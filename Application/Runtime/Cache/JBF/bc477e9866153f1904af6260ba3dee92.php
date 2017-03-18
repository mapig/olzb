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
	

<div class="pure-skin-mine">
	<form class="pure-form pure-skin-mine" role="search"  method ="post" action="<?php echo U('JBF/Stock/checkout');?>">

		<fieldset>
			<legend>&nbsp;首饰下货查询&nbsp;[当前日期:<?php echo ($saledate); ?>]</legend>

			<span>&nbsp;下货日期:&nbsp;</span>

			<input name="saledate" id="saledate" type="text" style="width:100px;" value="<?php echo ($saledate); ?>"  >

			&nbsp;

			<!--span>&nbsp;查询门店:&nbsp;</span>

            <select name="saleshop" id="saleshop">
                <option>全部门店</option>
                <option>OL珠宝解放路店</option>
                <option>OL珠宝司门口店</option>
            </select-->

			<button type="submit" class="pure-button pure-button-primary">查询</button>

		</fieldset>
	</form>
</div>

<div class="pure-g pure-skin-mine">



	<?php if(is_array($lst1)): foreach($lst1 as $key=>$sub): ?><div class="pure-u-1-4"><div class="dth-l">单号</div></div>
		<div class="pure-u-1-4"><div class="dth-l" style="color:#ff0000;"><?php echo ($sub["no"]); ?></div></div>
		<div class="pure-u-1-4"><div class="dth-l">门店</div></div>
		<div class="pure-u-1-4"><div class="dth-l" style="color:#ff0000;"><?php echo ($sub["shop"]); ?></div></div>

		<div class="pure-u-3-8"><div class="dth-l">名称</div></div>
		<div class="pure-u-1-4"><div class="dth-l">条码</div></div>
		<div class="pure-u-1-8"><div class="dth-l">类型</div></div>
		<div class="pure-u-1-8"><div class="dth-l">总重</div></div>
		<div class="pure-u-1-8"><div class="dth-l">售价</div></div>




		<?php if(is_array($sub["item"])): foreach($sub["item"] as $key=>$item): ?><div class="pure-u-3-8"><div class="dt1-l"><?php echo ($item["name"]); ?></div></div>
			<div class="pure-u-1-4"><div class="dt1-l" onclick="showproduct('<?php echo ($item["code"]); ?>')" style="color:#4096ee;"><?php echo ($item["code"]); ?></div></div>
			<div class="pure-u-1-8"><div class="dt1-l"><?php echo ($item["catalog"]); ?></div></div>
			<div class="pure-u-1-8"><div class="dt1-l"><?php echo ($item["weight"]); ?></div></div>
			<div class="pure-u-1-8"><div class="dt1-l"><?php echo ($item["price"]); ?></div></div><?php endforeach; endif; endforeach; endif; ?>

</div>
</body>
</html>