<?php

namespace App\Http\Controllers;

use App\News;
use App\Comment;
use Illuminate\Http\Request;

class NewsCommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(News $news)
    {
        $comments = $news->comments()->orderBy("created_at", 'desc')->get();
        return view("comments.index", compact("news", "comments"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(News $news)
    {
        return view("comments.create", compact("news"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, News $news)
    {
        $request->validate([
            'username'=>'required',
            'comment_text'=>'required'
        ]);

        $comment = new Comment();
        $comment->slug = $request->get('slug');
        $comment->news_id = $news->id;
        $comment->username = $request->get('username');
        $comment->comment_text = $request->get('comment_text');
        $comment->save();
        return redirect()->route("news.comments.index", $news->slug)->with("success","Uspeshno dodaden komentar!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news, Comment $comment)
    {
        return view("comments.edit", compact("news", "comment"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, News $news, Comment $comment)
    {
        $request->validate([
            'username'=>'required',
            'comment_text'=>'required'
        ]);

        $comment->slug = $request->get('slug');
        $comment->username = $request->get('username');
        $comment->comment_text = $request->get('comment_text');
        $comment->save();
        return redirect()->route("news.comments.index", $news->slug)->with("success","Uspeshno promenet komentar!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news, Comment $comment)
    {
        $comment->delete();
        return redirect()->route("news.comments.index", $news->slug)->with("success","Uspeshno izbrishan komentar!");

    }

    public function search(Request $request,News $news){
        $search = $request->get('search');
        $comments = $news->comments()->where("comment_text", "like", "%" . $search . "%")->get();
        if (sizeof($comments) != 0){
            return view("comments.index", compact("news", "comments"));
        }
        return redirect()->route("news.comments.index", $news->slug)->with("success", "Ne postoi takov komentar sho to sodrzi search!");
    }
}
