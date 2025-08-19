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
                        <form action="{{ route('install.database') }}" method="post">
                            @csrf
                            <div class="card border-0 shadow-sm overflow-hidden">
                                <div class="card-header">
                                    <div class="font-weight-medium py-1">{{ __('Database configuration') }}</div>
                                </div>
                                <div class="card-body">
                                    @if (request()->session()->get('success'))
                                    <div class="w-100 alert alert-success alert-dismissible fade show" role="alert">
                                        {{ request()->session()->get('success') }}
                                        <button type="button" class="close d-flex align-items-center justify-content-center width-12 height-12 p-0" data-dismiss="alert" aria-label="{{ __('Close') }}">
                                            <span aria-hidden="true" class="d-flex align-items-center"><i class="fa fa-close text-danger fs-5"></i>
                                        </button>
                                    </div>
                                    @endif
                                    @if (request()->session()->get('error'))
                                    <div class="w-100 alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ request()->session()->get('error') }}
                                        <button type="button" class="close d-flex align-items-center justify-content-center width-12 height-12 p-0" data-dismiss="alert" aria-label="{{ __('Close') }}">
                                            <span aria-hidden="true" class="d-flex align-items-center"><i class="fa fa-close text-danger fs-5"></i>
                                        </button>
                                    </div>
                                    @endif
                                    <div class="row mx-n2">
                                        <div class="col px-2">
                                            <div class="form-group">
                                                <label for="i-database-hostname">
                                                    {{ __('Hostname') }}
                                                </label>
                                                <input type="text" name="database_hostname" id="i-database-hostname" value="{{ old('database_hostname') ?? '127.0.0.1' }}" class="form-control{{ $errors->has('database_hostname') ? ' is-invalid' : '' }}">
                                                @if ($errors->has('database_hostname'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('database_hostname') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col px-2">
                                            <div class="form-group">
                                                <label for="i-database-port">
                                                    {{ __('Port') }}
                                                </label>
                                                <input type="number" name="database_port" id="i-database-port" value="{{ old('database_port') ?? '3306' }}" class="form-control{{ $errors->has('database_port') ? ' is-invalid' : '' }}">
                                                @if ($errors->has('database_port'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('database_port') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group {{ $errors->has('database_name') ? ' has-error ' : '' }}">
                                        <label for="i-database-name">
                                            {{ __('Name') }}
                                        </label>
                                        <input type="text" name="database_name" id="i-database-name" class="form-control{{ $errors->has('database_name') ? ' is-invalid' : '' }}" value="{{ old('database_name') }}">
                                        @if ($errors->has('database_name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('database_name') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="i-database-username">
                                            {{ __('User') }}
                                        </label>
                                        <input type="text" name="database_username" id="i-database-username" class="form-control{{ $errors->has('database_username') ? ' is-invalid' : '' }}" value="{{ old('database_username') }}">
                                        @if ($errors->has('database_username'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('database_username') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="i-database-password">
                                            {{ __('Password') }}
                                        </label>
                                        <input type="password" name="database_password" id="i-database-password" class="form-control{{ $errors->has('database_password') ? ' is-invalid' : '' }}" value="{{ old('database_password') }}">
                                        @if ($errors->has('database_password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('database_password') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-block btn-primary d-inline-flex align-items-center mt-3 py-2">
                                <span class="d-inline-flex align-items-center mx-auto">
                                    {{ __('Next') }}
                                </span>
                            </button>
                        </form>
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