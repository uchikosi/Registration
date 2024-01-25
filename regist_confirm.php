<?php

// 変数の中身を確認
// var_dump($_POST);
// $familyName = isset($_POST['familyName']) ? $_POST['familyName'] : '';
// var_dump($familyName);

// アカウント登録画面からのデータを取得
$familyName = $_POST["familyName"];
$lastName = $_POST["lastName"];
$familyNameKana = $_POST["familyNameKana"];
$lastNameKana = $_POST["lastNameKana"];
$mail = $_POST["mail"];
$password = $_POST["password"];
$gender = ($_POST["gender"] == 0) ? "男" : "女";
$postalCode = $_POST["postalCode"];
$prefecture = $_POST["prefecture"];
$address1 = $_POST["address1"];
$address2 = $_POST["address2"];
$authority = ($_POST["authority"] == 0) ? "一般" : "管理者";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $familyName = $_POST['familyName'];
    // ひらがなと漢字のみを許可する正規表現
    $pattern = '/^[\p{Hiragana}\x{4E00}-\x{9FAF}ー－]+$/u';


    if (!preg_match($pattern, $familyName)) {
        // エラー処理（アルファベットが含まれている場合）
        echo "名前（姓）にはひらがなと漢字のみを入力してください。";
    } else {
        // 正常な処理
        // 他の処理を続ける
    }
}

?>



<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="style.css">
  <title>アカウント登録確認画面</title>
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
        <!-- 登録処理をしてアカウント登録完了画面に遷移 -->
        <form method="post" action="regist_complete.php">
          <!-- 各確認要素 -->
          <button type="submit">登録する</button>
        </form>

        <form method="post" action="regist.php">
          <!-- hiddenフィールドの値をフォームに戻す -->
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
          <button type="submit">前に戻る</button>
        </form>
      </div>
    </div>


    </div>


    <div id="right">
      <div class="rightmain">
        <h2 class="topiX">人気記事</h2>
        <ul>
          <li>PHPオススメ本</li>
          <li>PHP MyAdminの使い方</li>
          <li>いま人気のエディタTops</li>
          <li>HTMLの基礎</li>
        </ul>
      </div>
      <div class="rightmain">
        <h2 class="topiX">オススメリンク</h2>
        <ul>
          <li>ﾃﾞｨｰｱｲﾜｰｸｽ株式会社</li>
          <li>XAMPPダウンロード</li>
          <li>Eclipseダウンロード</li>
          <li>Braketsのダウンロード</li>
        </ul>
      </div>
      <div class="rightmain">
        <h2 class="topiX">カテゴリ</h2>
        <ul>
          <li>HTML</li>
          <li>PHP</li>
          <li>MySQL</li>
          <li>JavaScript</li>
        </ul>
      </div>
    </div>
  </main>
  <footer>
    <p>Copytifht D.I.Worksl D.I.blog is the one which provides A to Z about programming</p>
  </footer>

</body>
</html>
