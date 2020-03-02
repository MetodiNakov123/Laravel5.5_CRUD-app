<html>
<body>

<form action="{{route("news.comments.update", [$news->slug, $comment->slug])}}" method="post">
    {{csrf_field()}}
    {{method_field("PUT")}}

    <div>
        <label>Slug</label>
        <input type="text" name="slug" value="{{$comment->slug}}" required>
    </div>

    <div>
        <label>Username</label>
        <input type="text" name="username" value="{{$comment->username}}" required>
    </div>

    <div>
        <label>Text</label>
        <input type="text" name="comment_text" value="{{$comment->comment_text}}" required>
    </div>

    <div>
        <button type="submit">Edit comment</button>
    </div>
</form>

</body>
</html>