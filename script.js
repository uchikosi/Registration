
function validateName(input, isLastName) {
  // 入力された値
  const inputValue = input.value.trim();  // trim()を使って前後の空白を削除

  // ひらがな、漢字の正規表現
  const textPattern = /^[\u4E00-\u9FFF\u3040-\u309Fー]*$/;
  // \u4E00-\u9FFF: 一般的な漢字
  // \u3040-\u309F: ひらがな

  // 入力が空でない場合のみ正規表現と比較
  if (inputValue !== '') {
    if (!textPattern.test(inputValue)) {
      // エラーメッセージを表示
      // console.log("ひらがな、漢字のみ入力できます。");
      input.setCustomValidity("ひらがな、漢字のみ入力できます。");
    } else {
      // エラーメッセージをクリア
      // console.log("エラーメッセージをクリア");
      input.setCustomValidity("");
    }
  } else {
    // 入力が空の場合
    if (isLastName) {
      // 名前（姓）の検証
      // console.log("名前（姓）は必須です。");
      input.setCustomValidity("名前（姓）は必須です。");
    } else {
      // 名前（名）の検証
      // console.log("名前（名）は必須です。");
      input.setCustomValidity("名前（名）は必須です。");
    }
  }
}

function validateNameKana(input, isLastNameKana) {
  // 入力された値
  const inputValue = input.value.trim();

  const textPattern = /^[\u30A1-\u30F6]*$/;

  // 入力が空でない場合のみ正規表現と比較
  if (inputValue !== '') {
    if (!textPattern.test(inputValue)) {
      // エラーメッセージを表示
      // console.log("カタカナのみ入力できます。");
      input.setCustomValidity("カタカナのみ入力できます。");
    } else {
      // エラーメッセージをクリア
      // console.log("エラーメッセージをクリア");
      input.setCustomValidity("");
    }
  } else {
    if (isLastNameKana) {
      // カナ（姓）の検証
      console.log("カナ（姓）は必須です。");
      input.setCustomValidity("カナ（姓）は必須です。");
    } else {
      // カナ（名）の検証
      console.log("カナ（名）は必須です。");
      input.setCustomValidity("カナ（名）は必須です。");
    }
  }
}

// メールアドレスのバリデーション関数
function validateEmail(input) {
  // メールアドレスの正規表現
  const emailPattern = /^[a-zA-Z0-9!%-]+@[a-zA-Z0-9-]+\.[a-zA-Z]{2,}$/;
  // ^: 文字列の先頭を示します。
  // [a - zA - Z0 - 9! % -] +: 英字（大文字または小文字）、数字、および一部の特殊文字（!、%、-）が1回以上繰り返されることを示します。これは、メールアドレスのローカル部分（@の前）を表します。
  // @: メールアドレスのローカル部分とドメイン部分を区切る「@」記号です。
  // [a - zA - Z0 - 9 -] +: 英字（大文字または小文字）、数字、およびハイフンが1回以上繰り返されることを示します。これは、メールアドレスのドメイン部分の最初の部分を表します。

  // $: 文字列の末尾を示します。

  // 入力された値
  const inputValue = input.value.trim();  // trim()を使って前後の空白を削除

  // 入力が空でない場合のみ正規表現と比較
  if (inputValue !== '') {
    if (!emailPattern.test(inputValue)) {
      // エラーメッセージを表示
      input.setCustomValidity("正しいメールアドレスの形式で入力してください。");
    } else {
      // エラーメッセージをクリア
      input.setCustomValidity("");
    }
  } else {
    // 入力が空の場合の処理を削除
    // メールの検証
    console.log("メールアドレスは必須です。");
    input.setCustomValidity("メールアドレスは必須です。");
  }
}

// validateForm 関数内
function validateForm() {
  // 各入力フィールドに対するバリデーションを手動で実行
  const familyNameInput = document.getElementById('familyName');
  const lastNameInput = document.getElementById('lastName');
  const familyNameKanaInput = document.getElementById('familyNameKana');
  const lastNameKanaInput = document.getElementById('lastNameKana');
  const mailInput = document.getElementById('mail');

  validateName(familyNameInput, true);
  validateName(lastNameInput, false);
  validateNameKana(familyNameKanaInput, true);
  validateNameKana(lastNameKanaInput, false);
  validateEmail(mailInput);

  // バリデーション結果を取得
  const isFormValid = familyNameInput.checkValidity() && lastNameInput.checkValidity() && familyNameKanaInput.checkValidity() && lastNameKanaInput.checkValidity() && mailInput.checkValidity();

  // バリデーションが成功した場合はフォームをサブミット
  return isFormValid;
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
