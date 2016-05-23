<?php

namespace Discussion\Model\Query;

use Kappa\Deaw\BasicSelectors\SelectAll;
use Kappa\Deaw\Queries\Queryable;
use Kappa\Deaw\Queries\QueryBuilder;

class GetAllComments implements Queryable {

  public function getQuery(QueryBuilder $builder) {
    return $builder->select(new SelectAll());
  }

}
