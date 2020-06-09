
<header>
<div class="container">
                <a class="logo" href="{{route('index')}}"><img src="{{ URL::asset('assets/images/logo-white.png') }}" alt="Logo"></a>

                <div class="right-area">
                </div><!-- right-area -->
                
                <a class="menu-nav-icon" data-menu="#main-menu" href="#"><i class="ion-navicon"></i></a>
                <ul class="main-menu font-mountainsre" id="main-menu">
                        <li><a href="{{route('index')}}">Home</a></li>
                        <li><a href="#">Menu</a></li>
                        <li><a href="#">SERVICES</a></li>
                        <li><a href="#">NEWS</a></li>
                        <li><a href="#">CONTACT</a></li>
                        <li><a href="{{route('cart.index')}}">Panier
                        <span class="badge badge-pill badge-warning">{{Cart::count()}}</span></a></li>
                        <li><a href="#">@include('layout.partials.auth')</a></li>
                </ul>
           
              

                <div class="clearfix"></div>
        </div><!-- container -->

        @if(session('success'))
        <div class="alert alert-success">
        {{session('success')}}
        </div>
        @endif
        </header>