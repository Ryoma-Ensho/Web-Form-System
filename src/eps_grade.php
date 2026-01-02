<h3>成績確認</h3>
<?php
$confirm=1;
include("sys_confirm.php");

require_once 'db_inc.php'; //データベースに接続する

$uid = $_SESSION['uid']; //ログイン中のユーザのIDを取得
$sid = strtoupper($uid); //ユーザIDを大文字に変換し学籍番号を求める

// 一覧データを検索するSQL文
$sql = "SELECT * FROM tbl_student WHERE sid='{$sid}'";
//"SELECT * FROM tbl_user WHERE uid= '{$u}'  AND upass='{$p}'"
//データベースへ問合せのSQL文($sql)を実行する
$rs = $conn->query($sql);
// 問合せ結果を表形式で出力する。
$row= $rs->fetch_assoc();
//学籍番号(sid)、氏名(sname)、性別(sex)、GPA(gpa)、修得単位数(credit)を表示
$sex = array(1=>'男', 2=>'女');
echo '<table class="table table-bordered table-hover"><tr><th>学籍番号</th><th>氏名</th><th>性別</th><th>GPA</th><th>取得単位数</th></tr>';
echo "<tr><td>{$row['sid']}</td><td>{$row['sname']}</td><td>{$sex[$row['sex']]}</td><td>{$row['gpa']}</td><td>{$row['credit']}</td></tr>";
echo "</table>";
echo '<h3>以下のプログラムに登録できます</h3>';
if($row['gpa']>=2.0&&$row['credit']>=38){
  echo '<ul><li>総合教育プログラム</li><li>応用教育プログラム</li></ul>';
}else{
  echo '<ul><li>応用教育プログラム</li></ul>';
}
?>