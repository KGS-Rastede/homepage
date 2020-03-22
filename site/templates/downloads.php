<?php snippet('header') ?>
<?php snippet('page-header') ?>

<ul class="nav nav-pills nav-pills-icons" role="tablist">
    <!--
        color-classes: "nav-pills-primary", "nav-pills-info", "nav-pills-success", "nav-pills-warning","nav-pills-danger"
    -->
    <li class="nav-item">
        <a class="nav-link active" href="#Schulbuchlisten-1" role="tab" data-toggle="tab">
            <i class="material-icons">dashboard</i>
            <?= $page->subtitle1() ?>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#schedule-1" role="tab" data-toggle="tab">
            <i class="material-icons">schedule</i>
            Ag-Wahllisten
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#tasks-1" role="tab" data-toggle="tab">
            <i class="material-icons">list</i>
            Tasks
        </a>
    </li>
</ul>
<div class="tab-content tab-space">
    <div class="tab-pane active" id="Schulbuchlisten-1">
        <h2><?= $page->subtitle1() ?></h2>
        <h4><?= $page->Subtitletext1() ?></h4>
        <div class="d-flex justify-content-around mt-2">
            <div class="card" style="width: 23rem;">
            <div class="card-header card-header-danger">
                <h4 class="card-title">Hauptschule</h4>
            </div>
            <div class="card-body">
                <h6 class="card-subtitle mt-1 mb-2 text-muted">Braucht man den hier?</h6>
                <p class="card-text"><?= $page->cardtextHZ() ?></p>
                <div class="card card-nav-tabs" style="width: 100%;">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr><th>Schulbuchlisten</th></tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>5. Klasse</td>
                                <td class="td-actions text-right">
                                    <button type="button" rel="tooltip" class="btn btn-info btn-just-icon btn-sm">
                                        <i class="material-icons">cloud_download</i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>10. Klasse</td>
                                <td class="td-actions text-right">
                                <button class="btn btn-success">
                                    <i class="material-icons">cloud_download</i></button>
                                </td>
                            </tr>
                            <?php foreach ($page->Schulbuchlisten()->toStructure() as $liste) : ?>
                                <tr>
                                <td><?= $liste->name() ?><br>Kosten: <?= $liste->preis() ?>
                                </td>
                                <td class="td-actions text-right">
                                    <a href="<?= $liste->link()->toFile()->url() ?>">
                                    <button type="button" rel="tooltip" class="btn btn-success btn-just-icon">
                                        <i class="material-icons">cloud_download</i>
                                    </button>
                                    </a>
                                <div class="text-left">
                                </div>
                                </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>

            <div class="card" style="width: 23rem;">
            <div class="card-header card-header-danger">
                <h4 class="card-title">Realschule</h4>
            </div>
            <div class="card-body">
                <h6 class="card-subtitle mb-2 mt-1 text-muted">Card subtitle</h6>
                <p class="card-text"><?= $page->cardtextRZ() ?></p>
                <div class="card card-nav-tabs" style="width: 100%;">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><a href="#" class="card-link">5. Klasse</a></li>
                    <button class="btn btn-success btn-round">
                        <i class="material-icons">cloud_download</i>  Download</button>
                        <li class="list-group-item"><a href="#" class="card-link">6. Klasse</a></li>
                        <li class="list-group-item"><a href="#" class="card-link">7. Klasse</a></li>
                        <li class="list-group-item"><a href="#" class="card-link">8. Klasse</a></li>
                        <li class="list-group-item"><a href="#" class="card-link">9. Klasse</a></li>
                        <li class="list-group-item"><a href="#" class="card-link">10. Klasse</a></li>
                        <li class="list-group-item"><a href="#" class="card-link">11. Klasse</a></li>
                        <li class="list-group-item"><a href="#" class="card-link">12. Klasse</a></li>
                    </ul>
                </div>
            </div>
        </div>

            <div class="card" style="width: 23rem;">
            <div class="card-header card-header-danger">
                <h4 class="card-title">Gymnasium</h4>
            </div>
            <div class="card-body">
                <h6 class="card-subtitle mb-2 mt-1 text-muted">Card subtitle</h6>
                <p class="card-text"><?= $page->cardtextGZ() ?></p>
                <a href="javascript:;" class="card-link">Card link</a>
                <a href="javascript:;" class="card-link">Another link</a>
                <div class="card card-nav-tabs card-plain mt-5">
                    <div class="card-header card-header-warning">
                        <!-- colors: "header-primary", "header-info", "header-success", "header-warning", "header-danger" -->
                        <div class="nav-tabs-navigation">
                            <div class="nav-tabs-wrapper">
                                <ul class="nav nav-tabs" data-tabs="tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#5" data-toggle="tab">5. Klasse</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#6" data-toggle="tab">6. Klasse</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#7" data-toggle="tab">7. Klasse</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#8" data-toggle="tab">8. Klasse</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#9" data-toggle="tab">9. Klasse</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#10" data-toggle="tab">10. Klasse</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div><div class="card-body ">
                        <div class="tab-content text-center">
                            <div class="tab-pane active" id="5">
                                Hier die Schulbuch Pläne für die 5. Klasse. Die kosten 30€                    
                                <button class="btn btn-success">
                                        <i class="material-icons">cloud_download</i>  Download</button>
                            </div>
                            <div class="tab-pane" id="6">
                                <p> I will be the leader of a company that ends up being worth billions of dollars, because I got the answers. I understand culture. I am the nucleus. I think that&#x2019;s a responsibility that I have, to push possibilities, to show people, this is the level that things could be at. I think that&#x2019;s a responsibility that I have, to push possibilities, to show people, this is the level that things could be at. </p>
                            </div>
                            <div class="tab-pane" id="7">
                                asdasd
                            </div>
                            <div class="tab-pane" id="8">
                                asdaasdassd
                            </div>
                            <div class="tab-pane" id="9">
                                assdsdfdasd
                            </div>
                            <div class="tab-pane" id="10">
                                asdasdfscxvxsd
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
    <div class="tab-pane" id="schedule-1">
        <h2><?= $page->subtitle2() ?></h2>
      Efficiently unleash cross-media information without cross-media value. Quickly maximize timely deliverables for real-time schemas.
      <br><br>Dramatically maintain clicks-and-mortar solutions without functional solutions.
    </div>
    <div class="tab-pane" id="tasks-1">
        <h2><?= $page->subtitle3() ?></h2>
       sdfsdfsdfs 
       Completely synergize resource taxing relationships via premier niche markets. Professionally cultivate one-to-one customer service with robust ideas.
        <br><br>Dynamically innovate resource-leveling customer service for state of the art customer service.
    </div>
</div>


<?php snippet('sidebar') ?>
<?php snippet('footer') ?>