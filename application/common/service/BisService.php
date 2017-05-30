<?php 
namespace app\common\service;
use think\Db;
class BisService{
	protected static $inc = null;
	protected function __construct(){

	}

	public static function instance(){
		if(is_null(self::$inc)){
			self::$inc = new self;
		}
		return self::$inc;
	}
	public function getBisDetail($id){
		$bis = model('Bis')->where(['id'=>$id])->find()->toArray();
		$se_city_id = model('Citys')->getSeCityByCityPath($bis['city_path']);
		if(!$se_city_id){
          $bis['se_city'] = model('Citys')->getCityById($se_city_id);
          $bis['se_city_id'] = $se_city_id;
        }else{
          $bis['se_city']='';
        }
       return $bis;
	}

	public function changeStatus($id,$status){
		model('Bis')->save(['status'=>$status],['id'=>$id]);
        model('BisLocation')->save(['status'=>$status],['bis_id'=>$id,'is_main'=>1]);
        model('BisAccount')->save(['status'=>$status],['bis_id'=>$id,'is_main'=>1]);
	}

	public function sendEmail($email,$status){
		 $str = '';
       $url = request()->domain().url('/bis/login/index');
       switch ($status){
           case -1:
               $str = '审核被删除';
               break;
           case 1:
               $str = '审核已通过<a href="'.$url.'" ></a>';
               break;
           case 2:
               $str = '审核被驳回';
               break;
           default:
               break;
       }
       if($str!='' && !empty($email) ){
           \PHPMailer\Email::send($email,'xxo2o审核信息',$str);
       }
	}
}