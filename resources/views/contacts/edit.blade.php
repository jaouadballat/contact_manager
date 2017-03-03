@extends('layouts.main')

@section('content')
<!-- You need To Add a File -->
  <form action="{{route('contact.update', ['id' => $contact->id])}}" method="POST"  enctype="multipart/form-data">
   {{ csrf_field() }}
   {{ method_field('PUT') }}
  <!-- You need To Add a File -->
    @include('contacts.form')
</form>
@endsection