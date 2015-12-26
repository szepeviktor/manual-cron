// Footer scripts should be after any HTML: no document.ready()
(function ($) {
    var $output = $('#manual-cron-output');

    if (typeof MANCRON === 'undefined') {
        return;
    }

    $('#manual-cron').click(function () {
        $.ajax({
            url: MANCRON.url,
            method: 'POST',
            timeout: MANCRON.timeout,
            dataType: 'html',
            success: function (data) {
                $output.html('<code>OK</code>' + data);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                $output.html('<code>ERROR</code> ' + textStatus + ' ' + errorThrown);
            }
         });
     });
}(jQuery));
