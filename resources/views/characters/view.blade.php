@extends('layouts.layout')

@section('title', 'Character Sheet')

@section('script')
<script>
$(document).ready(function(){
  var contents = [].concat(@json($sheet));

  loadData(contents);
  clearInterval(interval);
  ask = false;
  $('input, textarea').prop('disabled', true);
  $('button').remove();
});
</script>
@endsection