
(function ($) {
    $(document).ready(function () {
        $(document).on('click', '.theplus_wdkit_new_banner_btn', function(e){
            e.preventDefault();

            jQuery('.wb-loader-circle', this ).css('display','block')
            jQuery('.theplus-enable-text', this ).css('display','none')

            jQuery.ajax({
                url: ajaxurl,
                dataType: 'json',
                type: "post",
                async: true,
                cache: false,
                data: {
                    action: 'tp_install_wdkit',
                    security: theplus_nonce,
                },
                success: function (res) {
                    jQuery('.wb-loader-circle').css('display','none')

                    if( true === res.success ){
                     var wdkitlink = jQuery('.theplus_wdkit_new_banner_btn').data('link')

                        jQuery('.theplus-enable-text').css('display', 'block').text('Activated');
                        if (wdkitlink) {
                            window.location.href = wdkitlink;
                        }
                    }else{
                        jQuery('.theplus-enable-text').css('display', 'block').text('Enable Templates');
                    }
                }
            });

        });
    });
})(window.jQuery);