<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>

<style>
body {
    margin: 0;
    font-family: 'Ubuntu';
    color: #4a4a4a;
}

header {
    width: 100%;
    height: 500px;
    background: rgba(50,50,50,.7);
}

header .logo {
    position: absolute;
    margin-top: 228px;
    -webkit-filter: drop-shadow(0 3px 0 rgba(0,0,0, 0.2)) drop-shadow(0 3px 0 rgba(0,0,0, 0.2)) drop-shadow(3px 0 0 rgba(0,0,0,0.2)) drop-shadow(-1px 0 0 rgba(0,0,0,0.2)) drop-shadow(0 0 10px transparent);
}

video {
    position: fixed;
    width: 100%;
    top: -110px;
    height: auto;
    background-size: cover;
    z-index: -100;
    filter: blur(2px);
}

h1.message {
    text-align: center;
    margin: 130px 0px 0px 0px;
    color: #e4e4e4;
}

button.register {
    box-shadow: 0 3px 0 1px rgba(0,0,0,.3);
    display: inline-block;
    line-height: 1.2;
    text-align: center;
    background-color: #00813e;
    border-color: #8eda55;
    color: #fff;
    font-size: 32px;
    padding: 12px 24px;
    border-radius: 5px;
    border-width: 2px;
    border-style: solid;
    margin-bottom: 4px;
    text-transform: uppercase;
    width: auto;
    cursor: pointer;
}

button.register:hover {
    background-color:#00ab54;
    border-color:#b9f373;
}

#loggedin {
    width: 100%;
    height: 80px;
    background-color: rgba(0, 0, 0, 0.5);
}

#container {
    width: 70%;
    left: 15%;
    position: relative;
}

#content {
    padding-top: 10px;
    background-color: #e4e4e4;
    width: 100%;
    height: 100%;
}
</style>
<video playsinline autoplay muted loop>
     <source src="<?= $this->request->webroot; ?>videos/facebook-promo.mp4" type="video/mp4">
   <?= $this->Html->image('registration_background_step1.png'); ?>
</video>

<header>
    <div id="loggedin">
    </div>
    <div id="container">
        <img class="logo animated bounceInDown" src="https://www.habbomotel.com/img/habbomotel.gif" />
        <h1 class="message" data-message="Des vêtements inédits dans ta garde-robe..\Lorem ipsum dolor sit amet, consectetur adipiscing..|Alors qu'attends-tu pour nous rejoindre?"></h1>
        <center><br/>
            <button class="register animated infinite pulse" style="display: none">inscris-toi</button>
        </center>
    </div>
</header>

<section id="content">
    <div id="container">
    </div>
</section>

<script>
function sleep(ms) {
  return new Promise(resolve => setTimeout(resolve, ms));
}

async function welcomeMessage() {
    let message = $(".message").attr("data-message");

    for(i = 0; i < message.length; i++) {
        if(message[i] == "\\") {
            $(".message").append("<br/>");
        } else if(message[i] == "|") {
            await sleep(500);
            $(".message").html("");
        } else {
            $(".message").append(message[i]);
        }

        await sleep(55);
    }

    $(".register").show();
}

welcomeMessage();
</script>
