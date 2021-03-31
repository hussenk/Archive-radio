@extends('layouts.app')
@section('content')

    <div class="jumbotron jumbotron-fluid div-container-all">
        <div class="container">
            <h1 class="display-4">قائمة المستخدمين </h1>
            <p class="lead"> </p>
            {{-- <a href="{{ route('role.create') }}" class="btn btn-success">هنا</a> --}}
        </div>

    </div>

    <div class="container">
        <table class="table" dir="rtl">
            <thead>
                <tr>
                    <th scope="col" class="colorv1">#</th>
                    <th scope="col" class="colorv1">اسم المستخدم</th>
                    <th scope="col" class="colorv1">الاداء</th>
                </tr>
            </thead>
            @php
                $i = 0;
            @endphp

            @if ($user->count() > 0)
                <tbody>
                    @foreach ($user as $item)
                        <tr>
                            <th scope="row" class="color2"> {{ ++$i }}</th>
                            <td>{{ $item->name }}</td>
                            <td>

                                <a href="{{ route('role.show', ['id' => $item->id]) }}" class="btn btn-primary">عرض
                                    المستخدم</a>

                                {{-- <a href="{{ route('role.edit', ['id' => $item->id]) }}"
                    class="btn btn-warning">تعديل</a>
                    <a href=" {{ route('role.destroy', ['id', $item->id]) }} " class="btn btn-danger">حذف</a> --}}
                            </td>
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

@endsection
