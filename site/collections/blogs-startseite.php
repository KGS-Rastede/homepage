<?php

return function () {
    $blogs = new pages();
    foreach (collection('blogs') as $subpage) {
        if (
            $subpage->datumStartseite()->toDate('Y-m-d-H-i-s') >=
            date('Y-m-d-H-i-s')
        ) {
            //noch aktuell?
            if (in_array('Topartikel', $subpage->tags()->split()) == false) {
                //kein Topartikel)

                if ($subpage->toggleStartseite()->toBool() != true) {
                    //aktuelle Artikel, die keine Topartikel sind werden der collection hinzugefügt
                    $blogs = $blogs->add($subpage);
                }
            }
        }
    }

    return $blogs->flip();
};

?>
