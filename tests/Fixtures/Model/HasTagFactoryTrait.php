<?php

declare(strict_types=1);

namespace Inwebo\Markdown\Tests\Fixtures\Model;

use Inwebo\Markdown\Html\Block\Blockquote;
use Inwebo\Markdown\Html\Block\H1;
use Inwebo\Markdown\Html\Block\H2;
use Inwebo\Markdown\Html\Block\H3;
use Inwebo\Markdown\Html\Block\H4;
use Inwebo\Markdown\Html\Block\H5;
use Inwebo\Markdown\Html\Block\H6;
use Inwebo\Markdown\Html\Block\Hr;
use Inwebo\Markdown\Html\Block\Ol;
use Inwebo\Markdown\Html\Block\Paragraph;
use Inwebo\Markdown\Html\Block\Ul;
use Inwebo\Markdown\Html\Inline\Bold;
use Inwebo\Markdown\Html\Inline\Image;
use Inwebo\Markdown\Html\Inline\Italic;
use Inwebo\Markdown\Html\Inline\Link;
use Inwebo\Markdown\Html\Inline\Strikethrough;
use Inwebo\Markdown\Html\TagFactory;

trait HasTagFactoryTrait
{
    public function getTagFactory(): TagFactory
    {
        return new TagFactory(
            new Paragraph(),
            new H1(),
            new H2(),
            new H3(),
            new H4(),
            new H5(),
            new H6(),
            new Ul(),
            new Ol(),
            new Hr(),
            new Blockquote(),
            new Strikethrough(),
            new Bold(),
            new Italic(),
            new Link(),
            new Image(),
        );
    }
}
