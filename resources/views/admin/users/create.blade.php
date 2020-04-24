@extends('layouts.admin')

@section('content')

    {!! Form::open(['method'=>'POST','action'=>'AdminUserController@store','files'=>true]) !!}
        {{csrf_field()}}

        <div class="form-group">
            {!! Form::label('name','Name:') !!}
            {!! Form::text('name',null,['class'=>'form-control','placeholder'=>'Enter the Name ']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('email','Email:') !!}
            {!! Form::email('email',null,['class'=>'form-control','placeholder'=>'Enter the Email ']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('password','Password:') !!}
            {!! Form::password('password',['class'=>'form-control','placeholder'=>'Enter the password ']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('role','Role:') !!}
            {!! Form::select('role_id',[""=>"Select Role"]+$roles,null,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('status','Status:') !!}
            {!! Form::select('is_active',[-1=>'Select Status',1=>'Active',0=>'Not Active'],null,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('avatar','Avatar:') !!}
            {!! Form::file('avatar') !!}
        </div>
        {!! Form::submit('Add',['class'=>'btn btn-primary']) !!}

    {!! Form::close() !!}
    <br/>

    @if($errors)
        <div class="alert alert-danger">
            <ul>
        @foreach($errors->all() as $error)
                <li>{{$error}}</li>
        @endforeach
            </ul>
        </div>
    @endif


@endsection

