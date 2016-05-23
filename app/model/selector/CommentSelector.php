<?php

namespace Discussion\Model\Selector;

use Kappa\Deaw\Queries\Selector;

class CommentSelector extends Selector {

  public function configure() {
    $this->setSelects(['author', 'text']);
  }

}