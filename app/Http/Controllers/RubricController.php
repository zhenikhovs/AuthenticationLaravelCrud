<?php

namespace App\Http\Controllers;

use App\Models\ArticleRubric;
use App\Models\Rubric;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RubricController extends Controller
{
    function GetRubrics(){
        return Rubric::all()->toArray();
    }

    function GetCurrentRubric($rubric_id){
        return Rubric::where('id','=',$rubric_id)->first()->toArray();
    }

    function GetRubricArticles($rubric_id){

        $rubricArticles = ArticleRubric::
        join('articles', 'article_id', 'articles.id')
            ->where('rubric_id', '=',$rubric_id)
            ->get()
            ->toArray();
        return $rubricArticles;
    }
}
