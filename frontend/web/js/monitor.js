'use strict';

$(document).ready(function() {
    setInterval(function() {
        $.ajax({
            method: 'POST',
            cache: false,
            url: '/index.php?r=driver/monitor-order',
            success: function (data) {
                console.log($(data).find('h3'));
                if ($(data).hasClass('new-order')) {
                    $('#new-order').addClass('visible');
                }else {
                    $('#new-order').removeClass('visible');
                }
                $('#monitor-order').html(data);
            },
            error: function (data) {
                $('#monitor-order').html(data);
            }
        });
    }, 1000);
});