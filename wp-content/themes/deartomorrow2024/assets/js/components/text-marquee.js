function initializeTextMarquee() {
  (function ($) {
    $(".marquee-container").marquee({
      //duration in milliseconds of the marquee
      duration: 60000,
      //gap in pixels between the tickers
      gap: 50,
      //time in milliseconds before the marquee will start animating
      delayBeforeStart: 0,
      //true or false - should the marquee be duplicated to show an effect of continues flow
      duplicated: true,
      startVisible: true,
      delayBeforeStart: 500,
    });
  })(jQuery);
}

export default initializeTextMarquee;
