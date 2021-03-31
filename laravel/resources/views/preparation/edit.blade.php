@extends('layouts.app')
@section('content')

    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4">تعديل اسم المعد </h1>
            <h3>" {{ $preparation->name }} "</h3>
            <p class="lead"></p>
        </div>
    </div>
    <div class="container">
        @if (count($errors) > 0)
            <ul>
                @foreach ($errors->all() as $item)
                    <li>
                        {{ $item }}
                    </li>
                @endforeach
            </ul>

        @endif
    </div>
    <div class="container">
        <form action="{{ route('preparation.update', ['id' => $preparation->id]) }}" method="POST">
            @csrf
            <label style="text-align: center;">ادخل اسم المعد جديد </label>

            <input type="text" class="form-control" placeholder='  "الاسم واللقب"' name="name" autocomplete="off">
            <br>
            <button type="submit" class="btn btn-danger">تعديل</button>

        </form>
    </div>
@endsection
