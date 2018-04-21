@extends('user/app')

@section('bg-img',asset('user/img/home-bg.jpg'))
@section('title','CONTACT US')
@section('sub-heading','Learn Together and Grow Together')
@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
    .fa-thumbs-up:hover{
        color:#f41115;
    }
    .errors {
        color: red;
        padding: 8px 0px 0px 0px;
    }
    .feedbackheading {
        padding-bottom: 30px;
        font-size: 40px;
    }
</style>
@endsection
@section('main-content')
<div class="col-lg-8">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>                    
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="feedbackheading"><strong>Contact Us</strong></div>

    {!! Form::open(['route' => 'contact.store', 'onsubmit' => 'return validateForm($(this));']) !!}
    <div class="form-group">
        {!! Form::label('name', 'Your Name*') !!}
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('email', 'E-mail Address*') !!}
        {!! Form::text('email', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::textarea('msg', null, ['class' => 'form-control', "id" => "msg"]) !!}
    </div>

    {!! Form::submit('Submit', ['class' => 'btn btn-info']) !!}

    {!! Form::close() !!}

</div>

@endsection

<script type="text/javascript">
    function validateForm(obj) {
        $('.errors').remove();
        var formData = {};
        var errors = {};
        var serializeData = $(obj).serializeArray();
        $.each(serializeData, function (key, data) {
            if (data.value === '') {
                errors[data.name] = 'This field is required.';
            } else {
                formData[data.name] = data.value;
            }
        });

        //var errorsLength = Object.keys(errors).length;
        if (typeof errors.email === 'undefined') {
            var email = formData.email;
            if (!validateEmail(email)) {
                errors['email'] = 'Please provide a valid email address.';
            }
        }

        $.each(errors, function (key, value) {
            $('#' + key).after('<div class="errors">' + value + '</div>');
        });

        return (Object.keys(errors).length === 0) ? true : false;
    }

    function validateEmail(sEmail) {
        var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
        if (filter.test(sEmail)) {
            return true;
        } else {
            return false;
        }
    }

</script>