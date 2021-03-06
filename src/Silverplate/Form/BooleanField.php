<?php namespace Silverplate\Form;

class BooleanField extends Field {
    protected $type = 'checkbox';

    public function has() {
        return true;
    }

    public function get($default=null) {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            return isset($_POST[$this->key]);
        }

        return $this->initial;
    }

    public function repr() {
        return $this->get() ? get('translation-yes', 'Yes'): get('translation-no', 'No');
    }
    
    public function __toString() {
        return sprintf('<input type="%s" class="%s" name="%s" id="%s" value="1" %s>', $this->type, $this->classes, $this->key, $this->key, $this->get($this->initial) ? 'checked' : '');
    }
}

