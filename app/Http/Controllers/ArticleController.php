<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleRubric;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    function GetArticles(){
        return Article::all()->toArray();
    }

    function GetArticle($article_id){
        return Article::
        select('articles.title','articles.lid','articles.content','articles.image','rubrics.id','rubrics.name')
            ->join('article_rubrics', 'articles.id', 'article_rubrics.article_id')
            ->join('rubrics', 'article_rubrics.rubric_id', 'rubrics.id')
            ->where('articles.id',$article_id)->first();
    }

    public function AddArticle(){
        $requestData = request()->validate(
            [
                'title' => 'required|max:255',
                'lid' => 'required|max:255',
                'content' => 'required',
                'image' => 'required|max:255',
                'rubric_id' => 'required|int'
            ],['title.required' => 'НЕТУ ЗАГОЛОВКА',
            'title.max' => 'МЕНЬШЕ БУКВ',
            'lid.required' => 'НЕТУ ЛИДА',
            'lid.max' => 'МЕНЬШЕ БУКВ',
            'content.required' => 'НЕТУ КОНТЕНТА',
            'image.required' => 'НУЖНО ВЫБРАТЬ ИЗОБРАЖЕНИЕ',
            'image.max' => 'МЕНЬШЕ БУКВ',
            'rubric_id.required' => 'НУЖНО ВЫБРАТЬ РУБРИКУ']);
        $articleId=DB::table('articles')->insertGetId(
            [ 'title' => $requestData['title'],
                'lid' => $requestData['lid'],
                'content' => $requestData['content'],
                'image' => $requestData['image']
            ]
        );
        DB::table('article_rubrics')->insertGetId(
            ['article_id'=>$articleId, 'rubric_id'=>$requestData['rubric_id']]
        );
        return redirect( route('rubricPage',['rubric_id'=>$requestData['rubric_id']]));
    }

    function UpdateArticle(Article $article_id){
        $requestData = request()->validate(
            [
                'title' => 'required|max:255',
                'lid' => 'required|max:255',
                'content' => 'required',
                'image' => 'required|max:255',
                'rubric_id' => 'required|int'
            ],['title.required' => 'НЕТУ ТИТЛА',
            'title.max' => 'МЕНЬШЕ БУКВ',
            'lid.required' => 'НЕТУ ЛИДА',
            'lid.max' => 'МЕНЬШЕ БУКВ',
            'content.required' => 'НЕТУ КОНТЕНТА',
            'image.required' => 'НУЖНО ВЫБРАТЬ ИЗОБРАЖЕНИЕ',
            'image.max' => 'МЕНЬШЕ БУКВ',
            'rubric_id.required' => 'НУЖНО ВЫБРАТЬ РУБРИКУ']);
        $article_id->update([ 'title' => $requestData['title'],
            'lid' => $requestData['lid'],
            'content' => $requestData['content'],
            'image' => $requestData['image']
        ]);
        $article_id->save();

        $articleRubric = ArticleRubric::where('article_id','=',$article_id['id'])->first();
        $articleRubric->update(['article_id'=>$article_id['id'], 'rubric_id'=>$requestData['rubric_id']]);
        $articleRubric->save();

        return redirect(route('rubricPage',['rubric_id'=>$requestData['rubric_id']]));
    }

    public function DeleteArticle(Article $article_id) {
        $article_id->delete();
        return redirect(route('rubricPage',['rubric_id'=> $_GET['rubric_id']]));
    }
}
