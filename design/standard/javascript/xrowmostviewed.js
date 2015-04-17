jQuery(document).ready(function($) {
    updateMostViewed();
});

function updateMostViewed(){
    var nodeid = false;
    var impressions = {};
    if (!isNaN($("body").attr("data-nodeID")) && $("body").attr("data-nodeID") > 0)
    {
        nodeid=$("body").attr("data-nodeID");
    }
    $("*[data-impression]:visible").each(function( index, value ){
        impressions[index] = $(this).attr('data-impression');
    });

    $.ez( 'xrowmostviewed::increaseViewCounter', { 'nodeid': nodeid, 'impressions': impressions}, function( data ) { });
}