$(document).ready(function() {

    let all = $('#preview, #drivers, #foods, #farms, .sections, #next, #prev, #submitbtn');

    let blocks = {
        drivers: $('#drivers'),
        farms: $('#farms'),
        section1: $('#section1'),
        section2: $('#section2'),
        section3: $('#section3'),
        section4: $('#section4'),
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
            step = step >= 7 ? 7 : (step + 1);
            refresh();
        }
    });
    buttons.prev.click(e => {
        step = step <= 1 ? 1 : (step - 1);
        refresh();
    });

    function check() {
        if (blocks.drivers.find('input[name=driver_id]:checked').length !== 1) {
            alert('Нужно выбрать одного водителя');
            return false;
        }
        if (blocks.drivers.find('input[name=truck_id]:checked').length !== 1) {
            alert('Нужно выбрать грузовик');
            return false;
        }
        if (step === 2) {
            if (blocks.section1.find('input[name=food_section_1]:checked').length < 1) {
                alert('Нужно выбрать корм');
                return false;
            }
            if (blocks.section1.find('input[name=weight_section_1]:checked').length < 1) {
                alert('Нужно выбрать вес');
                return false;
            }
        }
        if (step === 3) {
            if (blocks.section2.find('input[name=food_section_2]:checked').length < 1) {
                alert('Нужно выбрать корм');
                return false;
            }
            if (blocks.section2.find('input[name=weight_section_2]:checked').length < 1) {
                alert('Нужно выбрать вес');
                return false;
            }
        }
        if (step === 4) {
            if (blocks.section3.find('input[name=food_section_3]:checked').length < 1) {
                alert('Нужно выбрать корм');
                return false;
            }
            if (blocks.section3.find('input[name=weight_section_3]:checked').length < 1) {
                alert('Нужно выбрать вес');
                return false;
            }
        }
        if (step === 5) {
            if ((blocks.section4.find('input[name=food_section_4]:checked').length + blocks.section4.find('input[name=weight_section_4]:checked').length) === 1) {
                alert('Нужно либо не выбирать ничего, либо и корм, и вес');
                return false;
            }
        }
        let farms = blocks.farms.find('input:checked').length;
        if (farms > 4) {
            alert('Можно выбрать не более 4 ферм');
            return false;
        }
        if (step === 6 && farms === 0) {
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
                blocks.section1.fadeIn();
                buttons.prev.fadeIn();
                buttons.next.fadeIn();
                break;
            case 3: // выбор корма
                blocks.section2.fadeIn();
                buttons.prev.fadeIn();
                buttons.next.fadeIn();
                break;
            case 4: // выбор корма
                blocks.section3.fadeIn();
                buttons.prev.fadeIn();
                buttons.next.fadeIn();
                break;
            case 5: // выбор корма
                blocks.section4.fadeIn();
                buttons.prev.fadeIn();
                buttons.next.fadeIn();
                break;
            case 6: // выбор фермы
                blocks.farms.fadeIn();
                buttons.prev.fadeIn();
                buttons.next.fadeIn();
                break;
            case 7:
                let driver_list = $('<ol></ol>');
                $('#drivers input[name=driver_id]:checked').each((i, v) => {
                    driver_list.append('<li>' + $(v).next('label').text() + '</li>');
                });
                let truck_list = $('<ol></ol>');
                $('#drivers input[name=truck_id]:checked').each((i, v) => {
                    truck_list.append('<li>' + $(v).next('label').text() + '</li>');
                });

                let food_list = $('<ol></ol>');
                $('.sections').each((i, v) => {
                    let p = $(v).find('input[type=radio]:checked');
                    food_list.append(
                        '<li>'
                        + 'Секция '
                        + (i + 1)
                        + ': '
                        + $(p[0]).next('label').text()
                        + ' - '
                        + $(p[1]).next('label').text()
                        + '</li>'
                    );
                });

                let farm_list = $('<ol></ol>');
                $('#farms input[type=checkbox]:checked').each((i, v) => {
                    farm_list.append('<li>' + $(v).next('label').text() + '</li>');
                });
                driver_list = '<ol>Водитель' + driver_list.html() + '</ol>';
                truck_list = '<ol>Грузовик' + truck_list.html() + '</ol>';
                food_list = '<ol>Корм' + food_list.html() + '</ol>';
                farm_list = '<ol>Ферма' + farm_list.html() + '</ol>';

                blocks.preview.html('<h4>Предпросмотр</h4>' + driver_list + truck_list + food_list + farm_list);
                blocks.preview.fadeIn();
                buttons.prev.fadeIn();
                buttons.submit.fadeIn();
        }
    }

    refresh();
});