<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>JSテスト</title>
</head>
<body>
    <h1>JSテストページ</h1>
    <button id="test-button">押してみて</button>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            console.log("JSは読み込まれたよ！");
            document.getElementById('test-button').addEventListener('click', function () {
                alert("ボタン押されたよ！");
            });
        });
    </script>
</body>
</html>