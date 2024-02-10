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
    $newGender = $_POST['gender'];
    $newPostalCode = $_POST['postalCode'];
    $newPrefecture = $_POST['prefecture'];
    $newAddress1 = $_POST['address1'];
    $newAddress2 = $_POST['address2'];
    $newAuthority = $_POST['authority'];
    var_dump($newMail);
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
    <div class="button-container">
        <form method="post" action="update.php?id=<?php echo $userId; ?>">
            <input type="hidden" name="id" value="<?php echo $userId; ?>">
            <input type="hidden" name="familyName" value="<?php echo htmlspecialchars($newFamilyName, ENT_QUOTES); ?>">
            <input type="hidden" name="lastName" value="<?php echo htmlspecialchars($newlastName, ENT_QUOTES); ?>">
            <input type="hidden" name="familyNameKana" value="<?php echo htmlspecialchars($newfamilyNameKana, ENT_QUOTES); ?>">
            <input type="hidden" name="lastNameKana" value="<?php echo htmlspecialchars($newLastNameKana, ENT_QUOTES); ?>">
            <input type="hidden" name="mail" value="<?php echo htmlspecialchars($newMail, ENT_QUOTES); ?>">
            <input type="hidden" name="password" value="<?php echo htmlspecialchars($newPassword, ENT_QUOTES); ?>">
            <input type="hidden" name="postalCode" value="<?php echo htmlspecialchars($newPostalCode, ENT_QUOTES); ?>">
            <input type="hidden" name="prefecture" value="<?php echo htmlspecialchars($newPrefecture, ENT_QUOTES); ?>">
            <input type="hidden" name="address1" value="<?php echo htmlspecialchars($newAddress1, ENT_QUOTES); ?>">
            <input type="hidden" name="address2" value="<?php echo htmlspecialchars($newAddress2, ENT_QUOTES); ?>">
            <input type="hidden" name="gender" value="<?php echo htmlspecialchars($newGender, ENT_QUOTES); ?>">
            <input type="hidden" name="authority" value="<?php echo htmlspecialchars($newAuthority, ENT_QUOTES); ?>">
            <input type="submit" value="前に戻る">
        </form>
          <!-- htmlspecialchars は、HTMLエスケープ処理 PHP関数　これを使うと、HTML タグや特殊文字をエスケープする。 -->

        <!-- 更新処理をしてアカウント更新完了画面に遷移 -->
        <form method="post" action="update_complete.php">
            <input type="hidden" name="id" value="<?php echo $userId; ?>">

            <input type="hidden" name="familyName" value="<?php echo isset($_POST['familyName']) ? htmlspecialchars($_POST['familyName'], ENT_QUOTES) : ''; ?>">
            <input type="hidden" name="lastName" value="<?php echo isset($_POST['lastName']) ? htmlspecialchars($_POST['lastName'], ENT_QUOTES) : ''; ?>">
          <input type="hidden" name="familyNameKana" value="<?php echo isset($_POST['familyNameKana']) ? htmlspecialchars($_POST['familyNameKana'], ENT_QUOTES) : ''; ?>">
          <input type="hidden" name="lastNameKana" value="<?php echo isset($_POST['lastNameKana']) ? htmlspecialchars($_POST['lastNameKana'], ENT_QUOTES) : ''; ?>">
          <input type="hidden" name="mail" value="<?php echo isset($_POST['mail']) ? htmlspecialchars($_POST['mail'], ENT_QUOTES) : ''; ?>">
          <!-- <input type="hidden" name="password" value="<?php //echo isset($_POST['password']) ? htmlspecialchars($_POST['password'], ENT_QUOTES) : ''; ?>"> -->
          <input type="hidden" name="gender" value="<?php echo isset($_POST['gender']) ? htmlspecialchars($_POST['gender'], ENT_QUOTES) : ''; ?>">
          <input type="hidden" name="postalCode" value="<?php echo isset($_POST['postalCode']) ? htmlspecialchars($_POST['postalCode'], ENT_QUOTES) : ''; ?>">
          <input type="hidden" name="prefecture" value="<?php echo isset($_POST['prefecture']) ? htmlspecialchars($_POST['prefecture'], ENT_QUOTES) : ''; ?>">
          <input type="hidden" name="address1" value="<?php echo isset($_POST['address1']) ? htmlspecialchars($_POST['address1'], ENT_QUOTES) : ''; ?>">
          <input type="hidden" name="address2" value="<?php echo isset($_POST['address2']) ? htmlspecialchars($_POST['address2'], ENT_QUOTES) : ''; ?>">
          <input type="hidden" name="authority" value="<?php echo isset($_POST['authority']) ? htmlspecialchars($_POST['authority'], ENT_QUOTES) : ''; ?>">

            <input type="submit" name="" value="更新">
        </form>

      </div>
  </main>
  <footer>
    <p>Copytifht D.I.Worksl D.I.blog is the one which provides A to Z about programming</p>
  </footer>

</body>
</html>
