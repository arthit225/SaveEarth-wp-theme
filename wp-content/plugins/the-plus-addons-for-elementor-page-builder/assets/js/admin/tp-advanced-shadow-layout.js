(function ($) {
	"use strict";
	var tpAdvShadowLayouts = function ($scope, $) {
		var target = $scope,
		sectionId = target.data("id"),
		editMode = elementorFrontend.isEditMode(),
		settings = {};
		if (editMode) {
			var editorElements = null,
			sectionData = {};
			if (!window.elementor.hasOwnProperty("elements")) {
				return false;
			}
			editorElements = window.elementor.elements;
			if (!editorElements.models) {
				return false; 
			}
			$.each(editorElements.models, function (index, elem) {
				if (elem.id == target.closest('.elementor-top-section,.elementor-element.e-container,.elementor-element.e-con').data('id')) {
					$.each(elem.attributes.elements.models, function (index, col) {
						$.each(col.attributes.elements.models, function (index, subSec) {
							$.each(subSec.attributes.elements.models, function (index, subCol) {
								$.each(subCol.attributes.elements.models, function (ind, subWidget) {
									if (sectionId == subWidget.id) {
										sectionData = subWidget.attributes.settings.attributes;
										cccs(subWidget.id,sectionData);
										if (0 !== settings.length) {
											return settings;
										}
									}
									if (!editMode || !settings) {
										return false;
									}
								});
							});
						});
					});
				}
				sectionData = elem.attributes.settings.attributes;
				if(sectionData.adv_shadow_boxshadow=='yes' || sectionData.adv_shadow_textshadow=='yes' || sectionData.adv_shadow_dropshadow=='yes'){
					cccs(elem.id,sectionData);
				}
				$.each(elem.attributes.elements.models, function (inde, column) {
					if (column.id) {
						sectionData = column.attributes.settings.attributes;
						if(sectionData.adv_shadow_boxshadow=='yes' || sectionData.adv_shadow_textshadow=='yes' || sectionData.adv_shadow_dropshadow=='yes'){
							cccs(column.id,sectionData);
						}
					}
					$.each(column.attributes.elements.models, function (ind, widget) {
						if (sectionId == widget.id) {
							sectionData = widget.attributes.settings.attributes;
							cccs(widget.id,sectionData);
							if (0 !== settings.length) {
								return settings;
							}
						}
						if (!editMode || !settings) {
							return false;
						}
					});
				});				
			});
			function cccs(id, sectionData){
				var adv_shadow_boxshadow = sectionData.adv_shadow_boxshadow,
				    adv_shadow_boxshadow_class = ' '+sectionData.adv_shadow_boxshadow_class,
                    adv_shadow_boxshadow_h_s = sectionData.adv_shadow_boxshadow_h_s,
                    as_bs_lists = sectionData.as_bs_lists,
                    as_bs_lists_h = sectionData.as_bs_lists_h,
                    as_bs_transition = sectionData.as_bs_transition,
                    as_bs_transition_h = sectionData.as_bs_transition,
                    as_bs_type = sectionData.as_bs_type,

                    adv_shadow_textshadow = sectionData.adv_shadow_textshadow,
                    adv_shadow_textshadow_class = ' '+sectionData.adv_shadow_textshadow_class,
                    adv_shadow_textshadow_h_s = sectionData.adv_shadow_textshadow_h_s,
                    as_ts_lists = sectionData.as_ts_lists,
                    as_ts_lists_h = sectionData.as_ts_lists_h,
                    as_ts_transition = sectionData.as_ts_transition,
                    as_ts_transition_h = sectionData.as_ts_transition_h,


                    adv_shadow_dropshadow = sectionData.adv_shadow_dropshadow,
                    adv_shadow_dropshadow_class = ' '+sectionData.adv_shadow_dropshadow_class,
                    adv_shadow_dropshadow_h_s = sectionData.adv_shadow_dropshadow_h_s,
                    as_ds_lists = sectionData.as_ds_lists,
                    as_ds_lists_h = sectionData.as_ds_lists_h,
                    as_ds_transition = sectionData.as_ds_transition,
                    as_ds_transition_h = sectionData.as_ds_transition_h;

                    var id1 = `${id}:hover`;
					//box shadow
                    if (adv_shadow_boxshadow == "yes") {
                        var bStyle = '';						
						var bstrans= '';						
						if(as_bs_transition !=''){
							bstrans = '-webkit-transition: '+as_bs_transition+';-moz-transition: '+as_bs_transition+';-o-transition: '+as_bs_transition+';-ms-transition: '+as_bs_transition+';';							
						}

						if( as_bs_lists.length > 0 && as_bs_lists.models ){
							var i = 1;
							var total = as_bs_lists.models.length;						
							as_bs_lists.models.forEach(function(self){
								
								var as_bs_x = self.attributes.as_bs_x.size+self.attributes.as_bs_x.unit,
								as_bs_y = self.attributes.as_bs_y.size+self.attributes.as_bs_y.unit,
								as_bs_blur = self.attributes.as_bs_blur.size+self.attributes.as_bs_blur.unit,
								as_bs_spread = self.attributes.as_bs_spread.size+self.attributes.as_bs_spread.unit,
								as_bs_type = self.attributes.as_bs_type,
								as_bs_color = self.attributes.as_bs_color;

								var as_bs_typev ='';
								if(as_bs_type==='bst_inset'){
									as_bs_typev = 'inset';
								}
								var sep = '';
								if ( i != total ) {						
									sep = ', ';
								}
								bStyle += as_bs_typev+' '+as_bs_x+' '+as_bs_y+' '+as_bs_blur+' '+as_bs_spread+' '+as_bs_color+sep;
								i++;								
							});
						}


                        var selectorStyle = '.elementor-element.elementor-element-'+id+adv_shadow_boxshadow_class+',.elementor-element.elementor-element-'+id+':not(.elementor-motion-effects-element-type-background) > .elementor-widget-wrap '+adv_shadow_boxshadow_class+',.elementor-element.elementor-element-'+id+' > .elementor-widget-wrap > .elementor-motion-effects-container > .elementor-motion-effects-layer '+adv_shadow_boxshadow_class+',.elementor-element.elementor-element-'+id+'> .elementor-widget-container '+adv_shadow_boxshadow_class+'{ '+bstrans+'box-shadow :' +bStyle+' }';
				    	setStyle(selectorStyle,id); 
						
						if (adv_shadow_boxshadow_h_s != '') {
							var bStyleh = '';						
							var bstransh= '';	
							if(as_bs_transition_h){
								bstransh = '-webkit-transition: '+as_bs_transition_h+';-moz-transition: '+as_bs_transition_h+';-o-transition: '+as_bs_transition_h+';-ms-transition: '+as_bs_transition_h+';';
							}
	
							if( as_bs_lists_h.length > 0 && as_bs_lists_h.models ){
								var ih = 1;
								var totalh = as_bs_lists_h.models.length;						
								as_bs_lists_h.models.forEach(function(self){
									
									var as_bs_x_h = self.attributes.as_bs_x_h.size+self.attributes.as_bs_x_h.unit,
										as_bs_y_h = self.attributes.as_bs_y_h.size+self.attributes.as_bs_y_h.unit,
										as_bs_blur_h = self.attributes.as_bs_blur_h.size+self.attributes.as_bs_blur_h.unit,
										as_bs_spread_h = self.attributes.as_bs_spread_h.size+self.attributes.as_bs_spread_h.unit,
										as_bs_type_h = self.attributes.as_bs_type_h,
										as_bs_color_h = self.attributes.as_bs_color_h;
	
									var as_bs_typevh ='';
									if(as_bs_type_h==='bst_inset'){
										as_bs_typevh = 'inset';
									}
									var seph = '';
									if ( ih != totalh ) {						
										seph = ', ';
									}
									bStyleh += as_bs_typevh+' '+as_bs_x_h+' '+as_bs_y_h+' '+as_bs_blur_h+' '+as_bs_spread_h+' '+as_bs_color_h+seph;
									
									ih++;								
								});
							}
							
							var selectorStyle = '.elementor-element.elementor-element-'+id1+adv_shadow_boxshadow_class+',.elementor-element.elementor-element-'+id1+':not(.elementor-motion-effects-element-type-background) > .elementor-widget-wrap '+adv_shadow_boxshadow_class+',.elementor-element.elementor-element-'+id1+' > .elementor-widget-wrap > .elementor-motion-effects-container > .elementor-motion-effects-layer '+adv_shadow_boxshadow_class+',.elementor-element.elementor-element-'+id1+'> .elementor-widget-container '+adv_shadow_boxshadow_class+'{ '+bstransh+'box-shadow :' +bStyleh+' }';
				    	setStyle(selectorStyle,id1); 
						}
                    }
					
					//text Shadow
                    if (adv_shadow_textshadow == "yes") {
                        var tStyle = '';						
						var tstrans= '';						
						if(as_ts_transition !=''){
							tstrans = '-webkit-transition: '+as_ts_transition+';-moz-transition: '+as_ts_transition+';-o-transition: '+as_ts_transition+';-ms-transition: '+as_ts_transition+';';							
						}

						if( as_ts_lists.length > 0 && as_ts_lists.models ){
							var j = 1;
							var ttotal = as_ts_lists.models.length;						
							as_ts_lists.models.forEach(function(self){
								
								var as_ts_x = self.attributes.as_ts_x.size+self.attributes.as_ts_x.unit,
								as_ts_y = self.attributes.as_ts_y.size+self.attributes.as_ts_y.unit,
								as_ts_blur = self.attributes.as_ts_blur.size+self.attributes.as_ts_blur.unit,
								as_ts_color = self.attributes.as_ts_color;

								var sep = '';
								if ( j != ttotal ) {						
									sep = ', ';
								}
								tStyle += as_ts_x+' '+as_ts_y+' '+as_ts_blur+' '+as_ts_color+sep;
								j++;								
							});
						}


                        var selectorStyleT = '.elementor-element.elementor-element-'+id+adv_shadow_textshadow_class+',.elementor-element.elementor-element-'+id+':not(.elementor-motion-effects-element-type-background) > .elementor-widget-wrap '+adv_shadow_textshadow_class+',.elementor-element.elementor-element-'+id+' > .elementor-widget-wrap > .elementor-motion-effects-container > .elementor-motion-effects-layer '+adv_shadow_textshadow_class+',.elementor-element.elementor-element-'+id+'> .elementor-widget-container '+adv_shadow_textshadow_class+'{ '+tstrans+'text-shadow :' +tStyle+' }';
				    	setStyleTs(selectorStyleT,id); 
						
						if (adv_shadow_textshadow_h_s != '') {
							var tstransh= '';
							var tStyleh = '';
							if(as_ts_transition_h !=''){
								tstransh = '-webkit-transition: '+as_ts_transition_h+';-moz-transition: '+as_ts_transition_h+';-o-transition: '+as_ts_transition_h+';-ms-transition: '+as_ts_transition_h+';';							
							}

							if( as_ts_lists_h.length > 0 && as_ts_lists_h.models ){
								var jh = 1;
								var ttotalh = as_ts_lists_h.models.length;						
								as_ts_lists_h.models.forEach(function(self){									
									var as_ts_x_h = self.attributes.as_ts_x_h.size+self.attributes.as_ts_x_h.unit,
									as_ts_y_h = self.attributes.as_ts_y_h.size+self.attributes.as_ts_y_h.unit,
									as_ts_blur_h = self.attributes.as_ts_blur_h.size+self.attributes.as_ts_blur_h.unit,
									as_ts_color_h = self.attributes.as_ts_color_h;

									var seph = '';
									if ( jh != ttotalh ) {						
										seph = ', ';
									}
									tStyleh += as_ts_x_h+' '+as_ts_y_h+' '+as_ts_blur_h+' '+as_ts_color_h+seph;
									jh++;								
								});
							}


							var selectorStyleT = '.elementor-element.elementor-element-'+id1+adv_shadow_textshadow_class+',.elementor-element.elementor-element-'+id1+':not(.elementor-motion-effects-element-type-background) > .elementor-widget-wrap '+adv_shadow_textshadow_class+',.elementor-element.elementor-element-'+id1+' > .elementor-widget-wrap > .elementor-motion-effects-container > .elementor-motion-effects-layer '+adv_shadow_textshadow_class+',.elementor-element.elementor-element-'+id1+'> .elementor-widget-container '+adv_shadow_textshadow_class+'{ '+tstransh+'text-shadow :' +tStyleh+' }';
							setStyleTs(selectorStyleT,id1);
						}                     
                    }

					/*drop shadow*/
                    if (adv_shadow_dropshadow == "yes") {
                        
                        var dStyle = '';						
						var dstrans= '';						
						if(as_ds_transition !=''){
							dstrans = '-webkit-transition: '+as_ds_transition+';-moz-transition: '+as_ds_transition+';-o-transition: '+as_ds_transition+';-ms-transition: '+as_ds_transition+';';							
						}

						if( as_ds_lists.length > 0 && as_ds_lists.models ){
							var k = 1;
							var ktotal = as_ds_lists.models.length;						
							as_ds_lists.models.forEach(function(self){
								
								var as_ds_x = self.attributes.as_ds_x.size+self.attributes.as_ds_x.unit,
								as_ds_y = self.attributes.as_ds_y.size+self.attributes.as_ds_y.unit,
								as_ds_blur = self.attributes.as_ds_blur.size+self.attributes.as_ds_blur.unit,
								as_ds_color = self.attributes.as_ds_color;

								dStyle += 'drop-shadow('+as_ds_x+' '+as_ds_y+' '+as_ds_blur+' '+as_ds_color+') ' ;
								k++;								
							});
						}


                        var selectorStyleD = '.elementor-element.elementor-element-'+id+adv_shadow_dropshadow_class+',.elementor-element.elementor-element-'+id+':not(.elementor-motion-effects-element-type-background) > .elementor-widget-wrap '+adv_shadow_dropshadow_class+',.elementor-element.elementor-element-'+id+' > .elementor-widget-wrap > .elementor-motion-effects-container > .elementor-motion-effects-layer '+adv_shadow_dropshadow_class+',.elementor-element.elementor-element-'+id+'> .elementor-widget-container '+adv_shadow_dropshadow_class+'{ '+dstrans+'filter :' +dStyle+' }';
				    	setStyleDs(selectorStyleD,id); 
						
						if (adv_shadow_dropshadow_h_s != '') {
							var dstransh= '';
							var dStyleh = '';
							if(as_ds_transition_h !=''){
								dstransh = '-webkit-transition: '+as_ds_transition_h+';-moz-transition: '+as_ds_transition_h+';-o-transition: '+as_ds_transition_h+';-ms-transition: '+as_ds_transition_h+';';							
							}

							if( as_ds_lists_h.length > 0 && as_ds_lists_h.models ){
								var kh = 1;
								var dtotalh = as_ds_lists_h.models.length;						
								as_ds_lists_h.models.forEach(function(self){									
									var as_ds_x_h = self.attributes.as_ds_x_h.size+self.attributes.as_ds_x_h.unit,
									as_ds_y_h = self.attributes.as_ds_y_h.size+self.attributes.as_ds_y_h.unit,
									as_ds_blur_h = self.attributes.as_ds_blur_h.size+self.attributes.as_ds_blur_h.unit,
									as_ds_color_h = self.attributes.as_ds_color_h;

									dStyleh += 'drop-shadow('+as_ds_x_h+' '+as_ds_y_h+' '+as_ds_blur_h+' '+as_ds_color_h+') ' ;
									kh++;								
								});
							}


							var selectorStyleD = '.elementor-element.elementor-element-'+id1+adv_shadow_dropshadow_class+',.elementor-element.elementor-element-'+id1+':not(.elementor-motion-effects-element-type-background) > .elementor-widget-wrap '+adv_shadow_dropshadow_class+',.elementor-element.elementor-element-'+id1+' > .elementor-widget-wrap > .elementor-motion-effects-container > .elementor-motion-effects-layer '+adv_shadow_dropshadow_class+',.elementor-element.elementor-element-'+id1+'> .elementor-widget-container '+adv_shadow_dropshadow_class+'{ '+dstransh+'filter :' +dStyleh+' }';
							setStyleDs(selectorStyleD,id1);
						}                         
                    }

			}

			function setStyle(styleCss, widunID) {
				var styleSelector = window.document;
				if (styleSelector.getElementById('tp-advancedshadows-bs' + widunID) === null) {
					var cssInline = document.createElement('style');
					cssInline.type = 'text/css';
					cssInline.id = 'tp-advancedshadows-bs' + widunID;
					if (cssInline.styleSheet) {
						cssInline.styleSheet.cssText = styleCss;
					} else {
						cssInline.innerHTML = styleCss;
					}
					styleSelector.getElementsByTagName("head")[0].appendChild(cssInline);
				} else {
					styleSelector.getElementById('tp-advancedshadows-bs' + widunID).innerHTML = styleCss;
				}
			}

			function setStyleTs(styleCss, widunID) {
				var styleSelector = window.document;
				if (styleSelector.getElementById('tp-advancedshadows-ts' + widunID) === null) {
					var cssInline = document.createElement('style');
					cssInline.type = 'text/css';
					cssInline.id = 'tp-advancedshadows-ts' + widunID;
					if (cssInline.styleSheet) {
						cssInline.styleSheet.cssText = styleCss;
					} else {
						cssInline.innerHTML = styleCss;
					}
					styleSelector.getElementsByTagName("head")[0].appendChild(cssInline);
				} else {
					styleSelector.getElementById('tp-advancedshadows-ts' + widunID).innerHTML = styleCss;
				}
			}

			function setStyleDs(styleCss, widunID) {
				var styleSelector = window.document;
				if (styleSelector.getElementById('tp-advancedshadows-ds' + widunID) === null) {
					var cssInline = document.createElement('style');
					cssInline.type = 'text/css';
					cssInline.id = 'tp-advancedshadows-ds' + widunID;
					if (cssInline.styleSheet) {
						cssInline.styleSheet.cssText = styleCss;
					} else {
						cssInline.innerHTML = styleCss;
					}
					styleSelector.getElementsByTagName("head")[0].appendChild(cssInline);
				} else {
					styleSelector.getElementById('tp-advancedshadows-ds' + widunID).innerHTML = styleCss;
				}
			}
		}
	};
	$(window).on('elementor/frontend/init', function () {
		elementorFrontend.hooks.addAction('frontend/element_ready/widget', tpAdvShadowLayouts);
	});
})(jQuery);