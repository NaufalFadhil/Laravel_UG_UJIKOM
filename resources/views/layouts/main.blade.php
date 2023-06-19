<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PT. Baroqah TBK')</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    @stack('prepend-style')
    @include('includes.style')
    @stack('addon-style')
</head>

<body>
    <div id="app">
        @include('includes.sidebar')

        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none sidebar-hide">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-content">
                <section class="row">
                    <div class="col-12 col-lg-12">
                        <div class="row">
                            <div class="col-12 col-xl-12">
                                @yield('content')
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-12 col-lg-3">
                        <div class="card">
                            <div class="card-header">
                                <h4>Your Profile</h4>
                            </div>
                            <div class="card-content pb-4">
                                <div class="recent-message d-flex px-4 py-3">
                                    <div class="avatar avatar-lg">
                                        <img src="/assets/images/faces/1.jpg">
                                    </div>
                                    <div class="name ms-4">
                                        <h5 class="mb-1">{{ Str::of(auth()->user()->name)->limit(10);}}</h5>
                                        <h6 class="text-muted mb-0">{{ auth()->user()->institution }}</h6>
                                    </div>
                                </div>
                                <div class="px-4">
                                    <form action="{{ route('admin-logout') }}" method="post">
                                        @csrf
                                        <button class='btn btn-block btn-xl btn-danger font-bold mt-3'>Logout</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </section>
            </div>
            @yield('modal')
            @include('includes.footer')
        </div>
    </div>

    @stack('prepend-script')
    @include('includes.script')
    @stack('addon-script')

</body>
</html>