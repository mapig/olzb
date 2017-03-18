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

        $tSql="SELECT ����,��������,��ɫ,��ʯ,���,����,���ռ�,�ۿ�,�ֿ۽��,���� FROM JBF_���۾��ϱ� WHERE ʱ�� BETWEEN '{saledate} 00:00:00' AND '{saledate} 23:59:59' ORDER BY ʱ��";

        $tSql=str_replace('{saledate}',$saledate,$tSql);

        $lst1 = array();

        $result = querydb($tSql);

        //dump($tSql);

        foreach($result as $temp)
        {
            $lst1[] = array(

                'dh'  =>$temp[0],//[����]
                'lx'  =>gbk2utf8($temp[1]),//[��������]
                'cs'  =>gbk2utf8($temp[2]),//[��ɫ]

                'bs'  =>gbk2utf8($temp[3]),//��ʯ
                'lb'  =>gbk2utf8($temp[4]),//���
                'kz'  =>$temp[5],//[����]

                'hsj' =>$temp[6],//[���ռ�]
                'zk'  =>$temp[7],//[�ۿ�]
                'dkje'=>$temp[8],//[�ֿ۽��]
                'gf'  =>$temp[9],//[����]
            );
        }

        $this->assign('lst1',$lst1);

        $this->assign('saledate',$saledate);

        $this->show();

    }
}