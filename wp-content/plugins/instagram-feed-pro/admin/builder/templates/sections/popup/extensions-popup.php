<div class="sbi-fb-extensions-pp-ctn sb-fs-boss sbi-fb-center-boss" v-if="viewsActive.extensionsPopupElement != null && viewsActive.extensionsPopupElement != false">
	<div class="sbi-fb-extensions-popup sbi-fb-popup-inside" v-if="viewsActive.extensionsPopupElement != null && viewsActive.extensionsPopupElement != false" :data-getext-view="viewsActive.extensionsPopupElement">

        <div class="sbi-fb-popup-cls" @click.prevent.default="activateView('extensionsPopupElement')">
            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M14 1.41L12.59 0L7 5.59L1.41 0L0 1.41L5.59 7L0 12.59L1.41 14L7 8.41L12.59 14L14 12.59L8.41 7L14 1.41Z" fill="#141B38"/>
            </svg>
        </div>
        <div>
            <div class="sbi-fb-extpp-top sbi-fb-fs">
                <div class="sbi-fb-extpp-info">
                    <div class="sbi-extpp-license-notice sbi-fb-fs" v-if="sbiLicenseNoticeActive">
                        <span v-html="genericText.licenseInactive" v-if="sbiLicenseInactiveState"></span>
                        <span v-html="genericText.licenseExpired"  v-if="!sbiLicenseInactiveState"></span>
                    </div>
                    <div class="sbi-fb-extpp-head sbi-fb-fs"><h2 v-html="extensionsPopup[viewsActive.extensionsPopupElement].heading"></h2></div>
                    <div class="sbi-fb-extpp-desc sbi-fb-fs sb-caption" v-html="extensionsPopup[viewsActive.extensionsPopupElement].description"></div>
                    <div v-if="extensionsPopup[viewsActive.extensionsPopupElement].popupContentBtn && !sbiLicenseNoticeActive" v-html="extensionsPopup[viewsActive.extensionsPopupElement].popupContentBtn" class="sbi-fb-fs"></div>
                </div>
                <div class="sbi-fb-extpp-img" v-html="extensionsPopup[viewsActive.extensionsPopupElement].img">
                </div>
            </div>
            <div class="sbi-fb-extpp-bottom sbi-fb-fs">
                <div v-if="typeof extensionsPopup[viewsActive.extensionsPopupElement].bullets !== 'undefined'" class="sbi-extension-bullets">
                    <h4>{{extensionsPopup[viewsActive.extensionsPopupElement].bullets.heading}}</h4>
                    <div class="sbi-extension-bullet-list">
                        <div class="sbi-extension-single-bullet" v-for="bullet in extensionsPopup[viewsActive.extensionsPopupElement].bullets.content">
                            <svg width="4" height="4" viewBox="0 0 4 4" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect width="4" height="4" fill="#0096CC"/>
                            </svg>
                            <span class="sb-small-p">{{bullet}}</span>
                        </div>
                    </div>
                </div>
                <div class="sbi-fb-extpp-btns sbi-fb-fs" :class="{'sbi-popup-single-btn' : !extensionsPopup[viewsActive.extensionsPopupElement].demoUrl}">
                    <a class="sbi-fb-extpp-get-btn sbi-btn-orange" :href="extensionsPopup[viewsActive.extensionsPopupElement].buyUrl" target="_blank" class="sbi-fb-fs-link">
                        {{ sbiLicenseInactiveState ? genericText.activateLicense : sbiLicenseNoticeActive ? genericText.renew : genericText.upgrade}}
                    </a>
                    <a class="sbi-fb-extpp-get-btn sbi-btn-grey" :href="extensionsPopup[viewsActive.extensionsPopupElement].demoUrl" v-if="extensionsPopup[viewsActive.extensionsPopupElement].demoUrl" target="_blank" class="sbi-fb-fs-link">{{genericText.viewDemo}}</a>
                </div>
            </div>
        </div>
	</div>
</div>