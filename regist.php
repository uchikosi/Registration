<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="css/shareStyle.css">
  <title>アカウント登録フォーム</title>
  <script type="text/javascript" src="script.js"></script>
   <style>
    form{
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
      <div id="regist">
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
          <input type="text" id="mail" name="mail" maxlength="100" oninput="validateEmail(this)" placeholder="@,ドット,半角英数字のみ" <?php if (isset($_POST['mail'])) echo 'value="' . htmlspecialchars($_POST['mail'], ENT_QUOTES) . '"'; ?>>
          <br>

          <label for="password">パスワード:</label>
          <input type="password" id="password" name="password" minlength="3" maxlength="10" oninput="validatePassword(this)" placeholder="半角英数字 3~10文字">
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
          <?php
          // 47都道府県の配列
          $prefectures = [
              '北海道', '青森県', '岩手県', '宮城県', '秋田県',
              '山形県', '福島県', '茨城県', '栃木県', '群馬県',
              '埼玉県', '千葉県', '東京都', '神奈川県', '新潟県',
              '富山県', '石川県', '福井県', '山梨県', '長野県',
              '岐阜県', '静岡県', '愛知県', '三重県', '滋賀県',
              '京都府', '大阪府', '兵庫県', '奈良県', '和歌山県',
              '鳥取県', '島根県', '岡山県', '広島県', '山口県',
              '徳島県', '香川県', '愛媛県', '高知県', '福岡県',
              '佐賀県', '長崎県', '熊本県', '大分県', '宮崎県', '鹿児島県', '沖縄県'
          ];

          foreach ($prefectures as $prefecture) {
            // $prefectures を $prefectureに置き換え
              echo "<option value=\"$prefecture\"";
              if (isset($_POST['prefecture']) && $_POST['prefecture'] == $prefecture) {
                // isset($_POST['prefecture']) は、$_POST スーパーグローバル変数内に 'prefecture' という名前のキーが存在するかどうかを確認するための条件式
                // isset($_POST['prefecture']) は、'prefecture' という名前のキーが $_POST 内に存在し、かつその値が NULL でないかを確認しています。
                // フォームから 'prefecture' に関するデータが送信され、かつその値が $prefecture の値と一致する場合には、selected 属性が追加されます。
                // selected 属性は、<option> 要素に対して使用される属性、使用することで、フォームの選択肢の中からあらかじめ選択された状態で表示することができます。
                // selected 属性を追加することでフォームが再表示されたときの選択状態を決定するためのものです。
                  echo ' selected';
              }
              echo ">$prefecture</option>";
              // オプションの表示名として、都道府県の名前が表示
          }
          ?>
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
          <!-- required属性　入力必須 -->
          <!-- placeholder属性　フォームに説明を記入できる -->

          <button type="submit">確認する</button>
        </form>
      </div>
  </main>
  <footer>
    <p>Copytifht D.I.Worksl D.I.blog is the one which provides A to Z about programming</p>
  </footer>

</body>
</html>
