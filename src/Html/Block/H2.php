<?php

declare(strict_types=1);

namespace Inwebo\Markdown\Html\Block;

use Inwebo\Markdown\Model\Enum\NodeType;

class H2 extends AbstractHtmlTag
{
    public function __construct(NodeType $type = NodeType::H2)
    {
        parent::__construct($type);
    }
}
