<nav class="navbar navbar-default navbar-static-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!-- Branding Image -->
			<h4>
				<a class="navbar-brand main_arabic_font" href="{{ url('/') }}">
					{{-- <img src="{{asset('images/helper_images/branding_image.png')}}" class="navbar-left" alt="الشركة العربية لمهمات المكاتب" width="30px"> --}}
					الشركــة العـــربيـــة لمهمـات المكاتـب
				</a>
			</h4>
        </div>
        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- right Side Of Navbar -->
            @include('layouts.nav.nav-privileges')
            @include('layouts.nav.nav-customers')
			@include('layouts.nav.nav-printing-machines')
            @include('layouts.nav.nav-contracts')
            @include('layouts.nav.nav-installation-records')
            @include('layouts.nav.nav-follow-up-cards')
            @include('layouts.nav.nav-references')
            @include('layouts.nav.nav-visits')
            @include('layouts.nav.nav-indexations')
            @include('layouts.nav.nav-invoices')
			@include('layouts.nav.nav-employees')
			@include('layouts.nav.nav-departments')
			@include('layouts.nav.nav-parts')
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav navbar-left main_arabic_font">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ route('login') }}"> تسجيل دخول </a></li>
                    {{-- <li><a href="{{ route('register') }}"> تسجيل </a></li> --}}
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
							@php
								$userImage = (isset(Auth::user()->images->first()->name))?Auth::user()->images->first()->name:'no_image.png';
							@endphp
                            <img src="{{ asset('images/project_images/'.$userImage) }}" class="img-circle" height="30px" alt="Image">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ action('UserController@edit', ['id'=>Auth::user()->id]) }}"><i class="fa fa-btn fa-edit"></i>تعديل الملف الشخصي</a></li>
                            <li>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    تسجيل خروج
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
