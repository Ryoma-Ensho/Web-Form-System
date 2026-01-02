<h3>希望状況一覧</h3>
<?php
$confirm=2;
include("sys_confirm.php");

require_once 'db_inc.php'; //データベースに接続する

// 希望状況データを検索するSQL文
$sql = "SELECT s.*,pid FROM tbl_student s, tbl_wish w WHERE s.sid=w.sid ORDER BY sid";
// 希望状況データを検索するSQL文（未提出者含む）
$sql = "SELECT s.*,pid FROM tbl_student s, tbl_wish w WHERE s.sid=w.sid UNION
SELECT s.*,0 as pid FROM tbl_student s, tbl_wish w WHERE s.sid NOT IN (SELECT sid FROM tbl_wish)
ORDER BY sid";
//データベースへ問合せのSQL文($sql)を実行する・・・
$rs = $conn->query($sql);
$row= $rs->fetch_assoc();
// 問合せ結果を出力する。

//学籍番号(sid)、氏名(sname)、性別(sex)、GPA(gpa)、修得単位数(credit), 本人希望(pid)、配属結果(decided)、「配属決定」ボタンの一覧表示
echo "<table border><tr><th>学籍番号</th><th>氏名</th><th>性別</th><th>GPA</th><th>修得単位数</th><th>本人希望</th><th>配属結果</th><th>操作</th></tr>";
while($row){
  $sex = array(1=>'男', 2=>'女');
  $program = array(0=>'未設定', 1=>'総合教育', 2=>'応用教育');

  echo "<tr><td>{$row['sid']}</td><td>{$row['sname']}</td><td>{$sex[$row['sex']]}</td><td>{$row['gpa']}</td>";
  echo "<td>{$row['credit']}</td><td>{$program[$row['pid']]}</td><td>{$program[$row['decided']]}</td><td><a href='?do=eps_decide&sid=" . $row['sid'] . "'>配属決定</a></td></tr>";
  $row= $rs->fetch_assoc();
}
echo "</table>";
?>