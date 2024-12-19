jQuery(window).on('sbiafterimagesloaded', function (event) {
    if (!event.el.hasClass('sbi_mediavine')) {
        return;
    }
    var sbIsMobile = (window.innerWidth <= 480),
        sbIsTablet = (window.innerWidth > 480 && window.innerWidth < 640),
        $feedEl = event.el;

    var cols = 3,
        tabletCols = 2,
        mobileCols = 1;

    if ($feedEl.length) {
        cols = parseInt($feedEl.attr('data-cols'));
        var settings = JSON.parse( $feedEl.attr('data-options'));

        if (settings.colsmobile !== 'auto') {
            mobileCols = parseInt(settings.colsmobile);
            tabletCols = cols;
        }
    }

    var insertFactor = cols*3;
    if (sbIsTablet) {
        insertFactor = tabletCols*3;
    } else if (sbIsMobile) {
        insertFactor = mobileCols*3;
    }

    setTimeout(function() {
        event.el.find('.sbi_item').each(function(index) {
            if ((index > 1) && (((index + 1) % insertFactor == 0)) ) {
                if (!jQuery(this).next('.content_hint').length) {
                    jQuery(this).after('<div class="content_hint"></div>');
                }
            }
        });

        if (typeof $mediavine !== 'undefined' && typeof $mediavine.web !== 'undefined' && typeof $mediavine.web.fillContentHints() !== 'undefined') {
            $mediavine.web.fillContentHints();
        } else {
            console.log( '$mediavine object not found');
        }
    },500);
});
