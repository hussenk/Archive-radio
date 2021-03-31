@extends('layouts.app')
@section('content')
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4">تعديل الاسم </h1>
            <h3>" {{ $categorysub->title }} "</h3>
            <p class="lead"></p>
        </div>
    </div>
    <div class="container">
        @if (count($errors) > 0)
            <ul>
                @foreach ($errors->all() as $item)
                    <li>
                        {{ $item }}
                    </li>
                @endforeach
            </ul>

        @endif
    </div>
    <div class="container">
        <form action="{{ route('categorysub.update', ['id' => $categorysub->id]) }}" method="POST">
            @csrf
            <h3>اختار التصنيف</h3>
            <select multiple class="form-control" name="category_id">
                <option selected>اختار </option>
                @foreach ($category as $item)
                    <option value="{{ $item->id }}">{{ $item->type }}</option>
                @endforeach
            </select>
            <br>
            <label>ادخل اسم تصنيف هنا </label>

            <input type="text" class="form-control" placeholder='  "برنامج" "مسيقى"' name="title" autocomplete="off">
            <br>
            <label>الوصف سابق</label>
            <textarea class="form-control" readonly rows="3" autocomplete="off"> {{ $categorysub->description }} </textarea>
            <br>
            <label>الوصف</label>
            <textarea class="form-control" name="description" rows="3" autocomplete="off"
                placeholder='  "برنامج شبابي يتكلم عن المستقبل القريب"'></textarea>
            <br>
            <button type="submit" class="btn btn-danger">اضافة</button>
            @if (count($errors) > 0)
                <ul>
                    @foreach ($errors->all() as $item)
                        <li>{{ $item }}</li>
                    @endforeach
                </ul>
            @endif
        </form>
    </div>
@endsection
