@extends('layouts.app', ['title' => __('Posts Management')])

@section('content')
    @include('posts.partials.header', ['title' => __('Edit Post')])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('status') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Post Management') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('post.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('post.store') }}" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            @method('post')

                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-title">{{ __('Title') }}</label>
                                    <input type="text" name="title" id="input-title" class="form-control form-control-alternative{{ $errors->has('title') ? ' is-invalid' : '' }}" placeholder="{{ __('Title') }}" value="{{ old('title') }}"  autofocus>

                                    @if ($errors->has('title'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="row">
                                    <div class="col-md-7 col-12">
                                        <div class="form-group{{ $errors->has('content') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="content">{{ __('Content') }}</label>
                                            <textarea type="text" name="content" id="content" class="form-control form-control-alternative{{ $errors->has('content') ? ' is-invalid' : '' }}" placeholder="{{ __('Content') }}" rows="20" required>
                                                {{ old('content') }}
                                            </textarea>
                                            @if ($errors->has('content'))
                                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('content') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                        <div class="form-group{{ $errors->has('tags') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="tags">{{ __('Tags') }}</label>
                                            <select multiple="" name="tags[]" id="tags" class="form-control form-control-alternative{{ $errors->has('tags') ? ' is-invalid' : '' }}" placeholder="{{ __('Tags') }}" value="">
                                                @foreach($tags as $tag)
                                                    <option value="{{ $tag->id }}" >{{ $tag->name }}</option>
                                                @endforeach
                                            </select>
                                            <div class="form-group{{ $errors->has('category_id') ? ' has-danger' : '' }}">
                                                <label class="form-control-label" for="category_id">{{ __('Category') }}</label>
                                                <select name="category_id" id="category_id" class="form-control form-control-alternative{{ $errors->has('category_id') ? ' is-invalid' : '' }}" placeholder="{{ __('Category') }}" value="">
                                                    @foreach($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>
                                        <div class="custom-control custom-control-alternative custom-checkbox mb-3">
                                            <input class="custom-control-input" id="published" type="checkbox" name="published" value="1" >
                                            <label class="custom-control-label" for="published">{{ __('Published') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-5 col-5">
                                        <label class="form-control-label" for="image">{{ __('Image') }}</label>
                                        <div class="card">
                                            <div class="card-body">
                                                <img class="card-img-top" src="https://myfiles.kz/Pics/RozaVetrov-wp/uploads/2018/03/nowimage.jpg" alt="Card image cap">
                                            </div>
                                            <div class="card-footer">
                                                <div class="form-group">
                                                    <label for="image">{{ __('Image name') }}</label>
                                                    <input type="file" class="form-control-file" id="image" name="image">
                                                    @if ($errors->has('image'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('image') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                    <a href="{{ route('post.index') }}" class="btn btn-info mt-4">{{ __('Cancel') }}</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection