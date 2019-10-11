@extends('layouts.global')

@section('content')

    <div class="site-mobile-menu">
        <div class="site-mobile-menu-header">
            <div class="site-mobile-menu-close mt-3">
            <span class="icon-close2 js-menu-toggle"></span>
            </div>
        </div>
        <div class="site-mobile-menu-body"></div>
    </div> <!-- .site-mobile-menu -->

    <div class="site-blocks-cover overlay" style="background-image: url('images/background.jpg');" data-aos="fade" data-stellar-background-ratio="0.5" data-aos="fade">
        <div class="container">
            <div class="row align-items-center justify-content-center">
            <div class="col-md-7 text-center" data-aos="fade-up" data-aos-delay="400">
                <h1 class="mb-4">RAYAKAN LIBURAN TANPA KHAWATIR</h1>
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
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="100">
                <a href="{{route('anothers.showevent', ['id' => $event->id])}}" class="unit-9">
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

    <div class="site-section bg-dark">

      <div class="container">

        <div class="row">
            <div class="site-section-heading text-center mb-5 w-border col-md-6 mx-auto" data-aos="fade-up">
                <h2 class="mb-5">Recommendation Events</h2>
            </div>
        </div>
        <div class="site-block-retro d-block d-md-flex">
            @foreach($cobas1 as $coba1)

            <a href="{{route('anothers.showevent', ['id' => $coba1->id])}}" class="col1 unit-9 no-height" data-aos="fade-up" data-aos-delay="100">
                @if($coba1->cover)
                    <div class="image" style="background-image: url('{{asset('storage/' . $coba1->cover)}}');"></div>
                @endif
                <div class="unit-9-content">
                <h2>{{$coba1->location}}</h2>
                <span>{{$coba1->date}} &mdash; {{$coba1->time}}</span>
                </div>
            </a>
            @endforeach
            <div class="col2 ml-auto">
            @foreach($cobas2 as $coba2)

            <a href="{{route('anothers.show', ['id' => $coba2->id])}}" class="col2-row1 unit-9 no-height" data-aos="fade-up" data-aos-delay="200">
                @if($coba2->cover)
                    <div class="image" style="background-image: url('{{asset('storage/' . $coba2->cover)}}');"></div>
                @endif
                <div class="unit-9-content">
                    <h2>{{$coba2->location}}</h2>
                    <span>{{$coba2->date}} &mdash; {{$coba2->time}}</span>
                </div>
            </a>
            @endforeach
            @foreach($cobas3 as $coba3)

            <a href="{{route('anothers.show', ['id' => $coba3->id])}}" class="col2-row1 unit-9 no-height" data-aos="fade-up" data-aos-delay="200">
                @if($coba3->cover)
                    <div class="image" style="background-image: url('{{asset('storage/' . $coba3->cover)}}');"></div>
                @endif
                <div class="unit-9-content">
                    <h2>{{$coba3->location}}</h2>
                    <span>{{$coba3->date}} &mdash; {{$coba3->time}}</span>
                </div>
            </a>
            @endforeach
          </div>

        </div>

      </div>
    </div>

    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="site-section-heading text-center mb-5 w-border col-md-6 mx-auto" data-aos="fade-up">
            <h2 class="mb-5">Articles</h2>
          </div>
        </div>
        @foreach($articles as $article)
        <div class="row">
          <div class="col-md-6 col-lg-4 mb-4 mb-lg-0" data-aos="fade-up" data-aos-delay="100">
            <a href="{{route('anothers.show', ['id' => $article->id])}}">
            @if($article->cover)
                <img src="{{asset('storage/' . $article->cover)}}" alt="Image" class="img-fluid">
            @endif</a>
            <div class="p-4 bg-white">
              <span class="d-block text-secondary small text-uppercase">{{$article->date}}</span>
              <h2 class="h5 text-black mb-3"><a href="{{route('articles.show', ['id' => $article->id])}}">{{$article->name}}</a></h2>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>


    <div class="site-section">
        <div class="container" data-aos="fade-up">
            <div class="row">
                <div class="site-section-heading text-center mb-5 w-border col-md-6 mx-auto">
                    <h2 class="mb-5">Our DJs</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-lg-4 mb-5 mb-lg-5">
                    <div class="team-member">
                        <img src="images/person_1.jpg" alt="Image" class="img-fluid">
                    <div class="text">
                        <h2 class="mb-2 font-weight-light h4">Megan Smith</h2>
                        <span class="d-block mb-2 text-white-opacity-05">Creative Director</span>
                        <p class="mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit ullam reprehenderit nemo.</p>
                        <p>
                            <a href="#" class="text-white p-2"><span class="icon-facebook"></span></a>
                            <a href="#" class="text-white p-2"><span class="icon-twitter"></span></a>
                            <a href="#" class="text-white p-2"><span class="icon-linkedin"></span></a>
                        </p>
                    </div>

                </div>
            </div>



            <div class="col-md-6 col-lg-4 mb-5 mb-lg-5">
                <div class="team-member">

                <img src="images/person_2.jpg" alt="Image" class="img-fluid">

                <div class="text">

                    <h2 class="mb-2 font-weight-light h4">Brooke Cagle</h2>
                    <span class="d-block mb-2 text-white-opacity-05">Creative Director</span>
                    <p class="mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit ullam reprehenderit nemo.</p>
                    <p>
                    <a href="#" class="text-white p-2"><span class="icon-facebook"></span></a>
                    <a href="#" class="text-white p-2"><span class="icon-twitter"></span></a>
                    <a href="#" class="text-white p-2"><span class="icon-linkedin"></span></a>
                    </p>
                </div>

                </div>
            </div>

            <div class="col-md-6 col-lg-4 mb-5 mb-lg-5">
                <div class="team-member">

                <img src="images/person_3.jpg" alt="Image" class="img-fluid">

                <div class="text">

                    <h2 class="mb-2 font-weight-light h4">Philip Martin</h2>
                    <span class="d-block mb-2 text-white-opacity-05">Creative Director</span>
                    <p class="mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit ullam reprehenderit nemo.</p>
                    <p>
                    <a href="#" class="text-white p-2"><span class="icon-facebook"></span></a>
                    <a href="#" class="text-white p-2"><span class="icon-twitter"></span></a>
                    <a href="#" class="text-white p-2"><span class="icon-linkedin"></span></a>
                    </p>
                </div>

                </div>
            </div>

            <div class="col-md-6 col-lg-4 mb-5 mb-lg-5">
                <div class="team-member">

                <img src="images/person_4.jpg" alt="Image" class="img-fluid">

                <div class="text">

                    <h2 class="mb-2 font-weight-light h4">Steven Ericson</h2>
                    <span class="d-block mb-2 text-white-opacity-05">Creative Director</span>
                    <p class="mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit ullam reprehenderit nemo.</p>
                    <p>
                    <a href="#" class="text-white p-2"><span class="icon-facebook"></span></a>
                    <a href="#" class="text-white p-2"><span class="icon-twitter"></span></a>
                    <a href="#" class="text-white p-2"><span class="icon-linkedin"></span></a>
                    </p>
                </div>

                </div>
            </div>

            <div class="col-md-6 col-lg-4 mb-5 mb-lg-5">
                <div class="team-member">

                <img src="images/person_5.jpg" alt="Image" class="img-fluid">

                <div class="text">

                    <h2 class="mb-2 font-weight-light h4">Nathan Dumlao</h2>
                    <span class="d-block mb-2 text-white-opacity-05">Creative Director</span>
                    <p class="mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit ullam reprehenderit nemo.</p>
                    <p>
                    <a href="#" class="text-white p-2"><span class="icon-facebook"></span></a>
                    <a href="#" class="text-white p-2"><span class="icon-twitter"></span></a>
                    <a href="#" class="text-white p-2"><span class="icon-linkedin"></span></a>
                    </p>
                </div>

                </div>
            </div>

            <div class="col-md-6 col-lg-4 mb-5 mb-lg-5">
                <div class="team-member">

                <img src="images/person_6.jpg" alt="Image" class="img-fluid">

                <div class="text">

                    <h2 class="mb-2 font-weight-light h4">Brooke Cagle</h2>
                    <span class="d-block mb-2 text-white-opacity-05">Creative Director</span>
                    <p class="mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit ullam reprehenderit nemo.</p>
                    <p>
                    <a href="#" class="text-white p-2"><span class="icon-facebook"></span></a>
                    <a href="#" class="text-white p-2"><span class="icon-twitter"></span></a>
                    <a href="#" class="text-white p-2"><span class="icon-linkedin"></span></a>
                    </p>
                </div>

                </div>
            </div>


            </div>
        </div>
    </div>



@endsection
