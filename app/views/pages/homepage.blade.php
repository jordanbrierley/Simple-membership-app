@extends('layouts/full-width')

@section('content')
    <div class="banner">
      <div class="banner__caption">
        <h1 class="banner__title">All things animals</h1>

        @if (Auth::guest())
          <p>Become a member to get some of our awesome secret pictures!</p>
          <a href="{{ URL::to('users/register') }}" class="btn btn--primary">Sign up</a>
        @else

          @if(!Auth::getUser()->is_member)
            <p>Upgrade your account to see our private collection</p>
            <a href="{{ URL::to('subscribe/payment') }}" class="btn btn--primary">Upgrade account</a>            
          @else
            <p>Checkout our new members pictures</p>
            <a href="{{ URL::to('members') }}" class="btn btn--primary">Members area</a>
          @endif
        @endif 

      </div>
      <!-- banner__caption -->
    </div>
    <!-- ./banner -->
    <div class="page">

      <div class="inner">
        <div class="page-intro">
          <h1 class="page-intro__title">Did you know?</h1>
          <p>Check out some of our cats facts below and a few of our free images</p>
        </div> <!-- ./page-intro -->

        <div class="icon-list">
          <div class="icon-list__item">
            <img src="{{ URL::to('/img/icon-storage.svg') }}" alt="" class="icon-list__img">
            <p class="icon-list__title">Cats have 1,000 times more data storage than an iPad.</p>
          </div>
          <div class="icon-list__item">
            <img src="{{ URL::to('/img/icon-speed.svg') }}" alt="speed icon"  class="icon-list__img">
            <p class="icon-list__title">A house cat is faster than Usain Bolt.</p>
          </div>
          <div class="icon-list__item">
            <img src="{{ URL::to('/img/icon-cat.svg') }}" alt="cat icon"  class="icon-list__img">
            <p class="icon-list__title">A group of cats is called a clowder.</p>
          </div>
        </div> <!-- ./icon-list -->

        <div class="image-grid">
          <div class="image-grid__item"><img src="{{ URL::to('/img/animal-thumb-01.jpg') }}" alt=""></div>
          <div class="image-grid__item"><img src="{{ URL::to('/img/animal-thumb-02.jpg') }}" alt=""></div>
          <div class="image-grid__item"><img src="{{ URL::to('/img/animal-thumb-03.jpg') }}" alt=""></div>
          <div class="image-grid__item"><img src="{{ URL::to('/img/animal-thumb-04.jpg') }}" alt=""></div>
          <div class="image-grid__item"><img src="{{ URL::to('/img/animal-thumb-05.jpg') }}" alt=""></div>
          <div class="image-grid__item"><img src="{{ URL::to('/img/animal-thumb-06.jpg') }}" alt=""></div>
          <div class="image-grid__item"><img src="{{ URL::to('/img/animal-thumb-07.jpg') }}" alt=""></div>
        </div> <!-- ./image-grid -->

      </div>
      <!-- ./inner -->
    </div>
@stop