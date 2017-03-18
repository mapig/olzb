<?php
namespace JBF\Controller;
use Think\Controller;
class StockController extends Controller {

    //����ѯ
    public function index(){


        #print_r($_POST);

        $saleshop = $_POST['saleshop'];

        if (is_null($saleshop)){

            $saleshop =  "ȫ���ŵ�";
        }

        //����������
        $tSql="select * from [JBF_����_������ͳ��] order by ����";

        $tSql="SELECT G.����,count(*) AS �����,

CASE 

	WHEN (G.���� = '���' OR G.���� = '�����Ƕ' OR G.���� = '����' OR G.���� = '����' ) THEN SUM(CONVERT(FLOAT,G.������)) 

	WHEN (G.���� = '�ʽ�' OR G.���� = '3D���') THEN SUM(CONVERT(FLOAT,G.�ܼ���)) 

	ELSE 0  END AS ������

FROM JBF_����_���_�����Ʒ AS S LEFT JOIN ��Ʒ�� AS G ON S.[�����] = G.[�����] ";

        if($saleshop != "ȫ���ŵ�"){
            $tSql = $tSql." WHERE S.�ŵ�= '".$saleshop."'";
        }

        $tSql = $tSql." GROUP BY [����]";

        //print $tSql;
        //
        $result = querydb($tSql);

        $lst1 = array();

        foreach($result as $temp)
        {
            $lst1[] = array('name'=>gbk2utf8($temp[0]),'number'=>$temp[1],'weight'=>$temp[2]);
        }

        $this->assign('lst1',$lst1);

        //����������
        //$tSql="select * from [JBF_����_ǧ�����ͳ��] order by Ʒ��";

        $tSql="SELECT G.[����], COUNT(*) AS �������, SUM(CONVERT(FLOAT,G.������)) as ������

FROM [JBF_����_���_�����Ʒ] AS S LEFT JOIN ��Ʒ�� AS G ON S.[�����] = G.[�����]

WHERE G.[����]='���'";

        if($saleshop != "ȫ���ŵ�"){
            $tSql = $tSql." AND �ŵ� ='".$saleshop."'";
        }

        $tSql = $tSql." GROUP BY [����]";

        //print $tSql;

        $result = querydb($tSql);

        $lst2 = array();

        foreach($result as $temp)
        {
            $lst2[] = array('name'=>gbk2utf8($temp[0]),'number'=>$temp[1],'weight'=>$temp[2]);
        }

        $this->assign('lst2',$lst2);


        //�������
        $tSql="SELECT COUNT(*) AS ������� FROM [JBF_����_���_�����Ʒ]";
        if($saleshop != "ȫ���ŵ�"){
            $tSql = $tSql." WHERE �ŵ� ='".$saleshop."'";
        }

        //echo $tSql;

        $result = querydb($tSql);

        $lst3 = $result[0][0];

        $this->assign('lst3',$lst3);

        $this->assign('saleshop',$saleshop);

        this.$this->display();

    }



    //����ѯ
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

        if($stype == "�ƽ�"){
            $tSql="SELECT �������,FLOOR(CONVERT(FLOAT,G.������)/10) AS ����,COUNT(*) AS ���� FROM [JBF_����_���_�����Ʒ] AS S LEFT JOIN ��Ʒ�� AS G ON S.[�����] = G.[�����]

	WHERE G.[����]='���' GROUP BY FLOOR(CONVERT(FLOAT,G.������)/10),������� ORDER BY �������,FLOOR(CONVERT(FLOAT,G.������)/10) ASC";
        }

        if($stype == "����"){
            $tSql="SELECT �������,FLOOR(CONVERT(FLOAT,G.������)/10) AS ����,COUNT(*) AS ���� FROM [JBF_����_���_�����Ʒ] AS S LEFT JOIN ��Ʒ�� AS G ON S.[�����] = G.[�����]

	WHERE G.[����]='����' GROUP BY FLOOR(CONVERT(FLOAT,G.������)/10),������� ORDER BY �������,FLOOR(CONVERT(FLOAT,G.������)/10) ASC";
        }

        if($stype == "Ӳ��"){
            $tSql="SELECT �������,FLOOR(CONVERT(FLOAT,G.�ܼ���)/10) AS ����,COUNT(*) AS ���� FROM [JBF_����_���_�����Ʒ] AS S LEFT JOIN ��Ʒ�� AS G ON S.[�����] = G.[�����]

	WHERE G.[����]='3D���' GROUP BY FLOOR(CONVERT(FLOAT,G.�ܼ���)/10),������� ORDER BY �������,FLOOR(CONVERT(FLOAT,G.�ܼ���)/10) ASC";
        }

        if($stype == "�ʽ�"){
            $tSql="SELECT �������,FLOOR(CONVERT(FLOAT,G.�ܼ���)/10) AS ����,COUNT(*) AS ���� FROM [JBF_����_���_�����Ʒ] AS S LEFT JOIN ��Ʒ�� AS G ON S.[�����] = G.[�����]

	WHERE G.[����]='�ʽ�' GROUP BY FLOOR(CONVERT(FLOAT,G.�ܼ���)/10),������� ORDER BY �������,FLOOR(CONVERT(FLOAT,G.�ܼ���)/10) ASC";
        }


        $result = querydb($tSql);

        //print_r($result);





        //�����ֵ�������б�
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

        $return["text"] = $stype."��Ʒ������";

        $return["type"] = $stype;

        $return["series"] = $lst_result;

        $json = json_encode($return);

        $this->ajaxReturn($json,'JSON');

    }

    //����ѯ
    public function analysis(){

        this.$this->display();


    }

    //����ѯ
    public function checkin(){

        $saledate = $_POST['saledate'];

        $saleshop = 'ȫ���ŵ�';

        if (is_null($saledate)){

            $saledate =  date('Y-m-d',time());
        }

        //$saledate=str_replace('-','/',$saledate);

        //$tSql="SELECT �����,����,Ʒ��,��Ʒ����,֤���,�ܼ���,������,�ۼ� FROM ���� WHERE ����ʱ��='{saledate}' ORDER BY [�����] ASC";

        //AND C0205='OL�鱦���·��'

        $tSql= "SELECT ����,�����,��Ʒ����,�ܼ���,������,֤���,����,����,�ӹ��ѷ�ʽ,�ӹ���,�ۼ�,T.C0205 AS �ŵ� FROM(

		SELECT C0301 AS ����,C0302,C0309 FROM JBF_����������Ʒ�� WHERE C0301 IN (

		SELECT C0201 FROM JBF_�����������ݱ� WHERE CONVERT(Varchar(10), C0209, 120)  = '{saledate}' AND C0202 = 'JFH' AND C0213 = 'CFD' 

		)) AS R

		INNER JOIN ��Ʒ�� AS S ON R.C0302 = S.�����

		LEFT JOIN JBF_�����������ݱ� AS T ON R.���� = T.C0201

		ORDER BY C0309";

        $tSql=str_replace('{saledate}',$saledate,$tSql);

        //print($tSql);

        $lst1 = array();

        $result = querydb($tSql);

        foreach($result as $temp)
        {

            $no = str_replace('FH','',$temp[0]);
            $shop = str_replace('OL�鱦','',gbk2utf8($temp[11]));

            $lst1[$no]['no'] = $no;
            $lst1[$no]['shop'] = $shop;
            $lst1[$no]['item'][] = array(

                //'no'=>$temp[0],//[����]

                'code'=>$temp[1],//[�����]
                'name'=>gbk2utf8($temp[2]),//��Ʒ����

                'weight'=>str_replace('.00','',$temp[3]),//[�ܼ���]
                'goldweight'=>$temp[4],//[������]

                'certificates'=>gbk2utf8($temp[5]),//֤���
                'catalog'=>gbk2utf8($temp[6]),//[����]
                'type'=>gbk2utf8($temp[7]),//[����]

                'addtype' => gbk2utf8($temp[8]),//[��������]
                'addcost' => str_replace('.00','',$temp[9]),//[�ӹ���]

                'price'=>str_replace('.00','',$temp[10]),//[�ۼ�]

            );
        }

        //var_dump($lst1);

        $this->assign('lst1',$lst1);

        $this->assign('saledate',$saledate);

        $this->assign('saleshop',$saleshop);

        $this->show();
    }



    //�춯��ѯ
    public function checkout(){

        $saledate = $_POST['saledate'];

        if (is_null($saledate)){

            $saledate =  date('Y-m-d',time());
        }

        //C02.C0205 = 'OL�鱦˾�ſڵ�'
        /*$tSql="SELECT C03.C0301 AS ����,C03.C0302 AS ����,C01.C0103 AS ���, C01.C0107 AS ���,  C01.C0108 AS ֤��,   C01.C0109 AS ԭ���, C03.c0312 AS ����,  C03.c0313 AS ����,C01.C0128 AS ָȦ,   C01.C0131 AS ��ʯ��,  C01.C0132 AS ��ʯ��, C01.C0136 AS ��ɫ,  C01.C0137 AS ����,  C01.C0138 AS �й�,C01.C0169 AS ��ʯ��,  C01.C0170 AS ��ʯ��, C01.C0182 AS �ۼ�,    C01.C0185 AS ���� FROM ITSV.uZBSALE.dbo.C03 AS C03 left outer join ITSV.uZBSALE.dbo.C01 AS C01 on C0302 = C0102 Where C0301 IN (SELECT C02.C0201 from ITSV.uZBSALE.dbo.C02 AS C02 where C0202 = 'JTH' and C0211 = 'N' and CONVERT(Varchar(10), C0209, 120)  = '{saledate}') ORDER BY ����";*/


        $tSql="SELECT C03.C0301 AS ����, C02.C0205 AS ����, C01.C0185 AS ����,
		C03.C0302 AS ����,����,����,�ܼ���,������,�ۼ�,
		C03.C0309 AS ���,C02.C0215 AS ʱ��, 
		�ӹ��ѷ�ʽ,�ӹ���
		FROM ITSV.uZBSALE.dbo.C03 AS C03 left outer join ITSV.uZBSALE.dbo.C01 AS C01 on C0302 = C0102 
		LEFT JOIN ��Ʒ�� AS K on C0302 = ����� 
		LEFT JOIN ITSV.uZBSALE.dbo.C02 AS C02 on C0301 = C02.C0201
		WHERE C0301 IN (SELECT C02.C0201 from ITSV.uZBSALE.dbo.C02 AS C02 WHERE C0202 = 'JTH' AND C0211 = 'N' AND CONVERT(Varchar(10), C0209, 120)  = '{saledate}')";

        $tSql=str_replace('{saledate}',$saledate,$tSql);

        $lst1 = array();

        $result = querydb($tSql);

        /*
        foreach($result as $temp)
        {
            $lst1[] = array(

                'dh'  =>$temp[0],//[����]
                'tm'  =>$temp[1],//[����]
                'lb'  =>$temp[2],//[���]

                'kh'  =>$temp[3],//[���]
                'zs'  =>$temp[4],//[֤��]
                'ybh'  =>$temp[5],//[ԭ���]

                'zz' =>$temp[6],//[����]
                'jz'  =>$temp[7],//[����]
                'zq'=>$temp[8],//[ָȦ]

                'zss'  =>$temp[9],//[��ʯ��]
                'zsz'  =>$temp[10],//[��ʯ��]
                'ys'  =>gbk2utf8($temp[11]),//[��ɫ]

                'jd'  =>$temp[12],//[����]
                'qg'  =>gbk2utf8($temp[13]),//[�й�]
                'fss'  =>$temp[14],//[��ʯ��]

                'fsz'  =>$temp[15],//[��ʯ��]
                'sj'  =>$temp[16],//[�ۼ�]
                'mc'  =>gbk2utf8($temp[17]),//[����]
            );
        } */


        foreach($result as $temp)
        {

            $no = str_replace('FT','',$temp[0]);
            $shop = str_replace('OL�鱦','',gbk2utf8($temp[1]));

            $lst1[$no]['no'] = $no;
            $lst1[$no]['shop'] = $shop;
            $lst1[$no]['item'][] = array(

                //'no'=>$temp[0],//[����]

                'code'=>$temp[3],//[�����]
                'name'=>gbk2utf8($temp[2]),//��Ʒ����

                'weight'=>str_replace('.00','',$temp[6]),//[�ܼ���]
                'goldweight'=>$temp[7],//[������]

                //'certificates'=>gbk2utf8($temp[5]),//֤���
                'catalog'=>gbk2utf8($temp[4]),//[����]
                'type'=>gbk2utf8($temp[5]),//[����]

                'addtype' => gbk2utf8($temp[11]),//[��������]
                'addcost' => str_replace('.00','',$temp[12]),//[�ӹ���]

                'price'=>str_replace('.00','',$temp[8]),//[�ۼ�]

            );
        }

        $this->assign('lst1',$lst1);

        $this->assign('saledate',$saledate);

        $this->show();
    }

    //�춯��ѯ
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

            $tSql="SELECT �����,ԭ���,֤���,��Ʒ����,�ܼ���,������,�г��ɱ�,�ۼ�,�ӹ���,�ִ�,����,����,��ע FROM ��Ʒ�� WHERE ����� = '{stockcode}'";


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
                    'tmh'  =>$result[0][0],//[�����]
                    'ybh'  =>$result[0][1],//[ԭ���]
                    'zsh'  =>$result[0][2],//[֤���]
                    'cpmc'  =>gbk2utf8($result[0][3]),//[��Ʒ����]
                    'zjz'  =>$result[0][4],//[�ܼ���]
                    'jjz'  =>$result[0][5],//[������]
                    'sccb'  =>$result[0][6],//[�г��ɱ�]
                    'sj'  =>$result[0][7],//[�ۼ�]
                    'jgf'  =>$result[0][8],//[�ӹ���]
                    'sc'  =>$result[0][9],//[�ִ�]
                    'zl'  =>gbk2utf8($result[0][10]),//[����]
                    'pz'  =>gbk2utf8($teresultmp[0][11]),//[Ʒ��]
                    'bz'  =>gbk2utf8($temp[0][12]),//[��ע]
                    'ssj'  => $ssj,//[�ۼ�]
                );

                //$this->assign('info',$info);
            }
            else
            {
                //echo "������";

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