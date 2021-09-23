<?php

class ListLehrer extends Page
{

    public function children()
    {
        $csv      = csv($this->root() . '/lehrer.csv', ';');
        $children = array_map(function ($lehrer) {
            return [
                'slug'     => Str::slug($lehrer['kuerzel']),
                'template' => 'krankmeldung',
                'model'    => 'krankmeldung',
                'num'      => 0,
                'content'  => [
                    'name'       => $lehrer['name'],
                    'kuerzel'  => $lehrer['kuerzel'],
                ]
            ];
        }, $csv);

        return Pages::factory($children, $this);
    }

}