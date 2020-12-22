<?php

return function() {

    $blogs = new pages();
    foreach (collection('blogs') as $subpage) {
        if (
            $subpage->datumStartseite()->toDate('Y-m-d-H-i-s') >= date('Y-m-d-H-i-s') //noch aktuell? 
            && in_array("Topartikel", $subpage->tags()->split()) == false  //kein Topartikel
        )
            $blogs = $blogs->add($subpage); //aktuelle Artikel, die keine Topartikel sind werden der collection hinzugefügt
    }

    return $blogs
        ->flip();
}

?>