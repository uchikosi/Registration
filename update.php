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

  try {
    // データベースから対象のユーザー情報を取得するSQLクエリ
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
    $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
    $stmt->execute();

    // データベースからの取得結果を連想配列として取得
    $userData = $stmt->fetch(PDO::FETCH_ASSOC);
   } catch (PDOException $e) {
       die("ユーザー情報の取得に失敗しました: " . $e->getMessage());
   }

  // var_dump($userData);
  if (isset($_SESSION['form_values'])) {
    $formValues = $_SESSION['form_values'];
    unset($_SESSION['form_values']); // セッションから削除
  } else {
    // セッションにフォームの値がない場合、デフォルト値を設定する
    $formValues = array(
        // 'familyName' => '',
        // 'lastName' => '',
        // 'familyNameKana' = '',
        // 'lastNameKana' = '',
        // 'mail' = ''
        // 'password' = '',
        // 'gender' = '',
        // 'postalCode' = '',
        // 'prefecture' = '',
        // 'address1' = '',
        // 'address2' = '',
        // 'authority' = '';
    );
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
    form{
      text-align: center;
    }
  </style>
</head>
<body>
  <header>
    <div>
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
    <div id="update">
      <h1>アカウント更新</h1>
      <!-- // フォームにデータを表示 -->
      <form method='post' action='update_confirm.php'>
        <div>
          <input type='hidden' name='id' value='<?php echo $userId; ?>'>
        </div>
        <div>
          <label for='family_name'>名前(姓)</label>
          <input type='text' name='familyName' id="familyName" maxlength="10" autofocus placeholder="漢字orひらがな" oninput="validateName(this, true)" value='<?php
            if (isset($_POST['familyName'])){
              // update_confirm.phpから遷移した場合
              echo htmlspecialchars($_POST['familyName'], ENT_QUOTES);
            } elseif (isset($_GET['id'])) {
              // list.phpから遷移した場合
              echo htmlspecialchars($userData['family_name'], ENT_QUOTES);
            } else {
              // その他の場合
              echo '';
            }?>'>
        </div>

        <div>
          <label for='last_name'>名前(名)</label>
          <input type='text' name='lastName' id="lastName" maxlength="10" autofocus placeholder="漢字orひらがな" oninput="validateName(this, true)" value='<?php
            if (isset($_POST['lastName'])){
              // update_confirm.phpから遷移した場合
              echo htmlspecialchars($_POST['lastName'], ENT_QUOTES);
            } elseif (isset($_GET['id'])) {
              // list.phpから遷移した場合
              echo htmlspecialchars($userData['last_name'], ENT_QUOTES);
            } else {
              // その他の場合
              echo '';
            }?>'>
        </div>

        <div>
          <label for='family_name_kana'>カナ(姓)</label>
          <input type='text' id="familyNameKana" name="familyNameKana" maxlength="10" oninput="validateNameKana(this, true)" placeholder="カタカナ" value='<?php
            if (isset($_POST['familyNameKana'])){
              // update_confirm.phpから遷移した場合
              echo htmlspecialchars($_POST['familyNameKana'], ENT_QUOTES);
            } elseif (isset($_GET['id'])) {
              // list.phpから遷移した場合
              echo htmlspecialchars($userData['family_name_kana'], ENT_QUOTES);
            } else {
              // その他の場合
              echo '';
            }?>'>
        <div>

        <div>
          <label for='last_name_kana'>カナ(名)</label>
          <input type='text' id="lastNameKana" name="lastNameKana" maxlength="10" oninput="validateNameKana(this, false)" placeholder="カタカナ" value='<?php
            if (isset($_POST['lastName'])){
              // update_confirm.phpから遷移した場合
              echo htmlspecialchars($_POST['lastNameKana'], ENT_QUOTES);
            } elseif (isset($_GET['id'])) {
              // list.phpから遷移した場合
              echo htmlspecialchars($userData['last_name_kana'], ENT_QUOTES);
            } else {
              // その他の場合
              echo '';
            }?>'>
        </div>

        <div>
          <label for='mail'>メールアドレス</label>
          <input type='text' id="mail" name="mail" maxlength="100" oninput="validateEmail(this)" placeholder="@,ドット,半角英数字のみ" value='<?php
            if (isset($_POST['mail'])){
              // update_confirm.phpから遷移した場合
              echo htmlspecialchars($_POST['mail'], ENT_QUOTES);
            } elseif (isset($_GET['id'])) {
              // list.phpから遷移した場合
              echo htmlspecialchars($userData['mail'], ENT_QUOTES);
            } else {
              // その他の場合
              echo '';
            }?>'>
        </div>

        <div>
          <label for='password'>パスワード:</label>
          <input type='password' id="password" name="password" oninput="validatePassword(this)" placeholder="半角英数字 3~10文字" value='<?php
            if (isset($_POST['password'])){
              // update_confirm.phpから遷移した場合
              echo htmlspecialchars($_POST['password'], ENT_QUOTES);
            } elseif (isset($_GET['id'])) {
              // list.phpから遷移した場合
              echo htmlspecialchars($userData['password'], ENT_QUOTES);
            } else {
              // その他の場合
              echo '';
            }?>'>
        </div>

        <div>
          <label>性別</label>
          <label><input type='radio' id="male" name='gender' value='0' <?php echo (isset($_POST['gender']) && $_POST['gender'] == 0 ? 'checked' : ($userData['gender'] == 0 ? 'checked' : '')); ?>> 男性</label>
          <label><input type='radio' id="female" name='gender' value='1' <?php echo (isset($_POST['gender']) && $_POST['gender'] == 1 ? 'checked' : ($userData['gender'] == 1 ? 'checked' : '')); ?>> 女性</label>
        </div>

        <div>
          <label for='postal_code'>郵便番号:</label>
          <input type='text' id="postalCode" name="postalCode" maxlength="7" pattern="^[0-9]+$" required placeholder="半角英数字" value='<?php
            if (isset($_POST['password'])){
              // update_confirm.phpから遷移した場合
              echo htmlspecialchars($_POST['postalCode'], ENT_QUOTES);
            } elseif (isset($_GET['id'])) {
              // list.phpから遷移した場合
              echo htmlspecialchars($userData['postal_code'], ENT_QUOTES);
            } else {
              // その他の場合
              echo '';
            }?>'>
        </div>

        <div>
          <label for='prefecture'>都道府県:</label>
          <select id="prefecture" name="prefecture" required>
            <?php
              $prefectures = array(
                '北海道', '青森県', '岩手県', '宮城県', '秋田県', '山形県', '福島県',
                '茨城県', '栃木県', '群馬県', '埼玉県', '千葉県', '東京都', '神奈川県',
                '新潟県', '富山県', '石川県', '福井県', '山梨県', '長野県', '岐阜県',
                '静岡県', '愛知県', '三重県', '滋賀県', '京都府', '大阪府', '兵庫県',
                '奈良県', '和歌山県', '鳥取県', '島根県', '岡山県', '広島県', '山口県',
                '徳島県', '香川県', '愛媛県', '高知県', '福岡県', '佐賀県', '長崎県',
                '熊本県', '大分県', '宮崎県', '鹿児島県', '沖縄県'
              );
              foreach ($prefectures as $prefecture) {
                echo "<option value='{$prefecture}' " . (isset($_POST['prefecture']) && $_POST['prefecture'] == $prefecture ? 'selected' : ($userData['prefecture'] == $prefecture ? 'selected' : '')) . ">{$prefecture}</option>";
              }
            ?>
          </select>
        </div>

        <div>
          <label for='address1'>住所1:</label>
          <input type='text' id="address1" name="address1" maxlength="10" required placeholder="日本語で入力" oninput="validateAddress(this)" value='<?php
            if (isset($_POST['password'])){
              // update_confirm.phpから遷移した場合
              echo htmlspecialchars($_POST['address1'], ENT_QUOTES);
            } elseif (isset($_GET['id'])) {
              // list.phpから遷移した場合
              echo htmlspecialchars($userData['address_1'], ENT_QUOTES);
            } else {
              // その他の場合
              echo '';
            }?>'>
        </div>

        <div>
          <label for='address2'>住所2:</label>
          <input type='text' id="address2" name="address2" maxlength="100" required placeholder="日本語で入力"oninput="validateAddress(this)" value='<?php
            if (isset($_POST['password'])){
              // update_confirm.phpから遷移した場合
              echo htmlspecialchars($_POST['address2'], ENT_QUOTES);
            } elseif (isset($_GET['id'])) {
              // list.phpから遷移した場合
              echo htmlspecialchars($userData['address_2'], ENT_QUOTES);
            } else {
              // その他の場合
              echo '';
            }?>'>
        </div>

        <div>
          <label for='authority'>アカウント権限</label>
          <select id="authority" name="authority" required>
              <option value='0' <?php echo (isset($_POST['authority']) && $_POST['authority'] == 0 ? 'selected' : ($userData['authority'] == 0 ? 'selected' : '')); ?>>一般</option>
              <option value='1' <?php echo (isset($_POST['authority']) && $_POST['authority'] == 1 ? 'selected' : ($userData['authority'] == 1 ? 'selected' : '')); ?>>管理者</option>
          </select>
        </div>

        <input type='submit' value='確認する'>
        <?php
          // エラーメッセージの表示
          if (isset($_SESSION['error'])) {
            echo "<div style='color: red; font-size: 18px;'>" . $_SESSION['error'] . "</div>";
            unset($_SESSION['error']); // エラーメッセージを表示した後はセッションから削除する
          }
        ?>
      </form>
    </div>
  </main>
  <footer>
    <p>Copytifht D.I.Worksl D.I.blog is the one which provides A to Z about programming</p>
  </footer>
</body>
</html>
