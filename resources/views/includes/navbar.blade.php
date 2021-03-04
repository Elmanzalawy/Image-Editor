<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            @auth
            <ul class="navbar-nav mr-auto">
                @role('admin')
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/users')}}">Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('vendors')}}">Vendors</a>
                </li>
                @endrole
                @can('view orders')
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <span>Orders</span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('orders.index') }}">
                            <span>New Orders</span>
                        </a>
                        <a class="dropdown-item" href="{{ route('assignedOrdersPage') }}">
                            <span>Assigned Orders</span>
                        </a>
                        <a class="dropdown-item" href="{{ route('completedOrdersPage') }}">
                            <span>Completed Orders</span>
                        </a>
                        <a class="dropdown-item" href="{{ route('cancelledOrdersPage') }}">
                            <span>Cancelled Orders</span>
                        </a>
                    </div>
                </li>
                @endcan
                {{-- <li class="nav-item">
                    <a class="nav-link" href="{{route('deliveries.index')}}">Deliveries</a>
                </li> --}}

            </ul>
            @endauth

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto mr-4">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
