<?php

declare(strict_types=1);

namespace Inwebo\Markdown\Model\Enum;

enum ParserType
{
    case BOTH;
    case INLINE;
    case BLOCK;
}
