<?php

$data = $pages->find('blogs')->children()->published()->flip();
$json = [];

foreach ($data as $article) {
  $json[] = [
    'url' => (string) $article->url(),
    'title' => (string) $article->title(),
    'text' => (string) $article->text(),
    'date' => (string) $article->date(),
  ];
}

echo json_encode($json);
