@extends('layouts.master')

@section('content')
    <h1>Messages <small>({{ count($messages) }})</small></h1>

    @if (count($messages) > 0)
        <ul>
        @foreach ($messages as $message)
            <li>
                <h2>{{ $message->subject }}</h2>
                <p>Posted on {{ $message->created_at }} by {{ $message->user->display_name }}</p>
                {{ HTML::markdown($message->content) }}
            </li>
        @endforeach
    </ul>
    @else
        <p>There are no messages</p>
    @endif

    <hr>

    <h2>Create a message</h2>
    @if (Auth::check())
        @if ( $errors->count() > 0 )
          <h3>{{ trans('forms.validation.header') }}</h3>

          <p>{{ Lang::choice('forms.validation.body', $errors->count()) }}</p>

          <ul>
            @foreach( $errors->all() as $message )
              <li>{{ $message }}</li>
            @endforeach
          </ul>
        @endif
        {{ Form::open(array('route' => 'messages.store')) }}
            <fieldset>
                <dl class="lining">
                    <dt>
                        {{ Form::label('subject', trans('forms.subject.label')) }}
                    </dt>
                    <dd>
                        {{ Form::text('subject', null, array('required' => 'required', 'placeholder' => trans('forms.subject.placeholder'))) }}
                    </dd>
                    <dt>
                        {{ Form::label('content', trans('forms.content.label')) }}
                    </dt>
                    <dd>
                        {{ Form::textarea('content')}}
                    </dd>
                </dl>
                <hr>
                <p>You can use Markdown in the content.</p>
            </fieldset>
            {{ Form::honeypot('username', 'username_time') }}

            {{ Form::button(trans('forms.message.label'), array('type' => 'submit', 'name' => 'message', 'value' => 'message')) }}
        {{ Form::close() }}
    @else
        <p>You must be <a href="{{ URL::route('login') }}">logged in</a> to post.</p>
    @endif

@stop
