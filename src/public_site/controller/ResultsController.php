<?php

namespace public_site\controller;
use api\model\Database;
use api\model\ResultsModel;

/*
  This is the ResultsController, its main function is to return results from
  ResultsModel and the db.
*/
class ResultsController
{
  /** @var Database */
  private $db;

  public function __construct()
  {
    $this->db = new Database();
  }

  /** @return ResultsModel[] */
  public function getAll()
  {
    $resultsModel = new ResultsModel($this->db);

    return $resultsModel->loadAll();
  }
}
