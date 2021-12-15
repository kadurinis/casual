$(document).ready(function() {

    let all = $('#preview, #drivers, #foods, #farms, #next, #prev, #submitbtn');

    let blocks = {
        drivers: $('#drivers'),
        foods: $('#foods'),
        farms: $('#farms'),
        preview: $('#preview'),
    }
    let buttons = {
        next: $('#next'),
        prev: $('#prev'),
        submit: $('#submitbtn'),
    }

    let step = 1;

    buttons.next.click(e => {
        if (check()) {
            step = step >= 4 ? 4 : (step + 1);
            refresh();
        }
    });
    buttons.prev.click(e => {
        if (check()) {
            step = step <= 1 ? 1 : (step - 1);
            refresh();
        }
    });

    function check() {
        if (blocks.drivers.find('input:checked').length !== 1) {
            alert('Нужно выбрать одного водителя');
            return false;
        }
        let foods = blocks.foods.find('input:checked').length;
        if (foods > 4) {
            alert('Можно выбрать не более 4 видов кормов');
            return false;
        }
        if (step === 2 && foods === 0) {
            alert('Нужно выбрать хотя бы один вид корма');
            return false;
        }
        let farms = blocks.farms.find('input:checked').length;
        if (farms > 4) {
            alert('Можно выбрать не более 4 ферм');
            return false;
        }
        if (step === 3 && farms === 0) {
            alert('Нужно выбрать хотя бы одну ферму');
            return false;
        }
        return true;
    }

    function refresh() {
        all.hide();
        switch (step) {
            case 1: // выбор водителя
                blocks.drivers.fadeIn();
                buttons.next.fadeIn();
                break;
            case 2: // выбор корма
                blocks.foods.fadeIn();
                buttons.prev.fadeIn();
                buttons.next.fadeIn();
                break;
            case 3: // выбор фермы
                blocks.farms.fadeIn();
                buttons.prev.fadeIn();
                buttons.next.fadeIn();
                break;
            case 4:
                let driver_list = $('<ol></ol>');
                $('#drivers input[type=radio]:checked').each((i, v) => {
                    driver_list.append('<li>' + $(v).next('label').text() + '</li>');
                });
                let food_list = $('<ol></ol>');
                $('#foods input[type=checkbox]:checked').each((i, v) => {
                    food_list.append('<li>' + $(v).next('label').text() + '</li>');
                });
                let farm_list = $('<ol></ol>');
                $('#farms input[type=checkbox]:checked').each((i, v) => {
                    farm_list.append('<li>' + $(v).next('label').text() + '</li>');
                });
                driver_list = '<ol>Водитель' + driver_list.html() + '</ol>';
                food_list = '<ol>Корм' + food_list.html() + '</ol>';
                farm_list = '<ol>Ферма' + farm_list.html() + '</ol>';

                blocks.preview.html('<h4>Предпросмотр</h4>' + driver_list + food_list + farm_list);
                blocks.preview.fadeIn();
                buttons.prev.fadeIn();
                buttons.submit.fadeIn();
        }
    }

    refresh();
});