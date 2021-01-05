<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
//use App\Http\Controllers\API\BaseController as BaseController;
use App\Article;

class ArticleController extends Controller
{
    
    public function index(){
        $article = Article::all();

        return response()->json($article);
    }

    public function create(Request $request){
        $article = new Article();
        $article->title = $request->input('title');
        $article->body =  $request->input('body');

        //return response()->json($request);
        //$article->created_at = $request->input('created_at');

        $article->save();
        return response()->json($article);
    }

    public function show($id){
        $article = Article::find($id);

        if (is_null($article)) {
            return response()->json("Article does not found");
        }

        return response()->json($article);
    }

    public function update(Request $request,$id){
        $article = Article::findOrFail($id);
        if(is_null($article)){
            return response()->json("Article does not found");
        }else{
            //return response()->json($request);
            
            $input = $request->all();
            //return response()->json($input);
            //return response()->json($article);
            $validator = Validator::make($input, [
                'title' => 'required',
                'body' => 'required'
            ]);
    
            if($validator->fails()){
                return response()->json("Invalid formate");
            }
            
            
            $article->update($request->all());
            return response()->json($article);
        }
        
    }

    public function delete(Request $request, $id){
        $article = Article::findOrFail($id);
        if(is_null($article)){
            return response()->json("Article is not found");
        }
        $article->delete();
        return response()->json("Article deleted successfully");
    }
}
