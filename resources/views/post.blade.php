@extends('layout.app')

@section('content')
    <!-- Page Content -->
    <!-- Banner Starts Here -->
    <div class="heading-page header-text">
        <section class="page-heading">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-content">
                            <h4>Post</h4>
                            <h2>{{ $post->title }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Banner Ends Here -->

    <section class="blog-posts grid-system">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="all-blog-posts">
                        <div class="row">
                            <!-- START Blog Post Section -->
                            <div class="col-lg-12">
                                <div class="blog-post">
                                    <div class="blog-thumb">
                                        <img src="{{ $post->image_url }}" alt="{{ $post->title }}" loading="lazy">
                                    </div>
                                    <div class="down-content">
                                        <span>{{ (count($post->tags) > 0) ? $post->tags->first()->name : '' }}</span>
                                        <a href="#"><h4>{{ $post->title }}</h4></a>
                                        <ul class="post-info">
                                            <li><a href="#">{{ $post->author }}</a></li>
                                            <li><a href="#">{{ $post->created_at->isoFormat('MMM Do YY') }}</a></li>
                                            <li><a href="#">{{ $post->comments_count }} Comments</a></li>
                                        </ul>
                                        <p>{{ $post->content }}</p>
                                        <div class="post-options">
                                            <div class="row">
                                                <div class="col-6">
                                                    <ul class="post-tags">
                                                        <li><i class="fa fa-tags"></i></li>
                                                        @foreach($post->tags as $tag)
                                                            <li><a href="#">{{ $tag->name }}</a>
                                                                @unless($loop->last) , @endunless</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                                <div class="col-6">
                                                    <ul class="post-share">
                                                        <li><i class="fa fa-share-alt"></i></li>
                                                        <li><a href="#">Facebook</a>,</li>
                                                        <li><a href="#"> Twitter</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END Blog Post Section -->

                            <!-- START Comment Section -->
                            <div class="col-lg-12">
                                <div class="sidebar-item comments">
                                    <div class="sidebar-heading">
                                        <h2>{{ $post->comments_count }} Comments</h2>
                                    </div>
                                    <div class="content">
                                        <comments-component :post-id="{{ $post->id }}"
                                                            id="comments-component"></comments-component>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="sidebar-item submit-comment">
                                    <div class="sidebar-heading">
                                        <h2>Your comment</h2>
                                    </div>
                                    <add-comment-component :post-id="{{ $post->id }}"></add-comment-component>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @include('layout.sidebar')
            </div>
        </div>
    </section>

@endsection
