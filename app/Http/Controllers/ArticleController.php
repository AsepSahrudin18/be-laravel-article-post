<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    Article,

};
use Carbon\Carbon;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        // Mendapatkan nilai limit dan offset dari query parameter
        $limit = $request->query('limit', 10); // Default limit 10 jika tidak ada parameter limit
        $offset = $request->query('offset', 0);

        // Validasi $limit dan $offset
        $validatedLimit = max(1, min($limit, 100)); 
        $validatedOffset = max(0, $offset);

        // Mengambil data artikel dengan paging menggunakan limit dan offset
        $articles = Article::skip($validatedOffset)->take($validatedLimit)->get();

        if($articles->count() > 0){
            $data = [
                "message" => "Get All Resources",
                "data" => $articles
            ];

            return response()->json($data, 200);
        } else {
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
        // dd($request->all());
        // Validasi input
        $validatedData = $request->validate([
            'title'     => 'required|min:20',
            'content'   => 'required|min:200',
            'category'  => 'required|min:3',
            'status'    => 'required|in:publish,draft,trash',
        ]);

        $article = Article::find($id);
        
            if($article){
                $input = [
                    'title'         => $validatedData['title'] ?? $article->title,
                    'content'       => $validatedData['content'] ?? $article->content,
                    'category'      => $validatedData['category'] ?? $article->category,
                    'status'        => $validatedData['status'] ?? $article->status,
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
            'title'     => 'required|min:20',
            'content'   => 'required|min:200',
            'category'  => 'required|min:3',
            'status'    => 'required|in:publish,draft,trash',
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
