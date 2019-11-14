import $ from "jquery";

$('tbody').on('click', '.delete', function(e){
    e.preventDefault();
    if (confirm('Are you sure you want to removed this?')) {
        $(this).parents('tr').remove();
        let url = $(this).attr('href');
        del(url);

        function del(url) {
            $.ajax({
                type: 'DELETE',
                url: url
            }).done(function (data) {
                $(this).parents('tr').remove();
                $('#id').remove();
            }).fail(function () {
                alert('Could not be deleted');
            });
        }
    }
});