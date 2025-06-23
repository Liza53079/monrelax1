<?php
class Profile {
    function getChatBalance($userId){ return (int)findOne('uni_clients','clients_id=?',[$userId])['clients_chat_balance']; }
    function addChatBalance($userId,$count){ update('update uni_clients set clients_chat_balance=clients_chat_balance+? where clients_id=?',[$count,$userId]); }
    function getDailyChatUsed($userId,$date=''){ if(!$date) $date=date('Y-m-d'); $get=findOne('uni_chat_limits','user_id=? and date=?',[$userId,$date]); if(!$get){ insert('INSERT INTO uni_chat_limits(user_id,date,messages_sent,contacts_used)VALUES(?,?,?,0)',[$userId,$date,0]); return 0; } return (int)$get['messages_sent']; }
    function incrementDailyChatUsed($userId,$date=''){ if(!$date) $date=date('Y-m-d'); $get=findOne('uni_chat_limits','user_id=? and date=?',[$userId,$date]); if(!$get){ insert('INSERT INTO uni_chat_limits(user_id,date,messages_sent,contacts_used)VALUES(?,?,?,0)',[$userId,$date,1]); } else { update('update uni_chat_limits set messages_sent=messages_sent+1 where id=?',[$get['id']]); } }
    function canSendChat($userId,$date=''){ $bal=$this->getChatBalance($userId); $used=$this->getDailyChatUsed($userId,$date); return $bal>0 || $used<30; }
    function recordChatSent($userId,$date=''){ $bal=$this->getChatBalance($userId); if($bal>0){ update('update uni_clients set clients_chat_balance=clients_chat_balance-1 where clients_id=?',[$userId]); } else { $this->incrementDailyChatUsed($userId,$date); } }
}
?>
