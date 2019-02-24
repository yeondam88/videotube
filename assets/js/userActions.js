function subscribe(userTo, userFrom, button) {
  if (userTo == userFrom) {
    alert("You can't subscribe to yourself.");
  }

  $.post("ajax/subscribe.php", { userTo, userFrom }).done(function(data) {
    console.log(data);
  });
}
