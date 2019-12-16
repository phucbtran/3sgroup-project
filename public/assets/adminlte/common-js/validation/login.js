"use strict";
$("#form-login").validate({
    rules: {
        email: {
            required: true,
            email: true
        },
        password: {
            required: true
        },
    },
    messages: {
        email: {
            required: 'Vui lòng nhập email.',
            email: 'Email không đúng định dạng.'
        },
        password: {
            required: 'Vui lòng nhập mật khẩu.'
        }
    },
    highlight: function (element) {
        $(element).parent().addClass('message-error');
    },
});
