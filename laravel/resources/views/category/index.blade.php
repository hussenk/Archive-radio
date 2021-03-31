@extends('layouts.app')
@section('content')

    <head>
        <link rel="stylesheet" href="{{ asset('css/newcss.css') }}">
    </head>

    <div class="jumbotron jumbotron-fluid div-container-all">
        <div class="container">
            <h1 class="display-4">قائمة التصنيفات الاساسية</h1>
            <p class="lead">محتوى هذا القائمة </p>


            <a href="{{ route('category.create') }}" class="btn btn-success">اضافة جديد</a>


        </div>

    </div>


    <div class="container">
        <table class="table" dir="rtl">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">اسم تصنيف</th>
                    <th scope="col">الاداء</th>
                </tr>
            </thead>
            @php
                $i = 0;
                
            @endphp

            @if ($category->count() > 0)
                <tbody>
                    @foreach ($category as $item)
                        <tr>
                            <th scope="row" class="color2"> {{ ++$i }}</th>
                            <td>{{ $item->type }}</td>

                            <td>
                                <a href="{{ route('category.showcategorysub', ['category_id' => $item->id]) }}"
                                    class="btn btn-primary">عرض المحتوى</a>


                                @foreach ($user->role as $item5)
                                    @if ($item5->id == '5')
                                        <a href="{{ route('category.edit', ['id' => $item->id]) }}"
                                            class="btn btn-warning">تعديل</a>
                                        {{-- <a href=" {{ route('category.destroy', ['id', $item->id]) }} "
                    class="btn btn-danger">حذف</a> --}}

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
        <span> {{ $category->links('pagination::bootstrap-4') }} </span>

    </div>
@endsection
