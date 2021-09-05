<?php

return function($page) {

  // fetch the basic set of pages
  $articles = $page->children()->listed()->flip();

  // das dritte Argument hier (also das 'true') bewirkt,
  // dass nur einzigartige Tags zurückgegeben werden. Sonst hätte man
  // etliche Tags doppelt und zehnfach
  $tags = $articles->pluck('tags', ',', true);

  // add the tag filter
  if($tag = urldecode(param('tag'))) {
    $articles = $articles->filterBy('tags', $tag, ',');
  }

  // apply pagination
  $articles   = $articles->paginate(10);
  $pagination = $articles->pagination();

  return compact('articles', 'tags', 'tag', 'pagination');

};