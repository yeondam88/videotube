function subscribe(userTo, userFrom, button) {
  if (userTo == userFrom) {
    alert("You can't subscribe to yourself.");
  }

  $.post("ajax/subscribe.php", { userTo, userFrom }).done(function(count) {
    if (count != null) {
      $(button).toggleClass("subscribe unsubscribe");

      const buttonText = $(button).hasClass("subscribe")
        ? "SUBSCRIBE"
        : "SUBSCRIBED";
      $(button).text(buttonText + " " + count);
    } else {
      alert("Something went wrong.");
    }
  });
}
