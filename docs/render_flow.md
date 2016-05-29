---
title: Render flow
------------------

The Sirius\FormsRenderer library uses the [Sirius\Html](http://www.sirius.ro/php/sirius/html/) library to generate the HTML which has a very small API inspired by React and jQuery.

The Sirius\Html library allows you to output HTML like so

```php

$h = new \Sirius\Html\Builder;

echo $h->make(
    'article',
    ['class' => 'post post-123 post-story'], 
    [
        ['heading', $post->post_name],
        ['section', $post->content],
        ['footer', 'Written by ' . $post->author],
        ['aside', [
            ['h3', 'Similar articles'],
            ['ul', [
                // ... you can guess what happens here 
            ]]
        ]]
    ] 
);

```

The process of turning a `Sirius\Input\InputFilter` into a form goes through the following stages

## 1. Constructing a tree

The Sirius\Input library allows form elements to be grouped visually in a specific containers so the first step is to transform the structure of the form elements into a nodes tree that can be used by a Sirius\Html builder to output HTML tags. The result of constructing the tree is a list of nodes that have the following structure

```php
array(
    '_form' => $the_input_filter_instance,
    '_element' => $the_input_filter_element_attached_to_this_node,
    '_name' => $the_name_of_the_element_attached_to_this_node,
    '_children' => $array_containing_the_children_of_the_element
);

```

## 2. The renderer creates widgets for each node in the tree

The form renderer (ie: a special instance of a \Sirius\Html\Builder object) has registered a list of custom elements called **widgets** which, based on the node creates actual \Sirius\Html\Tag objects.

The library comes with a set of predefined widgets:

- Button, Submit, Reset - for buttons
- Text, Email, Number, Password, Textarea - for text input
- Select, Multiselect, Checkbox, Checkboxset, Radioset - for choice-based input
- Group, Fieldset - to contain a set of widgets
- Form

The `Sirius\FormRenderer\Widget\Password` is registered in the builder as `widget-password` and the output of the build is the same as calling

```php
$formRenderer->make('widget-password', array(
    '_form' => $someInputFilterInstance,
    '_element' => $someInputFilterInstance->get('password'),
    '_name' => 'password'
));
```

## 3. The tags get decorated

The renderer can have decorators attached to it which will process every HTML tag generated. It is very important to understand that each tag is passed to all decorators so your decorator should know what type of tag is handling. If your decorator only check if the HTML tag name is 'LABEL' all `<label>` will be altered by the decorator, no matter the context.  