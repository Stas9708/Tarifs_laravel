<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Homework</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="{{asset('js/scripts.js')}}"></script>
</head>
<body>
<div class="mt-4 ms-0">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="{{ url('/') }}">Tarifs</a>
    </nav>

    <div class="main_block">
        <form id="tarifForm" method="POST" action="{{ route('tarifs.store') }}">
            @csrf
            <div class="w-50" id="tarifContainer">
                <div class="input-group mt-2">
                    <select class="form-select tarifSelect" name="tarifs[]" aria-label="Выбор тарифа">
                        <option selected disabled>Выберите тариф</option>
                        @for($i = 0; $i < count($tarifs); $i++)
                            <option value="{{ $tarifs[$i]['id'] }}" data-price="{{$tarifs[$i]['price']}}">
                                {{ $tarifs[$i]['name'] }} - {{ $tarifs[$i]['price'] }} {{ $tarifs[$i]['unit'] }}
                            </option>
                        @endfor
                    </select>
                    <input type="text" class="form-control valueInput" name="values[]" placeholder="Введите значение">
                    <input type="text" class="form-control output" name="prices[]" readonly>
                    <button type="button" class="btn btn-danger removeBtn">Удалить</button>
                </div>
            </div>


            <div>
                <button type="button" id="addBtn" class="btn btn-primary mt-2">Добавить</button>
                <button type="submit" id="submitBtn" class="btn btn-success mt-2">Отправить</button>
            </div>
            @if(count($errors) > 1)
                <div>
                    @foreach($errors as $error)
                        <h5 style="color: red;">{{$error}}</h5>
                    @endforeach
                </div>
            @elseif(count($errors) == 1)
                <div>
                    <h5 style="color: green">{{$errors[0]}}</h5>
                </div>
            @endif
        </form>
</div>
</div>
<script>
    $(document).ready(function () {

        $('#addBtn').on('click', function () {
            const newBlock = `
            <div class="input-group mt-2">
            <select class="form-select tarifSelect" name="tarifs[]" aria-label="Выбор тарифа">
                <option selected disabled>Выберите тариф</option>
                @for($i = 0; $i < count($tarifs); $i++)
                    <option value="{{ $tarifs[$i]['id'] }}" data-price="{{$tarifs[$i]['price']}}">
                        {{ $tarifs[$i]['name'] }} - {{ $tarifs[$i]['price'] }} {{ $tarifs[$i]['unit'] }}
                    </option>
                @endfor
            </select>
    <input type="text" class="form-control valueInput" name="values[]" placeholder="Введите значение">
    <input type="text" class="form-control output" name="prices[]" readonly>
    <button type="button" class="btn btn-danger removeBtn">Удалить</button>
</div>
`;
            $('#tarifContainer').append(newBlock);
        });

        });

</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
