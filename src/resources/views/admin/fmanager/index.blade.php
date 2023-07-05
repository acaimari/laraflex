
@extends('laraflex::layouts.admin')

@section('content')

<!-- Styles -->

   <!--  <link href="{{ asset('vendor/file-manager/css/file-manager.css') }}" rel="stylesheet"> -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>


<div class="col-md-12" id="fm-main-block">
    <div id="fm"></div>
</div>

<script>
$(document).ready(function() {
    $.get('/fmanager', function(data) {
        $('#fm').html(data);
    });
});
</script>




@endsection