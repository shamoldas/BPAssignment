<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Models\Post;
use App\Models\User;

use App\Models\Comment;

class PostController extends Controller
{
   

   public function __construct()
    {
        return $this->middleware('auth');
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
         //      $comments = Comment::all();
        $posts = Post::latest()->paginate(10);            
        return view('post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('post.create');
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
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
                ]);

             
          

            $input = $request->all();

            if ($image = $request->file('image')) 
            {
                $destinationPath = 'image/';
                $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
                $image->move($destinationPath, $profileImage);
                $input['image'] = "$profileImage";
            }


            /*
                $post = new Post;

                $post->user_id = $request->get('user_id');
                $post->title = $request->get('title');
                $post->slug = $request->get('slug');
                $post->description = $request->get('description');
              //  $post->image = $request->get('image');

                   if ($image = $request->file('image')) 
                {
                    $destinationPath = 'image/';
                    $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
                    $image->move($destinationPath, $profileImage);
                    $input['image'] = "$profileImage";
                }
                else
                {
                    unset($input['image']);
                }


                $post->save();
                */

             Post::create($input);
               // return redirect('post');
                return redirect()->route('post.index')->with('success','Created Successfully.');
    }








    public function edit($id)
        {
            $post = Post::find($id);
            return view('post.edit', compact('post'));
        }
    

    public function update(Request $request,$id)
        {
            
             
            $request->validate([
            'title' => 'required',
            'description' => 'required',
            //'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
                ]);          

            $input = $request->all();

            if ($image = $request->file('image')) 
            {
                $destinationPath = 'image/';
                $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
                $image->move($destinationPath, $profileImage);
                $input['image'] = "$profileImage";
            }
            
            else
            {
            unset($input['image']);
            }
          






            /* $request->validate([
                'title' => 'required',
                'description' => 'required',
               'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
                ]);
                 
             

            if ($image = $request->file('image')) 
                {
                    $destinationPath = 'image/';
                    $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
                    $image->move($destinationPath, $profileImage);
                    $input['image'] = "$profileImage";
                }

                $post = Post::find($id);

                $post = new Post;
                $post->title = $request->get('title');
                $post->slug = $request->get('slug');
                $post->description = $request->get('description');
                $post->image = $request->get('image');

                $post->save();

                */
                 Post::update($input);
    
                return redirect()->route('post.index')
                        ->with('success','Post Updated Successfully');
        }

    public function destroy(Post $post)
        {
        //
            $post->delete();            
            return redirect()->route('post.index')->with('success','Post Deleted successfully');
        }


     public function show($id)
        {
            $comments = Comment::all();
            $post = Post::find($id);
            
            //return view('post.show', compact('post','comments'));

            //return view('post.show', compact('post'));

              return View('post.show')->with(['post' => $post,'comments' => $comments]);
        }


     public function userposts()
        {
            $posts = Post::all();
            $posts=Post::paginate(10);
            return view('post.userpost', compact('posts'));
        }

     public function blog()
        {
            $posts = Post::latest()->paginate(10);            
            return view('post.index', compact('posts'));

        }

        public function myPost()
        {
            //
            $users = User::all();
            //$posts = Post::latest()->paginate(10); 
            //$posts = Posts::where('user_id','=',auth()->user()->id)->findOrFail($id);

            //$posts = Post::where('user_id','=',Auth::user()->id);
            $posts = Post::where('user_id', Auth::user()->id)->get();

            //$posts = $user->posts()->get();
            //$posts = Post::with('user')->get();           
            //return view('manager.mypost', compact('posts','users'));

           // $posts = Post::all();

            return view('post.mypost', compact('posts'));
        }

}
