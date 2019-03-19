<div class="well">
    <div class="media">
        <a class="pull-left" href="#">
            <img class="media-object" src="{{ $post->photo }}">
        </a>

        <div class="media-body">
            <h4 class="media-heading">{{ $post->title }}</h4> <p class="text-right">By {{ $post->author }}</p>
        
                <p>{{ $post->content }}</p>

            <ul class="list-inline list-unstyled">
                <li>
                    <span>
                        <i class="glyphicon glyphicon-calendar"></i> {{ $post->created_at }} 
                    </span>
                </li>
            </ul>
        </div>
    </div>
</div>