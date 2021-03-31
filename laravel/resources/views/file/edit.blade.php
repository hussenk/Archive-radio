@extends('layouts.app')
@section('content')


<div class="jumbotron jumbotron-fluid ">
    <div class="container div-container-all">
        <h1 class="display-4">رفع ملف الي {{ $category->type }}</h1>
        <p class="lead"> </p>
    </div>
</div>


<div class="row">


    <div class="container">
        <div class="col">

            @if (count($errors) > 0)
            <ul>
                @foreach ($errors->all() as $item)
                <li>
                    {{ $item }}
                </li>
                @endforeach
            </ul>

            @endif
            <form action="{{ route('file.update', ['id' => $file->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>اسم السابق</label>
                    <input type="text" class="form-control" value="{{ $file->title }}" readonly name="old_title">
                </div>
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
                        @foreach ($categorysub as $item)
                        <option value="{{ $item->id }}" @if ($item->id == $file->category_sub_id) selected="true" @endif>{{ $item->title }}</option>
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

                <h5>الاشارت</h5>

                @if ($tag->count() > 0)

                <div class="form-check form-check-inline">
                    @foreach ($tag as $item)
                    &nbsp; <input class="form-check-input" name="tags[]" type="checkbox" value="{{ $item->id }}" @foreach ($file->tag as $item2) @if ($item->id==$item2->id)
                    checked @endif
                    @endforeach

                    >
                    <label class="form-check-label">
                        {{ $item->tag }}</label>&nbsp;
                    @endforeach

                </div>

                @else
                <div class="alert alert-primary" role="alert">
                    لا يوجد اشارات
                </div>
                @endif


                <h5>المعد</h5>
                <div class="container">
                    @if ($preparation->count() > 0)

                    <div class="form-check form-check-inline">
                        @foreach ($preparation as $item)
                        &nbsp; <input class="form-check-input" type="checkbox" name="preparation[]" value="{{ $item->id }}" @foreach ($file->preparation as $item2) @if ($item->id==$item2->id)
                        checked @endif
                        @endforeach
                        >
                        &nbsp;<label class="form-check-label">{{ $item->name }}</label>&nbsp;
                        @endforeach

                    </div>
                    @else
                    <div class="alert alert-primary" role="alert">
                        لا يوجد معدين
                    </div>
                    @endif
                </div>
                <h5>المقدم</h5>

                <div class="container">
                    @if ($presenter->count() > 0)

                    <div class="form-check form-check-inline">
                        @foreach ($presenter as $item)
                        &nbsp;<input class="form-check-input" type="checkbox" name="presenter[]" value="{{ $item->id }}" @foreach ($file->presenter as $item2) @if ($item->id==$item2->id)
                        checked @endif
                        @endforeach
                        >
                        &nbsp;<label class="form-check-label">{{ $item->name }}</label>&nbsp;
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
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
{{-- Laravel Dynamic Dependent Dropdown --}}