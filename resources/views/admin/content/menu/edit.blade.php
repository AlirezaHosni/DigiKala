@extends('admin.layouts.master')

@section('head-tag')
<title>منو</title>
@endsection

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">بخش محتوا</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">سوالات متداول</a></li>
      <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش منو</li>
    </ol>
  </nav>


  <section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                  ویرایش منو
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                <a href="{{ route('admin.content.menu.index') }}" class="btn btn-info btn-sm">بازگشت</a>
            </section>

            <section>
                <form action="{{ route('admin.content.menu.update', $menu->id) }}" method="POST" id="form">
                    @csrf
                    {{ method_field('put') }}
                    <section class="row">

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="name">نام منو</label>
                                <input type="text" class="form-control form-control-sm" name="name" id="name" value="{{ old('name', $menu->name) }}">
                            </div>
                            @error('name')
                            <span class="alert-required bg-danger text-white rounded">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        </section>

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="name">url</label>
                                <input type="text" class="form-control form-control-sm" name="url" id="url" value="{{ old('url', $menu->url) }}">
                            </div>
                            @error('url')
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
                                    <option value="0" @if(old('status', $menu->status) == 0) selected @endif>غیر فعال</option>
                                    <option value="1" @if(old('status', $menu->status) == 1) selected @endif>فعال</option>
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
                                <label for="parent_id">منو والد</label>
                                <select name="parent_id" id="parent_id" class="form-control form-control-sm">
                                    <option value="" @if(old('parent_id', $menu->parent_id) == null) selected @endif>منو اصلی</option>
                                    @foreach($parent_menus as $parent_menu)
                                        <option value="{{ $parent_menu->id }}" @if(old('parent_id', $menu->id) == $parent_menu->id) selected @endif>
                                            {{ $parent_menu->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                            @error('parent_id')
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
    <script>
        CKEDITOR.replace('body');
    </script>

@endsection
