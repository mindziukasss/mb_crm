import $ from 'jquery';

window.Dropzone = require('dropzone/dist/min/dropzone.min');
Dropzone.autoDiscover = false;
$(document).ready(function() {
    let formElement = document.querySelector('.js-media-dropzone');

    if (!formElement) {
        return;
    }
    let dropzone = new Dropzone(formElement, {
        paramName: 'media',
        init: function () {
            this.on('error', function (file, data) {
                if (data.detail) {
                    this.emit('error', file, data.detail);
                }
            });
        }
    });
});