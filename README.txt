１．すべての機能や画面のソースファイルは、srcフォルダ以下に集約する。
２．各機能や画面の利用は、必ずindex.phpを通して行う。
３．各機能や画面のURLは以下のような相対URLに統一。
　例えばeps_hoge.phpにアクセスしたい場合は、URLは以下のいずれかのように指定する
　「index.php?do=eps_hoge」 もしくは
  「?do=eps_hoge」　（index.phpはデフォルトページなので省略可）


eps：education program system
～～～～～～～～～～～～～～～～


何かエラーが出たし、周りに合わせるためにコピーを作る。

//エラーメッセージ
Warning: Cannot modify header information - headers already sent by 
(output started at /var/www/html/wp2025/src/pg_header.php:1) 
in /var/www/html/wp2025/src/sys_logout.php on line 4

2025verとプログラムの内容が変わるので、新しく作る。
どちらも残しておきたい。

独自機能として、提出した希望の取消し機能を付けた。
eps_submitを2024を見て、編集が必要。

eps_decide_save.php のheader関数がうまく動かない
何なんだろうこのエラーは。

アカウント削除機能？

unset()：変数自体を削除する。
$a = 1;
unset($a);
print($a);
＞エラー
Undefined variable $a in /workspace/Main.php on line 5
＊unset($a)の部分をコメントアウトすると、実行できて1と表示される。

変数のスコープは<?php ?>の中
https://tamoc.com/php-include-paramater/