<?php
    class db_tools{
        private  $server = "mysql:host=localhost;dbname=intranet_intranet;charset=utf8";
        private  $user = "root";
        private  $pass = "";
        private  $options  = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,);
        protected $con;
        public $sql="";
        public $stm="";
        public function openConnection(){
               try
                 {
        	        $this->con = new PDO($this->server, $this->user,$this->pass,$this->options);
        	        return $this->con;
                  }
               catch (PDOException $e)
                 {
                     echo "There is some problem in connection: " . $e->getMessage();
                 }

        }
        public function closeConnection(){
            $this->con = null;
        }

        function createStement($textsql){
            $this->sql=$textsql;
            $this->stm = $this->con->prepare($this->sql);
            }
        function Stement(){
            $this->stm = $this->con->prepare($this->sql);
            }
        function runStmSql($param=array()){
            $this->stm->execute($param);
        }

        function moveNext_getRow($mode ='num'){
            $arrmode = array("num"=>PDO::FETCH_NUM,"assoc"=>PDO::FETCH_ASSOC);
            return $this->stm->fetch($arrmode[$mode]);
        }
        function closeStm(){
            $this->stm->closeCursor();
        }
		public function findAll($table){
				$this->sql = 'SELECT * FROM '.$table;
				return $this;
			}
        function conditions($table,$condition){
			$this->sql = "SELECT * FROM $table WHERE $condition";
			return $this;
		}
		function findByPK($table,$column,$value){
			$this->sql = "SELECT * FROM $table WHERE $column = $value";
			return $this;
		}
}
?>
