@extends('layouts.master')

@section('content')
    {{ Form::open(array('route' => 'users.create')) }}
        <fieldset>
            <legend>{{ trans('forms.required_fields') }}</legend>
            <dl class="lining">
                <dt>
                    {{ Form::label('display_name', trans('forms.display_name.label')) }}
                    <small>{{ trans('forms.display_name.hint') }}</small>
                </dt>
                <dd>
                    {{ Form::text('display_name', null, array('required' => 'required', 'placeholder' => trans('forms.display_name.placeholder'))) }}
                </dd>
                <dt>
                    {{ Form::label('email', trans('forms.email.label')) }}
                    <small>{{ trans('forms.email.hint') }}</small>
                </dt>
                <dd>
                    {{ Form::email('email', null, array('required' => 'required', 'placeholder' => trans('forms.email.placeholder'))) }}
                </dd>
                <dt>
                    {{ Form::label('password', trans('forms.password.label')) }}
                    <small>{{ trans('forms.password.hint') }}</small>
                </dt>
                <dd>
                    {{ Form::text('password', null, array('required' => 'required', 'placeholder' => trans('forms.password.placeholder'))) }}
                </dd>
                <dt>
                    {{ Form::label('remember_me', trans('forms.remember_me.label')) }}
                    <small>{{ trans('forms.remember_me.hint') }}</small>
                </dt>
                <dd>
                    {{ Form::checkbox('remember_me', 'yes') }}
                </dd>
            </dl>
        </fieldset>

        {{ Form::honeypot('username', 'username_time') }}

        {{ Form::button(trans('forms.register.label'), array('type' => 'submit', 'name' => 'register', 'value' => 'register')) }}
    {{ Form::close() }}
@stop
