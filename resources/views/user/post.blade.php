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

<!-- Facebook OG data -->

<meta property="og:url"                content="{{ URL::to('/' . $post->slug) }}" />
<meta property="og:type"               content="post" />
<meta property="og:title"              content="{{ $post->title }}" />
<meta property="og:description"        content="Listen to Punjabi Romance Top 50 by Gaana. Also enjoy other Popular songs on your favourite music app Gaana.com" />
<meta property="og:image"              content="" />

<!-- Twitter Card data -->
<meta name="twitter:card" content="summary">
<meta name="twitter:url" content="{{ URL::to('/' . $post->slug) }}"/>
<meta name="twitter:site" content="@gaana">
<meta name="twitter:title" content="{{ $post->title }}">
<meta name="twitter:description" content="Listen to Punjabi Romance Top 50 by Gaana. Also enjoy other Popular songs on your favourite music app Gaana.com"/>
<meta name="twitter:creator" content="@Gaana"/>
<meta name="twitter:image:src" content="https://a10.gaanacdn.com/images/playlists/96/4092696/crop_175x175_4092696_1450429091.jpg"/>



<style>
    li {
        list-style: none;
    }

    .post-body {
        margin-top: 130px;
    }
    span.fa.fa-facebook-official {
        border: 1px solid red;
        padding: 6px;
    }
</style>

@endsection
@section('title',$post->title)
@section('sub-heading',$post->subtitle)
@section('main-content')
<div class="col-lg-8">

    <!-- Title -->
    <h1 class="mt-4">{{ $post->title }}</h1>

    <!-- Author -->
    <p class="lead">
        by
        <a href="https://gaana.com/" target="_blank">Gaana.com</a>
    </p>

    <hr>

    <!-- Date/Time -->
    <p>Posted on {{ $post->created_at }}</p>

    <hr>

    <!-- Preview Image -->
    <img class="img-fluid rounded" src="{{ asset('/post_image/' . $post->image) }}" alt="">

    <hr>

    <!-- Post Content -->
    <div>
        <div class="pull-left">
            <?php
            echo Share::page(URL::to('/' . $post->slug), $post->title)
                    ->twitter()
                    ->googlePlus()
                    ->linkedin($post->subtitle)
                    ->facebook();
            ?>
        </div>
        <div class="categories pull-right">
            @foreach ($post->categories as $category)
            <small style="margin-right: 20px;border-radius: 5px;border: 1px solid gray;padding: 5px;">  
                <a href="{{ route('category',$category->slug) }}">{{ $category->name }}</a>
            </small>
            @endforeach
        </div>
    </div>
    <br/>
    <div class="post-body">
        {!! htmlspecialchars_decode($post->body) !!}
    </div>
    <hr>

    <!-- Comments Form -->
    <!--div class="card my-4">
        <h5 class="card-header">Leave a Comment:</h5>
        <div class="card-body">
            <form>
                <div class="form-group">
                    <textarea class="form-control" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div-->

    <!-- Single Comment -->
    <!--div class="media mb-4">
        <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
        <div class="media-body">
            <h5 class="mt-0">Commenter Name</h5>
            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
        </div>
    </div-->

    <!-- Comment with nested comments -->
    <!--div class="media mb-4">
        <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
        <div class="media-body">
            <h5 class="mt-0">Commenter Name</h5>
            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.

            <div class="media mt-4">
                <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
                <div class="media-body">
                    <h5 class="mt-0">Commenter Name</h5>
                    Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                </div>
            </div>

            <div class="media mt-4">
                <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
                <div class="media-body">
                    <h5 class="mt-0">Commenter Name</h5>
                    Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                </div>
            </div>

        </div>
    </div-->
    {{-- Tag clouds --}}
    <h3>Tag Clouds</h3>
    @foreach ($post->tags as $tag)
    <a href="{{ route('tag',$tag->slug) }}"><small class="pull-left" style="margin-right: 20px;border-radius: 5px;border: 1px solid gray;padding: 5px;">
            {{ $tag->name }}
        </small></a>
    @endforeach
    <div style="padding-bottom: 20px;">
        @include('laravelLikeComment::comment', ['comment_item_id' => $post->id])
    </div>
</div>
<?php /*
  <div class="col-lg-8">
  <?php
  echo Share::page(URL::to('/' . $post->slug), $post->title)
  ->facebook()
  ->twitter()
  ->googlePlus()
  ->linkedin($post->subtitle);
  ?>
  <small>Created at {{ $post->created_at }} </small>
  @foreach ($post->categories as $category)
  <small class="pull-right" style="margin-right: 20px">
  <a href="{{ route('category',$category->slug) }}">{{ $category->name }}</a>
  </small>
  @endforeach
  {!! htmlspecialchars_decode($post->body) !!}

  {{-- Tag clouds --}}
  <h3>Tag Clouds</h3>
  @foreach ($post->tags as $tag)
  <a href="{{ route('tag',$tag->slug) }}"><small class="pull-left" style="margin-right: 20px;border-radius: 5px;border: 1px solid gray;padding: 5px;">
  {{ $tag->name }}
  </small></a>
  @endforeach

  @include('laravelLikeComment::comment', ['comment_item_id' => $post->id])

  <!--div class="fb-comments" data-href="{{ Request::url() }}" data-numposts="5"></div-->
  <?php /*
  <div id="app" style="clear: both;margin-top:100px;">
  <comments
  :user = "{{ $userData }}"
  :postid = {{ $post->id }}
  login = "{{ Auth::check() }}"
  >
  </comments>
  @foreach($comments as $comment)
  <div class="col-sm-12" style="margin-left: -15px;width: 780px; margin-top:10px;">
  <div class="panel panel-white post panel-shadow">
  <div class="post-heading">
  <div class="pull-left image">
  <img src="http://bootdey.com/img/Content/user_1.jpg" class="img-circle avatar" alt="user profile image">
  </div>
  <div class="pull-left meta">
  <div class="title h5">
  <a href="#"><b>{{ $comment->name }}</b></a>
  made a comment.
  </div>
  <h6 class="text-muted time">{{ $comment->created_at->diffForHumans() }}</h6>
  </div>
  </div>
  <div class="post-description">
  <p>{{ $comment->comment }}</p>
  <!--div class="stats">
  <a href="#" class="btn btn-default stat-item">
  <i class="fa fa-thumbs-up icon"></i>2
  </a>
  <a href="#" class="btn btn-default stat-item">
  <i class="fa fa-thumbs-down icon"></i>12
  </a>
  </div-->
  </div>
  <div class="like_comment" data-commentid = {{ $comment->id }} data-postid = {{ $post->id }}>
  <i class="fa fa-thumbs-up"></i>
  <span class="likecount" id="likecount{{ $comment->id }}">{{ $comment->number_of_likes }}</span>
  </div>
  <div id='reply_{{ $comment->id }}' data-person_name = '{{ $comment->name }}' data-comment_id='{{ $comment->id }}' class="reply" style="cursor: pointer;">Reply</div>
  </div>
  </div>
  @endforeach
  </div>
  // ?>
  </div>

  <?php /*
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
  <div class="modal-content">
  <div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
  <h4 class="modal-title" id="myModalLabel">Reply To : <span id="reply_comment_name"></span></h4>
  </div>
  <form method="post" name="formCommentReply" id="formCommentReply">
  <div class="modal-body">
  <div class="comment-preview">
  <input type="hidden" name="parent_comment_id" id="parent_comment_id" />
  <input type="hidden" name="post_id" id="postid" value="{{ $post->id }}" />
  <div class="form-group"><label for="name">Name*:</label> <input id="name" name="name" class="form-control"></div>
  <div class="form-group"><label for="email">Email*:</label> <input id="email" name="email" class="form-control"></div>
  <div class="form-group"><label for="comment">Comment*:</label> <textarea rows="5" id="comment" name="comment" class="form-control"></textarea></div>
  {{ csrf_field() }}
  </div>
  </div>
  <div class="modal-footer">
  <input type="submit" name="submit" value="Add Comment" class="btn btn-success pull-right">
  </div>
  </form>
  </div>
  </div>
  </div>
 */ ?>

<hr>
@endsection
@section('footer')
<script src="{{ asset('user/js/prism.js') }}"></script>
<!--script src="{{ asset('js/app.js') }}"></script-->
<script src="{{ asset('js/share.js') }}"></script>
<script type="text/javascript">
$('.like_comment').click(function () {
    var commentid = $(this).attr('data-commentid');
    var postid = $(this).attr('data-postid');
    var checkLogin = "{{ Auth::check() }}";
    if (checkLogin) {
        var serializedData = {
            commentid: commentid,
            postid: postid,
            _token: document.head.querySelector('meta[name="csrf-token"]').content
        };
        $.post('/commentlike', serializedData, function (response) {
            if (typeof response.response_status !== 'undefined' && response.response_status === 'success') {
                var likeDiv = $('#likecount' + commentid);
                var previous_count = parseInt(likeDiv.text());
                if (response.response_code === 204) {
                    var new_count = previous_count + 1;
                } else if (response.response_code === 203) {
                    var new_count = previous_count - 1;
                }
                likeDiv.text(new_count);
            } else {

            }
            setTimeout(function () {
                $('#message').html('');
            }, 2000);
        }, "json");
    } else {
        window.location = '/login';
    }
});
$('.reply').click(function () {
    var parent_comment_id = $(this).attr('data-comment_id');
    var comment_person_name = $(this).attr('data-person_name');
    $('#reply_comment_name').html(comment_person_name);
    $('#parent_comment_id').val(parent_comment_id);
    $('#myModal').modal('show');
});
var userData = <?php echo $userData; ?>;
$('#formCommentReply #name').val(userData.name);
$('#formCommentReply #email').val(userData.email);
$('#formCommentReply').on('submit', function (e) {
    e.preventDefault();
    var data = {};
    var formData = $(this).serializeArray();
    $.each(formData, function (key, value) {
        data[value.name] = value.value;
    });
    var isValid = checkValidation('formCommentReply', data);
    if (isValid === 0) {
        $.post('/addComment', data, function (response) {
            console.log(response);
//            if (typeof response.response_status !== 'undefined' && response.response_status === 'success') {
//                var likeDiv = $('#likecount' + commentid);
//                var previous_count = parseInt(likeDiv.text());
//                if (response.response_code === 204) {
//                    var new_count = previous_count + 1;
//                } else if (response.response_code === 203) {
//                    var new_count = previous_count - 1;
//                }
//                likeDiv.text(new_count);
//            } else {
//
//            }
//            setTimeout(function () {
//                $('#message').html('');
//            }, 2000);
        }, "json");
    } else {
        console.log('inValid');
    }
});

function checkValidation(formId, comments) {
    var errors = {};
    $('.errors').remove();
    $.each(comments, function (key, value) {
        if (value == "") {
            errors[key] = key.charAt(0).toUpperCase() + key.substr(1).toLowerCase() + ' field is required.';
        }
    });
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
    var email = comments.email;
    if (!email.match(re)) {
        errors['email'] = 'Please enter a valid email.';
    }
    $.each(errors, function (key, value) {
        $('#' + formId + ' #' + key).after('<div class="errors">' + value + '</div>');
    });
    return Object.keys(errors).length;
}
</script>
<script src="{{ asset('/vendor/laravelLikeComment/js/script.js') }}" type="text/javascript"></script>
@endsection