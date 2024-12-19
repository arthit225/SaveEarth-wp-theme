(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);throw new Error("Cannot find module '"+o+"'")}var f=n[o]={exports:{}};t[o][0].call(f.exports,function(e){var n=t[o][1][e];return s(n?n:e)},f,f.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
"use strict";

/* global wpforms_gutenberg_form_selector, JSX */
/* jshint es3: false, esversion: 6 */

/**
 * @param strings.update_wp_notice_head
 * @param strings.update_wp_notice_text
 * @param strings.update_wp_notice_link
 * @param strings.wpforms_empty_help
 * @param strings.wpforms_empty_info
 */

var _wp = wp,
  _wp$serverSideRender = _wp.serverSideRender,
  ServerSideRender = _wp$serverSideRender === void 0 ? wp.components.ServerSideRender : _wp$serverSideRender;
var _wp$element = wp.element,
  createElement = _wp$element.createElement,
  Fragment = _wp$element.Fragment;
var registerBlockType = wp.blocks.registerBlockType;
var _ref = wp.blockEditor || wp.editor,
  InspectorControls = _ref.InspectorControls;
var _wp$components = wp.components,
  SelectControl = _wp$components.SelectControl,
  ToggleControl = _wp$components.ToggleControl,
  PanelBody = _wp$components.PanelBody,
  Placeholder = _wp$components.Placeholder;
var __ = wp.i18n.__;
var wpformsIcon = createElement('svg', {
  width: 20,
  height: 20,
  viewBox: '0 0 612 612',
  className: 'dashicon'
}, createElement('path', {
  fill: 'currentColor',
  d: 'M544,0H68C30.445,0,0,30.445,0,68v476c0,37.556,30.445,68,68,68h476c37.556,0,68-30.444,68-68V68 C612,30.445,581.556,0,544,0z M464.44,68L387.6,120.02L323.34,68H464.44z M288.66,68l-64.26,52.02L147.56,68H288.66z M544,544H68 V68h22.1l136,92.14l79.9-64.6l79.56,64.6l136-92.14H544V544z M114.24,263.16h95.88v-48.28h-95.88V263.16z M114.24,360.4h95.88 v-48.62h-95.88V360.4z M242.76,360.4h255v-48.62h-255V360.4L242.76,360.4z M242.76,263.16h255v-48.28h-255V263.16L242.76,263.16z M368.22,457.3h129.54V408H368.22V457.3z'
}));

/**
 * Popup container.
 *
 * @since 1.8.3
 *
 * @type {Object}
 */
var $popup = {};

/**
 * Close button (inside the form builder) click event.
 *
 * @since 1.8.3
 *
 * @param {string} clientID Block Client ID.
 */
var builderCloseButtonEvent = function builderCloseButtonEvent(clientID) {
  $popup.off('wpformsBuilderInPopupClose').on('wpformsBuilderInPopupClose', function (e, action, formId, formTitle) {
    if (action !== 'saved' || !formId) {
      return;
    }

    // Insert a new block when a new form is created from the popup to update the form list and attributes.
    var newBlock = wp.blocks.createBlock('wpforms/form-selector', {
      formId: formId.toString() // Expects string value, make sure we insert string.
    });

    // eslint-disable-next-line camelcase
    wpforms_gutenberg_form_selector.forms = [{
      ID: formId,
      post_title: formTitle
    }];

    // Insert a new block.
    wp.data.dispatch('core/block-editor').removeBlock(clientID);
    wp.data.dispatch('core/block-editor').insertBlocks(newBlock);
  });
};

/**
 * Init Modern style Dropdown fields (<select>) with choiceJS.
 *
 * @since 1.9.0
 *
 * @param {Object} e Block Details.
 */
var loadChoiceJS = function loadChoiceJS(e) {
  if (typeof window.Choices !== 'function') {
    return;
  }
  var $form = jQuery(e.detail.block.querySelector("#wpforms-".concat(e.detail.formId)));
  var config = window.wpforms_choicesjs_config || {};
  $form.find('.choicesjs-select').each(function (index, element) {
    if (!(element instanceof HTMLSelectElement)) {
      return;
    }
    var $el = jQuery(element);
    if ($el.data('choicesjs')) {
      return;
    }
    var $field = $el.closest('.wpforms-field');
    config.callbackOnInit = function () {
      var self = this,
        $element = jQuery(self.passedElement.element),
        $input = jQuery(self.input.element),
        sizeClass = $element.data('size-class');

      // Add CSS-class for size.
      if (sizeClass) {
        jQuery(self.containerOuter.element).addClass(sizeClass);
      }

      /**
       * If a multiple select has selected choices - hide a placeholder text.
       * In case if select is empty - we return placeholder text.
       */
      if ($element.prop('multiple')) {
        // On init event.
        $input.data('placeholder', $input.attr('placeholder'));
        if (self.getValue(true).length) {
          $input.removeAttr('placeholder');
        }
      }
      this.disable();
      $field.find('.is-disabled').removeClass('is-disabled');
    };
    $el.data('choicesjs', new window.Choices(element, config));

    // Placeholder fix on iframes.
    if ($el.val()) {
      $el.parent().find('.choices__input').attr('style', 'display: none !important');
    }
  });
};

// on document ready
jQuery(function () {
  jQuery(window).on('wpformsFormSelectorFormLoaded', loadChoiceJS);
});
/**
 * Open builder popup.
 *
 * @since 1.6.2
 *
 * @param {string} clientID Block Client ID.
 */
var openBuilderPopup = function openBuilderPopup(clientID) {
  if (jQuery.isEmptyObject($popup)) {
    var tmpl = jQuery('#wpforms-gutenberg-popup');
    var parent = jQuery('#wpwrap');
    parent.after(tmpl);
    $popup = parent.siblings('#wpforms-gutenberg-popup');
  }
  var url = wpforms_gutenberg_form_selector.get_started_url,
    $iframe = $popup.find('iframe');
  builderCloseButtonEvent(clientID);
  $iframe.attr('src', url);
  $popup.fadeIn();
};
var hasForms = function hasForms() {
  return wpforms_gutenberg_form_selector.forms.length > 0;
};
registerBlockType('wpforms/form-selector', {
  title: wpforms_gutenberg_form_selector.strings.title,
  description: wpforms_gutenberg_form_selector.strings.description,
  icon: wpformsIcon,
  keywords: wpforms_gutenberg_form_selector.strings.form_keywords,
  category: 'widgets',
  attributes: {
    formId: {
      type: 'string'
    },
    displayTitle: {
      type: 'boolean'
    },
    displayDesc: {
      type: 'boolean'
    },
    preview: {
      type: 'boolean'
    }
  },
  example: {
    attributes: {
      preview: true
    }
  },
  supports: {
    customClassName: hasForms()
  },
  edit: function edit(props) {
    // eslint-disable-line max-lines-per-function
    var _props$attributes = props.attributes,
      _props$attributes$for = _props$attributes.formId,
      formId = _props$attributes$for === void 0 ? '' : _props$attributes$for,
      _props$attributes$dis = _props$attributes.displayTitle,
      displayTitle = _props$attributes$dis === void 0 ? false : _props$attributes$dis,
      _props$attributes$dis2 = _props$attributes.displayDesc,
      displayDesc = _props$attributes$dis2 === void 0 ? false : _props$attributes$dis2,
      _props$attributes$pre = _props$attributes.preview,
      preview = _props$attributes$pre === void 0 ? false : _props$attributes$pre,
      setAttributes = props.setAttributes;
    var formOptions = wpforms_gutenberg_form_selector.forms.map(function (value) {
      return {
        value: value.ID,
        label: value.post_title
      };
    });
    var strings = wpforms_gutenberg_form_selector.strings;
    var jsx;
    formOptions.unshift({
      value: '',
      label: wpforms_gutenberg_form_selector.strings.form_select
    });
    function selectForm(value) {
      // eslint-disable-line jsdoc/require-jsdoc
      setAttributes({
        formId: value
      });
    }
    function toggleDisplayTitle(value) {
      // eslint-disable-line jsdoc/require-jsdoc
      setAttributes({
        displayTitle: value
      });
    }
    function toggleDisplayDesc(value) {
      // eslint-disable-line jsdoc/require-jsdoc
      setAttributes({
        displayDesc: value
      });
    }

    /**
     * Get block empty JSX code.
     *
     * @since 1.8.3
     *
     * @param {Object} blockProps Block properties.
     *
     * @return {JSX.Element} Block empty JSX code.
     */
    function getEmptyFormsPreview(blockProps) {
      var clientId = blockProps.clientId;
      return /*#__PURE__*/React.createElement(Fragment, {
        key: "wpforms-gutenberg-form-selector-fragment-block-empty"
      }, /*#__PURE__*/React.createElement("div", {
        className: "wpforms-no-form-preview"
      }, /*#__PURE__*/React.createElement("img", {
        src: wpforms_gutenberg_form_selector.block_empty_url,
        alt: ""
      }), /*#__PURE__*/React.createElement("p", {
        dangerouslySetInnerHTML: {
          __html: strings.wpforms_empty_info
        }
      }), /*#__PURE__*/React.createElement("button", {
        type: "button",
        className: "get-started-button components-button is-button is-primary",
        onClick: function onClick() {
          openBuilderPopup(clientId);
        }
      }, __('Get Started', 'wpforms-lite')), /*#__PURE__*/React.createElement("p", {
        className: "empty-desc",
        dangerouslySetInnerHTML: {
          __html: strings.wpforms_empty_help
        }
      }), /*#__PURE__*/React.createElement("div", {
        id: "wpforms-gutenberg-popup",
        className: "wpforms-builder-popup"
      }, /*#__PURE__*/React.createElement("iframe", {
        src: "about:blank",
        width: "100%",
        height: "100%",
        id: "wpforms-builder-iframe",
        title: "wpforms-gutenberg-popup"
      }))));
    }

    /**
     * Print empty forms notice.
     *
     * @since 1.8.3
     *
     * @param {string} clientId Block client ID.
     *
     * @return {JSX.Element} Field styles JSX code.
     */
    function printEmptyFormsNotice(clientId) {
      return /*#__PURE__*/React.createElement(InspectorControls, {
        key: "wpforms-gutenberg-form-selector-inspector-main-settings"
      }, /*#__PURE__*/React.createElement(PanelBody, {
        className: "wpforms-gutenberg-panel",
        title: strings.form_settings
      }, /*#__PURE__*/React.createElement("p", {
        className: "wpforms-gutenberg-panel-notice wpforms-warning wpforms-empty-form-notice",
        style: {
          display: 'block'
        }
      }, /*#__PURE__*/React.createElement("strong", null, __('You haven’t created a form, yet!', 'wpforms-lite')), __('What are you waiting for?', 'wpforms-lite')), /*#__PURE__*/React.createElement("button", {
        type: "button",
        className: "get-started-button components-button is-button is-secondary",
        onClick: function onClick() {
          openBuilderPopup(clientId);
        }
      }, __('Get Started', 'wpforms-lite'))));
    }

    /**
     * Get styling panels preview.
     *
     * @since 1.8.8
     *
     * @return {JSX.Element} JSX code.
     */
    function getStylingPanelsPreview() {
      return /*#__PURE__*/React.createElement(Fragment, null, /*#__PURE__*/React.createElement(PanelBody, {
        className: "wpforms-gutenberg-panel disabled_panel",
        title: strings.themes
      }, /*#__PURE__*/React.createElement("div", {
        className: "wpforms-panel-preview wpforms-panel-preview-themes"
      })), /*#__PURE__*/React.createElement(PanelBody, {
        className: "wpforms-gutenberg-panel disabled_panel",
        title: strings.field_styles
      }, /*#__PURE__*/React.createElement("div", {
        className: "wpforms-panel-preview wpforms-panel-preview-field"
      })), /*#__PURE__*/React.createElement(PanelBody, {
        className: "wpforms-gutenberg-panel disabled_panel",
        title: strings.label_styles
      }, /*#__PURE__*/React.createElement("div", {
        className: "wpforms-panel-preview wpforms-panel-preview-label"
      })), /*#__PURE__*/React.createElement(PanelBody, {
        className: "wpforms-gutenberg-panel disabled_panel",
        title: strings.button_styles
      }, /*#__PURE__*/React.createElement("div", {
        className: "wpforms-panel-preview wpforms-panel-preview-button"
      })), /*#__PURE__*/React.createElement(PanelBody, {
        className: "wpforms-gutenberg-panel disabled_panel",
        title: strings.container_styles
      }, /*#__PURE__*/React.createElement("div", {
        className: "wpforms-panel-preview wpforms-panel-preview-container"
      })), /*#__PURE__*/React.createElement(PanelBody, {
        className: "wpforms-gutenberg-panel disabled_panel",
        title: strings.background_styles
      }, /*#__PURE__*/React.createElement("div", {
        className: "wpforms-panel-preview wpforms-panel-preview-background"
      })));
    }
    if (!hasForms()) {
      jsx = [printEmptyFormsNotice(props.clientId)];
      jsx.push(getEmptyFormsPreview(props));
      return jsx;
    }
    jsx = [/*#__PURE__*/React.createElement(InspectorControls, {
      key: "wpforms-gutenberg-form-selector-inspector-controls"
    }, /*#__PURE__*/React.createElement(PanelBody, {
      title: wpforms_gutenberg_form_selector.strings.form_settings
    }, /*#__PURE__*/React.createElement(SelectControl, {
      label: wpforms_gutenberg_form_selector.strings.form_selected,
      value: formId,
      options: formOptions,
      onChange: selectForm
    }), /*#__PURE__*/React.createElement(ToggleControl, {
      label: wpforms_gutenberg_form_selector.strings.show_title,
      checked: displayTitle,
      onChange: toggleDisplayTitle
    }), /*#__PURE__*/React.createElement(ToggleControl, {
      label: wpforms_gutenberg_form_selector.strings.show_description,
      checked: displayDesc,
      onChange: toggleDisplayDesc
    }), /*#__PURE__*/React.createElement("p", {
      className: "wpforms-gutenberg-panel-notice wpforms-warning"
    }, /*#__PURE__*/React.createElement("strong", null, strings.update_wp_notice_head), strings.update_wp_notice_text, " ", /*#__PURE__*/React.createElement("a", {
      href: strings.update_wp_notice_link,
      rel: "noreferrer",
      target: "_blank"
    }, strings.learn_more))), getStylingPanelsPreview())];
    if (formId) {
      jsx.push( /*#__PURE__*/React.createElement(ServerSideRender, {
        key: "wpforms-gutenberg-form-selector-server-side-renderer",
        block: "wpforms/form-selector",
        attributes: props.attributes
      }));
    } else if (preview) {
      jsx.push( /*#__PURE__*/React.createElement(Fragment, {
        key: "wpforms-gutenberg-form-selector-fragment-block-preview"
      }, /*#__PURE__*/React.createElement("img", {
        src: wpforms_gutenberg_form_selector.block_preview_url,
        style: {
          width: '100%'
        },
        alt: ""
      })));
    } else {
      jsx.push( /*#__PURE__*/React.createElement(Placeholder, {
        key: "wpforms-gutenberg-form-selector-wrap",
        className: "wpforms-gutenberg-form-selector-wrap"
      }, /*#__PURE__*/React.createElement("img", {
        src: wpforms_gutenberg_form_selector.logo_url,
        alt: ""
      }), /*#__PURE__*/React.createElement(SelectControl, {
        key: "wpforms-gutenberg-form-selector-select-control",
        value: formId,
        options: formOptions,
        onChange: selectForm
      })));
    }
    return jsx;
  },
  save: function save() {
    return null;
  }
});
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJuYW1lcyI6WyJfd3AiLCJ3cCIsIl93cCRzZXJ2ZXJTaWRlUmVuZGVyIiwic2VydmVyU2lkZVJlbmRlciIsIlNlcnZlclNpZGVSZW5kZXIiLCJjb21wb25lbnRzIiwiX3dwJGVsZW1lbnQiLCJlbGVtZW50IiwiY3JlYXRlRWxlbWVudCIsIkZyYWdtZW50IiwicmVnaXN0ZXJCbG9ja1R5cGUiLCJibG9ja3MiLCJfcmVmIiwiYmxvY2tFZGl0b3IiLCJlZGl0b3IiLCJJbnNwZWN0b3JDb250cm9scyIsIl93cCRjb21wb25lbnRzIiwiU2VsZWN0Q29udHJvbCIsIlRvZ2dsZUNvbnRyb2wiLCJQYW5lbEJvZHkiLCJQbGFjZWhvbGRlciIsIl9fIiwiaTE4biIsIndwZm9ybXNJY29uIiwid2lkdGgiLCJoZWlnaHQiLCJ2aWV3Qm94IiwiY2xhc3NOYW1lIiwiZmlsbCIsImQiLCIkcG9wdXAiLCJidWlsZGVyQ2xvc2VCdXR0b25FdmVudCIsImNsaWVudElEIiwib2ZmIiwib24iLCJlIiwiYWN0aW9uIiwiZm9ybUlkIiwiZm9ybVRpdGxlIiwibmV3QmxvY2siLCJjcmVhdGVCbG9jayIsInRvU3RyaW5nIiwid3Bmb3Jtc19ndXRlbmJlcmdfZm9ybV9zZWxlY3RvciIsImZvcm1zIiwiSUQiLCJwb3N0X3RpdGxlIiwiZGF0YSIsImRpc3BhdGNoIiwicmVtb3ZlQmxvY2siLCJpbnNlcnRCbG9ja3MiLCJsb2FkQ2hvaWNlSlMiLCJ3aW5kb3ciLCJDaG9pY2VzIiwiJGZvcm0iLCJqUXVlcnkiLCJkZXRhaWwiLCJibG9jayIsInF1ZXJ5U2VsZWN0b3IiLCJjb25jYXQiLCJjb25maWciLCJ3cGZvcm1zX2Nob2ljZXNqc19jb25maWciLCJmaW5kIiwiZWFjaCIsImluZGV4IiwiSFRNTFNlbGVjdEVsZW1lbnQiLCIkZWwiLCIkZmllbGQiLCJjbG9zZXN0IiwiY2FsbGJhY2tPbkluaXQiLCJzZWxmIiwiJGVsZW1lbnQiLCJwYXNzZWRFbGVtZW50IiwiJGlucHV0IiwiaW5wdXQiLCJzaXplQ2xhc3MiLCJjb250YWluZXJPdXRlciIsImFkZENsYXNzIiwicHJvcCIsImF0dHIiLCJnZXRWYWx1ZSIsImxlbmd0aCIsInJlbW92ZUF0dHIiLCJkaXNhYmxlIiwicmVtb3ZlQ2xhc3MiLCJ2YWwiLCJwYXJlbnQiLCJvcGVuQnVpbGRlclBvcHVwIiwiaXNFbXB0eU9iamVjdCIsInRtcGwiLCJhZnRlciIsInNpYmxpbmdzIiwidXJsIiwiZ2V0X3N0YXJ0ZWRfdXJsIiwiJGlmcmFtZSIsImZhZGVJbiIsImhhc0Zvcm1zIiwidGl0bGUiLCJzdHJpbmdzIiwiZGVzY3JpcHRpb24iLCJpY29uIiwia2V5d29yZHMiLCJmb3JtX2tleXdvcmRzIiwiY2F0ZWdvcnkiLCJhdHRyaWJ1dGVzIiwidHlwZSIsImRpc3BsYXlUaXRsZSIsImRpc3BsYXlEZXNjIiwicHJldmlldyIsImV4YW1wbGUiLCJzdXBwb3J0cyIsImN1c3RvbUNsYXNzTmFtZSIsImVkaXQiLCJwcm9wcyIsIl9wcm9wcyRhdHRyaWJ1dGVzIiwiX3Byb3BzJGF0dHJpYnV0ZXMkZm9yIiwiX3Byb3BzJGF0dHJpYnV0ZXMkZGlzIiwiX3Byb3BzJGF0dHJpYnV0ZXMkZGlzMiIsIl9wcm9wcyRhdHRyaWJ1dGVzJHByZSIsInNldEF0dHJpYnV0ZXMiLCJmb3JtT3B0aW9ucyIsIm1hcCIsInZhbHVlIiwibGFiZWwiLCJqc3giLCJ1bnNoaWZ0IiwiZm9ybV9zZWxlY3QiLCJzZWxlY3RGb3JtIiwidG9nZ2xlRGlzcGxheVRpdGxlIiwidG9nZ2xlRGlzcGxheURlc2MiLCJnZXRFbXB0eUZvcm1zUHJldmlldyIsImJsb2NrUHJvcHMiLCJjbGllbnRJZCIsIlJlYWN0Iiwia2V5Iiwic3JjIiwiYmxvY2tfZW1wdHlfdXJsIiwiYWx0IiwiZGFuZ2Vyb3VzbHlTZXRJbm5lckhUTUwiLCJfX2h0bWwiLCJ3cGZvcm1zX2VtcHR5X2luZm8iLCJvbkNsaWNrIiwid3Bmb3Jtc19lbXB0eV9oZWxwIiwiaWQiLCJwcmludEVtcHR5Rm9ybXNOb3RpY2UiLCJmb3JtX3NldHRpbmdzIiwic3R5bGUiLCJkaXNwbGF5IiwiZ2V0U3R5bGluZ1BhbmVsc1ByZXZpZXciLCJ0aGVtZXMiLCJmaWVsZF9zdHlsZXMiLCJsYWJlbF9zdHlsZXMiLCJidXR0b25fc3R5bGVzIiwiY29udGFpbmVyX3N0eWxlcyIsImJhY2tncm91bmRfc3R5bGVzIiwicHVzaCIsImZvcm1fc2VsZWN0ZWQiLCJvcHRpb25zIiwib25DaGFuZ2UiLCJzaG93X3RpdGxlIiwiY2hlY2tlZCIsInNob3dfZGVzY3JpcHRpb24iLCJ1cGRhdGVfd3Bfbm90aWNlX2hlYWQiLCJ1cGRhdGVfd3Bfbm90aWNlX3RleHQiLCJocmVmIiwidXBkYXRlX3dwX25vdGljZV9saW5rIiwicmVsIiwidGFyZ2V0IiwibGVhcm5fbW9yZSIsImJsb2NrX3ByZXZpZXdfdXJsIiwibG9nb191cmwiLCJzYXZlIl0sInNvdXJjZXMiOlsiZmFrZV9lZmMzYTNjLmpzIl0sInNvdXJjZXNDb250ZW50IjpbIi8qIGdsb2JhbCB3cGZvcm1zX2d1dGVuYmVyZ19mb3JtX3NlbGVjdG9yLCBKU1ggKi9cbi8qIGpzaGludCBlczM6IGZhbHNlLCBlc3ZlcnNpb246IDYgKi9cblxuLyoqXG4gKiBAcGFyYW0gc3RyaW5ncy51cGRhdGVfd3Bfbm90aWNlX2hlYWRcbiAqIEBwYXJhbSBzdHJpbmdzLnVwZGF0ZV93cF9ub3RpY2VfdGV4dFxuICogQHBhcmFtIHN0cmluZ3MudXBkYXRlX3dwX25vdGljZV9saW5rXG4gKiBAcGFyYW0gc3RyaW5ncy53cGZvcm1zX2VtcHR5X2hlbHBcbiAqIEBwYXJhbSBzdHJpbmdzLndwZm9ybXNfZW1wdHlfaW5mb1xuICovXG5cbmNvbnN0IHsgc2VydmVyU2lkZVJlbmRlcjogU2VydmVyU2lkZVJlbmRlciA9IHdwLmNvbXBvbmVudHMuU2VydmVyU2lkZVJlbmRlciB9ID0gd3A7XG5jb25zdCB7IGNyZWF0ZUVsZW1lbnQsIEZyYWdtZW50IH0gPSB3cC5lbGVtZW50O1xuY29uc3QgeyByZWdpc3RlckJsb2NrVHlwZSB9ID0gd3AuYmxvY2tzO1xuY29uc3QgeyBJbnNwZWN0b3JDb250cm9scyB9ID0gd3AuYmxvY2tFZGl0b3IgfHwgd3AuZWRpdG9yO1xuY29uc3QgeyBTZWxlY3RDb250cm9sLCBUb2dnbGVDb250cm9sLCBQYW5lbEJvZHksIFBsYWNlaG9sZGVyIH0gPSB3cC5jb21wb25lbnRzO1xuY29uc3QgeyBfXyB9ID0gd3AuaTE4bjtcblxuY29uc3Qgd3Bmb3Jtc0ljb24gPSBjcmVhdGVFbGVtZW50KCAnc3ZnJywgeyB3aWR0aDogMjAsIGhlaWdodDogMjAsIHZpZXdCb3g6ICcwIDAgNjEyIDYxMicsIGNsYXNzTmFtZTogJ2Rhc2hpY29uJyB9LFxuXHRjcmVhdGVFbGVtZW50KCAncGF0aCcsIHtcblx0XHRmaWxsOiAnY3VycmVudENvbG9yJyxcblx0XHRkOiAnTTU0NCwwSDY4QzMwLjQ0NSwwLDAsMzAuNDQ1LDAsNjh2NDc2YzAsMzcuNTU2LDMwLjQ0NSw2OCw2OCw2OGg0NzZjMzcuNTU2LDAsNjgtMzAuNDQ0LDY4LTY4VjY4IEM2MTIsMzAuNDQ1LDU4MS41NTYsMCw1NDQsMHogTTQ2NC40NCw2OEwzODcuNiwxMjAuMDJMMzIzLjM0LDY4SDQ2NC40NHogTTI4OC42Niw2OGwtNjQuMjYsNTIuMDJMMTQ3LjU2LDY4SDI4OC42NnogTTU0NCw1NDRINjggVjY4aDIyLjFsMTM2LDkyLjE0bDc5LjktNjQuNmw3OS41Niw2NC42bDEzNi05Mi4xNEg1NDRWNTQ0eiBNMTE0LjI0LDI2My4xNmg5NS44OHYtNDguMjhoLTk1Ljg4VjI2My4xNnogTTExNC4yNCwzNjAuNGg5NS44OCB2LTQ4LjYyaC05NS44OFYzNjAuNHogTTI0Mi43NiwzNjAuNGgyNTV2LTQ4LjYyaC0yNTVWMzYwLjRMMjQyLjc2LDM2MC40eiBNMjQyLjc2LDI2My4xNmgyNTV2LTQ4LjI4aC0yNTVWMjYzLjE2TDI0Mi43NiwyNjMuMTZ6IE0zNjguMjIsNDU3LjNoMTI5LjU0VjQwOEgzNjguMjJWNDU3LjN6Jyxcblx0fSApXG4pO1xuXG4vKipcbiAqIFBvcHVwIGNvbnRhaW5lci5cbiAqXG4gKiBAc2luY2UgMS44LjNcbiAqXG4gKiBAdHlwZSB7T2JqZWN0fVxuICovXG5sZXQgJHBvcHVwID0ge307XG5cbi8qKlxuICogQ2xvc2UgYnV0dG9uIChpbnNpZGUgdGhlIGZvcm0gYnVpbGRlcikgY2xpY2sgZXZlbnQuXG4gKlxuICogQHNpbmNlIDEuOC4zXG4gKlxuICogQHBhcmFtIHtzdHJpbmd9IGNsaWVudElEIEJsb2NrIENsaWVudCBJRC5cbiAqL1xuY29uc3QgYnVpbGRlckNsb3NlQnV0dG9uRXZlbnQgPSBmdW5jdGlvbiggY2xpZW50SUQgKSB7XG5cdCRwb3B1cFxuXHRcdC5vZmYoICd3cGZvcm1zQnVpbGRlckluUG9wdXBDbG9zZScgKVxuXHRcdC5vbiggJ3dwZm9ybXNCdWlsZGVySW5Qb3B1cENsb3NlJywgZnVuY3Rpb24oIGUsIGFjdGlvbiwgZm9ybUlkLCBmb3JtVGl0bGUgKSB7XG5cdFx0XHRpZiAoIGFjdGlvbiAhPT0gJ3NhdmVkJyB8fCAhIGZvcm1JZCApIHtcblx0XHRcdFx0cmV0dXJuO1xuXHRcdFx0fVxuXG5cdFx0XHQvLyBJbnNlcnQgYSBuZXcgYmxvY2sgd2hlbiBhIG5ldyBmb3JtIGlzIGNyZWF0ZWQgZnJvbSB0aGUgcG9wdXAgdG8gdXBkYXRlIHRoZSBmb3JtIGxpc3QgYW5kIGF0dHJpYnV0ZXMuXG5cdFx0XHRjb25zdCBuZXdCbG9jayA9IHdwLmJsb2Nrcy5jcmVhdGVCbG9jayggJ3dwZm9ybXMvZm9ybS1zZWxlY3RvcicsIHtcblx0XHRcdFx0Zm9ybUlkOiBmb3JtSWQudG9TdHJpbmcoKSwgLy8gRXhwZWN0cyBzdHJpbmcgdmFsdWUsIG1ha2Ugc3VyZSB3ZSBpbnNlcnQgc3RyaW5nLlxuXHRcdFx0fSApO1xuXG5cdFx0XHQvLyBlc2xpbnQtZGlzYWJsZS1uZXh0LWxpbmUgY2FtZWxjYXNlXG5cdFx0XHR3cGZvcm1zX2d1dGVuYmVyZ19mb3JtX3NlbGVjdG9yLmZvcm1zID0gWyB7IElEOiBmb3JtSWQsIHBvc3RfdGl0bGU6IGZvcm1UaXRsZSB9IF07XG5cblx0XHRcdC8vIEluc2VydCBhIG5ldyBibG9jay5cblx0XHRcdHdwLmRhdGEuZGlzcGF0Y2goICdjb3JlL2Jsb2NrLWVkaXRvcicgKS5yZW1vdmVCbG9jayggY2xpZW50SUQgKTtcblx0XHRcdHdwLmRhdGEuZGlzcGF0Y2goICdjb3JlL2Jsb2NrLWVkaXRvcicgKS5pbnNlcnRCbG9ja3MoIG5ld0Jsb2NrICk7XG5cdFx0fSApO1xufTtcblxuLyoqXG4gKiBJbml0IE1vZGVybiBzdHlsZSBEcm9wZG93biBmaWVsZHMgKDxzZWxlY3Q+KSB3aXRoIGNob2ljZUpTLlxuICpcbiAqIEBzaW5jZSAxLjkuMFxuICpcbiAqIEBwYXJhbSB7T2JqZWN0fSBlIEJsb2NrIERldGFpbHMuXG4gKi9cbmNvbnN0IGxvYWRDaG9pY2VKUyA9IGZ1bmN0aW9uKCBlICkge1xuXHRpZiAoIHR5cGVvZiB3aW5kb3cuQ2hvaWNlcyAhPT0gJ2Z1bmN0aW9uJyApIHtcblx0XHRyZXR1cm47XG5cdH1cblxuXHRjb25zdCAkZm9ybSA9IGpRdWVyeSggZS5kZXRhaWwuYmxvY2sucXVlcnlTZWxlY3RvciggYCN3cGZvcm1zLSR7IGUuZGV0YWlsLmZvcm1JZCB9YCApICk7XG5cdGNvbnN0IGNvbmZpZyA9IHdpbmRvdy53cGZvcm1zX2Nob2ljZXNqc19jb25maWcgfHwge307XG5cblx0JGZvcm0uZmluZCggJy5jaG9pY2VzanMtc2VsZWN0JyApLmVhY2goIGZ1bmN0aW9uKCBpbmRleCwgZWxlbWVudCApIHtcblx0XHRpZiAoICEgKCBlbGVtZW50IGluc3RhbmNlb2YgSFRNTFNlbGVjdEVsZW1lbnQgKSApIHtcblx0XHRcdHJldHVybjtcblx0XHR9XG5cblx0XHRjb25zdCAkZWwgPSBqUXVlcnkoIGVsZW1lbnQgKTtcblxuXHRcdGlmICggJGVsLmRhdGEoICdjaG9pY2VzanMnICkgKSB7XG5cdFx0XHRyZXR1cm47XG5cdFx0fVxuXG5cdFx0Y29uc3QgJGZpZWxkID0gJGVsLmNsb3Nlc3QoICcud3Bmb3Jtcy1maWVsZCcgKTtcblxuXHRcdGNvbmZpZy5jYWxsYmFja09uSW5pdCA9IGZ1bmN0aW9uKCkge1xuXHRcdFx0Y29uc3Qgc2VsZiA9IHRoaXMsXG5cdFx0XHRcdCRlbGVtZW50ID0galF1ZXJ5KCBzZWxmLnBhc3NlZEVsZW1lbnQuZWxlbWVudCApLFxuXHRcdFx0XHQkaW5wdXQgPSBqUXVlcnkoIHNlbGYuaW5wdXQuZWxlbWVudCApLFxuXHRcdFx0XHRzaXplQ2xhc3MgPSAkZWxlbWVudC5kYXRhKCAnc2l6ZS1jbGFzcycgKTtcblxuXHRcdFx0Ly8gQWRkIENTUy1jbGFzcyBmb3Igc2l6ZS5cblx0XHRcdGlmICggc2l6ZUNsYXNzICkge1xuXHRcdFx0XHRqUXVlcnkoIHNlbGYuY29udGFpbmVyT3V0ZXIuZWxlbWVudCApLmFkZENsYXNzKCBzaXplQ2xhc3MgKTtcblx0XHRcdH1cblxuXHRcdFx0LyoqXG5cdFx0XHQgKiBJZiBhIG11bHRpcGxlIHNlbGVjdCBoYXMgc2VsZWN0ZWQgY2hvaWNlcyAtIGhpZGUgYSBwbGFjZWhvbGRlciB0ZXh0LlxuXHRcdFx0ICogSW4gY2FzZSBpZiBzZWxlY3QgaXMgZW1wdHkgLSB3ZSByZXR1cm4gcGxhY2Vob2xkZXIgdGV4dC5cblx0XHRcdCAqL1xuXHRcdFx0aWYgKCAkZWxlbWVudC5wcm9wKCAnbXVsdGlwbGUnICkgKSB7XG5cdFx0XHRcdC8vIE9uIGluaXQgZXZlbnQuXG5cdFx0XHRcdCRpbnB1dC5kYXRhKCAncGxhY2Vob2xkZXInLCAkaW5wdXQuYXR0ciggJ3BsYWNlaG9sZGVyJyApICk7XG5cblx0XHRcdFx0aWYgKCBzZWxmLmdldFZhbHVlKCB0cnVlICkubGVuZ3RoICkge1xuXHRcdFx0XHRcdCRpbnB1dC5yZW1vdmVBdHRyKCAncGxhY2Vob2xkZXInICk7XG5cdFx0XHRcdH1cblx0XHRcdH1cblxuXHRcdFx0dGhpcy5kaXNhYmxlKCk7XG5cdFx0XHQkZmllbGQuZmluZCggJy5pcy1kaXNhYmxlZCcgKS5yZW1vdmVDbGFzcyggJ2lzLWRpc2FibGVkJyApO1xuXHRcdH07XG5cblx0XHQkZWwuZGF0YSggJ2Nob2ljZXNqcycsIG5ldyB3aW5kb3cuQ2hvaWNlcyggZWxlbWVudCwgY29uZmlnICkgKTtcblxuXHRcdC8vIFBsYWNlaG9sZGVyIGZpeCBvbiBpZnJhbWVzLlxuXHRcdGlmICggJGVsLnZhbCgpICkge1xuXHRcdFx0JGVsLnBhcmVudCgpLmZpbmQoICcuY2hvaWNlc19faW5wdXQnICkuYXR0ciggJ3N0eWxlJywgJ2Rpc3BsYXk6IG5vbmUgIWltcG9ydGFudCcgKTtcblx0XHR9XG5cdH0gKTtcbn07XG5cbi8vIG9uIGRvY3VtZW50IHJlYWR5XG5qUXVlcnkoIGZ1bmN0aW9uKCkge1xuXHRqUXVlcnkoIHdpbmRvdyApLm9uKCAnd3Bmb3Jtc0Zvcm1TZWxlY3RvckZvcm1Mb2FkZWQnLCBsb2FkQ2hvaWNlSlMgKTtcbn0gKTtcbi8qKlxuICogT3BlbiBidWlsZGVyIHBvcHVwLlxuICpcbiAqIEBzaW5jZSAxLjYuMlxuICpcbiAqIEBwYXJhbSB7c3RyaW5nfSBjbGllbnRJRCBCbG9jayBDbGllbnQgSUQuXG4gKi9cbmNvbnN0IG9wZW5CdWlsZGVyUG9wdXAgPSBmdW5jdGlvbiggY2xpZW50SUQgKSB7XG5cdGlmICggalF1ZXJ5LmlzRW1wdHlPYmplY3QoICRwb3B1cCApICkge1xuXHRcdGNvbnN0IHRtcGwgPSBqUXVlcnkoICcjd3Bmb3Jtcy1ndXRlbmJlcmctcG9wdXAnICk7XG5cdFx0Y29uc3QgcGFyZW50ID0galF1ZXJ5KCAnI3dwd3JhcCcgKTtcblxuXHRcdHBhcmVudC5hZnRlciggdG1wbCApO1xuXG5cdFx0JHBvcHVwID0gcGFyZW50LnNpYmxpbmdzKCAnI3dwZm9ybXMtZ3V0ZW5iZXJnLXBvcHVwJyApO1xuXHR9XG5cblx0Y29uc3QgdXJsID0gd3Bmb3Jtc19ndXRlbmJlcmdfZm9ybV9zZWxlY3Rvci5nZXRfc3RhcnRlZF91cmwsXG5cdFx0JGlmcmFtZSA9ICRwb3B1cC5maW5kKCAnaWZyYW1lJyApO1xuXG5cdGJ1aWxkZXJDbG9zZUJ1dHRvbkV2ZW50KCBjbGllbnRJRCApO1xuXHQkaWZyYW1lLmF0dHIoICdzcmMnLCB1cmwgKTtcblx0JHBvcHVwLmZhZGVJbigpO1xufTtcblxuY29uc3QgaGFzRm9ybXMgPSBmdW5jdGlvbigpIHtcblx0cmV0dXJuIHdwZm9ybXNfZ3V0ZW5iZXJnX2Zvcm1fc2VsZWN0b3IuZm9ybXMubGVuZ3RoID4gMDtcbn07XG5cbnJlZ2lzdGVyQmxvY2tUeXBlKCAnd3Bmb3Jtcy9mb3JtLXNlbGVjdG9yJywge1xuXHR0aXRsZTogd3Bmb3Jtc19ndXRlbmJlcmdfZm9ybV9zZWxlY3Rvci5zdHJpbmdzLnRpdGxlLFxuXHRkZXNjcmlwdGlvbjogd3Bmb3Jtc19ndXRlbmJlcmdfZm9ybV9zZWxlY3Rvci5zdHJpbmdzLmRlc2NyaXB0aW9uLFxuXHRpY29uOiB3cGZvcm1zSWNvbixcblx0a2V5d29yZHM6IHdwZm9ybXNfZ3V0ZW5iZXJnX2Zvcm1fc2VsZWN0b3Iuc3RyaW5ncy5mb3JtX2tleXdvcmRzLFxuXHRjYXRlZ29yeTogJ3dpZGdldHMnLFxuXHRhdHRyaWJ1dGVzOiB7XG5cdFx0Zm9ybUlkOiB7XG5cdFx0XHR0eXBlOiAnc3RyaW5nJyxcblx0XHR9LFxuXHRcdGRpc3BsYXlUaXRsZToge1xuXHRcdFx0dHlwZTogJ2Jvb2xlYW4nLFxuXHRcdH0sXG5cdFx0ZGlzcGxheURlc2M6IHtcblx0XHRcdHR5cGU6ICdib29sZWFuJyxcblx0XHR9LFxuXHRcdHByZXZpZXc6IHtcblx0XHRcdHR5cGU6ICdib29sZWFuJyxcblx0XHR9LFxuXHR9LFxuXHRleGFtcGxlOiB7XG5cdFx0YXR0cmlidXRlczoge1xuXHRcdFx0cHJldmlldzogdHJ1ZSxcblx0XHR9LFxuXHR9LFxuXHRzdXBwb3J0czoge1xuXHRcdGN1c3RvbUNsYXNzTmFtZTogaGFzRm9ybXMoKSxcblx0fSxcblx0ZWRpdCggcHJvcHMgKSB7IC8vIGVzbGludC1kaXNhYmxlLWxpbmUgbWF4LWxpbmVzLXBlci1mdW5jdGlvblxuXHRcdGNvbnN0IHsgYXR0cmlidXRlczogeyBmb3JtSWQgPSAnJywgZGlzcGxheVRpdGxlID0gZmFsc2UsIGRpc3BsYXlEZXNjID0gZmFsc2UsIHByZXZpZXcgPSBmYWxzZSB9LCBzZXRBdHRyaWJ1dGVzIH0gPSBwcm9wcztcblx0XHRjb25zdCBmb3JtT3B0aW9ucyA9IHdwZm9ybXNfZ3V0ZW5iZXJnX2Zvcm1fc2VsZWN0b3IuZm9ybXMubWFwKCAoIHZhbHVlICkgPT4gKFxuXHRcdFx0eyB2YWx1ZTogdmFsdWUuSUQsIGxhYmVsOiB2YWx1ZS5wb3N0X3RpdGxlIH1cblx0XHQpICk7XG5cblx0XHRjb25zdCBzdHJpbmdzID0gd3Bmb3Jtc19ndXRlbmJlcmdfZm9ybV9zZWxlY3Rvci5zdHJpbmdzO1xuXHRcdGxldCBqc3g7XG5cblx0XHRmb3JtT3B0aW9ucy51bnNoaWZ0KCB7IHZhbHVlOiAnJywgbGFiZWw6IHdwZm9ybXNfZ3V0ZW5iZXJnX2Zvcm1fc2VsZWN0b3Iuc3RyaW5ncy5mb3JtX3NlbGVjdCB9ICk7XG5cblx0XHRmdW5jdGlvbiBzZWxlY3RGb3JtKCB2YWx1ZSApIHsgLy8gZXNsaW50LWRpc2FibGUtbGluZSBqc2RvYy9yZXF1aXJlLWpzZG9jXG5cdFx0XHRzZXRBdHRyaWJ1dGVzKCB7IGZvcm1JZDogdmFsdWUgfSApO1xuXHRcdH1cblxuXHRcdGZ1bmN0aW9uIHRvZ2dsZURpc3BsYXlUaXRsZSggdmFsdWUgKSB7IC8vIGVzbGludC1kaXNhYmxlLWxpbmUganNkb2MvcmVxdWlyZS1qc2RvY1xuXHRcdFx0c2V0QXR0cmlidXRlcyggeyBkaXNwbGF5VGl0bGU6IHZhbHVlIH0gKTtcblx0XHR9XG5cblx0XHRmdW5jdGlvbiB0b2dnbGVEaXNwbGF5RGVzYyggdmFsdWUgKSB7IC8vIGVzbGludC1kaXNhYmxlLWxpbmUganNkb2MvcmVxdWlyZS1qc2RvY1xuXHRcdFx0c2V0QXR0cmlidXRlcyggeyBkaXNwbGF5RGVzYzogdmFsdWUgfSApO1xuXHRcdH1cblxuXHRcdC8qKlxuXHRcdCAqIEdldCBibG9jayBlbXB0eSBKU1ggY29kZS5cblx0XHQgKlxuXHRcdCAqIEBzaW5jZSAxLjguM1xuXHRcdCAqXG5cdFx0ICogQHBhcmFtIHtPYmplY3R9IGJsb2NrUHJvcHMgQmxvY2sgcHJvcGVydGllcy5cblx0XHQgKlxuXHRcdCAqIEByZXR1cm4ge0pTWC5FbGVtZW50fSBCbG9jayBlbXB0eSBKU1ggY29kZS5cblx0XHQgKi9cblx0XHRmdW5jdGlvbiBnZXRFbXB0eUZvcm1zUHJldmlldyggYmxvY2tQcm9wcyApIHtcblx0XHRcdGNvbnN0IGNsaWVudElkID0gYmxvY2tQcm9wcy5jbGllbnRJZDtcblxuXHRcdFx0cmV0dXJuIChcblx0XHRcdFx0PEZyYWdtZW50XG5cdFx0XHRcdFx0a2V5PVwid3Bmb3Jtcy1ndXRlbmJlcmctZm9ybS1zZWxlY3Rvci1mcmFnbWVudC1ibG9jay1lbXB0eVwiPlxuXHRcdFx0XHRcdDxkaXYgY2xhc3NOYW1lPVwid3Bmb3Jtcy1uby1mb3JtLXByZXZpZXdcIj5cblx0XHRcdFx0XHRcdDxpbWcgc3JjPXsgd3Bmb3Jtc19ndXRlbmJlcmdfZm9ybV9zZWxlY3Rvci5ibG9ja19lbXB0eV91cmwgfSBhbHQ9XCJcIiAvPlxuXHRcdFx0XHRcdFx0PHAgZGFuZ2Vyb3VzbHlTZXRJbm5lckhUTUw9eyB7IF9faHRtbDogc3RyaW5ncy53cGZvcm1zX2VtcHR5X2luZm8gfSB9PjwvcD5cblx0XHRcdFx0XHRcdDxidXR0b24gdHlwZT1cImJ1dHRvblwiIGNsYXNzTmFtZT1cImdldC1zdGFydGVkLWJ1dHRvbiBjb21wb25lbnRzLWJ1dHRvbiBpcy1idXR0b24gaXMtcHJpbWFyeVwiXG5cdFx0XHRcdFx0XHRcdG9uQ2xpY2s9e1xuXHRcdFx0XHRcdFx0XHRcdCgpID0+IHtcblx0XHRcdFx0XHRcdFx0XHRcdG9wZW5CdWlsZGVyUG9wdXAoIGNsaWVudElkICk7XG5cdFx0XHRcdFx0XHRcdFx0fVxuXHRcdFx0XHRcdFx0XHR9XG5cdFx0XHRcdFx0XHQ+XG5cdFx0XHRcdFx0XHRcdHsgX18oICdHZXQgU3RhcnRlZCcsICd3cGZvcm1zLWxpdGUnICkgfVxuXHRcdFx0XHRcdFx0PC9idXR0b24+XG5cdFx0XHRcdFx0XHQ8cCBjbGFzc05hbWU9XCJlbXB0eS1kZXNjXCIgZGFuZ2Vyb3VzbHlTZXRJbm5lckhUTUw9eyB7IF9faHRtbDogc3RyaW5ncy53cGZvcm1zX2VtcHR5X2hlbHAgfSB9PjwvcD5cblxuXHRcdFx0XHRcdFx0eyAvKiBUZW1wbGF0ZSBmb3IgcG9wdXAgd2l0aCBidWlsZGVyIGlmcmFtZSAqLyB9XG5cdFx0XHRcdFx0XHQ8ZGl2IGlkPVwid3Bmb3Jtcy1ndXRlbmJlcmctcG9wdXBcIiBjbGFzc05hbWU9XCJ3cGZvcm1zLWJ1aWxkZXItcG9wdXBcIj5cblx0XHRcdFx0XHRcdFx0PGlmcmFtZSBzcmM9XCJhYm91dDpibGFua1wiIHdpZHRoPVwiMTAwJVwiIGhlaWdodD1cIjEwMCVcIiBpZD1cIndwZm9ybXMtYnVpbGRlci1pZnJhbWVcIiB0aXRsZT1cIndwZm9ybXMtZ3V0ZW5iZXJnLXBvcHVwXCI+PC9pZnJhbWU+XG5cdFx0XHRcdFx0XHQ8L2Rpdj5cblx0XHRcdFx0XHQ8L2Rpdj5cblx0XHRcdFx0PC9GcmFnbWVudD5cblx0XHRcdCk7XG5cdFx0fVxuXG5cdFx0LyoqXG5cdFx0ICogUHJpbnQgZW1wdHkgZm9ybXMgbm90aWNlLlxuXHRcdCAqXG5cdFx0ICogQHNpbmNlIDEuOC4zXG5cdFx0ICpcblx0XHQgKiBAcGFyYW0ge3N0cmluZ30gY2xpZW50SWQgQmxvY2sgY2xpZW50IElELlxuXHRcdCAqXG5cdFx0ICogQHJldHVybiB7SlNYLkVsZW1lbnR9IEZpZWxkIHN0eWxlcyBKU1ggY29kZS5cblx0XHQgKi9cblx0XHRmdW5jdGlvbiBwcmludEVtcHR5Rm9ybXNOb3RpY2UoIGNsaWVudElkICkge1xuXHRcdFx0cmV0dXJuIChcblx0XHRcdFx0PEluc3BlY3RvckNvbnRyb2xzIGtleT1cIndwZm9ybXMtZ3V0ZW5iZXJnLWZvcm0tc2VsZWN0b3ItaW5zcGVjdG9yLW1haW4tc2V0dGluZ3NcIj5cblx0XHRcdFx0XHQ8UGFuZWxCb2R5IGNsYXNzTmFtZT1cIndwZm9ybXMtZ3V0ZW5iZXJnLXBhbmVsXCIgdGl0bGU9eyBzdHJpbmdzLmZvcm1fc2V0dGluZ3MgfT5cblx0XHRcdFx0XHRcdDxwIGNsYXNzTmFtZT1cIndwZm9ybXMtZ3V0ZW5iZXJnLXBhbmVsLW5vdGljZSB3cGZvcm1zLXdhcm5pbmcgd3Bmb3Jtcy1lbXB0eS1mb3JtLW5vdGljZVwiIHN0eWxlPXsgeyBkaXNwbGF5OiAnYmxvY2snIH0gfT5cblx0XHRcdFx0XHRcdFx0PHN0cm9uZz57IF9fKCAnWW91IGhhdmVu4oCZdCBjcmVhdGVkIGEgZm9ybSwgeWV0IScsICd3cGZvcm1zLWxpdGUnICkgfTwvc3Ryb25nPlxuXHRcdFx0XHRcdFx0XHR7IF9fKCAnV2hhdCBhcmUgeW91IHdhaXRpbmcgZm9yPycsICd3cGZvcm1zLWxpdGUnICkgfVxuXHRcdFx0XHRcdFx0PC9wPlxuXHRcdFx0XHRcdFx0PGJ1dHRvbiB0eXBlPVwiYnV0dG9uXCIgY2xhc3NOYW1lPVwiZ2V0LXN0YXJ0ZWQtYnV0dG9uIGNvbXBvbmVudHMtYnV0dG9uIGlzLWJ1dHRvbiBpcy1zZWNvbmRhcnlcIlxuXHRcdFx0XHRcdFx0XHRvbkNsaWNrPXtcblx0XHRcdFx0XHRcdFx0XHQoKSA9PiB7XG5cdFx0XHRcdFx0XHRcdFx0XHRvcGVuQnVpbGRlclBvcHVwKCBjbGllbnRJZCApO1xuXHRcdFx0XHRcdFx0XHRcdH1cblx0XHRcdFx0XHRcdFx0fVxuXHRcdFx0XHRcdFx0PlxuXHRcdFx0XHRcdFx0XHR7IF9fKCAnR2V0IFN0YXJ0ZWQnLCAnd3Bmb3Jtcy1saXRlJyApIH1cblx0XHRcdFx0XHRcdDwvYnV0dG9uPlxuXHRcdFx0XHRcdDwvUGFuZWxCb2R5PlxuXHRcdFx0XHQ8L0luc3BlY3RvckNvbnRyb2xzPlxuXHRcdFx0KTtcblx0XHR9XG5cblx0XHQvKipcblx0XHQgKiBHZXQgc3R5bGluZyBwYW5lbHMgcHJldmlldy5cblx0XHQgKlxuXHRcdCAqIEBzaW5jZSAxLjguOFxuXHRcdCAqXG5cdFx0ICogQHJldHVybiB7SlNYLkVsZW1lbnR9IEpTWCBjb2RlLlxuXHRcdCAqL1xuXHRcdGZ1bmN0aW9uIGdldFN0eWxpbmdQYW5lbHNQcmV2aWV3KCkge1xuXHRcdFx0cmV0dXJuIChcblx0XHRcdFx0PEZyYWdtZW50PlxuXHRcdFx0XHRcdDxQYW5lbEJvZHkgY2xhc3NOYW1lPVwid3Bmb3Jtcy1ndXRlbmJlcmctcGFuZWwgZGlzYWJsZWRfcGFuZWxcIiB0aXRsZT17IHN0cmluZ3MudGhlbWVzIH0+XG5cdFx0XHRcdFx0XHQ8ZGl2IGNsYXNzTmFtZT1cIndwZm9ybXMtcGFuZWwtcHJldmlldyB3cGZvcm1zLXBhbmVsLXByZXZpZXctdGhlbWVzXCI+PC9kaXY+XG5cdFx0XHRcdFx0PC9QYW5lbEJvZHk+XG5cdFx0XHRcdFx0PFBhbmVsQm9keSBjbGFzc05hbWU9XCJ3cGZvcm1zLWd1dGVuYmVyZy1wYW5lbCBkaXNhYmxlZF9wYW5lbFwiIHRpdGxlPXsgc3RyaW5ncy5maWVsZF9zdHlsZXMgfT5cblx0XHRcdFx0XHRcdDxkaXYgY2xhc3NOYW1lPVwid3Bmb3Jtcy1wYW5lbC1wcmV2aWV3IHdwZm9ybXMtcGFuZWwtcHJldmlldy1maWVsZFwiPjwvZGl2PlxuXHRcdFx0XHRcdDwvUGFuZWxCb2R5PlxuXHRcdFx0XHRcdDxQYW5lbEJvZHkgY2xhc3NOYW1lPVwid3Bmb3Jtcy1ndXRlbmJlcmctcGFuZWwgZGlzYWJsZWRfcGFuZWxcIiB0aXRsZT17IHN0cmluZ3MubGFiZWxfc3R5bGVzIH0+XG5cdFx0XHRcdFx0XHQ8ZGl2IGNsYXNzTmFtZT1cIndwZm9ybXMtcGFuZWwtcHJldmlldyB3cGZvcm1zLXBhbmVsLXByZXZpZXctbGFiZWxcIj48L2Rpdj5cblx0XHRcdFx0XHQ8L1BhbmVsQm9keT5cblx0XHRcdFx0XHQ8UGFuZWxCb2R5IGNsYXNzTmFtZT1cIndwZm9ybXMtZ3V0ZW5iZXJnLXBhbmVsIGRpc2FibGVkX3BhbmVsXCIgdGl0bGU9eyBzdHJpbmdzLmJ1dHRvbl9zdHlsZXMgfT5cblx0XHRcdFx0XHRcdDxkaXYgY2xhc3NOYW1lPVwid3Bmb3Jtcy1wYW5lbC1wcmV2aWV3IHdwZm9ybXMtcGFuZWwtcHJldmlldy1idXR0b25cIj48L2Rpdj5cblx0XHRcdFx0XHQ8L1BhbmVsQm9keT5cblx0XHRcdFx0XHQ8UGFuZWxCb2R5IGNsYXNzTmFtZT1cIndwZm9ybXMtZ3V0ZW5iZXJnLXBhbmVsIGRpc2FibGVkX3BhbmVsXCIgdGl0bGU9eyBzdHJpbmdzLmNvbnRhaW5lcl9zdHlsZXMgfT5cblx0XHRcdFx0XHRcdDxkaXYgY2xhc3NOYW1lPVwid3Bmb3Jtcy1wYW5lbC1wcmV2aWV3IHdwZm9ybXMtcGFuZWwtcHJldmlldy1jb250YWluZXJcIj48L2Rpdj5cblx0XHRcdFx0XHQ8L1BhbmVsQm9keT5cblx0XHRcdFx0XHQ8UGFuZWxCb2R5IGNsYXNzTmFtZT1cIndwZm9ybXMtZ3V0ZW5iZXJnLXBhbmVsIGRpc2FibGVkX3BhbmVsXCIgdGl0bGU9eyBzdHJpbmdzLmJhY2tncm91bmRfc3R5bGVzIH0+XG5cdFx0XHRcdFx0XHQ8ZGl2IGNsYXNzTmFtZT1cIndwZm9ybXMtcGFuZWwtcHJldmlldyB3cGZvcm1zLXBhbmVsLXByZXZpZXctYmFja2dyb3VuZFwiPjwvZGl2PlxuXHRcdFx0XHRcdDwvUGFuZWxCb2R5PlxuXHRcdFx0XHQ8L0ZyYWdtZW50PlxuXHRcdFx0KTtcblx0XHR9XG5cblx0XHRpZiAoICEgaGFzRm9ybXMoKSApIHtcblx0XHRcdGpzeCA9IFsgcHJpbnRFbXB0eUZvcm1zTm90aWNlKCBwcm9wcy5jbGllbnRJZCApIF07XG5cblx0XHRcdGpzeC5wdXNoKCBnZXRFbXB0eUZvcm1zUHJldmlldyggcHJvcHMgKSApO1xuXHRcdFx0cmV0dXJuIGpzeDtcblx0XHR9XG5cblx0XHRqc3ggPSBbXG5cdFx0XHQ8SW5zcGVjdG9yQ29udHJvbHMga2V5PVwid3Bmb3Jtcy1ndXRlbmJlcmctZm9ybS1zZWxlY3Rvci1pbnNwZWN0b3ItY29udHJvbHNcIj5cblx0XHRcdFx0PFBhbmVsQm9keSB0aXRsZT17IHdwZm9ybXNfZ3V0ZW5iZXJnX2Zvcm1fc2VsZWN0b3Iuc3RyaW5ncy5mb3JtX3NldHRpbmdzIH0+XG5cdFx0XHRcdFx0PFNlbGVjdENvbnRyb2xcblx0XHRcdFx0XHRcdGxhYmVsPXsgd3Bmb3Jtc19ndXRlbmJlcmdfZm9ybV9zZWxlY3Rvci5zdHJpbmdzLmZvcm1fc2VsZWN0ZWQgfVxuXHRcdFx0XHRcdFx0dmFsdWU9eyBmb3JtSWQgfVxuXHRcdFx0XHRcdFx0b3B0aW9ucz17IGZvcm1PcHRpb25zIH1cblx0XHRcdFx0XHRcdG9uQ2hhbmdlPXsgc2VsZWN0Rm9ybSB9XG5cdFx0XHRcdFx0Lz5cblx0XHRcdFx0XHQ8VG9nZ2xlQ29udHJvbFxuXHRcdFx0XHRcdFx0bGFiZWw9eyB3cGZvcm1zX2d1dGVuYmVyZ19mb3JtX3NlbGVjdG9yLnN0cmluZ3Muc2hvd190aXRsZSB9XG5cdFx0XHRcdFx0XHRjaGVja2VkPXsgZGlzcGxheVRpdGxlIH1cblx0XHRcdFx0XHRcdG9uQ2hhbmdlPXsgdG9nZ2xlRGlzcGxheVRpdGxlIH1cblx0XHRcdFx0XHQvPlxuXHRcdFx0XHRcdDxUb2dnbGVDb250cm9sXG5cdFx0XHRcdFx0XHRsYWJlbD17IHdwZm9ybXNfZ3V0ZW5iZXJnX2Zvcm1fc2VsZWN0b3Iuc3RyaW5ncy5zaG93X2Rlc2NyaXB0aW9uIH1cblx0XHRcdFx0XHRcdGNoZWNrZWQ9eyBkaXNwbGF5RGVzYyB9XG5cdFx0XHRcdFx0XHRvbkNoYW5nZT17IHRvZ2dsZURpc3BsYXlEZXNjIH1cblx0XHRcdFx0XHQvPlxuXHRcdFx0XHRcdDxwIGNsYXNzTmFtZT1cIndwZm9ybXMtZ3V0ZW5iZXJnLXBhbmVsLW5vdGljZSB3cGZvcm1zLXdhcm5pbmdcIj5cblx0XHRcdFx0XHRcdDxzdHJvbmc+eyBzdHJpbmdzLnVwZGF0ZV93cF9ub3RpY2VfaGVhZCB9PC9zdHJvbmc+XG5cdFx0XHRcdFx0XHR7IHN0cmluZ3MudXBkYXRlX3dwX25vdGljZV90ZXh0IH0gPGEgaHJlZj17IHN0cmluZ3MudXBkYXRlX3dwX25vdGljZV9saW5rIH0gcmVsPVwibm9yZWZlcnJlclwiIHRhcmdldD1cIl9ibGFua1wiPnsgc3RyaW5ncy5sZWFybl9tb3JlIH08L2E+XG5cdFx0XHRcdFx0PC9wPlxuXHRcdFx0XHQ8L1BhbmVsQm9keT5cblx0XHRcdFx0eyBnZXRTdHlsaW5nUGFuZWxzUHJldmlldygpIH1cblx0XHRcdDwvSW5zcGVjdG9yQ29udHJvbHM+LFxuXHRcdF07XG5cblx0XHRpZiAoIGZvcm1JZCApIHtcblx0XHRcdGpzeC5wdXNoKFxuXHRcdFx0XHQ8U2VydmVyU2lkZVJlbmRlclxuXHRcdFx0XHRcdGtleT1cIndwZm9ybXMtZ3V0ZW5iZXJnLWZvcm0tc2VsZWN0b3Itc2VydmVyLXNpZGUtcmVuZGVyZXJcIlxuXHRcdFx0XHRcdGJsb2NrPVwid3Bmb3Jtcy9mb3JtLXNlbGVjdG9yXCJcblx0XHRcdFx0XHRhdHRyaWJ1dGVzPXsgcHJvcHMuYXR0cmlidXRlcyB9XG5cdFx0XHRcdC8+XG5cdFx0XHQpO1xuXHRcdH0gZWxzZSBpZiAoIHByZXZpZXcgKSB7XG5cdFx0XHRqc3gucHVzaChcblx0XHRcdFx0PEZyYWdtZW50XG5cdFx0XHRcdFx0a2V5PVwid3Bmb3Jtcy1ndXRlbmJlcmctZm9ybS1zZWxlY3Rvci1mcmFnbWVudC1ibG9jay1wcmV2aWV3XCI+XG5cdFx0XHRcdFx0PGltZyBzcmM9eyB3cGZvcm1zX2d1dGVuYmVyZ19mb3JtX3NlbGVjdG9yLmJsb2NrX3ByZXZpZXdfdXJsIH0gc3R5bGU9eyB7IHdpZHRoOiAnMTAwJScgfSB9IGFsdD1cIlwiIC8+XG5cdFx0XHRcdDwvRnJhZ21lbnQ+XG5cdFx0XHQpO1xuXHRcdH0gZWxzZSB7XG5cdFx0XHRqc3gucHVzaChcblx0XHRcdFx0PFBsYWNlaG9sZGVyXG5cdFx0XHRcdFx0a2V5PVwid3Bmb3Jtcy1ndXRlbmJlcmctZm9ybS1zZWxlY3Rvci13cmFwXCJcblx0XHRcdFx0XHRjbGFzc05hbWU9XCJ3cGZvcm1zLWd1dGVuYmVyZy1mb3JtLXNlbGVjdG9yLXdyYXBcIj5cblx0XHRcdFx0XHQ8aW1nIHNyYz17IHdwZm9ybXNfZ3V0ZW5iZXJnX2Zvcm1fc2VsZWN0b3IubG9nb191cmwgfSBhbHQ9XCJcIiAvPlxuXHRcdFx0XHRcdDxTZWxlY3RDb250cm9sXG5cdFx0XHRcdFx0XHRrZXk9XCJ3cGZvcm1zLWd1dGVuYmVyZy1mb3JtLXNlbGVjdG9yLXNlbGVjdC1jb250cm9sXCJcblx0XHRcdFx0XHRcdHZhbHVlPXsgZm9ybUlkIH1cblx0XHRcdFx0XHRcdG9wdGlvbnM9eyBmb3JtT3B0aW9ucyB9XG5cdFx0XHRcdFx0XHRvbkNoYW5nZT17IHNlbGVjdEZvcm0gfVxuXHRcdFx0XHRcdC8+XG5cdFx0XHRcdDwvUGxhY2Vob2xkZXI+XG5cdFx0XHQpO1xuXHRcdH1cblxuXHRcdHJldHVybiBqc3g7XG5cdH0sXG5cdHNhdmUoKSB7XG5cdFx0cmV0dXJuIG51bGw7XG5cdH0sXG59ICk7XG4iXSwibWFwcGluZ3MiOiI7O0FBQUE7QUFDQTs7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUFFQSxJQUFBQSxHQUFBLEdBQWdGQyxFQUFFO0VBQUFDLG9CQUFBLEdBQUFGLEdBQUEsQ0FBMUVHLGdCQUFnQjtFQUFFQyxnQkFBZ0IsR0FBQUYsb0JBQUEsY0FBR0QsRUFBRSxDQUFDSSxVQUFVLENBQUNELGdCQUFnQixHQUFBRixvQkFBQTtBQUMzRSxJQUFBSSxXQUFBLEdBQW9DTCxFQUFFLENBQUNNLE9BQU87RUFBdENDLGFBQWEsR0FBQUYsV0FBQSxDQUFiRSxhQUFhO0VBQUVDLFFBQVEsR0FBQUgsV0FBQSxDQUFSRyxRQUFRO0FBQy9CLElBQVFDLGlCQUFpQixHQUFLVCxFQUFFLENBQUNVLE1BQU0sQ0FBL0JELGlCQUFpQjtBQUN6QixJQUFBRSxJQUFBLEdBQThCWCxFQUFFLENBQUNZLFdBQVcsSUFBSVosRUFBRSxDQUFDYSxNQUFNO0VBQWpEQyxpQkFBaUIsR0FBQUgsSUFBQSxDQUFqQkcsaUJBQWlCO0FBQ3pCLElBQUFDLGNBQUEsR0FBaUVmLEVBQUUsQ0FBQ0ksVUFBVTtFQUF0RVksYUFBYSxHQUFBRCxjQUFBLENBQWJDLGFBQWE7RUFBRUMsYUFBYSxHQUFBRixjQUFBLENBQWJFLGFBQWE7RUFBRUMsU0FBUyxHQUFBSCxjQUFB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
},{}]},{},[1])