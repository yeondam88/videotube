function postComment(button, postedBy, videoId, replyTo, containerClass) {
  const textarea = $(button).siblings("textarea");
  const commentText = textarea.val();
  textarea.val("");

  if (commentText) {
    $.post("ajax/postComment.php", {
      commentText,
      postedBy,
      videoId,
      responseTo: replyTo
    }).done(function(data) {
      alert(data);
    });
  } else {
    alert("You can't post an empty comment");
  }
}
