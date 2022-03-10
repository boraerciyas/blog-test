<div class="col-lg-12">
    <div class="blog-post">
        <div class="blog-thumb">
            <img src="{{ $post->image_url }}" alt="{{ $post->title }}" loading="lazy">
        </div>
        <div class="down-content">
            <span>{{  (count($post->tags) > 0) ? $post->tags->first()->name : ''  }}</span>
            <a href="{{ route('post', ['post' => $post->slug]) }}"><h4>{{ $post->title }}</h4></a>
            <ul class="post-info">
                <li><a href="#">{{ $post->author }}</a></li>
                <li>
                    <a href="#">{{ $post->created_at->isoFormat('MMM Do YYYY hh:mm:ss') }}</a>
                </li>
                <li><a href="#">{{ $post->comments_count }} Comments</a></li>
            </ul>
            <p>{{ $post->description }}</p>
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
