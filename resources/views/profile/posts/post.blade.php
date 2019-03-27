<div id="{{ $post->id }}" class="card card-body bg-faded mb-2">
    <div class="media">
        <div id="post-photo" class="pull-left mr-1" style="width:500;height:500;background-image:url({{ asset('post/image/'.$post->id) }});background-size:100%100%;background-repeat:no-repeat">
            {{-- <button class="btn btn-secondary btn-sm">&times;</button> --}}
        </div>

        <div class="media-body mr-0" style="word-wrap:break-word;max-width:500">
            <h4 id="post-title" class="mt-0">{{ $post->title }}</h4> <p class="text-right">By {{ $post->author->name }}</p>
        
                <p id="post-content">{{ $post->content }}</p>

            <div role="post-createdDate" class="text-right"><i class="fas fa-calendar-alt"></i> {{ $post->created_at }}</div>      
        </div>
    </div>
</div>