(function ($) {
    jQuery("document").ready(function () {
        jQuery(document).on('click', ".tp-preset-editor-raw", function () {
            var e;
            if (!e) {
                window.tp_preser_editor = elementorCommon.dialogsManager.createWidget("lightbox",
                    {
                        id: "tp-elementor-preset",
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
                            var e = window.tp_preser_editor.getElements("content");
                            window.tpae_PopupToggle.open(e.get(0));
                        },
                        onHide: function () {
                            var e = window.tp_preser_editor.getElements("content");
                            window.tpae_PopupToggle.close(e.get(0));
                            window.tp_preser_editor.destroy();
                        }
                    }
                );
                window.tp_preser_editor.getElements("header").remove();
                window.tp_preser_editor.getElements("message").append(window.tp_preser_editor.addElement("content"));
            }

            return window.tp_preser_editor.show();
        });
    });
})(jQuery);