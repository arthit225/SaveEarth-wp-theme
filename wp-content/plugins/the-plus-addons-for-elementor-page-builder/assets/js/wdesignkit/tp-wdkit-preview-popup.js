(function ($) {
    const {
        __,
    } = wp.i18n;

    $("document").ready(function () {
        let templateAddSection = $("#tmpl-elementor-add-section");

        if (0 < templateAddSection.length) {
            var oldTemplateButton = templateAddSection.html();
                oldTemplateButton = oldTemplateButton.replace('<div class="elementor-add-section-drag-title', '<div data-mode="dark" class="elementor-add-section-area-button elementor-action-tp-wdkit-button" title="' + __("WDesignKit") + '"><a href="#" class="tp-wkit-main-logo-div"></a></div><div class="elementor-add-section-drag-title');
                templateAddSection.html(oldTemplateButton);
        }

        elementor.on("preview:loaded", function () {
            
            window.tp_wdkit_editor = elementorCommon.dialogsManager.createWidget(
                "lightbox",
                {
                    id: "tp-wdkit-elementorp",
                    headerMessage: !1,
                    message: "",
                    hide: {
                        auto: !1,
                        onClick: !1,
                        onOutsideClick: false,
                        onOutsideContextMenu: !1,
                        onBackgroundClick: !0,
                    },
                    position: {
                        my: "center",
                        at: "center",
                    },
                    onShow: function () {
                        var dialogLightboxContent = $(".dialog-lightbox-message"),
                            clonedWrapElement = $("#tp-wdkit-wrap");

                            clonedWrapElement = clonedWrapElement.clone(true).show()
                            dialogLightboxContent.html(clonedWrapElement);

                            dialogLightboxContent.on("click", ".tp-close-btn", function () {
                                window.tp_wdkit_editor.hide();
                            });
                    },
                    onHide: function () {
                        window.tp_wdkit_editor.destroy();
                    }
                }
            );

            $(elementor.$previewContents[0].body).on("click", ".elementor-action-tp-wdkit-button", function (event) {
                window.tp_wdkit_editor.show();
            });

            $(document).on('click', '.tp-not-show-again', function (e) {
                e.preventDefault();
                $.ajax({
                    url: tp_wdkit_preview_popup.ajax_url,
                    dataType: 'json',
                    type: "POST",
                    async: true,
                    data: {
                        action: 'tp_dont_show_again',
                        security: tp_wdkit_preview_popup.nonce
                    },
                    success: function (res) {
                        elementor.saver.update.apply().then(function () {
                            window.location.reload();
                        });
                    },
                    error: function (xhr, status, error) {
                        console.log('Response:', xhr.responseText);
                    }
                });
            });

            $(document).on('click', '.tp-wdesign-install', function (e) {
                e.preventDefault();

                var $button = $(this);
                var $loader = $button.find('.tp-wb-loader-circle');
                var $text = $button.find('.theplus-enable-text');

                if ($text.length > 0) {
                    $text.text('Installing WDesignKit');
                } else {
                    var $tp_visitPlugin = $button.find('.tp-visit-plugin');
                    if ($tp_visitPlugin.length > 0) {
                        $tp_visitPlugin.text('Waiting...');
                    }
                }

                $loader.css('display', 'block');

                jQuery.ajax({
                    url: tp_wdkit_preview_popup.ajax_url,
                    dataType: 'json',
                    type: "post",
                    async: true,
                    data: {
                        action: 'tp_install_wdkit',
                        security: tp_wdkit_preview_popup.nonce,
                    },
                    success: function (res) {

                        $loader.css('display', 'none');

                        if (true === res.success) {
                            elementor.saver.update.apply().then(function () {
                                window.location.reload();
                            });

                        } else {
                            $text.text('Enable Templates');
                        }
                    },
                    error: function () {
                        $loader.css('display', 'none');
                        $text.css('display', 'block').text('Enable Templates');
                    }
                });
            });
        });
    });
})(jQuery);