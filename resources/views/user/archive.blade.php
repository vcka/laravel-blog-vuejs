@extends('user/app')

@section('bg-img',asset('user/img/home-bg.jpg'))
@section('head')
<link rel="stylesheet" href="{{ asset('user/css/prism.css') }}">
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="//cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.2/components/icon.min.css" rel="stylesheet">
<link href="//cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.2/components/comment.min.css" rel="stylesheet">
<link href="//cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.2/components/form.min.css" rel="stylesheet">
<link href="//cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.2/components/button.min.css" rel="stylesheet">
<link href="{{ asset('/vendor/laravelLikeComment/css/style.css') }}" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
<style>
    li {
        list-style: none;
    }    
</style>

@endsection

@section('main-content')
<div class="container">
    <div class="row">
        <div style="font-size: 30px;"><strong>Archive Post By Year & Month</strong></div>
        <ul style="margin-left: -40px;">
            @foreach ($data as $key => $row)

            <li><a href='{{ URL::to('/archive/' . $key) }}'>{{ $key }} ({{ $row['total_post'] }})</a></li>
            <ul>
                @foreach($row['months'] as $mkey => $month)
                <li><a href='{{ URL::to('/archive/' . $key . '/' . $month['month']) }}'>{{ $mkey }} ({{ $month['count'] }})</a></li>
                @endforeach
            </ul>
            @endforeach
        </ul>
        <div style="font-size: 30px;"><strong>Archive Post By Category</strong></div>
        <ul style="margin-left: -40px;">
            @foreach ($postByCategory as $key => $row)
            <li><a href='{{ URL::to('/post/category/' . $row['slug']) }}'>{{ $row['name'] }} ({{ $row['post_count'] }})</a></li>            
            @endforeach
        </ul>

    </div>
</div>

@endsection
@section('footer')

@endsection