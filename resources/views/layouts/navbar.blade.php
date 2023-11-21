<!-- NavBar--->
<nav class="navbar navbar-expand-lg sticky-top navbar-custom p-2">
    <div class="container ">
        <a href="{{ route('home') }}">
            <img src="/images/car-seller-logo .png" alt="Car Seller logo" style="width: 48px; ">
        </a>

        <button class="navbar-toggler navbar-dark border-0" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse ms-2" id="navbarCollapse">
            <div class="navbar-nav">
                <a href="{{ route('policy') }}" class="nav-item nav-link custom-nav-link @if( request()->url()==route('policy') ) active @endif">{{ __('policy') }}</a>
                <a href="{{ route('about') }}" class="nav-item nav-link custom-nav-link @if( request()->url()==route('about') ) active @endif">{{ __('about') }}</a>
                <!-- Language Toggle Switch -->

                <!-- End Language Toggle Switch -->
            </div>
            <div class="dropdown">
                <a class="dropdown-toggle nav-link custom-nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    {{ __('language') }}
                </a>
                <?php $en = 'en';
                $my = 'my'; ?>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="{{ url('localization/en') }}"> {{ __('en') }} </a></li>
                    <li><a class="dropdown-item" href="{{ url('localization/my') }}"> {{ __('my') }} </a></li>
                </ul>
            </div>
            <div class="navbar-nav ms-auto">

                <div class="dropdown">
                    <a class="dropdown-toggle nav-link custom-nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ __('create_post') }}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a href="{{ route('buy.create') }}" class="dropdown-item" @if( request()->url()==route('buy.create') ) active @endif> {{ __('buy_post') }} </a></li>
                        <li><a href="{{ route('sale.create') }}" class="dropdown-item" @if( request()->url()==route('sale.create') ) active @endif> {{ __('sale_post') }} </a></li>
                    </ul>
                </div>

                {{--<a href="{{ route('buy.create') }}" class="nav-item nav-link custom-nav-link @if( request()->url()==route('buy.create') ) active @endif">{{ __('create post') }}</a>--}}

                @if( Auth::check())
                <a href="{{ route('buy-favourite.index') }}" class="nav-item nav-link custom-nav-link @if( request()->url()==route('post.favourite') ) active @endif">{{__('my_fav')}}</a>

                <li class="nav-item dropdown ">
                    <a class="nav-link fw-bold dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }}

                        @if(Auth::user()->profile->profile_image)
                        <img src="{{  url(Auth::user()->profile->profile_image->url) }}" class="align-self-center ms-2 rounded-circle" alt="User Profile" width="32px" height="32px" style="object-fit:cover;">
                        @else
                        <img src="/images/default_avatar.jpeg" class="align-self-center rounded-circle" alt="Profile" width="32px" height="32px" style="object-fit:cover;">
                        @endif
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li>
                            <a href="{{ route('profile.sale') }}" class="dropdown-item">
                                <i class="fas fa-user me-2"></i>
                                Profile
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST" onclick="return confirm('Logout Your Account! Are you sure?')">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <i class="fas fa-sign-out-alt me-2"></i>
                                    Logout
                                </button>
                            </form>

                        </li>
                    </ul>
                </li>
                @else
                <a href="{{ route('login.create') }}" class="nav-item nav-link custom-nav-link">{{ __('login')}}</a>
                <a href="{{ route('register.create') }}" class="nav-item nav-link custom-nav-link">{{ __('register')}}</a>
                @endif
            </div>

        </div>
    </div>
</nav>
<!-- End NavBar--->