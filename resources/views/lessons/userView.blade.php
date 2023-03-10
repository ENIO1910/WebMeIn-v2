@extends('layouts.app')

@section('content')
    @vite(['resources/css/styles.css'])
    <!-- Masthead-->
    <div class="pt-5 bg-primary">
        <header class="masthead text-white text-center">
            <div class="container d-flex align-items-center flex-column">
                <!-- Masthead Avatar Image-->
                <!-- Masthead Heading-->
                <h1 class="masthead-heading text-uppercase mb-0">Zaczynajmy !</h1>
                <!-- Icon Divider-->
                <div class="divider-custom divider-light">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <!-- Masthead Subheading-->
                <p class="masthead-subheading font-weight-light mb-0 text-uppercase">{{$course->name}}</p>
                <p class="masthead-subheading font-weight-light mb-0 text-uppercase">{{$lesson->name}}</p>
            </div>
        </header>
    </div>
    <div class='d-flex' style='height:80vh;'>
            <div class="row-fluid pdf-block ">
                <iframe src ="{{ asset('/laraview/#../storage/'.$lesson->pdf_file_path) }}" width="100%" height="100%"></iframe>

            </div>
            <div class="vl"></div>
            <div class="row-fluid w-50 text-center mt-5">
                <h3> Wykonaj instrukcję</h3>
                <h5 class="mt-5">Tutaj znajdziesz potrzebne pliki do wykonania zadania: </h5>
                <a href="{{route('downloadFile', $lesson)}}" <input type="button" class="btn btn-primary"/> Pliki </a>
                <form action="{{ route('updateScore', $lesson->id) }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="withoutScore" value="true">
                    <input type="hidden" name="lesson_id" value="{{$lesson->id}}">
                    <div>
                        @if(!isset($score) || $score->percentage < 0.75)
                            <h5 class="mt-5">Jeśli wykonasz wszystkie kroki w instrukcji przejdź dalej</h5>
                            <input type="submit" name="submit" value="Zatwierdź" class="btn btn-primary">
                        @endif
                    </div>
                </form>
                @if(isset($score) && $score->percentage > 0.75)
                    <div class="mt-5">
                        <h3>Wynik:</h3>
                        <h4 class="text-green"> {{$score->percentage * 100}}% </h4>
                    </div>
                @endif
            </div>
        </div>

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
                            WebMeIn was created in order to develop competences by students of secondary schools, and above all of technical schools.
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
