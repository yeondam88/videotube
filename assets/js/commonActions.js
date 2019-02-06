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
