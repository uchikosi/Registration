<?php
  session_start();
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

  // URLからユーザーIDを取得
  $userId = $_GET['id'];

  // データベースから対象のユーザー情報を取得するSQLクエリ
  $stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
  $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
  $stmt->execute();

  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  if (!$user) {
      echo "該当するユーザーが見つかりませんでした。";
      exit();
  }
  // var_dump($user);

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
  <link rel="stylesheet" type="text/css" href="../css/shareStyle.css">
  <title>アカウント削除</title>
  <script type="text/javascript" src="../js/Delete/script.js"></script>
  <style>
    table{
      margin: 0 auto;
    }
    td{
      text-align: center;
    }
    #confirm{
      text-align: center;
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
    <h1>アカウント削除</h1>
    <div id="">
      <table>
        <tr>
          <td>名前（姓）</td>
          <td><?php echo $user['family_name']; ?></td>
        </tr>
        <tr>
            <td>名前（名）</td>
            <td><?php echo $user['last_name']; ?></td>
        </tr>
        <tr>
          <td>カナ（姓）</td>
          <td><?php echo $user['family_name_kana']; ?></td>
        </tr>
        <tr>
          <td>カナ（名）</td>
          <td><?php echo $user['last_name_kana']; ?></td>
        </tr>
        <tr>
          <td>メールアドレス</td>
          <td><?php echo $user['mail']; ?></td>
        </tr>
        <tr>
          <td>パスワード</td>
          <td><?php echo str_repeat("●", min(strlen($user['password']), 10)); ?></td>
        </tr>
        <tr>
          <td>性別</td>
          <td><?php echo ($user['gender'] == 0 ? '男性' : '女性'); ?></td>
        </tr>
        <tr>
          <td>郵便番号</td>
          <td><?php echo $user['postal_code']; ?></td>
        </tr>
        <tr>
          <td>住所（都道府県）</td>
          <td><?php echo $user['prefecture']; ?></td>
        </tr>
        <tr>
          <td>住所（市区町村）</td>
          <td><?php echo $user['address_1']; ?></td>
        </tr>
        <tr>
          <td>住所（番地）</td>
          <td><?php echo $user['address_2']; ?></td>
        </tr>
        <tr>
          <td>アカウント権限</td>
          <td><?php echo ($user['authority'] == 0 ? '一般' : '管理者'); ?></td>
        </tr>
        <tr>
          <td>登録日時</td>
          <td><?php echo $user['registered_time']; ?></td>
        </tr>
      </table>
    </div>
    <form action="delete_confirm.php" method="GET" id = "confirm">
      <input type="hidden" name="id" value="<?php echo $userId; ?>">
      <input type="submit" value="確認する">
    </form>
  </div>
  </main>
  <footer>
    <p>Copytifht D.I.Worksl D.I.blog is the one which provides A to Z about programming</p>
  </footer>
</body>
</html>
