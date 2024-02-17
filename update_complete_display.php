<?php
// セッションの開始
session_start();

// もしログインしていなければ、ログインページにリダイレクト
if (!isset($_SESSION['mail'])) {
    header("Location: login.php");
    exit();
}

// 成功メッセージと失敗メッセージをセッションから取得
$success = $_SESSION['success'] ?? null;
$failure = $_SESSION['failure'] ?? null;

// ユーザーの権限を取得
$role = $_SESSION['role'] ?? null;

// 成功メッセージと失敗メッセージをセッションから削除
unset($_SESSION['success']);
unset($_SESSION['failure']);
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
      <a href="http://localhost:8888/Registration/index.php">
        <img src="img/diblog_logo.jpg" id="logo">
      </a>
      <p>ようこそ ID  <?php echo $user_id; ?>様</p>
      <p> <?php echo $_SESSION['mail']; ?></p>
      <?php if ($role === '一般'): ?>
        <p>このアカウント権限は一般です</p>
      <?php elseif ($role === '管理者'): ?>
        <p>このアカウント権限は管理者です</p>
      <?php endif; ?>
      <p><a href="logout.php">Logout</a></p>
    </div>

    <div id="menu">
      <ul>
        <li><a href="http://localhost:8888/Registration/index.php">トップ</a></li>
        <li>プロフィール</li>
        <li>D.I.Blogについて</li>
        <?php if ($role === '管理者'): ?>
          <li><a href="http://localhost:8888/Registration/regist.php">登録ホーム</a></li>
          <li><a href="http://localhost:8888/Registration/list.php">アカウント一覧</a></li>
        <?php endif; ?>
        <li>問い合わせ</li>
        <li>その他</li>
      </ul>
    </div>
  </header>
  <main>
    <h3>アカウント更新完了画面</h3>
    <div>
      <h1 id="databasedeleteupdate">
        <?php if ($success): ?>
            <p style="color: green;"><?php echo $success; ?></p>
        <?php elseif ($failure): ?>
            <p style="color: red;"><?php echo $failure; ?></p>
        <?php endif; ?>
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
