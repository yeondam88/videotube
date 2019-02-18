function likeVideo(button, videoId) {
  $.post("ajax/likeVideo.php", {
    videoId
  }).done(function(data) {
    alert(data);
  });
}
