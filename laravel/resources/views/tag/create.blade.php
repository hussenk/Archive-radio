@extends('layouts.app')
@section('content')

<div class="jumbotron jumbotron-fluid div-container-all">
    <div class="container">
        <h1 class="display-4">اضافة اشارة جديد</h1>
        <p class="lead"></p>
    </div>
</div>
<div class="container ulfilde">
    @if (count($errors) > 0)
    <ul class="">
        @foreach ($errors->all() as $item)
        <li>
            {{ $item }}
        </li>
        @endforeach
    </ul>

    @endif
</div>
<div class="container">
    <form action="{{ route('tag.store') }}" method="POST">
        @csrf
        <label style="text-align: center;">ادخل اسم الاشارة</label>

        <input type="text" class="form-control" placeholder='  "صحي" "قديم" "صباحي" "عربي"' name="tag" autocomplete="off">
        <br>
        <button type="submit" class="btn btn-danger">اضافة</button>

    </form>
</div>
@endsection