<div class="pot">
    {{ Form::label($honeypotName, trans('forms.honeypot.label')) }}
    {{ Form::text($honeypotName) }}
    {{ Form::hidden($honeypotTimeName, Crypt::encrypt(time())) }}
</div>
