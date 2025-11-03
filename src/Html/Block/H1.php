<?php

declare(strict_types=1);

namespace Inwebo\Markdown\Html\Block;

use Inwebo\Markdown\Model\Enum\NodeType;

class H1 extends AbstractHtmlTag
{
    public function __construct(NodeType $type = NodeType::H1)
    {
        parent::__construct($type);
    }
}
