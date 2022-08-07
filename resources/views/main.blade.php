@extends('layout.app')

@section('content')
    <!-- Page Content -->
    <!-- Banner Starts Here -->
    <div class="main-banner header-text">
        <div class="container-fluid">
            <div class="owl-banner owl-carousel">
                @foreach($posts as $post)
                    <div class="item">
                        <img src="{{ $post->image_url }}" alt="{{ $post->title }}" loading="lazy">
                        <div class="item-content">
                            <div class="main-content">
                                <div class="meta-category">
                                    <span>{{ (count($post->tags) > 0) ? $post->tags->first()->name : '' }}</span>
                                </div>
                                <a href="#"><h4></h4></a>
                                <ul class="post-info">
                                    <li><a href="#">{{ $post->author }}</a></li>
                                    <li><a href="#">{{ $post->created_at->isoFormat('MMM Do YY') }}</a></li>
                                    <li><a href="#">{{ $post->comments_count }} Comments</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Banner Ends Here -->

    <section class="blog-posts">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="all-blog-posts">
                        <div class="row">
                            @foreach($posts as $post)
                                @include('layout.post-listing', ['post' => $post, 'searchedTag' => $searchedTag])
                            @endforeach
                            <div class="col-lg-12">
                                {{ $posts->links() }}
                            </div>
                        </div>
                    </div>
                </div>
                @include('layout.sidebar', ['searchedTag' => $searchedTag])
            </div>
        </div>
    </section>
@endsection
