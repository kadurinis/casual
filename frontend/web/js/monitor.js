'use strict';

$(document).ready(function() {
    setInterval(function() {
        $.ajax({
            method: 'POST',
            cache: false,
            url: '/index.php?r=driver/monitor-order',
            success: function (data) {
                $('#monitor-order').html(data);
            },
            error: function (data) {
                $('#monitor-order').html(data);
            }
        });
    }, 1000);
});