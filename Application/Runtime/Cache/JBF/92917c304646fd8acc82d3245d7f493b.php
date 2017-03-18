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
	<!-- Default panel contents -->

	<fieldset>
		<legend>&nbsp;���ͳ�Ʋ�ѯ&nbsp;[��ǰ�ŵ�:<?php echo ($saleshop); ?>]</legend>

		<span>&nbsp;ͳ������:&nbsp;</span>

		<select name="analysistype" id="analysistype">
			<option>�ƽ�</option>
			<option>����</option>
			<option>Ӳ��</option>
			<option>�ʽ�</option>
		</select>

		&nbsp;

		<button  class="pure-button pure-button-primary" onclick="search()">��ѯ</button>

	</fieldset>


	<div id="container" style="min-width:400px;height:300px;"></div>


	<script>
        $(function () {
            $('#container').highcharts({
                chart: {
                    type: 'column'
                },
                title: {
                    text: '��Ʒ������'
                },
                xAxis: {
                    categories: ['0', '10', '20', '30', '40', '50', '60', '70', '80', '90', '100']   //ָ��x�����
                },
                yAxis: {
                    title: {
                        text: '��Ʒ�ֲ�'
                    }
                },
                series: []
            });
        });


        function search(){

            //alert($("#analysistype").val());

            var stype = $("#analysistype").val();

            $.ajax({ url: "search", data: {type:stype},dataType:"json", success: function(e){

                var obj = jQuery.parseJSON(e);

                //alert(e);

                $('#container').highcharts({
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: obj.text
                    },
                    xAxis: {
                        categories: ['0', '10', '20', '30', '40', '50', '60', '70', '80', '90', '100']   //ָ��x�����
                    },
                    yAxis: {
                        title: {
                            text: '���طֲ�'
                        }
                    },
                    series: obj.series
                });

            }});
        }
	</script>


</div>



</body>
</html>