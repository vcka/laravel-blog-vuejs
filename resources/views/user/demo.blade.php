@extends('user/app')
@section('head')
<style>
    .fa-thumbs-up:hover{
        color:#f41115;
    }
</style>
@endsection
@section('main-content')
<!-- Blog Entries Column -->
<div class="col-md-8">

    <h1 class="my-4">Welcome to Gaana Blog
        <small>Home</small>
    </h1>
    @foreach ($posts as $post)    
    <!-- Blog Post -->
    <div class="card mb-4">
        <img class="card-img-top" src="{{ asset('/user/img/home-bg.jpg') }}" alt="{{ $post->title }}" title="{{ $post->title }}">
        <div class="card-body">
            <h2 class="card-title">{{ $post->title }}</h2>
            <p class="card-text">{!! htmlspecialchars_decode(preg_replace('/\s+?(\S+)?$/', '', substr($post->body, 0, 300))) !!}</p>
            <a href="{{ URL::to('post/' . $post->slug) }}" class="btn btn-primary">Read More &rarr;</a>
        </div>
        <div class="card-footer text-muted">
            Posted on {{ $post->created_at }} by
            <a href="https://gaana.com/" target="_blank">Gaana.com</a>
            <span class="likeIt" data-postid="{{ $post->id }}">
                <small id="likeit{{ $post->id }}">{{ count($post->likes) }}</small>
                <i class="fa fa-thumbs-up" aria-hidden="true"></i>
            </span>
        </div>
    </div>
    @endforeach
    <!-- Pagination -->
    <ul class="pagination justify-content-center mb-4">
        <li class="page-item">
            <a class="page-link" href="#">&larr; Older</a>
        </li>
        <li class="page-item disabled">
            <a class="page-link" href="#">Newer &rarr;</a>
        </li>
    </ul>
</div>
@endsection
@section('footer')
<script type="text/javascript">
    function likeIt(postId) {
        var isLoggedIn = "<?php echo Auth::check() ?>";
        if (isLoggedIn) {
            $.post('/saveLike', {
                id: postId,
                _token: "{{ csrf_token() }}"
            }, function (response) {
                console.log(response);
                var previousLike = parseInt($('#likeit' + postId).text());
                if (response === 'deleted') {
                    previousLike -= 1;
                } else {
                    previousLike += 1;
                }
                $('#likeit' + postId).html(previousLike);
            });
        } else {
            window.location = 'login'
        }
    }

    $(document).on('click', '.likeIt', function (e) {
        e.preventDefault();
        var postId = $(this).attr('data-postid');
        likeIt(postId);
    });

</script>
@endsection