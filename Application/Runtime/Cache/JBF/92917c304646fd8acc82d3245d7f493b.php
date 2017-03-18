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
	<!-- Default panel contents -->

	<fieldset>
		<legend>&nbsp;库存统计查询&nbsp;[当前门店:<?php echo ($saleshop); ?>]</legend>

		<span>&nbsp;统计内容:&nbsp;</span>

		<select name="analysistype" id="analysistype">
			<option>黄金</option>
			<option>铂金</option>
			<option>硬金</option>
			<option>彩金</option>
		</select>

		&nbsp;

		<button  class="pure-button pure-button-primary" onclick="search()">查询</button>

	</fieldset>


	<div id="container" style="min-width:400px;height:300px;"></div>


	<script>
        $(function () {
            $('#container').highcharts({
                chart: {
                    type: 'column'
                },
                title: {
                    text: '饰品库存分析'
                },
                xAxis: {
                    categories: ['0', '10', '20', '30', '40', '50', '60', '70', '80', '90', '100']   //指定x轴分组
                },
                yAxis: {
                    title: {
                        text: '饰品分布'
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
                        categories: ['0', '10', '20', '30', '40', '50', '60', '70', '80', '90', '100']   //指定x轴分组
                    },
                    yAxis: {
                        title: {
                            text: '金重分布'
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