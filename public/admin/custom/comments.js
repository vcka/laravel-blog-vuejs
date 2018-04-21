$(document).ready(function () {


    $(document).on('change', '.checkbox_approved:checkbox', function () {        
        var id = parseInt($(this).attr('data-id'));
        var status = parseInt($(this).attr('data-status'));
        var newStaus = (status === 1) ? 0 : 1;
        $(this).attr('data-status', newStaus);
        var serializedData = {
            id: id,
            status: newStaus,
            _token: _token
        };
        $.post('approved', serializedData, function (response) {
            if (typeof response.response_status !== 'undefined' && response.response_status === 'success') {
                $('#message').html('<div class="alert alert-success"><strong>Success! </strong>' + response.message + '</div>');
            } else {
                $('#message').html('<div class="alert alert-danger"><strong>Danger! </strong>' + response.message + '</div>');
            }
            setTimeout(function () {
                $('#message').html('');
            }, 2000);
        }, "json");
    });

});