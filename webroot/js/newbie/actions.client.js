/*var guide = $.guide({
    actions: [
        {
            element: $('.trophies'),
            content: '<progress class="progress is-primary is-small" value="40" max="100">40%</progress>\
                      <p class="title is-5 is-uppercase" style="color:#FFF">Mes Trophées</p>\
                      <p>Gagne et mets en avant <b>tes trophées</b> dans l\'hôtel en réalisant des actions<br/> sur le site, tel que commenter un article.</p>',
            offsetX: 150,
            offsetY: -40
        },
        {
            element: $('.shared'),
            content: '<progress class="progress is-primary is-small" value="80" max="100">80%</progress>\
                      <p class="title is-5 is-uppercase" style="color:#FFF">Partage à tes amis</p>\
                      <p>Remporte une box contenant des rares et des badges<br/> tous les jours en partageant <b>Jabbo Hôtel</b> à tes amis.</p>',
            offsetX: -390,
            offsetY: 20,
        },
        {
            element: $('.sign-in'),
            content: '<progress class="progress is-primary is-small" value="100" max="100">100%</progress>\
                      <p class="title is-5 is-uppercase is-spaced" style="color:#FFF">Rejoins les jabbos connectés</p>\
                      <p class="subtitle is-6" style="color:#FFF"><span class="icon is-small"><i class="fa fa-check"></i></span> Bravo, tu as terminé la visite guidée.</p>\
                      <p>Pour rejoindre les autres utilisateurs connectés clique<br/> sur le bouton <b>"Entrer dans l\'hôtel"</b>.</p>',
            offsetX: -390,
            offsetY: -95,
            beforeFunc: function(g) {
                $.get(hostname + "/avatars/newbie", function() {})
                .done(function() {
                });
            }
        },
        {
            beforeFunc: function(g) {
                location.reload();
            }
        }
    ]
});
*/