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
                                        <span class="badge bg-danger">{{$ticket['status']['ru']}}</span>
                                    @else
                                        <span class="badge bg-warning">{{$ticket['status']['ru']}}</span>
                                    @endif
                                </td>
                                <td>{{$ticket['summary']}}</td>
                                <td>{{gmdate("Y-m-d H:i:s", strtotime($ticket['updated_at']))}} UTC</td>
                            </tr>
                        @endforeach
                    @else
                        <p style="color: red">
                            Неверный <b>токен</b> или не могу подключиться к {{ config('services.api_settings.api_url') }}
                        </p>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        let table = $('#tickets-table').DataTable({
            "order": [[ 3, "desc" ]]
        });
    });
</script>
@endsection
