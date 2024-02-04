<!-- regist_confirm.php -->
<?php
session_start();

// POST データから値を取得
$familyName = $_POST['familyName'];
$lastName = $_POST['lastName'];
$familyNameKana = $_POST['familyNameKana'];
$lastNameKana = $_POST['lastNameKana'];
$mail = $_POST['mail'];
$password = $_POST['password'];
$gender = ($_POST['gender'] == '0') ? '男' : '女';
// 三項演算子と呼ばれるものです。通常のif文と同じような条件分岐を簡潔に書くために使われます。
// if ($_POST['gender'] == '0') {$gender = '男';} else {$gender = '女';}
// つまり、$_POST['gender'] の値が '0' であれば '男' を、そうでなければ '女' を $gender に代入しています。
$postalCode = $_POST['postalCode'];
$prefecture = $_POST['prefecture'];
$address1 = $_POST['address1'];
$address2 = $_POST['address2'];
$authority = ($_POST['authority'] == '0') ? '一般' : '管理者';
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="css/shareStyle.css">
  <title>アカウント登録確認画面</title>
  <style>

    main{
      margin: 10px;
    }
    table {
    width: 200px;               /* 幅指定 */
    height: 90px;               /* 高さ指定 */
    margin:  0 auto;            /* 中央寄せ */
    }
    .button-container{
    padding: 10px;              /* 余白指定 */
    height: 50px;              /* 高さ指定 */
    text-align:  center;        /* 中央寄せ */
    display: flex;
    justify-content:center
    }
    #registBack {
      padding: 20px;
      margin: 10px;
    }

    #registerDatabase {
      padding: 20px;
      margin: 10px;
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
    <div id="left">
      <div class="leftmain">
         <h1>アカウント登録確認画面</h1>
      <table>
          <tr>
              <td>名前（姓）</td>
              <td><?php echo $familyName; ?></td>
          </tr>
          <tr>
              <td>名前（名）</td>
              <td><?php echo $lastName; ?></td>
          </tr>
          <tr>
              <td>カナ（姓）</td>
              <td><?php echo $familyNameKana; ?></td>
          </tr>
          <tr>
              <td>カナ（名）</td>
              <td><?php echo $lastNameKana; ?></td>
          </tr>
          <tr>
              <td>メールアドレス</td>
              <td><?php echo $mail; ?></td>
          </tr>
          <tr>
              <td>パスワード</td>
              <td><?php echo str_repeat("●", strlen($password)); ?></td>
          </tr>
          <tr>
              <td>性別</td>
              <td><?php echo $gender; ?></td>
          </tr>
          <tr>
              <td>郵便番号</td>
              <td><?php echo $postalCode; ?></td>
          </tr>
          <tr>
              <td>住所（都道府県）</td>
              <td><?php echo $prefecture; ?></td>
          </tr>
          <tr>
              <td>住所（市区町村）</td>
              <td><?php echo $address1; ?></td>
          </tr>
          <tr>
              <td>住所（番地）</td>
              <td><?php echo $address2; ?></td>
          </tr>
          <tr>
              <td>アカウント権限</td>
              <td><?php echo $authority; ?></td>
          </tr>
      </table>

      <div class="button-container">

        <form method="post" action="regist.php" id="registBack">
          <!-- hiddenフィールドの値をフォームに戻す -->
          <input type="hidden" name="familyName" value="<?php echo isset($_POST['familyName']) ? htmlspecialchars($_POST['familyName'], ENT_QUOTES) : ''; ?>">
          <input type="hidden" name="lastName" value="<?php echo isset($_POST['lastName']) ? htmlspecialchars($_POST['lastName'], ENT_QUOTES) : ''; ?>">
          <input type="hidden" name="familyNameKana" value="<?php echo isset($_POST['familyNameKana']) ? htmlspecialchars($_POST['familyNameKana'], ENT_QUOTES) : ''; ?>">
          <input type="hidden" name="lastNameKana" value="<?php echo isset($_POST['lastNameKana']) ? htmlspecialchars($_POST['lastNameKana'], ENT_QUOTES) : ''; ?>">
          <input type="hidden" name="mail" value="<?php echo isset($_POST['mail']) ? htmlspecialchars($_POST['mail'], ENT_QUOTES) : ''; ?>">
          <input type="hidden" name="gender" value="<?php echo isset($_POST['gender']) ? htmlspecialchars($_POST['gender'], ENT_QUOTES) : ''; ?>">
          <input type="hidden" name="postalCode" value="<?php echo isset($_POST['postalCode']) ? htmlspecialchars($_POST['postalCode'], ENT_QUOTES) : ''; ?>">
          <input type="hidden" name="prefecture" value="<?php echo isset($_POST['prefecture']) ? htmlspecialchars($_POST['prefecture'], ENT_QUOTES) : ''; ?>">
          <input type="hidden" name="address1" value="<?php echo isset($_POST['address1']) ? htmlspecialchars($_POST['address1'], ENT_QUOTES) : ''; ?>">
          <input type="hidden" name="address2" value="<?php echo isset($_POST['address2']) ? htmlspecialchars($_POST['address2'], ENT_QUOTES) : ''; ?>">
          <input type="hidden" name="authority" value="<?php echo isset($_POST['authority']) ? htmlspecialchars($_POST['authority'], ENT_QUOTES) : ''; ?>">
          <button type="submit">前に戻る</button>

          <!-- htmlspecialchars は、HTMLエスケープ処理 PHP関数　これを使うと、HTML タグや特殊文字をエスケープする。 -->
          <!-- isset は、変数がセットされているかどうかを確認するためのPHPの関数です。変数がセットされている場合に true を、セットされていない場合には false を返します。 -->
          <!-- 主なパラメータ： -->
          <!-- $string: エスケープしたい文字列。
          $flags: エンティティ変換のモードを指定するフラグ。デフォルトは ENT_COMPAT | ENT_HTML401 です。
          $encoding: 変換に使用する文字エンコーディング。デフォルトは ini_get("default_charset") です。
          $double_encode: 二重エンコードを防ぐためのフラグ。デフォルトは true です。 -->
        </form>

        <!-- 登録処理をしてアカウント登録完了画面に遷移 -->
        <form method="post" action="regist_complete.php" id="registerDatabase">
          <!-- 各確認要素 -->
          <button type="submit">登録する</button>
          <input type="hidden" name="familyName" value="<?php echo isset($_POST['familyName']) ? htmlspecialchars($_POST['familyName'], ENT_QUOTES) : ''; ?>">
          <input type="hidden" name="lastName" value="<?php echo isset($_POST['lastName']) ? htmlspecialchars($_POST['lastName'], ENT_QUOTES) : ''; ?>">
          <input type="hidden" name="familyNameKana" value="<?php echo isset($_POST['familyNameKana']) ? htmlspecialchars($_POST['familyNameKana'], ENT_QUOTES) : ''; ?>">
          <input type="hidden" name="lastNameKana" value="<?php echo isset($_POST['lastNameKana']) ? htmlspecialchars($_POST['lastNameKana'], ENT_QUOTES) : ''; ?>">
          <input type="hidden" name="mail" value="<?php echo isset($_POST['mail']) ? htmlspecialchars($_POST['mail'], ENT_QUOTES) : ''; ?>">
          <input type="hidden" name="password" value="<?php echo isset($_POST['password']) ? htmlspecialchars($_POST['password'], ENT_QUOTES) : ''; ?>">
          <input type="hidden" name="gender" value="<?php echo isset($_POST['gender']) ? htmlspecialchars($_POST['gender'], ENT_QUOTES) : ''; ?>">
          <input type="hidden" name="postalCode" value="<?php echo isset($_POST['postalCode']) ? htmlspecialchars($_POST['postalCode'], ENT_QUOTES) : ''; ?>">
          <input type="hidden" name="prefecture" value="<?php echo isset($_POST['prefecture']) ? htmlspecialchars($_POST['prefecture'], ENT_QUOTES) : ''; ?>">
          <input type="hidden" name="address1" value="<?php echo isset($_POST['address1']) ? htmlspecialchars($_POST['address1'], ENT_QUOTES) : ''; ?>">
          <input type="hidden" name="address2" value="<?php echo isset($_POST['address2']) ? htmlspecialchars($_POST['address2'], ENT_QUOTES) : ''; ?>">
          <input type="hidden" name="authority" value="<?php echo isset($_POST['authority']) ? htmlspecialchars($_POST['authority'], ENT_QUOTES) : ''; ?>">
        </form>

      </div>
    </div>
  </main>
  <footer>
    <p>Copytifht D.I.Worksl D.I.blog is the one which provides A to Z about programming</p>
  </footer>

</body>
</html>
