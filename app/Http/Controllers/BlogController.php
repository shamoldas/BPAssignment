<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\Post;
use App\Models\Comment;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

         $posts = Post::all();
         $comments = Comment::all();
         $posts=Post::paginate(10);
         return view('post.blog', compact('posts','comments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

            $comments = Comment::all();
            $post = Post::find($id);
            
            //return view('post.show', compact('post','comments'));

            //return view('post.show', compact('post'));

             return View('post.show')->with(['post' => $post,'comments' => $comments]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function searchpost(Request $request)
    {

    
    $search = $request->input('search');

    // Search in the title and body columns from the posts table
    $posts = Post::query()
        ->where('title', 'LIKE', "%{$search}%")
        ->orWhere('description', 'LIKE', "%{$search}%")
        ->orWhere('slug', 'like', "%'$search'%")
        ->orderBy('id', 'ASC')
        ->get();

    // Return the search view with the resluts compacted
    return view('post.searchpost', compact('posts'));
    }



    public function last5()
    {
        //

         //$posts = Post::all();

         $posts= Post::latest()->paginate(5);

         $comments = Comment::all();
         return view('post.blog', compact('posts','comments'));
    }

}
