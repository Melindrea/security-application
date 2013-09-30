<!-- check for flash notification message -->
@if(Session::has('flash_notice'))
    <div id="flash_notice">{{ Session::get('flash_notice') }}</div>
@endif
@if(Session::has('flash_error'))
    <div id="flash_error">{{ Session::get('flash_error') }}</div>
@endif
