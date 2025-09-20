@extends('layouts.app')

@section('content')
<div class="brand-header">FashionablyLate</div>

<div class="contact-container">
    <form method="GET" action="{{ route('admin.index') }}" class="search-form">
        <input type="text" name="keyword" placeholder="名前やメールアドレスを入力してください" value="{{ request('keyword') }}">
        
        <select name="gender">
            <option value="">性別</option>
            <option value="1" {{ request('gender') == '1' ? 'selected' : '' }}>男性</option>
            <option value="2" {{ request('gender') == '2' ? 'selected' : '' }}>女性</option>
            <option value="3" {{ request('gender') == '3' ? 'selected' : '' }}>その他</option>
        </select>

        <select name="category_id">
            <option value="">お問い合わせ種類</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>

        <input type="date" name="date" value="{{ request('date') }}">

        <button type="submit" class="btn btn-search">検索</button>
        <a href="{{ route('admin.index') }}" class="btn btn-reset">リセット</a>
        <a href="{{ route('admin.export', request()->query()) }}" class="btn btn-export">エクスポート</a>
    </form>

    @if (session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    <table class="contact-table">
        <thead>
            <tr>
                <th>名前</th>
                <th>性別</th>
                <th>メールアドレス</th>
                <th>お問い合わせ種類</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contacts as $contact)
                <tr>
                    <td>{{ $contact->last_name }} {{ $contact->first_name }}</td>
                    <td>
                        @if ($contact->gender == 1) 男性
                        @elseif ($contact->gender == 2) 女性
                        @else その他
                        @endif
                    </td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->category->name ?? '' }}</td>
                    <td>
                        <button type="button" class="btn btn-detail" data-id="{{ $contact->id }}">詳細</button>
                        
                        <form method="POST" action="{{ route('admin.destroy', $contact->id) }}" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-delete">削除</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $contacts->appends(request()->query())->links() }}
</div>

<!-- モーダルウィンドウ -->
<div id="contact-modal" class="modal" style="display:none;">
    <div class="modal-content">
        <span class="close">&times;</span>
        <div id="modal-body"></div>
    </div>
</div>

@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.btn-detail').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.dataset.id;
            fetch(`/admin/${id}`)
                .then(response => response.text())
                .then(html => {
                    document.getElementById('modal-body').innerHTML = html;
                    document.getElementById('contact-modal').style.display = 'block';
                });
        });
    });

    document.querySelector('.close').addEventListener('click', function () {
        document.getElementById('contact-modal').style.display = 'none';
    });
});
</script>
@endsection