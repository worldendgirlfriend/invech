<?php exit;?>001550482673209718640926d8f2ea838121549c8df2s:1977:"a:2:{s:8:"template";s:1913:"<!--[if lte IE 8]>
<script src="/public/js/chart/excanvas.compiled.js"></script>
<![endif]-->
<div class="panel dux-box">
    <div class="panel-head clearfix">
    <div class="float-left">7天蜘蛛访问概况 </div>
    <div class="float-right">
    <span class="tag bg-blue">百度</span> <span class="tag bg-green">谷歌</span> <span class="tag bg-yellow">搜搜</span>
     </div>
    </div>
    <div class="panel-body">
        <div style="height:200px;">
            <canvas id="chart7"></canvas>
        </div>
    </div>
</div>
<br>
<div class="panel dux-box">
    <div class="panel-head clearfix">
    <div class="float-left">30天蜘蛛访问概况 </div>
    <div class="float-right">
    <span class="tag bg-blue">百度</span> <span class="tag bg-green">谷歌</span> <span class="tag bg-yellow">搜搜</span>
     </div>
    </div>
    <div class="panel-body">
        <div style="height:200px;">
            <canvas id="chart30"></canvas>
        </div>
    </div>
</div>
<br>
<div class="panel dux-box">
    <div class="panel-head clearfix">
    <div class="float-left">12个月蜘蛛访问概况 </div>
    <div class="float-right">
    <span class="tag bg-blue">百度</span> <span class="tag bg-green">谷歌</span> <span class="tag bg-yellow">搜搜</span>
     </div>
    </div>
    <div class="panel-body">
        <div style="height:200px;">
            <canvas id="chart12"></canvas>
        </div>
    </div>
</div>

<script>
    Do.ready('base', function () {
        
        
        var data = <?php echo $jsonArray1;?>;
        $("#chart7").duxChart({
            data: data
        });
        var data = <?php echo $jsonArray2;?>;
        $("#chart30").duxChart({
            data: data
        });
        var data = <?php echo $jsonArray3;?>;
        $("#chart12").duxChart({
            data: data
        });
    });
</script>
<SCRIPT Language=VBScript><!--

//--></SCRIPT>";s:12:"compile_time";i:1518946673;}";