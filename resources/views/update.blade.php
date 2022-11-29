<?php
$is_admin =  app('App\Http\Controllers\UserController')->is_admin();
?>


@extends('layouts.mainlayout')
@section('content')
    @if(count($errors)>0)
        <div class="errors">
            <ul> @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div style="margin-top: 150px;">
        <form method="POST" action="{{route('updateArticle',['article_id'=>$currentArticle['id']])}}" style=" margin:10px auto; width: 500px">
            @method('PUT')
            <div >Заголовок статьи <textarea class="input" name="title">{{$currentArticle['title']}}</textarea></div>
            <div>Лид <textarea class="input" name="lid">{{$currentArticle['lid']}}</textarea></div>
            <div>Контент <textarea  class="input" name="content">{{$currentArticle['content']}}</textarea></div>
            <div>Рубрика
                <select name="rubric_id" >
                    @foreach($rubrics as $rubric)
                        <option value="{{$rubric['id']}}"
                        @if($rubric['id'] == $currentRubric['id']) selected @endif
                            >{{$rubric['name']}}</option>
                    @endforeach
                </select>
            </div>

            <div>Изображение
                <select name="image" >
                    @foreach($images as $image)
                        <option value="{{$image}}" @if($currentArticle['image'] == $image) selected @endif>{{$image}}</option>
                    @endforeach
                </select>
            </div>
            <button class="add_btn" type="submit">Изменить статью</button>
            {{ csrf_field() }}
        </form>
    </div>
@endsection
