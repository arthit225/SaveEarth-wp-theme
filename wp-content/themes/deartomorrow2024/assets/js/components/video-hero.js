import $ from "jquery";
import inView from "in-view";
function videoHero() {
  var hero = $(".js-video-hero");

  if (hero.length) {
    inView(".js-video-hero").on("enter", function () {
      var text = hero.find(".js-video-hero-text p");
      text.each(function (i) {
        $(this)
          .delay(500 * (i + 1))
          .animate({ opacity: "1" }, 300); //Uses the each methods index+1 to create a multiplier on the delay
      });
    });
  }
}
export default videoHero;
