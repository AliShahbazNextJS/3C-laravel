	
<header id="header" class="mb-3">
    <div class="container">
        <div class="d-flex align-items-center justify-content-between">
            <a class="menu-btn d-lg-none" href="#"><img src="images/menu.png"></a>
            <div class="logo">
                <a href="{{url('/')}}"><img src="{{url('images/logo.png')}}" alt="logo" class="img-fluid"></a>
            </div>
            <nav id="nav">
                <a class="menu-btn d-lg-none" href="#"><img src="images/menu.png"></a>
                <ul class="list-unstyled d-lg-flex m-0 p-0">
                    <li><a href="{{url('/')}}">Home</a></li>
                    <li><a href="{{url('/about-us')}}">About</a></li>
                    <li><a href="{{url('/products')}}">Services</a></li>
                    <li><a href="{{url('/subscribers')}}">Portfolio</a></li>
                    <li><a href="{{url('/blogs')}}">Blog</a></li>
                    <li><a href="{{url('/contact-us')}}">Support</a></li>
                </ul>
            </nav>
            <div class="mobile-icon d-lg-none">
                <a href="#"><img src="images/header-icon.png"></a>
            </div>
            <div class="header-right d-none d-lg-block">
                <div class="d-flex align-items-center">
                    <!-- <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle bg-transparent border-0" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-globe" aria-hidden="true"></i> EN <i class="fa fa-angle-down" aria-hidden="true"></i>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </div> -->
                    @guest
                    <a class="btn custom-btn" href="{{route('login')}}">Login</a>
                    @else
                    <a class="btn custom-btn" href="{{route('login')}}">{{ Auth::user()->name }}</a>
                    <a class="btn custom-btn" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    @endguest
                    
                </div>
            </div>
        </div>
    </div>
</header>