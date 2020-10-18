@extends('layouts.app')

@section('content')
        @if(Auth::user())
        <script type="text/javascript">window.location.href = "/home";</script>
        @endif
      <center>Welcome to e4Health Backend assistant demo</center>
@endsection
