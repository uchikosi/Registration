<?php
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

   var_dump($userData);
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
        <input type='hidden' name='id' value='<?php echo $userId; ?>'>
        <label for='family_name'>名前(姓)</label>
        <input type='text' name='family_name' value='<?php echo htmlspecialchars($userData['family_name'], ENT_QUOTES); ?>'>

        <label for='last_name'>名前(名)</label>
        <input type='text' name='last_name' value='<?php echo htmlspecialchars($userData['last_name'], ENT_QUOTES); ?>'>

        <label for='family_name_kana'>カナ(姓)</label>
        <input type='text' name='family_name_kana' value='<?php echo htmlspecialchars($userData['family_name_kana'], ENT_QUOTES); ?>'>

        <label for='last_name_kana'>カナ(名)</label>
        <input type='text' name='last_name_kana' value='<?php echo htmlspecialchars($userData['last_name_kana'], ENT_QUOTES); ?>'>

        <label for='mail'>メールアドレス</label>
        <input type='text' name='mail' value='<?php echo htmlspecialchars($userData['mail'], ENT_QUOTES); ?>'>

        <label for='password'>パスワード:</label>
        <input type='password' name='password' value='⚫'>

        <label>性別</label>
        <label><input type='radio' name='gender' value='0' <?php echo ($userData['gender'] == 0 ? 'checked' : ''); ?>> 男性</label>
        <label><input type='radio' name='gender' value='1' <?php echo ($userData['gender'] == 1 ? 'checked' : ''); ?>> 女性</label>

        <label for='postal_code'>郵便番号:</label>
        <input type='text' name='postal_code' value='<?php echo htmlspecialchars($userData['postal_code'], ENT_QUOTES); ?>'>

        <label for='prefecture'>都道府県:</label>
        <select name='prefecture'>
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
              echo "<option value='{$prefecture}' " . ($userData['prefecture'] == $prefecture ? 'selected' : '') . ">{$prefecture}</option>";
            }
          ?>
        </select>

        <label for='address1'>住所1:</label>
        <input type='text' name='address_1' value='<?php echo htmlspecialchars($userData['address_1'], ENT_QUOTES); ?>'>

        <label for='address2'>住所2:</label>
        <input type='text' name='address_2' value='<?php echo htmlspecialchars($userData['address_2'], ENT_QUOTES); ?>'>

        <label for='authority'>アカウント権限</label>
        <select name='authority'>
            <option value='0' <?php echo ($userData['authority'] == 0 ? 'selected' : ''); ?>>一般</option>
            <option value='1' <?php echo ($userData['authority'] == 1 ? 'selected' : ''); ?>>管理者</option>
        </select>

        <input type='submit' value='確認する'>
      </form>

      <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
          // POSTリクエストの場合、フォームデータを処理
          $userId = $_POST['id'];
          $newFamilyName = $_POST['family_name'];
          $newLastName = $_POST['last_name'];
          $newFamilyNameKana = $_POST['family_name_kana'];
          $newLastNameKana = $_POST['last_name_kana'];
          $newMail = $_POST['mail'];
          $newPassword =$_POST['password'];
          $newGender = $_POST['gender'];
          $newPostalCode = $_POST['postal_code'];
          $newPrefecture = $_POST['prefecture'];
          $newAddress1 = $_POST['address_1'];
          $newAddress2 = $_POST['address_2'];

          // update_confirm.phpに値を渡すために、セッションにデータを保存する
          $_SESSION['update_confirm_data'] = array(
            'id' => $userId,
            'family_name' => $newFamilyName,
            'last_name' => $newLastName,
            'family_name_kana' => $newFamilyNameKana,
            'last_name_kana' => $newLastNameKana,
            'mail' => $newMail,
            'password' => $newPassword,
            'gender' => $newGender,
            'postal_code' => $newPostalCode,
            'prefecture' => $newPrefecture,
            'address_1' => $newAddress1,
            'address_2' => $newAddress2
          );

          // update_confirm.phpにリダイレクトする
          header("Location: update_confirm.php");
          exit();
        }
      ?>
    </div>
  </main>
  <footer>
    <p>Copytifht D.I.Worksl D.I.blog is the one which provides A to Z about programming</p>
  </footer>

</body>
</html>
