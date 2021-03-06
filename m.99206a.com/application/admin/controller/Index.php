<?php
namespace app\admin\controller;
use app\admin\Base;
use think\Cache;
use think\Db;

class index extends Base{
    
    public function index(){
        return $this->fetch("index");
    }
    
    public function login(){
    	if(request()->isGet()){
    		if($this->isLogin()){
    			$this->redirect('index/index');
    		}
    		return $this->fetch("login");	
    	}else{
	
	    	$sysConfig = Cache::get('sysConfig');

	    	if($sysConfig['loginYzm'] == '1' && isset($_POST['dlyzm'])){
	    	    if(!captcha_check($_POST['dlyzm'])){
	    	        //exit(json_encode(array('status'=>'n','info'=>'验证码错误!',)));
	    	        //exit(json_encode(array('status'=>0,'info' => '验证码错误!')));
	    	    }
	    	}
	    	
	        $username = trim($_POST['LoginName']);
	        $password = trim($_POST['LoginPassword']);
	        $data = array(
	        		'login_name' =>  $username,
	        		'login_pwd'  =>  $password,
	        );
	        
	        $rules = ['login_name'=> 'require|length:4,12|alphaNum',
	                  'login_pwd' => 'require|length:6,32'
	        ];
	        $msg = [
	            'login_name.require'  =>  '用户名必须填写!',
	            'login_name.length'   =>  '用户名长度必须在6~12之间!',
	            'login_name.alphaNum' =>  '用户名必须是数字和字母的组合!',
	            'login_pwd.require'  =>  '密码必须填写!',
	            'login_pwd.length'   =>  '密码长度必须在6~32位之间!',	            
	        ];
	        $validate = new \think\Validate($rules,$msg);
	        if(! $validate->check($data))
	        {
	            $error = $validate->getError();
	            //$this->error($error);
	            return ['status'=>'n','info'=>$error,];
	        }

	        $rememberme = @$_POST['rember'] == 'on';
	

            if($this->doLogin($data['login_name'],$data['login_pwd'],$rememberme)){
            	return ['status'=>'y','info'=>'登录成功',];
            }else{
            	return ['status'=>'n','message'=>'用户名称或密码错误!'];
            }
            /*
	        $data['login_pwd'] = md5($data['login_pwd']);
	        $admin = db('sys_admin','otherdb')->where($data)->find();
	        if(empty($admin)){
                //$this->error('用户名称或密码错误!');
	            return ['status'=>'n','info'=>'用户名称或密码错误',];
	        }

	        session('adminid',$admin['uid']);
	        session('adminname',$admin['login_name']);
	        //$this->success('登录成功',url('index/index'));
	        return ['status'=>'y','info'=>'登录成功',];
	        */
    	}
    }
    
    public function logout(){
        session(null);
        cookie(null,config('cookie.prefix'));
       	$this->redirect('/index/login');
    }

    public function test(){
        $userinfo =  Db::table('k_user')->where(array('username'=>'jianbing'))->find();
        //$res =  Db::query("select sum(case when type=1 or type = 100 then m_value else 0 end) as ck,sum(case when type=2 or type=200 or type=2000 then m_value else 0 end) as zs,sum(case when type=3 or type=600 then m_value else 0 end) as fs,sum(case when type=4 or type=4000 then m_value else 0 end) as qt,sum(case when type=11 or type=255 or type=900 then m_value else 0 end) as qk,sum(case when type=120 then m_value else 0 end) as kk from k_money where uid=".$userinfo["uid"]." and status=1");
        $res =  Db::name('k_money')->field('type,sum(m_value)')->where('uid', $userinfo["uid"])->group('type')->select();

        $sql_h		=	"select sum(money) as hk from huikuan where uid=".$userinfo["uid"]." and status=1";
        $rs_h1 		=	Db::query($sql_h)[0];

        $rs_h 		=	Db::name('zz_info')->field('type,sum(amount)')->where('uid', $userinfo["uid"])->group('type')->select();
        var_dump($res,$rs_h1, $rs_h);

        $sum = 0;
        foreach ($res as $val){
            $sum += $val['sum(m_value)'];
        }
        echo $sum+$rs_h1['hk'];
    }
}