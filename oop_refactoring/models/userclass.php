<?php
require('/orm.php')
class user extends orm{

    private $table='users';
    
     public function __construct() {
 parent::__construct(['localhost','root','','php']);
    }
    public function getusers() {
        $this->selectall($this->table);
    }
    public function getuser($id) {
        $this->select($this->table,,"where `id` ={$id}");
    }
    public function adduser($id) {
        $this->insert($this->table,"");
    }


}
?>
