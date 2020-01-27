set character_set_client = utf8;
set character_set_connection = utf8;
set character_set_results = utf8;

# ゲストユーザー追加
INSERT INTO users (label, account_name, password) VALUES ('ゲストアカウント', 'guest', '$2y$10$Bkk0pCTFPRfHoHwImdzubee7BFSmPRicVvcVTO.UEoHJOL8DFBPVe');

# プルダウンの項目データ登録
INSERT INTO registered_user (id, label, sort_order) VALUES 
(1, '森本', 1),
(2, '小野', 2),
(3, '宮永', 3);

INSERT INTO classification (id, label, sort_order) VALUES 
(1 ,'ノート',       1 ),
(2 ,'デスクトップ', 2 ),
(3 ,NULL,           3 ),
(4 ,'モニター',     4 ),
(5 ,'タブレット',   5 ),
(6 ,'スピーカー',   6 ),
(7 ,NULL,           7 ),
(8 ,'管理他',       8 ),
(9 ,'プログラマー', 9 ),
(10,'デザイナー',   10);

INSERT INTO os (id, label, sort_order) VALUES 
(1, 'windows10 pro',  1),
(2, 'windows10 home', 2),
(3, 'mac',            3),
(4, 'Linux',          4);

INSERT INTO manufacturer (id, label, sort_order) VALUES 
(1 , 'mouse computer', 1 ),
(2 , 'ドスパラ',       2 ),
(3 , 'HP',             3 ),
(4 , 'DELL',           4 ),
(5 , 'LENOVO',         5 ),
(6 , NULL,             6 ),
(7 , 'IODATA',         7 ),
(8 , 'EIZO',           8 ),
(9 , 'フィリップス',   9 ),
(10, 'BenQ',           10),
(11, 'iiyama',         11),
(12, NULL,             12),
(13, 'microsoft',      13),
(14, 'adobe',          14),
(15, 'trendmicro',     15),
(16, 'Autodesk',       16);

INSERT INTO cpu (id, label, sort_order) VALUES 
(1, 'Intel Core i5-8400',                   1),
(2, 'Intel Core i7-8700 - 3.20GHz-4.60GHz', 2),
(3, 'Intel Core i7 7700 - 3.60GHZ',         3);

INSERT INTO hdd (id, label, sort_order) VALUES 
(1, 'なし', 1),
(2, '1TB',  2),
(3, '2TB',  3),
(4, '3TB',  4);

INSERT INTO graphics (id, label, sort_order) VALUES 
(1, 'GeForce GTX1050', 1),
(2, 'GeForce GTX1060', 2),
(3, 'GeForce GT710',   3);

INSERT INTO memory (id, label, sort_order) VALUES 
(1, '16GB', 1),
(2, '32GB', 2),
(3, '64GB', 3);

INSERT INTO insure (id, label, sort_order) VALUES 
(1, '１年', 1),
(2, '２年', 2),
(3, '３年', 3),
(4, '４年', 4),
(5, '５年', 5),
(6, 'なし', 6)
;


INSERT INTO hard (id, label, sort_order) VALUES 
(1, 'DVD',     1),
(2, 'BluRay',  2),
(3, 'Wii',     3),
(4, 'Switch',  4),
(5, 'PSP',     5),
(6, 'PS4',     6),
(7, 'PSVR',    7),
(8, 'DS3',     8),
(9, 'その他',  9);
