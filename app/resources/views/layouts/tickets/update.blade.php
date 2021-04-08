<script>
    $(document).ready(function () {

        $(document).on('click', '.comment-add-submit', function() {

            let ticket = $('#ticket-number').html();
            let comment = $('#addNewComment').val();

            console.log(comment);

            if (comment.length < 5)
                Toast.fire({
                    icon: 'error',
                    title: 'Так не пойдет!',
                    footer: 'Ошибка: очень короткий коммент'
                });
            else
                $.ajax({
                    type: 'POST',
                    url: '/ticket/'+ticket+'/comments',
                    data: {
                        '_token': $('input[name=_token]').val(),
                        'comment': comment
                    },
                    success: function(response) {
                        console.log(response);

                        if (typeof response['error'] !== 'undefined'){
                            Toast.fire({
                                icon: 'error',
                                title: 'Ошибка!',
                                footer: 'Error: '+response['error']
                            });
                        } else location.reload();
                    },
                    error: function(response) {
                        let errors = response.responseJSON;
                        console.log(errors);
                        Toast.fire({
                            icon: 'error',
                            title: 'Изменение НЕ произведено!',
                            footer: 'Ошибка: '+errors['message']
                        });
                    },
                });
        });
    });
</script>
