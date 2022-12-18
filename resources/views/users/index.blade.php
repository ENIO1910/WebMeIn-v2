@extends('layouts.app')

@section('content')
    <div class="container" >
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">ID</th>
                <th scope="col">{{__('Name')}}</th>
                <th scope="col">{{__('Surname')}}</th>
                <th scope="col">{{__('Email')}}</th>
                <th scope="col">{{__('School')}}</th>
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
                    <td>
                        <button class="btn btn-danger btn-sm delete" data-id="">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{$users->links()}}
    </div>
@endsection
