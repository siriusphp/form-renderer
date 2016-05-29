---
title: Form Widgets
---

# Form Widgets (aka form controls, aka form elements)

Because the `Sirius\FormRenderer` library relies on `Sirius\Html` to output HTML forms and since `Sirius\Html` only knows how to work with tags (or components) the Sirius\FormRenderer builder object comes with a set of widgets which are able to convert the nodes from the tree (see [the render flow process](render_flow.md)) into HTML.
 
The widgets are registered as custom components with the prefix `widget-`. If your InputFilter element has the "widget" property set to "select" then the `widget-select` will be used for rendering.

Most widgets extend the `AbstractWidget` class because most form elements have the same structure: a label, an input, a hint (instructions for filling it out), an error message (where applicable) etc.

Below is the code for the `Sirius\FormRenderer\Widget\Select` class to demonstrate how easy it is to create your own widgets.

```php
namespace Sirius\FormRenderer\Widget;

use \Sirius\Input\Specs;
use \Sirius\Html\Tag\Select as SelectTag;

class Select extends AbstractWidget
{

    protected $inputTag = 'select';

    protected function getInputProps()
    {
        // $props is the container of the properties (attributes and other properties) of the input part of the widget
        $props = parent::getInputProps(); 

        // now we add the necessary data required by that tag to render the list of options
        $props['_first_option'] = $this->get('_element')->get(Specs::FIRST_CHOICE);
        $props['_options'] = $this->get('_element')->get(Specs::CHOICES);

        return $props;
    }

}
```

Here is the code for `Sirius\FormRenderer\Widget\Multiselect` which extends the `Sirius\FormRenderer\Widget\Select` class

```php
namespace Sirius\FormRenderer\Widget;

use \Sirius\Input\Specs;
use \Sirius\Html\Tag\MultiSelect as MultiselectTag;

class Multiselect extends Select
{

    protected $inputTag = 'multiselect';

    public function getInputProps()
    {
        $props = parent::getInputProps();
        $props['multiple'] = 'multiple';

        return $props;
    }

}
```
