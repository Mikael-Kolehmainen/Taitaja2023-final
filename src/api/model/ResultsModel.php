<?php

namespace api\model;

class ResultsModel
{
  private const TABLE_NAME = "results";
  private const FIELD_ID = "id";
  private const FIELD_GAMES_ID = "games_id";
  private const FIELD_USERS_ID = "users_id";
  private const FIELD_SCORE = "score";
  private const FIELD_GAMETIME = "gametime";

  /** @var int */
  public $id;

  /** @var int */
  public $gamesId;

  /** @var int */
  public $usersId;

  /** @var int */
  public $score;

  /** @var int */
  public $gameTime;

  /** @var Database */
  private $db;

  public function __construct($database)
  {
    $this->db = $database;
  }

  /** @return ResultsModel[] */
  public function loadAll()
  {
    $records = $this->db->select(
      'SELECT * FROM ' . self::TABLE_NAME,
      []
    );

    $results = [];
    $i = 0;
    foreach ($records as $record) {
      $resultsModel = new ResultsModel($this->db);
      $results[$i] = $resultsModel->mapFromDbRecord($record);

      $i++;
    }

    return $results;
  }

  /**
   * @param mixed[] $record Associative array of one db record
   * @return $this
   */
  public function mapFromDbRecord($record)
  {
    $this->id = $record[self::FIELD_ID];
    $this->gamesId = $record[self::FIELD_GAMES_ID];
    $this->usersId = $record[self::FIELD_USERS_ID];
    $this->score = $record[self::FIELD_SCORE];
    $this->gameTime = $record[self::FIELD_GAMETIME];

    return $this;
  }
}
