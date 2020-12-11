@extends('web.layout')
@section('content')
@php $r =   'web.details.detail1' . $final_theme['detail']; @endphp
@include($r)
@include('web.common.scripts.addToCompare')
@endsection
