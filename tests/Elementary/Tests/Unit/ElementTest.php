<?php

namespace Elementary\Tests\Unit;

use Elementary\Element;
use Asar\TestHelper\TestCase;

/**
 * Elementary\Element specifications
 */
class ElementTest extends TestCase
{


    /**
     * Basic element generation
     */
    public function testBasicElementGeneration()
    {
        $foo = new Element('foo');

        $this->assertEquals('<foo></foo>', "$foo");
    }

    /**
     * Attributes
     */
    public function testAddingAttributes()
    {
        $span = new Element('span', array(
            'attributes' => array('id' => 'foo', 'class' => 'bar')
        ));

        $this->assertEquals('<span id="foo" class="bar"></span>', "$span");
    }

    /**
     * Attribute escaping
     */
    public function testAttributesShouldBeEscapedProperly()
    {
        $span = new Element('span', array(
            'attributes' => array('title' => "Ain't <nothing> on \"me\".")
        ));

        $this->assertEquals('<span title="Ain\'t &lt;nothing&gt; on &quot;me&quot;."></span>', "$span");
    }

    /**
     * Contents
     */
    public function testAddingContents()
    {
        $span = new Element('span', array(
            'contents' => array('Hello ', 'World')
        ));

        $this->assertEquals('<span>Hello World</span>', "$span");
    }

    /**
     * Content escaping
     */
    public function testContentShouldBeEscaped()
    {
        $span = new Element('span', array(
            'contents' => array('<happy>"Hi & Welcome!"</happy>')
        ));

        $this->assertEquals('<span>&lt;happy&gt;"Hi &amp; Welcome!"&lt;/happy&gt;</span>', "$span");
    }

    /**
     * Can contain other elements
     */
    public function testCanContainOtherElements()
    {
        $em = new Element('em', array(
            'contents' => array('Hello')
        ));
        $span = new Element('span', array(
            'contents' => array($em, ' World!')
        ));

        $this->assertEquals('<span><em>Hello</em> World!</span>', "$span");
    }

    /**
     * Can create empty elements
     */
    public function testCreateEmptyElement()
    {
        $br = new Element('br', array(
            'empty' => true
        ));

        $this->assertEquals('<br />', "$br");
    }

}