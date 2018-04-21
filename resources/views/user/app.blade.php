<!DOCTYPE html>
<html lang="en">

    <head>
        @include('user/layouts/head')
    </head>

    <body>

        @include('user/layouts/header')
        <div class="container">
            <div class="row">
                @section('main-content')
                @show                
            </div>
        </div>        
        @include('user/layouts/footer')

    </body>

</html>
