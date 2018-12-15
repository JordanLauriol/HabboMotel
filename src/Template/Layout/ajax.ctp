<style>
@import url('https://fonts.googleapis.com/css?family=Ubuntu');
body {
    font-family: 'Ubuntu';
    color: #FFF;
}

.has-text-centered {
    text-align: center;
}

.has-text-uppercase {
    text-transform: uppercase;
}

/* MODAL */
.modal {
    min-width: 30%;
    min-height: 15%;

    display: none;
    position: absolute;

    background-color: rgb(236, 234, 224);

    border-radius: 10px;
    border: 1px solid #000;

    -moz-box-shadow: 0px 0px 2px 0px #000;
    -webkit-box-shadow: 0px 0px 4px 0px #000;
    -o-box-shadow: 0px 0px 4px 0px #000;
    box-shadow: 0px 0px 4px 0px #000;
    filter:progid:DXImageTransform.Microsoft.Shadow(color=#000, Direction=NaN, Strength=4);
}

.modal-header {
    width: 100%;
    height: 2em;

    background-color: rgb(54, 120, 151);

    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
    border: 2px solid rgb(64, 140, 175);
    border-bottom: 1px solid #000;

    box-sizing: border-box;

    font-weight: bold;
}

.modal-body {
    width: 100%;
    height: auto;

    color: #333;

    box-sizing: border-box;

    padding: 5px;
}

.modal-body .content {
    box-sizing: border-box;

    width: 100%;

    background-color: #FFF;

    border-radius: 5px;

    padding: 10px;
}

.modal-footer {
    position: absolute;
    bottom: 0;

    width: 100%;
    height: 2em;

    border-bottom-left-radius: 10px;
    border-bottom-right-radius: 10px;

    box-sizing: border-box;
}

#profileInformationComposer {
    width: 30%;
    height: auto;
}
</style>

<?= $this->fetch('content'); ?>
