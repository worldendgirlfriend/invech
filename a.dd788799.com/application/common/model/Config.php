<?php
namespace app\common\model;
use think\Model;

class Config extends Base{

    protected $table = 'gygy_params';

    CONST GROUP_NONE = '未分组';
    CONST GROUP_BASIC = '基础';
    CONST GROUP_BET = '投注';
    CONST GROUP_CASH = '充提限制';
    CONST GROUP_BC = '返点分佣';
    CONST GROUP_WIN = '杀率控制';

    CONST GROUP_ARRAY = [self::GROUP_NONE,self::GROUP_BASIC,self::GROUP_BET,self::GROUP_CASH,self::GROUP_BC,self::GROUP_WIN,];    

    public function getGroupAttr($value,$data){
        return self::GROUP_ARRAY[$value];
    }
     //----------------后台------------------
    public static function getList(){
        $params = request()->param();
        $query  = self::order('id desc');
        $group = $params['group']??'';
        if(is_numeric($group)){
            $query->where('group',$group);
        }
        if($params['keywords']??0){
            $query->where('name|title|value','like','%'.trim($params['keywords']).'%');
        }
        return $query->paginate();
    }

    public static function getAll(){
        $params = cache('gygy_configs');
        if(!$params){
            $params = self::All();

            $params_map = [];
            foreach ($params as $param) {
                $name = $param->data['name'];//$param->name
                $params_map[$name] = $param->value;
            }
            $params = $params_map;
            cache('gygy_configs',$params);
        }
        return $params;
    }

    public static function getByName($name)
    {
        $params = self::getAll();
        return $params[$name]??null;
    }    
}
