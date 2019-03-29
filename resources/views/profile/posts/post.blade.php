<div id="{{ $post->id }}" class="card card-body bg-faded mb-2">
    <div class="media">
        <div id="post-photo" class="pull-left mr-1" style="width:500;height:500;background-image:url({{ asset('post/image/'.$post->id) }});background-size:cover;background-repeat:no-repeat;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)">
            {{-- <button class="btn btn-secondary btn-sm">&times;</button> --}}
        </div>

        <div class="media-body" style="word-wrap:break-word;max-width:500">
            <h4 id="post-title" class="ml-2">{{ $post->title }}</h4> <p class="text-right">By {{ $post->author->name }}</p>
        
                <p id="post-content" class="ml-1">{{ $post->content }}</p>

            <div role="post-createdDate" class="text-right"><i class="fas fa-calendar-alt"></i> {{ $post->created_at }}</div>      
        </div>
    </div>
</div>