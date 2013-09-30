<?php

namespace Elementary;

/**
 * Represents an HTML Fragment
 */
class Fragment extends Element
{

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->contents = func_get_args();
    }

    /**
     * @return string the string representation of the fragment
     */
    public function render()
    {
        $contents = $this->renderContents();

        return "{$contents}";
    }

    /**
     * Adds content
     */
    public function add()
    {
        $contents = func_get_args();

        foreach ($contents as $content) {
            $this->contents[] = $content;
        }
    }

}