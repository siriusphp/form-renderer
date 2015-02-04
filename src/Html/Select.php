<?php
namespace Sirius\Forms\Html;

class Select extends Input
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
            if ((is_string($value) && $k == $value) || (is_array($value) && in_array($k, $value))) {
                $selected = 'selected="selected"';
            }
            $options .= sprintf('<option value="%s" %s>%s</option>', htmlentities($k, ENT_COMPAT), $selected, $v);
        }
        return $options;
    }

    function render()
    {
        $template = '<select%s>%s</select>';
        $before = '';
        foreach ($this->before as $item) {
            $before .= (string)$item;
        }
        $after = '';
        foreach ($this->after as $item) {
            $after .= (string)$item;
        }
        return $before . sprintf($template, $this->getAttributesString(), $this->getOptionsString()) . $after;
    }
}
