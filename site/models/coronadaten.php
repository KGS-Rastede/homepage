<?php

class CoronadatenPage extends Page
{

    public function children()
    {
        $csv      = csv($this->root() . '/coronadaten.csv', ';');
        $children = array_map(function ($datenpunkt) {
            return [
                'slug'     => Str::slug($datenpunkt['name']),
                'template' => 'datenpunkt',
                'model'    => 'datenpunkt',
                'num'      => 0,
                'content'  => [
                    'name'       => $datenpunkt['name'],
                    'quarantaene'  => $datenpunkt['quarantaene'],
                    'infiziert' => $datenpunkt['infiziert'],
                ]
            ];
        }, $csv);

        return Pages::factory($children, $this);
    }

}