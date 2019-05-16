$(document).ready(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('change', '.model_select', function () {
        $.ajax({
            method: 'get',
            url: $(this).data('route'),
            data: {id: $(this).val()},
            success: function (response) {
                var options = ["<option>Комплектация</option>"];
                $.each(response, function (key, element) {
                    options.push("<option value='" + element.id + "'>" + element.title + "</option>");
                });
                $('.grade_select').html(options);
            },
            error: function () {
                alert('error');
            }
        });
    });

    $(document).on('change', '.grade_select', function () {
        $('.form_data').hide();
        $('.car_data_card').hide();
        $('.car_data').html('');
        $.ajax({
            method: 'get',
            url: $(this).data('route'),
            data: {grade_id: $(this).val(), car_id: $('.model_select').val()},
            success: function (response) {
                $('.car_data').html(response);
                $('.form_data').show();
                $('.car_data_card').show();
            },
            error: function () {
                alert('error');
            }
        });
    });

    $(document).on('click', '.send_email_btn', function (e) {
        e.preventDefault();
        $.ajax({
            method: 'post',
            url: $(this).data('route'),
            data: {grade_id: $('.grade_select').val(), car_id: $('.model_select').val(), email: $('.email_input').val()},
            success: function () {
                alert('Email sent');
                $('.email_input').val('');
            },
            error: function () {
                alert('error');
            }
        });
    })
});
