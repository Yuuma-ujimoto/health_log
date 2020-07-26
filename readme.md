## トレーニング記録WEBサービス

### 機能
トレーニングの記録
トレーニングの項目の登録
トレーニングの記録の確認と任意のトレーニングの記録の削除

これらの機能を全て非同期で実装し全ての機能を一つのページでストレス無く行えるようにしました

全てのコードをindex.phpに集約させた結果ファイルはすっきりしたが中のファイルが魑魅魍魎と化した


### SQL初期設定

create database health;

use health

create table health_data(
  itn health_id auto increment,
  int exercise,
  int count,
  datetime date_data
  int is_show default 1,
  index(health_id)
);

create table exercise_data(
  int exercise_id auto increment,
  varchar(500) exercise_name,
  varchar(10) count_type,
  int is_show default 1,
  index(exercise_id)
);