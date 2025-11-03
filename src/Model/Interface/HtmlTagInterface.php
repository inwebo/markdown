<?php

declare(strict_types=1);

namespace Inwebo\Markdown\Model\Interface;

use Inwebo\Markdown\Model\Enum\NodeType;
use Inwebo\Markdown\Node\Node;

interface HtmlTagInterface
{
    public function getTokenType(): NodeType;

    public function sanitize(Node $node): string;

    public function getHtml(Node $node): string;
}
