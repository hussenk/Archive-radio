@extends('layouts.app')

@section('content')
    @foreach ($user->role as $item5) @endforeach
    <div class="jumbotron jumbotron-fluid div-container-all">
        <div class="container">
            <h1 class="display-4">قائمة التصنيفات فرعيه</h1>
            <strong class="lead">محتوى هذا القائمة </strong>

            <br>
            <a href="{{ route('categorysub.create') }}" class="btn btn-success">اضافة جديد</a>

            @if ($item5->id == '3')

                <a href="{{ route('categorysub.trashed') }}" class="btn btn-danger">قائمة المحذوفات</a>
            @endif
        </div>
    </div>


    <div class="container">
        <table class="table" dir="rtl">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">اسم ملف</th>
                    <th scope="col">يتبع لتصنيف</th>

                    {{-- <th scope="col">عدد تصنيفات الداخليه</th> --}}

                    <th scope="col">الاداء</th>
                </tr>
            </thead>
            @php
                $i = 0;
            @endphp
            @if ($categorysub->count() > 0)
                <tbody>
                    @foreach ($categorysub as $item)
                        <tr>
                            <th scope="row" class="color2"> {{ ++$i }}</th>

                            <td>{{ $item->title }}</td>
                            @foreach ($category as $item2)
                                @if ($item->category_id == $item2->id)
                                    <td>{{ $item2->type }}</td>
                                @endif
                            @endforeach


                            @if ($item->deleted_at == null)
                                <td>
                                    <a href="{{ route('categorysub.show', ['id' => $item->id]) }}"
                                        class="btn btn-primary">عرض
                                        المحتوى</a>

                                    @if ($item5->id == '3')

                                        <a href="{{ route('categorysub.edit', ['id' => $item->id]) }}"
                                            class="btn btn-warning">تعديل</a>

                                        <a href=" {{ route('categorysub.destroy', ['id' => $item->id]) }} "
                                            class="btn btn-danger">حذف</a>

                                </td>
                            @endif
                    @endif

                    @if ($item->deleted_at != null)
                        <td>
                            <a href=" {{ route('categorysub.restore', ['id' => $item->id]) }} "
                                class="btn btn-danger">استرجاع</a>
                        </td>
                    @endif

                    </tr>
            @endforeach


        @else
            <tr>
                <div class="col">
                    <div class="alert alert-primary" role="alert">
                        قائمة فارغة عبيها من <a href="#" class="alert-link">هنا</a>.
                    </div>
                </div>
            </tr>
            @endif
            </tbody>
        </table>
    </div>
    <div class="container">
        <span> {{ $categorysub->links('pagination::bootstrap-4') }} </span>

    </div>

@endsection
