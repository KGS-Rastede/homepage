<?php

return function($page) {

  // fetch the basic set of pages
  $articles = $page->children()->listed()->flip();

  // apply pagination
  $articles   = $articles->paginate(5);
  $pagination = $articles->pagination();

  return compact('articles', 'pagination');

};

?>