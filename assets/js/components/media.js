import $ from 'jquery';

window.Dropzone = require('dropzone/dist/min/dropzone.min');
Dropzone.autoDiscover = false;

$(document).ready(function() {
    let galleryId = document.querySelector('.gallery_block');

    var total_photos_counter = 0;
    Dropzone.autoDiscover = false;
    if ($('.dropzone').length) {
        const myDropzone = new Dropzone('.js-media-dropzone', {
            autoProcessQueue: false,
            parallelUploads: 20,
            maxFilesize: 200,
            // thumbnailWidth: 120,
            // thumbnailHeight: 120,
            addRemoveLinks: true,
            dictFileTooBig: 'Limit: 10MB',
            timeout: 180000,
            dictDefaultMessage: "Click me",
            maxThumbnailFilesize: 200,
            maxFiles:20,

            init: function () {
                this.on("removedfile", function (file) {

                    if (typeof file.xhr !== 'undefined') {
                        let fileData = JSON.parse(file.xhr.responseText);
                        delImageDropzone(fileData);
                    };
                });

                this.on("uploadprogress", function(file, progress) {
                    console.log("File progress", progress);
                });

                $.get('/mb-crm/admin/media/' + galleryId.dataset.id, function (file) {
                    $.each(file, function (key, value) {
                        if (value.length > 0) {
                            $.each(value, function (k, v) {
                                let mockFile = {name: v.originalFileName, size: v.size, id: v.id};
                                myDropzone.options.addedfile.call(myDropzone, mockFile);
                                myDropzone.options.thumbnail.call(myDropzone, mockFile, '/uploads/galleries/' + v.fileName);
                                $('.dz-progress').hide();
                            });
                        }
                        myDropzone.on("removedfile", function (file) {
                            delImageDropzone(file)
                        });
                    });
                })
            },

            success: function (file, done) {
                total_photos_counter++;
                $("#counter").text("# " + total_photos_counter);
            },
        });

        // Submit
        const button = document.getElementById('upload-files');
        button.addEventListener('click', function () {
            // Retrieve selected files
            const acceptedFiles = myDropzone.getAcceptedFiles();
            for (let i = 0; i < acceptedFiles.length; i++) {
                setTimeout(function () {
                    myDropzone.processFile(acceptedFiles[i])
                }, i * 2000)
            }
        });
    }

    function delImageDropzone(file) {
        if (typeof file.id !== 'undefined') {
            $.ajax({
                type: 'DELETE',
                url: '/mb-crm/admin/media/' + file.id + '/remove',
                data: {id: file.name, _token: $('[name="_token"]').val()},
                dataType: 'json',
                success: function (data) {
                    total_photos_counter--;
                    $("#counter").text("# " + total_photos_counter);
                }
            });
        }
    }
});