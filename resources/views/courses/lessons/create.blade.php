@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center pt-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add Lesson') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{route('courses.lessons.store', $course->id)}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">

                            <input id="course_id" type="number" name="course_id" style="display:none" value="{{$course->id}}">

                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Number') }}</label>

                            <div class="col-md-6">
                                <input id="number" type="number" min="1" step="1" class="form-control @error('number') is-invalid @enderror" name="number" value="{{ old('name') }}" required autofocus>

                                @error('number')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="description" class="col-md-4 col-form-label text-md-end">{{ __('Description') }}</label>

                            <div class="col-md-6">
                                <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" placeholder="Opis czego dotyczy kurs" required autocomplete="email"></textarea>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="files" class="col-md-4 col-form-label text-md-end">{{ __('Files') }}</label>

                            <div class="col-md-6">
                                <input id="files" type="file" class="form-control @error('files') is-invalid @enderror" name="files" >

                                @error('files')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="pdf" class="col-md-4 col-form-label text-md-end">{{ __('Pdf_Files') }}</label>

                            <div class="col-md-6">
                                <input id="pdf" type="file" class="form-control  @error('pdf') is-invalid @enderror" name="pdf" >

                                @error('pdf')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('ADD') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
