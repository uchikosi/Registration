<?php
// ユーザーIDを取得
$userId = $_GET['id'];

// var_dump($userId);
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
    #deleteconfirm {
      padding: 10px;              /* 余白指定 */
      background-color:  #ddd;    /* 背景色指定 */
      height: 100px;              /* 高さ指定 */
      text-align:  center;        /* 中央寄せ */
    }
   .button-container{
      padding: 10px;              /* 余白指定 */
      height: 50px;              /* 高さ指定 */
      text-align:  center;        /* 中央寄せ */
      display: flex;
      justify-content:center
    }
    #deleteBack {
      padding: 20px;
      margin: 10px;
    }

    #deleteDatabase {
      padding: 20px;
      margin: 10px;
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
    <h3>アカウント削除確認画面</h3>
    <div id="">
      <h1 id=deleteconfirm>ユーザーのID: <?php echo $userId; ?>を本当に削除してしまってよろしいですか？</h1>
      <div class="button-container">
        <form action="delete.php" method="GET" id = "deleteBack">
          <input type="hidden" name="id" value="<?php echo $userId; ?>">
          <input type="submit" value="前に戻る">
        </form>
         <!-- 削除ボタン -->
        <form action="delete_complete.php" method="POST" id = "deleteDatabase">
          <input type="hidden" name="id" value="<?php echo $userId; ?>">
          <input type="submit" value="削除する">
        </form>
      </div>
    </div>
  </main>
  <footer>
    <p>Copytifht D.I.Worksl D.I.blog is the one which provides A to Z about programming</p>
  </footer>

</body>
</html>
