<?php
class ChatLimits {
    public function getToday($userId){
        return findOne('uni_chat_limits','user_id=? and date=?',[$userId,date('Y-m-d')]);
    }

    public function contactsUsedToday($userId){
        $row = $this->getToday($userId);
        return $row ? (int)$row['contacts_used'] : 0;
    }

    private function incrementContacts($userId){
        $row = $this->getToday($userId);
        if($row){
            update('update uni_chat_limits set contacts_used=contacts_used+1 where id=?',[$row['id']]);
        }else{
            insert('INSERT INTO uni_chat_limits(user_id,date,messages_sent,contacts_used)VALUES(?,?,?,?)',[$userId,date('Y-m-d'),0,1]);
        }
    }

    public function remainingChats($userId){
        global $settings;
        $free = min(30, intval($settings['chat_free_per_day']));
        $bonus = (int)findOne('uni_clients','clients_id=?',[$userId])['clients_bonus_chats'];
        $used = $this->contactsUsedToday($userId);
        $limit = $free + $bonus;
        return max(0, $limit - $used);
    }

    public function useChat($userId){
        global $settings;
        $free = min(30, intval($settings['chat_free_per_day']));
        $bonus = (int)findOne('uni_clients','clients_id=?',[$userId])['clients_bonus_chats'];
        $used = $this->contactsUsedToday($userId);
        if($used >= $free){
            if($bonus <= 0) return false;
            update('update uni_clients set clients_bonus_chats=clients_bonus_chats-1 where clients_id=?',[$userId]);
        }
        $this->incrementContacts($userId);
        return true;
    }

    public function addBonus($userId,$count){
        update('update uni_clients set clients_bonus_chats=clients_bonus_chats+? where clients_id=?',[$count,$userId]);
    }
}
?>
