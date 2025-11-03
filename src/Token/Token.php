<?php

declare(strict_types=1);

namespace Inwebo\Markdown\Token;

use Inwebo\Markdown\Model\Enum\NodeType;

readonly class Token
{
    public function __construct(
        private NodeType $type,
    ) {
    }

    public function getRegex(): string
    {
        return '/'.$this->type->value.'/im';
    }

    public function getType(): NodeType
    {
        return $this->type;
    }

    public function isBlock(): bool
    {
        return in_array($this->type, [
            NodeType::UL,
            NodeType::OL,
            NodeType::BLOCKQUOTE,
            NodeType::PARAGRAPH,
            NodeType::HR,
            NodeType::H1,
            NodeType::H2,
            NodeType::H3,
            NodeType::H4,
            NodeType::H5,
            NodeType::H6,
        ]);
    }

    public function isInline(): bool
    {
        return !$this->isBlock();
    }
}
