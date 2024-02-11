<?php
// パスワードをハッシュ化
$hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
// 現在の日時を取得
$registeredTime = date("Y-m-d H:i:s");
// パラメータが0の場合は「有効」で1の場合は「無効」
$delete_flag = "0";

// try ブロック:データベースへの登録処理が try内で実行されます。この部分でエラーが発生した場合は、catch ブロックに処理が移ります。
try {
  // PDOを使用してデータベースに接続し、ユーザーの情報をデータベースのusersテーブルに挿入
  $pdo = new PDO("mysql:dbname=DIBlog;host=localhost;", "root", "root");
  // prepare()メソッドは、実行するSQLクエリのプリペアドステートメント（準備された文）を作成します。VALUES以下の各?はプレースホルダであり、後でバインドされる値が入る場所を表しています。
  $stmt = $pdo->prepare("INSERT INTO users (family_name, last_name, family_name_kana, last_name_kana, mail, password, gender, postal_code, prefecture, address_1, address_2, authority, delete_flag, registered_time) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
  // execute()メソッドは、プリペアドステートメントを実行します。配列内の値が対応するプレースホルダにバインドされます。実行結果は$resultに格納されます。
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
    $delete_flag,    //削除の有無
    $registeredTime // 現在の日時を使用
  ]);

  if ($result) {
    // データベースへの登録が成功した場合に実行される。$result が true の場合メッセージが出力されます。
    // echo "データベースへの登録が完了しました。";
    $success = "アカウントの登録が完了しました。";
  } else {
    // データベースへの登録が失敗した場合に実行される。この場合、$stmt->errorInfo() を使用してエラー情報を取得し、エラーコードとエラーメッセージを表示します。
    $failure = "エラーが発生したためアカウント登録できません。";
  }
} catch (PDOException $e) {
  // PDOExceptionが発生した場合にキャッチされる部分です。これは、データベースへの接続やクエリ実行などで発生する可能性のある例外です。エラーメッセージが表示されます。
  echo "データベースへの登録が失敗しました。";
}
?>



<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="css/shareStyle.css">
  <title>アカウント登録完了画面</title>
  <style>
    div {
      text-align: center; /* 中央寄せ */
      margin:  20px;
    }
    #databaseRegistrationResults {
    padding: 10px;              /* 余白指定 */
    background-color:  #ddd;    /* 背景色指定 */
    height: 150px;              /* 高さ指定 */
    text-align:  center;        /* 中央寄せ */
    }
    #topBack {
      text-align: center;
      padding: 20px;
      border: 1px solid #ccc;
      background-color: #f8f8f8;
    }
  </style>
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
        <li> <a href="http://localhost:8888/Registration/list.php">アカウント一覧</a></li>
        <li>問い合わせ</li>
        <li>その他</li>
      </ul>
    </div>
  </header>
  <main>
    <div>
      <h1 id="databaseRegistrationResults">
        <?php
          if (isset($success)) {
            echo $success;// 成功メッセージ
            echo "<br>";
          }

          if (isset($failure)) {
            echo $failure;// 失敗メッセージ
            echo "<br>";
          }
        ?>
      </h1>
    </div>

    <div>
      <p>
        <a href="http://localhost:8888/Registration/index.php" id = "topBack" >TOPページへ戻る</a>
      </p>
    </div>
  </main>
  <footer>
    <p>Copytifht D.I.Worksl D.I.blog is the one which provides A to Z about programming</p>
  </footer>

</body>
</html>
