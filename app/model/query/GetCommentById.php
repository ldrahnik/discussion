<?php

namespace Discussion\Model\Query;

use Kappa\Deaw\Queries\Queryable;
use Kappa\Deaw\Queries\QueryBuilder;

class GetCommentById implements Queryable {

  private $id;

  public function __construct($id) {
    $this->id = $id;
  }

  public function getQuery(QueryBuilder $builder) {
    $query = $builder->select([])
      ->where('id = ?', $this->id);

    return $query;
  }

}
