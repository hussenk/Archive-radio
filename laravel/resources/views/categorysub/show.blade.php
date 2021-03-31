@extends('layouts.app')
@section('content')
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4">قائمة {{ $categorysub->title }}</h1>
            <p class="lead">{{ $categorysub->description }} </p>
            {{-- <b>اضافة جديد</b>
            <a href="{{ route('categorysub.create') }}" class="btn btn-success">هنا</a> --}}
        </div>
    </div>
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">اسم ملف</th>

                    <th scope="col"> تاريخ</th>

                    {{-- <th scope="col">عدد تصنيفات الداخليه</th>
                    --}}

                    <th scope="col">الاداء</th>
                </tr>
            </thead>
            @php
            $i = 0 ;
            @endphp
            @if ($file->count() > 0)
                <tbody>
                    @foreach ($file as $item)

                        <tr>
                            <th scope="row"> {{ ++$i }}</th>


                            <td>{{ $item->title }}</td>
                            <td>{{ $item->user_date }}</td>

                            <td>
                                <a class="btn btn-primary"
                                    href="{{ route('file.download', ['id' => $item->id]) }}">تحميل</a>
                                @foreach ($user->role as $item2)
                                    @if ($item2->id == '3')

                                        <a href="{{ route('file.edit', ['id' => $item->id, 'category_id' => $item->category_id]) }}"
                                            class="btn btn-warning">تعديل</a>
                                        <a href="" class="btn btn-danger">حذف</a>
                                    @endif
                                @endforeach
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
    <div class="container">
        @if ($file->count() > 0)
            <span> {{ $file->links('pagination::bootstrap-4') }} </span>
        @endif
    </div>
@endsection
