<?php

namespace Common\Tools;

// 数据库操作类  
class OperateMssqlDB  
{  
    function Execsql($sql,$conn)  
    {  
            $sqltype = strtolower(substr(trim($sql),0,6));// 截取sql语句中的前6个字符串,并转换成小写
            $result = sqlsrv_query($conn,$sql);// 执行sql语句
            $calback_arrary = array();// 定义二维数组
            if ("select" == $sqltype)// 判断执行的是select语句  
            {  

                if (false == $result)  
                {  

                    return false;     
                }  
                //else if (0 == sqlsrv_num_rows($result))  
                //{  
                //    echo "3";
                //    return false;  
                //}  
                else  
                {  

                    while($result_array = sqlsrv_fetch_array($result))  
                    {  
                    array_push($calback_arrary, $result_array);  
                    }  
                    return $calback_arrary;// 成功返回查询结果的数组     
                }  
            }  
            else if ("update" == $sqltype || "insert" == $sqltype || "delete" == $sqltype)  
            {  
                    if ($result)  
                    {  
                        return true;  
                    }  
                    else  
                    {  
                        return false;  
                    }  
            }  
    }     
}  