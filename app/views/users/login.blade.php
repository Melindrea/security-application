@extends('layouts.master')

@section('content')
    {{ Form::open(array('route' => 'login')) }}
        <dl class="lining">
            <dt>
                {{ Form::label('email', trans('forms.email.label')) }}
            </dt>
            <dd>
                {{ Form::email('email', null, array('required' => 'required', 'placeholder' => trans('forms.email.placeholder'))) }}
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
