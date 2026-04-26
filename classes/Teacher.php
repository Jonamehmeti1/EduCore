<?php

require_once __DIR__ . '/Person.php';

class Teacher extends Person {
    private $subject;
    private $isActive;

    public function __construct($id, $name, $email, $subject, $isActive) {
        parent::__construct($id, $name, $email);
        $this->subject = $subject;
        $this->isActive = $isActive;
    }

    public function getSubject() {
        return $this->subject;
    }

    public function getIsActive() {
        return $this->isActive;
    }

    public function setSubject($subject) {
        $this->subject = $subject;
    }

    public function setIsActive($isActive) {
        $this->isActive = $isActive;
    }

    public function getTeacherInfo() {
        $status = $this->isActive ? "Aktiv" : "Jo aktiv";
        return $this->getInfo() . " | Lënda: " . $this->subject . " | Statusi: " . $status;
    }
}