<?php
namespace Sirius\Forms\Html;

class MultiSelect extends Select
{

    protected $tag = 'select';

    protected $isSelfClosing = false;

    /**
     * Generates the string with the list of the <OPTIONS> elements
     *
     * @return string
     */
    protected function getOptionsString()
    {
        $value = $this->getValue();
        $options = '';
        if ($this->getData('first_option')) {
            $options .= sprintf('<option value="">%s</option>', $this->getData('first_option'));
        }
        foreach ($this->getData('options') as $k => $v) {
            $selected = '';
            // be flexible, accept a non-array value
            if ((is_string($value) && $k == $value) || (is_array($value) && in_array($k, $value))) {
                $selected = 'selected="selected"';
            }
            $options .= sprintf('<option value="%s" %s>%s</option>', htmlentities($k, ENT_COMPAT), $selected, $v);
        }
        return $options;
    }

    function render()
    {
        $name = $this->getAttribute('name');
        if (substr($name, -2) != '[]') {
            $this->setAttribute('name', $name . '[]');
        }
        return parent::render();
    }
}