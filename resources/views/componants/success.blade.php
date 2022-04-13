@if(Session::has('success'))<div class="alert alert-success" style="color: red; font-size:12px;">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{!! session('success') !!}</strong></div>@endif
