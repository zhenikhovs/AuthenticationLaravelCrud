<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    function GetIndexPage()
    {
        $rubrics = app('App\Http\Controllers\RubricController')->GetRubrics();
        $articles = app('App\Http\Controllers\ArticleController')->GetArticles();
        return view('index', compact('rubrics', 'articles'));
    }

    function GetRubricPage($rubric_id){
        $rubrics = app('App\Http\Controllers\RubricController')->GetRubrics();
        $currentRubric = app('App\Http\Controllers\RubricController')->GetCurrentRubric($rubric_id);
        $rubricArticles = app('App\Http\Controllers\RubricController')->GetRubricArticles($rubric_id);
        return view('rubric')
            ->with([
                'rubrics' => $rubrics,
                'currentRubric' => $currentRubric,
                'rubricArticles'=>$rubricArticles
            ]);
    }

    function GetArticlePage($article_id){
        $rubrics = app('App\Http\Controllers\RubricController')->GetRubrics();
        $article = app('App\Http\Controllers\ArticleController')->GetArticle($article_id);
        return view('article')
            ->with([
                'rubrics' => $rubrics,
                'article'=>$article
            ]);
    }

    function AddArticleForm($rubric_id){
        $rubrics = app('App\Http\Controllers\RubricController')->GetRubrics();
        $currentRubric = app('App\Http\Controllers\RubricController')->GetCurrentRubric($rubric_id);
        $images = array_slice(scandir($_SERVER['DOCUMENT_ROOT'].'/images'),2) ;
        return view('add')
            ->with([
                'rubrics' => $rubrics,
                'currentRubric' => $currentRubric,
                'images' => $images
            ]);
    }

    function UpdateArticleForm(Article $article_id){

        $rubrics = app('App\Http\Controllers\RubricController')->GetRubrics();
        $currentRubric = app('App\Http\Controllers\RubricController')->GetCurrentRubric($_GET['rubric_id']);
        $images = array_slice(scandir($_SERVER['DOCUMENT_ROOT'].'/images'),2) ;
        return view('update')
            ->with([
                'rubrics' => $rubrics,
                'currentRubric' => $currentRubric,
                'currentArticle' => $article_id,
                'images' => $images
            ]);
    }
}
