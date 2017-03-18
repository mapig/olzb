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

        $tSql="SELECT T.���۵��� AS XSDH,T.�������� AS XSLX,T.��Ʒ���� AS SPMC,T.��Ʒ���� AS SPTM,T.�ۿ��� AS ZKL,T.ʵ�۹��� AS SXGF,T.ʵ�۽�� AS SXJJ,T.ʵ�ۼ� AS SSJ,T.���� AS ZZ,T.���� AS JZ,G.�ۼ� AS BQSJ,G.������ AS BQJZ,G.�ܼ��� AS BQZZ,G.�ӹ��ѷ�ʽ AS JGFFS,G.�ӹ��� AS BQJGF,G.��Ʒ���� AS LB1,G.���� AS LB2,G.���� AS LB3 ,C.C0218 AS XSY, C.C0205 AS XSMD, C.C0217 AS HYBH, C.C0214 AS HYMC FROM(SELECT D.SaleID AS ���۵���,D.Type AS ��������,D.C0185 AS ��Ʒ����,D.C0302 AS ��Ʒ����,D.C0306 AS �ۿ���,D.C0318 AS ʵ�۹���,D.C0317 AS ʵ�۽��,D.C0303 AS ʵ�ۼ�,D.c0312 AS ����, D.c0313 AS ���� FROM ITSV.uZBSALE.dbo.v_jbf_xsd_detail AS D WHERE SaleID LIKE '{dh}') AS T LEFT JOIN ��Ʒ�� AS G ON T.��Ʒ���� = G.����� LEFT JOIN ITSV.uZBSALE.dbo.C02 AS C ON T.���۵��� = C.C0201 {md} ORDER BY T.���۵���";

        //WHERE C.C0205='OL�鱦���·��'
        //WHERE C.C0205='OL�鱦˾�ſڵ�'
        $md = '';

        if (!is_null($saleshop) and $saleshop!='ȫ���ŵ�' ){
            $md = "WHERE C.C0205='".$saleshop."'";
        }
        else
        {
            $saleshop = 'ȫ���ŵ�';
        }

        $tSql=str_replace('{md}', $md, $tSql);

        $tSql=str_replace('{dh}', $dh, $tSql);

        $lst = array();

        //print $tSql;

        $result = querydb($tSql);

        //header("Content-type: text/html; charset=utf-8");

        foreach($result as $temp)
        {
            //���۵���
            $xsdh = $temp['XSDH'];
            //����Ա
            $xsy  = gbk2utf8($temp['XSY']);
            //�����ŵ�
            $xsmd = gbk2utf8($temp['XSMD']);
            //��Ա���
            $hybh = $temp['HYBH'];
            //��Ա����
            $hymc = gbk2utf8($temp['HYMC']);


            if(!array_key_exists($xsdh, $lst))
            {
                $lst[$xsdh] = array();

                $lst[$xsdh]["���۵���"] = $xsdh;

                $lst[$xsdh]["������"]   = 0;
                $lst[$xsdh]["��950����"]  = 0;
                $lst[$xsdh]["�㲬����"]   = 0;
                $lst[$xsdh]["��������"]   = 0;
                $lst[$xsdh]["��������"]   = 0;
                $lst[$xsdh]["�Żݽ��"]   = 0;

                $lst[$xsdh]["�ƽ����"]   = 0;
                $lst[$xsdh]["��950����"]  = 0;
                $lst[$xsdh]["�㲬����"]   = 0;
                $lst[$xsdh]["��750����"]  = 0;
                $lst[$xsdh]["���ξ���"]   = 0;
                $lst[$xsdh]["�����Ͽ���"] = 0;

                $lst[$xsdh]["�ؽ�����"]   = 0;
                $lst[$xsdh]["Ӳ������"]   = 0;
                $lst[$xsdh]["�ƽ���Ƕ"]   = 0;
                $lst[$xsdh]["��������"]   = 0;
                $lst[$xsdh]["�ʽ�����"]   = 0;
                $lst[$xsdh]["��������"]   = 0;
                $lst[$xsdh]["��������"]   = 0;
                $lst[$xsdh]["��������"]   = 0;
                $lst[$xsdh]["��Ƕ����"]   = 0;
                $lst[$xsdh]["��������"]   = 0;

                $lst[$xsdh]["���ϵֿ�"]   = 0;

                $lst[$xsdh]["����Ա"]   = $xsy;
                $lst[$xsdh]["��Ա���"]   = $hybh;
                $lst[$xsdh]["��Ա����"]   = $hymc;

                $lst[$xsdh]["ʵ���ܶ�"]   = 0;
            }

            //ϵͳ����
            $lb1 = gbk2utf8($temp['LB1']);
            //����
            $lb2 = gbk2utf8($temp['LB2']);
            //����
            $lb3 = gbk2utf8($temp['LB3']);

            //����
            $jz = $temp['JZ'];
            //����
            $zz = $temp['ZZ'];

            //��������
            $xslx = gbk2utf8($temp['XSLX']);
            //��Ʒ����
            $spmc = gbk2utf8($temp['SPMC']);
            //��Ʒ����
            $sptm = $temp['SPTM'];
            //ʵ�ۼ�
            $ssj = $temp['SSJ'];

            //ʵ������
            $sxgf = $temp['SXGF'];

            //print $xsdh." ".$xslx." ".$spmc." ".$sptm." ".$lb1." ".$lb2." ".$lb3." ".$ssj." ".$jz." ".$zz." ".$xsy." ".$hybh." ".$hymc."<br/>";


            //���ش���0 ���۽���
            if($xslx == "����" and $jz>0)
            {
                if($lb1 == "SGL" and strstr($spmc,"���"))
                {
                    $lst[$xsdh]["������"] += $jz;
                }
                elseif ($lb1 == "SGL" and strstr($spmc,"��950"))
                {
                    $lst[$xsdh]["��950����"] += $jz;
                }
                elseif ($lb1 == "SGL" and strstr($spmc,"�㲬"))
                {
                    $lst[$xsdh]["�㲬����"] += $jz;
                }
                elseif ($lb1 == "SAG" and  $lb2 == "����")
                {
                    $lst[$xsdh]["��������"] += $jz;
                }
                else
                {
                    $lst[$xsdh]["��������"] += $jz;
                }
            }

            //���ش���0 ���˽���
            if($xslx == "����" and $jz>0)
            {
                if($lb1 == "SGL" and strstr($spmc,"���"))
                {
                    $lst[$xsdh]["������"] -= $jz;
                }
                elseif ($lb1 == "SGL" and strstr($spmc,"��950"))
                {
                    $lst[$xsdh]["��950����"] -= $jz;
                }
                elseif ($lb1 == "SGL" and strstr($spmc,"�㲬"))
                {
                    $lst[$xsdh]["�㲬����"] -= $jz;
                }
                elseif ($lb1 == "SAG" and  $lb2 == "����")
                {
                    $lst[$xsdh]["��������"] -= $jz;
                }
                else
                {
                    $lst[$xsdh]["��������"] -= $jz;
                }
            }

            //��������Ϊ�ۿ�
            if($xslx == "�ۿ�")
            {
                $lst[$xsdh]["�Żݽ��"] += $ssj;
            }

            //��������Ϊ����
            if($xslx == "����")
            {
                if (strstr($spmc,"���"))
                {
                    $lst[$xsdh]["�ƽ����"] += $jz;
                }
                elseif (strstr($spmc,"��950"))
                {
                    $lst[$xsdh]["��950����"] += $jz;
                }
                elseif (strstr($spmc,"�㲬"))
                {
                    $lst[$xsdh]["�㲬����"] += $jz;
                }
                elseif (strstr($spmc,"��750"))
                {
                    $lst[$xsdh]["��750����"] += $jz;
                }
                elseif (strstr($spmc,"����"))
                {
                    $lst[$xsdh]["���ξ���"] += $jz;
                }
                else
                {
                    $lst[$xsdh]["�����Ͽ���"] += $jz;
                }

                $lst[$xsdh]["���ϵֿ�"]  += $ssj;
            }


            if($xslx == "����" or $xslx == "����")
            {
                if ($lb2 == "���")
                {
                    $lst[$xsdh]["�ؽ�����"]   += $ssj;
                }
                elseif ($lb2 == "3D���")
                {
                    $lst[$xsdh]["Ӳ������"]   += $ssj;
                }
                elseif ($lb1 == "SGL" and $lb2 == "�����Ƕ")
                {
                    $lst[$xsdh]["�ؽ�����"]   += ($ssj -$sxgf);

                    $lst[$xsdh]["�ƽ���Ƕ"]   += $sxgf;
                }
                elseif ($lb1 == "SGN" and $lb2 == "�����Ƕ")
                {
                    $lst[$xsdh]["�ƽ���Ƕ"]   += $ssj;
                }
                elseif ($lb2 == "����")
                {
                    $lst[$xsdh]["��������"]   += $ssj;
                }
                elseif ($lb2 == "�ʽ�")
                {
                    $lst[$xsdh]["�ʽ�����"]   += $ssj;
                }
                elseif ($lb1 == "SAG" and $lb2 == "����")
                {
                    $lst[$xsdh]["��������"]   += $ssj;
                }
                elseif ($lb1 == "YSL" and $lb2 == "����")
                {
                    $lst[$xsdh]["��������"]   += $ssj;
                }
                elseif ($lb2 == "����")
                {
                    $lst[$xsdh]["��������"]   += $ssj;
                }
                elseif ($lb2 == "��Ƕ")
                {
                    $lst[$xsdh]["��Ƕ����"]   += $ssj;
                }
                else
                {
                    $lst[$xsdh]["��������"]   += $ssj;
                }
            }

            $lst[$xsdh]["ʵ���ܶ�"] += $ssj;
        }

        //print_r($lst);

        $this->assign('lst',$lst);

        $this->assign('saledate',$saledate);

        $this->assign('saleshop',$saleshop);

        $this->show();
    }
}