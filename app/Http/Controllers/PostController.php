<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\Post;
use App\Models\User;


class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    public function index(){

        //$posts = new post;
        //$posts = Post::all();
        //dd($posts);
        //$posts = auth()->user()->posts()->paginate(5);
        //return view('admin.posts.index',['posts'=>$posts]);
        ///return view('admin.posts.index',compact('posts'));

        $posts = Post::all();   //<!-- {{$posts->links()}} --> //add this in admin.post.index after adding pagination here.

        return view('admin.posts.index')->with(compact('posts'));

       

    }
    public function show(Post $post){
        //$posts = post::findOrFail($post);
        //print_r($post);
        $this->authorize('view',$post);
        return view('blog-post',['post'=>$post]);
        //return view('blog-post',compact($post));
    }

    public function create(){

        return view('admin.posts.create');

    }


    public function store(post $post, Request $request){

        //$this->Authorize('store',$post);

        $input = $request->validate([
            'title'=>'required|unique:posts|max:255',
            //'post_image'=>'file',
            'body'=>'required',

        ]);
        //echo "Post is valid";
        if(request('post_image')){
            $input['post_image'] = $request->post_image;
            //->store('images')
        }

        auth()->User()->Posts()->create($input);

        Session()->flash('Post_created_message','Post is created');

        return redirect()->route('posts.index');
    }

    // public function destroy(post $post){
    //     $post->delete();
    //     Session::flash('message','Post is deleted');
    //     return back();
    // }

    public function edit(post $post){
        if(auth()->user()){  //->can('view',$post)
        //$request->Session()->flash('message','Post is edited');
        //$this->Authorize('view',$post);
        return view('admin.posts.edit',['post'=>$post]);
    }
    }

    public function destroy(post $post, Request $request ){
        $this->Authorize('delete',$post);
        $post->delete();
        $request->Session()->flash('message','Post is deleted');
        return back();
    }

    public function update(post $post,Request $request){
        
        //$request->Session()->flash('message','Post is deleted');

        $input = $request->validate([
            'title'=>'required|unique:posts|max:255',
            //'post_image'=>'file',
            'body'=>'required',
        ]);
        if(request('post_image')){
            $input['post_image'] = $request->post_image;
            $post->post_image =  $input['post_image'];
        }
        $post->title =  $input['title'];
        $post->body =  $input['body'];
        
        $this->Authorize('update',$post);
        
        //auth()->user()->posts()->save($post); //update the post adn the ownerby logedin user
        $post->save();  //update the post without updating the owner by logedin user
        $request->Session()->flash('update_message','Post is Updated');
        return redirect()->route('posts.index');
    }
}
