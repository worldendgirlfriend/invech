<?php
// +----------------------------------------------------------------------
// | describe=>  自动派奖处理
// +----------------------------------------------------------------------
// | CreateDate=> 2017年11月22日
// +----------------------------------------------------------------------
// | Author=>
// +----------------------------------------------------------------------

require_once('./AutoLottery.php');

$lottery = new AutoLottery() ;

$lottery->runTask() ;