@extends('layouts.app')
@section('content')
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4">Upload File</h1>
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
                <form action="{{ route('file.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="exampleFormControlInput1">اسم الملف</label>
                        <input type="text" class="form-control" name="title" placeholder="مثال : الشباب_و_الرياضة_1">
                    </div>

                    <div class="form-group">
                        <label>تصنيف الاساسي</label>
                        <select class="form-control category" name="category_id" data-dependent="category_id">
                            <option disabled="true" selected="true">اختار</option>
                            @foreach ($category as $item)
                                <option value="{{ $item->id }}">{{ $item->type }}</option>
                            @endforeach
                        </select>
                        {{ csrf_field() }}
                    </div>
                    <div class="form-group">
                        <label>تصنيف الفرعي</label>
                        <select class="form-control dynamic" name="categorysub_id" id="sub_select">
                            <option disabled="true" selected="true">اختار</option>
                        </select>
                    </div>

                    <div class="form-group row">
                        <label for="example-date-input" class="col-2 col-form-label">تاريخ</label>
                        <div class="col-10">
                            <input class="form-control" type="date" max="2030-12-31" min="2017-01-01" name="date_user">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">الوصف</label>
                        <textarea class="form-control" name="description" rows="3"></textarea>
                    </div>

                    <h5>الاشارت</h5>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="option1">
                        <label class="form-check-label">1</label>
                    </div>



                    <h5>المعد</h5>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="option1">
                        <label class="form-check-label">1</label>
                    </div>

                    <h5>المقدم</h5>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="option1">
                        <label class="form-check-label">1</label>
                    </div>

                    <div class="form-group">
                        <label>ارفع الملف</label>
                        <input type="file" class="form-control-file" name="path_file">
                    </div>
                    <div class="form-group">

                        <button type="submit" class="btn btn-danger">save</button>
                    </div>

                </form>
            </div>
        </div>
    </div>




{{--
    <script>
        // function filter(id) {
        //     var x = document.getElementById("sub_selcet");
        //     var option = document.createElement("option");
        //     var sites = {
        //         !!json_encode($id - > toArray()) !!
        //     };
        //     array.forEach(id => {
        //         option.text = id.title;
        //         option.value = id.id;
        //     });

        //     x.add(option);
        // }

        // }
        $(document).ready(function() {
            console.log("?????");
            $(.dynamic).change(function() {
                if ($(this).val() != '') {
                    var select = $(this).attr("id");
                    var value = = $(this).val();
                    var dependent = $(this).data('sub_select');
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url: "{{ route('category._id') }}",
                        method: "POST",
                        data: {
                            select: select,
                            value: value,
                            _token: _token,
                            dependent: dependent
                        },
                        success: function(result) {
                            $('#' + dependent).html(result);
                        }

                    })
                }
            });
        });

    </script> --}}


@endsection
{{-- Laravel Dynamic Dependent Dropdown  --}}
