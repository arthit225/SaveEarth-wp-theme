(function ($) {
    "use strict";
    $(document).ready(function () {
        var boardPop = document.querySelector('.tpae-boarding-pop');

        var closePop = (boardPop !== null) ? boardPop.querySelector('.tpae-close-button') : null;
        if (closePop !== null) {
            closePop.addEventListener("click", event => {
                event.preventDefault();

                boardPop.style.display = "none";

                $.ajax({
                    url: theplus_ajax_url,
                    type: "post",
                    data: {
                        action: 'tpae_onbording_close',
                        security: tp_onboarding_vars.nonce,
                    },
                    beforeSend: function () {

                    },
                    success: function (response) {

                    }
                });

            });
        }

        if (boardPop !== null) {
            var proceedBtn = boardPop.querySelector('.tpae-boarding-proceed'),
                backBtn = boardPop.querySelector('.tpae-boarding-back'),
                step1 = boardPop.querySelector(`[data-step="1"]`),
                step7 = boardPop.querySelector(`[data-step="7"]`),
                step8 = boardPop.querySelector(`[data-step="8"]`),
                step6 = boardPop.querySelector(`[data-step="6"]`),
                step5 = boardPop.querySelector(`[data-step="5"]`),
                pagination = boardPop.querySelector('.tpae-pagination'),
                boardProcess = boardPop.querySelector('.tpae-boarding-progress'),
                processWidth = 100 / 8;


            var webcompTypes = boardPop.querySelector('.tpae-select-3');
            var selectWebcomp = webcompTypes.querySelectorAll('.tpae-select-box');
            selectWebcomp.forEach((self) => {
                self.addEventListener("click", event => {
                    event.preventDefault();

                    var allTypes = webcompTypes.querySelectorAll('.tpae-select-box');
                    allTypes.forEach((self) => {
                        if (self.classList.contains('active')) {
                            self.classList.remove('active');
                        }
                    });
                    event.currentTarget.classList.add('active');
                });
            });

            var webTypes = boardPop.querySelector('.tpae-select-8');
            var selectWeb = webTypes.querySelectorAll('.tpae-select-box');
            selectWeb.forEach((self) => {
                self.addEventListener("click", event => {
                    event.preventDefault();

                    var allTypes = webTypes.querySelectorAll('.tpae-select-box');
                    allTypes.forEach((self) => {
                        if (self.classList.contains('active')) {
                            self.classList.remove('active');
                        }
                    });
                    event.currentTarget.classList.add('active');
                });
            });

            proceedBtn.addEventListener("click", event => {
                event.preventDefault();

                var activeSection = boardPop.querySelector('.tpae-on-boarding.active'),
                    getstepVal = activeSection.getAttribute('data-step');
                var nextstepVal = Number(getstepVal) + 1;
                if (nextstepVal <= 8) {
                    var nextSection = boardPop.querySelector(`[data-step="${nextstepVal}"]`);
                    activeSection.classList.remove('active');
                    nextSection.classList.add('active');

                    if (!step1.classList.contains('active')) {
                        backBtn.classList.add('active');
                    }

                    if (step7.classList.contains('active')) {
                        var copyClick = boardPop.querySelector('.code-img');

                        copyClick.addEventListener("click", e => {
                            e.preventDefault();
                            let copytxtDiv = boardPop.querySelector('.offer-code');

                            if (copytxtDiv) {
                                var textarea = document.createElement('textarea');
                                textarea.value = copytxtDiv.textContent;

                                document.body.appendChild(textarea);
                                textarea.select();

                                try {
                                    document.execCommand('copy');
                                    console.log('Code copied to clipboard');
                                } catch (err) {
                                    console.error('Unable to copy code to clipboard', err);
                                } finally {
                                    document.body.removeChild(textarea);
                                }
                            } else {
                                console.log('Text to copy is empty');
                            }
                        });
                    }



                    // Send Email
                    if (step6.classList.contains('active')) {
                        tpae_send_mail();
                    }

                    // Store Onboarding Data
                    if (step8.classList.contains('active')) {
                        event.stopPropagation();
                        proceedBtn.innerHTML = "Visit Dashboard";
                        proceedBtn.classList.add('tpae-onbor-last')

                        var getdetBtn = boardPop.querySelector('.tpae-show-details');
                        if (getdetBtn != null) {
                            getdetBtn.addEventListener("click", function () {
                                var getdeDiv = this.parentNode.parentNode.querySelector('.tpae-details');

                                if (getdeDiv.classList.contains('show')) {
                                    getdeDiv.classList.remove("show");
                                } else {
                                    getdeDiv.classList.add("show");
                                }
                            })
                        }

                        if (nextstepVal === 8) {
                            tpae_boarding_store(selectWebcomp, selectWeb, step8, nextstepVal);
                        }
                    }
                    // Install Nexter Theme
                    if (step5.classList.contains('active')) {
                        tpae_add_nexter(proceedBtn);
                    }
                    progessBar(nextstepVal);
                }
            });

            backBtn.addEventListener("click", event => {
                event.preventDefault();

                var activeSection = boardPop.querySelector('.tpae-on-boarding.active'),
                    getstepVal = activeSection.getAttribute('data-step');
                var nextstepVal = Number(getstepVal) - 1;
                var prevSection = boardPop.querySelector(`[data-step="${nextstepVal}"]`),
                    getdetBtn = boardPop.querySelector('.tpae-show-details');
                activeSection.classList.remove('active');
                prevSection.classList.add('active');

                if (step1.classList.contains('active')) {
                    backBtn.classList.remove('active');
                }
                if (!step8.classList.contains('active')) {
                    proceedBtn.innerHTML = "Proceed";
                }
                if (proceedBtn.classList.contains('tpae-onbor-last')) {
                    proceedBtn.onclick = '';
                    proceedBtn.classList.remove('tpae-onbor-last');
                }

                if (getdetBtn.parentNode.parentNode.querySelector('.tpae-details').classList.contains('show')) {
                    getdetBtn.parentNode.parentNode.querySelector('.tpae-details').classList.remove("show");
                }
                progessBar(nextstepVal);
            });

            function progessBar(nextstepVal) {
                var progress = processWidth * nextstepVal;
                boardProcess.style.width = progress + '%';
                pagination.innerHTML = `${nextstepVal}/8`;
            }

            // Stey Update Email
            function tpae_send_mail() {
                var tpaeSendEmail = document.querySelector('.tpae-submit-btn');
                tpaeSendEmail.addEventListener('click', event => {
                    event.preventDefault();
                    var tpaeoName = document.querySelector('#tpae-onb-name'),
                        tpaeoEmail = document.querySelector('#tpae-onb-email'),
                        errorDiv = document.querySelector('.tpae-input-note');

                    if (tpaeoName && tpaeoName.value == '') {
                        tpae_on_validation(errorDiv, 'Name field is required.')
                    } else {
                        if (tpaeoEmail && tpaeoEmail.value != '') {
                            const validateEmail = (email) => {
                                return email.match(
                                    /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
                                );
                            };
                            if (validateEmail(tpaeoEmail.value)) {
                                const webhookBody = {
                                    full_name: tpaeoName.value,
                                    email: tpaeoEmail.value,
                                };

                                const welcomeEmailUrl = 'https://store.posimyth.com/?fluentcrm=1&route=contact&hash=de4217f1-9860-4d25-9bee-5a75e132aafc';
                                fetch(welcomeEmailUrl, {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'Access-Control-Allow-Origin': 'http://localhost/',
                                    },
                                    mode: 'no-cors',
                                    body: JSON.stringify(webhookBody),
                                }).then((response) => {
                                    if (response) {
                                        tpae_on_validation(errorDiv, 'Successfully send mail.')
                                    } else {
                                        tpae_on_validation(errorDiv, 'There was an error! Try again later!')
                                    }
                                });

                            } else {
                                tpae_on_validation(errorDiv, 'Invalid email. Double-check your entry.')
                            }
                        } else {
                            tpae_on_validation(errorDiv, 'Please Enter a Valid Email Address.')
                        }
                    }
                })
            }

            // Form Field Vaildation
            function tpae_on_validation(selector, msg) {
                selector.innerHTML = msg;
                jQuery(selector).slideDown()

                setTimeout(function () {
                    jQuery(selector).slideUp()
                }, 5000);
            }

            // Store On Borading Data in DB

            function tpae_boarding_store(select1, select2, stepno, current) {

                if (current === 8) {
                    var onDonebtn = document.querySelector('.tpae-onbor-last'),
                        tpae_ondata = document.getElementById('tpae_ondata');
                    if (onDonebtn != null) {
                        onDonebtn.onclick = function (event) {
                            event.preventDefault();
                            var tpaeonData = { 
                                tpae_web_com: '', 
                                tpae_web_Type: '', 
                                tpae_get_data: false, 
                                tpae_onboarding: false 
                            };

                            let checkbox_val = tpae_ondata.checked

                            select1.forEach((obj) => {
                                if (obj.classList.contains('active')) {
                                    let webCom = obj.querySelector('.select-title')
                                    tpaeonData['tpae_web_com'] = webCom.innerHTML;
                                }
                            });

                            select2.forEach((obj) => {
                                if (obj.classList.contains('active')) {
                                    let webtype = obj.querySelector('.select-title')
                                    tpaeonData['tpae_web_Type'] = webtype.innerHTML;
                                }
                            });

                            if (tpae_ondata) {
                                tpaeonData['tpae_get_data'] = checkbox_val;
                            }

                            if (tpaeonData) {
                                tpaeonData['tpae_onboarding'] = true;
                                $.ajax({
                                    url: theplus_ajax_url,
                                    type: "post",
                                    data: {
                                        action: 'tpae_boarding_store',
                                        boardingData: tpaeonData,
                                        security: tp_onboarding_vars.nonce,
                                    },
                                    beforeSend: function () {
                                        onDonebtn.disabled = true;
                                    },
                                    success: function (response) {
                                        document.querySelector('.tpae-boarding-pop').style.display = "none";
                                    },
                                    error: function (xhr, status, error) {
                                        document.querySelector('.tpae-boarding-pop').style.display = "none";
                                    },
                                });
                            }
                        }
                    }
                }
            }

            // Install & Active Nexter Theme
            function tpae_add_nexter(btnscope) {

                let addnxt = document.getElementById('in-nexter'),
                    loder = document.querySelector('.tpae-nxt-load'),
                    notice = document.querySelector('.tpae-wrong-msg-notice');

                addnxt.addEventListener("change", function () {
                    if (this.checked) {
                        btnscope.setAttribute('disabled', true)

                        $.ajax({
                            url: theplus_ajax_url,
                            type: "post",

                            data: {
                                action: 'tpae_install_nexter',
                                security: tp_onboarding_vars.nonce,
                            },
                            beforeSend: function () {

                                loder.style.display = 'flex';
                            },
                            success: function (response) {

                                loder.style.display = 'none';

                                if (response.nexter) {
                                   
                                    setTimeout(function () {
                                        notice.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"  viewBox="0 0 512 512"><path fill="#27ae60" d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM369 209L241 337c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L335 175c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z"/></svg>' + response.message;
                                        notice.classList.add('active');
                                    }, 50);
                                } else {

                                    setTimeout(function () {
                                        notice.innerHTML = '<svg width="20" height="20" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="16" cy="16" r="15.75" stroke="#FC4032" stroke-width="0.5"></circle><circle cx="16" cy="16" r="12" fill="#FC4032"></circle><rect x="15" y="9" width="2" height="10" rx="1" fill="white"></rect><rect x="15" y="20" width="2" height="2" rx="1" fill="white"></rect></svg>' + response.message;
                                        notice.classList.add('active');
                                    }, 50);
                                }
                                setTimeout(function () {
                                    notice.remove();
                                }, 3500);

                                btnscope.removeAttribute('disabled')
                            }
                        });

                    } else {
                        btnscope.removeAttribute('disabled')
                    }
                })
            }

        }

    });

})(window.jQuery);

var slidePage = 1;
setTimeout(() => {
    tp_showDivs(slidePage);
}, 1000);

function tp_plusPage(n) {
    tp_showDivs(slidePage += n);
}

function tp_currentPage(n) {
    tp_showDivs(slidePage = n);
}

function tp_showDivs(slidePage) {
    var i;
    var tpOnbordDetails = document.querySelectorAll(".tpae-onboarding-details.slider");
    var sliderDots = document.querySelector('.tpae-slider-btns');
    var dots = (sliderDots != null) ? sliderDots.querySelectorAll(".tpae-slider-btn") : '';

    if (slidePage > tpOnbordDetails.length) {
        slidePage = 1;
    }
    if (slidePage < 1) {
        slidePage = tpOnbordDetails.length;
    }
    for (i = 0; i < tpOnbordDetails.length; i++) {
        tpOnbordDetails[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }

    if (tpOnbordDetails[slidePage - 1] != null) {
        tpOnbordDetails[slidePage - 1].style.display = "block";
    }
    if (dots[slidePage - 1] != null) {
        dots[slidePage - 1].className += " active";
    }
}