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
                                        {{$ticket['created_at']}}
                                    @elseif ($ticket['status']['ru'] =='Отвечен'
                                        or $ticket['status']['ru'] =='В работе'
                                        or $ticket['status']['ru'] =='Ожидает ответа'
                                        or $ticket['status']['ru'] =='Обрабатывается'
                                        or $ticket['status']['ru'] == 'Решен')
                                        {{$ticket['updated_at']}}
                                    @elseif ($ticket['status']['ru'] == 'Закрыт')
                                        {{$ticket['closed_at']}}
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
            "order": [[ 0, "desc" ]],
            language: {
                search: "Найти:",
                show: "Показать",
                entries: "строк",
                paginate: {
                    first:      "Начало",
                    previous:   "Предыдущая",
                    next:       "Следующая",
                    last:       "Конец"
                },
                lengthMenu:    "Показать по _MENU_ строк",
                info:           "Показано с _START_ по _END_ из _TOTAL_ строк",
                infoEmpty:      "Ничего не найдено",
                infoFiltered:   "(Всего _MAX_ элемент(ов))",
                infoPostFix:    "",
                zeroRecords:    "Нет данных"
            },
            "columnDefs": [{
                targets:3,
                render:function(data){
                    const isoString = new Date(data).toISOString();
                    const ruDate = ISOtoLongDate(isoString, "ru-RU");
                    return `${ruDate}`
                }
            }]
        });
    });


</script>
@endsection
