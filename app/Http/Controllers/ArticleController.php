<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use App\Article;
use App\ArticleImage;
use Auth;
use Storage;

class ArticleController extends Controller
{
    public function getAllArticles()
    {
        $articles = Article::with('articleImages')->orderBy('created_at', 'desc')->get();
        return response()->json(['error' => false, 'data' => $articles]);

    }

    public function getPaginatedArticles(Request $request)
    {
        $articles = Article::with('articleImages', 'author', 'ratings', 'category')->orderBy('created_at', 'desc')->paginate($request->numOfItems);
        return  response()->json(['error' => false, 'data' => $articles]);
    }

    public function createArticle(Request $request)
    {
        $user = Auth::user();
        $title = $request->title;
        $body = $request->body;
        $images = $request->images;
        $categoryId = $request->cetegoryId;

        $article = Article::create([
            'title' => $title,
            'body' => $body,
            'user_id' => $user->id,
            'category_id' => $categoryId
        ]);

        if ($images !== null){
            foreach ($images as $image) {
                $imagePath = Storage::disk('uploads')->put($user->email . '/articles/' . $article->id, $image);
                ArticleImage::create([
                    'article_image_caption' => $title,
                    'article_image_path' => '/uploads/' . $imagePath,
                    'article_id' => $article->id,
                ]);
            }
        }

        return response()->json(['error' => false, 'data' => $article]);

    }
}
