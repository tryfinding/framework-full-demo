<?php   namespace core;
/**
*  Cookie　设置　获取　删除
*
*  
* @author Sun <sunkang@wstaichi.com>
* @copyright 
* @time 2014-2015
*/
class cookie
{
	static function init(){
		di::set('crypt',function($c){
			return new crypt;	
		});

		return di::get('crypt');
		 
	}
	/**
	* 设置COOKIE
	* @param string $name  COOKIE名
	* @param string $value  COOKIE值
	* @param string $expire  浏览器关闭就会自动失效
	* @param string $path    路径
	* @param string $domain  域名
	* @param string $secure  是否为安全https，默认否
	* @return void
	*/
	static function set($name,$value=null,$expire=0,$path=null,$domain=null,$secure=null){
		if(!$path){
			$path = Config::get('app.cookiePath')?:'/';
		}  
		if(!$domain){
			$domain = Config::get('app.cookieDomain');
		} 
 		//设置跨域COOKIE
		header('P3P: CP="NOI DEV PSA PSD IVA PVD OTP OUR OTR IND OTC"');
		/**
		* 对数组或对象直接设置COOKIE
		*/
		if(!$value && (is_array($name) || is_object($name))){
			$name = (array)$name; 
			foreach($name as $k=>$v){
				$v = static::init()->encode($v);
				$_COOKIE[$k] = $v;
				setcookie($k,$v,$expire,$path,$domain,$secure);
			}  
			return $name;
		} 
		 
		if($value != null){
			$value = static::init()->encode($value);
		}
		setcookie($name,$value,$expire,$path,$domain,$secure);
		if($value)
			$_COOKIE[$name] = $value;
	}
	 
	/**
	* 设置永久 COOKIE  
	* @param string $name  COOKIE名
	* @param string $value  COOKIE值
	* @param string $path    路径
	* @param string $domain  域名
	* @param string $secure  是否为安全https，默认否
	* @return void
	*/	
	static function forver($name,$value,$path='/',$secure=null){ 
		$value = static::init()->encode($value);
		static::set($name,$value,time()+86400*365*200,$path,$secure=null);
	} 
	/**
	* 取COOKIE
	* @param string $name  COOKIE名,可以为空
	* @return array/string
	*/	
	static function get($name = null){
		if(!$name && $_COOKIE) { 
			foreach($_COOKIE as $k=>$v){ 
				$data[$k] = static::init()->decode($v);
			} 
			return  (object)$data;
		} 
		elseif(is_array($name) && $_COOKIE) {   
			foreach($name as $k){
				$v = $_COOKIE[$k];
				$data[$k] = static::init()->decode($v);
			} 
			return  (object)$data;
		} 
		$value = $_COOKIE[$name]; 
		if($value)
			return static::init()->decode($value);		 
	}
	 
	/**
	* 删除COOKIE
	* @param string $name  COOKIE名,为空时删除所有COOKIE
	* @return void
	*/	
	static function delete($name = null){
		if(!$name)
			$values = $_COOKIE;
		elseif(is_array($name))
			$values = array_flip($name);		
		if($values){
			foreach($values as $name=>$value){
				unset($_COOKIE[$name]);
				static::set($name,NULL,time()-20); 
			} 
			return;
		} 
		unset($_COOKIE[$name]);
		static::set($name,NULL,time()-20); 
	}
	
	
 
}