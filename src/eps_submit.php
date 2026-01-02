<?php
$confirm=1;
include("sys_confirm.php");

require_once 'db_inc.php';

$uid = $_SESSION['uid']; //ログイン中のユーザのIDを取得
$sid = strtoupper($uid); //学籍番号（ユーザIDの大文字変換）を求める

// 変数の初期化。新規登録か編集かにより異なる。
$act = 'insert';// 新規登録の場合
$pid = 0;
$reason = '';

// 現在の希望を調べ、変数$pid、$reasonに代入
$sql = "SELECT pid, reason FROM tbl_wish WHERE sid='{$sid}'";
// データベースへ問合せのSQL($sql)を実行
$rs = $conn->query($sql);
if (!$rs) die('エラー: ' . $conn->error);

// 問合せ結果を一行取得
$row= $rs->fetch_assoc();
if ($row){ 
  $act = 'update';
  //続いて、連想配列$rowにあるpid,reason項目を$pid, $reasonに代入
  $pid = $row['pid'];
  $reason = $row['reason'];
}
?>
<h2>希望プログラム選択</h2>
<form action="?do=eps_save" method="post">
  <!--
 ---ここへ希望登録画面をHTML・PHPで作る
 ---操作区分($act)、学籍番号($sid)、本人希望($pid)、希望理由($reason)などの変数が使える
 ---送信項目：操作区分(act:非表示送信)、本人希望(pid:ラジオボタン)、希望理由(reason:テキストエリア)
-->
 <input type="hidden" name="act" value="<?=$act?>">
<?php
  echo '<input type="radio" name="pid" value=1 ' . ($pid==1 ? "checked" : "") . '>総合教育プログラム<br>';
  echo '<input type="radio" name="pid" value=2 ' . ($pid==2 ? "checked" : "") . '>応用教育プログラム';
?>
 <h3>希望理由</h3>
 <textarea name="reason" class="form-control"><?=$reason ?></textarea>
 <br>
 <input type="submit" value="登録" class="btn btn-primary"><input type="reset" value="取消" class="btn btn-danger">
</form>
<hr>
<h2>希望プログラムの取消し</h2>
<p>・プログラムの希望登録を取消すことができます</p>
<a href="?do=eps_delete&log='check'"><button class="btn btn-danger">取り消す</button></a>