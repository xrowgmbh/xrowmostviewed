jQuery(document).ready(function($) {
    if (!isNaN($("body").attr("data-nodeID")) && $("body").attr("data-nodeID") > 0)
    {
        var nodeid=$("body").attr("data-nodeID");
        $.ez( 'xrowmostviewed::increaseViewCounter', { 'nodeid': nodeid}, function( data ) { });
    }
});