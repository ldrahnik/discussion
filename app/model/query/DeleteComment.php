<?php

namespace Discussion\Model\Query;

use Kappa\Deaw\Queries\Queryable;
use Kappa\Deaw\Queries\QueryBuilder;

class DeleteComment implements Queryable {

  /** @var int */
  private $id;

  /**
   * @param int $id
   */
  public function __construct($id) {
    $this->id = $id;
  }

  public function getQuery(QueryBuilder $builder) {
    $query = $builder->delete()
      ->where('id = ?', $this->id);

    return $query;
  }

}
