<?php namespace Silverplate\Form;

class TextareaField extends Field {
    public function __toString() {
        return sprintf('<textarea name="%s" id="%s">%s</textarea>', $this->key, $this->key, $this->get($this->initial));
    }
}

