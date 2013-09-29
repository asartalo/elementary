Elementary
==========

[![Build Status](https://secure.travis-ci.org/asartalo/elementary.png)](http://travis-ci.org/asartalo/elementary)


An HTML generator for PHP.


The following example code:

```php
<?php
$el = new Elementary\ElementBuilder;

echo
$el->html(
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

?>
```

Produces the following structure *without the indentation and line-breaks*.

```html
<html>
    <head>
        <meta charset="utf-8" />
        <title>Elementary Example</title>
    </head>
    <body>
        <h1>Elementary Demonstration &amp; Examples</h1>
        <div id="contents">
            <p>This is an example paragraph.</p>
        </div>
    </body>
</html>

```

Caveats
-------

- Default serialization is xml (i.e. it looks like XHTML with empty elements closed with '/')
- Does not create comments
- Right now, Elementary produces 'ugly' HTML. 'Ugly' means no line-breaks and no indentations.
- To force a leading or trailing space, you can add an empty space (' ') before or after the elements


FAQ
---

*Q. Is it fast?*

Don't know. Haven't benchmarked it. I don't think it is but it's fast enough for me.