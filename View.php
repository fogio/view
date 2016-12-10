<?php 

echo $view->render('app/index.php', ['event' => $event]);

?>

<?= $event['title'] /* auto escaped by htmlspecialchars */?>

<?= $event->title ?>

<?= $event->title->ucwords()->cut('140', '...') ?>

<? $event->title->filters()->ucwords()->cut('140', '...')->html() ?>
<?= $event->title ?>

<?= $event->start->date('Y-m-d H:i') ?>
<?= $event->start->dateModify('+1 Day')->date('Y-m-d H:i') ?>

var title = <?= $event->title->json() ?>;

<?= $event->title->striptags()->ucwords() ?>

<?= $event->tags->implode(', ')->pad(100, ' ', STR_PAD_RIGHT) ?>

<?= $event->tags->view('app/event/tags.php') ?>

<?= $event->deschtml->raw() ?>

<?= $event->deschtml->nofilters() ?>

<?= $event->view('app/event/detail.php') ?>

<? foreach ($events->tags as $tag) : ?>
    <?= $tag->ucfirst() ?>
<? endforeach ?>

<? 
    // view is predifined, auto created in view context, contains the view 
    $html = $view->var('<b>bold</b>');
    $html->filters()->upper();
    echo $html->html(); 
?>

<?= $event->non_existing_property->striptags()->ucwords() /* no errors, no warings */ ?>

<? foreach ($events->non_existing_property as $whatever) : /* no errors, no warings */ ?>
    <?= $whatever->ucfirst() ?>
<? endforeach ?>

<? if ($event->imgs->count()) : ?>

<? endif ?>

<? $view->start()->nospace()->ucfirst() ?>
a
b
c
<? $view->stop() ?>

<? $view->start()->html() ?>
Using bold in html: `<b>Text</b>`.
<? $view->stop() ?>

<? $doc = $view->var()->start() ?>
# 1. Heading Primary
## 1. 1. Heading Secondary
<? $view->stop() ?>
<?= $doc->mdTopicOfContents() ?>
<?= $doc->md() ?>

<? $view->start()->placeholder('head') ?>
<script> var x = 2; </script>
<? $view->stop() ?>

<? $article->attachments->is() ?>

<? $article->attachments->isIterable() ?>

<? $article->attachments->count() /* count array, if no array then returns 0, no errors*/ ?>

<? $article->status->is('public') ?>

<? $article->status->in(['public', 'draft']) ?>

<? $article->premium->sameas(true) ?>

<? $view->article->is() /* check level 0 variable*/ ?>

$view
    $view (container)
        $render($tpl, $data) + engines

$tpl { render}

engine php

<?php

namespace Fogio\Front;

class Module extends Fogio\Container\Container {

    public function _hook() {

        return $this->hook = (new Container())->__invoke([

            'app' => function ($c) {

                return $c->app = (new Container())->__invoke([

                    ':db' => function ($c, $db)  {
                        $db([
                            'event' => Fogio\Front\Model\Event::Class,
                        ]);
                    },

                    ':view' => function ($c, $view)  {
                        $view([
                            ':cut' => function($view, $val, $length = '100', $end = '...') {
                                // return ...;
                            },
                        ]);
                    },

                ]);

            },

        ]);
    }


}

$view->render->php->render();?>

// base.html
<!DOCTYPE html>
<html>
    <head>
        <?php $view->block('head') ?>
            <link rel="stylesheet" href="style.css" />
            <title><?php $view->valblock('title') ?> - My Webpage</title>
        <?php $view->endblock() ?>
    </head>
    <body>
        <div id="content"><?php $view->valblock('content') ?></div>
        <div id="footer">
            <?php $view->block('footer') ?>
                &copy; Copyright 2011 by <a href="http://domain.invalid/">you</a>.
            <?php $view->endblock() ?>
        </div>
    </body>
</html>


<?php $view->extends('base.html') ?>

<?php $view->block('title') ?>Index<?php $view->endblock() ?>
<?php $view->block('head') ?>
    {{ parent() }}
    <style type="text/css">
        .important { color: #336699; }
    </style>
<?php $view->endblock() ?>
<?php $view->block('head') ?>
    <h1>Index</h1>
    <p class="important">
        Welcome on my awesome homepage.
    </p>
<?php $view->endblock() ?>



<?php $view->head->block->start() ?>
    <link rss/>
<?php $view->head->block->stop() ?>