# demo

[Demo](https://equipmentmanagement.herokuapp.com/)

| ユーザー | パスワード |
| -------- | ---------- |
| guest    | guest      | 

※ 「管理者メニュー」を開く際に必要です

# 環境構築手順

1. dockerを起動します

```shell
docker-compose build
docker-compose up -d
```

2. SQLを流します

- `migrations/create_structure.sql`
- `migrations/data.sql`

```shell
docker cp migrations/create_structure.sql site_mysql:/home/create_structure.sql
docker cp migrations/data.sql site_mysql:/home/data.sql
```

```sql
CREATE USER 'adminuser'@'%' IDENTIFIED BY 'adminuser';
GRANT ALL PRIVILEGES ON *.* TO 'adminuser'@'%' WITH GRANT OPTION;

set character_set_client = utf8;
set character_set_connection = utf8;
set character_set_results = utf8;
```

docker exec -it site_mysql /bin/bash

mysql -u adminuser -p management < /home/create_structure.sql
mysql -u adminuser -p management < /home/data.sql

3. セッションデータ保存先を用意します

セッションデータ保存先ディレクトリを作成し、所有権を変更する
docker exec -it site_web /bin/bash
cd /var/www/site/
mkdir -p .session | chown nginx:nginx .session

4. 画面から確認します

ブラウザからアクセス
> http://localhost:9080

# 本番環境設置手順

1. ソースをクローン

git pull

2. configを環境に合わせる

vi app/config/config.php

3. session用ディレクトリ作成

セッションデータ保存先ディレクトリを作成し、所有権を変更する
cd /path/to/project/
mkdir -p .session | chmod 777 .session

4. MySQL

- ユーザー作成（まだであれば）
```sql
CREATE USER 'adminuser'@'%' IDENTIFIED BY 'adminuser';
GRANT ALL PRIVILEGES ON *.* TO 'adminuser'@'%' WITH GRANT OPTION;
```

- `migrations/create_schema.sql`
- `migrations/create_structure.sql`
- `migrations/data.sql`
