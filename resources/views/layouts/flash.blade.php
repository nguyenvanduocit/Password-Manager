<?php
    $message = null;
    $type = null;
  if(Session::has('success_message')){
      $message = Session::get('success_message');
      $type = 'success';
  }elseif(Session::has('error_message')){
      $message = Session::get('error_message');
      $type = 'danger';
  }
?>
@if($message)
    <div class="container">
        <div class="alert alert-{{$type}}" role="alert">
            {{$message}}
        </div>
    </div>
@endif
