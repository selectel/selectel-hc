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
                    <div class="col col-md-3">
                        <div class="info-box bg-light">
                            <div class="info-box-content">
                                <span class="info-box-text text-center text-muted">Номер заявки</span>
                                <span class="info-box-number text-center text-muted mb-0">
                                    <a href="#" id="ticket-number">{{ $ticket['number'] }}</a>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col col-md-3">
                        <div class="info-box bg-light">
                            <div class="info-box-content">
                                <span class="info-box-text text-center text-muted">Статуст запроса</span>
                                <span class="info-box-number text-center text-muted mb-0">
                                    @if ($ticket['status']['ru'] == 'Закрыт' or $ticket['status']['ru'] == 'Решен')
                                        <span class="badge bg-success">{{$ticket['status']['ru']}}</span>
                                    @elseif ($ticket['status']['ru'] =='Отвечен')
                                        <span class="badge bg-danger">Ждем от вас ответа</span>
                                    @else
                                        <span class="badge bg-warning">{{$ticket['status']['ru']}}</span>
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col col-md-3">
                        <div class="info-box bg-light">
                            <div class="info-box-content">
                                @if ($ticket['status']['ru'] =='Создан')
                                    <span class="info-box-text text-center text-muted">Дата создания</span>
                                    <span class="info-box-number text-center text-muted mb-0 my-time-label">{{$ticket['created_at']}}</span>
                                @elseif ($ticket['status']['ru'] =='Отвечен'
                                    or $ticket['status']['ru'] =='В работе'
                                    or $ticket['status']['ru'] =='Ожидает ответа'
                                    or $ticket['status']['ru'] =='Обрабатывается'
                                    or $ticket['status']['ru'] == 'Решен')
                                    <span class="info-box-text text-center text-muted">Дата изменения</span>
                                    <span class="info-box-number text-center text-muted mb-0 my-time-label">{{$ticket['updated_at']}}</span>
                                @elseif ($ticket['status']['ru'] == 'Закрыт')
                                    <span class="info-box-text text-center text-muted">Дата закрытия</span>
                                    <span class="info-box-number text-center text-muted mb-0 my-time-label">{{$ticket['closed_at']}}</span>
                                @else
                                    <span class="info-box-number text-center text-muted mb-0">unknown status</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col col-md-3">
                        <div class="info-box bg-light">
                            <div class="info-box-content">
                                <span class="info-box-text text-center text-muted">Уведомление на</span>
                                <span class="info-box-number text-center text-muted mb-0">@if (isset($ticket['client_emails'][0])) {{$ticket['client_emails'][0]}} @else <не указано> @endif</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <h4>Комменты:</h4>
                    <div class="col-12">
                        @if (isset($ticket['comments']))
                            @foreach ($ticket['comments'] as $comment)
                                <div class="post">
                                    <span class="post">
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
                                            <span class="description my-time-label">{{$comment['sent_at']}}</span>
                                        </div>
                                        <!-- /.user-block -->
                                        <p>
                                            <pre style="font-family: Verdana, Geneva, sans-serif; font-size: small">{{ $comment['body'] }}</pre>
                                        </p>
                                    </span>
                                </div>
    {{--                                <p>--}}
    {{--                                    <a href="#" class="link-black text-sm"><i class="fas fa-link mr-1"></i> File..</a>--}}
    {{--                                </p>--}}

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
{{--                        <p>--}}
{{--                            <a href="#" class="link-black text-sm"><i class="fas fa-link mr-1"></i> File..</a>--}}
{{--                        </p>--}}
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
    $(document).ready(function () {
        const time = document.querySelectorAll('.my-time-label');

        time.forEach(element => {
            const isoString = new Date(element.textContent).toISOString();
            const ruDate = ISOtoLongDate(isoString, "ru-RU");
            element.textContent =  `${ruDate}`;
        })
    });

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
