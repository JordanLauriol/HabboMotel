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

    // Remove notification
    $(".message").each(function(index, element) {
        $(this).find('.delete').click(function(event) {
            event.preventDefault();
            var notificationId = $(this).attr("data-id");
            $.get(hostname + "/notifications/read/" + notificationId, function() {
            })
            .done(function() {
                $(element).animateCss("slideOutUp");
                $(element).fadeOut("slow");
            });
        });
    });

    // Remove comment
    $(".comment").each(function(index, element) {
        var commentId = $(this).attr("data-id");
        $(this).find('.delete').click(function(event) {
            event.preventDefault();
            $.get(hostname + "/comments/delete/" + commentId, function() {
            })
            .done(function() {
                $(element).animateCss("fadeOutLeftBig");
                $(element).fadeOut("slow");
            });
        });
    });

    // Close modal
    $(".modal .delete").click(function() {
        $(".modal").removeClass("is-active");
    });

    $(".modal-share").click(function() {
        $(".modal").addClass("is-active");
    });

    // Share
    $(".share").click(function(event) {
        $.get(hostname + "/share/facebook", function() {
        }, 'json')
        .done(function(data) {
            FB.ui({
                method: "share",
                href: hostname,
                quote: data.quote,
                hashtag: data.hashtag
            }, function(response) {
                if (response && !response.error_message) {
                    $.get(hostname + "/share/reward", { reward: 'ducket' }, function() {
                    })
                    .done(function(result) {
                        var response = JSON.parse(result);
                        $(".modal .notification").fadeIn().addClass(response.type).animateCss('bounce').text(response.message);
                    });
                } else {
                    $(".modal .notification").fadeIn().addClass("is-danger").animateCss('bounce').text(notShared);
                }
            });
        });
    });

    // Team - user information
    $(".team .user").click(function() {
        var pos = $(this).offset();

        $(".team .ui").css({
            position: 'absolute', 
            top: pos.top - 300, 
            left: pos.left - 80
        });

        $.get(hostname + "/community/staff/" + $(this).attr("data-uid"), function(data) {
        }, 'json')
        .done(function(data) {
            $(".team .ui").find("#username").html(data.username);
            $(".team .ui").find("#motto i").html(data.motto);
            $(".team .ui").find("#last_online i").html(data.last_online);
            $(".team .ui").show();
        });
    })
    .mouseleave(function() {
        $(".team .ui").hide();
    });
});
