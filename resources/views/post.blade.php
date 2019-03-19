<div class="card card-body bg-faded mb-3">
    <div class="media">
        <a class="pull-left" href="#">
            <img class="mr-3" src="{{ $post->photo }}">
        </a>

        <div class="media-body">
            <h4 class="mt-0">{{ $post->title }}</h4> <p class="text-right">By {{ $post->author->name }}</p>
        
                <p>{{ $post->content }}</p>

            <ul class="list-inline list-unstyled">
                <li>
                    <span>
                        <i class="fas fa-calendar-alt"></i> {{ $post->created_at }} 
                    </span>
                </li>
            </ul>
        </div>
    </div>
</div>