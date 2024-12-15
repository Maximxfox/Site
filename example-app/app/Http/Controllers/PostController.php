<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
// Use the Post Model
use App\Models\Post;
// We will use Form Request to validate incoming requests from our store and update method
use App\Http\Requests\Post\StoreRequest;
use App\Http\Requests\Post\UpdateRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index(): Response
    {
        return response()->view('posts.index', [
            'posts' => Post::orderBy('updated_at', 'desc')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return response()->view('posts.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('featured_image')) {

            $file = Storage::disk('public')->put('images/posts/featured-images', request()->file('featured_image'), 'public');

            $path = Storage::url($file);
            $validated['featured_image'] = $path;
        }


        $validated['user_id'] = auth()->id(); 

        $create = Post::create($validated);

        if ($create) {
            session()->flash('notif.success', 'Post created successfully!');
            return redirect()->route('posts.index');
        }

        return abort(500);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id): Response
    {
        return response()->view('posts.show', [
            'post' => Post::findOrFail($id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    const TIME_LIMIT_HOURS = 1;
    public function edit(string $id): Response|RedirectResponse
    {
        $post = Post::findOrFail($id);

        // Check if the post creation time is older than the allowed time limit
        if ($post->created_at->diffInMinutes(Carbon::now()) > self::TIME_LIMIT_HOURS) {
            return redirect()->route('posts.index')->with('notif.error', 'You cannot edit this post because more than ' . self::TIME_LIMIT_HOURS . ' hours have passed since its creation.');
        }
    
        return response()->view('posts.form', [
            'post' => $post,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id): RedirectResponse
    {
        $post = Post::findOrFail($id);
        $validated = $request->validated();

        if ($request->hasFile('featured_image')) {
            // get current image path and replace the storage path with public path
            $currentImage = str_replace('/storage', '/public', $post->featured_image);
            // delete current image
            Storage::delete($currentImage);

            $file = Storage::disk('public')->put('images/posts/featured-images', request()->file('featured_image'), 'public');
            $path = Storage::url($file);
            $validated['featured_image'] = $path;
        }

        $update = $post->update($validated);

        if($update) {
            session()->flash('notif.success', 'Post updated successfully!');
            return redirect()->route('posts.index');
        }

        return abort(500);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $post = Post::findOrFail($id);

        // Check if the post creation time is older than the allowed time limit
        if ($post->created_at->diffInMinutes(Carbon::now()) > self::TIME_LIMIT_HOURS) {
            return redirect()->route('posts.index')->with('notif.error', 'You cannot delete this post because more than ' . self::TIME_LIMIT_HOURS . ' hours have passed since its creation.');
        }
    
        // Delete the post's image from storage if it exists
        if ($post->featured_image) {
            $currentImagePath = str_replace('/storage', '/public', $post->featured_image);
            Storage::delete($currentImagePath);
        }
    
        // Delete the post from the database
        $delete = $post->delete();
    
        if ($delete) {
            session()->flash('notif.success', 'Post deleted successfully!');
            return redirect()->route('posts.index');
        }
    
        return abort(500);
    }
}