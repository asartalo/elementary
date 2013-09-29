<?php

namespace Elementary;

/**
 * Builds HTML elements
 */
class Element
{
    private $name;

    private $attributes = array();

    private $defaults = array(
        'attributes' => array(),
        'contents'   => array(),
        'empty'      => false
    );

    /**
     * Constructor
     *
     * @param string $name    the tag name of the element
     * @param array  $options an associative array of attribute and values
     */
    public function __construct($name, array $options = array())
    {
        $this->name = $name;
        $options = array_merge($this->defaults, $options);
        $this->attributes = $options['attributes'];
        $this->contents = $options['contents'];
        $this->isEmpty = $options['empty'];
    }

    /**
     * Static helper for calling the method directly without resorting to reflection
     *
     * @param string $name    the tag name of the element
     * @param array  $options an associative array of attribute and values
     *
     * @return Element an instance of Element
     */
    public static function getNew($name, $options)
    {
        return new Element($name, $options);
    }

    /**
     * @return string the string representation of the element
     */
    public function __toString()
    {
        $attributes = $this->renderAttributes();
        $contents = $this->renderContents();

        if ($this->isEmpty) {
            return "<{$this->name}{$attributes} />";
        }

        return "<{$this->name}{$attributes}>$contents</$this->name>";
    }

    protected function renderAttributes()
    {
        $output = "";
        foreach ($this->attributes as $attr => $value) {
            $escapedValue = htmlspecialchars($value);
            $output .= " $attr=\"$escapedValue\"";
        }

        return $output;
    }

    protected function renderContents()
    {
        $output = "";
        foreach ($this->contents as $content) {
            if ($content instanceof Element) {
                $escaped = "$content";
            } else {
                $escaped = htmlspecialchars($content, ENT_NOQUOTES);
            }
            $output .= $escaped;
        }

        return $output;
    }

}