@extends('layouts.admin')

@section('content')
    <table class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Created At</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
            @if($users)
            @foreach($users as $user)
                <tr>
                    <td> {{$user->id}} </td>
                    <td> {{$user->name}} </td>
                    <td> {{$user->email}} </td>
                    <td> {{$user->role['role']}}</td>
                    <td> {{$user->created_at->diffForHumans()}} </td>
                    <td> @if($user->is_active == 1)<span style="color: #3c763d">{{'Active'}}@else<span style="color: red">{{'Not Active'}}@endif </td>
                </tr>
            @endforeach
            @endif
        </tbody>
    </table>



@endsection