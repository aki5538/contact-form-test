@extends('layouts.app')

<style>
    .confirm-title {
        width: 100%;
        height: 100px;
        background-color: #8B7969;
        color: white;
        font-family: Georgia, serif;
        font-size: 35px;
        font-weight: 400;
        text-align: center;
        line-height: 100px;
        margin-bottom: 30px;
    }

    .confirm-container {
        max-width: 900px;
        margin: 0 auto;
        font-family: Georgia, serif;
    }

    .confirm-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 30px;
    }

    .confirm-table th,
    .confirm-table td {
        border: 1px solid #ccc;
        padding: 12px;
        text-align: left;
        vertical-align: top;
    }

    .confirm-table th {
        background-color: #f5f5f5;
        width: 200px;
    }

    .confirm-buttons {
        text-align: center;
        margin-top: 20px;
    }

    .btn {
        padding: 10px 20px;
        font-size: 16px;
        border: none;
        cursor: pointer;
        margin: 0 10px;
        border-radius: 4px;
    }

    .btn-send {
        background-color: #007bff;
        color: white;
    }

    .btn-edit {
        background-color: #6c757d;
        color: white;
    }
</style>

@section('content')
<div class="confirm-title">Confirm</div>

<div class="confirm-container">
    <form method="POST" action="{{ route('contact.store') }}">
        @csrf

        <table class="confirm-table">
            <tr>
                <th>お名前</th>
                <td>{{ $inputs['last_name'] }} {{ $inputs['first_name'] }}</td>
            </tr>
            <tr>
                <th>性別</th>
                <td>
                    @if ((int)$inputs['gender'] === 1)
                        男性
                    @elseif ((int)$inputs['gender'] === 2)
                        女性
                    @elseif ((int)$inputs['gender'] === 3)
                        その他
                    @else
                        未設定
                    @endif
                </td>
            </tr>
            <tr>
                <th>メールアドレス</th>
                <td>{{ $inputs['email'] }}</td>
            </tr>
            <tr>
                <th>電話番号</th>
                <td>{{ $inputs['tel1'] }}-{{ $inputs['tel2'] }}-{{ $inputs['tel3'] }}</td>
            </tr>
            <tr>
                <th>住所</th>
                <td>{{ $inputs['address'] }}</td>
            </tr>
            <tr>
                <th>建物名</th>
                <td>{{ $inputs['building'] }}</td>
            </tr>
            <tr>
                <th>お問い合わせの種類</th>
                <td>{{ $category->name }}</td>
            </tr>
            <tr>
                <th>お問い合わせ内容</th>
                <td>{!! nl2br(e($inputs['detail'])) !!}</td>
            </tr>
        </table>

        @foreach ($inputs as $key => $value)
            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
        @endforeach

        <div class="confirm-buttons">
            <button type="submit" class="btn btn-send">送信</button>
        </div>
    </form>

    <form method="GET" action="{{ route('contact.create') }}">
        <div class="confirm-buttons">
            <button type="submit" class="btn btn-edit">修正</button>
        </div>
    </form>
</div>
@endsection

