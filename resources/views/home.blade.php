@extends('layouts.app')

@section('content')
    @vite(['resources/css/styles.css'])
    <header class="masthead bg-primary text-white text-center remove-margin shadow-lg">
        <div class="container d-flex align-items-center flex-column">
            <!-- LOGO Image-->
            <img class="logo-color-granat" style="width: 350px; height: 350px;"  src="{{asset('assets/img/LOGO.svg')}}" alt="LOGO" />
            <h1 class="masthead-heading mb-0 text-uppercase">{{ config('app.name', 'Laravel') }}</h1>
            <h3 class="bg-primary slogan text-secondary mb-10">Code With Us</h3>
            <!-- Icon Divider-->
            <div class="divider-custom divider-light">
                <div class="divider-custom-line"></div>
                <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                <div class="divider-custom-line"></div>
            </div>
            <!-- LOGO Subheading-->
            <p class="masthead-subheading font-weight-light mb-0">FRAMEWORKS - TECHNOLOGY - KNOWLAGE</p>
        </div>
    </header>
    <!-- COURSES Section-->
    <section class="page-section portfolio shadow-lg" id="portfolio">
        <div class="container">
            <!-- Portfolio Section Heading-->
            <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">{{__("Courses")}}</h2>
            <!-- Icon Divider-->
            <div class="divider-custom">
                <div class="divider-custom-line"></div>
                <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                <div class="divider-custom-line"></div>
            </div>
            <!-- COURSES Grid Items-->
            <div class="row justify-content-center">
                <!-- COURSES ITEMS -->
                @foreach($courses as $key => $course)
                    <div class="col-md-6 col-lg-4 mb-5">
                        <div class="portfolio-item mx-auto" data-bs-toggle="modal" data-bs-target="#courseModal{{$course->id}}">
                            <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                                <div class="portfolio-item-caption-content text-center text-white"><i class="fas fa-plus fa-3x"></i></div>
                            </div>
                            <img class="img-fluid" src="{{asset('storage/'.$course->image_path)}}" alt="{{$course->name}}" />
                        </div>
                    </div>

                @endforeach

            </div>
        </div>
        {{$courses->links()}}
        @foreach($courses as $key => $course)

            <div class="portfolio-modal modal fade" id="courseModal{{$course->id}}" tabindex="-1" aria-labelledby="#courseModal{{$course->id}}"
                 aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header border-0">
                            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center pb-5">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-lg-8">
                                        <!-- Bootstrap - Lekcje-->
                                        <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0">Lekcje</h2>
                                        <!-- Icon Divider-->
                                        <div class="divider-custom">
                                            <div class="divider-custom-line"></div>
                                            <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                                            <div class="divider-custom-line"></div>
                                        </div>
                                        <!-- % ukończenia kursu -->
                                        <div style="width: 50%;" class="mx-auto">
                                            <label><b>Stopień ukończenia kursu:</b></label>
                                            @if(count($percentages) === 0)
                                                <h3>
                                                    0%

                                                </h3>
                                                <div class="meter animate">
                                                    <span style="width:0%"><span></span></span>
                                                </div>
                                            @else
                                                @foreach($percentages as $percentage)
                                                    @if($course->id === $percentage->course_id)
                                                <h3>
                                                        {{$percentage->percentage_over_75}}%

                                                </h3>
                                                <div class="meter animate">
                                                    <span style="width:{{$percentage->percentage_over_75}}%"><span></span></span>
                                                </div>
                                                    @endif
                                                @endforeach
                                            @endif
                                            <!-- DODAĆ VALUE ODPOWIEDNIE [(WYNIK ZALICZONYCH / LESSONS) * 100%]   -->
                                        </div>
                                        <!-- Kurs - LEKCJE-->
                                        <div class="list list-inline">
                                            @foreach ($lessons as $lesson)
                                                @if($course->id === $lesson->course_id)
                                                <a href="{{route('lessons.userView', $lesson->id)}}" class="link">
                                                    <div class="d-flex list-lessons p-3 my-3">
                                                    <span class="mr-auto"><i class="
                                                     @foreach ($scores as $score)
                                                        @if($score->lesson_id === $lesson->id)
                                                            @if($score->percentage > 0.75)
                                                                fa-solid fa-circle-check
                                                            @else
                                                                fa-regular fa-circle-check
                                                            @endif
                                                        @endif
                                                     @endforeach
                                                     "></i></span>
                                                        <div class="mx-auto my-auto h6">{{$lesson->name}}</div>
                                                    </div>
                                                </a>
                                                @endif
                                            @endforeach
                                        </div>
                                        <button class="btn btn-primary my-3" data-bs-dismiss="modal">
                                            <i class="fas fa-xmark fa-fw"></i>
                                            <span>Zamknij</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </section>
    <!-- About Section-->
    <section class="page-section bg-primary text-white mb-0 shadow-lg" id="about">
        <div class="container">
            <!-- About Section Heading-->
            <h2 class="page-section-heading text-center text-uppercase text-white">About</h2>
            <!-- Icon Divider-->
            <div class="divider-custom divider-light">
                <div class="divider-custom-line"></div>
                <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                <div class="divider-custom-line"></div>
            </div>
            <!-- About Section Content-->
            <div class="row">
                <div class="col-lg-4 ms-auto"><p class="lead">WebMeIn was created in order to develop competences by students of secondary schools, and above all of technical schools.
                    </p></div>
                <div class="col-lg-4 me-auto"><p class="lead">The application aims to collect various types of web technology courses that will support high school students, especially technical schools. The application will mainly be created by a community that will be able to create new content and edit existing content !</p></div>
            </div>
        </div>
    </section>

    <!-- Footer-->
    <footer class="footer text-center">
        <div class="container">
            <div class="row">
                <!-- Footer Location-->
                <div class="col-lg-4 mb-5 mb-lg-0">
                    <h4 class="text-uppercase mb-4">Location</h4>
                    <p class="lead mb-0">
                        <a class="text-decoration-none text-white-link" target="_blank" href="https://wpt.pollub.pl/">Politechnika Lubelska
                            <br />
                            Wydzial Podstaw Techniki</a>
                    </p>
                </div>
                <!-- Footer Social Icons-->
                <div class="col-lg-4 mb-5 mb-lg-0">
                    <h4 class="text-uppercase mb-4">Around the Web</h4>
                    <a class="btn btn-outline-light btn-social mx-1" target="_blank" href="https://www.facebook.com/Rudyziomeksvd"><i class="fab fa-fw fa-facebook-f"></i></a>
                    <a class="btn btn-outline-light btn-social mx-1" target="_blank" href="https://twitter.com/pollub_lublin"><i class="fab fa-fw fa-twitter"></i></a>
                    <a class="btn btn-outline-light btn-social mx-1" target="_blank" href="https://www.linkedin.com/in/patryk-staniewski-059284221/"><i class="fab fa-fw fa-linkedin-in"></i></a>
                </div>
                <!-- Footer About Text-->
                <div class="col-lg-4">
                    <h4 class="text-uppercase mb-4">About Author</h4>
                    <p class="lead mb-0">
                        My name is Patryk Staniewski and I am a student at the Lublin University of Technology. I am a technology and programming enthusiast. My passion for programming is an inspiration for me to constantly develop and improve my skills. In my projects, I use tools such as PHP, Laravel, and Bootstrap, which allows me to create modern and aesthetic websites. I am constantly striving to improve my skills in HTML, CSS and JavaScript to be able to create even better projects in the future.
                    </p>
                </div>
            </div>
        </div>
    </footer>
    <!-- Copyright Section-->
    <div class="copyright py-4 text-center text-white">
        <div class="container"><small>Copyright &copy; WebMeIn 2022</small></div>
    </div>
@endsection
