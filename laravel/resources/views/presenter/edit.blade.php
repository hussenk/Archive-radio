@extends('layouts.app')
@section('content')
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4">تعديل اسم المقدم </h1>
            <h3>" {{ $presenter->name }} "</h3>
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
        <form action="{{ route('presenter.update', ['id' => $presenter->id]) }}" method="POST">
            @csrf
            <label style="text-align: center;">ادخل اسم المقدم هنا </label>

            <input type="text" class="form-control" placeholder=' "الاسم اللقب" ' name="name" autocomplete="off">
            <br>
            <button type="submit" class="btn btn-danger">تعديل</button>

        </form>
    </div>
@endsection
