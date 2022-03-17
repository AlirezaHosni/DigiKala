@extends('admin.layouts.master')

@section('head-tag')
<title>دسته بندی</title>
@endsection

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
      <li class="breadcrumb-item font-size-12 active" aria-current="page"> دسته بندی</li>
    </ol>
  </nav>


  <section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                  دسته بندی
                </h5>
            </section>

            @include('admin.alerts.alert-section.success')

            <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                <a href="{{ route('admin.content.category.create') }}" class="btn btn-info btn-sm">ایجاد دسته بندی</a>
                <div class="max-width-16-rem">
                    <input type="text" class="form-control form-control-sm form-text" placeholder="جستجو">
                </div>
            </section>

            <section class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>نام دسته بندی</th>
                            <th>توضیحات</th>
                            <th>اسلاگ</th>
                            <th>عکس</th>
                            <th>تگ‌ها</th>
                            <th>وضعیت</th>
                            <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($postCategories as $postCategory)
                            <tr>
                                <th>{{ $postCategory->id }}</th>
                                <td>{{ $postCategory->name }}</td>
                                <td>{{ $postCategory->description }}</td>
                                <td>{{ $postCategory->slug }}</td>
                                <td><img src="{{ asset($postCategory->image) }}" alt="" width="50px" height="50px"></td>
                                <td>{{ $postCategory->tags }}</td>
                                <td>
                                    <label>
                                        <input type="checkbox"  id="{{ $postCategory->id }}" onchange="changeStatus({{ $postCategory->id }})" @if($postCategory->status === 1) checked @endif data-url="{{ route('admin.content.category.status', $postCategory->id) }}">
                                    </label>
                                </td>
                                <td class="width-16-rem text-left">
                                    <a href="{{ route('admin.content.category.edit', $postCategory->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> ویرایش</a>
                                    <form class="d-inline" action="{{ route('admin.content.category.destroy', $postCategory->id) }}" method="post">
                                        @csrf
                                        {{ method_field('delete') }}
                                        <button class="btn btn-danger btn-sm" type="submit"><i class="fa fa-trash-alt"></i> حذف</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
{{--                        <tr>--}}
{{--                            <th>2</th>--}}
{{--                            <td>نمایشگر	</td>--}}
{{--                            <td>کالای الکترونیکی</td>--}}
{{--                            <td class="width-16-rem text-left">--}}
{{--                                <a href="#" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> ویرایش</a>--}}
{{--                                <button class="btn btn-danger btn-sm" type="submit"><i class="fa fa-trash-alt"></i> حذف</button>--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <th>3</th>--}}
{{--                            <td>نمایشگر	</td>--}}
{{--                            <td>کالای الکترونیکی</td>--}}
{{--                            <td class="width-16-rem text-left">--}}
{{--                                <a href="#" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> ویرایش</a>--}}
{{--                                <button class="btn btn-danger btn-sm" type="submit"><i class="fa fa-trash-alt"></i> حذف</button>--}}
{{--                            </td>--}}
{{--                        </tr>--}}
                    </tbody>
                </table>
            </section>

        </section>
    </section>
</section>

@endsection
@section('script')

    <script type="text/javascript">
        function changeStatus(id){
            var element = $("#" + id)
            var url = element.attr("data-url")
            var elementValue = !element.prop("checked")


            $.ajax({
                url : url,
                type : "GET",
                success : function(response){
                    if(response.status){
                        if(response.checked)
                            element.prop("checked", true);
                        else
                            element.prop("checked", false);
                    }else{
                        element.prop("checked", elementValue);
                    }
                }
            })
        }
    </script>

@endsection