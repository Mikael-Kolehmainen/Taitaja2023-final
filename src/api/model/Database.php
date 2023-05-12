<?php

namespace api\model;

/*
  This is the Database Model, which connects and serves MySQL database operations like:
  SELECT, INSERT, DELETE. All the functions use parameterized queries to avoid
  SQL injections.

  We use this file in the other Model files, for example UserModel could have
  a function that gets a user based on id, then the SELECT statement is created
  in UserModel and the query parameters are given as a second parameter in the
  select function.
*/
class Database
{
  /** @var \mysqli */
  protected $connection = null;

  public function __construct()
  {
    try {
      $this->connection = new \mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE_NAME);

      if (mysqli_connect_errno()) {
        throw new \Exception("Could not connect to database.");
      }
    } catch (\Exception $e) {
      throw new \Exception($e->getMessage());
    }
  }

  /**
   * @param string $query
   * @param array $params
   * @return array
   */
  public function select($query = "", $params = []): array
  {
    try {
      $stmt = $this->executeStatement($query, $params);
      $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
      $stmt->close();

      return $result;
    } catch (\Exception $e) {
      throw new \Exception($e->getMessage());
    }
  }

  /**
   * @param string $query
   * @param array $params
   * @return int|string
   */
  public function insert($query = "", $params = [])
  {
    try {
      $stmt = $this->executeStatement($query, $params);
      $stmt->close();

      return $this->connection->insert_id;
    } catch (\Exception $e) {
      throw new \Exception($e->getMessage());
    }
  }

  /**
   * @param string $query
   * @param array $params
   */
  public function remove($query = "", $params = [])
  {
    try {
      $stmt = $this->executeStatement($query, $params);
      $stmt->close();
    } catch (\Exception $e) {
      throw new \Exception($e->getMessage());
    }
  }

  /**
   * @param string $query
   * @param array $params
   * @return \mysqli_stmt
   */
  private function executeStatement($query = "", $params = [])
  {
    try {
      $stmt = $this->connection->prepare($query);

      if ($stmt === false) {
        throw new \Exception("Unable to do prepared statement: " . $query);
      }

      if (!empty($params)) {
        $stmt->bind_param($params[0][0], ...$params[1]);
      }

      $stmt->execute();

      return $stmt;
    } catch (\Exception $e) {
      throw new \Exception($e->getMessage());
    }
  }
}
