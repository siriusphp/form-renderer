# Sirius Form Renderer

[![Source Code](http://img.shields.io/badge/source-siriusphp/form--renderer-blue.svg?style=flat-square)](https://github.com/siriusphp/form-renderer)
[![Latest Version](https://img.shields.io/packagist/v/siriusphp/form-renderer.svg?style=flat-square)](https://github.com/siriusphp/form-renderer/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](https://github.com/siriusphp/form-renderer/blob/master/LICENSE)
[![Build Status](https://img.shields.io/travis/siriusphp/form-renderer/master.svg?style=flat-square)](https://travis-ci.org/siriusphp/form-renderer)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/siriusphp/form-renderer.svg?style=flat-square)](https://scrutinizer-ci.com/g/siriusphp/form-renderer/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/g/siriusphp/form-renderer.svg?style=flat-square)](https://scrutinizer-ci.com/g/siriusphp/form-renderer)

Sirius\FormsRenderer is a library that renders [Sirius\InputFilter](http://www.sirius.ro/php/sirius/input/) objects as forms using the [Sirius\Html](http://www.sirius.ro/php/sirius/html/) library.

##Elevator pitch

```php
$form = new \Sirius\Input\InputFilter();

$form->add('name', [
	'type' => 'text',
	'label' => 'Name',
	'rules' => ['required']
]);
$form->add('email', [
	'type' => 'text',
	'label' => 'Email',
	'rules' => ['required', 'email']
]);
$form->add('message', [
	'type' => 'textarea',
	'label' => 'Message',
	'hint' => 'Please write in detail the problem you are facing',
	'rules' => ['required']
]);
$form->add('recaptcha', [
	'type' => 'recaptch',
	'label' => 'Are you human or are you dancer?'
]);
$form->add('submit', [
	'type' => 'submit',
	'label' => 'Send request'
]);

$r = new \Sirius\FormsRenderer\Renderer;

echo $r->render($form);
```

For actual code examples you can check out the [Form Examples repository](https://github.com/siriusphp/form-examples)