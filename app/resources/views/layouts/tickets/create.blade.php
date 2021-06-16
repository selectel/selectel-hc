<!-- /ticket-create-modal -->
<div class="modal fade" id="ticket-create-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Создание запроса</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-horizontal" role="modal">
                <div class="modal-body">
                    <div class="col-12">
                        <div class="form-group">
                            <label>Кратко запрос</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="ticket-name" name="ticket-name">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-check-circle"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="crate-comment">Подробно опишите проблему</label>
                            <textarea id="create-comment" class="form-control" rows="4"></textarea>
                        </div>
{{--                        <p>--}}
{{--                            <a href="#" class="link-black text-sm"><i class="fas fa-link mr-1"></i> File..</a>--}}
{{--                        </p>--}}
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="submit" class="btn btn-success create-ticket-submit" data-dismiss="modal">Открыть</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Я передумал</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /ticket-create-modal end -->

<script>
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 4000
    });

    $(document).ready(function () {
        $(document).on('click', '.ticket-create-modal-show', function() {
            $('#ticket-create-modal').modal('show');
        });

        $(document).on('click', '.create-ticket-submit', function() {
            let ticket_name = $('#ticket-name').val();
            let comment = $('#create-comment').val();

            if (ticket_name.length < 5 ||  comment.length < 5)
                Toast.fire({
                    icon: 'error',
                    title: 'Так не пойдет!',
                    footer: 'Ошибка: очень мало текста'
                });
            else
                $.ajax({
                    type: 'POST',
                    url: '/ticket/new',
                    data: {
                        '_token': $('input[name=_token]').val(),
                        'ticket_name': ticket_name,
                        'comment': comment
                    },
                    success: function(response) {
                        console.log(response);
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

