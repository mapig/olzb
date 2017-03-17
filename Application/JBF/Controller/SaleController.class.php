<?php
namespace JBF\Controller;
use Think\Controller;
class SaleController extends Controller {

    public function index(){

		$saledate = $_POST['saledate']; 

		if (is_null($saledate)){
			$saledate =  date('Y-m-d',time());
		}

        $tSql="SELECT [单号],[类型],[产品条码],[主类]+[子类] AS 类别,[产品名称],[原售价],[实售价],[加工费],[金重],[总重],[销售员],[销售提成],[店铺],[实售工费] FROM [JBF_报表_销售明细] WHERE 日期='{saledate}' ORDER BY [单号] DESC,[类型] DESC";

		$tSql=str_replace('{saledate}',$saledate,$tSql);

		$lst = array();

		$result = querydb($tSql);

		foreach($result as $temp)
		{
		    $type = 0;
		    if($temp["类型"] == "退换"){
                $type = 1;
            }

            $lst[] = array(
                '单号'=>substr($temp["单号"],-3),
                '类型'=>$temp["类型"],
                '产品条码'=>$temp["产品条码"],
                '产品名称'=>$temp["产品名称"],

                //$weight = substr($weight,0,strpos($weight,".")+3);
                '类别'=>$temp["类别"],
                '金重'=>str_replace('.000','',$temp["金重"]),
                '总重'=>str_replace('.000','',$temp["总重"]),

                '加工费'=>str_replace('.00','',$temp["加工费"]),
                '实售工费'=>str_replace('.00','',$temp["实售工费"]),

                '原售价'=>str_replace('.000','',$temp["原售价"]),
                '实售价'=>str_replace('.000','',$temp["实售价"]),

                '销售员'=>$temp["销售员"],
                '门店'=>str_replace('OL珠宝','',$temp["店铺"]),
                'Type'=>$type,
            );



		} 

		$this->assign('lst1',$lst);

		$this->assign('saledate',$saledate);

        $this->show();
    }
}