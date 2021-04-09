@section('content')
<div class="card">
    {{ csrf_field() }}
    <div class="card-header">
    @if (isset($ticket['summary']))
        <h3 class="card-title">Детали заявки: {{$ticket['summary']}}</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-12 col">
                <div class="row">
                    <div class="col-12 col-sm-4">
                        <div class="info-box bg-light">
                            <div class="info-box-content">
                                <span class="info-box-text text-center text-muted">Номер заявки</span>
                                <span class="info-box-number text-center text-muted mb-0">
                                    <a href="#" id="ticket-number">{{ $ticket['number'] }}</a>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-4">
                        <div class="info-box bg-light">
                            <div class="info-box-content">
                                <span class="info-box-text text-center text-muted">Статуст запроса</span>
                                <span class="info-box-number text-center text-muted mb-0">
                                    @if ($ticket['is_closed'])
                                        <span class="badge bg-success">{{$ticket['status']['ru']}}</span>
                                    @else
                                        <span class="badge bg-warning">{{$ticket['status']['ru']}}</span>
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-4">
                        <div class="info-box bg-light">
                            <div class="info-box-content">
                                <span class="info-box-text text-center text-muted">Дата изменения</span>
                                <span class="info-box-number text-center text-muted mb-0">{{gmdate("Y-m-d H:i:s", strtotime($ticket['updated_at']))}} UTC</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <h4>Комменты:</h4>
                        @if (isset($ticket['comments']))
                            @foreach ($ticket['comments'] as $comment)
                            <div class="post">
                                <div class="user-block">
                                    @if ($comment['is_client_author'])
                                    <img class="img-circle img-bordered-sm" src="{{ asset('dist/img/user1-128x128.jpg') }}" alt="user image">
                                    <span class="username">
                                        Мой комментарий
                                    </span>
                                    @else
                                    <img class="img-circle img-bordered-sm" src="{{ asset('dist/img/selectel-icon.jpg') }}" alt="user image">
                                    <span class="username">
                                        Служба поддержки
                                    </span>
                                    @endif
                                    <span class="description">{{gmdate("Y-m-d H:i:s", strtotime($comment['sent_at']))}} UTC</span>
                                </div>
                                <!-- /.user-block -->
                                <p>
                                    {{ $comment['body'] }}
                                </p>

                                <p>
                                    <a href="#" class="link-black text-sm"><i class="fas fa-link mr-1"></i> File..</a>
                                </p>
                            </div>
                            @endforeach
                        @endif
                    </div>
                </div>
                @if (! $ticket['is_closed'])
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="addNewComment">Дополнить запрос</label>
                            <textarea id="addNewComment" class="form-control" rows="4"></textarea>
                        </div>
                        <p>
                            <a href="#" class="link-black text-sm"><i class="fas fa-link mr-1"></i> File..</a>
                        </p>
                    </div>
                    <div class="card-body">
                        <button type="button" class="btn btn-info comment-add-submit">Добавить комментарий</button>
                    @if ($ticket['is_can_be_closed'])
                        <button type="button" class="btn btn-danger ticket-close-submit">Закрыть запрос</button>
                    @endif
                    </div>
                </div>
                @else
                Стутус запроса:
                    @if ($ticket['status']['ru'] == 'Закрыт' or $ticket['status']['ru'] == 'Решен')
                        <span class="badge bg-success">{{$ticket['status']['ru']}}</span>
                    @elseif ($ticket['status']['ru'] =='Отвечен')
                        <span class="badge bg-danger">Ждем от вас ответа</span>
                    @else
                        <span class="badge bg-warning">{{$ticket['status']['ru']}}</span>
                    @endif
                @endif
            </div>
        </div>
    </div>
    @else
        <p style="color: red">
            Неверный <b>токен</b> или не могу подключиться к {{ config('services.api_settings.api_url') }}
        </p>
    @endif

    <!-- /.card-body -->
</div>
<!-- /.card -->

<script>
    $(document).on('click', '.no-methods', function() {
        Toast.fire({
            icon: 'error',
            title: 'Изменение НЕ произведено!',
            footer: 'метод еще в разработке'
        });
    });
</script>

@include('layouts.tickets.close')
@include('layouts.tickets.update')

@endsection
