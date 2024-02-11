<?php
  // データベースへの接続
  mb_internal_encoding("utf8");
  $servername = "localhost";
  $username = "root";
  $password = "root";
  $dbname = "DIBlog";

  try {
    $pdo = new PDO("mysql:dbname={$dbname};host={$servername}", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch (PDOException $e) {
    die("データベースへの接続に失敗しました: " . $e->getMessage());
  }


  // ユーザーIDを取得
  $userId = $_POST['id'];

  // データベースの更新処理
  try {
      // delete_flagカラムを1に更新するSQLクエリを準備
      $stmt = $pdo->prepare("UPDATE users SET delete_flag = 1 WHERE id = :id");
      $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
      $stmt->execute();

      $delete_complete = "削除が完了しました。";

  } catch (PDOException $e) {
      $delete_failure = "削除に失敗しました: " . $e->getMessage();
  }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="css/shareStyle.css">
  <title>アカウント削除</title>
  <script type="text/javascript" src="js/Delete/script.js"></script>
  <style>
    div {
      text-align: center; /* 中央寄せ */
      margin:  20px;
    }
    h3 {
      margin:  20px;
    }
    #databasedeleteResults {
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
      <a href="http://localhost:8888/Registration/index.php">
        <img src="img/diblog_logo.jpg" id="logo">
      </a>
    </div>

    <div id="menu">
      <ul>
        <li><a href="http://localhost:8888/Registration/index.php">トップ</a></li>
        <li>プロフィール</li>
        <li>D.I.Blogについて</li>
        <li> <a href="http://localhost:8888/Registration/regist.php">登録ホーム</a></li>
        <li> <a href="http://localhost:8888/Registration/list.php">アカウント一覧</a></li>
        <li>問い合わせ</li>
        <li>その他</li>
      </ul>
    </div>
  </header>
  <main>
    <h3>アカウント削除完了画面</h3>
    <div>
      <h1 id="databasedeleteResults">
      <?php
        if (isset($delete_complete)) {
          echo  $delete_complete;// 成功メッセージ
          echo "<br>";
        }
        if (isset($delete_failure)) {
          echo $delete_failure;// 失敗メッセージ
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
