<h3>アカウント一覧</h3>
<?php
require_once 'db_inc.php'; //データベースに接続する

// 一覧データを検索するSQL文
$sql = "SELECT * FROM tbl_user ORDER BY urole,uid";
//データベースへ問合せのSQL文($sql)を実行
$rs = $conn->query($sql);
if (!$rs) die('エラー: ' . $conn->error);
// 問合せ結果を表形式で出力する
echo '<table border=1>';
// まず、ヘッド部分（項目名）を出力
echo '<tr><th>No.</th><th>氏名</th><th>ユーザ種別</th></tr>';
$row= $rs->fetch_assoc();
while ($row) {
// ユーザID（uid）、ユーザ名(uname)、ユーザ種別(urole)を1行ずつ繰り返し出力
 echo '<tr>';
 echo '<td>' . $row['uid'] . '</td>';
 echo '<td>' . $row['uname']. '</td>';
 //echo '<td>' . $row['urole']. '</td>'; 　この行をコメントアウト、以下の3行を追加
 $i  = $row['urole'];     // ユーザ種別のコードを数値で取得
 $codes = array(1=>'学生', 2=>'教員', 9=>'管理者' ); //ユーザ種別を定義する配列
 echo '<td>' . $codes[$i] . '</td>'; // ユーザ種別名を配列の要素として出力
 echo '<td><a href="?do=usr_detail&uid='.$row['uid'] . '">詳細</a></td>';//echo '</tr>';の直前に追加 
 echo '<td><a href="?do=usr_edit&uid='.$row['uid'].'">編集</a></td>';// while文内に追加 
 echo '<td><a href="?do=usr_delete&uid='.$row['uid'].'">削除</a></td>';// echo '</tr>';の直前に追加 
 echo '</tr>';
 $row = $rs->fetch_assoc();//次の行へ
}
echo '</table>';
?>