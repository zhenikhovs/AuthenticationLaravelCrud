@extends('layouts.mainlayout')
@section('content')
<header>
    <div class="row">
        <h1>Новости науки</h1>
    </div>
</header>
<section>
    <div class="section_main">
        <div class="row">
            <section class="eight columns">
                @foreach($articles as $article)
                    <article class="blog_post">
                        <div class="three columns">
                            <a href="{{ route('articlePage',['article_id'=>$article['id']]) }}" class="th"><img src="{{asset('images/' . $article['image'])}}" alt="desc" /></a>
                        </div>
                        <div class="nine columns">
                            <a href="{{ route('articlePage',['article_id'=>$article['id']]) }}"><h4>{{$article['title']}}</h4></a>
                            <p> {{$article['lid']}}</p>
                        </div>
                    </article>
                @endforeach
            </section>

        </div>
    </div>
</section>

<section>
    <div class="section_dark">
        <div class="row">
            <h2></h2>
            <div class="two columns">
                <img src="images/thumb1.jpg" alt="desc" />
            </div>

            <div class="two columns">
                <img src="images/thumb2.jpg" alt="desc" />
            </div>

            <div class="two columns">
                <img src="images/thumb3.jpg" alt="desc" />
            </div>

            <div class="two columns">
                <img src="images/thumb4.jpg" alt="desc" />
            </div>

            <div class="two columns">
                <img src="images/thumb5.jpg" alt="desc" />
            </div>

            <div class="two columns">
                <img src="images/thumb6.jpg" alt="desc" />
            </div>
        </div>
    </div>
</section>
@endsection
