<?php
    $is_admin =  app('App\Http\Controllers\UserController')->is_admin();
    ?>
@extends('layouts.mainlayout')
@section('content')
<header>
    <div class="row">
        <a href="/">
            <h1>Новости науки</h1>
        </a>
    </div>
</header>

<section>
    <div class="section_main">
        <div class="row">
            <section class="eight columns">
                <h3>{{$currentRubric['name']}}</h3>
                @foreach($rubricArticles as $article)

                <article class="blog_post">
                    <div class="three columns">
                        <a href="{{ route('articlePage',['article_id'=>$article['id']]) }}" class="th">
                            <img src="{{asset('images/' . $article['image'])}}" alt="desc" />
                        </a>
                    </div>
                    <div class="nine columns">
                        <a href="{{ route('articlePage',['article_id'=>$article['id']]) }}">
                            <h4>{{$article['title']}}</h4>
                        </a>
                        <p> {{$article['lid']}}</p>
                        <div>
                            @if($is_admin)
                                <div style="display: flex; gap: 10px">
                                    <a href="{{ route('updateArticleForm',['article_id'=>$article['id'],'rubric_id'=>$currentRubric['id']]) }}" >
                                        <button class="update_btn" type="submit">Изменить</button>
                                    </a>
                                    <form action=
                                              "{{ route('deleteArticle',['article_id'=>$article['id'], 'rubric_id'=>$currentRubric['id']]) }}" method="POST">
                                        @method('DELETE')
                                        <button class="remove_btn" type="submit">Удалить</button>
                                        {{ csrf_field() }}
                                    </form>

                                </div>

                            @endif
                        </div>
                    </div>
                </article>
                @endforeach
            </section>
            @auth
                @if($is_admin)
                    <section class="four columns">
                        <H3>  &nbsp; </H3>
                        <div class="panel">
                            <h3>Админ-панель</h3>
                            <ul class="accordion">
                                <li class="active">
                                    <div class="title">
                                        <a href="{{ route('addArticleForm',['rubric_id'=>$currentRubric['id']]) }}"><h5>Добавить статью</h5></a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </section>
                @endif
            @endauth
        </div>
    </div>
</section>


<section>
    <div class="section_dark">
        <div class="row">
            <h2></h2>
            <div class="two columns">
                <img src="{{asset('images/thumb1.jpg')}}" alt="desc" />
            </div>
            <div class="two columns">
                <img src="{{asset('images/thumb2.jpg')}}" alt="desc" />
            </div>
            <div class="two columns">
                <img src="{{asset('images/thumb3.jpg')}}" alt="desc" />
            </div>
            <div class="two columns">
                <img src="{{asset('images/thumb4.jpg')}}" alt="desc" />
            </div>
            <div class="two columns">
                <img src="{{asset('images/thumb5.jpg')}}" alt="desc" />
            </div>
            <div class="two columns">
                <img src="{{asset('images/thumb6.jpg')}}" alt="desc" />
            </div>
        </div>
    </div>

</section>
@endsection
