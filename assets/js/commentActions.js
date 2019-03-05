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
    }).done(function(comment) {
      $("." + containerClass).prepend(comment);
    });
  } else {
    alert("You can't post an empty comment");
  }
}

function toggleReply(button) {
  const parent = $(button).closest(".itemContainer");
  const commentForm = parent.find(".commentForm").first();

  commentForm.toggleClass("hidden");
}
