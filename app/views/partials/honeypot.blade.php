<div class="pot">
    {{ Form::label($honeypotName, trans('forms.honeypot.label')) }}
    {{ Form::text($honeypotName) }}
    {{ Form::hidden($honeypotTimeName, time()) }}
</div>
