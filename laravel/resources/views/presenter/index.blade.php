@extends('layouts.app')
@section('content')
    <div class="jumbotron jumbotron-fluid div-container-all">
        @foreach ($user->role as $item5) @endforeach
        <div class="container">
            <h1 class="display-4">قائمة المقدمين</h1>
            <strong class="lead">محتوى هذه القائمة </strong>
            <br>
            <a href="{{ route('presenter.create') }}" class="btn btn-success">اضافة جديد</a>
            @if ($item5->id == '3')
                <a href="{{ route('presenter.trashed') }}" class="btn btn-danger">قائمة المحذوفات</a>
            @endif
        </div>
    </div>
    <div class="container">
        <table class="table" dir="rtl">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">اسم المقدم</th>
                    {{-- <th scope="col">عدد تصنيفات الداخليه</th> --}}

                    <th scope="col">الاداء</th>
                </tr>
            </thead>
            @php
                $i = 0;
                
            @endphp

            @if ($presenter->count() > 0)
                <tbody>
                    @foreach ($presenter as $item)
                        <tr>
                            <th scope="row" class="color2"> {{ ++$i }}</th>
                            <td>{{ $item->name }}</td>

                            {{-- <td>
                                {{ where($categorysub->category_id == $item->id)->count() }}
                </td> --}}
                            @if ($item->deleted_at == null)
                                <td>
                                    {{-- <a href="{{ route('tag.show', ['id' => $item->id]) }}" class="btn btn-primary">عرض
                    المحتوى</a> --}}

                                    @if ($item5->id == '3')

                                        <a href="{{ route('presenter.edit', ['id' => $item->id]) }}"
                                            class="btn btn-warning">تعديل</a>

                                        <a href=" {{ route('presenter.destroy', ['id' => $item->id]) }} "
                                            class="btn btn-danger">حذف</a>

                                </td>
                            @endif
                    @endif

                    @if ($item->deleted_at != null)
                        <td>
                            <a href=" {{ route('presenter.restore', ['id' => $item->id]) }} "
                                class="btn btn-danger">استرجاع</a>
                        </td>
                    @endif
                    </tr>
            @endforeach

            <tr>
            @else
                <div class="col">
                    <div class="alert alert-primary" role="alert">
                        قائمة فارغة املأها من <a href="#" class="alert-link">هنا</a>.
                    </div>
                </div>
                @endif
                </tbody>
        </table>
    </div>
    <div class="container">
        <span> {{ $presenter->links('pagination::bootstrap-4') }} </span>

    </div>
@endsection
