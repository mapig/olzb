<?php
namespace JBF\Controller;
use Think\Controller;
class SaleController extends Controller {

    public function index(){

		$saledate = $_POST['saledate']; 

		if (is_null($saledate)){
			$saledate =  date('Y-m-d',time());
		}

        $tSql="SELECT [����],[����],[��Ʒ����],[����]+[����] AS ���,[��Ʒ����],[ԭ�ۼ�],[ʵ�ۼ�],[�ӹ���],[����],[����],[����Ա],[�������],[����],[ʵ�۹���] FROM [JBF_����_������ϸ] WHERE ����='{saledate}' ORDER BY [����] DESC,[����] DESC";

		$tSql=str_replace('{saledate}',$saledate,$tSql);

		$lst = array();

		$result = querydb($tSql);

		foreach($result as $temp)
		{
		    $type = 0;
		    if($temp["����"] == "�˻�"){
                $type = 1;
            }

            $lst[] = array(
                '����'=>substr($temp["����"],-3),
                '����'=>$temp["����"],
                '��Ʒ����'=>$temp["��Ʒ����"],
                '��Ʒ����'=>$temp["��Ʒ����"],

                //$weight = substr($weight,0,strpos($weight,".")+3);
                '���'=>$temp["���"],
                '����'=>str_replace('.000','',$temp["����"]),
                '����'=>str_replace('.000','',$temp["����"]),

                '�ӹ���'=>str_replace('.00','',$temp["�ӹ���"]),
                'ʵ�۹���'=>str_replace('.00','',$temp["ʵ�۹���"]),

                'ԭ�ۼ�'=>str_replace('.000','',$temp["ԭ�ۼ�"]),
                'ʵ�ۼ�'=>str_replace('.000','',$temp["ʵ�ۼ�"]),

                '����Ա'=>$temp["����Ա"],
                '�ŵ�'=>str_replace('OL�鱦','',$temp["����"]),
                'Type'=>$type,
            );



		} 

		$this->assign('lst1',$lst);

		$this->assign('saledate',$saledate);

        $this->show();
    }
}