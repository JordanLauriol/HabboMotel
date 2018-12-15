<footer class="footer">
    <div class="container">
        <div class="content">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="<?= $this->Url->build([
                        "controller" => "Home",
                        "action"     => "language",
                        "lang"       => "fr"
                        ]); ?>"><?= $this->Html->image('icons/fr.png'); ?>&nbsp; <?= __("Français"); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $this->Url->build([
                        "controller" => "Home",
                        "action"     => "language",
                        "lang"       => "pt"
                        ]); ?>"><?= $this->Html->image('icons/br.png'); ?>&nbsp; <?= __("Portugais"); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $this->Url->build([
                      'controller' => 'Articles',
                      'action'     => 'index'
                      ]); ?>"><?= __("Les articles"); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $this->Url->build([
                      'controller' => 'Forum',
                      'action'     => 'index'
                      ]); ?>"><?= __("Forum de discussion"); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" target="_blank" href="#"><?= __("Conditions d'utilisations"); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" target="_blank" href="#"><?= __("Nous contacter"); ?></a>
                </li>
            </ul>
            <p class="copyright">
                &copy; <?= date('Y'); ?> HabboMotel<br>
                <?= __("Propulsé par"); ?> <a href="https://cakephp.org" target="_blank">CakePHP</a> <?= __("et"); ?> <a href="https://bulma.io" target="_blank">Bulma</a><br/>
            </p>
        </div>
    </div>
</footer>

<?php
if($locale == "fr_FR") { ?>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-118638953-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-118638953-1');
</script>
<?php } else { ?>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-118690509-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-118690509-1');
</script>
<?php } ?>

<script type="text/javascript">
document.addEventListener('DOMContentLoaded', function () {

  // Get all "navbar-burger" elements
  var $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);

  // Check if there are any navbar burgers
  if ($navbarBurgers.length > 0) {

    // Add a click event on each of them
    $navbarBurgers.forEach(function ($el) {
      $el.addEventListener('click', function () {

        // Get the target from the "data-target" attribute
        var target = $el.dataset.target;
        var $target = document.getElementById(target);

        // Toggle the class on both the "navbar-burger" and the "navbar-menu"
        $el.classList.toggle('is-active');
        $target.classList.toggle('is-active');

      });
    });
  }
});
</script>
