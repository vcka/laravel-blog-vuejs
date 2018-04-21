@php
$config = [
'appName' => config('app.name'),
'locale' => $locale = app()->getLocale(),
'locales' => config('app.locales'),
'githubAuth' => config('services.github.client_id'),
];
$polyfills = [
'Promise',
'Object.assign',
'Object.values',
'Array.prototype.find',
'Array.prototype.findIndex',
'Array.prototype.includes',
'String.prototype.includes',
'String.prototype.startsWith',
'String.prototype.endsWith',
];
@endphp
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>{{ config('app.name') }}</title>

        <!--link rel="stylesheet" href="{{ mix('css/app.css') }}"-->
        <!-- Bootstrap core CSS -->
        <link href="{{ asset('user/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('user/css/blog-home.css') }}" rel="stylesheet">
        <link href="//cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.2/components/icon.min.css" rel="stylesheet">
        <link href="//cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.2/components/comment.min.css" rel="stylesheet">
        <link href="//cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.2/components/form.min.css" rel="stylesheet">
        <link href="//cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.2/components/button.min.css" rel="stylesheet">        
        <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
        <script src="https://apis.google.com/js/api:client.js"></script>
        <script type="text/javascript">
            var _token = "{{ csrf_token() }}";
        </script>
    </head>
    <body>
        <div id="app"></div>
        <!-- Footer -->
        <footer class="py-5 bg-dark">
            <div class="container">
                <p class="m-0 text-center text-white">Copyright &copy; Your Website 2018</p>
            </div>
            <!-- /.container -->
        </footer>
        {{-- Global configuration object --}}
        <script>window.config = @json($config);</script>

        {{-- Polyfill JS features via polyfill.io --}}
        <script src="https://cdn.polyfill.io/v2/polyfill.min.js?features={{ implode(',', $polyfills) }}"></script>

        {{-- Load the application scripts --}}
        @if (app()->isLocal())
        <script src="{{ mix('js/app.js') }}"></script>
        <script src="{{ asset('user/vendor/jquery/jquery.min.js') }}"></script>        
        <script src="{{ asset('user/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        @else
        <script src="{{ mix('js/app.js') }}"></script>
        <script src="{{ asset('user/vendor/jquery/jquery.min.js') }}"></script>        
        <script src="{{ asset('user/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        @endif
    </body>
</html>