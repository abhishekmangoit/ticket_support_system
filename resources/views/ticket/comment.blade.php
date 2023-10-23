<!-- Conversations are loaded here -->
<div class="direct-chat-messages">
    
    @foreach($ticket->comments as $comment)

    <!-- Message. Default to the left -->
    @if($comment->user->role != $user->role)
    <div class="direct-chat-msg">
    <div class="direct-chat-infos clearfix">
        <span class="direct-chat-name float-left">{{ $comment->user->name }}</span>
        <span class="direct-chat-timestamp float-right">{{ $formatDate($comment->created_at) }}</span>
    </div>
    <!-- /.direct-chat-infos -->
    <div class="direct-chat-text">
        <span>{{$comment->message}}</span>
    </div>
    @foreach($comment->images as $image)
        <a id="example2" href="{{ asset($image->image) }}"><img src="{{ asset($image->image) }}" class="mr-3" alt="" style="width:100px"></a>
    @endforeach
    <!-- /.direct-chat-text -->
    </div>
    <!-- /.direct-chat-msg -->
    @else 
    
    <!-- Message to the right -->
    <div class="direct-chat-msg right">
    <div class="direct-chat-infos clearfix">
        <span class="direct-chat-name float-right">{{ $comment->user->name }}</span>
        <span class="direct-chat-timestamp float-left">{{ $formatDate($comment->created_at) }}</span>
    </div>
    <!-- /.direct-chat-infos -->
    <div class="direct-chat-text mb-2">
        <span>{{$comment->message}}</span>
    </div>
    @foreach($comment->images as $image)
        <a id="example2" href="{{ asset($image->image) }}"><img src="{{ asset($image->image) }}" class="mr-3" alt="" style="width:100px"></a>
    @endforeach
    <!-- /.direct-chat-text -->
    </div>
    
    @endif
    @endforeach
    
    

</div>