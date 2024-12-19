(function($){
	$(document).ready(function(){
		
		/*
		--------------------
		General js
		--------------------
		*/
		
		var adminID="#"+_adminParams.id,
			totalInstances=$("#"+_adminParams.db_prefix+"total_instances"),
			resetField=$("#"+_adminParams.db_prefix+"reset"),
			shortcodePrefix=_adminParams.sc_prefix,
			instanceTitle="Instance title";
		
		if(repeatables){
			$(".form-table").wrapAll("<div class='repeatable-group meta-box-sortables' />").each(function(index){
				$(this).wrap("<div class='repeatable postbox' />").wrap("<div class='inside' />").parent().parent().prepend("<div class='handlediv' title='"+toggle_instance_title+"'><br /></div><h3 class='handle'><span>"+instanceTitle+"</span></h3>").children(".inside").prepend("<p class='repeatable-info'></p>").append("<p class='repeatable-tools'><a class='button button-small repeatable-remove' href='#'>Remove</a></p>");
			});
			
			setRemovable();
			setTitle();
			
			if(shortcodes){
				$(".repeatable-info").append("<span class='shortcode-info' />");
				
				setShortcode();
			}
			
			$(".js .wrap form").css({"opacity":1});
			
			$(".repeatable-add").on("click",function(e){
				e.preventDefault();
				var repeatable=loc=$(adminID+" .repeatable:last"),cloned;
				if(repeatable.length>0){
					cloned=repeatable.clone(true);
					var clonedRadio=cloned.find("input:radio"),
						clonedRadioName=clonedRadio.attr("name");
					clonedRadio.attr("name",clonedRadioName+"-cloned");
					cloned.insertAfter(loc);
					totalInstances.val(parseInt(totalInstances.val())+1);
					setRepeatable();
				}else{
					cloned="WTF!? All is empty...";
					loc=$(".repeatable-group");
					loc.append(cloned);
				}
			});
			
			$(".repeatable-group").sortable({  
				opacity:0.6,
				revert:true,
				cursor:"move",
				handle:".handle",
				placeholder:"sortable-placeholder",
				forcePlaceholderSize:true,
				update: function(event,ui){
					setRepeatable();
				}
			});  
			
			$("body").on("click",".repeatable-group",function(){
				$(this).sortable("refresh");  
			}).on("click",".repeatable-remove",function(e){
				e.preventDefault();
				if(!$(this).hasClass("remove-disabled")){
					$(this).parent().parent().parent(".repeatable").remove();
					totalInstances.val(parseInt(totalInstances.val())-1);
					setRepeatable();
				}
			}).on("click",".handlediv",function(e){
				e.preventDefault();
				var $this=$(this);
				$this.parent().toggleClass("closed");
			});
		}else{
			if(shortcodes){
				$(".plugin-footer").prepend("<p><span class='shortcode-info' /></p>");
				
				setShortcode();
			}
		}
		
		$(".reset-to-default").on("click",function(e){
			e.preventDefault();
			resetField.val("true");
			$("#submit").attr({"id":"none","name":"none"});
			$(adminID).submit();
		});
		
		function setRepeatable(){
			$(".repeatable").each(function(){
				var $this=$(this),
					i=$this.index();
				$this.find("label,input,select,textarea").each(function(){
					var field=$(this);
					if(field[0].nodeName.toLowerCase()==="label"){
						if(!!field.attr("for")){
							var upd=changeAttr(field.attr("for"),i);
							field.attr({"for":upd});
						}
					}else{
						var upd=changeAttr(field.attr("name"),i).replace("-cloned","");
						field.attr({"name":upd});
						if(!!field.attr("id")){
							field.attr({"id":upd});
						}
					}
				});	
			});
			setRemovable();
			setTitle();
			setShortcode();
		}
		
		function changeAttr(attr,i){
			var n=attr.match(/\d+\.?\d*/g),
				o=attr.replace("_"+n[0]+"_","_"+i+"_");
			return o;
		}
		
		function setRemovable(){
			$(".repeatable").find(".repeatable-remove").removeClass("remove-disabled");
			if(totalInstances.val()<2){
				$(".repeatable").find(".repeatable-remove").addClass("remove-disabled");
			}
		}
		
		function setTitle(){
			$(".repeatable").each(function(){
				var $this=$(this),
					i=$this.index();
				$this.find("h3 span").each(function(){
					$(this).text(instanceTitle+" "+(i+1));
				});	
			});
		}
		
		function setShortcode(){
			if(repeatables){
				$(".repeatable").each(function(){
					var $this=$(this),
						i=$this.index();
					$this.find(".repeatable-info .shortcode-info").each(function(){
						$(this).html("Shortcode: <span class='code'><code>["+shortcodePrefix+(i+1)+"] your content here [/"+shortcodePrefix+(i+1)+"]</code></span>");
					});	
				});
			}else{
				$(".shortcode-info").html("Shortcode: <span class='code'><code>["+shortcodePrefix+"] your content here [/"+shortcodePrefix+"]</code></span>");
			}
		}
		
		/*
		--------------------
		Plugin specific js --edit--
		--------------------
		*/

		//check for selector without quotes which is invalid without jquery migrate or jquery 3.x and display a warning
		var mps2idSelectorInput=$("input#page_scroll_to_id_0_selector"),
			mps2idSelectorDesc=mps2idSelectorInput.parent().children(".description"),
			mps2idExcludedSelectorInput=$("input#page_scroll_to_id_0_excludeSelector"),
			mps2idExcludedSelectorDesc=mps2idExcludedSelectorInput.parent().children(".description");
		if(mps2idSelectorInput.length && mps2idSelectorDesc.length){
			if(mps2idSelectorInput.val().indexOf("a[href*=#]:not([href=#])") >= 0){
				var mps2idSelectorInputQuoted=mps2idSelectorInput.val().replace("a[href*=#]:not([href=#])", "a[href*='#']:not([href='#'])");
				mps2idSelectorDesc.prepend("<small style='color:red'>It seems that you're using an older selector which might cause issues with the latest versions of WordPress. If you have such issues, change \"Selector(s)\" option value to: </small><br /><code>"+mps2idSelectorInputQuoted+"</code><br />");
			}
		}
		if(mps2idExcludedSelectorInput.length && mps2idExcludedSelectorDesc.length){
			if(mps2idExcludedSelectorInput.val().indexOf("a[href*=#]:not([href=#])") >= 0){
				var mps2idExcludedSelectorInputQuoted=mps2idExcludedSelectorInput.val().replace("a[href*=#]:not([href=#])", "a[href*='#']:not([href='#'])");
				mps2idExcludedSelectorDesc.prepend("<small style='color:red'>It seems that you're using a selector which might cause issues with the latest versions of WordPress. If you have such issues, change \"selectors are excluded\" value to: </small><br /><code>"+mps2idExcludedSelectorInputQuoted+"</code><br />");
			}
		}

		$(".mPS2id-show-option-common-values").on("click",function(e){
			e.preventDefault();
			$(this).next("span").toggleClass("mPS2id-show");
		});
		
		$(".mPS2id-open-help").on("click",function(e){
			e.preventDefault();
			openHelp();
		});
		
		$(".mPS2id-open-help-overview").on("click",function(e){
			e.preventDefault();
			openHelp("overview");
		});
		
		$(".mPS2id-open-help-get-started").on("click",function(e){
			e.preventDefault();
			openHelp("get-started");
		});
		
		$(".mPS2id-open-help-plugin-settings").on("click",function(e){
			e.preventDefault();
			openHelp("plugin-settings");
		});
		
		$(".mPS2id-open-help-shortcodes").on("click",function(e){
			e.preventDefault();
			openHelp("shortcodes");
		});
		
		function openHelp(tab){
			if(parseFloat(wpVersion)>=3.6){ //WP Contextual Help
				if(tab){
					$("a[href='#tab-panel-page-scroll-to-id"+tab+"']").trigger("click");
				}else{
					if(!$("#contextual-help-wrap").is(":visible")){
						setTimeout(function(){ $("#contextual-help-link").trigger("click"); },60);
					}
				}
			}else{
				if(tab){
					$(".oldwp-plugin-help-section-active:not(.oldwp-plugin-help-section-"+tab+")").removeClass("oldwp-plugin-help-section-active");
					$(".oldwp-plugin-help-section-"+tab).toggleClass("oldwp-plugin-help-section-active");
				}
			}
		}
		
	});
})(jQuery);