<script>
    $(document).ready(function () {
        let ticket = $('#ticket-number').html();

        $(document).on('click', '.ticket-close-submit', function() {
            Swal.fire({
                title: 'Уверенно ?',
                text: "Закрываем " + ticket,
                footer: 'После закрытия, Вы не сможете добавить коммент',
                icon: 'warning',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                denyButtonColor: '#3085d9',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Закрыть и +10',
                denyButtonText: 'Закрыть'
            }).then((result) => {
                if (result.isDenied) {
                    $.ajax({
                        type: 'POST',
                        url: '/ticket/'+ticket+'/close',
                        data: {
                            '_token': $('input[name=_token]').val(),
                        },
                        success: function(response) {
                            if (typeof response['error'] !== 'undefined')
                                Toast.fire({
                                    icon: 'error',
                                    title: 'Ошибка!',
                                    footer: 'Error: '+response['error']
                                });
                            else location.reload();
                        },
                        error: function(response) {
                            let errors = response.responseJSON;
                            Toast.fire({
                                icon: 'error',
                                title: 'Изменение НЕ произведено!',
                                footer: 'Ошибка: '+errors['message']
                            });
                        },
                    });
                }
                else if (result.isConfirmed) {
                    $.ajax({
                        type: 'POST',
                        url: '/ticket/'+ticket+'/close',
                        data: {
                            '_token': $('input[name=_token]').val(),
                            'score': '10'
                        },
                        success: function(response) {
                            if (typeof response['error'] !== 'undefined')
                                Toast.fire({
                                    icon: 'error',
                                    title: 'Ошибка!',
                                    footer: 'Error: '+response['error']
                                });
                            else location.reload();
                        },
                        error: function(response) {
                            let errors = response.responseJSON;
                            console.log('+10: ' + errors);
                            Toast.fire({
                                icon: 'error',
                                title: 'Изменение НЕ произведено!',
                                footer: 'Ошибка: '+errors['message']
                            });
                        },
                    });
                }
            });
        });
    });
</script>
