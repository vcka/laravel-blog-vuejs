 <!-- Navigation -->
    <nav class="navbar navbar-default navbar-custom navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    Menu <i class="fa fa-bars"></i>
                </button>                
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="{{ URL::to('/') }}">Home</a>
                    </li>
                    <li>
                        <a href="{{ URL::to('/contact') }}">Contact Us</a>
                    </li>
                    <li>
                        <a href="{{ URL::to('/recent-post') }}">Recent Post</a>
                    </li>
                    <li>
                        <a href="{{ URL::to('/archive') }}">Archive Post</a>
                    </li>                    
                    <li>
                        @if (Auth::guest())
                            <a href="{{ route('login') }}">Login</a>
                        @else
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        @endif
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Header -->
    <!-- Set your background image for this header on the line below. -->
    <header class="intro-header" style="background-image: url(@yield('bg-img'))">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="site-heading">
                        <h1>@yield('title')</h1>
                        <hr class="small">
                        <span class="subheading">@yield('sub-heading')</span>
                    </div>
                </div>
            </div>
        </div>
    </header>