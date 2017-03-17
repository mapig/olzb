<?php
namespace JBF\Controller;
use Think\Controller;
class MaterialController extends Controller {

    public function index(){

        $saledate = $_POST['saledate'];

        if (is_null($saledate)){

            $saledate =  date('Y-m-d',time());
        }

        //$saledate=str_replace('-','/',$saledate);

        //echo $saledate;

        //dump($_POST);

        $tSql="SELECT 单号,旧料类型,成色,宝石,类别,克重,回收价,折扣,抵扣金额,工费 FROM JBF_销售旧料表 WHERE 时间 BETWEEN '{saledate} 00:00:00' AND '{saledate} 23:59:59' ORDER BY 时间";

        $tSql=str_replace('{saledate}',$saledate,$tSql);

        $lst1 = array();

        $result = querydb($tSql);

        //dump($tSql);

        foreach($result as $temp)
        {
            $lst1[] = array(

                'dh'  =>$temp[0],//[单号]
                'lx'  =>gbk2utf8($temp[1]),//[旧料类型]
                'cs'  =>gbk2utf8($temp[2]),//[成色]

                'bs'  =>gbk2utf8($temp[3]),//宝石
                'lb'  =>gbk2utf8($temp[4]),//类别
                'kz'  =>$temp[5],//[克重]

                'hsj' =>$temp[6],//[回收价]
                'zk'  =>$temp[7],//[折扣]
                'dkje'=>$temp[8],//[抵扣金额]
                'gf'  =>$temp[9],//[工费]
            );
        }

        $this->assign('lst1',$lst1);

        $this->assign('saledate',$saledate);

        $this->show();

    }
}