<?php

namespace Elementary\Tests\Functional;

use Elementary\ElementBuilder;
use Asar\TestHelper\TestCase;

/**
 * Demonstration
 */
class DemoTest extends TestCase
{

    /**
     * Setup
     */
    public function setUp()
    {
        $this->builder = new ElementBuilder;

        $el = $this->builder;
        $output = $el->html(
            $el->head(
                $el->meta_(array('charset'=> 'utf-8')),
                $el->title('Elementary Example')
            ),
            $el->body(
                $el->h1('Elementary Demonstration & Examples'),
                $el->div(
                    array('id' => 'contents'),
                    $el->p('This is an example paragraph.')
                )
            )
        );

        $this->htmlString = "$output";
        $this->htmlDom = str_get_dom($this->htmlString);
    }

    /**
     * Sanity check
     */
    public function testHtmlElmentIsPresent()
    {
        $this->assertStringStartsWith("<html>", $this->htmlString);
        $this->assertStringEndsWith("</html>", $this->htmlString);
    }

    /**
     * Head element
     */
    public function testHeadElementIsCreated()
    {
        $html = $this->htmlDom;
        $this->assertCount(1, $html('html head'), $this->htmlString);
    }

    /**
     * Title
     */
    public function testTitleElementIsCreated()
    {
        $html = $this->htmlDom;
        $title = array_shift($html('html title'));
        $this->assertEquals(
            'Elementary Example', $title->getPlainText(), $this->htmlString
        );
    }

    /**
     * Empty Element Meta
     */
    public function testEmptyMetaElementIsCreated()
    {
        $html = $this->htmlDom;
        $this->assertCount(1, $html('html head meta'), $this->htmlString);
        $meta = array_shift($html('html head meta'));
        $this->assertStringEndsWith(' />', $meta->html(), $this->htmlString);
    }

    /**
     * Output escaping
     */
    public function testTextIsEscaped()
    {
        $html = $this->htmlDom;
        $h1 = array_shift($html('html body h1'));
        $this->assertEquals(
            '<h1>Elementary Demonstration &amp; Examples</h1>',
            $h1->html(), $h1->html()
        );
    }
}