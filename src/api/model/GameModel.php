<?php

namespace api\model;

class GameModel
{
  private const TABLE_NAME = "games";
  private const FIELD_ID = "id";
  private const FIELD_TITLE = "title";
  private const FIELD_GAMEIMAGE = "gameimage";
  private const FIELD_CLASS = "class";

  /** @var int */
  public $id;

  /** @var string */
  public $title;

  /** @var string */
  public $gameImage;

  /** @var string */
  public $class;

  /** @var Database */
  private $db;

  public function __construct($database)
  {
    $this->db = $database;
  }

  /** @return GameModel[] */
  public function loadAll()
  {
    $records = $this->db->select(
      'SELECT * FROM ' . self::TABLE_NAME,
      []
    );

    $games = [];
    $i = 0;
    foreach ($records as $record) {
      $gameModel = new GameModel($this->db);
      $games[$i] = $gameModel->mapFromDbRecord($record);

      $i++;
    }

    return $games;
  }

  /**
   * @param mixed[] $record Associative array of one db record
   * @return $this
   */
  public function mapFromDbRecord($record)
  {
    $this->id = $record[self::FIELD_ID];
    $this->title = $record[self::FIELD_TITLE];
    $this->gameImage = $record[self::FIELD_GAMEIMAGE];
    $this->class = $record[self::FIELD_CLASS];

    return $this;
  }
}
