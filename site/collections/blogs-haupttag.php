<?php

return function() {
    return collection('blogs')
    ->filterBy('tags', page()->haupttag(), ',');
}

?>