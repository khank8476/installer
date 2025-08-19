<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Installer - {{config('app.name')}}</title>
    <link rel="shortcut icon" href="{{url('assets/images/logo-bag-transparent.png')}}" type="image/x-icon">
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap"
        rel="stylesheet">
    <!-- Icons -->
    <link rel="stylesheet" type="text/css" href="{{url('assets/css/vendors/font-awesome.css')}}">
    <!-- Bootstrap css -->
    <link rel="stylesheet" type="text/css" href="{{url('assets/css/vendors/bootstrap.css')}}">
</head>

<body class="d-flex flex-column">
    <div class="d-flex flex-column flex-fill">
        <div class="bg-base-1 flex-fill">
            <div class="container">
                <div class="row h-100 justify-content-center align-items-center py-5">
                    <div class="col-lg-12">
                        @php
                        $menu = [
                        [
                        'icon' => 'home',
                        'route' => 'install.index'
                        ],
                        [
                        'icon' => 'requirements',
                        'route' => 'install.requirements'
                        ],
                        [
                        'icon' => 'permissions',
                        'route' => 'install.permissions'
                        ],
                        [
                        'icon' => 'database',
                        'route' => 'install.database'
                        ],
                        [
                        'icon' => 'account',
                        'route' => 'install.account'
                        ],
                        [
                        'icon' => 'complete',
                        'route' => 'install.complete'
                        ]
                        ];
                        @endphp
                        <div class="nav flex-column">
                            <ul class="nav nav-pills d-flex justify-content-center mb-4">
                                @foreach ($menu as $link)
                                <li class="nav-item mx-1">
                                    @if(Route::currentRouteName() == $link['route'])
                                    <a href="{{ route($link['route']) }}" class="btn btn-primary d-flex align-items-center text-capitalize">
                                        {{$link['icon']}}
                                    </a>
                                    @else
                                    <a href="#" class="btn d-flex align-items-center text-capitalize disabled">
                                        {{$link['icon']}}
                                    </a>
                                    @endif
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="card border-0 shadow-sm overflow-hidden">
                            <div class="card-header">
                                <div class="font-weight-medium py-1">{{ __('Requirements') }}</div>
                            </div>
                            <div class="card-body">
                                @foreach($results['extensions'] as $type => $extension)
                                <div class="list-group list-group-flush {{ $loop->index == 0 ? 'mb-n3 mt-n3' : 'mt-3 mb-n3 pt-3' }}">
                                    <div class="list-group-item px-0">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <span class="font-weight-medium">{{ mb_strtoupper($type) }}</span>
                                                @if($type == 'php')
                                                {{ config('install.php_version') }}+
                                                @endif
                                            </div>
                                            <div class="col-auto d-flex align-items-center">
                                                @if($type == 'php')
                                                @if(version_compare(PHP_VERSION, config('install.php_version')) >= 0)
                                                <i class="fa fa-check text-success fs-5"></i>
                                                @else
                                                <i class="fa fa-close text-danger fs-5"></i>
                                                @endif
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    @foreach($extension as $name => $enabled)
                                    <div class="list-group-item px-0 text-muted">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                {{ $name }}
                                            </div>
                                            <div class="col-auto d-flex align-items-center">
                                                @if($enabled)
                                                <i class="fa fa-check text-success fs-5"></i>
                                                @else
                                                <i class="fa fa-close text-danger fs-5"></i>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                @endforeach
                            </div>
                        </div>

                        @if(isset($results['errors']) == false)
                        <a href="{{ route('install.permissions') }}" class="btn btn-block btn-primary d-inline-flex align-items-center mt-3 py-2">
                            <span class="d-inline-flex align-items-center mx-auto">
                                {{ __('Next') }}
                            </span>
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- latest jquery-->
    <script src="{{url('assets/js/jquery-3.3.1.min.js')}}"></script>
    <!-- Bootstrap js-->
    <script src="{{url('assets/js/bootstrap.bundle.min.js')}}"></script>
</body>

</html>