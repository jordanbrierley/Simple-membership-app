@extends('layouts/default')

@section('title', 'Members')


@section('content')
  <div class="members">
    <p>Select your favourite species to get one of our quality images!</p>

    @if($images)
      <div class="image-list">
      @foreach ($images as $image)
        <button class="btn btn--primary image-link" data-link="/file/{{ $image->code }}">{{ $image->species }}</button>
      @endforeach
      </div>
      <br>
      <div class="member__image"></div>
  @endif 
  </div>

@stop