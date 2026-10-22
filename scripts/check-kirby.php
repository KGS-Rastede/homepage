<?php

// Migration checks: php scripts/check-kirby.php [--content] [--render]
ob_start(); // Panel responses must be able to set cookies and headers.
require dirname(__DIR__) . '/kirby/bootstrap.php';

use Kirby\Cms\Page;
use Kirby\Blueprint\Blueprint;
use Symfony\Component\Yaml\Yaml;

$root = dirname(__DIR__);
$kirby = new Kirby(['roots' => ['index' => $root]]);
$errors = [];
$checked = 0;
$phpFiles = 0;
foreach ([$root . '/index.php', ...iterator_to_array(new RecursiveIteratorIterator(new RecursiveDirectoryIterator($root . '/site')))] as $file) {
    $path = (string)$file;
    if (pathinfo($path, PATHINFO_EXTENSION) !== 'php') {
        continue;
    }
    $phpFiles++;
    try {
        token_get_all(file_get_contents($path), TOKEN_PARSE);
    } catch (Throwable $error) {
        $errors[] = $path . ': ' . $error->getMessage();
    }
}

foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($root . '/site/blueprints')) as $file) {
    if ($file->getExtension() !== 'yml') {
        continue;
    }
    $checked++;
    try {
        Yaml::parseFile($file->getPathname());
    } catch (Throwable $error) {
        $errors[] = $file->getPathname() . ': ' . $error->getMessage();
    }
}

// Loading the blueprints also checks inheritance and section/field name clashes.
$models = ['site' => $kirby->site()];
foreach (glob($root . '/site/blueprints/pages/*.yml') as $file) {
    $name = pathinfo($file, PATHINFO_FILENAME);
    $models['pages/' . $name] = new Page(['slug' => 'check-' . $name, 'template' => $name]);
}
foreach ($models as $blueprint => $model) {
    try {
        foreach (Blueprint::factory($model, $blueprint)->fields() as $name => $field) {
            if (($field['type'] ?? null) === 'error' || ($field['label'] ?? null) === 'Error' || preg_match('/-duplicate-\d+$/', $name)) {
                $errors[] = $blueprint . '/' . $name . ': ' . strip_tags($field['text'] ?? 'Invalid field');
            }
        }
    } catch (Throwable $error) {
        $errors[] = $model->id() . ': ' . $error->getMessage();
    }
}

if (in_array('--content', $argv, true)) {
    $contentFields = 0;
    $legacyFields = 0;
    foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($root . '/content')) as $file) {
        if ($file->getExtension() !== 'txt') {
            continue;
        }
        foreach (Kirby\Data\Txt::decode(file_get_contents($file->getPathname())) as $name => $value) {
            if (!is_string($value) || !str_starts_with(ltrim($value), '- ')) {
                continue;
            }
            $contentFields++;
            try {
                if (Kirby\Data\YamlSymfony::decode($value) !== Kirby\Data\YamlSpyc::decode($value)) {
                    $legacyFields++;
                    if ($kirby->option('yaml.handler') !== 'spyc') {
                        $errors[] = $file->getPathname() . '/' . $name . ': YAML parsers return different values or types';
                    }
                }
            } catch (Throwable $error) {
                if ($kirby->option('yaml.handler') !== 'spyc') {
                    $errors[] = $file->getPathname() . '/' . $name . ': incompatible YAML';
                } else {
                    $legacyFields++;
                }
            }
        }
    }
    echo $contentFields . ' YAML content fields checked; ' . $legacyFields . ' require legacy compatibility (handler: ' . ($kirby->option('yaml.handler') ?? 'symfony') . ').' . PHP_EOL;
}

if (in_array('--render', $argv, true)) {
    $_SERVER['HTTP_HOST'] = 'localhost';
    foreach (['', 'blogs', 'kontakte', 'wichtige-informationen', 'sitemap.xml', $kirby->option('panel.slug', 'panel')] as $path) {
        try {
            $app = new Kirby(['roots' => ['index' => $root], 'options' => ['debug' => true]]);
            $response = $app->render($path);
            echo '/' . $path . ': HTTP ' . $response->code() . PHP_EOL;
            if ($response->code() >= 400) {
                $errors[] = '/' . $path . ': HTTP ' . $response->code();
            }
        } catch (Throwable $error) {
            $errors[] = '/' . $path . ': ' . $error->getMessage() . ' (' . $error->getFile() . ':' . $error->getLine() . ')';
        }
    }
}

foreach ($errors as $error) {
    fwrite(STDERR, $error . PHP_EOL);
}
echo 'Kirby ' . $kirby->version() . ': ' . $phpFiles . ' PHP files, ' . $checked . ' YAML files, ' . count($models) . ' blueprints, ' . count($errors) . ' errors.' . PHP_EOL;
ob_end_flush();
exit($errors === [] ? 0 : 1);
