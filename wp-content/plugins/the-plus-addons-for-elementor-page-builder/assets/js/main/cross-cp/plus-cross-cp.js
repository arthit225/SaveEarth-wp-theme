/*Plus Cross Copy Paste*/ (function () {
    function j(a) {
        return (
            a.forEach(function (a) {
                (a.id = elementorCommon.helpers.getUniqueId()), 0 < a.elements.length && j(a.elements);
            }),
            a
        );
    }
    function f(k, h) {
        var a = h,
            b = h.model.get("elType"),
            c = k.tpelecode.elType,
            d = k.tpelecode,
            e = JSON.stringify(d);
        var f = /\.(jpg|png|jpeg|gif|svg)/gi.test(e),
            g = { elType: c, settings: d.settings },
            l = null,
            m = { index: 0 };
        "section" === c || "container" === c
            ? ((g.elements = j(d.elements)), (l = elementor.getPreviewContainer()))
            : "column" === c
            ? ((g.elements = j(d.elements)),
              "section" === b || "container" === b
                  ? (l = a.getContainer())
                  : "column" === b
                  ? ((l = a.getContainer().parent), (m.index = a.getOption("_index") + 1))
                  : "widget" === b
                  ? ((l = a.getContainer().parent.parent), (m.index = a.getContainer().parent.view.getOption("_index") + 1))
                  : void 0)
            : "widget" === c
            ? ((g.widgetType = k.tpeletype),
              (l = a.getContainer()),
              "section" === b || "container" === b
                  ? (l = a.children.findByIndex(0).getContainer())
                  : "column" === b
                  ? (l = a.getContainer())
                  : "widget" === b
                  ? ((l = a.getContainer().parent), (b.index = a.getOption("_index") + 1), (m.index = a.getOption("_index") + 1))
                  : void 0)
            : void 0;
        var n = $e.run("document/elements/create", { model: g, container: l, options: m });
        f &&
            jQuery.ajax({ url: theplus_cross_cp.ajax_url, method: "POST", data: { nonce: theplus_cross_cp.nonce, action: "plus_cross_cp_import", copy_content: e } }).done(function (a) {
                if (a.success) {
                    var b = a.data[0];
                    (g.elType = b.elType),
                        (g.settings = b.settings),
                        "widget" === g.elType ? (g.widgetType = b.widgetType) : (g.elements = b.elements),
                        $e.run("document/elements/delete", { container: n }),
                        $e.run("document/elements/create", { model: g, container: l, options: m });
                }
            });
    }
    function tpae_isJSON(str) {
		try {
			JSON.parse(str);
			return true;
		} catch (e) {
			return false;
		}
	}
    
    xdLocalStorage.init({ iframeUrl: "https://posimyththemes.com/tpcp/", initCallback: function () {} });
    var g = ["section", "column", "widget", "container"],
        a = [];
    elementor.on("preview:loaded", function () {
        g.forEach(function (b, e) {
            elementor.hooks.addFilter("elements/" + g[e] + "/contextMenuGroups", function (b, h) {
                return (
                    a.push(h),
                    b.push({
                        name: "plus_" + g[e],
                        actions: [
                            {
                                name: "tp_plus_copy",
                                title: "Plus Copy",
                                icon: "eicon-copy",
                                callback: function () {
                                    var b = {};
                                    (b.tpeletype = "widget" == g[e] ? h.model.get("widgetType") : null), (b.tpelecode = h.model.toJSON()), xdLocalStorage.setItem("theplus-c-p-element", JSON.stringify(b)), console.log(b);
                                    var textarea = document.createElement('textarea');
                                    textarea.value = JSON.stringify(b);
                                    document.body.appendChild(textarea);
                                    textarea.select();
                                    document.execCommand('copy');
                                    document.body.removeChild(textarea);
                                },
                            },
                            {
                                name: "tp_plus_paste",
                                title: "Plus Paste",
                                icon: "eicon-import-kit",
                                callback: function () {
                                    if (!navigator.clipboard) {
                                        
                                        var existingDialog = document.getElementById('tpae-paste-area-dialog');
                                        if (existingDialog) {
                                            existingDialog.parentNode.removeChild(existingDialog);
                                        }
                                        
                                        var tpae_paste = document.querySelector('#tpae-paste-area-input');
                                        if (!tpae_paste) {

                                                var container = document.createElement('div'),
                                                    paragraph = document.createElement('p');
                                                paragraph.innerHTML = 'Please grant clipboard permission for smoother copying and pasting.';

                                                var inputArea = document.createElement('input');
                                                    inputArea.id = 'tpae-paste-area-input';
                                                    inputArea.type = 'text';
                                                    inputArea.setAttribute('autocomplete', 'off');
                                                    inputArea.setAttribute('autofocus', 'autofocus');
                                                    inputArea.focus();

                                                    container.appendChild(paragraph);
                                                    container.appendChild(inputArea);
                                
                                            inputArea.addEventListener('paste', async function (event) {
                                                event.preventDefault();
                                                var pastedData = event.clipboardData.getData("text");
                                
                                                if (tpae_isJSON(pastedData)) {
                                                    var checktype = JSON.parse(pastedData);
                                                    if (pastedData && typeof checktype == 'object' && checktype.tpelecode) {
                                                        xdLocalStorage.setItem("theplus-c-p-element", pastedData);
                                                    }
                                                }
                                
                                                xdLocalStorage.getItem('theplus-c-p-element', function (data) {
                                                    if (data && data.value !== undefined && data.value && tpae_isJSON(data.value)) {
                                                        var checktype = JSON.parse(data.value);
                                                        if (typeof checktype == 'object' && checktype.tpelecode) {
                                                            f(checktype, h);
                                                        }
                                                        // xdLocalStorage.removeItem("theplus-c-p-element");
                                                    }
                                                });

                                                var existingDialog = document.getElementById('tpae-paste-area-dialog');
                                                if (existingDialog) {
                                                    existingDialog.parentNode.removeChild(existingDialog);
                                                }
                                            });

                                            let getSystem = '';
                                            if (navigator.userAgent.indexOf('Mac OS X') != -1) {
                                                getSystem = 'Command'
                                            } else {
                                                getSystem = 'Ctrl'
                                            }

                                            var tpDilouge = elementorCommon.dialogsManager.createWidget('lightbox', {
                                                id: 'tpae-paste-area-dialog',
                                                headerMessage: `${getSystem} + V`,
                                                message: container,
                                                position: {
                                                    my: 'center center',
                                                    at: 'center center'
                                                },
                                                onShow: function onShow() {
                                                    inputArea.focus()
                                                    tpDilouge.getElements('widgetContent').on('click', function () {
                                                        inputArea.focus()
                                                    });
                                                },
                                                closeButton: true,
                                                closeButtonOptions: {
                                                    iconClass: 'eicon-close'
                                                },
                                            });
                                
                                            tpDilouge.show();
                                        }
                                    }else{
                                        navigator.clipboard.readText().then(function (pastedData) {
                                            if(tpae_isJSON(pastedData)){
                                                var checktype = JSON.parse(pastedData)
                                                if(pastedData && typeof checktype == 'object' && checktype.tpelecode){
                                                    xdLocalStorage.setItem("theplus-c-p-element", pastedData);
                                                }
                                            }
                                            xdLocalStorage.getItem( 'theplus-c-p-element', function ( data ) {
                                                if(data && data.value!=undefined && data.value && tpae_isJSON(data.value)){
                                                    var checktype = JSON.parse(data.value)
                                                    if(typeof checktype == 'object' && checktype.tpelecode){
                                                        f(checktype, h);
                                                    }
                                                   // xdLocalStorage.removeItem("theplus-c-p-element");
                                                }
                                            });
                                        }).catch(function (err) {
                                            console.error("Error clipboard data: " + err);
                                        });
                                    }
                                },
                            },
                        ],
                    }),
                    b
                );
            });
        });
    });
})(jQuery);