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
        function insert($table,$data){
	        $field = array();
			$val = array();
			$colon =array();

			foreach($data as $k => $v){
				$field[] = $k;
				$val[":$v"] =$v;
				$colon[] =":$v";

				$fnlist = join($field,",");
				$vnlist = join($colon,",");
			}


	        $this->createStement("INSERT INTO $table($fnlist) VALUES ($vnlist) ");
	        print_r($this);
	        $this->runStmSql($val);
		}
		function update($table, $data, $field, $value){
    		$con = $this->connect();
			$rows ="";
			$i=0;
			foreach($data as $k => $v){
				if($k!=$field){
					$rows.="$k ='$v'";
					if($i<count($data)-1){
						$rows.=',';
					}
					$i++;
				}
			}
			$this->sql = "UPDATE $table SET $rows WHERE $field = $value";
			return mysqli_query($con,$this->sql);
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
