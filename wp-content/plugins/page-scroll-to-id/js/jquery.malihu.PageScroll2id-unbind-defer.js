(function($){
	var _unbindUnrelatedClickEvents=function(evt,s){
			for(var i=evt.click.length-1; i>=0; i--){
				var handler=evt.click[i];
				if(handler && handler.namespace != "mPS2id"){
					if(handler.selector==='a[href*=#]'){
						handler.selector='a[href*=#]:not(._mPS2id-h), a[href*=#]:not(.__mPS2id)';
					}else if(handler.selector==='a[href*="#"]'){
						handler.selector='a[href*="#"]:not(._mPS2id-h), a[href*="#"]:not(.__mPS2id)';
					}else if(handler.selector==='a[href*=#]:not([href=#])'){
						handler.selector='a[href*=#]:not([href=#]):not(._mPS2id-h), a[href*=#]:not([href=#]):not(.__mPS2id)';
					}else if(handler.selector==='a[href*="#"]:not([href="#"])'){
						handler.selector='a[href*="#"]:not([href="#"]):not(._mPS2id-h), a[href*="#"]:not([href="#"]):not(.__mPS2id)';
					}else if(handler.selector && handler.selector.indexOf("mobmenu")!==-1){
						//special cases
						s.off("click");
					}else{
						s.off("click",handler.handler);
					}
				}
			}
		};
	$(window).on("load",function(){ //win load
		var selOpt=mPS2id_unbindScriptParams.unbindSelector,
			sel=$(selOpt);
		if(selOpt && sel.length){
			setTimeout(function(){
				var $events=sel.length ? $._data(sel[0],"events") : null,
					$docEvents=sel.length ? $._data($(document)[0],"events") : null;
				if($events) _unbindUnrelatedClickEvents($events,sel);
				if($docEvents) _unbindUnrelatedClickEvents($docEvents,sel);
			},300);
		}
	});
})(jQuery);