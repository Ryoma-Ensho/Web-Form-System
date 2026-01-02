<?php
  //$conn = new mysqli("mysql","root","root", "wp2025db");//MySQLサーバへ接続
  //if ($conn->connect_errno) die($conn->connect_error);
  //$conn->set_charset('utf8mb4'); //文字コードをutf8mb4に設定（文字化け対策）

  $conn = new mysqli("localhost","k22rs026", "Ksu#DB2025", "wdb25k22rs026");//＜運用時の環境設定＞
  if ($conn->connect_errno) die($conn->connect_error);
  $conn->set_charset('utf8'); //文字コードをutf8に設定（文字化け対策）
?>