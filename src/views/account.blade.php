<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Installer - {{config('info.software.name')}}</title>
    <link rel="shortcut icon" href="{{url('favicon.ico')}}" type="image/x-icon">
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap"
        rel="stylesheet">
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" />
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
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
                        <form action="{{ route('install.account') }}" method="post">
                            @csrf
                            <div class="card border-0 shadow-sm overflow-hidden">
                                <div class="card-header">
                                    <div class="font-weight-medium py-1">{{ __('Admin credentials') }}</div>
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
                                    <div class="form-group">
                                        <label for="i-name">{{ __('Name') }}</label>
                                        <input id="i-name" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" autofocus>
                                        @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="i-email">{{ __('Email address') }}</label>
                                        <input id="i-email" type="text" dir="ltr" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}">
                                        @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="i-password">{{ __('Password') }}</label>
                                        <input id="i-password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" value="{{ old('password') }}">
                                        @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="i-password-confirmation">{{ __('Confirm password') }}</label>
                                        <input id="i-password-confirmation" type="password" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" name="password_confirmation" value="{{ old('password_confirmation') }}">
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input{{ $errors->has('newsletter') ? ' is-invalid' : '' }}" name="newsletter" id="i-newsletter">
                                        <label class="custom-control-label" for="i-newsletter">
                                            {{ __('Newsletter') }}
                                            <small id="passwordHelpInline" class="d-block text-muted">
                                                {{ __('Get notified when I (kamrankhan_dev) launch a new product or run a sale.') }}
                                            </small>
                                        </label>
                                        @if ($errors->has('newsletter'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('newsletter') }}</strong>
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
    <!-- Bootstrap js-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>