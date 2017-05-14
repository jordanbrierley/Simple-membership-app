<html>
	<head>
		@include('partials/site/meta')
	</head>
  <body>

    <div id="wrapper">
    
      @include('partials/site/masthead')
     

      <div class="page">
        <div class="inner">
          <div class="page__title">
            <h1>@yield('title')</h1>
          </div>
        </div>

        <div class="inner">
          <div class="page__body">
           @include('partials/alerts')

            @yield('content')
          </div>
        </div>
      </div>

      @include('partials/site/footer')

    </div>

    @include('partials/site/postscript')

    </body>
</html>