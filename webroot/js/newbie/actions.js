var guide = $.guide({
    actions: [
        {
            element: $('.trophies'),
            content: '<progress class="progress is-primary is-small" value="40" max="100">40%</progress>\
                      <p class="title is-5 is-uppercase" style="color:#FFF">' + trophies.title + '</p>\
                      <p>' + trophies.content + '</p>',
            offsetX: 150,
            offsetY: -40
        },
        {
            element: $('.shared'),
            content: '<progress class="progress is-primary is-small" value="80" max="100">80%</progress>\
                      <p class="title is-5 is-uppercase" style="color:#FFF">' + shared.title + '</p>\
                      <p>' + shared.content + '</p>',
            offsetX: -390,
            offsetY: 20,
        },
        {
            element: $('.sign-in'),
            content: '<progress class="progress is-primary is-small" value="100" max="100">100%</progress>\
                      <p class="title is-5 is-uppercase is-spaced" style="color:#FFF">' + signin.title + '</p>\
                      <p class="subtitle is-6" style="color:#FFF">' + signin.content + '</p>',
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
