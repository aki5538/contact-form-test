@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
<link rel="stylesheet" href="{{ asset('css/contact.css') }}">
<style>
    .thanks-wrapper {
        position: relative;
        text-align: center;
        padding: 120px 20px;
        font-family: Georgia, serif;
    }

    .thanks-message {
        font-size: 24px;
        color: #333;
        z-index: 2;
        position: relative;
        margin-bottom: 40px;
        font-weight: bold;
    }

    .btn-home {
        padding: 12px 32px;
        font-size: 16px;
        background-color: #8B7969;
        color: white;
        border: none;
        border-radius: 4px;
        text-decoration: none;
        z-index: 2;
        position: relative;
        font-weight: bold;
    }

    .background-text {
        font-size: 100px;
        color: #eee;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 1;
        pointer-events: none;
        white-space: nowrap;
    }
</style>
@endsection

@section('content')
<div class="thanks-wrapper">
    <div class="background-text">Thank you</div>
    <div class="thanks-message">お問い合わせありがとうございました</div>
    <a href="{{ route('contact.create') }}" class="btn-home">HOME</a>
</div>
@endsection