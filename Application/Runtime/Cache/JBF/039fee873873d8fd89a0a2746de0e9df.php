<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=GBK" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>欧蕾珠宝</title>
    <link rel="stylesheet" href="//wholzb.com/pure/pure-min.css" />
    <link rel="stylesheet" href="//wholzb.com/pure-custom-skin.css" />
    <!--script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.0.0.min.js"></script-->
	<script src="//cdn.bootcss.com/jquery/3.1.1/jquery.min.js"></script>

    <script src="//wholzb.com/js/layer/layer.js"></script>
    <!-- 引入 ECharts 文件 -->
    <!--script src="//cdn.bootcss.com/echarts/3.2.3/echarts.min.js"></script-->
	<script src="//cdn.hcharts.cn/highcharts/highcharts.js"></script>
	<!-- 
	<script src="http://www.wholzb.com/web/js/jquery-3.0.0.min.js"></script> 
	-->
    
	<style>
	   .dth-l{
			border-left:1px solid #ededed;  
			border-top:1px solid #ededed; 
			border-bottom:1px solid #ededed; 
			text-align:center; 
			height: 30px;
			line-height: 30px;
			background-color: #dedede;
	   }

	   .dth-r{border-right:1px solid #ededed; text-align:center; }

	   .dt1-l{
			border-left:1px solid #ededed;  
			border-bottom:1px solid #ededed; 
			text-align:center; 
			height: 30px;
			line-height: 30px;
			background-color: #fafafa;
	   }

	   .dt1-r{border-right:1px solid #ededed; text-align:center; }


	   .dt2-l{
			border-left:1px solid #ededed;  
			border-bottom:1px solid #ededed; 
			text-align:center; 
			height: 30px;
			line-height: 30px;
			background-color: #ffe;
			color: #999999;
		   }

	   .dt2-r{border-right:1px solid #ededed; text-align:center; }

	   .dt3-l{
			border-left:1px solid #ededed;  
			border-bottom:1px solid #ededed; 
			text-align:center; 
			height: 30px;
			line-height: 30px;
	   }
   		.btnSelect{
			width:75px;
			margin-top: 3px;
			margin-bottom: 3px;

		}

	</style>
</head>

<body>
	<div class="pure-menu pure-menu-open pure-menu-horizontal">
	    <ul>
			<li><a href="<?php echo U('JBF/Index/index');?>">系统首页</a></li>
			<li><a href="<?php echo U('JBF/Stock/index');?>">库存统计</a></li>
			<li><a href="<?php echo U('JBF/Stock/analysis');?>">库存分析</a></li>
			<li><a href="<?php echo U('JBF/Sale/index');?>">首饰销售</a></li>
			<li><a href="<?php echo U('JBF/Material/index');?>">旧料回收</a></li>
			<li><a href="<?php echo U('JBF/Stock/checkin');?>">首饰上货</a></li>
			<li><a href="<?php echo U('JBF/Stock/checkout');?>">首饰异动</a></li>
			<li><a href="<?php echo U('JBF/Stock/sfind');?>">商品查询</a></li>
			<li><a href="<?php echo U('JBF/SalesAnalysis/index');?>">销售单据</a></li>
	    </ul>
	</div>
	

<script type="text/javascript">
    function clearcode(){
        $("#stockcode").val("");
    }

    function backspacecode(){
        var strCode = $("#stockcode").val();
        var strLen = strCode.length;
        if(strLen > 0){
            strCode = strCode.substr(0,strLen-1);
            $("#stockcode").val(strCode);
        }
    }

    function addcode(a){
        var strCode = $("#stockcode").val();
        if(strCode == "00000000"){
            strCode = "";
        }
        strCode = strCode + a;
        $("#stockcode").val(strCode);
    }
</script>

<div class="pure-skin-mine">
	<form class="pure-form pure-skin-mine" role="search"  method ="post" action="<?php echo U('JBF/Stock/sfind');?>">
		<fieldset>
			<legend>&nbsp;商品查询&nbsp;[当前条码:<?php echo ($info["tmh"]); ?>]</legend>

			<span>&nbsp;商品条码:&nbsp;</span>

			<input id="stockcode" name="stockcode" type="text" value="<?php echo ($info["tmh"]); ?>">

			&nbsp;

			<button type="submit" class="pure-button pure-button-primary">查询</button>

		</fieldset>
	</form>
</div>

<div class="pure-g pure-skin-mine">

	<div class="pure-u-1-3" style="text-align: center;"><button onclick="addcode('1');" class="pure-button btnSelect">1</button></div>
	<div class="pure-u-1-3" style="text-align: center;"><button onclick="addcode('2');" class="pure-button btnSelect">2</button></div>
	<div class="pure-u-1-3" style="text-align: center;"><button onclick="addcode('3');" class="pure-button btnSelect">3</button></div>

	<div class="pure-u-1-3" style="text-align: center;"><button onclick="addcode('4');" class="pure-button btnSelect">4</button></div>
	<div class="pure-u-1-3" style="text-align: center;"><button onclick="addcode('5');" class="pure-button btnSelect">5</button></div>
	<div class="pure-u-1-3" style="text-align: center;"><button onclick="addcode('6');" class="pure-button btnSelect">6</button></div>

	<div class="pure-u-1-3" style="text-align: center;"><button onclick="addcode('7');" class="pure-button btnSelect">7</button></div>
	<div class="pure-u-1-3" style="text-align: center;"><button onclick="addcode('8');" class="pure-button btnSelect">8</button></div>
	<div class="pure-u-1-3" style="text-align: center;"><button onclick="addcode('9');" class="pure-button btnSelect">9</button></div>

	<div class="pure-u-1-3" style="text-align: center;"><button onclick="addcode('0');" class="pure-button btnSelect">0</button></div>
	<div class="pure-u-1-3" style="text-align: center;"><button onclick="backspacecode();" class="pure-button btnSelect">回退</button></div>
	<div class="pure-u-1-3" style="text-align: center;"><button onclick="clearcode();" class="pure-button btnSelect">清除</button></div>

</div>


<div style="font-size:1px;line-height:1px;width:100%;background-color:#ededed;margin-bottom: 10px;">&nbsp;</div>

<div class="pure-g pure-skin-mine">
	<div class="pure-u-1" style="text-align:center;" >
		<img class="pure-img" style="margin-bottom: 10px; margin-left: 10px;" src="http://image.wholzb.com/product/<?php echo ($info["tmh"]); ?>.jpg" />
	</div>

	<div class="pure-u-1-2"><div class="dt2-l">产品条码</div></div>
	<div class="pure-u-1-2"><div class="dt2-l"><?php echo ($info["tmh"]); ?></div></div>

	<div class="pure-u-1-2"><div class="dt2-l">产品名称</div></div>
	<div class="pure-u-1-2"><div class="dt2-l"><?php echo ($info["cpmc"]); ?></div></div>

	<div class="pure-u-1-2"><div class="dt2-l">产品证书</div></div>
	<div class="pure-u-1-2"><div class="dt2-l"><?php echo ($info["zsh"]); ?></div></div>

	<div class="pure-u-1-2"><div class="dt2-l">产品种类</div></div>
	<div class="pure-u-1-2"><div class="dt2-l"><?php echo ($info["zl"]); ?></div></div>

	<div class="pure-u-1-2"><div class="dt2-l">产品类别</div></div>
	<div class="pure-u-1-2"><div class="dt2-l"><?php echo ($info["lb"]); ?></div></div>

	<div class="pure-u-1-2"><div class="dt2-l">产品总重</div></div>
	<div class="pure-u-1-2"><div class="dt2-l"><?php echo ($info["zjz"]); ?></div></div>

	<div class="pure-u-1-2"><div class="dt2-l">产品金重</div></div>
	<div class="pure-u-1-2"><div class="dt2-l"><?php echo ($info["jjz"]); ?></div></div>

	<div class="pure-u-1-2"><div class="dt2-l">加工费</div></div>
	<div class="pure-u-1-2"><div class="dt2-l"><?php echo ($info["jgf"]); ?></div></div>

	<div class="pure-u-1-2"><div class="dt2-l">售价</div></div>
	<div class="pure-u-1-2"><div class="dt2-l"><?php echo ($info["sj"]); ?></div></div>

	<div class="pure-u-1-2"><div class="dt2-l">备注</div></div>
	<div class="pure-u-1-2"><div class="dt2-l"><?php echo ($info["ssj"]); ?></div></div>


</div>
</body>
</html>