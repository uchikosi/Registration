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

// データベースからユーザー情報を取得（idの大きい順に並べる）
$sql = "SELECT * FROM users ORDER BY id DESC";
$result = $pdo->query($sql);

session_start();
// もしログインしていなければ、ログインページにリダイレクト
if (!isset($_SESSION['mail'])) {
    header("Location: login.php");
    exit();
}

// ユーザーの権限を取得
$role = $_SESSION['role'] ?? null;
?>


<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="css/shareStyle.css">
  <title>アカウント一覧</title>
  <style>
    /* 罫線 */
    table {
        border-collapse: collapse;
        width: 98%;
        margin: 15px;
    }

    table, th, td {
        border: 1px solid black;
        text-align: center; /* 中央配置 */
        padding: 8px; /* セル内の余白を追加 */
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
        <li> <a href="http://localhost:8888/Registration/regist.php">登録ホーム</a></li>
        <li> <a href="http://localhost:8888/Registration/list.php">アカウント一覧</a></li>
        <li>問い合わせ</li>
        <li>その他</li>
      </ul>
    </div>
  </header>
  <main>
      <div id="list">
        <h1>アカウント一覧</h1>
        <table>
          <tr>
            <th>ID</th>
            <th>名前（姓）</th>
            <th>名前（名）</th>
            <th>カナ（姓）</th>
            <th>カナ（名）</th>
            <th>メールアドレス</th>
            <th>性別</th>
            <th>アカウント権限</th>
            <th>削除フラグ</th>
            <th>登録日時</th>
            <th>更新日時</th>
            <?php if ($role === '管理者'): ?>
              <th>更新</th>
              <th>削除</th>
            <?php endif; ?>
          </tr>

          <?php
            // データベースから取得したユーザー情報を表示
            foreach ($result as $row) {
              echo "<tr>";
              echo "<td>{$row['id']}</td>";
              echo "<td>{$row['family_name']}</td>";
              echo "<td>{$row['last_name']}</td>";
              echo "<td>{$row['family_name_kana']}</td>";
              echo "<td>{$row['last_name_kana']}</td>";
              // メールアドレスが50文字以上の場合に折り返して表示
              $mail = $row['mail'];
              $mailClass = strlen($mail) > 50 ? 'long-text' : ''; // 適切な文字数を設定
              echo "<td class='$mailClass'>{$mail}</td>";
              echo "<td>" . ($row['gender'] == 0 ? '男' : '女') . "</td>";
              echo "<td>" . ($row['authority'] == 0 ? '一般' : '管理者') . "</td>";
              echo "<td>" . ($row['delete_flag'] == 0 ? '有効' : '無効') . "</td>";
              // 登録日時
              echo "<td>" . date("Y/m/d", strtotime($row['registered_time'])) . "</td>";
              // 更新日時
              echo "<td>";
              if ($row['update_time'] !== null) {
                // 値があれば表示、NULLの場合に更新なしになる
                  echo date("Y/m/d", strtotime($row['update_time']));
              }else {
                  echo "更新なし";
              }
              echo "</td>";
              if ($role === '管理者'):
                echo "<td><a href='update.php?id={$row['id']}'>更新</a></td>";
                echo "<td><a href='delete.php?id={$row['id']}'>削除</a></td>";
              endif;
              echo "</tr>";
            }
          ?>
        </table>
      </div>
  </main>
  <footer>
    <p>Copytifht D.I.Worksl D.I.blog is the one which provides A to Z about programming</p>
  </footer>

  <script>
    var longTextElements = document.getElementsByClassName('long-text');
    for (var i = 0; i < longTextElements.length; i++) {
      var element = longTextElements[i];
      var text = element.innerText;
      if (text.length > 50) {
          element.innerHTML = text.replace(/(.{50})/g, '$1<br>');
      }
    }
  </script>
</body>
</html>
<?php
// データベース接続を閉じる
$pdo = null;
?>
