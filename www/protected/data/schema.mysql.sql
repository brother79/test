CREATE TABLE IF NOT EXISTS tbl_url (
  id int(11) NOT NULL AUTO_INCREMENT,
  source varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  short char(32) COLLATE utf8_unicode_ci NOT NULL,
  hash char(32) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (id),
  KEY short (short),
  KEY hash (hash),
  KEY source (source)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;


