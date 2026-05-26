(function (window) {
  const config = window.LidingoNetpublicatorBulletinboard || {};

  if (!config.id || !window.NPPublicBulletinBoard || !document.getElementById('bulletinboard')) {
    return;
  }

  window.NPPublicBulletinBoard.init({
    id: config.id,
  });
})(window);
