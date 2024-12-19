/*! TPAE Free - v5.3.3*/
(function ($) {
  'use strict';

  var TheplusAdminDialog = {
    cacheElements: function cacheElements() {
      this.cache = {
        $deactivateLink: $('#the-list').find('[data-slug="the-plus-addons-for-elementor-page-builder"] span.deactivate a'),
        $dialogHeader: $('#tp-feedback-dialog-header'),
        $dialogForm: $('#tp-feedback-dialog-form')
      };
    },
    bindEvents: function bindEvents() {
      var self = this;
          self.cache.$deactivateLink.on('click', function (event) {
            event.preventDefault();

            self.getModal().show();
          });
    },
    deactivate: function deactivate() {
      location.href = this.cache.$deactivateLink.attr('href');
    },
    initModal: function initModal() {
      var self = this, modal;

          self.getModal = function () {
            if (!modal) {
              modal = elementorCommon.dialogsManager.createWidget('lightbox', {
                id: 'tp-deactivate-feedback-modal',
                headerMessage: self.cache.$dialogHeader,
                message: self.cache.$dialogForm,
                hide: {
                  onButtonClick: false
                },
                position: {
                  my: 'center',
                  at: 'center'
                },
                onReady: function onReady() {
                  DialogsManager.getWidgetType('lightbox').prototype.onReady.apply(this, arguments);

                  this.addButton({
                    name: 'submit',
                    text: 'Submit & Deactivate',
                    callback: self.sendFeedback.bind(self)
                  });

                  this.addButton({
                    name: 'skip',
                    text: 'Skip & Deactivate',
                    callback: self.skipFeedback.bind(self)
                  });
                },
                onShow: function onShow() {
                  var $dialogModal = $('#tp-deactivate-feedback-modal'),
                      radioSelector = '.tp-deactivate-feedback-dialog-input';

                      $dialogModal.find(radioSelector).on('change', function () {
                        $dialogModal.attr('data-feedback-selected', $(this).val());
                      });

                      $dialogModal.find(radioSelector + ':checked').trigger('change');
                }
              });
            }

            return modal;
          };
    },
    sendFeedback: function sendFeedback() {
      var self = this,
          formData = self.cache.$dialogForm.serialize();

      var urlEncodedString = formData;
      var queryString = decodeURIComponent(urlEncodedString);
      var formData = new URLSearchParams(queryString);

      var reason_key = formData.get('reason_key');
        if( !reason_key ){
          return;
        }

      self.getModal().getElements('submit').text('').addClass('tp-loading');

      jQuery.ajax({
        url: theplus_ajax_url,
        type: "post",
        data: {
          action: 'tp_deactivate_rateus_notice',
          site_url: formData.get('site_url'),
          reason_key: reason_key,
          reason_tp_found_a_better_plugin: formData.get('reason_tp_found_a_better_plugin'),
          reason_tp_other: formData.get('reason_tp_other'),
          cur_datetime: formData.get('cur_datetime'),
          user_email: formData.get('user_email'),
          tpae_version: formData.get('tpae_version'),
          nonce: formData.get('nonce'),
        },
        beforeSend: function () {
        },
        success: function (response) {
          location.href = $('#the-list').find('[data-slug="the-plus-addons-for-elementor-page-builder"] span.deactivate a').attr('href')
        },
        error: function(xhr, status, error) {
          location.href = $('#the-list').find('[data-slug="the-plus-addons-for-elementor-page-builder"] span.deactivate a').attr('href')
        }
      });
    },
    skipFeedback: function skipFeedback() {
      var self = this,
          formData = self.cache.$dialogForm.serialize(),
          queryParams = new URLSearchParams(formData);

          jQuery.ajax({
            url: theplus_ajax_url,
            type: "post",
            data: {
              action: 'tp_skip_rateus_notice',
              nonce: queryParams.get('nonce'),
            },
            beforeSend: function () {
            },
            success: function (response) {
              location.href = $('#the-list').find('[data-slug="the-plus-addons-for-elementor-page-builder"] span.deactivate a').attr('href')
            },
            error: function (xhr, status, error) {
              location.href = $('#the-list').find('[data-slug="the-plus-addons-for-elementor-page-builder"] span.deactivate a').attr('href')
            }
          });
    },
    init: function init() {
      this.initModal();
      this.cacheElements();
      this.bindEvents();
    }
  };

  $(function () {
    TheplusAdminDialog.init();
  });

})(jQuery);