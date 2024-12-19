(function($){
	var _p="mPS2id",
		_o=mPS2id_params,
		shortcodeClass=_o.shortcode_class, //shortcode without suffix 
		_hash=location.hash || null,
		_targetPosition,
		specialChars=/[ `!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/,
		_validateLocHash=function(val,forAll){
			var _id=val.substring(val.indexOf('#')+1);
			try{ //avoid js errors on invalid selectors 
				var $val=specialChars.test(_id) ? $(document.getElementById(_id)) : $("#"+_id); 
			}catch(error){ 
				return false; 
			}
			return (specialChars.test(_id) ? $(document.getElementById(_id)) : $("#"+_id)).length && (forAll || $("a[href*='#"+_id+"']").filter(function(){return $(this).data(_p+"Element")==true}).length);
		},
		_offset=function(val){
			if(val.indexOf(",")!==-1){
				var arr=val.split(","),y=arr[0] || "0",x=arr[1] || "0";
				return {"y":y,"x":x};
			}else{
				return val;
			}
		},
		_screen=function(val){
			if(val.indexOf(",")!==-1){
				var arr=val.split(","),x=arr[0] || "0",y=arr[1] || "0";
				return [x,y];
			}else{
				return val;
			}
		},
		_toTop=function(layout){
			if(layout!=="horizontal"){
				$(window).scrollTop(0); //stop jump to hash straight away
			}
			if(layout!=="vertical"){
				$(window).scrollLeft(0); //stop jump to hash straight away
			}
		},
		_unbindUnrelatedClickEvents=function(evt,s){
			for(var i=evt.click.length-1; i>=0; i--){
				var handler=evt.click[i];
				if(handler && handler.namespace != "mPS2id"){
					if(handler.selector==='a[href*=#]'){
						handler.selector='a[href*=#]:not(._mPS2id-h)';
					}else if(handler.selector==='a[href*="#"]'){
						handler.selector='a[href*="#"]:not(._mPS2id-h)';
					}else if(handler.selector==='a[href*=#]:not([href=#])'){
						handler.selector='a[href*=#]:not([href=#]):not(._mPS2id-h)';
					}else if(handler.selector==='a[href*="#"]:not([href="#"])'){
						handler.selector='a[href*="#"]:not([href="#"]):not(._mPS2id-h)';
					}else if(handler.selector && handler.selector.indexOf("mobmenu")!==-1){
						//special cases
						s.off("click");
					}else{
						s.off("click",handler.handler);
					}
				}
			}
		},
		autoSelectors="a[data-ps2id-api='true'][href*='#'],.ps2id > a[href*='#'],a.ps2id[href*='#']";
	$(function(){ //doc ready
		for(var k=0; k<_o.total_instances; k++){
			//generate id from class name (e.g. class ps2id-id-myid gives element the id myid)
			var c2iSel=$("[class*='ps2id-id-']");
			if(c2iSel.length){
				c2iSel.each(function(){
					var c2i=$(this),
						c2iClasses=c2i.attr("class").split(" "),
						c2iVal;
					if(!c2i.attr("id")){
						for(var c2iClass in c2iClasses){
							if(String(c2iClasses[c2iClass]).match(/^ps2id-id-\S+$/)){
								c2iVal=c2iClasses[c2iClass].split("ps2id-id-")[1];
								if(!$("#"+c2iVal).length) c2i.attr("id",c2iVal);
								break;
							}
						}
					}
				});
			}
			//scroll to location hash on page load
			if(_o.instances[_p+"_instance_"+k]["scrollToHash"]==="true" && _hash){
				$(_o.instances[_p+"_instance_"+k]["selector"]+",."+shortcodeClass+","+autoSelectors).not(_o.instances[_p+"_instance_"+k]["excludeSelector"]).each(function(){
					$(this).data(_p+"Element",true);
				});
				if(_validateLocHash(_hash,_o.instances[_p+"_instance_"+k]["scrollToHashForAll"]==="true")){
					var href=_o.instances[_p+"_instance_"+k]["scrollToHashRemoveUrlHash"]==="true" ? window.location.href.replace(/#.*$/,"") : window.location.href.replace(/#.*$/,"#");
					_toTop(_o.instances[_p+"_instance_"+k]["layout"]); //stop jump to hash straight away
					if(window.history && window.history.replaceState){
						window.history.replaceState("","",href);
					}else{
						window.location.href=href;
					}
				}
			}
		}
		//1.6.7
		//overwrite CSS scroll-behavior rule (https://developer.mozilla.org/en-US/docs/Web/CSS/scroll-behavior) in order to have proper smooth scrolling animation (duration, easing etc.)
		$("html").css("scroll-behavior","auto");
		//WordPress TwentyTwenty theme introduced its own (anonymous) smooth scrolling function which we need to disable (later versions of TwentyTwenty use CSS scroll-behavior rule) 
		if(window.twentytwenty && window.twentytwenty.smoothScroll) window.twentytwenty.smoothScroll=null;
	});
	$(window).on("load",function(){ //win load
		for(var i=0; i<_o.total_instances; i++){
			//check for selector without quotes which is invalid without jquery migrate or jquery 3.x and display a warning
			if(_o.instances[_p+"_instance_"+i]["selector"].indexOf("a[href*=#]:not([href=#])") >= 0){
				//var quotedSel=_o.instances[_p+"_instance_"+i]["selector"].replace("a[href*=#]:not([href=#])", "a[href*='#']:not([href='#'])");
				//_o.instances[_p+"_instance_"+i]["selector"]=quotedSel;
				console.log("ps2id selector issue: a[href*=#]:not([href=#]) selector needs quotes");
			}
			if(_o.instances[_p+"_instance_"+i]["excludeSelector"].indexOf("a[href*=#]:not([href=#])") >= 0){
				console.log("ps2id excluded selector issue: a[href*=#]:not([href=#]) selector needs quotes");
			}
			var sel=$(_o.instances[_p+"_instance_"+i]["selector"]+",."+shortcodeClass+","+autoSelectors),
				autoCorrectScrollOpt=_o.instances[_p+"_instance_"+i]["autoCorrectScroll"],autoCorrectScroll=0,
				autoCorrectScrollExtOpt=_o.instances[_p+"_instance_"+i]["autoCorrectScrollExtend"];
			//1.6.7
			//ps2id special parameters (these overwrite the ones in plugin settings) 
			//usage: <script>window.ps2id_special_params={ scrollSpeed: 500 }</script> 
			//the script should be added in head tag
			if(window.ps2id_special_params){
				if(window.ps2id_special_params.highlightSelector) _o.instances[_p+"_instance_"+i]["highlightSelector"]=window.ps2id_special_params.highlightSelector;
				if(window.ps2id_special_params.scrollSpeed) _o.instances[_p+"_instance_"+i]["scrollSpeed"]=window.ps2id_special_params.scrollSpeed;
				if(window.ps2id_special_params.scrollEasing) _o.instances[_p+"_instance_"+i]["scrollEasing"]=window.ps2id_special_params.scrollEasing;
				if(typeof window.ps2id_special_params.forceSingleHighlight !== "undefined") _o.instances[_p+"_instance_"+i]["forceSingleHighlight"]=window.ps2id_special_params.forceSingleHighlight;
				if(typeof window.ps2id_special_params.keepHighlightUntilNext !== "undefined") _o.instances[_p+"_instance_"+i]["keepHighlightUntilNext"]=window.ps2id_special_params.keepHighlightUntilNext;
				if(typeof window.ps2id_special_params.appendHash !== "undefined") _o.instances[_p+"_instance_"+i]["appendHash"]=window.ps2id_special_params.appendHash;
				if(window.ps2id_special_params.layout) _o.instances[_p+"_instance_"+i]["layout"]=window.ps2id_special_params.layout;
				if(window.ps2id_special_params.offset) _o.instances[_p+"_instance_"+i]["offset"]=window.ps2id_special_params.offset;
			}
			//-----
			sel.mPageScroll2id({
				scrollSpeed:_o.instances[_p+"_instance_"+i]["scrollSpeed"],
				autoScrollSpeed:(_o.instances[_p+"_instance_"+i]["autoScrollSpeed"]==="true") ? true : false,
				scrollEasing:(_o.instances[_p+"_instance_"+i]["forceScrollEasing"]==="true") ? "ps2id_"+_o.instances[_p+"_instance_"+i]["scrollEasing"] : _o.instances[_p+"_instance_"+i]["scrollEasing"],
				scrollingEasing:(_o.instances[_p+"_instance_"+i]["forceScrollEasing"]==="true") ? "ps2id_"+_o.instances[_p+"_instance_"+i]["scrollingEasing"] : _o.instances[_p+"_instance_"+i]["scrollingEasing"],
				pageEndSmoothScroll:(_o.instances[_p+"_instance_"+i]["pageEndSmoothScroll"]==="true") ? true : false,
				layout:_o.instances[_p+"_instance_"+i]["layout"],
				offset:_offset(_o.instances[_p+"_instance_"+i]["offset"].toString()),
				highlightSelector:_o.instances[_p+"_instance_"+i]["highlightSelector"],
				clickedClass:_o.instances[_p+"_instance_"+i]["clickedClass"],
				targetClass:_o.instances[_p+"_instance_"+i]["targetClass"],
				highlightClass:_o.instances[_p+"_instance_"+i]["highlightClass"],
				forceSingleHighlight:(_o.instances[_p+"_instance_"+i]["forceSingleHighlight"]==="true") ? true : false,
				keepHighlightUntilNext:(_o.instances[_p+"_instance_"+i]["keepHighlightUntilNext"]==="true") ? true : false,
				highlightByNextTarget:(_o.instances[_p+"_instance_"+i]["highlightByNextTarget"]==="true") ? true : false,
				disablePluginBelow:_screen(_o.instances[_p+"_instance_"+i]["disablePluginBelow"].toString()),
				appendHash:(_o.instances[_p+"_instance_"+i]["appendHash"]==="true") ? true : false,
				onStart:function(){
					if(autoCorrectScrollOpt==="true" && mPS2id.trigger==="selector") autoCorrectScroll++;
					if(autoCorrectScrollExtOpt==="true") _targetPosition=[mPS2id.target.offset().top,mPS2id.target.offset().left];
				},
				onComplete:function(){
					if(autoCorrectScrollExtOpt==="true"){
						if((_targetPosition[0] !== mPS2id.target.offset().top) || (_targetPosition[1] !== mPS2id.target.offset().left)){
							if(mPS2id.trigger === "selector" && mPS2id.clicked.length){
								mPS2id.clicked.trigger("click.mPS2id");
							}else{
								$.mPageScroll2id("scrollTo",mPS2id.target.attr("id"));
							}
						}
					}else{
						if(autoCorrectScroll==1){
							if(mPS2id.clicked.length) mPS2id.clicked.trigger("click.mPS2id");
							autoCorrectScroll=0;
						}
					}
				},
				excludeSelectors:_o.instances[_p+"_instance_"+i]["excludeSelector"],
				encodeLinks:(_o.instances[_p+"_instance_"+i]["encodeLinks"]==="true") ? true : false,
				liveSelector:_o.instances[_p+"_instance_"+i]["selector"]+",."+shortcodeClass+","+autoSelectors
			});
			//scroll to location hash on page load
			if(_o.instances[_p+"_instance_"+i]["scrollToHash"]==="true" && _hash){
				if(_validateLocHash(_hash,_o.instances[_p+"_instance_"+i]["scrollToHashForAll"]==="true")){
					_toTop(_o.instances[_p+"_instance_"+i]["layout"]); //jump/start from the top
					var scrollToHashUseElementData=_o.instances[_p+"_instance_"+i]["scrollToHashUseElementData"],
						linkMatchesHash=$("a._mPS2id-h[href$='"+_hash+"'][data-ps2id-offset]:not([data-ps2id-offset=''])").last();
					setTimeout(function(){
						if(scrollToHashUseElementData==="true" && linkMatchesHash.length){
							linkMatchesHash.trigger("click.mPS2id");
						}else{
							$.mPageScroll2id("scrollTo",_hash);
						}
						if(window.location.href.indexOf("#")!==-1){
							if(window.history && window.history.replaceState){
								window.history.replaceState("","",_hash);
							}else{
								window.location.hash=_hash;
							}
						}
					},_o.instances[_p+"_instance_"+i]["scrollToHashDelay"]);
				}
			}
			//auto-scroll to id on page load (based on "ps2id-auto-scroll" class)
			if($(".ps2id-auto-scroll[id]").length && !window.location.hash){
				setTimeout(function(){
					$.mPageScroll2id("scrollTo",$(".ps2id-auto-scroll[id]").attr("id"));
				},_o.instances[_p+"_instance_"+i]["scrollToHashDelay"]);
			}
			//attempt to unbind click events from other scripts 
			if(_o.instances[_p+"_instance_"+i]["unbindUnrelatedClickEvents"]==="true" && !_o.instances[_p+"_instance_"+i]["unbindUnrelatedClickEventsSelector"]){
				setTimeout(function(){
					var $events=sel.length ? $._data(sel[0],"events") : null,
						$docEvents=sel.length ? $._data($(document)[0],"events") : null;
					if($events) _unbindUnrelatedClickEvents($events,sel);
					if($docEvents) _unbindUnrelatedClickEvents($docEvents,sel);
				},300);
			}
			//force zero dimensions on anchor-point targets (firefox fix)
			if(_o.instances[_p+"_instance_"+i]["normalizeAnchorPointTargets"]==="true"){
				$("a._mPS2id-t[id]:empty").css({
					"display":"inline-block",
					"line-height":0,
					"width": 0,
					"height": 0,
					"border": "none"
				});
			}
			//stop scroll on mouse-wheel, touch-swipe etc.
			if(_o.instances[_p+"_instance_"+i]["stopScrollOnUserAction"]==="true"){
				$(document).on("mousewheel DOMMouseScroll touchmove",function(){
					var el=$("html,body");
					if(el.is(":animated")) el.stop();
				});
			}
		}
	});
	//extend jQuery's selectors
	if($.expr.pseudos){
		$.extend($.expr.pseudos,{
			//position based - e.g. :fixed
			absolute:$.expr.pseudos.absolute || function(el){return $(el).css("position")==="absolute";},
			relative:$.expr.pseudos.relative || function(el){return $(el).css("position")==="relative";},
			static:$.expr.pseudos.static || function(el){return $(el).css("position")==="static";},
			fixed:$.expr.pseudos.fixed || function(el){return $(el).css("position")==="fixed";},
			sticky:$.expr.pseudos.sticky || function(el){return $(el).css("position")==="sticky";},
			//width based - e.g. :width(200), :width(>200), :width(>200):width(<300) etc.
			width:$.expr.pseudos.width || function(a,i,m){
				var val=m[3].replace("&lt;","<").replace("&gt;",">");
				if(!val){return false;}
				return val.substr(0,1)===">" ? $(a).width()>val.substr(1) : val.substr(0,1)==="<" ? $(a).width()<val.substr(1) : $(a).width()===parseInt(val);
			},
			//height based - e.g. :height(200), :height(>200), :height(>200):height(<300) etc.
			height:$.expr.pseudos.height || function(a,i,m){
				var val=m[3].replace("&lt;","<").replace("&gt;",">");
				if(!val){return false;}
				return val.substr(0,1)===">" ? $(a).height()>val.substr(1) : val.substr(0,1)==="<" ? $(a).height()<val.substr(1) : $(a).height()===parseInt(val);
			}
		});
	}else{
		$.extend($.expr[":"],{
			//position based - e.g. :fixed
			absolute:$.expr[":"].absolute || function(el){return $(el).css("position")==="absolute";},
			relative:$.expr[":"].relative || function(el){return $(el).css("position")==="relative";},
			static:$.expr[":"].static || function(el){return $(el).css("position")==="static";},
			fixed:$.expr[":"].fixed || function(el){return $(el).css("position")==="fixed";},
			//width based - e.g. :width(200), :width(>200), :width(>200):width(<300) etc.
			width:$.expr[":"].width || function(a,i,m){
				var val=m[3].replace("&lt;","<").replace("&gt;",">");
				if(!val){return false;}
				return val.substr(0,1)===">" ? $(a).width()>val.substr(1) : val.substr(0,1)==="<" ? $(a).width()<val.substr(1) : $(a).width()===parseInt(val);
			},
			//height based - e.g. :height(200), :height(>200), :height(>200):height(<300) etc.
			height:$.expr[":"].height || function(a,i,m){
				var val=m[3].replace("&lt;","<").replace("&gt;",">");
				if(!val){return false;}
				return val.substr(0,1)===">" ? $(a).height()>val.substr(1) : val.substr(0,1)==="<" ? $(a).height()<val.substr(1) : $(a).height()===parseInt(val);
			}
		});
	}
	//extend jQuery with additional custom easings with custom names 
	//for more info see issue: https://wordpress.org/support/topic/easing-setting-does-not-take-effect/
	//some themes and plugins include outdated versions (1.3.x) of jquery.easing script (https://github.com/gdsmith/jquery.easing) which does not work with jquery 3.5 which is included in WordPress 5.6.
	$.easing.ps2id_easeInQuad=$.easing.ps2id_easeInQuad || function(x){
		return x*x;
	};
	$.easing.ps2id_easeOutQuad=$.easing.ps2id_easeOutQuad || function(x){
		return 1-(1-x)*(1-x);
	};
	$.easing.ps2id_easeInOutQuad=$.easing.ps2id_easeInOutQuad || function(x){
		return x<0.5 ? 2*x*x : 1-Math.pow(-2*x+2,2)/2;
	};
	$.easing.ps2id_easeInCubic=$.easing.ps2id_easeInCubic || function(x){
		return x*x*x;
	};
	$.easing.ps2id_easeOutCubic=$.easing.ps2id_easeOutCubic || function(x){
		return 1-Math.pow(1-x,3);
	};
	$.easing.ps2id_easeInOutCubic=$.easing.ps2id_easeInOutCubic || function(x){
		return x<0.5 ? 4*x*x*x : 1-Math.pow(-2*x+2,3)/2;
	};
	$.easing.ps2id_easeInQuart=$.easing.ps2id_easeInQuart || function(x){
		return x*x*x*x;
	};
	$.easing.ps2id_easeOutQuart=$.easing.ps2id_easeOutQuart || function(x){
		return 1-Math.pow(1-x,4);
	};
	$.easing.ps2id_easeInOutQuart=$.easing.ps2id_easeInOutQuart || function(x){
		return x<0.5 ? 8*x*x*x*x : 1-Math.pow(-2*x+2,4)/2;
	};
	$.easing.ps2id_easeInQuint=$.easing.ps2id_easeInQuint || function(x){
		return x*x*x*x*x;
	};
	$.easing.ps2id_easeOutQuint=$.easing.ps2id_easeOutQuint || function(x){
		return 1-Math.pow(1-x,5);
	};
	$.easing.ps2id_easeInOutQuint=$.easing.ps2id_easeInOutQuint || function(x){
		return x<0.5 ? 16*x*x*x*x*x : 1-Math.pow(-2*x+2,5)/2;
	};
	$.easing.ps2id_easeInExpo=$.easing.ps2id_easeInExpo || function(x){
		return x===0 ? 0 : Math.pow(2,10*x-10);
	};
	$.easing.ps2id_easeOutExpo=$.easing.ps2id_easeOutExpo || function(x){
		return x===1 ? 1 : 1-Math.pow(2,-10*x);
	};
	$.easing.ps2id_easeInOutExpo=$.easing.ps2id_easeInOutExpo || function(x){
		return x===0 ? 0 : x===1 ? 1 : x<0.5 ? Math.pow(2,20*x-10)/2 : (2-Math.pow(2,-20*x+10))/2;
	};
	$.easing.ps2id_easeInSine=$.easing.ps2id_easeInSine || function(x){
		return 1-Math.cos(x*Math.PI/2);
	};
	$.easing.ps2id_easeOutSine=$.easing.ps2id_easeOutSine || function(x){
		return Math.sin(x*Math.PI/2);
	};
	$.easing.ps2id_easeInOutSine=$.easing.ps2id_easeInOutSine || function(x){
		return -(Math.cos(Math.PI*x)-1)/2;
	};
	$.easing.ps2id_easeInCirc=$.easing.ps2id_easeInCirc || function(x){
		return 1-Math.sqrt(1-Math.pow(x,2));
	};
	$.easing.ps2id_easeOutCirc=$.easing.ps2id_easeOutCirc || function(x){
		return Math.sqrt(1-Math.pow(x-1,2));
	};
	$.easing.ps2id_easeInOutCirc=$.easing.ps2id_easeInOutCirc || function(x){
		return x<0.5 ? (1-Math.sqrt(1-Math.pow(2*x,2)))/2 : (Math.sqrt(1-Math.pow(-2*x+2,2))+1)/2;
	};
	$.easing.ps2id_easeInElastic=$.easing.ps2id_easeInElastic || function(x){
		return x===0 ? 0 : x===1 ? 1 : -Math.pow(2,10*x-10)*Math.sin((x*10-10.75)*((2*Math.PI)/3));
	};
	$.easing.ps2id_easeOutElastic=$.easing.ps2id_easeOutElastic || function(x){
		return x===0 ? 0 : x===1 ? 1 : Math.pow(2,-10*x)*Math.sin((x*10-0.75)*((2*Math.PI)/3))+1;
	};
	$.easing.ps2id_easeInOutElastic=$.easing.ps2id_easeInOutElastic || function(x){
		return x===0 ? 0 : x===1 ? 1 : x<0.5 ? -(Math.pow(2,20*x-10)*Math.sin((20*x-11.125)*((2*Math.PI)/4.5)))/2 : Math.pow(2,-20*x+10)*Math.sin((20*x-11.125)*((2*Math.PI)/4.5))/2+1;
	};
	$.easing.ps2id_easeInBack=$.easing.ps2id_easeInBack || function(x){
		return (1.70158+1)*x*x*x-1.70158*x*x;
	};
	$.easing.ps2id_easeOutBack=$.easing.ps2id_easeOutBack || function(x){
		return 1+(1.70158+1)*Math.pow(x-1,3)+1.70158*Math.pow(x-1,2);
	};
	$.easing.ps2id_easeInOutBack=$.easing.ps2id_easeInOutBack || function(x){
		return x<0.5 ? (Math.pow(2*x,2)*(((1.70158*1.525)+1)*2*x-(1.70158*1.525)))/2 : (Math.pow(2*x-2,2)*(((1.70158*1.525)+1)*(x*2-2)+(1.70158*1.525))+2)/2;
	};
	$.easing.ps2id_easeInBounce=$.easing.ps2id_easeInBounce || function(x){
		return 1-__ps2id_bounceOut(1-x);
	};
	$.easing.ps2id_easeOutBounce=$.easing.ps2id_easeOutBounce || __ps2id_bounceOut;
	$.easing.ps2id_easeInOutBounce=$.easing.ps2id_easeInOutBounce || function(x){
		return x<0.5 ? (1-__ps2id_bounceOut(1-2*x))/2 : (1+__ps2id_bounceOut(2*x-1))/2;
	};
	function __ps2id_bounceOut(x){
		var n1=7.5625,d1=2.75;
		if(x<1/d1){
			return n1*x*x;
		}else if(x<2/d1){
			return n1*(x-=(1.5/d1))*x+.75;
		}else if(x<2.5/d1){
			return n1*(x-=(2.25/d1))*x+.9375;
		}else{
			return n1*(x-=(2.625/d1))*x+.984375;
		}
	}
})(jQuery);