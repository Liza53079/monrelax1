-- Add pending status (value=4) to clients_status
-- This migration does not alter table structure but documents new status
-- Use this to ensure database defaults if needed
ALTER TABLE `uni_clients`
  MODIFY `clients_status` int(11) NOT NULL DEFAULT 4 COMMENT '0=unconfirmed,1=active,2=blocked,3=deleted,4=pending';
