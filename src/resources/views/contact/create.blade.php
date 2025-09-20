@extends('layouts.app')

@section('content')
<div class="brand-header">FashionablyLate</div>
<div class="contact-title">Contact</div>

<div class="contact-form">
    <form method="POST" action="{{ route('contact.confirm') }}">
        @csrf

        <table class="contact-table">
            <tr>
                <th>お名前 <span class="required">※</span></th>
                <td>
                    <div class="name-group">
                        <input type="text" name="last_name" placeholder="姓" value="{{ old('last_name', session('inputs.last_name')) }}">
                        <input type="text" name="first_name" placeholder="名" value="{{ old('first_name', session('inputs.first_name')) }}">
                    </div>
                    @error('last_name') <div class="error">{{ $message }}</div> @enderror
                    @error('first_name') <div class="error">{{ $message }}</div> @enderror
                </td>
            </tr>
            <tr>
                <th>性別 <span class="required">※</span></th>
                <td>
                    <select name="gender">
                        <option value="">選択してください</option>
                        <option value="1" {{ old('gender', session('inputs.gender')) == 1 ? 'selected' : '' }}>男</option>
                        <option value="2" {{ old('gender', session('inputs.gender')) == 2 ? 'selected' : '' }}>女</option>
                        <option value="3" {{ old('gender', session('inputs.gender')) == 3 ? 'selected' : '' }}>その他</option>
                    </select>
                    @error('gender') <div class="error">{{ $message }}</div> @enderror
                </td>
            </tr>
            <tr>
                <th>メールアドレス <span class="required">※</span></th>
                <td>
                    <input type="email" name="email" value="{{ old('email', session('inputs.email')) }}">
                    @error('email') <div class="error">{{ $message }}</div> @enderror
                </td>
            </tr>
            <tr>
                <th>電話番号 <span class="required">※</span></th>
                <td>
                    <div class="tel-group">
                        <input type="text" name="tel1" value="{{ old('tel1', session('inputs.tel1')) }}">
                        <span class="tel-dash">-</span>
                        <input type="text" name="tel2" value="{{ old('tel2', session('inputs.tel2')) }}">
                        <span class="tel-dash">-</span>
                        <input type="text" name="tel3" value="{{ old('tel3', session('inputs.tel3')) }}">
                    </div>
                    @error('tel1') <div class="error">{{ $message }}</div> @enderror
                    @error('tel2') <div class="error">{{ $message }}</div> @enderror
                    @error('tel3') <div class="error">{{ $message }}</div> @enderror
                </td>
            </tr>
            <tr>
                <th>住所 <span class="required">※</span></th>
                <td>
                    <input type="text" name="address" value="{{ old('address', session('inputs.address')) }}">
                    @error('address') <div class="error">{{ $message }}</div> @enderror
                </td>
            </tr>
            <tr>
                <th>建物名</th>
                <td>
                    <input type="text" name="building" value="{{ old('building', session('inputs.building')) }}">
                </td>
            </tr>
            <tr>
                <th>お問い合わせの種類 <span class="required">※</span></th>
                <td>
                    <select name="category_id">
                        <option value="">選択してください</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', session('inputs.category_id')) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id') <div class="error">{{ $message }}</div> @enderror
                </td>
            </tr>
            <tr>
                <th>お問い合わせ内容 <span class="required">※</span></th>
                <td>
                    <textarea name="detail" maxlength="120">{{ old('detail', session('inputs.detail')) }}</textarea>
                    @error('detail') <div class="error">{{ $message }}</div> @enderror
                </td>
            </tr>
        </table>

        <button type="submit" class="btn-confirm">確認画面</button>
    </form>
</div>
@endsection