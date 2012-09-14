<?php

class Field {
    protected
        $required = false,
        $key,
        $name,
        $type,
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

    public function has() {
        return isset($_POST[$this->key]) && trim($_POST[$this->key]);
    }

    public function validate($func) {
        $this->validator = $func;
    }

    public function check() {
        if($this->validator) {
            $this->error = call_user_func($this->validator, $this->get());

            return (bool) $this->error;
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

    public function __toString() {
        return sprintf('<input type="%s" name="%s" id="%s" value="%s">', $this->type, $this->key, $this->key, $this->get($this->initial));
    }
}

class TextField extends Field {
    protected $type = 'text';
}

// initial
class BooleanField extends Field {
    protected $type = 'checkbox';

    public function has() {
        return true;
    }

    public function get($default=null) {
        return isset($_POST[$this->key]);
    }

    public function repr() {
        return $this->get() ? 'Tak': 'Nie';
    }
}

class TextareaField extends Field {
    public function __toString() {
        return sprintf('<textarea name="%s" id="%s">%s</textarea>', $this->key, $this->key, $this->get($this->initial));
    }
}

class ChoiceField extends Field {
    public function choices($array) {
    }

    public function __toString() {
    }
}

class Form implements IteratorAggregate {
    private 
        $fields = array();

    public function add($key, $field) {
        $this->fields[] = $field->bind($key);
    }

    public function getIterator() {
        return new ArrayIterator($this->fields);
    }

    public function valid() {
        $errors = false;

        foreach($this as $field) {
            if($field->required() && !$field->has()) {
                $field->error = 'To pole jest wymagane';
                $errors = true;
            }

            if($field->has() && !$field->check()) {
                $errors = true;
            }
            print_r($field);
        }

        return !$errors;
    }

    public function get($name) {
        if(!isset($this->fields[$name])) {
            return null;
        }
        
        return $this->fields[$name];
    }
}