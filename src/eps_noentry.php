<h3>未提出者一覧</h3>
<?php
$confirm=2;
include("sys_confirm.php");

require_once 'db_inc.php'; //データベースに接続する

// 一覧データを検索するSQL
$sql = "SELECT * FROM tbl_student WHERE sid NOT IN (SELECT sid FROM tbl_wish)";
//データベースへ問合せのSQL文($sql)を実行する
$rs = $conn->query($sql);
$row= $rs->fetch_assoc();
//学籍番号(sid)、氏名(sname)、性別(sex)、GPA(gpa)、修得単位数(credit)の一覧表示

echo "<table border><tr><th>学籍番号</th><th>氏名</th><th>性別</th><th>GPA</th><th>修得単位数</th></tr>";
while($row){
  $sex = array(1=>'男', 2=>'女');
  echo "<tr><td>{$row['sid']}</td><td>{$row['sname']}</td><td>{$sex[$row['sex']]}</td><td>{$row['gpa']}</td><td>{$row['credit']}</td></tr>";
  $row= $rs->fetch_assoc();
}
echo "</table>"

?>