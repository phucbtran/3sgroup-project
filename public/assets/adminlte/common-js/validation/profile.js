"use strict";
$("#form-profile").validate({
    rules: {
        full_name: {
            required: true
        }
    },
    messages: {
        full_name: {
            required: 'Vui lòng nhập họ tên.'
        }
    },
    highlight: function (element) {
        $(element).parent().addClass('message-error');
    },
});
