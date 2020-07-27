<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Repositories\PostRepository;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Storage;
use Session;

class PostsController extends Controller
{   
    public $posts;

    public function __construct(Post $posts)
    {   
        
        $this->posts = new PostRepository($posts);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Post $post)
    {   
        $posts = $this->posts->getAll();
        
        return view('posts.index')->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {  
        $this->posts->create($request);
        Session::flash('success','Post Created Successfully');
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $posts = $this->posts->show($id);
        return view('posts.edit')->with('posts',$posts);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request,$id)
    {   
        $this->posts->update($request,$id);
        Session::flash('success','Post Updated Successfully');
        return redirect()->route('posts.index');
    }

    /**
     * Trashed the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {  
        $post = Post::withTrashed()->findOrFail($id);
        $post->trashed() ? $post->forceDelete() && \Storage::delete($post->image) : $this->posts->delete($id);
        Session::flash('success','Post Deleted Successfully');
        return redirect()->route('posts.index');
    }

    /**
     * Show Trashed
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function trashed()
    {   
        $posts = Post::onlyTrashed()->paginate(\Config::get('default.perPage'));
        return view('posts.index')->with('posts',$posts);
    }


   
}