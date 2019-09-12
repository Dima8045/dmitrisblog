@extends('layouts.app', ['title' => __('Posts')])

@section('content')
    @include('layouts.headers.cards')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Posts') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('post.create') }}" class="btn btn-sm btn-primary">{{ __('Add post') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">{{ __('Title') }}</th>
                                    <th scope="col">{{ __('Published') }}</th>
                                    <th scope="col">{{ __('Author') }}</th>
                                    <th scope="col">{{ __('Action') }}</th>
                                    <th scope="col"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($posts as $post)
                                    <tr>
                                        <td>
                                            <a href="{{ route('post.show', $post) }}"></a>{{ $post->title }}</td>
                                        <td>
                                            @if($post->published)
                                                <span class="badge badge-success">Published</span>
                                            @else
                                                <span class="badge badge-default">Unpublished</span>
                                            @endif
                                        </td>
                                        <td>{{ $post->user->name }}</td>
                                        <td class="text-right ">
                                            @if ($post->id != auth()->id() || $post->user_id == auth()->id())

                                            <a href="{{ route('post.create') }}" class="btn btn-sm btn-primary">{{ __('Add') }}</a>
                                                @can(['update-post', 'delete-post'], $post)
                                                <a href="{{ route('post.edit', $post) }}" class="btn btn-sm btn-warning">{{ __('Edit') }}</a>
                                                <form class="d-inline" action="{{ route('post.destroy', $post->id) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="button" class="btn btn-sm btn-danger" onclick="confirm('{{ __("Are you sure you want to delete this post?") }}') ? this.parentElement.submit() : ''">
                                                        {{ __('Delete') }}
                                                    </button>
                                                </form>
                                                @endcan
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer py-4">
                            <nav class="d-flex justify-content-end" aria-label="...">
                                {{ $posts->links() }}
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection