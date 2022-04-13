@if(Session::has('error'))<div class="alert alert-solid alert-info" style="color: red; font-size:12px;">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{!! session('error') !!}</strong></div>@endif
