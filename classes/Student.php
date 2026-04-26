<?php

require_once __DIR__ . '/Person.php';

class Student extends Person {
    private $grade;
    private $average;

    public function __construct($id, $name, $email, $grade, $average) {
        parent::__construct($id, $name, $email);
        $this->grade = $grade;
        $this->average = $average;
    }

    public function getGrade() {
        return $this->grade;
    }

    public function getAverage() {
        return $this->average;
    }

    public function setGrade($grade) {
        $this->grade = $grade;
    }

    public function setAverage($average) {
        $this->average = $average;
    }

    public function getStudentInfo() {
        return $this->getInfo() . " | Klasa: " . $this->grade . " | Mesatarja: " . $this->average;
    }
}