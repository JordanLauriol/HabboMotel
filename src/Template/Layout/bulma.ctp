<!DOCTYPE html>
<html lang="<?= $locale == "fr_FR" ? "fr" : "pt"; ?>">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HabboMotel - <?= (isset($title)) ? $title : ""; ?></title>
    <meta name="Author" content="Jordan" />
    <meta name="description" content="<?= (isset($description)) ? $description : $meta_description; ?>" />
    <meta name="keywords" content="<?= $locale == "fr_FR" ? $keywords_fr : $keywords_pt; ?>" />
    <meta name="build" content="0.1" />
    <meta name="robots" content="index,follow,all" />
    <meta name="language" content="<?= $locale; ?>" />
    <meta name="hreflang" content="<?= $locale; ?>" />
    <meta property="og:site_name" content="HabboMotel" />
    <meta property="og:title" content="<?= $title; ?>" />
    <meta property="og:url" content="https://<?= $_SERVER['SERVER_NAME']; ?>" />
    <meta property="og:type" content="website" />
    <meta property="og:description" content="<?= (isset($description)) ? $description : $meta_description; ?>" />
    <meta property="og:image" content="<?= $this->Url->build('/img/hmmedia.png', true); ?>" />
    <meta property="og:locale" content="<?= $locale; ?>" />
    <meta property="fb:app_id" content="<?= ($locale == "fr_FR") ? "2042368839367599" : "209131013199447"; ?>" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.0/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>

    <?= $this->Html->css('app.css'); ?>
    <?= $this->Html->css('bulma-switch.min.css'); ?>
    <?php
    if($this->request->controller == "Avatars" && $this->request->action == "index") {
        echo $this->Html->css('carousel/carousel.css');
    }

    if($this->request->controller == "Forum") {
        echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">';
        echo '<script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>';
        echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/showdown/1.8.6/showdown.min.js"></script>';
        echo $this->Html->css('bulma-tooltip.min.css');
        echo $this->Html->css('forum.css');
    }
    ?>

</head>
<body>
    <div style="display: none;">
        <?php
        foreach($hotels as $hotel) {
            echo "<h1>" . $hotel . "</h1>";
        } ?>
    </div>
    <script type="text/javascript">
    var hostname = "https://<?= $_SERVER['HTTP_HOST']; ?>";
    var notShared = "<?= __('Malheureusement, tu n\'as pas partagé notre publication sur tes réseaux sociaux pour gagner tes duckets du jour.'); ?>";
    </script>

    <div id="fb-root"></div>
    <script>
    (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.async=true; js.src = 'https://connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v2.11&appId=<?= ($locale == "fr_FR") ? "2042368839367599" : "209131013199447"; ?>';
    fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

    <section class="hero is-dark habbo-header" style="<?= $locale == "pt_PT" ? "background-image:url(/img/topheader_pt.png);background-position:0px -14px;" : ""; ?> background-color: #def1ff;">
        <?= $this->element('Header/header'); ?>

        <?php
        /*// Tabs
        if($this->request->session()->check('Auth.User.id')) {
            echo $this->element('Header/tabs');
        }*/

        echo $this->element('Header/tabs');
        ?>
    </section>

    <?php
    /*// Navbar
    if($this->request->session()->check('Auth.User.id')) {
        echo $this->element('Header/navbar');
    } else {
        echo $this->element('')
    }*/

    echo $this->element('Header/navbar');
    ?>

    <section class="section" style="margin-top: -1.5rem;">
        <div class="container">
            <div class="columns">
                <div class="column is-narrow" style="width: 100%;">
                    <?= $this->Flash->render() ?>
                    <?= $this->fetch('content') ?>
                </div>

                <div class="column is-2">
                    <?= $this->element('Advertising/160x600'); ?>
                </div>
            </div>
        </div>
    </section>


    <?= $this->element('Footer/footer'); ?>

    <?php
    if($this->request->controller == "Avatars" && $this->request->action == "index") {
        echo $this->Html->script('carousel/carousel.js', ['async' => 'true']);
    } ?>
    <?= $this->Html->script('app.js', ['async' => 'true']) ?>
</body>
</html>
