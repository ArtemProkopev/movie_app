@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <h2>Билеты</h2>
        <a href="{{ route('admin.tickets.create') }}" class="btn btn-primary">Добавить билет</a>

        <table class="table mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Расписание</th>
                    <th>Место</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tickets as $ticket)
                    <tr>
                        <td>{{ $ticket->id }}</td>
                        <td>{{ $ticket->schedule_id }}</td>
                        <td>{{ $ticket->hall_seat_id }}</td>
                        <td>
                            <a href="{{ route('admin.tickets.edit', $ticket) }}" class="btn btn-warning">Редактировать</a>
                            <form action="{{ route('admin.tickets.destroy', $ticket) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Удалить</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
