<?php
require_once(__DIR__."/config.php");

class MySQLDatabase {

  // db connection
  private $connection;

  function __construct() {
    $this->open_connection();
  }

  function __destruct() {
    $this->close_connection();
  }

  // Make a connection to the db
  public function open_connection() {
    $this->connection = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    if ($this->connection->connect_errno) {
      echo "Failed to connect to MySQL: " . $connection->connect_error;
    }
  }

  // Close connection
  public function close_connection() {
    if (isset($this->connection)) {
      $this->connection->close();
      unset($this->connection);
    }
  }

  // Perform Queries
  public function query($sql) {
    $result = $this->connection->query($sql);
    if (!$result) {
      echo "MySQL query error: " . $this->connection->error;
    }
    return $result;
  }

  public function fetch_array($result_set) {
    return $result_set->fetch_assoc();
  }

  public function num_rows($result_set) {
    return $result_set->num_rows;
  }

  public function insert_id() {
    return $this->connection->insert_id;
  }

  public function affected_rows() {
    return $this->connection->affected_rows;
  }

  // Helper functions

  // Escape string
  public function escape_value($value) {
    return $this->connection->real_escape_string($value);
  }
}

$database = new MySQLDatabase();
$db =& $database;
?>