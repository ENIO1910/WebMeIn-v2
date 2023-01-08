@extends('layouts.app')

@section('content')
    @vite(['resources/js/app.js', 'resources/js/delete.js'])
    <div class="container" >
        <div class="row pt-5">
            <div class="col-6">
                <h1>Lista kursów</h1>
            </div>
        </div>
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">ID</th>
                <th scope="col">{{__('Name')}}</th>
                <th scope="col">{{__('Surname')}}</th>
                <th scope="col">{{__('Email')}}</th>
                <th scope="col">{{__('School')}}</th>
                <th scope="col">{{__('Role')}}</th>
                <th scope="col">{{__('Actions')}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $key => $user)
                <tr>
                    <th scope="row">{{$key + 1}}</th>
                    <th >{{$user->id}}</th>
                    <td>{{$user->name}}</td>
                    <td>{{$user->surname}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->school}}</td>
                    <td>ADMIN</td>
                    <td>
                        <button class="btn btn-danger btn-sm delete" data-id="{{$user->id}}">
                            <i class="fa-solid fa-trash"></i>
                        </button>

                        <a href="{{route('users.edit', $user->id)}}">
                            <button class="btn btn-primary btn-sm edit" >
                                <i class="fa-solid fa-edit"></i>
                            </button>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{$users->links()}}
    </div>
@endsection

@section('javascript')
    const deleteUrl = "{{url('users')}}/";
@endsection
@section('js-files')
    @vite('resources/js/delete.js')
@endsection
