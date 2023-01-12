@extends('layouts.app')

@section('content')
    @vite(['resources/js/app.js', 'resources/js/delete.js'])
    <div class="container" >
        <div class="row pt-5">
            <div class="col-6">
                <h1>Lekcje</h1>
                <h3>{{$course->name}}</h3>
            </div>
            <div class="col-6">
                <a class="float-end" href="{{route("courses.lessons.create", $course->id)}}">
                    <buttton type="button" title="Dodaj lekcje" class="btn btn-primary addMore"><i class="fa-solid fa-plus"></i></buttton>
                </a>
            </div>
        </div>
        <table class="table table-striped">
            <thead>
            <tr class="text-center">
                <th scope="col">#</th>
                <th scope="col">ID</th>
                <th scope="col">{{__('Name')}}</th>
                <th scope="col">{{__('Description')}}</th>
                <th scope="col">{{__('Files')}}</th>
                <th scope="col">{{__('PDF')}}</th>
                <th scope="col">{{__('Actions')}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($lessons as $lesson)
                <tr style="vertical-align: middle">
                    <th class="text-center" scope="row">{{$lesson->number}}</th>
                    <td class="text-center">{{$lesson->id}}</th>
                    <td class="text-center">{{$lesson->name}}</td>
                    <td class="text-center">{{$lesson->description}}</td>
                    <td class="text-center"> <i class="fa-solid fa-file-arrow-down"></i> </td>
                    <td class="text-center"> {{$lesson->pdf_file_path}} </td>
                    <td class="text-center">
                        <button class="btn btn-danger btn-sm delete" data-id="{{$lesson->id}}">
                            <i class="fa-solid fa-trash"></i>
                        </button>

                        <a class="text-decoration-none" href="{{route('courses.lessons.edit', $lesson->id)}}">
                            <button title="Edycja" class="btn btn-primary btn-sm edit addMore" >
                                <i class="fa-solid fa-edit"></i>
                            </button>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{$lessons->links()}}
    </div>
@endsection
@section('javascript')
    const deleteUrl = "{{url('lessons')}}/";
@endsection
@section('js-files')
    @vite('resources/js/delete.js')
@endsection
