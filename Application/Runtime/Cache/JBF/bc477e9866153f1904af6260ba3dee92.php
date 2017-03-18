<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=GBK" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ŷ���鱦</title>
    <link rel="stylesheet" href="//wholzb.com/pure/pure-min.css" />
    <link rel="stylesheet" href="//wholzb.com/pure-custom-skin.css" />
    <!--script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.0.0.min.js"></script-->
	<script src="//cdn.bootcss.com/jquery/3.1.1/jquery.min.js"></script>

    <script src="//wholzb.com/js/layer/layer.js"></script>
    <!-- ���� ECharts �ļ� -->
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
			<li><a href="<?php echo U('JBF/Index/index');?>">ϵͳ��ҳ</a></li>
			<li><a href="<?php echo U('JBF/Stock/index');?>">���ͳ��</a></li>
			<li><a href="<?php echo U('JBF/Stock/analysis');?>">������</a></li>
			<li><a href="<?php echo U('JBF/Sale/index');?>">��������</a></li>
			<li><a href="<?php echo U('JBF/Material/index');?>">���ϻ���</a></li>
			<li><a href="<?php echo U('JBF/Stock/checkin');?>">�����ϻ�</a></li>
			<li><a href="<?php echo U('JBF/Stock/checkout');?>">�����춯</a></li>
			<li><a href="<?php echo U('JBF/Stock/sfind');?>">��Ʒ��ѯ</a></li>
			<li><a href="<?php echo U('JBF/SalesAnalysis/index');?>">���۵���</a></li>
	    </ul>
	</div>
	

<div class="pure-skin-mine">
	<form class="pure-form pure-skin-mine" role="search"  method ="post" action="<?php echo U('JBF/Stock/checkout');?>">

		<fieldset>
			<legend>&nbsp;�����»���ѯ&nbsp;[��ǰ����:<?php echo ($saledate); ?>]</legend>

			<span>&nbsp;�»�����:&nbsp;</span>

			<input name="saledate" id="saledate" type="text" style="width:100px;" value="<?php echo ($saledate); ?>"  >

			&nbsp;

			<!--span>&nbsp;��ѯ�ŵ�:&nbsp;</span>

            <select name="saleshop" id="saleshop">
                <option>ȫ���ŵ�</option>
                <option>OL�鱦���·��</option>
                <option>OL�鱦˾�ſڵ�</option>
            </select-->

			<button type="submit" class="pure-button pure-button-primary">��ѯ</button>

		</fieldset>
	</form>
</div>

<div class="pure-g pure-skin-mine">



	<?php if(is_array($lst1)): foreach($lst1 as $key=>$sub): ?><div class="pure-u-1-4"><div class="dth-l">����</div></div>
		<div class="pure-u-1-4"><div class="dth-l" style="color:#ff0000;"><?php echo ($sub["no"]); ?></div></div>
		<div class="pure-u-1-4"><div class="dth-l">�ŵ�</div></div>
		<div class="pure-u-1-4"><div class="dth-l" style="color:#ff0000;"><?php echo ($sub["shop"]); ?></div></div>

		<div class="pure-u-3-8"><div class="dth-l">����</div></div>
		<div class="pure-u-1-4"><div class="dth-l">����</div></div>
		<div class="pure-u-1-8"><div class="dth-l">����</div></div>
		<div class="pure-u-1-8"><div class="dth-l">����</div></div>
		<div class="pure-u-1-8"><div class="dth-l">�ۼ�</div></div>




		<?php if(is_array($sub["item"])): foreach($sub["item"] as $key=>$item): ?><div class="pure-u-3-8"><div class="dt1-l"><?php echo ($item["name"]); ?></div></div>
			<div class="pure-u-1-4"><div class="dt1-l" onclick="showproduct('<?php echo ($item["code"]); ?>')" style="color:#4096ee;"><?php echo ($item["code"]); ?></div></div>
			<div class="pure-u-1-8"><div class="dt1-l"><?php echo ($item["catalog"]); ?></div></div>
			<div class="pure-u-1-8"><div class="dt1-l"><?php echo ($item["weight"]); ?></div></div>
			<div class="pure-u-1-8"><div class="dt1-l"><?php echo ($item["price"]); ?></div></div><?php endforeach; endif; endforeach; endif; ?>

</div>
</body>
</html>