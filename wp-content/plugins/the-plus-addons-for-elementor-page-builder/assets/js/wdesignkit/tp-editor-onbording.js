(function ($) {

    $("document").ready(function () {
        elementor.on("preview:loaded", function () {
            window.tp_onbording_editor = elementorCommon.dialogsManager.createWidget(
                "lightbox",
                {
                    id: "tp-onbording-elementorp",
                    headerMessage: !1,
                    message: "",
                    hide: {
                        auto: !1,
                        onClick: !1,
                        onOutsideClick: false,
                        onOutsideContextMenu: !1,
                        onBackgroundClick: !1,
                    },
                    position: {
                        my: "center",
                        at: "center",
                    },
                    onShow: function () {
                        var dialogLightboxContent = $(".dialog-lightbox-message"),
                            clonedWrapElement = $("#tp-onbording-wrap");

                        clonedWrapElement = clonedWrapElement.clone(true).show()
                        dialogLightboxContent.html(clonedWrapElement);
                    },
                    onHide: function () {
                        window.tp_onbording_editor.destroy();
                    }
                }
            );
            window.tp_onbording_editor.show();
        });

        $(document).on('click', '.tp-skip-button', function (e) {
            e.preventDefault();

            $.ajax({
                url: tp_editor_onbording_popup.ajax_url,
                dataType: 'json',
                type: "POST",
                async: true,
                data: {
                    action: 'tp_onbording_skip',
                    security: tp_editor_onbording_popup.nonce
                },
                success: function (res) {
                    window.tp_onbording_editor.destroy();
                },
                error: function (xhr, status, error) {
                    console.log('Response:', xhr.responseText);
                }
            });
        });

        $(document).on('click', '.tp-do-it-button', function (e) {
            e.preventDefault();

            $.ajax({
                url: tp_editor_onbording_popup.ajax_url,
                dataType: 'json',
                type: "POST",
                async: true,
                data: {
                    action: 'tp_open_preview_popup',
                    security: tp_editor_onbording_popup.nonce
                },
                success: function (res) {
                    window.tp_onbording_editor.hide();

                    if( res.preview_popup ){
                        window.tp_wdkit_editor.show();
                    }

                    if ( res.wdkit_popup ){
                        jQuery(elementor.$previewContents[0].body).find(".elementor-action-wdkit-button").trigger("click");
                    }
                },
                error: function (xhr, status, error) {
                    console.log('Response:', xhr.responseText);
                }
            });
        });

    });
})(jQuery);