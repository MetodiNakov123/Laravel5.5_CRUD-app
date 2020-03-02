<html>
<body>

<form action="{{route("news.comments.store", $news->slug)}}" method="post">
    {{csrf_field()}}
    {{method_field("POST")}}

    <div>
        <label>Slug</label>
        <input type="text" name="slug" required>
    </div>

    <div>
        <label>Username</label>
        <input type="text" name="username" required>
    </div>

    <div>
        <label>Text</label>
        <input type="text" name="comment_text" required>
    </div>

    <div>
        <button type="submit">Add comment</button>
    </div>
</form>

</body>
</html>