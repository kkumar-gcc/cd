<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBlogRequest;
use App\Models\Blog;
use App\Models\BlogView;
use App\Models\Comment;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use Jorenvh\Share\ShareFacade;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show', 'tagSearch']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view("blogs.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Blog::class);
        return view("blogs.create");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $slug)
    {
        $blog = Blog::where("slug", $slug)->first();
        $this->authorize('view', $blog);
        if ($blog) {
            $shareBlog =  ShareFacade::currentPage()->facebook()
                ->twitter()
                ->linkedin()
                ->telegram()
                ->whatsapp()
                ->reddit()
                ->getRawLinks();
            $existView = BlogView::where([['ip_address', "=", $request->ip()], ["blog_id", "=", $blog->id]])->count();
            if ($existView < 1) {
                $newView = new BlogView();
                $newView->ip_address = $request->ip();
                $newView->blog_id = $blog->id;
                $newView->save();
            }

            return view("blogs.show")->with([
                "blog" => $blog,
                "shareBlog" => $shareBlog,
            ]);
        }
        return abort(404);;
    }
    public function edit($slug)
    {
        $blog = Blog::where("slug", $slug)->first();
        $this->authorize('update', $blog);
        if ($blog) {
            return view("blogs.update")->with(["blog" => $blog]);
        }
    }
    public function manage($slug)
    {
        $blog = Blog::where("slug", $slug)->first();
        $this->Authorize('update', $blog);
        if ($blog) {
            return view("blogs.manage")->with([
                "blog" => $blog,
            ]);
        }
        return abort(404);
    }
    public function seo(Request $request)
    {

        if (auth()->user()->id == $request->get('user_id')) {
            $blogId = $request->get('blog_id');
            $blog = Blog::find($blogId);
            if ($blog) {
                if ($request->get('user_id') == auth()->user()->id) {
                    $blog->meta_title = $request->get('seo_title');
                    $blog->meta_description = $request->get('seo_description');
                    $saved = $blog->save();
                    return response()->json(["success" => "SEO settings updated successfully."]);
                }
            }
        }
        return view("error");
    }
    public function stats($slug)
    {
        $blog = Blog::where("slug", $slug)->first();
        $this->Authorize('update', $blog);
        if ($blog) {
            return view("blogs.stats")->with([
                "blog" => $blog,
            ]);
        }
        return abort(404);
    }
    public function manageStore(Request $request)
    {
        if (auth()->user()->id == $request->get('user_id')) {
            $blogId = $request->get('blog_id');
            $blog = Blog::find($blogId);
            if ($blog) {
                if ($request->get('user_id') == auth()->user()->id) {
                    $blog->access = $request->get('blog_access');
                    $blog->comment_access = $request->get('comment_access');
                    $blog->adult_warning = $request->boolean('adult_warning');
                    $blog->age_confirmation  = $request->boolean('age_confirmation');
                    $saved = $blog->save();
                    return response()->json(["success" => "Blog updated successfully."]);
                }
            }
        }
        return view("404");
    }
    public function tagSearch(Request $request, $slug)
    {
        $searchTag = Tag::where("title", "=", $slug)->first();
        return view("blogs.tagged")->with([
            "searchTag" => $searchTag
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        $this->authorize('delete', $blog);
        $blog->delete();
        return redirect('/blogs')->with(["deleteSuccess" => "blog deleted successfully."]);
    }
}
