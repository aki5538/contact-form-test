@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
<link rel="stylesheet" href="{{ asset('css/contact.css') }}">
@endsection

@section('content')
<div class="contact-confirm">
    <h2 class="contact-title">Confirm</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('contact.store') }}" method="POST">
        @csrf

        <div>
            <label>お名前：</label>
            <p>{{ $inputs['last_name'] }} {{ $inputs['first_name'] }}</p>
            <input type="hidden" name="last_name" value="{{ $inputs['last_name'] }}">
            <input type="hidden" name="first_name" value="{{ $inputs['first_name'] }}">
        </div>

        <div>
            <label>性別：</label>
            @php
                $genderLabels = [1 => '男性', 2 => '女性', 3 => 'その他'];
            @endphp
            <p>{{ $genderLabels[$inputs['gender']] ?? '未設定' }}</p>
            <input type="hidden" name="gender" value="{{ $inputs['gender'] }}">
        </div>

        <div>
            <label>メールアドレス：</label>
            <p>{{ $inputs['email'] }}</p>
            <input type="hidden" name="email" value="{{ $inputs['email'] }}">
        </div>

        <div>
            <label>電話番号：</label>
            <p>{{ $inputs['tel'] }}</p>
            <input type="hidden" name="tel" value="{{ $inputs['tel'] }}">
        </div>

        <div>
            <label>住所：</label>
            <p>{{ $inputs['address'] }}</p>
            <input type="hidden" name="address" value="{{ $inputs['address'] }}">
        </div>

        <div>
            <label>建物名：</label>
            <p>{{ $inputs['building'] }}</p>
            <input type="hidden" name="building" value="{{ $inputs['building'] }}">
        </div>

        <div>
            <label>お問い合わせの種類：</label>
            <p>{{ $category->name }}</p>
            <input type="hidden" name="category_id" value="{{ $category->id }}">
        </div>

        <div>
            <label>お問い合わせ内容：</label>
            <p>{{ $inputs['detail'] }}</p>
            <input type="hidden" name="detail" value="{{ $inputs['detail'] }}">
        </div>

        <div style="margin-top: 2rem;">
            <button type="submit">送信する</button>
            <a href="{{ route('contact.create') }}" onclick="event.preventDefault(); document.getElementById('back-form').submit();">修正する</a>
        </div>
    </form>

    <form id="back-form" action="{{ route('contact.create') }}" method="POST" style="display: none;">
        @csrf
        @foreach($inputs as $key => $value)
            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
        @endforeach
    </form>
</div>
@endsection