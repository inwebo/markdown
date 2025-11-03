<?php

declare(strict_types=1);

namespace Inwebo\Markdown\Tests\Fixtures\Model;

use Inwebo\Markdown\Model\Enum\NodeType;
use Inwebo\Markdown\Parser;
use Inwebo\Markdown\Token\Token;

trait HasParserTrait
{
    public function getParser(): Parser
    {
        return new Parser(
            new Token(NodeType::PARAGRAPH),
            new Token(NodeType::UL),
            new Token(NodeType::OL),
            new Token(NodeType::HR),
            new Token(NodeType::H1),
            new Token(NodeType::H2),
            new Token(NodeType::H3),
            new Token(NodeType::H4),
            new Token(NodeType::H5),
            new Token(NodeType::H6),
            new Token(NodeType::BLOCKQUOTE),
            new Token(NodeType::BOLD),
            new Token(NodeType::ITALIC),
            new Token(NodeType::STRIKETHROUGH),
            new Token(NodeType::LINK),
            new Token(NodeType::IMAGE),
        );
    }
}
