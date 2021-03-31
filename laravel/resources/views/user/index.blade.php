@extends('layouts.app')
@section('content')

    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4">قائمة المهام </h1>
            <p class="lead"> </p>
            <b>اضافة مهمة جديدة</b>
            <a href="{{ route('role.create') }}" class="btn btn-success">هنا</a>
        </div>
    </div>

    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">اسم المهمة</th>
                    <th scope="col">الاداء</th>
                </tr>
            </thead>
            @php
            $i = 0 ;

            @endphp

            @if ($role->count() > 0)
                <tbody>
                    @foreach ($role as $item)
                        <tr>
                            <th scope="row"> {{ ++$i }}</th>
                            <td>{{ $item->title }}</td>

                            {{-- <td>
                                {{ where($categorysub->category_id == $item->id)->count() }}
                            </td> --}}
                            <td>
                                <a href="{{ route('role.edit', ['id' => $item->id]) }}" class="btn btn-warning">تعديل</a>
                                <a href=" {{ route('role.destroy', ['id', $item->id]) }} " class="btn btn-danger">حذف</a>
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
