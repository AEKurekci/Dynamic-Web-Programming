<?php
class Student{
    public $name;
    public $id;
    function __construct(){
        $this->$name = "Ali";
        $this->$id = 1;
    }

    public function GetInfo(){
        return $this->$name. " " . $this->$id;
    }
}

class GradStudent extends Student{
    function GradMessage(){
        print "I am the graduated student!";
    }
}
$student = new Student();
print $student->GetInfo();
$gradStudent = new GradStudent();
$gradStudent->GradMessage();
print $gradStudent->GetInfo();

?>