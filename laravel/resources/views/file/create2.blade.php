@extends('layouts.app')
@section('content')

<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <h1 class="display-4">رفع ملف الي {{ $category->type }}</h1>
        <p class="lead"> </p>
    </div>
</div>



<div class="row">


    <div class="container">
        <div class="col">

            @if (count($errors) > 0)
            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach ($errors->all() as $item)
                    <li>
                        {{ $item }}
                    </li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form action="{{ route('file.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>اسم الملف</label>
                    <input type="text" class="form-control" name="title" placeholder="مثال : الشباب_و_الرياضة_1" autocomplete="off">
                </div>
                <div class="form-group">
                    <label> ينضم الي {{ $category->type }}</label> &nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp; <input class="form-check-input" name="category_id" value="{{ $category->id }}" readonly type="hidden">
                </div>

                <div class="form-group">
                    <label>تصنيف الفرعي</label>
                    <select multiple class="form-control" name="category_sub_id">
                        <option disabled="true" selected="true">اختار</option>
                        @foreach ($categorysub as $item)
                        <option value="{{ $item->id }}">{{ $item->title }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group row">
                    <label class="col-2 col-form-label">تاريخ</label>
                    <div class="col-10">
                        <input class="form-control" type="date" max="2030-12-31" min="2017-01-01" name="user_date">
                    </div>
                </div>
                <div class="form-group">
                    <label>الوصف</label>
                    <textarea class="form-control" name="description" rows="3" autocomplete="off"></textarea>
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
                    $countbox++ ;
                    @endphp
                    @if ($countbox > 10)
                    <br>
                    @php
                    $countbox = 0 ;
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
                        $countbox++ ;
                        @endphp
                        @if ($countbox > 10)
                        <br>
                        @php
                        $countbox = 0 ;
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
                        $countbox++ ;
                        @endphp
                        @if ($countbox > 10)
                        <br>
                        @php
                        $countbox = 0 ;
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
                <div class="form-group">
                    <label>ارفع الملف</label>
                    <input type="file" class="form-control-file" name="path_file">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-danger">اضافة</button>


                    <script>
                        $(document).ready(function() {

                            $('.has-spinner').click(function() {
                                var btn = $(this);
                                $(btn).buttonLoader('start');
                                setTimeout(function() {
                                    $(btn).buttonLoader('stop');
                                }, 3000);
                            });
                        });
                    </script>
                    <script type="text/javascript">
                        var _gaq = _gaq || [];
                        _gaq.push(['_setAccount', 'UA-36251023-1']);
                        _gaq.push(['_setDomainName', 'jqueryscript.net']);
                        _gaq.push(['_trackPageview']);

                        (function() {
                            var ga = document.createElement('script');
                            ga.type = 'text/javascript';
                            ga.async = true;
                            ga.src = ('http:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                            var s = document.getElementsByTagName('script')[0];
                            s.parentNode.insertBefore(ga, s);
                        })();
                    </script>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="asset('js/newjs.js')"></script>
@endsection
{{-- Laravel Dynamic Dependent Dropdown --}}