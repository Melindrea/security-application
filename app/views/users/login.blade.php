@extends('layouts.master')

@section('content')
    <p><a href="{{ URL::route('users.create') }}">Register</a></p>
    {{ Form::open(array('route' => 'login')) }}
        <dl class="lining">
            <dt>
                {{ Form::label('username', trans('forms.username.label')) }}
            </dt>
            <dd>
                {{ Form::text('username', null, array('required' => 'required', 'placeholder' => trans('forms.username.placeholder'))) }}
            </dd>
            <dt>
                {{ Form::label('password', trans('forms.password.label')) }}
            </dt>
            <dd>
                {{ Form::password('password', null, array('required' => 'required')) }}
            </dd>
            <dt>
                {{ Form::label('remember-me', trans('forms.remember_me.label')) }}
                <small>{{ trans('forms.remember_me.hint') }}</small>
            </dt>
            <dd>
                {{ Form::checkbox('remember-me', 'yes') }}
            </dd>
        </dl>

        {{ Form::button(trans('forms.login.label'), array('type' => 'submit', 'name' => 'login', 'value' => 'login')) }}
    {{ Form::close() }}
@stop
