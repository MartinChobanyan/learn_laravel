<div id="{{ $post->id }}" class="card card-body bg-faded mb-2">
    <div class="media">
        <a class="pull-left" href="#">
            <img class="mr-3" src="{{ asset($post->photo) }}">
            <span style="display:none" id="post-photo">{{ $post->photo }}</span>
        </a>

        <div class="media-body">
            <h4 id="post-title" class="mt-0">{{ $post->title }}</h4> <p class="text-right">By {{ $post->author->name }}</p>
        
                <p id="post-content">{{ $post->content }}</p>

            <ul class="list-inline list-unstyled">
                <li>
                    <span role="postCreationDate">
                        <i class="fas fa-calendar-alt"></i> {{ $post->created_at }} 
                    </span>
                </li>
            </ul>
        </div>
    </div>
</div>