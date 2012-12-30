<?php namespace Silverplate;

class Form implements \IteratorAggregate {
    private 
        $fields = array();

    public function add($key, $field) {
        $this->fields[] = $field->bind($key);
    }

    public function getIterator() {
        return new \ArrayIterator($this->fields);
    }

    public function valid() {
        $errors = false;

        foreach($this as $field) {
            if($field->required() && !$field->has()) {
                $field->error = get('required', 'This field is required.'));
                $errors = true;
            }

            if($field->has() && !$field->check()) {
                $errors = true;
            }
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
