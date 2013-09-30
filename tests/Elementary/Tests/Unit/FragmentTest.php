<?php

namespace Elementary\Tests\Unit;

use Elementary\Element;
use Elementary\Fragment;
use Asar\TestHelper\TestCase;

/**
 * Elementary\Fragment specifications
 */
class FragmentTest extends TestCase
{

    /**
     * Setup
     */
    public function setUp()
    {
        $this->fragment = new Fragment();
    }

    /**
     * Default rendering
     */
    public function testFragmentRendersNothingWhenEmpty()
    {
        $this->assertEquals('', "$this->fragment");
    }

    /**
     * Container
     */
    public function testCanContainElements()
    {
        $elementA = new Element('foo');
        $elementB = new Element('bar');
        $this->fragment->add($elementA, $elementB);

        $this->assertEquals('<foo></foo><bar></bar>', "$this->fragment");
    }

    /**
     * Container on construction
     */
    public function testCanContainElementsOnConstruction()
    {
        $elementA = new Element('foo');
        $elementB = new Element('bar');
        $this->fragment = new Fragment($elementA, $elementB);

        $this->assertEquals('<foo></foo><bar></bar>', "$this->fragment");
    }
}