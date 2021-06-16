@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Список заявок</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="tickets-table" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Стутус</th>
                        <th>Суть</th>
                        <th>Изменен</th>
                    </tr>
                    </thead>
                    {{ csrf_field() }}
                    <tbody>
                    @if (isset($tickets))
                        @foreach ($tickets as $ticket)
                            <tr>
                                <td><a href="/ticket/{{$ticket['number']}}">{{$ticket['number']}}</a></td>
                                <td>
                                    @if ($ticket['status']['ru'] == 'Закрыт' or $ticket['status']['ru'] == 'Решен')
                                        <span class="badge bg-success">{{$ticket['status']['ru']}}</span>
                                    @elseif ($ticket['status']['ru'] =='Отвечен')
                                        <span class="badge bg-danger">Ждем от вас ответа</span>
                                    @else
                                        <span class="badge bg-warning">{{$ticket['status']['ru']}}</span>
                                    @endif
                                </td>
                                <td>{{$ticket['summary']}}</td>
                                <td>
                                    @if ($ticket['status']['ru'] =='Создан')
                                        <span class="time-label-rows">{{$ticket['created_at']}}></span>
                                    @elseif ($ticket['status']['ru'] =='Отвечен' or $ticket['status']['ru'] =='В работе' or $ticket['status']['ru'] =='Ожидает ответа' or $ticket['status']['ru'] =='Обрабатывается')
                                        <span class="time-label-rows">{{$ticket['updated_at']}}></span>
                                    @elseif ($ticket['status']['ru'] == 'Закрыт' or $ticket['status']['ru'] == 'Решен')
                                        <span class="time-label-rows">{{$ticket['closed_at']}}</span>
                                    @else
                                    unknown status
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <p style="color: red">
                            Неверный <b>токен</b> или не могу подключиться к {{ config('services.api_settings.api_url') }}
                        </p>
                    @endif
                    </tbody>
                </table>
                <table class="table table-bordered">
                    <tr>
                        <th><div><b>Легенда:</b></div></th>
                    </tr>
                    <td>
                        <div><span class="badge bg-success">Такой цвет</span><span> - Запрос закрыт или решен</span></div>
                        <div><span class="badge bg-warning">Такой цвет</span><span> - Мяч на сторона СП, ожидаем</span></div>
                        <div><span class="badge bg-danger">Такой цвет</span><span> - СП ждет реакции от вас</span></div>

                    </td>
                </table>
            </div>
        </div>
    </div>
</div>

<script>

    $(document).ready(function () {
        $('#tickets-table').DataTable({
            "order": [[ 3, "desc" ]]
        });

        // TODO перебрать все даты и модифицировать с учетом TZ
        // let cells = Array.prototype.slice.call(document.querySelectorAll('.time-label-rows'));
        // const time = document.querySelectorAll('.time-label');

        // table.before().cells.forEach(element => {
        //     const isoString = new Date(element.textContent).toISOString();
        //     const ruDate = ISOtoLongDate(isoString, "ru-RU");
        //     element.textContent =  `${ruDate}`;
        //     // console.log((element.textContent));
        // })
    });


</script>
@endsection
