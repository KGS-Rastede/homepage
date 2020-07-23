<?php

class SpendenPage extends Page
{

    public function children()
    {
        $csv      = csv($this->root() . '/spenden.csv', ';');
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

