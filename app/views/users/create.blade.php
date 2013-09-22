@extends('layouts.master')

@section('content')
    @if ( $errors->count() > 0 )
      <h3>{{ trans('forms.validation.header') }}</h3>

      <p>{{ Lang::choice('forms.validation.body', $errors->count()) }}</p>

      <ul>
        @foreach( $errors->all() as $message )
          <li>{{ $message }}</li>
        @endforeach
      </ul>
    @endif
    {{ Form::open(array('route' => 'users.store')) }}
        <fieldset>
            <legend>{{ trans('forms.required_fields') }}</legend>
            <dl class="lining">
                <dt>
                    {{ Form::label('un_field', trans('forms.username.label')) }}
                    <small>{{ trans('forms.username.hint') }}</small>
                </dt>
                <dd>
                    {{ Form::text('un_field', null, array('required' => 'required', 'placeholder' => trans('forms.username.placeholder'))) }}
                </dd>
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
                    {{ Form::label('email_confirmation', trans('forms.email.confirmation')) }}
                </dt>
                <dd>
                    {{ Form::email('email_confirmation', null, array('required' => 'required')) }}
                </dd>
                <dt>
                    {{ Form::label('password', trans('forms.password.label')) }}
                    <small>{{ trans('forms.password.hint') }}</small>
                </dt>
                <dd>
                    {{ Form::text('password', null, array('required' => 'required', 'placeholder' => trans('forms.password.placeholder'))) }}
                </dd>
                <dt>
                    {{ Form::label('agree_terms', trans('forms.terms.label')) }}
                    <small>{{ trans('forms.terms.hint') }}</small>
                </dt>
                <dd>
                    {{ Form::checkbox('agree_terms', 'yes') }}
                </dd>
            </dl>
        </fieldset>
        <dl class="lining">
            <dt>
                {{ Form::label('remember_me', trans('forms.remember_me.label')) }}
                <small>{{ trans('forms.remember_me.hint') }}</small>
            </dt>
            <dd>
                {{ Form::checkbox('remember_me', 'yes') }}
            </dd>
        </dl>

        {{ Form::honeypot('username', 'username_time') }}

        {{ Form::button(trans('forms.register.label'), array('type' => 'submit', 'name' => 'register', 'value' => 'register')) }}
    {{ Form::close() }}
@stop
