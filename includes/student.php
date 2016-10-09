<?php

require_once(__DIR__."/database.php");

class Student {

  public $uuid;
  public $firstname;
  public $middlename;
  public $lastname;
  public $l1progress;
  public $l2progress;
  public $l3progress;
  public $l1mark;
  public $l2mark;
  public $l3mark;
  public $l1PreMark;
  public $l2PreMark;
  public $l3PreMark;
  public $l1act1;
  public $l1act2;
  public $l1act3;
  public $l2act1;
  public $l2act2;
  public $l2act3;
  public $l3act1;
  public $l3act2;
  public $l3act3;
  public $l3act4;

  function __construct($filter) {
    if (gettype($filter) == "array")
      $record = $filter;
    else
      $record = self::find_by_id($filter);

    foreach ($record as $attribute => $value) {
      if ($this->has_attribute($attribute)) {
        $this->$attribute = $value;
      }
    }
  }

  public function full_name() {
    if (isset($this->$first_name) && isset($this->$last_name)) {
      return $this->$first_name . " " . $this->last_name;
    }
    return "";
  }
  
  public function insert() {
    global $database;
    $sql = "INSERT INTO users (uuid, firstname, middlename, lastname) VALUES 
      ('{$this->uuid}', '{$this->firstname}', '{$this->middlename}', '{$this->lastname}')";
    $database->query($sql);
  }
  
  public function update() {
    global $database;
    $sql = "UPDATE users SET firstname='{$this->firstname}',
                                          middlename='{$this->middlename}', 
                                          lastname='{$this->lastname}', 
                                          l1PreMark='{$this->l1PreMark}', 
                                          l1mark='{$this->l1mark}', 
                                          l2PreMark='{$this->l2PreMark}', 
                                          l2mark='{$this->l2mark}', 
                                          l3PreMark='{$this->l3PreMark}', 
                                          l3mark='{$this->l3mark}',
                                          l1act1='{$this->l1act1}',
                                          l1act2='{$this->l1act2}',
                                          l1act3='{$this->l1act3}',
                                          l2act1='{$this->l2act1}',
                                          l2act2='{$this->l2act2}',
                                          l2act3='{$this->l2act3}',
                                          l3act1='{$this->l3act1}',
                                          l3act2='{$this->l3act2}',
                                          l3act3='{$this->l3act3}',
                                          l3act4='{$this->l3act4}'
              WHERE uuid='{$this->uuid}'";
    $database->query($sql);
  }

  public static function find_all() {
    global $database;
    $users_array = array();
    $result_set = self::find_by_sql("SELECT * FROM users");
    while ($row = $database->fetch_array($result_set)) {
      $users_array[] = new self($row);
    }
    return $users_array;
  }

  public static function find_by_id($id = 0) {
    global $database;
    $result_set = self::find_by_sql("SELECT * FROM users WHERE uuid='{$id}' LIMIT 1");
    $found = $database->fetch_array($result_set);
    return $found;
  }

  public static function find_by_sql($sql="") {
    global $database;
    $result_set = $database->query($sql);
    return $result_set;
  }

  private function has_attribute($attribute) {
    $object_vars = get_object_vars($this);
    return array_key_exists($attribute, $object_vars);
  }
}

?>