@extends('layouts.app')
@section('content')
<div class="jumbotron jumbotron-fluid div-container-all">
    <div class="container">
        <h1>المستخدم </h1>
        <h2>{{ $calledUser->name }}</h2>
        {{-- <b>اضافة جديد</b>
            <a href="{{ route('categorysub.create') }}" class="btn btn-success">هنا</a> --}}
    </div>
</div>


<form action="{{ route('role.userRole', ['id' => $calledUser->id]) }}" method="POST">
    @csrf
    <div style="text-align: center;">
        <button type="submit" class="btn btn-primary" style="margin-right: 75%">تعديل</button>
        <div class="form-check form-check-inline">
            @foreach ($role as $item)
            <input class="form-check-input" type="checkbox" name="role[]" value="{{ $item->id }}" @foreach ($calledUser->role as $item2) @if ($item->id==$item2->id)
            checked @endif
            @endforeach
            >
            <label class="form-check-label"> {{ $item->title }} </label>&nbsp;&nbsp;
            @endforeach
        </div>

    </div>
    <br>

</form>



<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">نوع</th>

            <th scope="col"> تاريخ</th>

            <th scope="col">تفاصيل</th>


        </tr>
    </thead>
    @php
    $i = 0;
    @endphp
    @if ($log->count() > 0)
    <tbody>
        @foreach ($log as $item)

        <tr>
            <th scope="row"> {{ ++$i }}</th>
            <td>{{ $item->action }}</td>
            <td> {{ $item->created_at }}</td>
            <td> {{ $item->description }}</td>
        </tr>
        @endforeach

        <tr>
            @else
            <div class="col">
                <div class="alert alert-primary" role="alert">
                    قائمة فارغة عبيها من <a href="#" class="alert-link">هنا</a>.
                </div>
            </div>
            @endif
    </tbody>
</table>
</div>
<div class="container">
    {{-- @if ($file->count() > 0)
            <span> {{ $file->links('pagination::bootstrap-4') }} </span>
    @endif --}}
</div>
@endsection