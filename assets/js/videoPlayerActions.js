function likeVideo(button, videoId) {
  $.post("ajax/likeVideo.php", {
    videoId
  }).done(function (data) {
    const likeButton = $(button);
    const disLikeButton = $(button).siblings(".dislikeButton");

    likeButton.addClass("active");
    disLikeButton.removeClass("active");

    const result = JSON.parse(data);
  });
}

function disLikeVideo(button, videoId) {
  $.post("ajax/disLikeVideo.php", {
    videoId
  }).done(function (data) {
    const likeButton = $(button);
    const disLikeButton = $(button).siblings(".dislikeButton");

    likeButton.removeClass("active");
    disLikeButton.addClass("active");
  });
}