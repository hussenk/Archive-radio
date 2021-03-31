@extends('layouts.app')
@section('content')

    <div class="jumbotron jumbotron-fluid div-container-all">
        @foreach ($user->role as $item5) @endforeach
        <div class="container">
            <h1 class="display-4">قائمة المعدين </h1>

            {{-- link to create preparation --}}


            <strong style="font-size: 15px;">محتوى هذا القائمة </strong>
            <br>
            <a href="{{ route('preparation.create') }}" class="btn btn-success">اضافة جديد</a>

            @if ($item5->id == '3')
                {{-- link to trash --}}

                <a href="{{ route('preparation.trashed') }}" class="btn btn-danger">قائمة المحذوفات</a>
            @endif

        </div>
    </div>
    <div class="container">
        <table class="table" dir="rtl">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">اسم المعد</th>
                    <th scope="col">الاداء</th>
                </tr>
            </thead>
            @php
                $i = 0;
                
            @endphp

            @if ($preparation->count() > 0)
                <tbody>
                    @foreach ($preparation as $item)
                        <tr>
                            <th scope="row" class="color2"> {{ ++$i }}</th>
                            <td>{{ $item->name }}</td>


                            @if ($item->deleted_at == null)
                                <td>
                                    @if ($item5->id == '3')
                                        {{-- link to edit --}}
                                        <a href="{{ route('preparation.edit', ['id' => $item->id]) }}"
                                            class="btn btn-warning">تعديل</a>
                                        {{-- link to delete --}}
                                        <a href=" {{ route('preparation.destroy', ['id' => $item->id]) }} "
                                            class="btn btn-danger">حذف</a>

                                </td>
                            @endif
                    @endif

                    @if ($item->deleted_at != null)
                        <td>
                            {{-- link to restoe deleted ones --}}
                            <a href=" {{ route('presenter.restore', ['id' => $item->id]) }} "
                                class="btn btn-danger">استرجاع</a>
                        </td>
                    @endif
                    </tr>
            @endforeach

            <tr>
            @else
                <div class="col">
                    {{-- if tabel empity --}}
                    <div class="alert alert-primary" role="alert">
                        قائمة فارغة عبيها من <a href="#" class="alert-link">هنا</a>.
                    </div>
                </div>
                @endif
                </tbody>
        </table>
    </div>
    <div class="container">
        {{-- links if the list more than 10 --}}
        <span> {{ $preparation->links('pagination::bootstrap-4') }} </span>

    </div>
@endsection
