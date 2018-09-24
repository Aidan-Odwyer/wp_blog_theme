$(document).ready(function () {
    if ($('.post:eq(1)').length > 0) {
    } else {
        $('<style>section .container:after{display: none;}</style>').appendTo('head');
    }
});