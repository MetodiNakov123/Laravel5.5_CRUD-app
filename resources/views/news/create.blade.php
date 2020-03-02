<html>
<body>

<form action="/news" method="post">
    {{csrf_field()}}
    {{method_field("post")}}

    <div>
        <label>Title</label>
        <input type="text" name="news_title" required>
    </div>

    <div>
        <label>Link</label>
        <input type="url" name="news_link" required>
    </div>

    <div>
        <label>Description</label>
        <textarea name="news_description" required></textarea>
    </div>

    <div>
        <label>Slug</label>
        <input type="text" name="slug" required>
    </div>

    <div>
        <button type="submit">Create</button>
    </div>

</form>

</body>
</html>