<?php snippet('header') ?>

<?php snippet('page-header') ?>


<section class="jumbotron text-center">
  <div class="container">
    <h1>Die Schule stellt sich vor</h1>

    <p class="lead">Hier stellen sich die Fächer und Fachbereiche vor, aber auch andere Bereiche der Schule berichten.</p>
  </div>
</section>

<section class="content blog">
<?php snippet('blogs', [
      'blogs' => page('blogs')
        ->children()
        ->listed()
    ]) ?>

</section>



<?php snippet('footer') ?>