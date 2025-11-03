<?php

declare(strict_types=1);

namespace Inwebo\Markdown\Html\Block;

use Inwebo\Markdown\Model\Enum\NodeType;

class Ol extends Ul
{
    public function __construct(NodeType $type = NodeType::OL)
    {
        parent::__construct($type);
    }
}
