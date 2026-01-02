<h3>配属結果確認</h3>
<?php
$confirm=1;
include("sys_confirm.php");

require_once 'db_inc.php'; //データベースに接続する

$uid = $_SESSION['uid']; //ログイン中のユーザのIDを取得
$sid = strtoupper($uid); //学生であれば、学籍番号（ユーザIDの大文字変換）を求める

// 希望プログラムを検索するSQL文
$sql = "SELECT * FROM tbl_wish WHERE sid='{$sid}'";
//データベースへ問合せのSQL文($sql)を実行する
$rs = $conn->query($sql);
$row= $rs->fetch_assoc();
//問合せ結果があれば希望(pid)を求め、変数$pidに代入。空（未提出）の場合は、0を$pidに代入。
if($row){
  $pid = $row['pid']; 
}else{
  $pid = 0;
}
// 学生のデータを検索するSQL文
$sql = "SELECT * FROM tbl_student WHERE sid='{$sid}'";
//データベースへ問合せのSQL文($sql)を実行する
$rs = $conn->query($sql);
// 問合せ結果を表形式で出力する。
$row= $rs->fetch_assoc();
// 学籍番号(sid)、氏名(sname)、性別(sex)、GPA(gpa)、修得単位数(credit)、本人希望($pid)、配属結果(decided)を表示
$sex = array(1=>'男', 2=>'女');
$program = array(0=>'未設定', 1=>'総合教育', 2=>'応用教育');
echo "<table class='table table-bordered table-hover'><tr><th>学籍番号</th><th>氏名</th><th>性別</th><th>GPA</th><th>修得単位数</th><th>本人希望</th><th>配属結果</th></tr>";
echo "<tr><td>{$row['sid']}</td><td>{$row['sname']}</td><td>{$sex[$row['sex']]}</td><td>{$row['gpa']}</td><td>{$row['credit']}</td><td>{$program[$pid]}</td><td>{$program[$row['decided']]}</td></tr>";
echo "</table>";

?>