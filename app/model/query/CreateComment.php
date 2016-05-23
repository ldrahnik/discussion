<?php

namespace Discussion\Model\Query;

use Kappa\Deaw\Queries\Queryable;
use Kappa\Deaw\Queries\QueryBuilder;

class CreateComment implements Queryable {

  /** @var array */
  private $data;

  /**
   * @param array $data
   */
  public function __construct(array $data) {
    $this->data = $data;
  }

  public function getQuery(QueryBuilder $builder) {
    return $builder->insert($this->data);
  }

}
