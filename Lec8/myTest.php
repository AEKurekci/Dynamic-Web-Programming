<?php
/*class Book{
    function Book(){
        $this.name = "instruction";
    }
}*/
    $x = 5;
    print "x: ".$x."<br>";
    function myFunction(){
        global $x;
        print "x in function is $x";
    }
    function myFunction2(){
        $GLOBALS['x'] = 10;
    }

    function staticEx(){
        static $age = 0;//this line executed only once
        $age++;
        print "<br>age is ".$age;
    }
    myFunction();
    myFunction2();
    print "<br>$x";

    staticEx();
    staticEx();
    staticEx();


    print "<br> var_dump:";
    var_dump(3);
    $y = 5;
    var_dump($y);
    var_dump("ali emre");
    $names = array("ali","veli","ayşe");
    var_dump($names);
    //$myBook = new Book();
    //print $myBook;

?>
