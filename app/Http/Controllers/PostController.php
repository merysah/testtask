<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Post;
use App\Repositories\PostRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    /**
     * The user repository instance.
     */
    protected $posts;

    /**
     * Create a new controller instance.
     *
     * @param  PostRepository  $posts
     * @return void
     */
    public function __construct(PostRepository $posts)
    {
        $this->posts = $posts;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allPosts = $this->posts->paginate();
        return view('posts.index', compact('allPosts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $post = new Post();
        return view('posts.create', compact('post'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $this->imgUpload($request['image']);
        $data = [
            'user_id' => Auth::user()->id,
            'title' => $request['title'],
            'description' => $request['description'],
            'image' => $request->image->hashName(),
        ];
        $this->posts->create($data);

        return redirect()->back()->with('status', 'Post has been created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = $this->posts->find($id);
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = $this->posts->find($id);
        if(Auth::user()->isAdmin() || Auth::user()->id == $post->user->id)
        {
            return view('posts.edit', compact('post'));
        } else {
            return redirect()->back()->with('message', 'Oops, seems you don\'t have access to this page.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
        $data = [
            'title' => $request['title'],
            'description' => $request['description'],
        ];
        if ($request->has('image'))
        {
            $this->imgUpload($request['image']);
            $data['image'] = $request->image->hashName();
        }
        $this->posts->update($id, $data);
        return redirect()->back()->with('status', 'Post has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->posts->delete($id);

        return redirect('posts');
    }

    /**
     * Upload the given image
     *
     * @return uploaded image path
     */
    private function imgUpload($img)
    {
        $imagePath = $img->store('uploads', 'public');
        $image = Image::make(public_path("storage/{$imagePath}" ))->fit(1200, 1200);
        $image->save();
        return $imagePath;
    }
}
