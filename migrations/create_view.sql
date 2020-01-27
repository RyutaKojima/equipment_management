# CSV出力用途のビュー

# 機材
DROP VIEW IF EXISTS view_equipments;
CREATE VIEW view_equipments (
  `ID`,
  `種別`,
  `区分け`,
  `OS`,
  `メーカー`,
  `名称`,
  `CPU`,
  `SSD`,
  `HDD1`,
  `HDD2`,
  `グラフィック`,
  `メモリ`,
  `光学ドライブ`,
  `保証`,
  `シリアル`,
  `ログイン/PC名`,
  `パスワード`,
  `購入日`,
  `使用者`,
  `登録日`,
  `登録者`,
  `備考`
) AS
SELECT
  EQUIP.equipment_id,
  case EQUIP.type_id
    WHEN 1 THEN 'PC'
    WHEN 2 THEN 'ソフト'
    WHEN 3 THEN '周辺機器'
    ELSE '不明'
  END,
  classification.label,
  os.label,
  manufacturer.label,
  EQUIP.title,
  cpu.label,
  EQUIP.ssd,
  HDD_1.label,
  HDD_2.label,
  graphics.label,
  memory.label,
  case EQUIP.has_drive
    WHEN 1 THEN '有り'
    ELSE '無し'
  END,
  insure.label,
  EQUIP.serial,
  EQUIP.login_name,
  EQUIP.login_password,
  EQUIP.purchased_at,
  EQUIP.created_at,
  EQUIP.user_in_use,
  registered_user.label,
  EQUIP.remarks
FROM equipments AS EQUIP
LEFT JOIN classification ON classification.id = EQUIP.classification_id
LEFT JOIN os ON os.id = EQUIP.os_id
LEFT JOIN manufacturer ON manufacturer.id = EQUIP.manufacturer_id
LEFT JOIN cpu ON cpu.id = EQUIP.cpu_id
LEFT JOIN hdd AS HDD_1 ON HDD_1.id = EQUIP.hdd_1_id
LEFT JOIN hdd AS HDD_2 ON HDD_2.id = EQUIP.hdd_2_id
LEFT JOIN graphics ON graphics.id = EQUIP.graphics_id
LEFT JOIN memory ON memory.id = EQUIP.memory_id
LEFT JOIN insure ON insure.id = EQUIP.insure_id
LEFT JOIN registered_user ON registered_user.id = EQUIP.registered_by_id
;

# 資料
DROP VIEW IF EXISTS view_documents;
CREATE VIEW view_documents (
  document_id,
  `種別`,
  `名称`,
  `ハード`,
  `メーカー`,
  `ISBN`,
  `ASIN`,
  `発行日`,
  `購入日`,
  `登録日`,
  `備考`
  )
AS
SELECT
  DOC.document_id,
  CASE DOC.type_id
    WHEN 1 THEN '映像'
    WHEN 2 THEN 'GAME'
    WHEN 3 THEN '書籍'
    ELSE '不明'
    END,
  DOC.title,
  HARD.label,
  DOC.manufacturer,
  DOC.isbn,
  DOC.asin,
  DOC.issued_at,
  DOC.purchased_at,
  REG_USER.label,
  DOC.remarks
FROM documents AS DOC
LEFT JOIN hard AS HARD ON HARD.id = DOC.hard_id
LEFT JOIN registered_user AS REG_USER ON  REG_USER.id = DOC.registered_by_id
;

