<?php

return function ($list) {
    // create a new collection from the parts and paginate
    $parts = (new Collection($parts))->paginate(1);

    // create the pagination object
    $pagination = $parts->pagination();

    // return the variables to the template
    return compact('parts', 'pagination');

};