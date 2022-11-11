const options = {
  cache: false,
  animateHistoryBrowsing: true,
};

const swup = new Swup(options);

swup.on('animationInDone', function() {
  $('input[autofocus]').trigger('focus');
});