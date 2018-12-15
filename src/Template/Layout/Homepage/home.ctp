<!DOCTYPE html>
<html lang="<?= $locale == "fr_FR" ? "fr" : "pt"; ?>">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HabboMotel: <?= $title; ?></title>
    <meta name="Author" content="Jordan" />
    <meta name="description" content="<?= (isset($description)) ? $description : $meta_description; ?>" />
    <meta name="keywords" content="<?= $locale == "fr_FR" ? $keywords_fr : $keywords_pt; ?>" />
    <meta name="build" content="0.1" />
    <meta name="robots" content="index,follow,all" />
    <meta name="language" content="fr-FR" />
    <meta name="hreflang" content="fr-FR" />
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
    <script async src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <?= $this->Html->css('homepage/home.css'); ?>
    <?= $this->Html->css('carousel/homecarousel.css'); ?>

    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.css" />
    <script async src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.js"></script>
    <script>
    window.addEventListener("load", function(){
    window.cookieconsent.initialise({
      "palette": {
        "popup": {
          "background": "#000"
        },
        "button": {
          "background": "#f1d600"
        }
      },
      "showLink": false,
      "theme": "classic",
      "position": "bottom-right",
      "content": {
        "message": '<?= __("En poursuivant votre navigation sur HabboMotel, vous acceptez l’utilisation de cookies afin de nous permettre d’améliorer votre expérience utilisateur."); ?>',
        "dismiss": '<?= __("OK"); ?>'
      }
    })});
    </script>
</head>
<body>
    <div style="display: none;">
        <?php
        foreach($hotels as $hotel) {
            echo "<h1>" . $hotel . "</h1>";
        } ?>
    </div>
    <script>
    $(document).ready(function() {

        // Animation CSS
        $.fn.extend({
            animateCss: function (animationName) {
                var animationEnd = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
                this.addClass('animated ' + animationName).one(animationEnd, function() {
                    $(this).removeClass('animated ' + animationName);
                });
                return this;
            }
        });

        // Remove errors message
        $(".notification .delete").click(function() {
            $(".notification").animateCss("slideOutUp");
            $(".notification").fadeOut("slow");
        })
    });
    </script>

    <?= $this->Flash->render() ?>
    <?= $this->fetch('content') ?>

    <?= $this->element('Footer/footer'); ?>

    <?= $this->Html->script('carousel/homecarousel.js', ['async']); ?>
</body>
</html>
