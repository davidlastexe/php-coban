<?php

function getAll($sql) {
  global $connect;

  try {
    $stm = $connect->prepare($sql);
    $stm->execute();
    return $stm->fetchAll(PDO::FETCH_ASSOC);
  } catch (PDOException $ex) {
    echo "Error: {$ex->getMessage()}<br>";
    return false;
  }
}

/**
 * Summary of countRows
 * @param string $sql
 * @param array $params
 * @return bool|int
 */
function countRows($sql, $params = []) {
  global $connect;

  try {
    $stm = $connect->prepare($sql);
    $stm->execute($params);
    return $stm->rowCount();
  } catch (PDOException $ex) {
    echo "Error: {$ex->getMessage()}<br>";
    return false;
  }
}

function getOne($sql) {
  global $connect;

  try {
    $stm = $connect->prepare($sql);
    $stm->execute();
    return $stm->fetch(PDO::FETCH_ASSOC);
  } catch (PDOException $ex) {
    echo "Error: {$ex->getMessage()}<br>";
    return false;
  }
}

function lastID() {
  global $connect;

  try {
    return $connect->lastInsertId();
  } catch (PDOException $ex) {
    echo "Error: {$ex->getMessage()}<br>";
  }
}

function insert($table, $data) {
  global $connect;

  $keys = array_keys($data);
  $fields = implode(", ", array_map(fn ($key) => "`{$key}`", $keys));
  $places = ":".implode(",:", $keys);

  try {
    $sql = "INSERT INTO $table ($fields) VALUES ($places)";
    $stm = $connect->prepare($sql);
    return $stm->execute($data);
  } catch (PDOException $ex) {
    echo "Error: {$ex->getMessage()}<br>";
    return false;
  }
}

function update($table, $data, $condition = "", $params_condition = []) {
  global $connect;

  $fields = implode(", ", array_map(fn ($key) => "`{$key}` = :{$key}", array_keys($data)));
  $sql = $condition ? "UPDATE $table SET $fields WHERE $condition" : "UPDATE $table SET $fields";

  try {
    $stm = $connect->prepare($sql);
    $all_params = array_merge($data, $params_condition);
    return $stm->execute($all_params);
  } catch (PDOException $ex) {
    echo "Lỗi kết nối: ".$ex->getMessage();
    return false;
  }
}

function delete($table, $condition = "", $params_condition = []) {
  global $connect;

  $sql = $condition ? "DELETE FROM $table WHERE $condition" : "DELETE FROM $table";

  try {
    $stm = $connect->prepare($sql);
    return $stm->execute($params_condition);
  } catch (PDOException $ex) {
    echo "Lỗi kết nối: ".$ex->getMessage();
    return false;
  }
}