$(document).ready(function () {
    $('#shortenForm').on('submit', function (e) {
        e.preventDefault();
        const $fullUrl = $('#urlInput').val();

        $.ajax({
            type: 'POST',
            url: '/api/url/shorten_url',
            data: {
                full_url: $fullUrl,
                _token: '{{ csrf_token() }}'
            },
            success: function (response) {
                $('#shortenedUrl').text(response.short_url);
            },
            error: function(xhr, status, error) {
                const errorMessage = JSON.parse(xhr.responseText).errors.full_url;
                console.log(xhr.responseText)
                alert('Error: ' + errorMessage);
            }
        });
    });
});
