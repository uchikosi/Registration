<?php
// セッションの開始
session_start();

// データベース接続情報
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "DIBlog";
// var_dump($_POST);

// 現在の日時を取得
$updateTime = date("Y-m-d H:i:s");


try {
  // データベースへの接続
  $pdo = new PDO("mysql:host={$servername};dbname={$dbname}", $username, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // POSTリクエストから更新する値を取得
  $userId = $_POST['id'];
  $familyName = $_POST['familyName'];
  $lastName = $_POST['lastName'];
  $familyNameKana = $_POST['familyNameKana'];
  $lastNameKana = $_POST['lastNameKana'];
  $mail = $_POST['mail'];
  // パスワードをハッシュ化
  $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
  $gender = $_POST['gender'];
  $postalCode = $_POST['postalCode'];
  $prefecture = $_POST['prefecture'];
  $address1 = $_POST['address1'];
  $address2 = $_POST['address2'];
  $authority = $_POST['authority'];
  $updateTime;

  // 他の更新する値も同様に取得する
  // var_dump($familyName);

  // UPDATE文を準備
  $stmt = $pdo->prepare("UPDATE users SET family_name = :familyName, last_name = :lastName, family_name_kana = :familyNameKana, last_name_kana = :lastNameKana, mail = :mail, password = :hashedPassword, gender = :gender, postal_code = :postalCode, prefecture = :prefecture, address_1 = :address1, address_2 = :address2, authority = :authority, update_time = :updateTime WHERE id = :userId");
  // 他のカラムも更新する場合はここに追加

  // バインドパラメータを設定
  $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
  $stmt->bindParam(':familyName', $familyName, PDO::PARAM_STR);
  $stmt->bindParam(':lastName', $lastName, PDO::PARAM_STR);
  $stmt->bindParam(':familyNameKana', $familyNameKana, PDO::PARAM_STR);
  $stmt->bindParam(':lastNameKana', $lastNameKana, PDO::PARAM_STR);
  $stmt->bindParam(':mail', $mail, PDO::PARAM_STR);
  $stmt->bindParam(':hashedPassword', $hashedPassword, PDO::PARAM_STR);
  $stmt->bindParam(':gender', $gender, PDO::PARAM_STR);
  $stmt->bindParam(':postalCode', $postalCode, PDO::PARAM_STR);
  $stmt->bindParam(':prefecture', $prefecture, PDO::PARAM_STR);
  $stmt->bindParam(':address1', $address1, PDO::PARAM_STR);
  $stmt->bindParam(':address2', $address2, PDO::PARAM_STR);
  $stmt->bindParam(':authority', $authority, PDO::PARAM_STR);
  $stmt->bindParam(':updateTime', $updateTime, PDO::PARAM_STR);


  // UPDATE文を実行
  $update=$stmt->execute();
  // SQL実行後にバインドされたパラメータを表示する
  // $stmt->debugDumpParams();

  if ($update) {
    // データベースへの登録が成功した場合に実行される。$result が true の場合メッセージが出力されます。
    $success = "アカウントの更新が完了しました。";
  } else {
    // データベースへの登録が失敗した場合に実行される。この場合、$stmt->errorInfo() を使用してエラー情報を取得し、エラーコードとエラーメッセージを表示します。
    $failure = "エラーが発生したためアカウント更新できません。";
  }
} catch (PDOException $e) {
  // PDOExceptionが発生した場合にキャッチされる部分です。これは、データベースへの接続やクエリ実行などで発生する可能性のある例外です。エラーメッセージが表示されます。
  $error = "データベースへの更新が失敗しました。";
}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="css/shareStyle.css">
  <title>アカウント完了画面</title>
  <style>
    div {
      text-align: center; /* 中央寄せ */
      margin:  20px;
    }
    h3 {
      margin:  20px;
    }
    #databasedeleteupdate {
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
    <h3>アカウント削除確認画面</h3>
    <div>
      <h1 id="databasedeleteupdate">
        <?php
        if (isset($success)) {
          echo $success;// 成功メッセージ
          echo "<br>";
        }
        if (isset($error)) {
          echo $error;// 失敗メッセージ
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
