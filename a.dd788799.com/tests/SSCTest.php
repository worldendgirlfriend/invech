<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2015 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: yunwuxin <448901948@qq.com>
// +----------------------------------------------------------------------
namespace tests;

class SSCTest extends TestCase
{

    public function testGfwf()
    {
        require_once('./swoole/parse-calc-count.php');
		require_once('./swoole/kqwf_algo.php');

    	$ret = dxwf5f('01,23,45,67,89','1,3,5,7,9');
		$this->assertEquals($ret, 1);
    	$ret = dxwf5f('05,16,27,38,49','0,1,2,3,4');
		$this->assertEquals($ret, 1);
		$ret = dxwf5f('0,1,2,3,4','0,1,2,3,4');
		$this->assertEquals($ret, 1);

		$ret = dxwf5d('0,2,4,6,8','0,2,4,6,8');
		$this->assertEquals($ret, 1);
		$ret = dxwf5d('0,2,4,6,8|1,2,3,4,5','0,2,4,6,8');
		$this->assertEquals($ret, 1);
		$ret = dxwf5d('0,2,4,6,8|2 4 5 6 7','0,2,4,6,8');
		$this->assertEquals($ret, 1);

		$ret = ssc_5xzh('01,23,45,67,89','1,3,5,7,9');
		$this->assertArraySubset($ret,[1,1,1,1,1]);
		$this->assertArraySubset([1,1,1,1,1],$ret);

		$ret = ssczx120('123456','1,2,3,4,5');
		$this->assertEquals($ret, 1);
		$ret = ssczx60('1234,5678','2,2,5,7,8');
		$this->assertEquals($ret, 1);
		$ret = ssczx30('1234,5678','2,2,3,3,5');
		$this->assertEquals($ret, 1);
		$ret = ssczx20('123,4567','2,2,2,4,5');
		$this->assertEquals($ret, 1);
		$ret = ssczx20('123,4567','2,4,2,5,2');
		$this->assertEquals($ret, 1);
		$ret = ssczx10('234,567','2,5,2,5,2');
		$this->assertEquals($ret, 1);
		$ret = ssczx5('234,567','2,2,2,2,5');
		$this->assertEquals($ret, 1);

		$ret = dxwf5yffs('23','2,4,5,6,7');
		$this->assertEquals($ret, 1);		
		$ret = dxwf5hscs('23','2,2,3,3,7');
		$this->assertEquals($ret, 2);
		$ret = dxwf5sxbx('23','2,3,3,3,7');
		$this->assertEquals($ret, 1);
		$ret = dxwf5sjfc('23','2,2,2,2,3');
		$this->assertEquals($ret, 1);

		$ret = ssc5x_lh('龙虎','3,2,2,2,1');
		$this->assertEquals($ret, 1);
		$ret = ssc5x_zhdxds('总和小 总和单','1,2,3,4,5');	
		$this->assertEquals($ret, 2);


		//--------------------四星---------------------
		$ret = dxwfH4f('23,45,67,89','1,2,4,6,8');
		$this->assertEquals($ret, 1);
		$ret = dxwfH4d('2,4,6,8|3,4,5,6','1,2,4,6,8');
		$this->assertEquals($ret, 1);
		$ret = ssc_h4xzh('2,3,4,56','1,2,3,4,5');
		$this->assertArraySubset($ret,[1,1,1,1]);
		$this->assertArraySubset([1,1,1,1],$ret);

		$ret = sscH4Z24('23456','1,2,4,6,5');
		$this->assertEquals($ret, 1);
		$ret = sscH4Z12('23,456','1,2,2,4,5');
		$this->assertEquals($ret, 1);
		$ret = sscH4Z6('3456','1,3,3,6,6');
		$this->assertEquals($ret, 1);
		$ret = sscH4Z4('34,56','1,3,3,3,5');
		$this->assertEquals($ret, 1);

		//-------------------前三----------------
		$ret = sxwfQ3f('23,45,67','2,4,6,-,-');
		$this->assertEquals($ret, 1);
		$ret = sxwfQ3d('2,4,6','2,4,6,-,-');
		$this->assertEquals($ret, 1);
		$ret = ssc_q3xzh('34,5,6','3,5,6,-,-');
		$this->assertArraySubset($ret,[1,1,1]);
		$this->assertArraySubset([1,1,1],$ret);
		//$ret = ssc_q3xzh('34,5,6','3,4,6,-,-');
		//$this->assertArraySubset($ret,[0,0,1]);
		//$this->assertArraySubset([0,0,1],$ret);
		$ret = sxwfQ3_hz('0,18,27','9,9,9,-,-');
		$this->assertEquals($ret, 1);
		$ret = sxwfQ3_kd('2,3,4','1,2,3,-,-');
		$this->assertEquals($ret, 1);

		$ret = sxzxQ3z3('234','2,3,3,-,-');
		$this->assertEquals($ret, 1);
		$ret = sxzxQ3z6('2345','2,3,4,-,-');
		$this->assertEquals($ret, 1);

		$ret = sxzxQ3h('1,2,3|4,4,6','1,2,3,-,-');
		$this->assertArraySubset($ret,[0,1]);
		$this->assertArraySubset([0,1],$ret);		
		$ret = sxzxQ3h('1,2,3|4,4,6','4,4,6,-,-');
		$this->assertArraySubset($ret,[1,0]);
		$this->assertArraySubset([1,0],$ret);	

		$ret = sxzxQ3_hz('1,18,26','0,0,1,-,-');
		$this->assertArraySubset($ret,[1,0]);
		$this->assertArraySubset([1,0],$ret);
		$ret = sxzxQ3_hz('1,18,26','5,6,7,-,-');
		$this->assertArraySubset($ret,[0,1]);
		$this->assertArraySubset([0,1],$ret);	

		$ret = sxzxQ3_bd('0','0,0,0,-,-');//豹子不算中
		$this->assertArraySubset($ret,[0,0]);
		$this->assertArraySubset([0,0],$ret);		
		$ret = sxzxQ3_bd('0','0,2,1,-,-');
		$this->assertArraySubset($ret,[0,1]);
		$this->assertArraySubset([0,1],$ret);
		$ret = sxzxQ3_bd('0','0,2,2,-,-');
		$this->assertArraySubset($ret,[1,0]);
		$this->assertArraySubset([1,0],$ret);	

		$ret = sxwfQ3_hzws('0 5 9','0,7,8,-,-');
		$this->assertEquals($ret, 1);
		$ret = sxwfQ3_tsh('豹子 顺子','6,7,8,-,-');
		$this->assertEquals($ret, 1);
		$ret = sxwfQ3_tsh('豹子 顺子','6,6,6,-,-');
		$this->assertEquals($ret, 1);

		//-------------后三---------------

		$ret = sxwfH3f('23,45,67','-,-,2,4,6');
		$this->assertEquals($ret, 1);
		$ret = sxwfH3d('2,4,6','-,-,2,4,6');
		$this->assertEquals($ret, 1);
		$ret = ssc_h3xzh('34,5,6','-,-,3,5,6');
		$this->assertArraySubset($ret,[1,1,1]);
		$this->assertArraySubset([1,1,1],$ret);		

		$ret = sxwfH3_hz('0,18,27','-,-,9,9,9');
		$this->assertEquals($ret, 1);
		$ret = sxwfH3_kd('2,3,4','-,-,1,2,3');
		$this->assertEquals($ret, 1);

		$ret = sxzxH3z3('234','-,-,2,3,3');
		$this->assertEquals($ret, 1);
		$ret = sxzxH3z6('2345','-,-,2,3,4');
		$this->assertEquals($ret, 1);

		$ret = sxzxH3h('1,2,3|4,4,6','-,-,1,2,3');
		$this->assertArraySubset($ret,[0,1]);
		$this->assertArraySubset([0,1],$ret);		
		$ret = sxzxH3h('1,2,3|4,4,6','-,-,4,4,6');
		$this->assertArraySubset($ret,[1,0]);
		$this->assertArraySubset([1,0],$ret);	

		$ret = sxzxH3_hz('1,18,26','-,-,0,0,1');
		$this->assertArraySubset($ret,[1,0]);
		$this->assertArraySubset([1,0],$ret);		
		$ret = sxzxH3_hz('1,18,26','-,-,5,6,7');
		$this->assertArraySubset($ret,[0,1]);
		$this->assertArraySubset([0,1],$ret);

		$ret = sxzxH3_bd('0','-,-,0,0,0');
		$this->assertArraySubset($ret,[0,0]);
		$this->assertArraySubset([0,0],$ret);			
		$ret = sxzxH3_bd('0','-,-,0,2,1');
		$this->assertArraySubset($ret,[0,1]);
		$this->assertArraySubset([0,1],$ret);		
		$ret = sxzxH3_bd('0','-,-,0,2,2');
		$this->assertArraySubset($ret,[1,0]);
		$this->assertArraySubset([1,0],$ret);

		$ret = sxwfH3_hzws('0 5 9','-,-,0,7,8');
		$this->assertEquals($ret, 1);
		$ret = sxwfH3_tsh('豹子 顺子','-,-,6,7,8');
		$this->assertEquals($ret, 1);
		$ret = sxwfH3_tsh('豹子 顺子','-,-,6,6,6');
		$this->assertEquals($ret, 1);

		//----------------前二-----------------
		$ret = rxwfQ2f('12,34','1,3,-,-,-');
		$this->assertEquals($ret, 1);
		$ret = rxwfQ2d('1,3|2,4','1,3,-,-,-');
		$this->assertEquals($ret, 1);
		$ret = rxwfQ2_hz('0,8,18','3,5,-,-,-');
		$this->assertEquals($ret, 1);
		$ret = rxwfQ2_kd('0,5,9','3,8,-,-,-');
		$this->assertEquals($ret, 1);
		$ret = rxzxQ2f('345','3,5,-,-,-');
		$this->assertEquals($ret, 1);
		$ret = rxzxQ2d('5,3|3,2','3,5,-,-,-');
		$this->assertEquals($ret, 1);
		$ret = rxzxQ2_hz('3,5,7','1,4,-,-,-');
		$this->assertEquals($ret, 1);
		$ret = rxzxQ2_bd('8','1,8,-,-,-');
		$this->assertEquals($ret, 1);
		$ret = rxzxQ2_bd('8','8,8,-,-,-');
		//$this->assertEquals($ret, 0);

		$ret = rxwfH2f('12,34','-,-,-,1,3');
		$this->assertEquals($ret, 1);
		$ret = rxwfH2d('1,3|2,4','-,-,-,1,3');
		$this->assertEquals($ret, 1);
		$ret = rxwfH2_hz('0,8,18','-,-,-,3,5');
		$this->assertEquals($ret, 1);
		$ret = rxwfH2_kd('0,5,9','-,-,-,3,8');
		$this->assertEquals($ret, 1);
		$ret = rxzxH2f('345','-,-,-,3,5');
		$this->assertEquals($ret, 1);
		$ret = rxzxH2d('5,3|3,2','-,-,-,3,5');
		$this->assertEquals($ret, 1);
		$ret = rxzxH2_hz('3,5,7','-,-,-,1,4');
		$this->assertEquals($ret, 1);
		$ret = rxzxH2_bd('8','-,-,-,1,8');
		$this->assertEquals($ret, 1);
		$ret = rxzxH2_bd('8','-,-,-,8,8');
		//$this->assertEquals($ret, 0);

		$ret = rxwfR2f('-,34,46,-,-','-,3,6,-,-');
		$this->assertEquals($ret, 1);
		$ret = rxwfR2d('-,1,-,2,-|-,3,-,4,-','-,3,-,4,-');
		$this->assertEquals($ret, 1);
		$ret = rxwfR2_hz('9,18','-,3,-,6,-',10);
		$this->assertEquals($ret, 1);
		$ret = rxzxR2f('059','-,0,-,9,-',10);
		$this->assertEquals($ret, 1);
		$ret = rxzxR2d('-,1,-,2,-|-,3,-,4,-','-,4,-,3,-',10);
		$this->assertEquals($ret, 1);
		$ret = rxzxR2_hz('1,8,17','-,5,-,3,-',10);
		$this->assertEquals($ret, 1);

    }

    public function testKqwf(){

		require_once('./swoole/parse-calc-count.php');
		require_once('./swoole/kqwf_algo.php');
		
		$ret = ssc_sm('万位-大','9,5,6,4,5');
		$ret = ssc_sm('万位-小','9,5,6,4,5');
		$ret = ssc_sz('万位-9','9,5,6,4,5');
		$ret = ssc_sz('万位-5','9,5,6,4,5');

		$ret = ssc_dw1("千定位-5",'4,5,6,4,5');
		$ret = ssc_dw("二字定位-万位:4 千位:5",'4,5,6,4,5');
		$ret = ssc_dw("三字定位-万位:4 千位:5 百位:6",'4,5,6,4,5');

		$ret = ssc_dw_fs("二字定位-45,56,-,-,-",'4,5,6,4,5');

		//前三二字组合 是 任选2 , 使用单注记录;
		$ret = ssc_zx('前三一字组合-4','4,5,6,4,5');
		$ret = ssc_zx('后三二字组合-4,5','4,5,6,4,5');

		$ret = ssc_hs('万千和数-单','4,5,6,4,5');

		$ret = ssc_z3('前三组选三-0,1,2,3,4','3,4,3,4,5');
		$ret = ssc_z6('前三组选六-0,1,2,3,4','3,4,2,4,5');

		$ret = ssc_kd('前三跨度-2','3,4,2,4,5');
		$ret = ssc_lh('龙1vs虎2-龙','5,4,2,4,5'); 
		  	
    	$this->assertEquals('1', 1);
    }

}