<?php   namespace core;
/**
  *    
  * 
  * @author Sun <sunkang@wstaichi.com>
  * @copyright http://www.wstaichi.com 
  * @time 2014-2015
  */
 
class hook
{  
 	static $obj = [];  
	static $value;

	 

 	static function listen($name,&$arg = array() ){
 	     
 		$hook = self::$obj[$name];

 		if($hook){
 			foreach($hook as $call){ 
 				$cls = substr($call,0,strpos($call,'@'));
 				$ac = substr($call,strpos($call,'@')+1);
 				if(substr($cls,0,1)!='\\'){
 					$cls  = '\\'.$cls;
 				}
 				$obj = obj($cls);
 				$obj->$ac($arg);
 				 
 			}

 		}

 	}

 	static function value($name,$value = null){
 		if(!$value){
 			return self::$value[$name];
 		}
 		self::$value[$name] = $value;

 	}
 	

 	static function add($name,$fun){
 		self::$obj[$name][] = $fun;


 	}



}