"use strict";
$("#form-update").validate({
    rules: {
        name: {
            required: true
        },
        num_sort: {
            required: true,
            digits: true,
        },
    },
    messages: {
        name: {
            required: 'Vui lòng nhập tên danh mục.',
        },
        num_sort: {
            required: 'Vui lòng nhập vị trí sắp xếp.',
            digits: 'Vị trí phải là số nguyên.',
            maxlength: 'Vui lòng nhập số có tối đa 10 chữ số.'
        }
    },
    highlight: function (element) {
        $(element).parent().addClass('message-error');
    },
});

$("#form-add-category").validate({
    rules: {
        name: {
            required: true
        },
        num_sort: {
            required: true,
            digits: true,
        },
    },
    messages: {
        name: {
            required: 'Vui lòng nhập tên danh mục.',
        },
        num_sort: {
            required: 'Vui lòng nhập vị trí sắp xếp.',
            digits: 'Vị trí phải là số nguyên.',
            maxlength: 'Vui lòng nhập số có tối đa 10 chữ số.'
        }
    },
    highlight: function (element) {
        $(element).parent().addClass('message-error');
    },
});
