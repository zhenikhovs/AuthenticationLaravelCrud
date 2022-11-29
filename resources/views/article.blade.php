@extends('layouts.mainlayout')
@section('content')
<header>
    <div class="row">
        <a href="{{ route('rubricPage',['rubric_id'=>$article['id']]) }}"><h4>{{$article['name']}}</h4></a>
        <article>
            <div class="twelve columns">
                <h1>{{$article['title']}}</h1>
                <p class="excerpt">
                    {{$article['lid']}}
                </p>
            </div>
        </article>
    </div>
</header>

<section class="section_light">
    <div class="row">
        <img src="{{asset('images/' . $article['image'])}}" alt="desc" width=400 align=left hspace=30>
        <p>
            {{$article['content']}}
        </p>
    </div>
</section>
@endsection
