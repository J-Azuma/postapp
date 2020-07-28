<p>
  {{App\User::find($comment->user_id)->name}} posted comment to your post
</p>

<p>{{$comment->content}}</p>

<button type="button"><a href="{{route('posts.showdetail', ['post' => $post])}}">see comment</a></button>
