<?php

class SpendenPage extends Page
{

    public function children()
    {
        $file     = $this->datafile()->toFile();
        $csv      = csv($file->root(), ';');

        $children = array_map(function ($spenden) {
            return [
                'slug'     => Str::slug($spenden['Spender']),
                'template' => 'spenden',
                'model'    => 'spenden',
                'num'      => 0,
                'content'  => [
                    'datum'       => $spenden['Datum'],
                    'spender'  => $spenden['Spender'],
                    'betrag' => $spenden['Betrag'],
                ]
            ];
        }, $csv);

        return Pages::factory($children, $this);
    }

}

