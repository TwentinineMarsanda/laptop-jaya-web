

<?php

class database {
    protected $con;

    function __construct()
    {
       return $this->con = mysqli_connect("localhost", "root", "", "jual_laptop");
        
    }
}
?>