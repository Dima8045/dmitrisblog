@extends('layouts.app', ['title' => __('Posts Management')])

@section('content')
    @include('posts.partials.header', ['title' => __('Edit Post')])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
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
                        <form method="post" action="{{ route('post.update', $post) }}" autocomplete="off">
                            @csrf
                            @method('put')

                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-title">{{ __('Title') }}</label>
                                    <input type="text" name="name" id="input-title" class="form-control form-control-alternative{{ $errors->has('title') ? ' is-invalid' : '' }}" placeholder="{{ __('Title') }}" value="{{ old('title', $post->title) }}" required autofocus>

                                    @if ($errors->has('title'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="row">
                                    <div class="col-md-7 col-12">
                                        <div class="form-group{{ $errors->has('content') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-email">{{ __('Content') }}</label>
                                            <textarea type="text" name="content" id="input-email" class="form-control form-control-alternative{{ $errors->has('content') ? ' is-invalid' : '' }}" placeholder="{{ __('Content') }}" rows="20" required>
                                        {{ old('email', $post->content) }}
                                    </textarea>
                                            @if ($errors->has('content'))
                                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('content') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-5 col-5">
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('tags') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="tags">{{ __('Tags') }}</label>
                                    <select multiple="2" name="tags" id="tags" class="form-control form-control-alternative{{ $errors->has('tags') ? ' is-invalid' : '' }}" placeholder="{{ __('Tags') }}" value="">
                                        @foreach($tags as $tag)
                                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
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