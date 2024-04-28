<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    Article,

};
use Carbon\Carbon;

class ArticleController extends Controller
{
    public function index($limit, $offset)
    {
        // Validasi $limit dan $offset
        $validatedLimit = max(1, min($limit, 100)); 
        $validatedOffset = max(0, $offset);

        $articles = Article::skip($validatedOffset)->take($validatedLimit)->get();
        if($articles){
            // membuat deskripsi/keterangan
            $data = [
                "message" => "Get All Resource",
                "data" => $articles
            ];

            return response()->json($data, 200);
        }else{
            $data = [
                "message" => "Resource Not Found"
            ];
            return response()->json($data, 404);
        }
    }

    public function show($id)
    {
        $article = Article::find($id);

        if($article) {
            $data = [
                "message"   => "Get Detail Resource",
                "data"      => $article
            ];
            return response()->json($data, 200);
        }else{
            $data = [
                "message" => "Data Not Found"
            ];
            return response()->json($data, 404);
        }
    }

    public function update(Request $request, $id)
    {
        $article = Article::find($id);
        
            if($article){
                $input = [
                    'title'         => $request->title ?? $article->title,
                    'content'       => $request->content ?? $article->content,
                    'category'      => $request->category ?? $article->category,
                    'status'        => $request->status ?? $article->status,
                    'updated_at'  => Carbon::now(),
                ];
                $article->update($input);
    
                $data = [
                    'message' => 'Resource is update successfully',
                    'data' => $article
                ];
                
                return response($data, 200);
            }elseif(!$article) {
                $data = [
                    'message' => 'Resource not found',
                ];
                return response()->json($data, 404);
            }
    }

    public function destroy($id)
    {
        $article = Article::find($id);

        if($article){
            $article->delete();

            return response()->json(['message' => 'Article is Delete Successfully!'], 204);
        }elseif($article){
            return response()->json(['message' => 'Resource Not Found'], 404);
        }
    }

    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'title' => 'required|min:20',
            'content' => 'required|min:200',
            'category' => 'required|min:3',
            'status' => 'required|in:publish,draft,trash',
        ]);
        
        // Buat artikel baru dengan data yang divalidasi
        $input['title']         = $validatedData['title'];
        $input['content']       = $validatedData['content'];
        $input['category']      = $validatedData['category'];
        $input['status']        = $validatedData['status'];
        $input['updated_at']    = Carbon::now();
        $article = Article::create($input);

        // Kirim respons JSON
        $data['message'] = "Article is Created";
        $data['data'] = $article;

        return response()->json($data, 201);
    }

}
