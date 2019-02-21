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

    if (result.likes < 0) {
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

function updateLikesValue(element, number) {
  const likeCountValue = element.text() || 0;
  element.text(parseInt(likeCountValue) + parseInt(number));
}

function disLikeVideo(button, videoId) {
  $.post("ajax/disLikeVideo.php", {
    videoId
  }).done(function(data) {
    const disLikeButton = $(button);
    const likeButton = $(button).siblings(".likeButton");
    disLikeButton.addClass("active");
    likeButton.removeClass("active");

    const result = JSON.parse(data);
    updateLikesValue(likeButton.find(".text"), result.likes);
    updateLikesValue(disLikeButton.find(".text"), result.dislikes);

    if (result.dislikes < 0) {
      disLikeButton.removeClass("active");
      disLikeButton
        .find("img:first")
        .attr("src", "assets/images/icons/thumb-down.png");
    } else {
      disLikeButton
        .find("img:first")
        .attr("src", "assets/images/icons/thumb-down-active.png");
    }

    likeButton
      .find("img:first")
      .attr("src", "assets/images/icons/thumb-up.png");
  });
}
