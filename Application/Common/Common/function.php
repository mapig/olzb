<?php
use Common\Tools\ConnMssqlDB;
use Common\Tools\OperateMssqlDB;

function gbk2utf8($str)
{
    //return iconv('gb2312', 'utf-8//IGNORE', $str);
    return $str;
}

function utf82gbk($str)
{
    //return iconv('utf-8', 'gb2312//IGNORE', $str);
    return $str;
}

function querydb($tsql)
{
	$connobj = new ConnMssqlDB();

	$connobj->SetMssqlDB("127.0.0.1\GSQL","sa","admin","ZBERP");

	$conn = $connobj->GetConn();

	$operatedb = new OperateMssqlDB();

	//$tSql=utf82gbk($tsql);

	$result = $operatedb->Execsql($tsql,$conn);

	$connobj->CloseDB();

	return $result;
}

function querydb1($tsql)
{
	$connobj = new ConnMssqlDB();

	$connobj->SetMssqlDB("127.0.0.1\GSQL","sa","admin","ZBERP");

	$conn = $connobj->GetConn();

	$operatedb = new OperateMssqlDB();

	//$tSql=utf82gbk($tsql);

	$result = $operatedb->Execsql($tSql,$conn); 

	$connobj->CloseDB();

	return $result;
}

function querydb2($tsql)
{
    $connobj = new ConnMssqlDB();

    $connobj->SetMssqlDB("192.168.0.243\SQLEXPRESS","sa","admin","ZBERP");

    $conn = $connobj->GetConn();

    $operatedb = new OperateMssqlDB();

    $result = $operatedb->Execsql($tsql,$conn);

    $connobj->CloseDB();

    return $result;
}