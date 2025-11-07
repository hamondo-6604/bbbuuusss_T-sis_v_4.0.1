<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>BBS | Dashboard</title>


    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="{{ asset('dashboard/assets/css/style.css') }}">
</head>

<body>

    <div class="container">

        @include('layouts.sidebar')

        <div class="main">
            @include('layouts.header')

            @yield('content')
        </div>

        @include('layouts.footer')

    </div>
