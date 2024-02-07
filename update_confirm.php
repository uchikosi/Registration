<?php
session_start();

// POSTリクエストの場合
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // フォームからのデータを取得
    $userId = $_POST['id'];
    $newFamilyName = $_POST['familyName'];
    $newlastName = $_POST['lastName'];
    $newfamilyNameKana = $_POST['familyNameKana'];
    $newLastNameKana = $_POST['lastNameKana'];
    $newMail = $_POST['mail'];
    $newpassword = $_POST['password'];
    $newPostalCode = $_POST['postalCode'];
    $newPrefecture = $_POST['prefecture'];
    $newAddress1 = $_POST['address1'];
    $newAddress2 = $_POST['address2'];
    $newAuthority = $_POST['authority'];
    // var_dump($newMail);
}
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

  <h1>アカウント更新確認画面</h1>

  <table>
      <tr>
          <td>名前（姓）</td>
          <td><?php echo  $newFamilyName; ?></td>
      </tr>
      <tr>
          <td>名前（名）</td>
          <td><?php echo $newlastName; ?></td>
      </tr>
      <tr>
          <td>カナ（姓）</td>
          <td><?php echo $newfamilyNameKana ; ?></td>
      </tr>
      <tr>
          <td>カナ（名）</td>
          <td><?php echo $newLastNameKana; ?></td>
      </tr>
      <tr>
          <td>メールアドレス</td>
          <td><?php echo $newMail; ?></td>
      </tr>
      <tr>
          <td>パスワード</td>
          <td></td>
      </tr>
      <tr>
          <td>性別</td>
          <td><?php echo ($newGender['gender'] == 0 ? '男性' : '女性'); ?></td>
      </tr>
      <tr>
          <td>郵便番号</td>
          <td><?php echo $newPostalCode; ?></td>
      </tr>
      <tr>
          <td>住所（都道府県）</td>
          <td><?php echo $newPrefecture; ?></td>
      </tr>
      <tr>
          <td>住所（市区町村）</td>
          <td><?php echo $newAddress1 ; ?></td>
      </tr>
      <tr>
          <td>住所（番地）</td>
          <td><?php echo $newAddress2 ; ?></td>
      </tr>
      <tr>
          <td>アカウント権限</td>
          <td><?php echo ($newAuthority['authority'] == 0 ? '一般' : '管理者'); ?></td>
      </tr>
  </table>
      </div>
  </main>
  <footer>
    <p>Copytifht D.I.Worksl D.I.blog is the one which provides A to Z about programming</p>
  </footer>

</body>
</html>
