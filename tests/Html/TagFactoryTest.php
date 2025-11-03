<?php

declare(strict_types=1);

namespace Inwebo\Markdown\Tests\Html;

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
use Inwebo\Markdown\Tests\Fixtures\Model\HasParserTrait;
use Inwebo\Markdown\Tests\Fixtures\Model\HasTagFactoryTrait;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(TagFactory::class)]
#[CoversClass(H1::class)]
#[CoversClass(H2::class)]
#[CoversClass(H3::class)]
#[CoversClass(H4::class)]
#[CoversClass(H5::class)]
#[CoversClass(H6::class)]
#[CoversClass(Ol::class)]
#[CoversClass(Ul::class)]
#[CoversClass(Paragraph::class)]
#[CoversClass(Blockquote::class)]
#[CoversClass(Hr::class)]
#[CoversClass(Bold::class)]
#[CoversClass(Italic::class)]
#[CoversClass(Strikethrough::class)]
#[CoversClass(Link::class)]
#[CoversClass(Image::class)]
class TagFactoryTest extends TestCase
{
    use HasParserTrait;
    use HasTagFactoryTrait;

    public function testFactory(): void
    {
        $parser = $this->getParser();
        $tagFactory = $this->getTagFactory();

        $node = $parser->parse('# H1')->getIterator()->current();
        $tag = $tagFactory->toHtml($node);
        $this->assertEquals('<h1>H1</h1>'."\n", $tag);

        $node = $parser->parse('## H2')->getIterator()->current();
        $tag = $tagFactory->toHtml($node);
        $this->assertEquals('<h2>H2</h2>'."\n", $tag);

        $node = $parser->parse('### H3')->getIterator()->current();
        $tag = $tagFactory->toHtml($node);
        $this->assertEquals('<h3>H3</h3>'."\n", $tag);

        $node = $parser->parse('#### H4')->getIterator()->current();
        $tag = $tagFactory->toHtml($node);
        $this->assertEquals('<h4>H4</h4>'."\n", $tag);

        $node = $parser->parse('##### H5')->getIterator()->current();
        $tag = $tagFactory->toHtml($node);
        $this->assertEquals('<h5>H5</h5>'."\n", $tag);

        $node = $parser->parse('###### H6')->getIterator()->current();
        $tag = $tagFactory->toHtml($node);
        $this->assertEquals('<h6>H6</h6>'."\n", $tag);

        $node = $parser->parse('* ol')->getIterator()->current();
        $tag = $tagFactory->toHtml($node);
        $this->assertEquals('<ol>'."\n\t".'<li>ol</li>'."\n".'</ol>'."\n", $tag);

        $node = $parser->parse('- ul')->getIterator()->current();
        $tag = $tagFactory->toHtml($node);
        $this->assertEquals('<ul>'."\n\t".'<li>ul</li>'."\n".'</ul>'."\n", $tag);

        $node = $parser->parse('Paragraph')->getIterator()->current();
        $tag = $tagFactory->toHtml($node);
        $this->assertEquals('<p>'."\n\t".'Paragraph'."\n".'</p>'."\n", $tag);

        $node = $parser->parse('> Blockquote')->getIterator()->current();
        $tag = $tagFactory->toHtml($node);
        $this->assertEquals('<blockquote>'."\n\t".'Blockquote'."\n".'</blockquote>'."\n", $tag);

        $node = $parser->parse('---')->getIterator()->current();
        $tag = $tagFactory->toHtml($node);
        $this->assertEquals('<hr>'."\n", $tag);

        $nodeCollection = $parser->parse('**bold**');
        $node = $nodeCollection->getIterator()->current();
        $nodeCollection = $parser->parse($node);
        $node = $nodeCollection->getIterator()->current();

        $tag = $tagFactory->toHtml($node);
        $this->assertEquals('<b>bold</b>', $tag);

        $nodeCollection = $parser->parse('*italic*');
        $node = $nodeCollection->getIterator()->current();
        $nodeCollection = $parser->parse($node);
        $node = $nodeCollection->getIterator()->current();

        $tag = $tagFactory->toHtml($node);
        $this->assertEquals('<i>italic</i>', $tag);

        $nodeCollection = $parser->parse('~~strikethrough~~');
        $node = $nodeCollection->getIterator()->current();
        $nodeCollection = $parser->parse($node);
        $node = $nodeCollection->getIterator()->current();

        $tag = $tagFactory->toHtml($node);
        $this->assertEquals('<del>strikethrough</del>', $tag);

        $nodeCollection = $parser->parse('[Link](./relative)');
        $node = $nodeCollection->getIterator()->current();
        $nodeCollection = $parser->parse($node);
        $node = $nodeCollection->getIterator()->current();

        $tag = $tagFactory->toHtml($node);
        $this->assertEquals('<a href="./relative">Link</a>', $tag);

        $nodeCollection = $parser->parse('![Link](./href)');
        $node = $nodeCollection->getIterator()->current();
        $nodeCollection = $parser->parse($node);
        $node = $nodeCollection->getIterator()->current();

        $tag = $tagFactory->toHtml($node);
        $this->assertEquals('<img src="./href" title="Link">', $tag);
    }

    public function testUnknownFactory(): void
    {
        $node = $this->getParser()->parse('# H1')->getIterator()->current();
        $factory = new TagFactory();
        $this->expectException(\UnexpectedValueException::class);
        $factory->getFactoryHtmlTag($node);
    }
}
