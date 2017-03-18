<?php
namespace JBF\Controller;
use Think\Controller;

class KQController extends Controller {

	//库存查询
    public function index(){

    	//打卡数据表
		$tSql1 = "SELECT *,SUBSTRING(Mode,0,11) AS KQDate,SUBSTRING(Mode,12,5) AS KQTime FROM KQ WHERE SUBSTRING(Mode,0,8) = '2017/02' ORDER BY Name, KQDate ASC, KQTime ASC";

		//打卡数据集
		$result1 = querydb1($tSql1); 

		//个人考勤数据
		$person = array();

		foreach($result1 as $temp1)
		{
			$name =  trim(gbk2utf8($temp1[3])) ;

			$kqdate = $temp1[8];

			$kqtime = $temp1[9];

			if($person[$name] == ''){
			   	$person[$name] = array();
			}

			if($person[$name][$kqdate] == ''){
			   	$person[$name][$kqdate] = array();
			}

			$person[$name][$kqdate][] = $kqtime;
		} 

		// 补齐日期
		$tSql2 = "SELECT DISTINCT SUBSTRING(Mode,0,11) AS KQDate FROM KQ WHERE SUBSTRING(Mode,0,8) = '2017/02' ORDER BY KQDate ASC";

		$result2 = querydb1($tSql2); 

		foreach($result2 as $temp2)
		{
			$d = $temp2[0];

			foreach($person as $key => $value)
			{
				if($person[$key][$d] == ''){
					$person[$key][$d] = array();
				}
			} 
		}

		$resutl3 = array();

		//整理数据
		foreach($person as $kname => $vkq)
		{
			//日期排序
			ksort($vkq);

			//姓名
			//dump($kname);

			//考勤 日期集合 下面时间集合
			//dump($vkq);

			$resutl4 = array();

			foreach($vkq as $kdt => $vtm)
			{
				//日期集合
				$resutl4[] = join("</br>",$vtm);
			}

			$resutl3[] = array("NAME"=>$kname, "KQ"=>"<td>".join("</td><td>",$resutl4)."</td>");
		} 

		//dump($resutl3);
		//dump($result2);
		//
		$this->assign('dt', $result2);

		$this->assign('person', $resutl3);

		this.$this->display();

    }
}