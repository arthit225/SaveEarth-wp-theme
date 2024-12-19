(function(){
	tinymce.PluginManager.add("ps2id_tinymce_custom_button",function(editor,url){
		editor.addCommand("ps2id_tinymce_custom_button_link_popup",function(ui,v){
			editor.windowManager.open({
				title:"Page scroll to id link",body:[
					{type:"container",name:"ps2idlinkcontainer",html:"<p class='howto'>Enter the link URL/id and text</p>"},
					{type:"textbox",name:"ps2idurlid",label:"URL/id (e.g. #my-id)",value:v.f_url || "",tooltip:"e.g. http://mysite.com/#my-id or #my-id"},
					{type:"textbox",name:"ps2idtext",label:"Link Text",value:v.f_txt || ""},
					{type:"container",name:"ps2idlinkcontainer2",html:"<p class='howto'>Optional: enter a link-specific offset and/or your own custom class(es)</p>"},
					{type:"textbox",name:"ps2idoffset",label:"Offset",value:v.f_offset ? unescape(v.f_offset).replace(/&gt;/g, '>') : "",tooltip:"Set an offset to bypass plugin's general offset value"},
					{type:"container",name:"ps2idlinkcontainer3",html:"<p class='howto'>You can change the scroll duration/speed of the link by adding a <br />special class in the form of ps2id-speed-VALUE (i.e. ps2id-speed-600) <br />with value indicating the duration in milliseconds</p>"},
					{type:"textbox",name:"ps2idclass",label:"Custom class(es)",value:v.f_class ? unescape(v.f_class) : "",tooltip:"Separate multiple classes with space (e.g. class-a class-b)"},
					{type:"container",name:"ps2idlinkcontainer4",html:v.f_sccheck ? "<p class='howto'>Check the box below to transform the link to plain/text shortcode <br />(removes the ability to edit the link via this form)</p>" : "<p class='howto'>Check the box below to insert the link as plain/text shortcode in the editor</p>"},
					{type:"checkbox",name:"ps2idshortcode",label:v.f_sccheck ? "Change to shortcode" : "Insert as shortcode"}
				],
				onsubmit:function(e){
					if(e.data.ps2idurlid=="" || e.data.ps2idtext==""){
						editor.windowManager.alert("URL/id and Link Text cannot be empty!", function(){});
						return false;
					}
					if(v.edit_node){
						v.edit_node.parentNode.removeChild(v.edit_node);
					}
					if(e.data.ps2idshortcode){
						editor.insertContent("[ps2id url='"+e.data.ps2idurlid+"' offset='"+e.data.ps2idoffset+"' class='"+e.data.ps2idclass+"']"+e.data.ps2idtext+"[/ps2id]");
					}else{
						editor.insertContent("<a href='"+e.data.ps2idurlid+"' data-ps2id-offset='"+e.data.ps2idoffset+"' class='"+(e.data.ps2idclass ? e.data.ps2idclass+" _ps2id" : "_ps2id")+"'>"+e.data.ps2idtext+"</a>");
					}
				}
			});
		});
		editor.addButton("ps2id_tinymce_custom_button_link",{
			icon:"icon ps2id-custom-icon-link", 
			title:"Insert/edit Page scroll to id link",
			onclick:function(){
				var t=tinyMCE.activeEditor.selection.getNode(),s=tinyMCE.activeEditor.selection.getContent({format:"html"}),
					edit_node_v=null,f_url_v=null,f_txt_v=null,f_offset_v=null,f_class_v=null,f_sccheck_v=null;
				if(t.nodeName.toLowerCase()==="a"){
					edit_node_v=t;
					if(t.className.indexOf("_ps2id")>-1){
						f_offset_v=t.attributes["data-ps2id-offset"] ? t.attributes["data-ps2id-offset"].value : "";
						f_class_v=t.attributes["class"] ? t.attributes["class"].value.replace("_ps2id","") : "";
						f_sccheck_v=true;
					}
					f_url_v=t.attributes["href"].value;
					f_txt_v=t.innerHTML;
				}else{
					if(s && s.length>0){
						f_txt_v=s;
					}
				}
				editor.execCommand("ps2id_tinymce_custom_button_link_popup","",{
					edit_node: edit_node_v,
					f_url: f_url_v,
					f_txt: f_txt_v,
					f_offset: f_offset_v,
					f_class: f_class_v,
					f_sccheck: f_sccheck_v
				});
			},
			onPostRender:function(){
                ctrl=this,
                editor.on("NodeChange",function(e){
                    ctrl.active(e.element.className.indexOf("_ps2id")>-1);
                });
            }
		});
		editor.addButton("ps2id_tinymce_custom_button_target",{
			icon:"icon ps2id-custom-icon-target", 
			title:"Insert Page scroll to id target",
			onclick:function(){
				editor.windowManager.open({
					title:"Page scroll to id target",body:[
						{type:"textbox",name:"ps2idid",label:"id (e.g. my-id)"},
						{type:"textbox",name:"ps2idtarget",label:"Highlight target selector (optional)",tooltip:"Enter the element that will be considered as the actual target for highlighting"}
					],
					onsubmit:function(e){
						if(e.data.ps2idid=="" || e.data.ps2idid.indexOf("#")>-1){
							editor.windowManager.alert("id cannot be empty and should not contain a hash (#)!", function(){});
							return false;
						}
						editor.insertContent("[ps2id id='"+e.data.ps2idid+"' target='"+e.data.ps2idtarget+"'/]");
					}
				});
			} 
		});
	}); 
})();