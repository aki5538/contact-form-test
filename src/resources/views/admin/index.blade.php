<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>FashionablyLate 管理画面</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}?v={{ time() }}">
</head>
<body>
    <header>
        <h1>FashionablyLate</h1>
        <div class="logout-area">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">ログアウト</button>
            </form>
        </div>
    </header>

    <h2>管理画面</h2>

    <section class="search-area">
        <h3>検索条件</h3>

        <!-- 検索フォーム -->
        <form method="GET" action="{{ route('admin.index') }}">
            <input type="text" name="name" value="{{ request('name') }}" placeholder="名前">
            <input type="text" name="email" value="{{ request('email') }}" placeholder="メールアドレス">

            <select name="gender">
                <option value="">性別</option>
                <option value="all" {{ request('gender') == 'all' ? 'selected' : '' }}>全て</option>
                <option value="male" {{ request('gender') == 'male' ? 'selected' : '' }}>男性</option>
                <option value="female" {{ request('gender') == 'female' ? 'selected' : '' }}>女性</option>
                <option value="other" {{ request('gender') == 'other' ? 'selected' : '' }}>その他</option>
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

            <button type="submit">検索</button>
            <a href="{{ route('admin.index') }}">リセット</a>
        </form>

        <!-- CSVエクスポートフォーム -->
        <form method="GET" action="{{ route('admin.export') }}" style="margin-top: 10px;">
            @csrf
            <input type="hidden" name="name" value="{{ request('name') }}">
            <input type="hidden" name="email" value="{{ request('email') }}">
            <input type="hidden" name="gender" value="{{ request('gender') }}">
            <input type="hidden" name="category_id" value="{{ request('category_id') }}">
            <input type="hidden" name="date" value="{{ request('date') }}">
            <button type="submit" class="btn btn-success">エクスポート</button>
        </form>
    </section>

    <table>
        <thead>
            <tr>
                <th>名前</th>
                <th>性別</th>
                <th>メールアドレス</th>
                <th>お問い合わせ種類</th>
                <th>詳細</th>
                <th>削除</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contacts as $contact)
            <tr>
                <td>{{ $contact->last_name }} {{ $contact->first_name }}</td>
                <td>
                    @if ($contact->gender == 1) 男性
                    @elseif ($contact->gender == 2) 女性
                    @elseif ($contact->gender == 3) その他
                    @else 未設定
                    @endif
                </td>
                <td>{{ $contact->email }}</td>
                <td>{{ $contact->category->name ?? '未分類' }}</td>
                <td>
                    <button class="open-modal"
                        data-id="{{ $contact->id }}"
                        data-name="{{ $contact->last_name }} {{ $contact->first_name }}"
                        data-gender="@if($contact->gender == 1)男性 @elseif($contact->gender == 2)女性 @elseif($contact->gender == 3)その他 @else 未設定 @endif"
                        data-email="{{ $contact->email }}"
                        data-tel="{{ $contact->tel }}"
                        data-address="{{ $contact->address }}"
                        data-category="{{ $contact->category->name ?? '' }}"
                        data-detail="{{ $contact->detail }}">
                        詳細
                    </button>
                </td>
                <td>
                    <form method="POST" action="{{ route('admin.destroy', $contact->id) }}" onsubmit="return confirm('本当に削除しますか？');">
                        @csrf
                        @method('DELETE')
                        <button type="submit">削除</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $contacts->links() }}

    <div id="modal" class="modal hidden">
        <div class="modal-content">
            <span class="close" id="modal-close">×</span>
            <p>お名前：<span id="modal-name"></span></p>
            <p>性別：<span id="modal-gender"></span></p>
            <p>メールアドレス：<span id="modal-email"></span></p>
            <p>電話番号：<span id="modal-phone"></span></p>
            <p>住所：<span id="modal-address"></span></p>
            <p>お問い合わせの種類：<span id="modal-type"></span></p>
            <p>お問い合わせの内容：<span id="modal-detail"></span></p>

            <form method="POST" action="" id="delete-form">
                @csrf
                @method('DELETE')
                <button type="submit">削除</button>
            </form>
        </div>
    </div>

    <script src="{{ asset('js/modal.js') }}?v={{ time() }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.open-modal').forEach(button => {
                button.addEventListener('click', function () {
                    alert('モーダル開くよ！');
                    document.getElementById('modal').classList.add('show');
                });
            });
        });
    </script>
</body>
</html>