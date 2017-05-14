<html>
  <head>
    @include('partials/site/meta')
  </head>
  <body>

    <div id="wrapper">
    
      @include('partials/site/masthead')
    
      @include('partials/alerts')
      
      @yield('content')

      @include('partials/site/footer')

    </div>

    @include('partials/site/postscript')

    </body>
</html>