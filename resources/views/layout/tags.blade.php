<div class="col-lg-12">
    <div class="sidebar-item tags">
        <div class="sidebar-heading">
            <h2>Tags</h2>
        </div>
        <div class="content">
            <ul>
                @foreach($tags as $tag)
                    <li><a href="{{ route("/", ['tag' => $tag->key]) }}" @if($tag->key == $searchedTag) class="searched-tag" @endif>{{ $tag->name }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
