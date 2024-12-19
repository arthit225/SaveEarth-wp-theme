function initializeMenu() {
  //set submenu width and height for fully rounded background
  $("#menu-main-menu > li").each(function () {
    const isRoundMenu =
      $(this).hasClass("dt-hover-round") ||
      $(this).hasClass("dt-hover-round-2");
    if (!isRoundMenu) {
      return;
    }
    const submenu = $(this).find("> ul");
    const width = submenu.width();
    const height = submenu.height();
    const maxValue = width > height ? width : height;
    submenu.width(maxValue).height(maxValue);
  });

  // navigation menu hover effect and adjust submenu position
  $("#menu-main-menu > li").hover(
    function () {
      const stringWidth = $(this).find("> a").width();
      const stringMargin = $(this).find("> a").css("margin-left");
      const subMenuWidth = $(this).find("> ul").width();
      $(this)
        .find("> ul")
        .css({
          left: stringWidth / 2 - subMenuWidth / 2 + parseInt(stringMargin),
          display: "block",
        });
    },
    function () {
      $(this).find("> ul").css({ display: "none" });
    }
  );
}
export default initializeMenu