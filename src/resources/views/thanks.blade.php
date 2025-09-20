@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
<link rel="stylesheet" href="{{ asset('css/contact.css') }}">
@endsection

@section('content')
<div class="thanks">
    <h1>お問い合わせありがとうございました</h1>
    <a href="{{ route('contact.index') }}">HOMEへ戻る</a>
</div>
@endsection