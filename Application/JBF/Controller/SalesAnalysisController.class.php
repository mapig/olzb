<?php

namespace JBF\Controller;
use Think\Controller;
class SalesAnalysisController extends Controller {

    public function index(){

        //print_r($_POST);
        //2017-02-02
        $saledate = $_POST['saledate'];
        $saleshop = $_POST['saleshop'];


        //$dh = "XS170118%";
        $dh = "XS".date('ymd',time())."%";



        if (!is_null($saledate)){
            $dh = "XS".substr(str_replace('-', '', $saledate),2)."%";
        }
        else
        {
            $saledate = date('Y-m-d',time());
        }

        $tSql="SELECT T.销售单号 AS XSDH,T.销售类型 AS XSLX,T.商品名称 AS SPMC,T.商品条码 AS SPTM,T.折扣率 AS ZKL,T.实售工费 AS SXGF,T.实售金价 AS SXJJ,T.实售价 AS SSJ,T.总重 AS ZZ,T.金重 AS JZ,G.售价 AS BQSJ,G.净金重 AS BQJZ,G.总件重 AS BQZZ,G.加工费方式 AS JGFFS,G.加工费 AS BQJGF,G.产品大类 AS LB1,G.主类 AS LB2,G.子类 AS LB3 ,C.C0218 AS XSY, C.C0205 AS XSMD, C.C0217 AS HYBH, C.C0214 AS HYMC FROM(SELECT D.SaleID AS 销售单号,D.Type AS 销售类型,D.C0185 AS 商品名称,D.C0302 AS 商品条码,D.C0306 AS 折扣率,D.C0318 AS 实售工费,D.C0317 AS 实售金价,D.C0303 AS 实售价,D.c0312 AS 总重, D.c0313 AS 金重 FROM ITSV.uZBSALE.dbo.v_jbf_xsd_detail AS D WHERE SaleID LIKE '{dh}') AS T LEFT JOIN 商品表 AS G ON T.商品条码 = G.条码号 LEFT JOIN ITSV.uZBSALE.dbo.C02 AS C ON T.销售单号 = C.C0201 {md} ORDER BY T.销售单号";

        //WHERE C.C0205='OL珠宝解放路店'
        //WHERE C.C0205='OL珠宝司门口店'
        $md = '';

        if (!is_null($saleshop) and $saleshop!='全部门店' ){
            $md = "WHERE C.C0205='".$saleshop."'";
        }
        else
        {
            $saleshop = '全部门店';
        }

        $tSql=str_replace('{md}', $md, $tSql);

        $tSql=str_replace('{dh}', $dh, $tSql);

        $lst = array();

        //print $tSql;

        $result = querydb($tSql);

        //header("Content-type: text/html; charset=utf-8");

        foreach($result as $temp)
        {
            //销售单号
            $xsdh = $temp['XSDH'];
            //销售员
            $xsy  = gbk2utf8($temp['XSY']);
            //销售门店
            $xsmd = gbk2utf8($temp['XSMD']);
            //会员编号
            $hybh = $temp['HYBH'];
            //会员名称
            $hymc = gbk2utf8($temp['HYMC']);


            if(!array_key_exists($xsdh, $lst))
            {
                $lst[$xsdh] = array();

                $lst[$xsdh]["销售单号"] = $xsdh;

                $lst[$xsdh]["足金克重"]   = 0;
                $lst[$xsdh]["铂950克重"]  = 0;
                $lst[$xsdh]["足铂克重"]   = 0;
                $lst[$xsdh]["足银克重"]   = 0;
                $lst[$xsdh]["其它克重"]   = 0;
                $lst[$xsdh]["优惠金额"]   = 0;

                $lst[$xsdh]["黄金旧料"]   = 0;
                $lst[$xsdh]["铂950旧料"]  = 0;
                $lst[$xsdh]["足铂旧料"]   = 0;
                $lst[$xsdh]["金750旧料"]  = 0;
                $lst[$xsdh]["银饰旧料"]   = 0;
                $lst[$xsdh]["其它料克重"] = 0;

                $lst[$xsdh]["素金销售"]   = 0;
                $lst[$xsdh]["硬金销售"]   = 0;
                $lst[$xsdh]["黄金镶嵌"]   = 0;
                $lst[$xsdh]["铂金销售"]   = 0;
                $lst[$xsdh]["彩金销售"]   = 0;
                $lst[$xsdh]["素银销售"]   = 0;
                $lst[$xsdh]["银饰销售"]   = 0;
                $lst[$xsdh]["玉器销售"]   = 0;
                $lst[$xsdh]["镶嵌销售"]   = 0;
                $lst[$xsdh]["其它销售"]   = 0;

                $lst[$xsdh]["旧料抵扣"]   = 0;

                $lst[$xsdh]["销售员"]   = $xsy;
                $lst[$xsdh]["会员编号"]   = $hybh;
                $lst[$xsdh]["会员姓名"]   = $hymc;

                $lst[$xsdh]["实付总额"]   = 0;
            }

            //系统分类
            $lb1 = gbk2utf8($temp['LB1']);
            //主类
            $lb2 = gbk2utf8($temp['LB2']);
            //子类
            $lb3 = gbk2utf8($temp['LB3']);

            //金重
            $jz = $temp['JZ'];
            //总重
            $zz = $temp['ZZ'];

            //销售类型
            $xslx = gbk2utf8($temp['XSLX']);
            //商品名称
            $spmc = gbk2utf8($temp['SPMC']);
            //商品条码
            $sptm = $temp['SPTM'];
            //实售价
            $ssj = $temp['SSJ'];

            //实销工费
            $sxgf = $temp['SXGF'];

            //print $xsdh." ".$xslx." ".$spmc." ".$sptm." ".$lb1." ".$lb2." ".$lb3." ".$ssj." ".$jz." ".$zz." ".$xsy." ".$hybh." ".$hymc."<br/>";


            //金重大于0 销售金重
            if($xslx == "销售" and $jz>0)
            {
                if($lb1 == "SGL" and strstr($spmc,"足金"))
                {
                    $lst[$xsdh]["足金克重"] += $jz;
                }
                elseif ($lb1 == "SGL" and strstr($spmc,"铂950"))
                {
                    $lst[$xsdh]["铂950克重"] += $jz;
                }
                elseif ($lb1 == "SGL" and strstr($spmc,"足铂"))
                {
                    $lst[$xsdh]["足铂克重"] += $jz;
                }
                elseif ($lb1 == "SAG" and  $lb2 == "银饰")
                {
                    $lst[$xsdh]["足银克重"] += $jz;
                }
                else
                {
                    $lst[$xsdh]["其它克重"] += $jz;
                }
            }

            //金重大于0 销退金重
            if($xslx == "销退" and $jz>0)
            {
                if($lb1 == "SGL" and strstr($spmc,"足金"))
                {
                    $lst[$xsdh]["足金克重"] -= $jz;
                }
                elseif ($lb1 == "SGL" and strstr($spmc,"铂950"))
                {
                    $lst[$xsdh]["铂950克重"] -= $jz;
                }
                elseif ($lb1 == "SGL" and strstr($spmc,"足铂"))
                {
                    $lst[$xsdh]["足铂克重"] -= $jz;
                }
                elseif ($lb1 == "SAG" and  $lb2 == "银饰")
                {
                    $lst[$xsdh]["足银克重"] -= $jz;
                }
                else
                {
                    $lst[$xsdh]["其它克重"] -= $jz;
                }
            }

            //销售类型为折扣
            if($xslx == "折扣")
            {
                $lst[$xsdh]["优惠金额"] += $ssj;
            }

            //销售类型为旧料
            if($xslx == "旧料")
            {
                if (strstr($spmc,"足金"))
                {
                    $lst[$xsdh]["黄金旧料"] += $jz;
                }
                elseif (strstr($spmc,"铂950"))
                {
                    $lst[$xsdh]["铂950旧料"] += $jz;
                }
                elseif (strstr($spmc,"足铂"))
                {
                    $lst[$xsdh]["足铂旧料"] += $jz;
                }
                elseif (strstr($spmc,"金750"))
                {
                    $lst[$xsdh]["金750旧料"] += $jz;
                }
                elseif (strstr($spmc,"足银"))
                {
                    $lst[$xsdh]["银饰旧料"] += $jz;
                }
                else
                {
                    $lst[$xsdh]["其它料克重"] += $jz;
                }

                $lst[$xsdh]["旧料抵扣"]  += $ssj;
            }


            if($xslx == "销售" or $xslx == "销退")
            {
                if ($lb2 == "足金")
                {
                    $lst[$xsdh]["素金销售"]   += $ssj;
                }
                elseif ($lb2 == "3D足金")
                {
                    $lst[$xsdh]["硬金销售"]   += $ssj;
                }
                elseif ($lb1 == "SGL" and $lb2 == "足金镶嵌")
                {
                    $lst[$xsdh]["素金销售"]   += ($ssj -$sxgf);

                    $lst[$xsdh]["黄金镶嵌"]   += $sxgf;
                }
                elseif ($lb1 == "SGN" and $lb2 == "足金镶嵌")
                {
                    $lst[$xsdh]["黄金镶嵌"]   += $ssj;
                }
                elseif ($lb2 == "铂金")
                {
                    $lst[$xsdh]["铂金销售"]   += $ssj;
                }
                elseif ($lb2 == "彩金")
                {
                    $lst[$xsdh]["彩金销售"]   += $ssj;
                }
                elseif ($lb1 == "SAG" and $lb2 == "银饰")
                {
                    $lst[$xsdh]["素银销售"]   += $ssj;
                }
                elseif ($lb1 == "YSL" and $lb2 == "银饰")
                {
                    $lst[$xsdh]["银饰销售"]   += $ssj;
                }
                elseif ($lb2 == "玉器")
                {
                    $lst[$xsdh]["玉器销售"]   += $ssj;
                }
                elseif ($lb2 == "镶嵌")
                {
                    $lst[$xsdh]["镶嵌销售"]   += $ssj;
                }
                else
                {
                    $lst[$xsdh]["其它销售"]   += $ssj;
                }
            }

            $lst[$xsdh]["实付总额"] += $ssj;
        }

        //print_r($lst);

        $this->assign('lst',$lst);

        $this->assign('saledate',$saledate);

        $this->assign('saleshop',$saleshop);

        $this->show();
    }
}