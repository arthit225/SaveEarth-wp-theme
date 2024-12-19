/**
* ----------------------------------------------------------------------------
* Page scroll to id block editor JS (backend)
* ----------------------------------------------------------------------------
*/

(function(blocks, editor, components, i18n, element){

  var el = element.createElement,
      registerBlockType = blocks.registerBlockType,
      //RichText = editor.RichText,
      TextControl = components.TextControl,
      //BlockControls = editor.BlockControls,
      iconEl = el('img', { width: 24, height: 24,
        src: "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 15.641 15.931'%3E%3Cdefs%3E%3CclipPath id='a'%3E%3Cpath fill='%230ff' stroke='%23000' stroke-linecap='square' stroke-opacity='0' stroke-width='.265' d='M102.698 118.597v7.952H91.673v11.092h24.856v-11.092h-3.006v-7.952z' paint-order='markers stroke fill'/%3E%3C/clipPath%3E%3C/defs%3E%3Cg transform='translate(-87.653 -116.495)'%3E%3Cellipse cx='102.646' cy='127.029' fill='none' stroke='%23d54e21' stroke-width='1.494' clip-path='url(%23a)' rx='5.749' ry='5.82' transform='translate(-6.348 -1.67)'/%3E%3Ccircle cx='96.351' cy='125.352' r='2.539' fill='%23555d66'/%3E%3Cpath fill='none' stroke='%23d54e21' stroke-width='1.265' d='M88.934 117.796l3.34 3.274z'/%3E%3Cpath fill='%23d54e21' d='M88.466 122.246l5.145.067-.267-5.011z'/%3E%3C/g%3E%3C/svg%3E%0A"
      });

  registerBlockType( 'ps2id-block/target', {
      title: 'Page scroll to id target',

      icon: iconEl,

      keywords: [ i18n.__('HTML Anchor'), i18n.__('Target section') ],

      category: 'layout',

      attributes: {
          content: {
              type: 'string',
              source: 'attribute',
              selector: 'div',
              attribute: 'id'
          }
      },

      edit: function( props ) {
        var content = props.attributes.content;

        function onChangeContent( newContent ) {
            props.setAttributes( { content: newContent, id: newContent } );
        }

        return el(
          TextControl,
            {
                tagName: 'div',
                className: props.className,
                formattingControls: [],
                onChange: onChangeContent,
                //id: content,
                placeholder: i18n.__('Enter a target id (e.g. my-id)'),
                //help: 'Enter a target id (e.g. my-id)',
                //label: 'ID',
                //title: 'No spaces (spaces will be replaced by dashes)',
                value: content
            }
        );
      },

      save: function( props ) {
        var content = props.attributes.content,
            idVal = '';

        if(content){
            idVal = content.trim();
            idVal = idVal.replace(/\s/g, ''); //remove spaces (HTML5)
            //idVal = idVal.replace(/^[^a-zA-Z]+|[^\w:.-]+/g, ''); //sanitize id value (HTML4)
        }

        return el( 'div', {
            className: props.className,
            id: idVal
        }, '' );
      }
  } );

})(
  wp.blocks,
  wp.editor,
  wp.components,
  wp.i18n,
  wp.element
);