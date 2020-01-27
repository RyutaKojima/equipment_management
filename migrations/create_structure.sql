set character_set_client = utf8;
set character_set_connection = utf8;
set character_set_results = utf8;

DROP TABLE IF EXISTS `users`;
CREATE  TABLE `users`
(
  `user_id` int NOT NULL AUTO_INCREMENT COMMENT 'ユーザーID',
  `account_name` VARCHAR(20) NOT NULL COMMENT 'ログインアカウント',
  `password`     VARCHAR(255) NOT NULL COMMENT '暗号化したパスワード',
  `label` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '表示名',
  PRIMARY KEY user_id (user_id),
  UNIQUE KEY account_name (account_name)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='ユーザーアカウント情報';

# 資料系データ
DROP TABLE IF EXISTS `documents`;
CREATE  TABLE `documents`
(
  `document_id` int NOT NULL AUTO_INCREMENT COMMENT '資料ID',
  `type_id` int NOT NULL COMMENT '種別ID',
  `title`   VARCHAR(255) NOT NULL DEFAULT 'untitle' COMMENT 'タイトル',
  `hard_id` int NOT NULL DEFAULT 0 COMMENT 'ハード',
  `manufacturer`   VARCHAR(255) NOT NULL DEFAULT '' COMMENT 'メーカー（フリー入力）',
  `isbn`   VARCHAR(20) NOT NULL DEFAULT '' COMMENT 'ISBN',
  `asin`   VARCHAR(10) NOT NULL DEFAULT '' COMMENT 'ASIN',
  `issued_at` DATE NOT NULL COMMENT '発行日',
  `purchased_at` DATE NOT NULL COMMENT '購入日',
  `registered_by_id` int NOT NULL COMMENT '登録者',
  `remarks` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '備考',

  `created_at` DATETIME NOT NULL COMMENT '登録日時',
  `updated_at` DATETIME NOT NULL COMMENT '情報更新日時',
  PRIMARY KEY document_id (document_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='資料情報';

# 機材系データ
DROP TABLE IF EXISTS `equipments`;
CREATE  TABLE `equipments`
(
  `equipment_id` int NOT NULL AUTO_INCREMENT COMMENT '機材ID',
  `type_id` int NOT NULL COMMENT '種別ID',

  `classification_id` int NOT NULL DEFAULT 0 COMMENT '区分け',
  `os_id` int NOT NULL DEFAULT 0 COMMENT 'OS',
  `manufacturer_id` int NOT NULL DEFAULT 0 COMMENT 'メーカー',
  `title`   VARCHAR(255) NOT NULL DEFAULT '' COMMENT '名称',
  `cpu_id` int NOT NULL DEFAULT 0 COMMENT 'CPU',
  `ssd`   VARCHAR(255) NOT NULL DEFAULT '' COMMENT 'SSD',
  `hdd_1_id` int NOT NULL DEFAULT 0 COMMENT 'HDD1',
  `hdd_2_id` int NOT NULL DEFAULT 0 COMMENT 'HDD2',
  `graphics_id` int NOT NULL DEFAULT 0 COMMENT 'グラフィックボード',
  `memory_id` int NOT NULL DEFAULT 0 COMMENT 'メモリ',
  `has_drive` int NOT NULL DEFAULT 0 COMMENT '光学ドライブ有り',
  `insure_id` int NOT NULL DEFAULT 0 COMMENT '保証',

  `serial` VARCHAR(255) NOT NULL DEFAULT '' COMMENT 'シリアル',
  `login_name` VARCHAR(255) NOT NULL DEFAULT '' COMMENT 'ログインユーザー',
  `login_password` VARCHAR(255) NOT NULL DEFAULT '' COMMENT 'ログインパスワード',
  `purchased_at` DATE NOT NULL COMMENT '購入日',
  `user_in_use` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '使用者',
  `registered_by_id` int NOT NULL COMMENT '登録者',
  `remarks` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '備考',

  `created_at` DATETIME NOT NULL COMMENT '登録日時',
  `updated_at` DATETIME NOT NULL COMMENT '情報更新日時',
  PRIMARY KEY equipment_id (equipment_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='機材情報';

DROP TABLE IF EXISTS `registered_user`;
CREATE  TABLE `registered_user`
(
  id int NOT NULL AUTO_INCREMENT COMMENT 'ユニークなID',
  label VARCHAR(255) DEFAULT NULL COMMENT '表示名, NULLは区切り文字',
  sort_order int unsigned NOT NULL default 1 COMMENT '表示順',
  deleted_at DATETIME NOT NULL DEFAULT '1000-01-01 00:00:00' COMMENT '削除日時',
  PRIMARY KEY id (id),
  UNIQUE unq_label_deleted_at (label, deleted_at),
  INDEX idx_1 (deleted_at, sort_order ASC)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='登録者';

DROP TABLE IF EXISTS `classification`;
CREATE  TABLE `classification`
(
  id int NOT NULL AUTO_INCREMENT COMMENT 'ユニークなID',
  label VARCHAR(255) DEFAULT NULL COMMENT '表示名, NULLは区切り文字',
  sort_order int unsigned NOT NULL default 1 COMMENT '表示順',
  deleted_at DATETIME NOT NULL DEFAULT '1000-01-01 00:00:00' COMMENT '削除日時',
  PRIMARY KEY id (id),
  UNIQUE unq_label_deleted_at (label, deleted_at),
  INDEX idx_1 (deleted_at, sort_order ASC)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='区分け';

DROP TABLE IF EXISTS `os`;
CREATE  TABLE `os`
(
  id int NOT NULL AUTO_INCREMENT COMMENT 'ユニークなID',
  label VARCHAR(255) DEFAULT NULL COMMENT '表示名, NULLは区切り文字',
  sort_order int unsigned NOT NULL default 1 COMMENT '表示順',
  deleted_at DATETIME NOT NULL DEFAULT '1000-01-01 00:00:00' COMMENT '削除日時',
  PRIMARY KEY id (id),
  UNIQUE unq_label_deleted_at (label, deleted_at),
  INDEX idx_1 (deleted_at, sort_order ASC)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='OS';

DROP TABLE IF EXISTS `manufacturer`;
CREATE  TABLE `manufacturer`
(
  id int NOT NULL AUTO_INCREMENT COMMENT 'ユニークなID',
  label VARCHAR(255) DEFAULT NULL COMMENT '表示名, NULLは区切り文字',
  sort_order int unsigned NOT NULL default 1 COMMENT '表示順',
  deleted_at DATETIME NOT NULL DEFAULT '1000-01-01 00:00:00' COMMENT '削除日時',
  PRIMARY KEY id (id),
  UNIQUE unq_label_deleted_at (label, deleted_at),
  INDEX idx_1 (deleted_at, sort_order ASC)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='メーカー';

DROP TABLE IF EXISTS `cpu`;
CREATE  TABLE `cpu`
(
  id int NOT NULL AUTO_INCREMENT COMMENT 'ユニークなID',
  label VARCHAR(255) DEFAULT NULL COMMENT '表示名, NULLは区切り文字',
  sort_order int unsigned NOT NULL default 1 COMMENT '表示順',
  deleted_at DATETIME NOT NULL DEFAULT '1000-01-01 00:00:00' COMMENT '削除日時',
  PRIMARY KEY id (id),
  UNIQUE unq_label_deleted_at (label, deleted_at),
  INDEX idx_1 (deleted_at, sort_order ASC)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='CPU';

DROP TABLE IF EXISTS `hdd`;
CREATE  TABLE `hdd`
(
  id int NOT NULL AUTO_INCREMENT COMMENT 'ユニークなID',
  label VARCHAR(255) DEFAULT NULL COMMENT '表示名, NULLは区切り文字',
  sort_order int unsigned NOT NULL default 1 COMMENT '表示順',
  deleted_at DATETIME NOT NULL DEFAULT '1000-01-01 00:00:00' COMMENT '削除日時',
  PRIMARY KEY id (id),
  UNIQUE unq_label_deleted_at (label, deleted_at),
  INDEX idx_1 (deleted_at, sort_order ASC)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='HDD';

DROP TABLE IF EXISTS `graphics`;
CREATE  TABLE `graphics`
(
  id int NOT NULL AUTO_INCREMENT COMMENT 'ユニークなID',
  label VARCHAR(255) DEFAULT NULL COMMENT '表示名, NULLは区切り文字',
  sort_order int unsigned NOT NULL default 1 COMMENT '表示順',
  deleted_at DATETIME NOT NULL DEFAULT '1000-01-01 00:00:00' COMMENT '削除日時',
  PRIMARY KEY id (id),
  UNIQUE unq_label_deleted_at (label, deleted_at),
  INDEX idx_1 (deleted_at, sort_order ASC)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='グラフィックボード';

DROP TABLE IF EXISTS `memory`;
CREATE  TABLE `memory`
(
  id int NOT NULL AUTO_INCREMENT COMMENT 'ユニークなID',
  label VARCHAR(255) DEFAULT NULL COMMENT '表示名, NULLは区切り文字',
  sort_order int unsigned NOT NULL default 1 COMMENT '表示順',
  deleted_at DATETIME NOT NULL DEFAULT '1000-01-01 00:00:00' COMMENT '削除日時',
  PRIMARY KEY id (id),
  UNIQUE unq_label_deleted_at (label, deleted_at),
  INDEX idx_1 (deleted_at, sort_order ASC)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='メモリ';

DROP TABLE IF EXISTS `insure`;
CREATE  TABLE `insure`
(
  id int NOT NULL AUTO_INCREMENT COMMENT 'ユニークなID',
  label VARCHAR(255) DEFAULT NULL COMMENT '表示名, NULLは区切り文字',
  sort_order int unsigned NOT NULL default 1 COMMENT '表示順',
  deleted_at DATETIME NOT NULL DEFAULT '1000-01-01 00:00:00' COMMENT '削除日時',
  PRIMARY KEY id (id),
  UNIQUE unq_label_deleted_at (label, deleted_at),
  INDEX idx_1 (deleted_at, sort_order ASC)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='保証';

DROP TABLE IF EXISTS `hard`;
CREATE  TABLE `hard`
(
  id int NOT NULL AUTO_INCREMENT COMMENT 'ユニークなID',
  label VARCHAR(255) DEFAULT NULL COMMENT '表示名, NULLは区切り文字',
  sort_order int unsigned NOT NULL default 1 COMMENT '表示順',
  deleted_at DATETIME NOT NULL DEFAULT '1000-01-01 00:00:00' COMMENT '削除日時',
  PRIMARY KEY id (id),
  UNIQUE unq_label_deleted_at (label, deleted_at),
  INDEX idx_1 (deleted_at, sort_order ASC)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='ハード（資料）';

