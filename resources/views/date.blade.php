<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Выбор даты</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<form method="POST" action="{{ route('table.store') }}" class="d-flex align-items-center gap-2">
    @csrf
    <select id="date_from" name="date_from"  class="form-select form-select-sm w-auto" onchange="filterToDates()">
        <option selected disabled>Выберете дату "c"</option>
        @foreach($dates as $date)
            <option>{{$date}}</option>
        @endforeach
    </select>
    <select id="date_to" name="date_to"  class="form-select form-select-sm w-auto">
        <option selected disabled>Выберите дату "по"</option>
        @foreach($dates as $date)
            <option value="{{$date}}"></option>
        @endforeach
    </select>
    <button type="submit" class="btn btn-success btn-sm">Поиск</button>
</form>
<script>
    const allDates = [
        @foreach($dates as $date)
            "{{$date}}",
        @endforeach
    ];

    function filterToDates() {
        const dateFromValue = document.getElementById('date_from').value;
        const dateToSelect = document.getElementById('date_to');
        dateToSelect.innerHTML = '<option selected disabled>Выберите дату "по"</option>';
        const filteredDates = allDates.filter(date => date > dateFromValue);
        filteredDates.forEach(date => {
            const option = document.createElement('option');
            option.value = date;
            option.textContent = date;
            dateToSelect.appendChild(option);
        });
    }
</script>
</body>
</html>
