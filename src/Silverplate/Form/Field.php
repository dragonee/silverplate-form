<?php namespace Silverplate\Form;

class Field {
    protected
        $required = false,
        $key,
        $name,
        $type,
        $classes,
        $validator;

    public 
        $error = null,
        $label = null;

    public function __construct($label, $required=false, $initial='') {
        $this->label = $label;
        $this->required = $required;
        $this->initial = $initial;
    }

    public static function make($label, $required=false, $initial='') {
        return new static($label, $required, $initial);
    }

    public function required() {
        return (bool) $this->required;
    }

    public function bind($key) {
        $this->key = $key;

        return $this;
    }

    public function key() {
        return $this->key;
    }

    public function has() {
        return isset($_POST[$this->key]) && trim($_POST[$this->key]);
    }

    public function validate($func) {
        $this->validator = $func;

        return $this;
    }

    public function check() {
        if($this->validator) {
            $this->error = call_user_func($this->validator, $this->get());

            return !$this->error;
        }

        return true;
    }

    public function get($default=null) {
        if($this->has()) {
            return $_POST[$this->key];
        }

        return $default;
    }

    public function repr() {
        return $this->get();
    }

    public function label() {
        return sprintf('<label for="%s">%s</label>', $this->key, $this->label);
    }

    public function addClass($class) {
        $this->classes .= " $class";

        return $this;
    }

    public function __toString() {
        return sprintf('<input type="%s" class="%s" name="%s" id="%s" value="%s">', $this->type, $this->classes, $this->key, $this->key, $this->get($this->initial));
    }
}

