<?php

// Anleitung dazu hier:
// https://getkirby.com/docs/cookbook/content/search

return function ($site) {

  $query   = get('q');
  $sidewide = pages([
    "blogs",
    "kontakte",
    "schulleitung",
    "Faecher",
    "allgemeines",
    "schule",
    "ser",
    "sv",
    "unterricht"
  ])
    ->children()->published();
  $results = $sidewide->search($query, 'title|text');
  $results = $results->paginate(10);

  return [
    'query'      => $query,
    'results'    => $results,
    'pagination' => $results->pagination()
  ];
};
