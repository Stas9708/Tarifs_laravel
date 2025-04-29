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
    <label>Введите дату "с"</label><br>
    <input type="date" id="date_from" name="date_from"  class="form-select form-select-sm w-auto">
    <label>Введите дату "по"</label><br>
    <input type="date" id="date_to" name="date_to"  class="form-select form-select-sm w-auto">
    <button type="submit" class="btn btn-success btn-sm">Поиск</button>
</form>

@if($dates && $perPage)
<table class="table table-bordered">
    <thead>
    <tr>
        <th>#</th>
        <th>Название тарифа</th>
        <th>Стоимость</th>
        <th>Количество</th>
        <th>Дата создания</th>
    </tr>
    </thead>
    <tbody>
    @foreach($dates as $date)
        <tr>
            <td>{{ $date->id }}</td>
            <td>{{ $date->tarif->name }}</td>
            <td>{{ $date->price }}</td>
            <td>{{ $date->unit_points }}</td>
            <td>{{ $date->created_at }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
<form method="GET" action="{{ route('table.paginate') }}" class="row mb-3 align-items-center">
    <div class="col-auto">
        <label for="perPage" class="form-label mb-0 me-2">Показать</label>
    </div>
    <div class="col-auto">
        <select name="perPage" id="perPage" class="form-select" onchange="this.form.submit()">
            <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>
            <option value="20" {{ $perPage == 20 ? 'selected' : '' }}>20</option>
            <option value="30" {{ $perPage == 30 ? 'selected' : '' }}>30</option>
            <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>50</option>
            <option value="100" {{ $perPage == 100 ? 'selected' : '' }}>100</option>
        </select>
    </div>
</form>
    {{$dates->links()}}
@endif
</body>
</html>
