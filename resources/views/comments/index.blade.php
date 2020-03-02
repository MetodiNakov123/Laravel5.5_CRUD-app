<html>
<body>

<a href="/news">Back to news</a>

@if (session()->get('success'))
    <p class="alert-success">{{session()->get('success')}}</p>
    @endif

<h3>
    <a href="{{$news->news_link}}">{{$news->news_title}}</a>
</h3>

<a href="/news/{{$news->slug}}/upvote">Upvote</a> &nbsp &nbsp
<a href="/news/{{$news->slug}}/downvote">Downvote</a> &nbsp &nbsp
{{$news->num_upvotes}} <br/>

<p>Description: {{$news->news_description}}</p>
<p>Created at: {{$news->created_at}}</p>

<p><a href="/news/{{$news->slug}}/edit">Edit</a></p>

<form action="/news/{{$news->slug}}" method="post">
    {{csrf_field()}}
    {{method_field("DELETE")}}
    <button type="submit">Delete</button>
</form>

<h3>Search comments</h3>
<form action="/news/{{$news->slug}}/comments/search" method="post">
    {{csrf_field()}}

    <div>
        <label>Search comments</label>
        <input type="text" name="search" required>
    </div>

    <div>
        <button type="submit">Search comment</button>
    </div>

</form>


@foreach($comments as $comment)
    <div style="border: 1px solid black">
        <p>Username: {{$comment->username}}</p>
        <p>Text: {{$comment->comment_text}}</p>
        <p>Created at: {{$comment->created_at}}</p>

        <a href="{{route("news.comments.edit", [$news->slug, $comment->slug])}}">Edit comment</a>
        <form action="{{route("news.comments.destroy", [$news->slug, $comment->slug])}}" method="post">
            {{csrf_field()}}
            {{method_field("DELETE")}}
            <button type="submit">Delete comment</button>
        </form>



    </div>

    @endforeach

<h3>
    <a href="{{route("news.comments.create", $news->slug)}}">Add new Comment</a>
</h3>

</body>
</html>