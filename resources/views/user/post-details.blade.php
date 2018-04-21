@extends('user/app')
@section('head')
<style>
    .fa-thumbs-up:hover{
        color:#f41115;
    }
</style>
<!--link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css"-->
@endsection
@section('main-content')
<!-- Blog Entries Column -->    
<div id="app"></div>
    <?php /* @include('laravelLikeComment::comment', ['comment_item_id' => 3]); */ ?>
@endsection
@section('footer')
<script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
@endsection