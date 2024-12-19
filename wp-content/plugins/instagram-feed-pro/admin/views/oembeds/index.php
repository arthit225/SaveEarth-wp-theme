<div id="sbi-oembeds" class="sbi-oembeds">
    <?php
        InstagramFeed\SBI_View::render( 'sections.header' );
        InstagramFeed\SBI_View::render( 'oembeds.content' );
        InstagramFeed\SBI_View::render( 'sections.sticky_widget' );

        include_once SBI_BUILDER_DIR . 'templates/sections/popup/license-learn-more.php';
        include_once SBI_BUILDER_DIR . 'templates/sections/popup/why-renew-license-popup.php';
    ?>

    <div class="sb-notification-ctn" :data-active="notificationElement.shown" :data-type="notificationElement.type">
        <div class="sb-notification-icon" v-html="svgIcons[notificationElement.type+'Notification']"></div>
        <span class="sb-notification-text" v-html="notificationElement.text"></span>
    </div>
</div>

