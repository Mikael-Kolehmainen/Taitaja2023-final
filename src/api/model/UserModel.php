<?php

namespace api\model;

class UserModel
{
  private const TABLE_NAME = "users";
  private const FIELD_ID = "id";
  private const FIELD_USERNAME = "username";
  private const FIELD_FIRSTNAME = "firstname";
  private const FIELD_LASTNAME = "lastname";
  private const FIELD_EMAIL = "email";
  private const FIELD_PHONE = "phone";
  private const FIELD_PW = "pw";
  private const FIELD_USERROLE = "userrole";
  private const FIELD_USERSESSION = "usersession";
  private const FIELD_DELETED = "deleted";

  /** @var int */
  public $id;

  /** @var string */
  public $username;

  /** @var string */
  public $firstName;

  /** @var string */
  public $lastName;

  /** @var string */
  public $email;

  /** @var string */
  public $phone;

  /** @var string */
  public $password;

  /** @var string */
  public $userRole;

  /** @var string */
  public $userSession;

  /** @var int */
  public $deleted;

  /** @var Database */
  private $db;

  public function __construct($database)
  {
    $this->db = $database;
  }

  public function create()
  {
    $this->db->insert(
      'INSERT INTO ' . self::TABLE_NAME .
        '( ' .
          self::FIELD_USERNAME . ', ' .
          self::FIELD_FIRSTNAME . ', ' .
          self::FIELD_LASTNAME . ', ' .
          self::FIELD_EMAIL . ', ' .
          self::FIELD_PHONE . ', ' .
          self::FIELD_PW . ', ' .
          self::FIELD_USERROLE . ', ' .
          self::FIELD_USERSESSION .
        ') VALUES (?, ?, ?, ?, ?, ?, ?, ?)',
        [["ssssssss"], [
          $this->username,
          $this->firstName,
          $this->lastName,
          $this->email,
          $this->phone,
          $this->password,
          $this->userRole,
          $this->userSession
        ]]
    );
  }

  public function delete()
  {
    $this->db->remove(
      'DELETE FROM ' . self::TABLE_NAME . ' WHERE ' . self::FIELD_ID . ' = ?',
      [["s"], [$this->id]]
    );
  }

  public function load(): UserModel
  {
    $records = $this->db->select(
      'SELECT * FROM ' . self::TABLE_NAME . ' WHERE ' . self::FIELD_ID . ' = ?',
      [["s"], [$this->id]]
    );
    $record = array_pop($records);
    return $this->mapFromDbRecord($record);
  }

  /** @return UserModel[] */
  public function loadAll()
  {
    $records = $this->db->select(
      'SELECT * FROM ' . self::TABLE_NAME,
      []
    );

    $users = [];
    $i = 0;
    foreach ($records as $record) {
      $userModel = new UserModel($this->db);
      $users[$i] = $userModel->mapFromDbRecord($record);

      $i++;
    }

    return $users;
  }

  public function loadWithUsername(): UserModel
  {
    $records = $this->db->select(
      'SELECT * FROM ' . self::TABLE_NAME . ' WHERE ' . self::FIELD_USERNAME . ' = ?',
      [["s"], [$this->username]]
    );
    $record = array_pop($records);
    return $this->mapFromDbRecord($record);
  }

  public function loadWithSession(): UserModel
  {
    $records = $this->db->select(
      'SELECT * FROM ' . self::TABLE_NAME . ' WHERE ' . self::FIELD_USERSESSION . ' = ?',
      [["s"], [$this->userSession]]
    );
    $record = array_pop($records);
    return $this->mapFromDbRecord($record);
  }

  public function insertSoftDeleteMarker(): void
  {
    $this->db->insert(
      'UPDATE ' . self::TABLE_NAME . ' ' .
      'SET ' . self::FIELD_DELETED . ' = ? ' .
      'WHERE ' . self::FIELD_USERSESSION . ' = ?',
      [["is"], [1, $this->userSession]]
    );
  }

  public function updateUserSession(): void
  {
    $this->db->insert(
      'UPDATE ' . self::TABLE_NAME . ' ' .
      'SET ' . self::FIELD_USERSESSION . ' = ? ' .
      'WHERE ' . self::FIELD_ID . ' = ?',
      [["ss"], [$this->userSession, $this->id]]
    );
  }

  public function updateUsername(): void
  {
    $this->db->insert(
      'UPDATE ' . self::TABLE_NAME . ' ' .
      'SET ' . self::FIELD_USERNAME . ' = ? ' .
      'WHERE ' . self::FIELD_USERSESSION . ' = ?',
      [["ss"], [$this->username, $this->userSession]]
    );
  }

  public function updateEmail(): void
  {
    $this->db->insert(
      'UPDATE ' . self::TABLE_NAME . ' ' .
      'SET ' . self::FIELD_EMAIL . ' = ? ' .
      'WHERE ' . self::FIELD_USERSESSION . ' = ?',
      [["ss"], [$this->email, $this->userSession]]
    );
  }

  public function updatePhone(): void
  {
    $this->db->insert(
      'UPDATE ' . self::TABLE_NAME . ' ' .
      'SET ' . self::FIELD_PHONE . ' = ? ' .
      'WHERE ' . self::FIELD_USERSESSION . ' = ?',
      [["ss"], [$this->phone, $this->userSession]]
    );
  }

  /**
   * @param mixed[] $record Associative array of one db record
   * @return $this
   */
  public function mapFromDbRecord($record)
  {
    $this->id = $record[self::FIELD_ID];
    $this->username = $record[self::FIELD_USERNAME];
    $this->firstName = $record[self::FIELD_FIRSTNAME];
    $this->lastName = $record[self::FIELD_LASTNAME];
    $this->email = $record[self::FIELD_EMAIL];
    $this->phone = $record[self::FIELD_PHONE];
    $this->password = $record[self::FIELD_PW];
    $this->userRole = $record[self::FIELD_USERROLE];
    $this->deleted = $record[self::FIELD_DELETED];

    return $this;
  }
}
