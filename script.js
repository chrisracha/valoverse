$(document).ready(function() {

    var audhover = new Audio("audio/hover.mp3");
    audhover.preload = "auto";
    var audonclick = new Audio("audio/onclick.mp3");
    audonclick.preload = "auto";

    $("ul a").hover(function() {
        audhover.play();
    });
    $("button").hover(function() {
        audhover.play();
    });
    $("ul li a").click(function() {
        audonclick.play();
    });

    $(document).on('click', '#signupTrigger', function(event) {
        event.preventDefault();
        loadForm('php/signup.php');
    });

    $(document).on('click', '#loginTrigger', function(event) {
        event.preventDefault();
        loadForm('php/login.php');
    });

});

function loadForm(url) {
    $.ajax({
        url: url,
        method: 'GET',
        success: function(response) {
            $('#account').html(response);
        }
    });
}

function smoothScroll(target) {
    $('html, body').animate({
        scrollTop: $(target).offset().top
    }, 300);
}

function loadAgentStats(agent) {
    $.ajax({
        url: 'php/agent_stats.php',
        type: 'GET',
        data: { agent: agent },
        success: function(response) {
            $('.agent_stats').html(response);
        },
        error: function() {
            console.log('Error occurred while loading agent stats.');
        }
    });
}