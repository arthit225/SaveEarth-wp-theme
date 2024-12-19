window.onload = function() {

    jQuery('.EWLimplement').each(function(index) {

        //check if is section or column
        let element = (jQuery(this).prop('tagName').toLowerCase() === 'section') ? 'section' : 'column';
        //retrieve the data
        let url = jQuery(this).attr('data-ewl-url');
        let type = jQuery(this).attr('data-ewl-type');
        let external = jQuery(this).attr('data-ewl-external');
        //let extOption = (typeof(external) != "undefined" && external !== null) ? 'yes' : 'no';
        let extOption = (external !== '' && typeof(external) != "undefined") ? 'yes' : 'no';
        let extHtml = (extOption === 'yes') ? ' target="_blank" ' : '';

        if (type === 'html') {
            //create html A tag and set styles
            jQuery(this).wrap('<a class="EWLtag" href="' + url + '" ' + extHtml + '></a>');

        }



        
        
        
        
        
        
        
        
        });


        jQuery('.EWLimplement').on('click', function() {
            //let parentA = jQuery(this).parent().attr('href');
            let url = jQuery(this).attr('data-ewl-url');
            let type = jQuery(this).attr('data-ewl-type');
            let external = jQuery(this).attr('data-ewl-external');
            let extOption = (external !== '' && typeof(external) != "undefined") ? 'yes' : 'no';
            if (type === 'js') {
                if (extOption === 'yes') {
                    window.open(url, '_blank').focus();
                }
                if (extOption === 'no') {
                    window.location.href = url;
                }


            }


        });


        function clickEWL(element, url) {
            



        }



}


