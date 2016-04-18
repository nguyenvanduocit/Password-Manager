(function($) {

    var clipboard = new Clipboard('.btn-clipboard');
    clipboard.on('success', function(e) {
        $(e.trigger).notify("Coppied!", {
            autoHideDelay: 1000,
            position:'right',
            className:'success'
        });
        e.clearSelection();
    });

})(jQuery);
