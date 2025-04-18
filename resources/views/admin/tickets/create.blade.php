@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Создание билета</h1>
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form action="{{ route('admin.tickets.store') }}" method="POST">
        @csrf
    
        <div class="form-group">
            <label for="schedule_id">Расписание:</label>
            <select name="schedule_id" id="schedule_id" class="form-control" required>
                <option value="">Выберите сеанс</option>
                @foreach ($schedules as $schedule)
                    <option value="{{ $schedule->id }}">
                        {{ $schedule->movie->title }} - 
                        {{ $schedule->formatted_date }} 
                        (Зал: {{ $schedule->hall->name ?? 'Не указан' }})
                    </option>
                @endforeach
            </select>
        </div>
    
        <div class="form-group">
            <label for="hall_seat_id">Место в зале:</label>
            <select name="hall_seat_id" id="hall_seat_id" class="form-control" required disabled>
                <option value="">Сначала выберите сеанс</option>
            </select>
        </div>
    
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Создать билет</button>
        </div>
    </form>
</div>

<script>
    document.getElementById('schedule_id').addEventListener('change', function() {
        const scheduleId = this.value;
        const seatSelect = document.getElementById('hall_seat_id');
    
        if (!scheduleId) {
            seatSelect.innerHTML = '<option value="">Сначала выберите сеанс</option>';
            seatSelect.disabled = true;
            return;
        }
    
        // Подгружаем места через AJAX
        fetch(`/api/schedules/${scheduleId}/seats`)
            .then(response => {
                if (!response.ok) throw new Error('Ошибка загрузки мест');
                return response.json();
            })
            .then(data => {
                if (data.error) {
                    seatSelect.innerHTML = `<option value="">${data.error}</option>`;
                    seatSelect.disabled = true;
                } else {
                    seatSelect.innerHTML = data.map(seat => `
                        <option value="${seat.id}">
                            Ряд ${seat.row}, Место ${seat.seat_number} 
                            (Цена: ${seat.price} руб.)
                        </option>
                    `).join('');
                    seatSelect.disabled = false;
                }
            })
            .catch(error => {
                seatSelect.innerHTML = '<option value="">Ошибка загрузки</option>';
                seatSelect.disabled = true;
            });
    });
    </script>
@endsection