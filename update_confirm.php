 <?php
  session_start();

var_dump($_SESSION['update_confirm_data']);
  if (!isset($_SESSION['update_confirm_data'])) {
      die("セッションが見つかりません。");
  }

  $data = $_SESSION['update_confirm_data'];
  ?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="css/shareStyle.css">
  <title>アカウント更新</title>
  <script type="text/javascript" src="js/Update/script.js"></script>
   <style>
    </style>
</head>
<body>
  <header>
    <div>
      <a href="http://localhost:8888/Registration/index.php">
        <img src="img/diblog_logo.jpg" id="logo">
      </a>
    </div>
    <div id="">
      <?php
      session_start();
      $data = $_SESSION['update_confirm_data'];
      ?>

  <h1>アカウント更新確認画面</h1>

  <table>
      <tr>
          <td>名前（姓）</td>
          <td><?php echo $data['family_name']; ?></td>
      </tr>
      <tr>
          <td>名前（名）</td>
          <td><?php echo $data['last_name']; ?></td>
      </tr>
      <tr>
          <td>カナ（姓）</td>
          <td><?php echo $data['family_name_kana']; ?></td>
      </tr>
      <tr>
          <td>カナ（名）</td>
          <td><?php echo $data['last_name_kana']; ?></td>
      </tr>
      <tr>
          <td>メールアドレス</td>
          <td><?php echo $data['mail']; ?></td>
      </tr>
      <tr>
          <td>パスワード</td>
          <td><?php echo $data['password']; ?></td>
      </tr>
      <tr>
          <td>性別</td>
          <td><?php echo ($data['gender'] == 0 ? '男性' : '女性'); ?></td>
      </tr>
      <tr>
          <td>郵便番号</td>
          <td><?php echo $data['postal_code']; ?></td>
      </tr>
      <tr>
          <td>住所（都道府県）</td>
          <td><?php echo $data['prefecture']; ?></td>
      </tr>
      <tr>
          <td>住所（市区町村）</td>
          <td><?php echo $data['address_1']; ?></td>
      </tr>
      <tr>
          <td>住所（番地）</td>
          <td><?php echo $data['address_2']; ?></td>
      </tr>
      <tr>
          <td>アカウント権限</td>
          <td><?php echo ($data['authority'] == 0 ? '一般' : '管理者'); ?></td>
      </tr>
  </table>
      </div>
  </main>
  <footer>
    <p>Copytifht D.I.Worksl D.I.blog is the one which provides A to Z about programming</p>
  </footer>

</body>
</html>
