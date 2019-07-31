<?php
    class db_tools{
        private  $dsn = "mysql:host=localhost;dbname=intranet_intranet;charset=utf8";
        private  $user = "root";
        private  $pass = "";
        private  $options  = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,);
        protected $con;
        public $sql="";
        public $stm="";
        public function openConnection(){
               try
                 {
        	        $this->con = new PDO($this->dsn, $this->user,$this->pass,$this->options);
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
            $arrmode = array("num"=>PDO::FETCH_NUM,"assoc"=>PDO::FETCH_ASSOC,"array"=>PDO::FETCH_BOTH,"obj"=>PDO::FETCH_OBJ);
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
	        $this->runStmSql($val);
	        return $this;
		}
		function update($table, $data, $field, $value){
			$val = array();
			$colon =array();
			$i=0;
			foreach($data as $k => $v){
				$val[":$v"] = $v;
				if($k!=$field){
					$rows.="$k ="."'".$val[":$v"]."'";
					if($i<count($data)-1){
						$rows.=',';
					}
				}
				$i++;
			}
			$this->createStement("UPDATE $table SET $rows WHERE $field = $value");
			$this->runStmSql($val);
			return $this;
		}
		function delete($table,$field,$value){
			$this->createStement("DELETE FROM $table WHERE $field = $value");
			$this->runStmSql($val);
			return $this;
		}
		public function findAll($table){
			$this->createStement('SELECT * FROM '.$table);
			$this->runStmSql(array());
			return $this;
			}
        function conditions($table,$condition){
			$this->createStement("SELECT * FROM $table WHERE $condition");
			$this->runStmSql(array());
			return $this;
		}
		function findByPK($table,$data){
			$field = "";
			$val = array();
			$condition="";
			$i = 0;
			$tablelist = join($table,",");
			foreach($data as $k => $v){
				$field = $k;
				$val[":$v"] =$v;
				$value = $val[":$v"];
				$condition .= "$field = $value";
				if($i<count($data)-1){
					$condition .= " AND ";

					}
				$i++;

			}
			$this->createStement("SELECT * FROM $tablelist WHERE $condition");
			$this->runStmSql($val);
			return $this;
		}
}
?>
