{{-- @extends('errors::minimal')

@section('title', __('Not Found'))
@section('code', '404')
@section('message', __('Not Found')) --}}
<!doctype html>
<html  lang="en">
<head>
    @include('includes.head-errorpages')
</head>
<body>
    <header class="row">
        @include('includes.header')
    </header>
    <div class="container">
        <div class="row text-center">
            <div class="col-lg-6 offset-lg-3 col-sm-6 offset-sm-3 col-12 p-3 error-main">
                <div class="row">
                    <div class="col-lg-8 col-12 col-sm-10 offset-lg-2 offset-sm-1">
                        <i class="fa fa-frown-o" aria-hidden="true"></i>
                        <h1 class="m-0">404</h1>
                        <h6>Page not found - team.customsigncenter.com</h6>
                        <p>Sorry, that is an invalid web address for this site.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
