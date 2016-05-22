<?php

namespace Discussion\Services;

use Dibi\Connection;
use Nette\Object;
use Nette\Utils\DateTime;

class CommentsService extends Object {

  /** @var Connection */
  private $connection;

  /**
   * @param Connection $connection
   */
  public function __construct(Connection $connection) {
    $this->connection = $connection;
  }

  /**
   * Returns all comments
   *
   * @return \Dibi\Row[]
   */
  public function getAll() {
    return $this->connection->query('
			SELECT * FROM `comments`'
    )->fetchAll();
  }

  /**
   * Add comment
   *
   * @param string $author
   * @param string $text
   *
   * @return void
   */
  public function add($author, $text) {
    $this->connection->query('INSERT INTO `comments`', array(
      'author' => $author,
      'text' => $text,
      'created' => new DateTime(),
    ));
  }

  /**
   * Remove comment by id
   *
   * @param int $id
   *
   * @return void
   */
  public function delete($id) {
    $this->connection->query('
			DELETE FROM `comments`
			WHERE `dbId` = ?', $id
    );
  }

}
