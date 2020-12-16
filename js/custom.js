jQuery( document ).ready(function() {
    //idioma
    jQuery('.lang').click(function(){
        console.log(jQuery(this).attr('lang'));
        var url = URL_BASE + '/language/change/' + jQuery(this).attr('lang');
        jQuery.post( url, function(){ location.reload(); });
    });

    //destaque no menu
    // if( window.location.pathname == '/' ) {
    //     var page = '/inicio';
    // } else {
    //     var page = window.location.pathname;
    // }
    // var page_class = '.'+page.substr(1);
    // $( page_class ).last().addClass( "current" );
});
