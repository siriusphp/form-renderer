---
title: Form Widget Decorators
-----------------------------

# Widget Decorators

The decorators allow you to alter the aspect of the form without changing the code of the widget. Here are some scenarios for using decorators:

1. Adding an `id` attribute for fields (the library already comes with such an [auto ID decorator](https://github.com/siriusphp/form-renderer/blob/master/src/Decorator/AutoId.php))
2. Adding CSS classes to various tags (labels, error messages etc) so that the form displays as you want
3. Translating the form (labels, placeholders, hints, error messages)
4. Adding client side validation via custom attributes for each input or adding a `SCRIPT` tag after the form which initializes the validation procedure

You can see samples for these scenarios in the [form examples repo](https://github.com/siriusphp/form-examples/tree/master/src/FormRenderer/Decorator)
