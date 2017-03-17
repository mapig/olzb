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
	

<script type="text/javascript">
    $(function(){
        // $("#jumpMenu").val(Ҫѡ�е�option��valueֵ����);
        $("#saleshop").val("<?php echo ($saleshop); ?>");
    });
</script>

<div class="pure-skin-mine">
	<!-- Default panel contents -->

	<form class="pure-form pure-skin-mine" role="search"  method ="post" action="<?php echo U('JBF/Stock/index');?>">
		<fieldset>
			<legend>&nbsp;���ͳ�Ʋ�ѯ&nbsp;[��ǰ�ŵ�:<?php echo ($saleshop); ?>]</legend>

			<span>&nbsp;��ѯ�ŵ�:&nbsp;</span>

			<select name="saleshop" id="saleshop">
				<option>ȫ���ŵ�</option>
				<option>OL�鱦���·��</option>
				<option>OL�鱦˾�ſڵ�</option>
			</select>

			&nbsp;

			<button type="submit" class="pure-button pure-button-primary">��ѯ</button>

		</fieldset>
	</form>

	<div class="panel-heading" style="margin-left: 10px; margin-top:20px; margin-bottom: 10px;">
		<span class="glyphicon glyphicon-home" aria-hidden="true"></span> ʵʱ����ѯ&nbsp;&nbsp;<span style="color:#0099CC">[�������:<?php echo ($lst3); ?>]<span>
	</div>

	<table class="pure-table  pure-table-bordered" width="100%" style="text-align: center;">
		<thead style="text-align: center;">
		<tr>
			<th>����</th>
			<th>���</th>
			<th>����</th>
		</tr>
		</thead>
		<tbody>

		<?php if(is_array($lst1)): foreach($lst1 as $key=>$sub): ?><tr>
				<td><?php echo ($sub["name"]); ?></td>
				<td><?php echo ($sub["number"]); ?></td>
				<td><?php echo ($sub["weight"]); ?></td>
			</tr><?php endforeach; endif; ?>
		</tbody>
	</table>
</div>



<div class="panel panel-default" >
	<!-- Default panel contents -->
	<div class="panel-heading"style="margin-left: 10px; margin-top:20px; margin-bottom: 10px;" >
		<span class="glyphicon glyphicon-home" aria-hidden="true"></span> �ƽ����ѯ
	</div>
	<!--div class="panel-body">
        <form class="navbar-form navbar-left" role="search">
            <div class="form-group">
                <span>����:</span>
                <input type="text" class="datepicker form-control" readonly>
            </div>
            <button type="submit" class="btn btn-default">�ύ</button>
        </form>
    </div-->

	<table class="pure-table  pure-table-bordered"  width="100%"  style="text-align: center;">
		<thead style="text-align: center;">
		<tr >
			<th>Ʒ��</th>
			<th>���</th>
			<th>����</th>
		</tr>
		</thead>
		<tbody>

		<?php if(is_array($lst2)): foreach($lst2 as $key=>$sub): ?><tr>
				<td><?php echo ($sub["name"]); ?></td>
				<td><?php echo ($sub["number"]); ?></td>
				<td><?php echo ($sub["weight"]); ?></td>
			</tr><?php endforeach; endif; ?>
		</tbody>
	</table>
</div>
</body>
</html>