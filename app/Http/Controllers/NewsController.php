<?php

namespace App\Http\Controllers;

use App\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::orderBy('created_at', 'desc')->limit(3)->get();
        return view("news.index", compact("news"));
    }

    public function search(Request $request){
        $search = $request->get('search');
        $news = News::where('news_title', 'like', '%' . $search . "%")->get();
        if (sizeof($news) != 0){
            return view("news.index", compact("news"));
        }
        return redirect("/news")->with("success", "Ne postoi naslov sto go sodrzi vneseniot string!");
    }


    public function top()
    {
        $news = News::orderBy('num_upvotes', 'desc')->limit(2)->get();
        return view("news.top", compact("news"));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view("news.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'news_title' => 'required|min:10',
            'news_link' => 'required',
            'news_description' => 'required'
        ]);

        $news = new News();
        $news->news_title = $request->get('news_title');
        $news->news_link = $request->get('news_link');
        $news->news_description = $request->get('news_description');
        $news->slug = $request->get('slug');
        $news->save();
        return redirect("/news")->with("success", "Uspeshno kreirana novost!");
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
    public function edit(News $news)
    {
        return view("news.edit", compact("news"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, News $news)
    {
        $request->validate([
            'news_title' => 'required|min:10',
            'news_link' => 'required',
            'news_description' => 'required'
        ]);

        $news->news_title = $request->get('news_title');
        $news->news_link = $request->get('news_link');
        $news->news_description = $request->get('news_description');
        $news->slug = $request->get('slug');
        $news->save();
        return redirect("/news")->with("success", "Uspeshno editirana novost!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        $news->delete();
        return redirect("/news")->with("success", "Uspeshno izbrisana novost!");
    }

    public function upvote(News $news)
    {
        $news->num_upvotes = $news->num_upvotes + 1;
        $news->save();
        return back()->with("success", "Upvoted!");
    }

    public function downvote(News $news)
    {
        $news->num_upvotes = $news->num_upvotes - 1;
        $news->save();
        return back()->with("success", "Downvoted!");
    }


    public function downvoteNews(News $news){
        $votes = [];
        if(Cookie::has('votes'))
            $votes = unserialize(Cookie::get('votes'));

        if(array_key_exists($news->id, $votes) && $votes[$news->id] == 'down'){
            return back();
        }

        $news->num_upvotes = $news->num_upvotes - 1;
        $news->save();

        $votes[$news->id] = 'down';
        Cookie::queue('votes', serialize($votes), 60*48);

        return back();
    }

}
