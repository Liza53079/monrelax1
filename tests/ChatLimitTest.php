<?php
require_once __DIR__.'/ProfileStub.php';

// Stub database using SQLite
$pdo = new PDO('sqlite::memory:');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->exec("CREATE TABLE uni_clients (clients_id INTEGER PRIMARY KEY, clients_chat_balance INTEGER DEFAULT 0);");
$pdo->exec("CREATE TABLE uni_chat_limits (id INTEGER PRIMARY KEY AUTOINCREMENT, user_id INTEGER, date TEXT, messages_sent INTEGER DEFAULT 0, contacts_used INTEGER DEFAULT 0);");

function findOne($table,$query,$params=[]){
    global $pdo;
    $stmt=$pdo->prepare("SELECT * FROM $table WHERE $query LIMIT 1");
    $stmt->execute($params);
    $row=$stmt->fetch(PDO::FETCH_ASSOC);
    return $row ?: [];
}
function getAll($query,$params=[]){
    global $pdo;
    $stmt=$pdo->prepare($query);
    $stmt->execute($params);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function update($query,$params=[]){
    global $pdo;
    $stmt=$pdo->prepare($query);
    $stmt->execute($params);
}
function insert($query,$params=[]){
    global $pdo;
    $stmt=$pdo->prepare($query);
    $stmt->execute($params);
    return $pdo->lastInsertId();
}

$profile = new Profile();
insert("INSERT INTO uni_clients (clients_id, clients_chat_balance) VALUES (1,2)");

assert($profile->getChatBalance(1) === 2);
$profile->recordChatSent(1, '2025-01-01');
$profile->recordChatSent(1, '2025-01-01');
assert($profile->getChatBalance(1) === 0);

for($i=0;$i<30;$i++){
    $profile->recordChatSent(1, '2025-01-01');
}
assert($profile->canSendChat(1,'2025-01-01') === false);
assert($profile->canSendChat(1,'2025-01-02') === true);

echo "Tests passed\n";
?>
