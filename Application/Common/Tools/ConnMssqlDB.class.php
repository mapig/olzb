<?php

namespace Common\Tools;

// 连接数据库的类  
class ConnMssqlDB  
{  
		var $conn;
        var $host;  
        var $usr;  
        var $pwd;  
        var $dbname;  
        
        // 构造方法  
        function ConnMssqlDB($host,$user,$pwd,$dbname)  
        {  
            $this->SetMssqlDB($host,$user,$pwd,$dbname);
        }

        function SetMssqlDB($host,$user,$pwd,$dbname)
        {
                $this->host = $host; 
                $this->user = $user;  
                $this->pwd = $pwd;  
                $this->dbname = $dbname;
        }

        function GetConn()  
        {  
            $connectionInfo = array("UID"=>$this->user, "PWD"=>$this->pwd, "Database"=>$this->dbname);
         
            $this->conn = sqlsrv_connect($this->host,$connectionInfo) or die("数据库服务器连接错误".sqlsrv_errors()); 
            return $this->conn;  
        }

        function __destruct()  
        {  
            $this->CloseDB();      
        }  

        function CloseDB()  
        {  
            sqlsrv_close($this->conn);  
        }  
}

