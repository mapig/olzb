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
	<form class="pure-form pure-skin-mine" role="search"  method ="post" action="<?php echo U('JBF/SalesAnalysis/index');?>">
		<fieldset>
			<legend>&nbsp;���۵��ݲ�ѯ&nbsp;[��ǰ����:<?php echo ($saledate); ?>]</legend>

			<span>&nbsp;��������:&nbsp;</span>

			<input name="saledate" id="saledate" type="text" style="width:100px;" value="<?php echo ($saledate); ?>"  >

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
</div>

<div style="font-size:1px;line-height:1px;width:100%;background-color:#ededed;margin-bottom: 10px;">&nbsp;</div>

<table class="pure-table pure-table-bordered">
	<thead>
	<tr style="font-size: 9pt; text-align: center;">
		<th>���۵���</th>

		<th>������</th>
		<th>��950����</th>
		<th>�㲬����</th>
		<th>��������</th>
		<th>��������</th>

		<th>�ֽ�֧��</th>
		<th>POS��֧��</th>
		<th>֧����֧��</th>
		<th>΢��֧��</th>
		<th>������ʽ֧��</th>
		<th>������ʽ֧�����</th>
		<th>�Żݽ��</th>
		<th>ʵ���ܶ�</th>

		<th>�ƽ����</th>
		<th>��950����</th>
		<th>�㲬����</th>
		<th>��750����</th>
		<th>���ξ���</th>
		<th>�����Ͽ���</th>

		<th>�ؽ�����</th>
		<th>Ӳ������</th>
		<th>�ƽ���Ƕ</th>
		<th>��������</th>
		<th>�ʽ�����</th>
		<th>��������</th>
		<th>��������</th>
		<th>��������</th>
		<th>��Ƕ����</th>
		<th>��������</th>
		<th>���ϵֿ�</th>

		<th>����Ա</th>
		<th>���</th>
		<th>��Ա����</th>
		<th>��Ա���</th>
		<th>��Ա����</th>
		<th>��ע</th>
	</tr>
	</thead>
	<tbody>
	<?php if(is_array($lst)): foreach($lst as $key=>$sub): ?><tr>
			<td><?php echo ($sub["���۵���"]); ?></td>

			<td><?php echo ($sub["������"]); ?></td>
			<td><?php echo ($sub["��950����"]); ?></td>
			<td><?php echo ($sub["�㲬����"]); ?></td>
			<td><?php echo ($sub["��������"]); ?></td>
			<td><?php echo ($sub["��������"]); ?></td>


			<td><?php echo ($sub["ʵ���ܶ�"]); ?></td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td></td>
			<td><?php echo ($sub["�Żݽ��"]); ?></td>
			<td><?php echo ($sub["ʵ���ܶ�"]); ?></td>


			<td><?php echo ($sub["�ƽ����"]); ?></td>
			<td><?php echo ($sub["��950����"]); ?></td>
			<td><?php echo ($sub["�㲬����"]); ?></td>
			<td><?php echo ($sub["��750����"]); ?></td>
			<td><?php echo ($sub["���ξ���"]); ?></td>
			<td><?php echo ($sub["�����Ͽ���"]); ?></td>

			<td><?php echo ($sub["�ؽ�����"]); ?></td>
			<td><?php echo ($sub["Ӳ������"]); ?></td>
			<td><?php echo ($sub["�ƽ���Ƕ"]); ?></td>
			<td><?php echo ($sub["��������"]); ?></td>
			<td><?php echo ($sub["�ʽ�����"]); ?></td>
			<td><?php echo ($sub["��������"]); ?></td>
			<td><?php echo ($sub["��������"]); ?></td>
			<td><?php echo ($sub["��������"]); ?></td>
			<td><?php echo ($sub["��Ƕ����"]); ?></td>
			<td><?php echo ($sub["��������"]); ?></td>

			<td><?php echo ($sub["���ϵֿ�"]); ?></td>

			<td><?php echo ($sub["����Ա"]); ?></td>
			<td>0</td>
			<td><?php echo ($sub["��Ա����"]); ?></td>
			<td><?php echo ($sub["��Ա���"]); ?></td>
			<td><?php echo ($sub["��Ա����"]); ?></td>
			<td></td>
		</tr><?php endforeach; endif; ?>
	</tbody>
</table>
</body>
</html>