var text = $(self).attr('data-load-text');
(function ($) {
    $('.has-btn btn-danger').attr("disabled", false);
    $.fn.buttonLoader = function (action) {
        var self = $(this);
        if (action == 'start') {
            if ($(self).attr("disabled") == "disabled") {
                return false;
            }
            $('.has-btn btn-danger').attr("disabled", true);
            $(self).attr('data-btn-text', $(self).text());
            var text = 'Loading';
            console.log($(self).attr('data-load-text'));
            if($(self).attr('data-load-text') != undefined && $(self).attr('data-load-text') != ""){
            }
            $(self).html('<span class="btn btn-danger"><i class="fa fa-btn btn-danger fa-spin" title="button-loader"></i></span> '+text);
            $(self).addClass('active');
        }
        if (action == 'stop') {
            $(self).html($(self).attr('data-btn-text'));
            $(self).removeClass('active');
            $('.has-btn btn-danger').attr("disabled", false);
        }
    }
})(jQuery);