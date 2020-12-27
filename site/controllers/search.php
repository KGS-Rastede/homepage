<?php

return function ($site) {

  $query   = get('q');
  $results = page('blogs')->search($query, 'title|text');
  $results = $results->paginate(10);

  return [
    'query'      => $query,
    'results'    => $results,
    'pagination' => $results->pagination()
  ];

};