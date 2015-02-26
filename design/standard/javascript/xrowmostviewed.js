jQuery(document).ready(function($) {
    if (!isNaN($("body").attr("data-nodeID")) && $("body").attr("data-nodeID") > 0)
    {
        var nodeid=$("body").attr("data-nodeID");
        var impressions = {};
        $("*[data-impression]").each(function( index, value ) {
        	impressions[index] = $(this).attr('data-impression');
        });
        
        $.ez( 'xrowmostviewed::increaseViewCounter', { 'nodeid': nodeid, 'impressions': impressions}, function( data ) { });
    }
});