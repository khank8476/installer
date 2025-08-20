<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Installer - {{config('info.software.name')}}</title>
    <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon">
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap"
        rel="stylesheet">
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/fontawesome.min.css" />
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
                        <div class="card border-0 shadow-sm overflow-hidden">
                            <div class="card-header">
                                <div class="font-weight-medium py-1">{{ __('Permissions') }}</div>
                            </div>
                            <div class="card-body">
                                @foreach($results['permissions'] as $type => $files)
                                <div class="list-group list-group-flush {{ $loop->index == 0 ? 'mb-n3 mt-n3' : 'mt-3 mb-n3 pt-3' }}">
                                    <div class="list-group-item px-0">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <span class="font-weight-medium">{{ __($type) }}</span>
                                            </div>
                                            <div class="col-auto d-flex align-items-center">
                                            </div>
                                        </div>
                                    </div>
                                    @foreach($files as $file => $writable)
                                    <div class="list-group-item px-0 text-muted">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                {{ $file }}
                                            </div>
                                            <div class="col-auto d-flex align-items-center">
                                                <span class="mr-3">775</span>
                                                @if($writable)
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
                        <a href="{{ route('install.database') }}" class="btn btn-block btn-primary d-inline-flex align-items-center mt-3 py-2">
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
    <!-- Bootstrap js-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>