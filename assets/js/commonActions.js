$(document).ready(function() {
        var main = $("#mainSectionContainer");
        var nav = $("#sideNavContainer");
        nav.show();
        main.toggleClass("leftPadding");
    $(".navShowHide").on("click", function() {
        
        // var main = $("#mainSectionContainer");
        // var nav = $("#sideNavContainer");
        // nav.show();

        if(main.hasClass("leftPadding")) {
            nav.hide();
        }
        else {
            nav.show();
        }

        main.toggleClass("leftPadding");

    });

});

function notSignedIn() {
    alert("You must be signed in to perform this action");
}