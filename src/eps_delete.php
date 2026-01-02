<?php
require_once('db_inc.php');
//esp_submitからeps_deleteを呼び出したときは、log変数に値が入っているので
//1つ目のif文が実行される。このファイルからeps_deleteを呼び出すときは、
//log変数はない。こうしなければ、下のheader('Location:?do=eps_submit');で
//pg_headerを呼び出す前に、「echo '<h2>登録している希望を本当に削除しますか?</h2>';」
//が出力されるので、例のエラーになる。headerがすでに送られているというエラー。
if(isset($_GET['log'])){
echo '<h2>登録している希望を本当に削除しますか?</h2>';
echo '<form action="?do=eps_delete" method="post">';
echo '<input type="hidden" name="confirmed" value="1111">';
echo '<input type="submit" value="削除"> <a href="?do=eps_submit"><button type="button">戻る</button></a>';
echo '</form>';
}
if (isset($_POST['confirmed'])){//「削除」ボタンが再度押されたとき、データが削除される
  $uid = $_SESSION['uid'];
  $sid = strtoupper($uid);
  $sql = "DELETE FROM tbl_wish WHERE sid='{$sid}'";
  $rs = $conn->query($sql);
  header('Location:?do=eps_submit');
}
?>