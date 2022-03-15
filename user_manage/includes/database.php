<?php
if (!defined('_INCODE')) die('access deined...');
function query($sql, $data=[], $statementStatus = false) {
    global $conn;
    $query = false;
    try {
        $statement  = $conn -> prepare($sql);
        if(empty($data)) {
            $query = $statement->execute(); 
        } else {
            $query = $statement->execute($data); 
        }  
    }
    catch(Exception $e) {
        require_once 'module/erorr/databases.php';
        die();
    }
    if ($statementStatus && $query) {
        return $statement;
    }
    return $query;
}
function insert($table, $dataInsert) {

    $keyArray = array_keys($dataInsert);
    $strKey = implode(', ',$keyArray);
    $values = ':'.implode(', :', $keyArray);
    $sql = "INSERT INTO ".$table.'('.$strKey.') VALUES ('.$values.')' ;

    return query($sql, $dataInsert);
}
function update($table, $dataUpdate, $conditions) {
    $updateStr ='';
    foreach($dataUpdate as $key => $value) {
        $updateStr.= $key.'=:'.$key.', ';
    }
    $updateStr = rtrim($updateStr, ', ');
    if (!empty($conditions)) {
        $sql = "UPDATE ".$table." SET ".$updateStr.' WHERE '.$conditions;
    }
    else {
        $sql = "UPDATE ".$table." SET ".$updateStr;
    }
    return query($sql, $dataUpdate);
}
function delete($table, $conditions = '') {
    if (!empty($conditions)) {
        $sql = "DELETE FROM ".$table." WHERE ".$conditions;
    }
    else {
        $sql = "DELETE FROM ".$table;
    }
    return query($sql);
}
// laays dữ liệu ở sql
function getRows($sql) {
    $statement = query($sql, [] , true);
    if (is_object($statement)) {
        $dataFeed = $statement -> fetchAll(PDO::FETCH_ASSOC);
        return $dataFeed;
    }
    return false;
}
// laays 1 banr ghi
function firstRow($sql) {
    $statement = query($sql, [] , true);
    if (is_object($statement)) {
        $dataFeed = $statement -> fetch(PDO::FETCH_ASSOC);
        return $dataFeed;
    }
    return false;
}
function get($table, $field = '*', $conditions='') {

    $sql= 'SELECT'.$field.' FROM'.$table;
    if (!empty($conditions)) {
        $sql .= ' WHERE '.$conditions;
    }
    return getRows($sql);
}
function first($table, $field = '*', $conditions='') {
    $sql= 'SELECT'.$field.' FROM'.$table;
    if (!empty($conditions)) {
        $sql .= ' WHERE '.$conditions;
    }
    return firstRow($sql);
}
// laays số dòng vừa truy vấn
function firstRows($sql) {
    $statement = query($sql, [] , true );
    if (!empty($statement)) {
        return $statement -> rowCount();
    }

}
// laays id vừa truy vấn 
function insertID($sql) {
    
}