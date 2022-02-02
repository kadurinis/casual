'use strict';

$(document).ready(function() {
    let order_id = null;

    let monitor = $('#monitor-order');
    let driver = $('#driver-order');
    let callback = data => {};

    if (monitor[0]) {
        callback = data => {
            order_id = $(data).attr('data-id');
            if ($(data).attr('data-processed') === 'false') {
                $('#process-order').show();
            }else {
                $('#process-order').hide();
            }

            if ($(data).hasClass('new-order')) {
                $('#new-order').addClass('visible');
            }else {
                $('#new-order').removeClass('visible');
            }
            $('#monitor-order').html(data);
        }
    }

    if (driver[0]) {
        callback = data => {
            order_id = $(data).attr('data-id');
            $('#driver-order').html(data);
            if ($(data).attr('data-processed') === 'true') {
                $('#packing-completed').show();
            }else {
                $('#packing-completed').hide();
            }
        }
    }

    let ask = () => {
        $.ajax({
            method: 'POST',
            cache: false,
            url: '/index.php?r=driver/monitor-order',
            success: function (data) {
                callback(data);
            },
            error: function (data) {
                $('#monitor-order').html(data);
            }
        });
    }

    let loop = setInterval(() => ask(), 1000);

    $('#process-order').click(e => {
        $(e.target).hide();

        if (order_id) {
            clearInterval(loop);
            $.ajax({
                method: 'POST',
                cache: false,
                url: '/index.php?r=driver/monitor-order-confirm&order_id=' + order_id,
                success: function (data) {
                    ask();
                    loop = setInterval(() => ask(), 1000);
                },
                error: function (data) {
                    alert(data);
                }
            });
        }
        console.log('click');
    });
});