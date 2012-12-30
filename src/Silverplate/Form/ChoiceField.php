<?php namespace Silverplate\Form;

class ChoiceField extends Field {
    protected $choices = array();

    public function choices(array $array) {
        $this->choices = $array;

        return $this;
    }

    public function __toString() {
        $current_value = $this->get($this->initial);
        $options = '';

        foreach($this->choices as $value => $description) {
            // numeric arrays
            if(!is_string($value)) {
                $value = $description;
            }

            $selected = '';
            if($current_value == $value) {
                $selected = 'selected';
            }

            $options .= sprintf('<option value="%s" %s>%s</option>', $value, $selected, $description);
        }

        return sprintf('<select name="%s" id="%s">%s</select>', $this->key, $this->key, $options);
    }
}

