<?php
// 入力タグの無効化
function stringHTML(string $string) :string {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}
// IDの入力チェック（未入力不可）
//function double_checker($id,$name,$password,$bkcode,$position,$gender,$hasfe,$hasap,$hire_date){
    //    if((empty($id) & empty($name))||(empty($id)&empty($password))||(empty($id)&empty($bkcode))||(empty($id)&empty($position))||(empty($id)&empty($gender))||(empty($id)&empty($hasfe))
    //    ||(empty($id)&empty($hasap))(empty($id)&empty($hire_date))||(empty($name)&empty($password))||(empty($name)&empty($bkcode))(empty($name)&empty($position))||(empty($name)&empty($gender))
    //    ||(empty($name)&empty($hasfe))||(empty($name)&empty($hasap))(empty($name)&empty($hire_date))||(empty($password)&empty($bkcode))||(empty($password)&empty($position))||(empty($password)&empty($gender))
    //    ||(empty($password)&empty($hasfe))||(empty($password)&empty($hasap))||(empty($password)&empty($hire_date))||(empty($bkcode)&empty($position))||(empty($bkcode)&empty($gender))
    //    ||(empty($bkcode)&empty($hasfe))||(empty($bkcode)&empty($hasap))||(empty($bkcode)&empty($hire_date))||(empty($position)&empty($gender))||(empty($position)&empty($hasfe))
    //    ||(empty($position)&empty($hasap))||(empty($position)&empty($hire_date))||(empty($gender)&empty($hasfe))||(empty($gender)&empty($hasap))||(empty($gender)&empty($hire_date))
    //    ||(empty($hasfe)&empty($hasap))||(empty($hasfe)&empty($hire_date))||(empty($hasap)&empty($hire_date))){
    //     echo "未入力箇所が2か所あります。";
    //    }

    //   }

function id_checker($id)
{
    if (empty($id)) {
        echo "idを指定してください<br>";
       // exit;
    }
    if (!preg_match('/\A\d{5}\z/u', $id)) {
        echo "idは数字5桁で入力してください。<br>";
        //exit;
    }
}

// 氏名の入力チェック（未入力不可）
function name_checker($name)
{
    if (empty($name)) {
        echo "氏名の入力は必須です。<br>";
      //  exit;
    }
    if (!preg_match('/\A[[:^cntrl:]]{1,30}\z/u', $name)) {
        echo "氏名は30文字までで入力してください。<br>";
        //exit;
    }
}
// パスワードの入力チェック（未入力不可）
function password_checker($password)
{
    if (empty($password)) {
        echo "パスワードの入力は必須です。<br>";
        //exit;
    }
    if (!preg_match('/\APASS\d{4}\z/u', $password)) {
        echo "パスワードは「PASS」+ 数字4桁で入力してください。<br>";
    //    exit;
    }
}

// 部課コードの入力チェック
function bkcode_checker($bkcode)
{
    if (!preg_match('/\A[[:^cntrl:]]{5}\z/u', $bkcode)) {
        echo "部課コードのフォーマットが違います。<br>";
      //  exit;
    }
}

// 役職の入力チェック
function position_checker($position)
{
    if (!preg_match('/\A[[:^cntrl:]]{2}\z/u', $position)) {
        echo "役職が入力されていません。<br>";
        //exit;
    }
}

// 性別の入力チェック（未入力不可）
function gender_checker($gender)
{
    if (!($gender === 1 || $gender === 2)) {
    echo "性別が選択されていません。";
   //     exit;
    }
}

//基本情報処理資格の入力チェック（未入力不可）
function hasfe_checker($hasfe)
{
    if (!($hasfe === 0 || $hasfe === 1)) {
        echo "基本情報処理資格の有無が選択されていません。";
        exit;
    }
}

// 応用情報処理資格の入力チェック（未入力不可）
function hasap_checker($hasap)
{
    if (!($hasap === 0 || $hasap === 1)) {
        echo "応用情報処理資格の有無が選択されていません。";
        exit;
    }
}

// 入社日（未入力不可）
function hire_date_checker($hire_date)
{
    if (empty($hire_date)) {
        echo "入社年月日の入力は必須です。";
        exit;
    }
    if (!preg_match('/\A\d{4}-\d{1,2}-\d{1,2}\z/u', $_POST['hire_date'])) {
        echo "日付のフォーマットが違います。";
        exit;
    }
    $date = explode('-', $_POST['hire_date']);
    if (!checkdate($date[1], $date[2], $date[0])) {
        echo "正しい日付を入力してください。";
        exit;
    }
}
