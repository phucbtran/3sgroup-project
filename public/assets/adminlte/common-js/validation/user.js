$("#form-update").validate({
    rules: {
        full_name: {
            required: true
        },
        email: {
            required: true,
            email: true
        },
        password_confirm: {
            equalTo : "#form-password"
        },
    },
    messages: {
        full_name: {
            required: 'Vui lòng nhập họ tên.',
        },
        email: {
            required: 'Vui lòng nhập email.',
            email: 'Email không đúng định dạng.'
        },
        password_confirm: {
            equalTo: 'Mật khẩu không khớp.'
        }
    },
    highlight: function (element) {
        $(element).parent().addClass('message-error')
    },
});

$("#form-add").validate({
    rules: {
        full_name: {
            required: true
        },
        email: {
            required: true,
            email: true
        },
        password: {
            required: true
        },
        password_confirm: {
            required: true,
            equalTo : "#add-password"
        },
    },
    messages: {
        full_name: {
            required: 'Vui lòng nhập họ tên.',
        },
        email: {
            required: 'Vui lòng nhập email.',
            email: 'Email không đúng định dạng.'
        },
        password: {
            required: 'Vui lòng nhập mật khẩu.',
        },
        password_confirm: {
            required: 'Vui lòng nhập lại mật khẩu.',
            equalTo: 'Mật khẩu không khớp.'
        }
    },
    highlight: function (element) {
        $(element).parent().addClass('message-error')
    },
});
