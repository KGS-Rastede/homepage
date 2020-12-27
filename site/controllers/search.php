<?php

return function ($site) {

  $query   = get('q');
  $sidewide = pages(["blogs", "kontakte", "Faecher", "allgemeines", "foerderverein", "formulare", "schule", "ser", "sv", "unterricht"])->children()->published();
  $results = $sidewide->search($query, 'title|text');
  $results = $results->paginate(10);

  return [
    'query'      => $query,
    'results'    => $results,
    'pagination' => $results->pagination()
  ];

};