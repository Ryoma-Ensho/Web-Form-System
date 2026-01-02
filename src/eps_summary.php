<h3>希望状況集計</h3>
<?php
$confirm=2;
include("sys_confirm.php");

require_once 'db_inc.php'; //データベースに接続する

// 一覧データを検索するSQL文
$sql = 
"SELECT pid, COUNT(*) as people FROM tbl_wish GROUP BY pid UNION
SELECT pid, 0 as people FROM tbl_program WHERE pid NOT IN (SELECT pid FROM tbl_wish)
ORDER BY pid";
//決定者数を検索するSQL文
$sql2 = "SELECT decided, count(*) as people FROM tbl_student WHERE decided != 0 GROUP BY decided ORDER BY decided"; 

//データベースへ問合せのSQL文($sql)を実行する
$rs = $conn->query($sql);
$row= $rs->fetch_assoc();
$rs2 = $conn->query($sql2);
$row2 = $rs2->fetch_assoc();
//プログラムID(pid)、プログラム名(pidから求める)、希望人数(people)の一覧表示
$program = array(0=>'未設定', 1=>'総合教育プログラム', 2=>'応用教育プログラム');
echo "<table border><tr><th>プログラムID</th><th>プログラム名</th><th>希望人数</th><th>決定者数</th></tr>";

while($row){
  echo "<tr><td>{$row['pid']}</td><td>{$program[$row['pid']]}</td><td>{$row['people']}人</td><td>{$row2['people']}人</td></tr>";

  $row= $rs->fetch_assoc();
  $row2= $rs2->fetch_assoc();
}

echo "</table>";
?>