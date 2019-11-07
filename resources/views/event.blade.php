@extends('layouts.global')

@section('content')
<div class="site-blocks-cover inner-page-cover overlay" style="background-image: url('images/background.jpg');"
    data-aos="fade" data-stellar-background-ratio="0.5" data-aos="fade">
    <div class="container">
      <div class="row align-items-center justify-content-center">
        <div class="col-md-7 text-center" data-aos="fade-up" data-aos-delay="400">

          <h1 class="text-white">Events</h1>
        </div>
      </div>
    </div>
  </div>

  <div class="site-section">
        <div class="container">
            <div class="row">
            <div class="site-section-heading text-center mb-5 w-border col-md-6 mx-auto">
                <h2 class="mb-5">Upcoming Events</h2>
            </div>
            </div>
            <div class="row">
            @foreach($events as $event)
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="100" style="padding-bottom:5%;">
                <a href="{{route('events.show', ['id' => Crypt::encrypt($event->id)])}}" class="unit-9">
                @if($event->cover)
                <div class="image" style="background-image: url('{{asset('storage/' . $event->cover)}}');"></div>
                @endif
                <div class="unit-9-content">
                    <h2>Stock: {{$event->stock}}</h2>
                    <span>{{$event->date}} &mdash; {{$event->time}}</span>
                    <span>{{$event->location}}</span>
                </div>
                </a>
            </div>
            @endforeach
            </div>
        </div>
    </div>
@endsection
