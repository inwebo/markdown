# PHP Markdown
![GitHub Actions Workflow Status](https://img.shields.io/github/actions/workflow/status/inwebo/markdown/.github%2Fworkflows%2Flibrary.yml?branch=master&style=flat-square)
![Packagist Version](https://img.shields.io/packagist/v/inwebo/markdown?style=flat-square)
![Packagist Downloads](https://img.shields.io/packagist/dd/inwebo/markdown?style=flat-square)

## Introduction

**PHP Markdown** is a lightweight library written in PHP that parses Markdown syntax into HTML. It aims to provide a simple, efficient tokenizer and parser that adheres closely to standard Markdown specifications, making it ideal for developers who want full control over their Markdown rendering pipeline.

## Installation

```bash
composer require inwebo/markdown
```

## Usage

```php
<?php

declare(strict_types=1);

use Inwebo\Markdown\Model\Enum\NodeType;
use Inwebo\Markdown\Parser;
use Inwebo\Markdown\Token\Token;
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
use Inwebo\Markdown;

        $parser = new Parser(
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

        $tagFactory = new TagFactory(
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

        $factory = new Markdown\Factory($parser, $tagFactory);
        
        $html = $factory->render('# Hello World!');
        echo $html; // <h1>Hello World!</h1>
```

## Links
* https://isagi.in/blog/tokenizer-parser/
* https://www.markdownlang.com/fr/basic/paragraphs.html
* https://dev.to/ndesmic/writing-a-tokenizer-1j85
* https://onlinemarkdown.com/
* https://stackoverflow.com/a/64451918