<div class="modal-detail">
    <h2>お問い合わせ詳細</h2>

    <p><strong>お名前：</strong> {{ $contact->full_name }}</p>
    <p><strong>性別：</strong> {{ $contact->gender_label }}</p>
    <p><strong>メールアドレス：</strong> {{ $contact->email }}</p>
    <p><strong>電話番号：</strong> {{ $contact->tel }}</p>
    <p><strong>住所：</strong> {{ $contact->address }}</p>
    <p><strong>建物名：</strong> {{ $contact->building }}</p>
    <p><strong>お問い合わせ種類：</strong> {{ $contact->category->name ?? '' }}</p>
    <p><strong>お問い合わせ内容：</strong><br>{{ $contact->detail }}</p>

    <form method="POST" action="{{ route('contact.destroy', $contact->id) }}" style="margin-top: 20px;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-delete" onclick="return confirm('本当に削除しますか？')">削除</button>
    </form>
</div>