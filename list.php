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
$result = $pdo->query($sql);å

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="css/shareStyle.css">
  <title>アカウント一覧</title>
  <script type="text/javascript" src="js/list/script.js"></script>
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
              <th>更新</th>
              <th>削除</th>
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
                echo "<td>{$row['mail']}</td>";
                echo "<td>" . ($row['gender'] == 0 ? '男' : '女') . "</td>";
                echo "<td>" . ($row['authority'] == 0 ? '一般' : '管理者') . "</td>";
                echo "<td>" . ($row['delete_flag'] == 0 ? '有効' : '無効') . "</td>";
                // 登録日時
                echo "<td>" . date("Y/m/d", strtotime($row['registered_time'])) . "</td>";
                // 更新日時
                echo "<td>";
                if ($row['update_time'] !== null) {
                  // 値があれば表示、NULLの場合に空欄になる
                    echo date("Y/m/d", strtotime($row['update_time']));
                }else {
                    echo "更新なし";
                }
                echo "</td>";
                echo "<td><a href='update.php?id={$row['id']}'>更新</a></td>";
                echo "<td><a href='delete.php?id={$row['id']}'>削除</a></td>";
                echo "</tr>";
            }
          ?>
        </table>

      </div>
  </main>
  <footer>
    <p>Copytifht D.I.Worksl D.I.blog is the one which provides A to Z about programming</p>
  </footer>

</body>
</html>
<?php
// データベース接続を閉じる
$pdo = null;
?>
