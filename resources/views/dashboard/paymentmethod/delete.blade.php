@extends('layouts.app')

@section('content')
  @if(session('success'))

  @endif

  @if(errors->any())

  @endif

  <form action="{{ route('paymentmethod.destroy', $method->id) }}" method="POST">

  @method('DELETE')

  </form>
@endsection
