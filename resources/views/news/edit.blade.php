<html>
<body>

<form action="/news/{{$news->slug}}" method="post">
    {{csrf_field()}}
    {{method_field("put")}}

    <div>
        <label>Title</label>
        <input type="text" name="news_title" value="{{$news->news_title}}" required>
    </div>

    <div>
        <label>Link</label>
        <input type="url" name="news_link" value="{{$news->news_link}}" required>
    </div>

    <div>
        <label>Description</label>
        <textarea name="news_description"  required>{{$news->news_description}}</textarea>
    </div>

    <div>
        <label>Slug</label>
        <input type="text" name="slug" value="{{$news->slug}}" required>
    </div>

    <div>
        <button type="submit">Edit</button>
    </div>

</form>

</body>
</html>