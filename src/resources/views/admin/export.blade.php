<table>
    <thead>
        <tr>
            <th>名前</th>
            <th>性別</th>
            <th>メールアドレス</th>
            <th>電話番号</th>
            <th>住所</th>
            <th>建物名</th>
            <th>お問い合わせ種類</th>
            <th>お問い合わせ内容</th>
            <th>作成日時</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($inquiries as $inquiry)
        <tr>
            <td>{{ $inquiry->name }}</td>
            <td>{{ $inquiry->gender_label }}</td>
            <td>{{ $inquiry->email }}</td>
            <td>{{ $inquiry->tel }}</td>
            <td>{{ $inquiry->address }}</td>
            <td>{{ $inquiry->building }}</td>
            <td>{{ $inquiry->category->content ?? '' }}</td>
            <td>{{ $inquiry->detail }}</td>
            <td>{{ $inquiry->created_at->format('Y-m-d H:i') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>