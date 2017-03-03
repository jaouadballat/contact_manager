@extends('layouts.main')

@section('content')
<!-- You need To Add a File -->
  <form action="{{route('contact.store')}}" method="POST"  enctype="multipart/form-data">
   {{ csrf_field() }}
  <!-- You need To Add a File -->
    @include('contacts.form')
</form>
@endsection