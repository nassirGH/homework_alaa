<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * index
     *
     * @return View
     */
    public function index(): View
    {
        //get posts
        $posts = Post::latest()->paginate(5);

        //render view with posts
        return view('posts.index', compact('posts'));
    }

    /**
     * create
     *
     * @return View
     */
    public function create(): View
    {
        $categories = Category::all();

        return view('posts.create', compact('categories'));
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate form
        $this->validate($request, [
            'image'     => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'title'     => 'required|min:5',
            'content'   => 'required|min:10',
        ]);

        // Upload image
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension(); // Generate unique name
        $image->move(public_path('images'), $imageName); // Move to public/images

        // Create post
        Post::create([
            'image'     => $imageName,
            'title'     => $request->title,
            'content'   => $request->content,
            'category_id'   => $request->category_id,
        ]);

        // Redirect to index
        return redirect()->route('posts.index')->with(['success' => 'Created successfully!']);
    }

    /**
     * show
     *
     * @param  mixed $id
     * @return View
     */
    public function show(string $id): View
    {
        //get post by ID
        $post = Post::findOrFail($id);
        $categories = Category::findOrFail($id);

        //render view with post
        return view('posts.show', compact('post', 'categories'));
    }

    /**
     * edit
     *
     * @param  mixed $id
     * @return void
     */
    public function edit(string $id): View
    {
        //get post by ID
        $post = Post::findOrFail($id);
        $categories = Category::all();

        //render view with post
        return view('posts.edit', compact('post', 'categories'));
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //validate form
        $this->validate($request, [
            'image'     => 'image|mimes:jpeg,jpg,png|max:2048',
            'title'     => 'required|min:5',
            'content'   => 'required|min:10'
        ]);

        //get post by ID
        $post = Post::findOrFail($id);

        //check if image is uploaded
        if ($request->hasFile('image')) {

            //upload new image
            $image = $request->file('image');
            $image->storeAs('public/posts', $image->hashName());

            //delete old image
            Storage::delete('public/posts/' . $post->image);

            //update post with new image
            $post->update([
                'image'     => $image->hashName(),
                'title'     => $request->title,
                'content'   => $request->content,
                'category_id'   => $request->category_id
            ]);
        } else {

            //update post without image
            $post->update([
                'title'     => $request->title,
                'content'   => $request->content,
                'category_id'   => $request->category_id
            ]);
        }

        //redirect to index
        return redirect()->route('posts.index')->with(['success' => 'Updated successfully!']);
    }

    /**
     * destroy
     *
     * @param  mixed $post
     * @return void
     */
    public function destroy($id): RedirectResponse
    {
        //get post by ID
        $post = Post::findOrFail($id);

        //delete image
        Storage::delete('public/posts/' . $post->image);

        //delete post
        $post->delete();

        //redirect to index
        return redirect()->route('posts.index')->with(['success' => 'Deleted successfully!']);
    }
}
