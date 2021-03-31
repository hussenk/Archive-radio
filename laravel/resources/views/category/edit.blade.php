@extends('layouts.app')
@section('content')
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4">تعديل اسم التصنيف</h1>
            <h3>" {{ $category->type }} "</h3>
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
        <form action="{{ route('category.update', ['id' => $category->id]) }}" method="POST">
            @csrf
            <label style="text-align: center;">ادخل اسم تصنيف هنا </label>

            <input type="text" class="form-control" placeholder='  "برنامج" "موسيقى"' name="type" autocomplete="off">
            <br>
            <button type="submit" class="btn btn-danger">تعديل</button>

        </form>
    </div>
@endsection
