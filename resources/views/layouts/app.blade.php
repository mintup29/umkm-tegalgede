<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
    />

    <style>
      .search-box{
        border: 2px solid #004AAD;
        height: 40px;
        width: 450px;
        border-radius: 40px;
        padding: 10px;
      }
      .search-btn{
        color: white;
        float: right;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: #004AAD;
        display: flex;
        justify-content: center;
        align-items: center;
      }
      .search-txt{
      border: none;
      background: none;
      outline: none;
      float: left;
      padding: 0;
      color: black;
      font-size: 16px;
      transition: 0.4s;   
      line-height: 40px;
      width: 0px;
      }
    </style>

    <title>@yield('title')</title>

    {{-- Style --}}
    @stack('prepend-style')
    @include('includes.style')
    @stack('addon-style')

  </head>

  <body>
    {{-- Navbar --}}
    @include('includes.navbar')

    {{-- Page Content --}}
    @yield('content')

    {{-- Footer --}}
    @include('includes.footer')

    {{-- Script --}}
    @stack('prepend-script')
    @include('includes.script')
    @stack('addon-script')
  </body>
</html>
