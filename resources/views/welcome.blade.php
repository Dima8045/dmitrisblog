@extends('layouts.app', ['class' => 'bg-default'])

@section('content')
    <div class="header bg-gradient-primary py-7 py-lg-8">
        <div class="container">
            <div class="header-body text-center mt-7 mb-7">
                <div class="row justify-content-center">
                    <div class="">
                        @if($posts)
                            <div class="tab-content">
                                @foreach($posts->chunk(4) as $postsChunk)
                                    <div class="row">
                                        @foreach($postsChunk as $post)
                                        <div class=" col-lg-3 col-md-4  p-1" style="padding: 10px">
                                            <div id="table-component" class=" tab-pane tab-example-result fade show active" role="tabpanel" aria-labelledby="table-component-tab">
                                                <div class="card" style="width: 18rem;">
                                                    <img class="card-img-top" src="@if($post->image) {{ '/storage/posts/' . $post->image }} @else https://myfiles.kz/Pics/RozaVetrov-wp/uploads/2018/03/nowimage.jpg @endif" style="height: 340px" alt="Card image cap">
                                                    <div class="card-body" style="height: 340px">
                                                        <h5 class="card-title">{{ $post->title }}</h5>
                                                        <p class="card-text">{{ Str::limit($post->content, 50) }}</p>
                                                        <p class="card-text text-sm text-right">{{ \Carbon\Carbon::parse($post->created_at)->format('Y-m-d') }}</p>
                                                        <p class="card-text text-sm text-right">{{ $post->user->name }}</p>
                                                        <div>
                                                            @foreach($post->tags as $tag)
                                                                <form class="d-inline" action="{{ route('welcome') }}" method="post">
                                                                    @csrf
                                                                    @method('post')
                                                                    <input type="hidden" name="tag_id" value="{{ $tag->id }}">
                                                                    <button type="submit" class="btn btn-sm btn-secondary">
                                                                        {{ $tag->name }}
                                                                    </button>
                                                                </form>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                            <div class="py-4">
                                <nav class="d-flex justify-content-end" aria-label="...">
                                    {{ $posts->links() }}
                                </nav>
                            </div>

                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt--10 pb-5"></div>
@endsection
