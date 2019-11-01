import $ from 'jquery';

$(document).ready(function() {
    setInterval( function() {
        let hours = new Date().getHours();
        $(".hours").html(( hours < 10 ? "0" : "" ) + hours);
    }, 1000);
    setInterval( function() {
        let minutes = new Date().getMinutes();
        $(".min").html(( minutes < 10 ? "0" : "" ) + minutes);
    },1000);
    setInterval( function() {
        let seconds = new Date().getSeconds();
        $(".sec").html(( seconds < 10 ? "0" : "" ) + seconds);
    },1000);
});