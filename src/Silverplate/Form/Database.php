<?php namespace Silverplate\Form;

class Database {
    public static function make($dsn, $username, $password, $options) {
        $this->pdo = new \PDO($dsn, $username, $password, $options);
    }

    public function save_form($form, $table) {
        $bindings = array();
        $keys = array();

        foreach($form as $field) {
            $keys[] = $field->key();
            $bindings[] = $field->get();
        }

        $fields = join(', ', $keys);
        $placeholders = rtrim(str_repeat('?, ', count($keys)), ', ');

        $query = "INSERT INTO $table ($fields) VALUES($placeholders)";

        $this->pdo->prepare($query)->execute($bindings);
    }
}
