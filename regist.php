<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="style.css">
  <title>アカウント登録フォーム</title>
  <script type="text/javascript" src="script.js"></script>
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
        <li>問い合わせ</li>
        <li>その他</li>
      </ul>
    </div>
  </header>
  <main>
      <div id="left">
        <h1 iD="books"></h1>
        <h1>アカウント登録フォーム</h1>
        <form method="post" action="regist_confirm.php" onsubmit="return validateForm()">
          <label for="familyName">名前（姓）:</label>
          <input type="text" id="familyName" name="familyName" maxlength="10" autofocus oninput="validateName(this, true)" placeholder="漢字orひらがな"
            <?php if (isset($_POST['familyName'])) echo 'value="' . htmlspecialchars($_POST['familyName'], ENT_QUOTES) . '"'; ?>>
          <br>
          <!-- validateName(this, true)"　validateNameの引数をLastNameになっているためelseの時に発火する -->

          <label for="lastName">名前（名）:</label>
          <input type="text" id="lastName" name="lastName" maxlength="10" autofocus oninput="validateName(this, false)"  placeholder="漢字orひらがな"
            <?php if (isset($_POST['lastName'])) echo 'value="' . htmlspecialchars($_POST['lastName'], ENT_QUOTES) . '"'; ?>>
          <br>


          <label for="familyNameKana">カナ（姓）:</label>
          <input type="text" id="familyNameKana" name="familyNameKana" maxlength="10" oninput="validateNameKana(this, true)" placeholder="カタカナ" <?php if (isset($_POST['familyNameKana'])) echo 'value="' . htmlspecialchars($_POST['familyNameKana'], ENT_QUOTES) . '"'; ?>>
          <br>

          <label for="lastNameKana">カナ（名）:</label>
          <input type="text" id="lastNameKana" name="lastNameKana" maxlength="10" oninput="validateNameKana(this, false)" placeholder="カタカナ" <?php if (isset($_POST['lastNameKana'])) echo 'value="' . htmlspecialchars($_POST['lastNameKana'], ENT_QUOTES) . '"'; ?>>
          <br>

          <label for="mail">メールアドレス:</label>
          <input type="text" id="mail" name="mail" maxlength="100" oninput="validateEmail(this)" <?php if (isset($_POST['mail'])) echo 'value="' . htmlspecialchars($_POST['mail'], ENT_QUOTES) . '"'; ?>>
          <br>

          <label for="password">パスワード:</label>
          <input type="password" id="password" name="password" minlength="3" maxlength="10"  required  placeholder="半角英数字 3~10文字">

          <br>

          <label>性別:</label>
          <input type="radio" id="male" name="gender" value="0" <?php if (!isset($_POST['gender']) || (isset($_POST['gender']) && $_POST['gender'] == '0')) echo 'checked'; ?>>
          <label for="male">男</label>
          <input type="radio" id="female" name="gender" value="1" <?php if (isset($_POST['gender']) && $_POST['gender'] == '1') echo 'checked'; ?>>
          <label for="female">女</label>
          <br>

          <label for="postalCode">郵便番号:</label>
          <input type="text" id="postalCode" name="postalCode" maxlength="7" pattern="^[0-9]+$" required placeholder="半角英数字" <?php if (isset($_POST['postalCode'])) echo 'value="' . htmlspecialchars($_POST['postalCode'], ENT_QUOTES) . '"'; ?>>
          <br>

          <label for="prefecture">住所（都道府県）:</label>
            <select id="prefecture" name="prefecture" required>
                <option value="" selected disabled>選択してください</option>
                <!-- 47都道府県のオプションを追加 forで回す予定-->
                <option value="北海道" <?php if (isset($_POST['prefecture']) && $_POST['prefecture'] == '北海道') echo 'selected'; ?>>北海道</option>
                <option value="青森県" <?php if (isset($_POST['prefecture']) && $_POST['prefecture'] == '青森県') echo 'selected'; ?>>青森県</option>
            </select>
          <br>

          <!-- 住所（市区町村） -->
          <label for="address1">住所（市区町村）:</label>
          <input type="text" id="address1" name="address1" maxlength="10" required placeholder="日本語で入力" oninput="validateAddress(this)" <?php if (isset($_POST['address1'])) echo 'value="' . htmlspecialchars($_POST['address1'], ENT_QUOTES) . '"'; ?>>
          <br>

          <!-- 住所（番地） -->
          <label for="address2">住所（番地）:</label>
          <input type="text" id="address2" name="address2" maxlength="100" required placeholder="日本語で入力"oninput="validateAddress(this)" <?php if (isset($_POST['address2'])) echo 'value="' . htmlspecialchars($_POST['address2'], ENT_QUOTES) . '"'; ?>>
          <br>

          <label for="authority">アカウント権限:</label>
          <select id="authority" name="authority" required>
              <option value="0" <?php if (isset($_POST['authority']) && $_POST['authority'] == '0') echo 'selected'; ?>>一般</option>
              <option value="1" <?php if (isset($_POST['authority']) && $_POST['authority'] == '1') echo 'selected'; ?>>管理者</option>
          </select>
          <br>

          <!-- oninput 入力フィールドに変更を加えるたびにjsに設定したバリデーションが行われる -->
          <!-- pattern属性 それぞれの項目の入力可能な文字を制限する　正規表現 -->

          <button type="submit">確認する</button>
        </form>
      </div>
  </main>
  <footer>
    <p>Copytifht D.I.Worksl D.I.blog is the one which provides A to Z about programming</p>
  </footer>

</body>
</html>
