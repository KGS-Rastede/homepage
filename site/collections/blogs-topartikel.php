<?php

return function () {
    $blogs = new pages();
    foreach (collection('blogs') as $subpage) {
        if (
            $subpage->datumStartseite()->toDate('Y-m-d-H-i-s') >=
            date('Y-m-d-H-i-s') //noch aktuell?
        ) {
            $blogs = $blogs->add($subpage);
        } //wenn der Artikel aktuell ist wird er vorläufig der collection hinzugefügt
    }
    return $blogs->flip()->filterBy('tags', 'Topartikel', ','); //ist es ein Topartikel?
};

?>
