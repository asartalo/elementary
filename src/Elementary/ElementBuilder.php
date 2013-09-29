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

        if (strpos($name, '_') == strlen($name) - 1) {
            $options['empty'] = true;
            $name = rtrim($name, '_');
        }

        foreach ($arguments as $content) {
            $options['contents'][] = $content;
        }

        return Element::getNew($name, $options);
    }

}