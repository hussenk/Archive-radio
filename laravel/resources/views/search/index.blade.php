@extends('layouts.app')
@section('content')
<div>
    <div class="jumbotron jumbotron-fluid div-container-all">

        <div class="container">
            <h1 class="display-4">البحث</h1>


        </div>
    </div>
    <div class="mx-auto pull-right">
        <div class="container">
            <form action="{{ route('search.search') }}" method="post">

                <div class="input-group">
                    <span class="input-group-btn mr-5 mt-1">
                        <button class="btn btn-info" type="submit" title="Search projects">البحث
                            <span class="fas fa-search"></span>
                        </button>
                    </span>
                    <input type="text" class="form-control mr-2" name="key" placeholder="البحث عن مشروع">

                    <span class="input-group-btn">
                        <button class="btn btn-danger" type="button" title="Refresh page">تجديد
                            <span class="fas fa-sync-alt"></span>
                        </button>
                    </span>
                    </a>
                </div>
                @php
                $countbox = 0;
                @endphp
                <h5>الاشارت</h5>

                @if ($tag->count() > 0)

                <div class="form-check">
                    @foreach ($tag as $item)
                    &nbsp; <input class="form-check-input" name="tags[]" type="checkbox" value="{{ $item->id }}">
                    <label class="form-check-label">
                        {{ $item->tag }}</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    @php
                    $countbox++;
                    @endphp
                    @if ($countbox > 10)
                    <br>
                    @php
                    $countbox = 0;
                    @endphp

                    @endif
                    @endforeach

                </div>

                @else
                <div class="alert alert-primary" role="alert">
                    لا يوجد اشارات
                </div>
                @endif

                @php
                $countbox = 0;
                @endphp
                <h5>المعد</h5>

                <div class="container">
                    @if ($preparation->count() > 0)

                    <div class="form-check">
                        @foreach ($preparation as $item)
                        &nbsp; <input class="form-check-input" type="checkbox" name="preparation[]" value="{{ $item->id }}">
                        &nbsp;<label class="form-check-label">{{ $item->name }}</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        @php
                        $countbox++;
                        @endphp
                        @if ($countbox > 10)
                        <br>
                        @php
                        $countbox = 0;
                        @endphp
                        @endif
                        @endforeach
                    </div>
                    @else
                    <div class="alert alert-primary" role="alert">
                        لا يوجد معدين
                    </div>
                    @endif
                </div>
                @php
                $countbox = 0;
                @endphp
                <h5>المقدم</h5>

                <div class="container">
                    @if ($presenter->count() > 0)

                    <div class="form-check">
                        @foreach ($presenter as $item)
                        &nbsp;<input class="form-check-input" type="checkbox" name="presenter[]" value="{{ $item->id }}">
                        &nbsp;<label class="form-check-label">{{ $item->name }}</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        @php
                        $countbox++;
                        @endphp
                        @if ($countbox > 10)
                        <br>
                        @php
                        $countbox = 0;
                        @endphp
                        @endif
                        @endforeach
                    </div>
                    @else
                    <div class="alert alert-primary" role="alert">
                        لا يوجد مقدمين
                    </div>
                    @endif
                </div>


            </form>

        </div>
    </div>
    <table class="table"  dir="rtl">
        <thead>
            <tr>
                <th scope="col" class="color1">#</th>
                <th scope="col" class="color1">اسم ملف</th>

                <th scope="col" class="color1"> تاريخ</th>

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
            @foreach ($file as $item9)

            <tr>
                <th scope="row" class="color2"> {{ ++$i }}</th>


                <td>{{ $item9->title }}</td>
                <td>{{ $item9->user_date }}</td>

                <td>
                    <a class="btn btn-primary" href="{{ route('file.download', ['id' => $item9->id]) }}">تحميل</a>
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
{{-- <div class="container">
        @if ($file->count() > 0)
            <span> {{ $file->links('pagination::bootstrap-4') }} </span>
@endif
</div> --}}
@endsection
