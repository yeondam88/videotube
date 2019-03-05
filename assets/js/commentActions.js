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
      if (!replyTo) {
        $("." + containerClass).prepend(comment);
      } else {
        $(button)
          .parent()
          .siblings("." + containerClass)
          .append(comment);
      }
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

function likeComment(commentId, button, videoId) {
  $.post("ajax/likeComment.php", {
    commentId,
    videoId
  }).done(function(numToChange) {
    const likeButton = $(button);
    const disLikeButton = $(button).siblings(".disLikeButton");
    likeButton.addClass("active");
    disLikeButton.removeClass("active");

    let likesCount = $(button).siblings(".likesCount");

    updateLikesValue(likesCount, numToChange);

    if (numToChange < 0) {
      likeButton.removeClass("active");
      likeButton
        .find("img:first")
        .attr("src", "assets/images/icons/thumb-up.png");
    } else {
      likeButton
        .find("img:first")
        .attr("src", "assets/images/icons/thumb-up-active.png");
    }

    disLikeButton
      .find("img:first")
      .attr("src", "assets/images/icons/thumb-down.png");
  });
}

function disLikeComment(commentId, button, videoId) {
  $.post("ajax/dislikeComment.php", {
    commentId,
    videoId
  }).done(function(numToChange) {
    const dislikeButton = $(button);
    const likeButton = $(button).siblings(".likeButton");

    dislikeButton.addClass("active");
    likeButton.removeClass("active");

    let likesCount = $(button).siblings(".likesCount");

    updateLikesValue(likesCount, numToChange);

    if (numToChange > 0) {
      dislikeButton.removeClass("active");
      dislikeButton
        .find("img:first")
        .attr("src", "assets/images/icons/thumb-down.png");
    } else {
      dislikeButton
        .find("img:first")
        .attr("src", "assets/images/icons/thumb-down-active.png");
    }

    likeButton
      .find("img:first")
      .attr("src", "assets/images/icons/thumb-up.png");
  });
}

function updateLikesValue(element, number) {
  const likeCountValue = element.text() || 0;
  element.text(parseInt(likeCountValue) + parseInt(number));
}

function getReplies(commentId, button, videoId) {
  $.post("ajax/getCommentReplies.php", { commentId, videoId }).done(function(
    comments
  ) {
    const replies = $("<div>").addClass("repliesSection");
    replies.append(comments);

    $(button).replaceWith(replies);
  });
}
