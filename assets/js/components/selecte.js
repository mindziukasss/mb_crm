import $ from "jquery";

let selectForm = $('.js-select-form');
let selectTarget = $('.js-select-target');

selectForm.on('change', function (e) {

    $.ajax({
        url: selectForm.data('specific-url'),
        data: {
            location: selectForm.val()
        },

        success: function (html) {
            if (!html) {

                selectTarget.find('select').remove();
                selectTarget.addClass('d-none');

                return;
            }

            selectTarget
                .html(html)
                .removeClass('d-none')
        }
    });
});