<?php namespace Silverplate\Form;

class TextareaField extends Field {
    public function __toString() {
        return sprintf('<textarea class="%s" name="%s" id="%s">%s</textarea>', $this->classes, $this->key, $this->key, $this->get($this->initial));
    }
}

