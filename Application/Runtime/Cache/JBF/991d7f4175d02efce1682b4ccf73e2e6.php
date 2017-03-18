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
    $(function(){
        // $("#jumpMenu").val(要选中的option的value值即可);
        $("#saleshop").val("<?php echo ($saleshop); ?>");
    });

</script>
<div class="pure-skin-mine">
	<form class="pure-form pure-skin-mine" role="search"  method ="post" action="<?php echo U('JBF/SalesAnalysis/index');?>">
		<fieldset>
			<legend>&nbsp;销售单据查询&nbsp;[当前日期:<?php echo ($saledate); ?>]</legend>

			<span>&nbsp;销售日期:&nbsp;</span>

			<input name="saledate" id="saledate" type="text" style="width:100px;" value="<?php echo ($saledate); ?>"  >

			<span>&nbsp;查询门店:&nbsp;</span>
			<select name="saleshop" id="saleshop">
				<option>全部门店</option>
				<option>OL珠宝解放路店</option>
				<option>OL珠宝司门口店</option>
			</select>
			&nbsp;
			<button type="submit" class="pure-button pure-button-primary">查询</button>

		</fieldset>
	</form>
</div>

<div style="font-size:1px;line-height:1px;width:100%;background-color:#ededed;margin-bottom: 10px;">&nbsp;</div>

<table class="pure-table pure-table-bordered">
	<thead>
	<tr style="font-size: 9pt; text-align: center;">
		<th>销售单号</th>

		<th>足金克重</th>
		<th>铂950克重</th>
		<th>足铂克重</th>
		<th>足银克重</th>
		<th>其它克重</th>

		<th>现金支付</th>
		<th>POS机支付</th>
		<th>支付宝支付</th>
		<th>微信支付</th>
		<th>其它方式支付</th>
		<th>其它方式支付类别</th>
		<th>优惠金额</th>
		<th>实付总额</th>

		<th>黄金旧料</th>
		<th>铂950旧料</th>
		<th>足铂旧料</th>
		<th>金750旧料</th>
		<th>银饰旧料</th>
		<th>其它料克重</th>

		<th>素金销售</th>
		<th>硬金销售</th>
		<th>黄金镶嵌</th>
		<th>铂金销售</th>
		<th>彩金销售</th>
		<th>素银销售</th>
		<th>银饰销售</th>
		<th>玉器销售</th>
		<th>镶嵌销售</th>
		<th>其它销售</th>
		<th>旧料抵扣</th>

		<th>销售员</th>
		<th>提成</th>
		<th>会员积分</th>
		<th>会员编号</th>
		<th>会员姓名</th>
		<th>备注</th>
	</tr>
	</thead>
	<tbody>
	<?php if(is_array($lst)): foreach($lst as $key=>$sub): ?><tr>
			<td><?php echo ($sub["销售单号"]); ?></td>

			<td><?php echo ($sub["足金克重"]); ?></td>
			<td><?php echo ($sub["铂950克重"]); ?></td>
			<td><?php echo ($sub["足铂克重"]); ?></td>
			<td><?php echo ($sub["足银克重"]); ?></td>
			<td><?php echo ($sub["其它克重"]); ?></td>


			<td><?php echo ($sub["实付总额"]); ?></td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td></td>
			<td><?php echo ($sub["优惠金额"]); ?></td>
			<td><?php echo ($sub["实付总额"]); ?></td>


			<td><?php echo ($sub["黄金旧料"]); ?></td>
			<td><?php echo ($sub["铂950旧料"]); ?></td>
			<td><?php echo ($sub["足铂旧料"]); ?></td>
			<td><?php echo ($sub["金750旧料"]); ?></td>
			<td><?php echo ($sub["银饰旧料"]); ?></td>
			<td><?php echo ($sub["其它料克重"]); ?></td>

			<td><?php echo ($sub["素金销售"]); ?></td>
			<td><?php echo ($sub["硬金销售"]); ?></td>
			<td><?php echo ($sub["黄金镶嵌"]); ?></td>
			<td><?php echo ($sub["铂金销售"]); ?></td>
			<td><?php echo ($sub["彩金销售"]); ?></td>
			<td><?php echo ($sub["素银销售"]); ?></td>
			<td><?php echo ($sub["银饰销售"]); ?></td>
			<td><?php echo ($sub["玉器销售"]); ?></td>
			<td><?php echo ($sub["镶嵌销售"]); ?></td>
			<td><?php echo ($sub["其它销售"]); ?></td>

			<td><?php echo ($sub["旧料抵扣"]); ?></td>

			<td><?php echo ($sub["销售员"]); ?></td>
			<td>0</td>
			<td><?php echo ($sub["会员积分"]); ?></td>
			<td><?php echo ($sub["会员编号"]); ?></td>
			<td><?php echo ($sub["会员姓名"]); ?></td>
			<td></td>
		</tr><?php endforeach; endif; ?>
	</tbody>
</table>
</body>
</html>