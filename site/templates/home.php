<?php snippet('header') ?>

<?php
foreach (page('blogs')->children()->filterBy('featured', true) as $subpage) {
    echo "<div class=\"row\">\n";
    echo "<div class=\"col-sm-6\">\n";
    echo "<div class=\"card\">\n";
    echo "<div class=\"card-body\">\n";
    echo "<h5 class=\"card-title\">\n";
    echo $subpage->title();
    echo "</h5>";
    echo "<p class=\"card-text\">";
    echo $subpage->Text()->excerpt(150);
    echo "</p>";
    echo "<a href=\"";
    echo $subpage->url();
    echo "\" class=\"btn btn-primary\">...weiterlesen</a>";
    echo "</div>\n";
    echo "</div>\n";
    echo "</div>\n";
    echo "</div>\n";
}?>

<?php snippet('footer') ?>