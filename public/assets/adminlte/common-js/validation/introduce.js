"use strict";
$("#form-update-overview").validate({
    ignore: ":hidden:not(textarea)",
    rules: {
        email: {
            required: true,
            email: true
        },
        phone: {
            required : true,
        },
        address: {
            required : true,
        },
        map_api: {
            required : true,
        },
        logo_name: {
            required : true,
        },
        head_description: {
            required: true,
        },
        detail_description: {
            required: true,
        },
        img_detail_name: {
            required : true,
        },
    },
    messages: {
        email: {
            required: 'Vui lòng nhập email.',
            email: 'Email không đúng định dạng.'
        },
        phone: {
            required: 'Vui lòng nhập số điện thoại.'
        },
        address: {
            required: 'Vui lòng nhập địa chỉ.'
        },
        map_api: {
            required: 'Vui lòng nhập google map.'
        },
        logo_name: {
            required: 'Vui lòng chọn logo.'
        },
        head_description: {
            required: 'Vui lòng nhập mô tả 1.'
        },
        detail_description: {
            required: 'Vui lòng nhập mô tả 2.'
        },
        img_detail_name: {
            required: 'Vui lòng chọn hình ảnh.'
        },
    },
    highlight: function (element) {
        $(element).parent().addClass('message-error');
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
        $(element).parent().addClass('message-error');
    },
});
