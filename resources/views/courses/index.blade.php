@extends('layouts.app')

@section('content')
    @vite(['resources/js/app.js', 'resources/js/delete.js'])
    <div class="container" >
        <div class="row">
            <div class="col-6">
                <h1>Lista kursów</h1>
            </div>
            <div class="col-6">
                <a class="float-end" href="{{route("courses.create")}}">
                    <buttton type="button" class="btn btn-primary"><i class="fa-solid fa-plus"></i></buttton>
                </a>
            </div>
        </div>
        <table class="table table-striped">
            <thead>
            <tr class="text-center">
                <th scope="col">#</th>
                <th scope="col">ID</th>
                <th scope="col">{{__('Name')}}</th>
                <th scope="col">{{__('Category')}}</th>
                <th scope="col">{{__('Description')}}</th>
                <th scope="col">{{__('Difficulty')}}</th>
                <th scope="col">{{__('Image')}}</th>
                <th scope="col">{{__('Actions')}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($courses as $key => $course)
                <tr style="vertical-align: middle">
                    <th scope="row">{{$key + 1}}</th>
                    <th >{{$course->id}}</th>
                    <td>{{$course->name}}</td>

                    <td>{{$categories[$course->category_id]}}</td>
                    <td>{{$course->description}}</td>
                    <td>{{$course->difficulty}}</td>
                    <td> <img src="{{asset('storage/'.$course->image_path)}}" width="200px" height="150px" alt="image"> </td>
                    <td>
                        <button class="btn btn-danger btn-sm delete" data-id="{{$course->id}}">
                            <i class="fa-solid fa-trash"></i>
                        </button>

                        <a class="text-decoration-none" href="{{route('courses.edit', $course->id)}}">
                            <button title="Edycja" class="btn btn-primary btn-sm edit addMore" >
                                <i class="fa-solid fa-edit"></i>
                            </button>
                        </a>

                        <a class="text-decoration-none" href="{{route('courses.lessons.index', $course->id)}}">
                            <button title="Lekcje" class="btn btn-success btn-sm addMore" >
                                <i class="fa-sharp fa-solid fa-list"></i>
                            </button>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{$courses->links()}}
    </div>
@endsection

@section('javascript')
    const deleteUrl = "{{url('courses')}}/";
@endsection
@section('js-files')
    @vite('resources/js/delete.js')
@endsection
