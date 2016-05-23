<?php

namespace Discussion\Services;

use Discussion\Model\Query\CreateComment;
use Discussion\Model\Query\DeleteComment;
use Discussion\Model\Query\GetAllComments;
use Kappa\Deaw\Table;
use Kappa\Deaw\TableFactory;
use Nette\Object;
use Nette\Utils\DateTime;

class CommentsService extends Object {

  /** @var Table */
  private $comments;

  /**
   * @param TableFactory $tableFactory
   */
  public function __construct(TableFactory $tableFactory) {
    $this->comments = $tableFactory->create('comments');
  }

  /**
   * Returns all comments
   *
   * @return \Dibi\Row[]
   */
  public function getAll() {
    return $this->comments->fetch(new GetAllComments());
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
    $this->comments->execute(new CreateComment(array(
      'author' => $author,
      'text' => $text,
      'created' => new DateTime()
    )));
  }

  /**
   * Remove comment by id
   *
   * @param int $id
   *
   * @return void
   */
  public function delete($id) {
    $this->comments->execute(new DeleteComment($id));
  }

}
