<?php
update("ALTER TABLE uni_clients ADD COLUMN gender enum('male','female','other') DEFAULT NULL");
update("ALTER TABLE uni_clients ADD COLUMN role enum('sponsor','model') DEFAULT NULL");
update("ALTER TABLE uni_clients ADD COLUMN preferred_gender enum('male','female','both') DEFAULT NULL");
update("ALTER TABLE uni_clients ADD COLUMN verify_gesture varchar(255) DEFAULT NULL COMMENT 'Verification gesture'");
update("ALTER TABLE uni_clients ADD COLUMN verify_photo varchar(255) DEFAULT NULL COMMENT 'Verification photo'");
update("ALTER TABLE uni_clients ADD COLUMN social_links text DEFAULT NULL COMMENT 'Social networks'");
update("ALTER TABLE uni_clients ADD COLUMN age int(11) DEFAULT NULL COMMENT 'Age (18+)'");
update("ALTER TABLE uni_clients ADD COLUMN city varchar(255) DEFAULT NULL COMMENT 'City name'");
update("ALTER TABLE uni_clients ADD COLUMN phone varchar(50) DEFAULT NULL COMMENT 'Unique phone number'");
update("ALTER TABLE uni_clients ADD COLUMN description text DEFAULT NULL COMMENT 'Profile description'");
update("ALTER TABLE uni_clients ADD COLUMN is_email_verified tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Email confirmed'");
update("ALTER TABLE uni_clients ADD COLUMN is_phone_verified tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Phone confirmed'");
update("UPDATE uni_settings SET value=? WHERE name=?", array('4.10.2','systems_patch_version'));
?>
