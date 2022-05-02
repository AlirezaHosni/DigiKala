@extends('admin.layouts.master')

@section('head-tag')
<title>ایجاد پست</title>
<link rel="stylesheet" href="{{ asset('admin-assets/jalalidatepicker/persian-datepicker.min.css') }}">
@endsection

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">بخش محتوی</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">پست</a></li>
      <li class="breadcrumb-item font-size-12 active" aria-current="page"> ایجاد پست</li>
    </ol>
  </nav>


  <section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                  ایجاد پست
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                <a href="{{ route('admin.content.post.index') }}" class="btn btn-info btn-sm">بازگشت</a>
            </section>

            <section>
                <form action="{{ route('admin.content.post.store') }}" method="POST" enctype="multipart/form-data" id="form">
                    @csrf
                    <section class="row">

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">عنوان پست</label>
                                <input type="text" class="form-control form-control-sm" name="title" value="{{ old('title') }}">
                            </div>
                            @error('title')
                            <span class="alert-required bg-danger text-white rounded">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        </section>

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">انتخاب دسته</label>
                                <select name="category_id" id="" class="form-control form-control-sm">
                                    <option value="">دسته را انتخاب کنید</option>
                                    @foreach($postCategories as $postCategory)
                                        <option value="{{ $postCategory->id }}" @if(old('category_id') == $postCategory->id) selected @endif>{{ $postCategory->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('category_id')
                            <span class="alert-required bg-danger text-white rounded">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        </section>

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="image">تصویر</label>
                                <input type="file" class="form-control form-control-sm" name="image" id="image">
                            </div>
                            @error('image')
                            <span class="alert-required bg-danger text-white rounded">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        </section>

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="status">وضعیت</label>
                                <select name="status" id="status" class="form-control form-control-sm">
                                    <option value="0" @if(old('status') == 0) selected @endif>غیر فعال</option>
                                    <option value="1" @if(old('status') == 1) selected @endif>فعال</option>
                                </select>
                            </div>
                            @error('status')
                            <span class="alert-required bg-danger text-white rounded">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        </section>

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="commentable">امکان درچ کامنت</label>
                                <select name="commentable" id="commentable" class="form-control form-control-sm">
                                    <option value="0" @if(old('commentable') == 0) selected @endif>غیر فعال</option>
                                    <option value="1" @if(old('commentable') == 1) selected @endif>فعال</option>
                                </select>
                            </div>
                            @error('commentable')
                            <span class="alert-required bg-danger text-white rounded">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        </section>

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">تاریخ انتشار</label>
                                <input type="text" name="published_at" id="published_at" class="form-control form-control-sm d-none">
                                <input type="text" id="published_at_view" class="form-control form-control-sm">
                            </div>
                            @error('published_at')
                            <span class="alert-required bg-danger text-white rounded">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        </section>

                        <section class="col-12">
                            <div class="form-group">
                                <label for="tags">تگ‌ها</label>
                                <input type="hidden" class="form-control form-control-sm" name="tags" id="tags" value="{{ old('tags') }}">
                                <select class="select2 form-control form-control-sm" id="select_tags" multiple>

                                </select>
                            </div>
                            @error('tags')
                            <span class="alert-required bg-danger text-white rounded">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        </section>


                        <section class="col-12">
                            <div class="form-group">
                                <label for="">حلاصه پست</label>
                                <textarea name="summary" id="summary"  class="form-control form-control-sm" rows="6">
                                    {{ old('summary') }}
                                </textarea>
                            </div>
                            @error('summary')
                            <span class="alert-required bg-danger text-white rounded">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        </section>

                        <section class="col-12">
                            <div class="form-group">
                                <label for="">متن پست</label>
                                <textarea name="body" id="body"  class="form-control form-control-sm" rows="6">
                                    {{ old('body') }}
                                </textarea>
                            </div>
                            @error('body')
                            <span class="alert-required bg-danger text-white rounded">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        </section>

                        <section class="col-12">
                            <button class="btn btn-primary btn-sm">ثبت</button>
                        </section>
                    </section>
                </form>
            </section>

        </section>
    </section>
</section>

@endsection

@section('script')

    <script src="{{ asset('admin-assets/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('admin-assets/jalalidatepicker/persian-date.min.js') }}"></script>
    <script src="{{ asset('admin-assets/jalalidatepicker/persian-datepicker.min.js') }}"></script>
    <script>
        CKEDITOR.replace('body');
        CKEDITOR.replace('summary');
    </script>

    <script>
        $(document).ready(function (){
            var tags_input = $('#tags');
            var select_tags  = $('#select_tags');
            var default_tags = tags_input.val();
            var default_data = null;

            if (tags_input.val() !== null && tags_input.val().length > 0){
                default_data = default_tags.split(',');
            }
            select_tags.select2({
                placeholder : 'لطفا تگ‌های خود را وارد نمایید',
                tags : true,
                data : default_data
            });

            select_tags.children('option').attr('selected', true).trigger('change');

            $('#form').submit(function (event){
                if (select_tags.val() !== null && select_tags.val().length > 0){
                    var selectedSource = select_tags.val().join(',');
                    //    with above codes tags converted from array to string
                    tags_input.val(selectedSource)
                }
            })
        })
    </script>
    <script>
        $(document).ready(function (){
            $('#published_at_view').persianDatepicker({
                format : "YYYY/MM/DD",
                altField: "#published_at"
            })
        });
    </script>

@endsection
