/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you require will output into a single css file (app.css in this case)
import '../scss/app.scss';

import $ from 'jquery';
import 'bootstrap';
import './components/time'
import './components/delete'
import './components/selecte'
import './components/media'
import './components/galleryList'

// Need jQuery? Install it with 'yarn add jquery', then uncomment to require it.
// const $ = require('jquery');
$(document).ready(function(){
    $('.alert-success').fadeTo(2000, 500).slideUp(500, function(){
        $('.alert-success').slideUp(500);
    });

    //if need
    // $('.custom-file-input').on('change', function(event) {
    //     let inputFile = event.currentTarget;
    //     $(inputFile).parent()
    //         .find('.custom-file-label')
    //         .html(inputFile.files[0].name);
    // });
});

console.log('Hello Webpack Encore! Edit me in assets/js/app.js');
