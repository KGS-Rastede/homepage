<?php

class LehrerPage extends Page
{

    public function children()
    {
        $csv      = csv($this->root() . '/lehrer.csv', ';');
        $children = array_map(function ($lehrer) {
            return [
                'slug'     => Str::slug($lehrer['name']),
                'template' => 'lehrer',
                'model'    => 'lehrer',
                'num'      => 0,
                'content'  => [
                    'name'       => $lehrer['name'],
                    'kuerzel'  => $lehrer['kuerzel'],
                    'faecher' => $lehrer['faecher'],
                ]
            ];
        }, $csv);

        return Pages::factory($children, $this);
    }

}