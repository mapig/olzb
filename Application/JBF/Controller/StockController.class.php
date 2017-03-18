<?php
namespace JBF\Controller;
use Think\Controller;
class StockController extends Controller {

    //库存查询
    public function index(){


        #print_r($_POST);

        $saleshop = $_POST['saleshop'];

        if (is_null($saleshop)){

            $saleshop =  "全部门店";
        }

        //库存大类数据
        $tSql="select * from [JBF_报表_库存分类统计] order by 种类";

        $tSql="SELECT G.主类,count(*) AS 库存量,

CASE 

	WHEN (G.主类 = '足金' OR G.主类 = '足金镶嵌' OR G.主类 = '铂金' OR G.主类 = '玉器' ) THEN SUM(CONVERT(FLOAT,G.净金重)) 

	WHEN (G.主类 = '彩金' OR G.主类 = '3D足金') THEN SUM(CONVERT(FLOAT,G.总件重)) 

	ELSE 0  END AS 库存克数

FROM JBF_报表_多店_库存商品 AS S LEFT JOIN 商品表 AS G ON S.[条码号] = G.[条码号] ";

        if($saleshop != "全部门店"){
            $tSql = $tSql." WHERE S.门店= '".$saleshop."'";
        }

        $tSql = $tSql." GROUP BY [主类]";

        //print $tSql;
        //
        $result = querydb($tSql);

        $lst1 = array();

        foreach($result as $temp)
        {
            $lst1[] = array('name'=>gbk2utf8($temp[0]),'number'=>$temp[1],'weight'=>$temp[2]);
        }

        $this->assign('lst1',$lst1);

        //库存大类数据
        //$tSql="select * from [JBF_报表_千足金库存统计] order by 品种";

        $tSql="SELECT G.[子类], COUNT(*) AS 库存数量, SUM(CONVERT(FLOAT,G.净金重)) as 库存克数

FROM [JBF_报表_多店_库存商品] AS S LEFT JOIN 商品表 AS G ON S.[条码号] = G.[条码号]

WHERE G.[主类]='足金'";

        if($saleshop != "全部门店"){
            $tSql = $tSql." AND 门店 ='".$saleshop."'";
        }

        $tSql = $tSql." GROUP BY [子类]";

        //print $tSql;

        $result = querydb($tSql);

        $lst2 = array();

        foreach($result as $temp)
        {
            $lst2[] = array('name'=>gbk2utf8($temp[0]),'number'=>$temp[1],'weight'=>$temp[2]);
        }

        $this->assign('lst2',$lst2);


        //库存数据
        $tSql="SELECT COUNT(*) AS 库存总数 FROM [JBF_报表_多店_库存商品]";
        if($saleshop != "全部门店"){
            $tSql = $tSql." WHERE 门店 ='".$saleshop."'";
        }

        //echo $tSql;

        $result = querydb($tSql);

        $lst3 = $result[0][0];

        $this->assign('lst3',$lst3);

        $this->assign('saleshop',$saleshop);

        this.$this->display();

    }



    //库存查询
    public function search(){


        $arr = array();

        /*
        $arr = array(
            'name' => '124',
            'nick' => 'haran',
            'contact' => array(
                'email' => 'url at qq dot com',
                'website' => 'http://www.url.com',
                )
            );
        */

        /*

        $arr['name']=$picname;
        $arr['pic']=$pics;
        $arr['size']=$size;

        */
        #print_r($_GET);

        $stype = $_GET[type];

        #$stype = utf82gbk($stype);

        if($stype == "黄金"){
            $tSql="SELECT 首饰类别,FLOOR(CONVERT(FLOAT,G.净金重)/10) AS 金重,COUNT(*) AS 个数 FROM [JBF_报表_多店_库存商品] AS S LEFT JOIN 商品表 AS G ON S.[条码号] = G.[条码号]

	WHERE G.[主类]='足金' GROUP BY FLOOR(CONVERT(FLOAT,G.净金重)/10),首饰类别 ORDER BY 首饰类别,FLOOR(CONVERT(FLOAT,G.净金重)/10) ASC";
        }

        if($stype == "铂金"){
            $tSql="SELECT 首饰类别,FLOOR(CONVERT(FLOAT,G.净金重)/10) AS 金重,COUNT(*) AS 个数 FROM [JBF_报表_多店_库存商品] AS S LEFT JOIN 商品表 AS G ON S.[条码号] = G.[条码号]

	WHERE G.[主类]='铂金' GROUP BY FLOOR(CONVERT(FLOAT,G.净金重)/10),首饰类别 ORDER BY 首饰类别,FLOOR(CONVERT(FLOAT,G.净金重)/10) ASC";
        }

        if($stype == "硬金"){
            $tSql="SELECT 首饰类别,FLOOR(CONVERT(FLOAT,G.总件重)/10) AS 金重,COUNT(*) AS 个数 FROM [JBF_报表_多店_库存商品] AS S LEFT JOIN 商品表 AS G ON S.[条码号] = G.[条码号]

	WHERE G.[主类]='3D足金' GROUP BY FLOOR(CONVERT(FLOAT,G.总件重)/10),首饰类别 ORDER BY 首饰类别,FLOOR(CONVERT(FLOAT,G.总件重)/10) ASC";
        }

        if($stype == "彩金"){
            $tSql="SELECT 首饰类别,FLOOR(CONVERT(FLOAT,G.总件重)/10) AS 金重,COUNT(*) AS 个数 FROM [JBF_报表_多店_库存商品] AS S LEFT JOIN 商品表 AS G ON S.[条码号] = G.[条码号]

	WHERE G.[主类]='彩金' GROUP BY FLOOR(CONVERT(FLOAT,G.总件重)/10),首饰类别 ORDER BY 首饰类别,FLOOR(CONVERT(FLOAT,G.总件重)/10) ASC";
        }


        $result = querydb($tSql);

        //print_r($result);





        //求最大值和种类列表
        $lst_name = array();
        $max = 0;
        foreach($result as $temp)
        {
            $name   = gbk2utf8($temp[0]);
            $weight = $temp[1];
            $count  = $temp[2];

            if (!in_array($name, $lst_name)) {
                array_push($lst_name,$name);
            }

            if($temp[1] > $max){
                $max= $temp[1];
            }
        }

        $lst_result = array();



        foreach ($lst_name as $temp1) {
            array_push($lst_result,array('name'=>$temp1,'data'=>array_pad(array(),$max+1,0)));
        }

        //print_r($lst_result);

        foreach($result as $temp)
        {
            $name   = gbk2utf8($temp[0]);

            //print $temp[0];
            $weight = $temp[1];
            $count  = $temp[2];

            for ($i= 0;$i< count($lst_result); $i++){

                //$temp2= $lst_result[$i];

                if($lst_result[$i]["name"] == $name){

                    //echo $temp2["date"][$weight];

                    $lst_result[$i]["data"][$weight] = (int)$count;

                    //echo $temp2["date"][$weight];
                }

            }

        }

        //print $max;

        //print_r($lst_result);
        //print_r($lst_result);
        //$json = "";

        //$json = JSON($lst_result);

        $return = array();

        $return["text"] = $stype."饰品库存分析";

        $return["type"] = $stype;

        $return["series"] = $lst_result;

        $json = json_encode($return);

        $this->ajaxReturn($json,'JSON');

    }

    //库存查询
    public function analysis(){

        this.$this->display();


    }

    //入库查询
    public function checkin(){

        $saledate = $_POST['saledate'];

        $saleshop = '全部门店';

        if (is_null($saledate)){

            $saledate =  date('Y-m-d',time());
        }

        //$saledate=str_replace('-','/',$saledate);

        //$tSql="SELECT 条码号,种类,品种,产品名称,证书号,总件重,净金重,售价 FROM 入库表 WHERE 新增时间='{saledate}' ORDER BY [条码号] ASC";

        //AND C0205='OL珠宝解放路店'

        $tSql= "SELECT 单号,条码号,产品名称,总件重,净金重,证书号,主类,子类,加工费方式,加工费,售价,T.C0205 AS 门店 FROM(

		SELECT C0301 AS 单号,C0302,C0309 FROM JBF_分销发货商品表 WHERE C0301 IN (

		SELECT C0201 FROM JBF_分销发货单据表 WHERE CONVERT(Varchar(10), C0209, 120)  = '{saledate}' AND C0202 = 'JFH' AND C0213 = 'CFD' 

		)) AS R

		INNER JOIN 商品表 AS S ON R.C0302 = S.条码号

		LEFT JOIN JBF_分销发货单据表 AS T ON R.单号 = T.C0201

		ORDER BY C0309";

        $tSql=str_replace('{saledate}',$saledate,$tSql);

        //print($tSql);

        $lst1 = array();

        $result = querydb($tSql);

        foreach($result as $temp)
        {

            $no = str_replace('FH','',$temp[0]);
            $shop = str_replace('OL珠宝','',gbk2utf8($temp[11]));

            $lst1[$no]['no'] = $no;
            $lst1[$no]['shop'] = $shop;
            $lst1[$no]['item'][] = array(

                //'no'=>$temp[0],//[单号]

                'code'=>$temp[1],//[条码号]
                'name'=>gbk2utf8($temp[2]),//产品名称

                'weight'=>str_replace('.00','',$temp[3]),//[总件重]
                'goldweight'=>$temp[4],//[净金重]

                'certificates'=>gbk2utf8($temp[5]),//证书号
                'catalog'=>gbk2utf8($temp[6]),//[主类]
                'type'=>gbk2utf8($temp[7]),//[子类]

                'addtype' => gbk2utf8($temp[8]),//[工费类型]
                'addcost' => str_replace('.00','',$temp[9]),//[加工费]

                'price'=>str_replace('.00','',$temp[10]),//[售价]

            );
        }

        //var_dump($lst1);

        $this->assign('lst1',$lst1);

        $this->assign('saledate',$saledate);

        $this->assign('saleshop',$saleshop);

        $this->show();
    }



    //异动查询
    public function checkout(){

        $saledate = $_POST['saledate'];

        if (is_null($saledate)){

            $saledate =  date('Y-m-d',time());
        }

        //C02.C0205 = 'OL珠宝司门口店'
        /*$tSql="SELECT C03.C0301 AS 单号,C03.C0302 AS 条码,C01.C0103 AS 类别, C01.C0107 AS 款号,  C01.C0108 AS 证书,   C01.C0109 AS 原编号, C03.c0312 AS 总重,  C03.c0313 AS 金重,C01.C0128 AS 指圈,   C01.C0131 AS 主石数,  C01.C0132 AS 主石重, C01.C0136 AS 颜色,  C01.C0137 AS 净度,  C01.C0138 AS 切工,C01.C0169 AS 辅石数,  C01.C0170 AS 辅石重, C01.C0182 AS 售价,    C01.C0185 AS 名称 FROM ITSV.uZBSALE.dbo.C03 AS C03 left outer join ITSV.uZBSALE.dbo.C01 AS C01 on C0302 = C0102 Where C0301 IN (SELECT C02.C0201 from ITSV.uZBSALE.dbo.C02 AS C02 where C0202 = 'JTH' and C0211 = 'N' and CONVERT(Varchar(10), C0209, 120)  = '{saledate}') ORDER BY 单号";*/


        $tSql="SELECT C03.C0301 AS 单号, C02.C0205 AS 店铺, C01.C0185 AS 名称,
		C03.C0302 AS 条码,主类,子类,总件重,净金重,售价,
		C03.C0309 AS 序号,C02.C0215 AS 时间, 
		加工费方式,加工费
		FROM ITSV.uZBSALE.dbo.C03 AS C03 left outer join ITSV.uZBSALE.dbo.C01 AS C01 on C0302 = C0102 
		LEFT JOIN 商品表 AS K on C0302 = 条码号 
		LEFT JOIN ITSV.uZBSALE.dbo.C02 AS C02 on C0301 = C02.C0201
		WHERE C0301 IN (SELECT C02.C0201 from ITSV.uZBSALE.dbo.C02 AS C02 WHERE C0202 = 'JTH' AND C0211 = 'N' AND CONVERT(Varchar(10), C0209, 120)  = '{saledate}')";

        $tSql=str_replace('{saledate}',$saledate,$tSql);

        $lst1 = array();

        $result = querydb($tSql);

        /*
        foreach($result as $temp)
        {
            $lst1[] = array(

                'dh'  =>$temp[0],//[单号]
                'tm'  =>$temp[1],//[条码]
                'lb'  =>$temp[2],//[类别]

                'kh'  =>$temp[3],//[款号]
                'zs'  =>$temp[4],//[证书]
                'ybh'  =>$temp[5],//[原编号]

                'zz' =>$temp[6],//[总重]
                'jz'  =>$temp[7],//[金重]
                'zq'=>$temp[8],//[指圈]

                'zss'  =>$temp[9],//[主石数]
                'zsz'  =>$temp[10],//[主石重]
                'ys'  =>gbk2utf8($temp[11]),//[颜色]

                'jd'  =>$temp[12],//[净度]
                'qg'  =>gbk2utf8($temp[13]),//[切工]
                'fss'  =>$temp[14],//[辅石数]

                'fsz'  =>$temp[15],//[辅石重]
                'sj'  =>$temp[16],//[售价]
                'mc'  =>gbk2utf8($temp[17]),//[名称]
            );
        } */


        foreach($result as $temp)
        {

            $no = str_replace('FT','',$temp[0]);
            $shop = str_replace('OL珠宝','',gbk2utf8($temp[1]));

            $lst1[$no]['no'] = $no;
            $lst1[$no]['shop'] = $shop;
            $lst1[$no]['item'][] = array(

                //'no'=>$temp[0],//[单号]

                'code'=>$temp[3],//[条码号]
                'name'=>gbk2utf8($temp[2]),//产品名称

                'weight'=>str_replace('.00','',$temp[6]),//[总件重]
                'goldweight'=>$temp[7],//[净金重]

                //'certificates'=>gbk2utf8($temp[5]),//证书号
                'catalog'=>gbk2utf8($temp[4]),//[主类]
                'type'=>gbk2utf8($temp[5]),//[子类]

                'addtype' => gbk2utf8($temp[11]),//[工费类型]
                'addcost' => str_replace('.00','',$temp[12]),//[加工费]

                'price'=>str_replace('.00','',$temp[8]),//[售价]

            );
        }

        $this->assign('lst1',$lst1);

        $this->assign('saledate',$saledate);

        $this->show();
    }

    //异动查询
    public function sfind(){


        //print_r($_POST);

        $stockcode = $_POST['stockcode'];

        $this->assign('stockcode',$stockcode);

        //echo $stockcode;

        $info= array(
            'tmh'  => "00000000",
        );


        if (!is_null($stockcode)){

            $info =  $stockcode;

            $tSql="SELECT 条码号,原编号,证书号,产品名称,总件重,净金重,市场成本,售价,加工费,手寸,主类,子类,备注 FROM 商品表 WHERE 条码号 = '{stockcode}'";


            $tSql=str_replace('{stockcode}',$stockcode, $tSql);

            //dump($tSql);

            $result = querydb($tSql);

            $ssj = "";

            if(count($result)>0)
            {
                $sj = floor($result[0][6] * 100);
                $ssj = $sj;
                $ssj = str_replace('0','@',$ssj);
                $ssj = str_replace('1','a',$ssj);
                $ssj = str_replace('2','b',$ssj);
                $ssj = str_replace('3','c',$ssj);
                $ssj = str_replace('4','d',$ssj);
                $ssj = str_replace('5','e',$ssj);
                $ssj = str_replace('6','f',$ssj);
                $ssj = str_replace('7','x',$ssj);
                $ssj = str_replace('8','y',$ssj);
                $ssj = str_replace('9','z',$ssj);


                //echo $ssj;
                $info= array(
                    'tmh'  =>$result[0][0],//[条码号]
                    'ybh'  =>$result[0][1],//[原编号]
                    'zsh'  =>$result[0][2],//[证书号]
                    'cpmc'  =>gbk2utf8($result[0][3]),//[产品名称]
                    'zjz'  =>$result[0][4],//[总件重]
                    'jjz'  =>$result[0][5],//[净金重]
                    'sccb'  =>$result[0][6],//[市场成本]
                    'sj'  =>$result[0][7],//[售价]
                    'jgf'  =>$result[0][8],//[加工费]
                    'sc'  =>$result[0][9],//[手寸]
                    'zl'  =>gbk2utf8($result[0][10]),//[种类]
                    'pz'  =>gbk2utf8($teresultmp[0][11]),//[品种]
                    'bz'  =>gbk2utf8($temp[0][12]),//[备注]
                    'ssj'  => $ssj,//[售价]
                );

                //$this->assign('info',$info);
            }
            else
            {
                //echo "无数据";

                $info= array(
                    'tmh'  => "00000000",
                );
            }

            $this->assign('info',$info);

        } else {
            $info= array(
                'tmh'  => "00000000",
            );
        }


        $this->assign('info',$info);

        $this->show();
    }
}