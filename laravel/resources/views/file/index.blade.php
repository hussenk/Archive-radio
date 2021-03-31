@extends('layouts.app')

@section('content')

    <div class="jumbotron jumbotron-fluid div-container-all ">
        <div class="container">
            <h1 class="display-4">قائمة اضافة ملف جديد</h1>
            <p class="lead">محتوى هذا القائمة </p>
        </div>
    </div>

    <div class="container">
        <table class="table" dir="rtl">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">اسم تصنيف</th>

                    <th scope="col">اضافة</th>
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

                            {{-- <td>
                                {{ where($categorysub->category_id == $item->id)->count() }}
                </td> --}}
                            <td><a href="/file/{{ $item->id }}" class="btn btn-success">اضافة</a></td>
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
