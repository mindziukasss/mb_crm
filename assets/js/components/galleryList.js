import $ from "jquery";

let selectFormGallery = $('.js-select-form-gallery');
let selectTargetGallery = $('.js-select-target-gallery');
let pageDescription = $('.page-description');

selectFormGallery.on('change', function (e) {

    $.ajax({
        url: selectFormGallery.data('gallery-specific-url'),
        data: {
            location: selectFormGallery.val()
        },

        success: function (html) {
            if (!html) {

                selectTargetGallery.find('select').remove();
                selectTargetGallery.addClass('d-none');
                pageDescription.removeClass('d-none');

                return;
            }

            selectTargetGallery
                .html(html)
                .removeClass('d-none');

            pageDescription.addClass('d-none');
        }
    });
});