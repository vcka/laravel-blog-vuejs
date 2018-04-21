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
<div class="col-lg-8">
    <div style="margin-top: 100px;border: 1px solid red;padding: 20px;">
        Sorry, this is not a valid page.    
    </div>    
</div>
@endsection
@section('footer')

@endsection