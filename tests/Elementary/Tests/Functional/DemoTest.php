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
        $this->output = $el->html(
            $el->head(
                $el->meta_(array('charset'=> 'utf-8')),
                $el->title('Elementary Example')
            ),
            $el->body(
                $el->_( // Fragment
                    $el->h1('Elementary Demonstration & Examples'),
                    $el->div(
                        array('id' => 'contents'),
                        $el->p('This is an example paragraph.')
                    )
                )
            )
        );

        $this->htmlString = "{$this->output}";
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
        // If you're wondering why this is necessary,
        // see this: http://stackoverflow.com/questions/2354609/strict-standards-only-variables-should-be-passed-by-reference
        $titles = $html('html title');
        $title = $titles[0];
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
        $metas = $html('html head meta');
        $meta = $metas[0];
        $this->assertStringEndsWith(' />', $meta->html(), $this->htmlString);
    }

    /**
     * Output escaping
     */
    public function testTextIsEscaped()
    {
        $html = $this->htmlDom;
        $h1s = $html('html body > h1');
        $h1 = $h1s[0];
        $this->assertEquals(
            '<h1>Elementary Demonstration &amp; Examples</h1>',
            $h1->html(), $h1->html()
        );
    }

    /**
     * Rendering
     */
    public function testRendering()
    {
        $this->assertEquals($this->htmlString, $this->output->render());
    }
}