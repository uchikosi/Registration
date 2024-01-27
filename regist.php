<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="style.css">
  <title>アカウント登録フォーム</title>


<script>
    function validateName(input, isLastName) {
    // 入力された値
    const inputValue = input.value.trim();  // trim()を使って前後の空白を削除

    // ひらがな、漢字の正規表現
    const japaneseTextPattern = /^[\u4E00-\u9FFF\u3040-\u309Fー]*$/;
    // \u4E00-\u9FFF: 一般的な漢字
    // \u3040-\u309F: ひらがな

    // 入力が空でない場合のみ正規表現と比較
    if (inputValue !== '') {
        if (!japaneseTextPattern.test(inputValue)) {
            // エラーメッセージを表示
            console.log("ひらがな、漢字のみ入力できます。");
            input.setCustomValidity("ひらがな、漢字のみ入力できます。");
        } else {
            // エラーメッセージをクリア
            console.log("エラーメッセージをクリア");
            input.setCustomValidity("");
        }
    } else {
        // 入力が空の場合
        if (isLastName) {
            // 名前（姓）の検証
            console.log("名前（姓）は必須です。");
            input.setCustomValidity("名前（姓）は必須です。");
        } else if (isfamilyName) {
            // 名前（名）の検証
            console.log("名は必須です。");
            input.setCustomValidity("名は必須です。");
        }
    }
}




    // <!-- メールアドレスのバリデーション関数 -->
    function validateEmail(input) {
      // メールアドレスの正規表現
      const emailPattern = /^[a-zA-Z0-9!%-]+@[a-zA-Z0-9-]+\.[a-zA-Z]{2,}$/;

      // 入力された値
      const emailValue = input.value;

      // 正規表現と比較
      if (!emailPattern.test(emailValue)) {
        // エラーメッセージを表示
        input.setCustomValidity("正しいメールアドレスの形式で入力してください。");
      } else {
        // エラーメッセージをクリア
        input.setCustomValidity("");
      }
    }

    // <!-- 住所（市町村、番地）のバリデーション関数 -->
    function validateAddress(input) {
      // 入力された値
      const addressValue = input.value;

      // ひらがな、カタカナ、漢字、数字、ハイフン、スペースの正規表現
      const addressPattern = /^[ぁ-んァ-ン一-龠0-9０-９ー－\s]+$/;
      // ^: 文字列の先頭を表します。
      //ぁ-ん: ひらがな
      // ァ-ン: カタカナ
      // 一-龠: 漢字（一般的な漢字）
      // 0-9: 数字
      // ０-９: 全角数字
      // ー－: ハイフン
      // $: 文字列の末尾を表します。

      // 正規表現と比較
      if (!addressPattern.test(addressValue)) {
          // エラーメッセージを表示
          input.setCustomValidity("ひらがな、カタカナ、漢字、数字、ハイフン、スペースのみ入力できます。");
      } else {
          // エラーメッセージをクリア
          input.setCustomValidity("");
      }
  }
</script>

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
        <form method="post" action="regist_confirm.php">
          <label for="familyName">名前（姓）:</label>
          <input type="text" id="familyName" name="familyName" maxlength="10" autofocus oninput="validateName(this, true)" placeholder="漢字orひらがな"
            <?php if (isset($_POST['familyName'])) echo 'value="' . htmlspecialchars($_POST['familyName'], ENT_QUOTES) . '"'; ?>>
          <br>

          <label for="lastName">名前（名）:</label>
          <input type="text" id="lastName" name="lastName" maxlength="10" oninput="validateName(this, false)"  autofocus placeholder="漢字orひらがな"
            <?php if (isset($_POST['lastName'])) echo 'value="' . htmlspecialchars($_POST['lastName'], ENT_QUOTES) . '"'; ?>>
          <br>


          <label for="familyNameKana">カナ（姓）:</label>
          <input type="text" id="familyNameKana" name="familyNameKana" maxlength="10" pattern="[\u30A1-\u30F6]*" required placeholder="カタカナ" <?php if (isset($_POST['familyNameKana'])) echo 'value="' . htmlspecialchars($_POST['familyNameKana'], ENT_QUOTES) . '"'; ?>>
          <br>

          <label for="lastNameKana">カナ（名）:</label>
          <input type="text" id="lastNameKana" name="lastNameKana" maxlength="10" pattern="[\u30A1-\u30F6]*" required placeholder="カタカナ" <?php if (isset($_POST['lastNameKana'])) echo 'value="' . htmlspecialchars($_POST['lastNameKana'], ENT_QUOTES) . '"'; ?>>
          <br>

          <label for="mail">メールアドレス:</label>
          <input type="text" id="mail" name="mail" maxlength="100" required oninput="validateEmail(this)" <?php if (isset($_POST['mail'])) echo 'value="' . htmlspecialchars($_POST['mail'], ENT_QUOTES) . '"'; ?>>
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
          <!-- pattern=""はそれぞれの項目の入力可能な文字を制限する　正規表現 -->

          <button type="submit">確認する</button>
        </form>
      </div>
  </main>
  <footer>
    <p>Copytifht D.I.Worksl D.I.blog is the one which provides A to Z about programming</p>
  </footer>

</body>
</html>
