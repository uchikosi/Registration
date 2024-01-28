<!-- // regist_complete.php -->
<?php
// var_dump($_POST);
// $familyName = isset($_POST['familyName']) ? $_POST['familyName'] : '';
// var_dump($familyName);

// パスワードをハッシュ化
$hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
// 現在の日時を取得
$registeredTime = date("Y-m-d H:i:s");
// パラメータが0の場合は「有効」で1の場合は「無効」
$delete_flag = "1";

// try ブロック:データベースへの登録処理が try内で実行されます。この部分でエラーが発生した場合は、catch ブロックに処理が移ります。
try {
  $pdo = new PDO("mysql:dbname=DIBlog;host=localhost;", "root", "root");
  $stmt = $pdo->prepare("INSERT INTO users (family_name, last_name, family_name_kana, last_name_kana, mail, password, gender, postal_code, prefecture, address_1, address_2, authority, delete_flag, registered_time) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
  $result = $stmt->execute([
    $_POST['familyName'],
    $_POST['lastName'],
    $_POST['familyNameKana'],
    $_POST['lastNameKana'],
    $_POST['mail'],
    $hashedPassword,
    $_POST['gender'],
    $_POST['postalCode'],
    $_POST['prefecture'],
    $_POST['address1'],
    $_POST['address2'],
    $_POST['authority'],
    $delete_flag,
    $registeredTime // 現在の日時を使用
  ]);

  if ($result) {
    // データベースへの登録が成功した場合に実行される。$result が true の場合メッセージが出力されます。
    echo "データベースへの登録が成功しました。";
  } else {
    // データベースへの登録が失敗した場合に実行される。この場合、$stmt->errorInfo() を使用してエラー情報を取得し、エラーコードとエラーメッセージを表示します。
    // $errorInfo = $stmt->errorInfo();
    // PHP PDO (PHP Data Objects) ドライバを使用して実行された直近のデータベース操作に関するエラー情報を返す PDOStatement オブジェクトのメソッドです。このメソッドが返す情報は、通常、エラーコード、SQLSTATE エラーコード、エラーメッセージの3つの要素からなる配列です。
    // エラーコード ($errorInfo[1]): データベースエラーを表す整数コードです。異なるデータベースでは異なるエラーコードが使用されることがあります。成功した場合は 0 です。

    // SQLSTATE エラーコード: SQL 標準に基づくエラーコードで、エラーの種類を示します。$errorInfo[0] に格納されます。

    // エラーメッセージ ($errorInfo[2]): データベースエラーに関する説明的なメッセージです。エラーが発生した場合、このメッセージに詳細な情報が含まれることがあります。

    echo "データベースへの登録が失敗しました。";

    // echo "データベースへの登録が失敗しました。エラーコード: " . $errorInfo[1] . "、エラーメッセージ: " . $errorInfo[2];
  }
} catch (PDOException $e) {
  // PDOExceptionが発生した場合にキャッチされる部分です。これは、データベースへの接続やクエリ実行などで発生する可能性のある例外です。エラーメッセージが表示されます。
  echo "データベースへの登録が失敗しました。";
  // echo "データベースへの登録が失敗しました。エラーメッセージ: " . $e->getMessage();
  // getMessage();例外が発生すると、それに関する情報を含む Exception オブジェクトが生成されます。その際、例外オブジェクトにはエラーに関する詳細な情報（エラーメッセージなど）が含まれています。getMessage() メソッドは、これらの情報の中からエラーメッセージ部分を取り出します。
}
?>



<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="style.css">
  <title>アカウント登録確認画面</title>
</head>
<body>
  <header>
    <div>
      <a href="http://localhost:8888/Registration/regist.php">
        <img src="img/diblog_logo.jpg" id="logo">
      </a>
    </div>

    <div id="menu">
      <ul>
        <li><a href="http://localhost:8888/Registration/regist.php">トップ</a></li>
        <li>プロフィール</li>
        <li>D.I.Blogについて</li>
        <li> <a href="http://localhost:8888/Registration/regist_confirm.php">登録ホーム</a></li>
        <li>問い合わせ</li>
        <li>その他</li>
      </ul>
    </div>
  </header>
  <footer>
    <p>Copytifht D.I.Worksl D.I.blog is the one which provides A to Z about programming</p>
  </footer>

</body>
</html>
