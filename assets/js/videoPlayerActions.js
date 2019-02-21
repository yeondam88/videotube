function likeVideo(button, videoId) {
  $.post("ajax/likeVideo.php", {
    videoId
  }).done(function(data) {
    const likeButton = $(button);
    const disLikeButton = $(button).siblings(".disLikeButton");
    likeButton.addClass("active");
    disLikeButton.removeClass("active");

    const result = JSON.parse(data);
    updateLikesValue(likeButton.find(".text"), result.likes);
    updateLikesValue(disLikeButton.find(".text"), result.dislikes);
  });
}

function updateLikesValue(element, number) {
  const likeCountValue = element.text() || 0;
  element.text(parseInt(likeCountValue) + parseInt(number));
}

function disLikeVideo(button, videoId) {
  $.post("ajax/disLikeVideo.php", {
    videoId
  }).done(function(data) {
    const likeButton = $(button);
    const disLikeButton = $(button).siblings(".disLikeButton");

    likeButton.removeClass("active");
    disLikeButton.addClass("active");

    const result = JSON.parse(data);
    updateLikesValue(likeButton.find(".text"), result.likes);
    updateLikesValue(disLikeButton.find(".text"), result.dislikes);
  });
}
