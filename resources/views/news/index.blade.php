<html>
<body>

<h3><a href="/news/top">Top 2</a></h3>

@if(session()->get('success'))
    <p class="alert alert-success">{{session()->get('success')}}</p>
    @endif

<form action="/news/search" method="post">
    {{csrf_field()}}
    <div>
        <label>Search title</label>
        <input type="text" name="search" required>
    </div>

    <div>
        <button type="submit">Search</button>
    </div>
</form>

@foreach($news as $n)


    <div style="border: 1px solid black">
        <h3>
            <a href="{{$n->news_link}}">{{$n->news_title}}</a>
        </h3>

        <a href="/news/{{$n->slug}}/upvote">Upvote</a> &nbsp &nbsp
        <a href="/news/{{$n->slug}}/downvote">Downvote</a> &nbsp &nbsp
        {{$n->num_upvotes}} <br/>

        <a href="{{route("news.comments.index", [$n->slug])}}">Comments</a> <br/>

        <p>Created at: {{$n->created_at}}</p>

        <p><a href="/news/{{$n->slug}}/edit">Edit</a></p>

        <form action="/news/{{$n->slug}}" method="post">
            {{csrf_field()}}
            {{method_field("DELETE")}}
            <button type="submit">Delete</button>
        </form>

    </div>

    @endforeach

<h3>
    <a href="/news/create">Create news</a>
</h3>

</body>
</html>