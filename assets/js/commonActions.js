$(document).ready(function() {
  $(".navShowHide").on("click", function() {
    const main = $("#mainSectionContainer");
    const nav = $("#sideNavContainer");

    if (main.hasClass("leftPadding")) {
      nav.hide();
    } else {
      nav.show();
    }

    main.toggleClass("leftPadding");
  });
});

function notSignedIn() {
  alert("You must be signed in perform this action!");
}
