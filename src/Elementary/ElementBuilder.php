<?php

namespace Elementary;

/**
 * Builds HTML elements
 */
class ElementBuilder
{
    /**
     * Constructor
     *
     * @param array $options builder options
     */
    public function __construct(array $options = array())
    {
        //
    }


    /**
     * Magic call
     *
     * @param string $name      name of the element/tag
     * @param array  $arguments the arguments
     *
     * @return Element
     */
    public function __call($name, $arguments = array())
    {
        $options = array('contents' => array());

        if (is_array($arguments[0])) {
            $options['attributes'] = array_shift($arguments);
        }

        if ($this->_isEmpty($name)) {
            $options['empty'] = true;
            $name = rtrim($name, '_');
        }

        foreach ($arguments as $content) {
            $options['contents'][] = $content;
        }

        return new Element($name, $options);
    }

    protected function _isEmpty($name)
    {
        $length = strlen($name);

        return $length > 1 && strpos($name, '_') == strlen($name) - 1;
    }

    /**
     * Creates an element fragment
     *
     * @return Fragment
     */
    public function _()
    {
        $contents = func_get_args();
        $fragment = new Fragment();
        foreach ($contents as $content) {
            $fragment->add($content);
        }

        return $fragment;
    }

}