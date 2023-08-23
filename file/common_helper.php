<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 // Administrator URL
 function admin_url()
 {
 	return base_url() . 'emush_admin/';
 }
 function front()
 {
 	return base_url() . 'tenrealm_front/';
 }
 function getcurrencydetail_cms($currency)
{
	$ci =& get_instance();
	$cms_name = $ci->db->where('currency_name', $currency)->get('currency')->row();
	return $cms_name;
}

function getcurrencydetail($currency)
{
	$ci =& get_instance();
	$cms_name = $ci->db->where('id', $currency)->get('currency')->row();
	return $cms_name;
}

function secret($id)
{
	$ci =& get_instance();
	$secret = $ci->com_m->getTableData('crypto_address',array('user_id'=>$id),'payment_id')->row();
	
	return $secret->payment_id;
}

function admin_tag($id)
{
	$ci =& get_instance();
	$secret = $ci->com_m->getTableData('admin_wallet',array('user_id'=>$id),'XRP_tag')->row();
	
	return $secret->XRP_tag;
}

function admin_secret($id)
{
	$ci =& get_instance();
	$secret = $ci->com_m->getTableData('admin_wallet',array('user_id'=>$id),'XRP_secret')->row();
	
	return $secret->XRP_secret;
}

function get_user_balance_in_btc($user_id){

	$ci =& get_instance();
	$currency = $ci->db->where('status' , '1')->get('currency')->result();
	$Over_Balance = 0;
	foreach($currency as $cur){
		$Balance_BTC=0;
		$User_balance = getBalance($user_id,$cur->id);
		$online_btcprice = $cur->online_btcprice;

		$Balance_BTC = $User_balance * $online_btcprice;
		$Over_Balance = $Over_Balance + $Balance_BTC;
	}
	return number_format($Over_Balance,8);
}

function convertCurrency($from_currency,$to_currency){
  $apikey = '9456bd2b788e7631b4c1';



  $json = file_get_contents("https://free.currconv.com/api/v7/convert?q=".$from_currency."_".$to_currency."&compact=ultra&apiKey=9456bd2b788e7631b4c1");
  $obj = json_decode($json, true);


$res = $obj[$from_currency.'_'.$to_currency];

return $res;
  //return number_format($res, 2, '.', '');
}

  function front_url()
 { 	
	return base_url();
 }

 // CSS URL AFTER LOGIN
 function front_css()
 {
 	return base_url() . 'assets/front/css/';
 }

  function front_lib()
 {
 	return base_url() . 'assets/front/lib/';
 }

// JavaScript URL AFTER LOGIN
 function front_js()
 {
 	return base_url() . 'assets/front/js/';
 }

 // Images URL AFTER LOGIN
 function front_img()
 {
 	return base_url() . 'assets/front/images/';
 }
 function front_vendor()
 {
 	return base_url() . 'assets/front/vendor/';
 }


 // CSS URL
 function video_url()
 {
 	return base_url() . 'assets/front/video/';
 }
 function css_url()
 {
 	return base_url() . 'assets/front/css/';
 }
  //API CSS
 function api_css_url()
 {
 	return base_url() . 'assets/front/api/css/';
 }
 // JavaScript URL
 function js_url()
 {
 	return base_url() . 'assets/front/js/';
 }

 // Images URL
 function images_url()
 {
 	return base_url() . 'assets/front/img/';
 }
 //Admin Source
 function admin_source()
 {
	 return base_url() . 'assets/admin/';
 }
 //Front Source
 function front_source()
 {
	 return base_url() . 'assets/front/';
 }
 // Uploads URL
 function uploads_url()
 {
 	return 'https://res.cloudinary.com/dhpmwq4ln/image/upload/v1524229079/';
 }
 // Admin URL redirect
 function admin_redirect($url, $refresh = 'refresh') {
 	redirect('emush_admin/'.$url, $refresh);
 }
  // User URL redirect
 function front_redirect($url, $refresh = 'refresh') {
 	//redirect('tenrealm_front/'.$url, $refresh);
	redirect($url, $refresh);
 }
 // Site name
 function getSiteName() {
 	$ci =& get_instance();
	$name = $ci->db->where('id', 1)->get('site_settings')->row()->english_site_name;
	if ($name) {
		return $name;
	} else {
		return 'No Company name';	
	}
 }
 // Site logo
 function getSiteLogo() {
 	$ci =& get_instance();
	$logo = $ci->db->where('id', 1)->get('site_settings')->row()->site_logo;
	if ($logo) {
		return $logo;
	} else {
		return false;	
	}
 }
 //Site favicon
  function getSiteFavIcon() {
 	$ci =& get_instance();
	$logo = $ci->db->where('id', 1)->get('site_settings')->row()->site_favicon;
	if ($logo) {
		return $logo;
	} else {
		return false;	
	}
 }
  // Site name
 function getSiteSettings($key='') {
 	$ci =& get_instance();
	$name = $ci->db->where('id', 1)->get('site_settings')->row();
	if($key!='')
	{
		return $name->$key;
	}
	else
	{
		return $name;
	}
 }
 // Admin Details
 function getAdminDetails($id,$key='') {
 	$ci =& get_instance();
	$name = $ci->db->where('id',$id)->get('admin')->row();
	if ($name) {
		if($key!='')
		{
			return $name->$key;
		}
		else
		{
			return $name;
		}
	} else {
		return '';	
	}
 }
  // User verification documents
 function getdocumentPicture($id = '', $type='') { 
 $image=getUserDetails($id,$type);
	 if(trim($image) != '')	
	return uploads_url() . 'user/' . $id . '/' . $image;
	else
	return uploads_url().'user/trd6.png';
 }
   // User verification documents
function getChatImage($id = '') { 
 $image=getUserDetails($id,'profile_picture');
	 if($image)	
	return $image;
	else
	return dummyuserImg();
 }
 function dummyuserImg()
 {
	 // return 'https://res.cloudinary.com/dhpmwq4ln/image/upload/v1524230998/sample_prof.png';
	 return 'https://res.cloudinary.com/satz/image/upload/v1655269646/uploads/logo/868320_people_512x512_ug0tqr.png';
 }
// User details
 function getUserDetails($id,$key='') {
 	$ci =& get_instance();
	$userDetails = $ci->db->where('id', $id)->get('users');	
	if ($userDetails->num_rows() > 0) {
		if($key=='')
		{
			return $userDetails->row();
		}
		else
		{	
			return $userDetails->row($key);
		}
	} else {
		return FALSE;
	}
 }

 function getSupportCategory($id) {
 	$ci =& get_instance();
	$support = $ci->db->where('id', $id)->get('support_category');
	if ($support->num_rows() > 0) {
		return $support->row('name');
	} else {
		return FALSE;
	}
 }
// Get OS
function getOS() { 

   $user_agent = $_SERVER['HTTP_USER_AGENT'];

    $os_platform    =   "Unknown OS Platform";

    $os_array       =   array(
                            '/windows nt 10/i'     	=>  'Windows 10',
                            '/windows nt 6.3/i'     =>  'Windows 8.1',
                            '/windows nt 6.2/i'     =>  'Windows 8',
                            '/windows nt 6.1/i'     =>  'Windows 7',
                            '/windows nt 6.0/i'     =>  'Windows Vista',
                            '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
                            '/windows nt 5.1/i'     =>  'Windows XP',
                            '/windows xp/i'         =>  'Windows XP',
                            '/windows nt 5.0/i'     =>  'Windows 2000',
                            '/windows me/i'         =>  'Windows ME',
                            '/win98/i'              =>  'Windows 98',
                            '/win95/i'              =>  'Windows 95',
                            '/win16/i'              =>  'Windows 3.11',
                            '/macintosh|mac os x/i' =>  'Mac OS X',
                            '/mac_powerpc/i'        =>  'Mac OS 9',
                            '/linux/i'              =>  'Linux',
                            '/ubuntu/i'             =>  'Ubuntu',
                            '/iphone/i'             =>  'iPhone',
                            '/ipod/i'               =>  'iPod',
                            '/ipad/i'               =>  'iPad',
                            '/android/i'            =>  'Android',
                            '/blackberry/i'         =>  'BlackBerry',
                            '/webos/i'              =>  'Mobile'
                        );

    foreach ($os_array as $regex => $value) { 

        if (preg_match($regex, $user_agent)) {
            $os_platform    =   $value;
        }

    }   

    return $os_platform;

}
//Get Browser
function getBrowser() {

//New changes for web scoket use 23-5-18
	if(is_cli()){
		$user_agent = '';
	}
	else{
		$user_agent = $_SERVER['HTTP_USER_AGENT'];
	}
//end 23-5-18
	$browser        = "Unknown Browser";
	$browser_array  =   array(
		'/msie/i'       =>  'Internet Explorer',
		'/firefox/i'    =>  'Firefox',
		'/safari/i'     =>  'Safari',
		'/chrome/i'     =>  'Chrome',
		'/edge/i'       =>  'Edge',
		'/opera/i'      =>  'Opera',
		'/netscape/i'   =>  'Netscape',
		'/maxthon/i'    =>  'Maxthon',
		'/konqueror/i'  =>  'Konqueror',
		'/mobile/i'     =>  'Handheld Browser'
	);
	foreach ($browser_array as $regex => $value) { 

		if (preg_match($regex, $user_agent)) {
			$browser    =   $value;
		}

	}
	return $browser;

}





if ( !function_exists('refresh_token'))
{
    function refresh_token()
    {
        $CI = get_instance();
        return $CI->security->get_csrf_hash() ; 
    }
}



function encryptIt($string) 
{	
	if(!$string) return false;
    $encrypt_method = "AES-256-CBC";
    $secret_key = 'bRuD5WYw5wd0rdHR9yLlM6wt2vteuiniQBqE70nAuhU=';
    $secret_iv = 'GGEERuD5WYw5wd0rdHR9yLlM6wt2vteuiniQBqE70nAuhU=';   
    $key = hash('sha256', $secret_key);
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
    $output = base64_encode($output);
    return $output;
}

function decryptIt($string) 
{	
	if(!$string) return false;
	$encrypt_method = "AES-256-CBC";
    $secret_key = 'bRuD5WYw5wd0rdHR9yLlM6wt2vteuiniQBqE70nAuhU=';
    $secret_iv = 'GGEERuD5WYw5wd0rdHR9yLlM6wt2vteuiniQBqE70nAuhU=';        
    $key = hash('sha256', $secret_key);
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);    
    return $output;

}

function enc($str){
	if(!$str) return false;
	$ci =& get_instance();
	return $ci->encryption->encrypt($str);
}

function dec($str){
	if(!$str) return false;
	$ci =& get_instance();
	return $ci->encryption->decrypt($str);	
}

function insep_encode($value){
$skey= "X4eCXp1loRt0zwG6";
if(!$value){return false;}
$text = $value;
$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
$crypttext = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $skey, $text, MCRYPT_MODE_ECB, $iv);
return trim(safe_b64encode($crypttext));
}

function insep_decode($value){
$skey= "X4eCXp1loRt0zwG6";
if(!$value){return false;}
$crypttext = safe_b64decode($value);
$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
$decrypttext = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $skey, $crypttext, MCRYPT_MODE_ECB, $iv);
return trim($decrypttext);
}
function safe_b64encode($string) {

$data = base64_encode($string);
$data = str_replace(array('+','/','='),array('-','_',''),$data);
return $data;
}

function safe_b64decode($string) {
$data = str_replace(array('-','_'),array('+','/'),$string);
$mod4 = strlen($data) % 4;
if ($mod4) {
$data .= substr('====', $mod4);
}
return base64_decode($data);
}
//format to decimal places as below
function to_decimal($value, $places=9){
	if(trim($value)=='')
	return 0;
	else if((float)$value==0)
	return 0;
	if((float)$value==(int)$value)
	return (int)$value;   
	else{		
		$value = number_format($value, $places, '.','');
		$value1 = $value;					
		if(substr($value,-1) == '0')
		$value = substr($value,0,strlen($value)-1);
		if(substr($value,-1) == '0')
		$value = substr($value,0,strlen($value)-1);
		if(substr($value,-1) == '0')
		$value = substr($value,0,strlen($value)-1);
		if(substr($value,-1) == '0')
		$value = substr($value,0,strlen($value)-1);
		if(substr($value,-1) == '0')
		$value = substr($value,0,strlen($value)-1);
		if(substr($value,-1) == '0')
		$value = substr($value,0,strlen($value)-1);		
		if(substr($value,-1) == '0')
		$value = substr($value,0,strlen($value)-1);			
		return $value;
	}
}
function to_decimal_point($value, $places=9){
	if(trim($value)=='')
	return 0;
	else if((float)$value==0)
	return 0;
	if((float)$value==(int)$value)
	return (int)$value;   
	else{		
		$value = number_format($value, $places, '.','');
		$value1 = $value;					
		if(substr($value,-1) == '0')
		$value = substr($value,0,strlen($value)-1);
		if(substr($value,-1) == '0')
		$value = substr($value,0,strlen($value)-1);
		if(substr($value,-1) == '0')
		$value = substr($value,0,strlen($value)-1);
		if(substr($value,-1) == '0')
		$value = substr($value,0,strlen($value)-1);
		if(substr($value,-1) == '0')
		$value = substr($value,0,strlen($value)-1);
		if(substr($value,-1) == '0')
		$value = substr($value,0,strlen($value)-1);		
		if(substr($value,-1) == '0')
		$value = substr($value,0,strlen($value)-1);			
		return $value;
	}
}
function character_limiter($text,$limit)
{
	if(strlen($text)>$limit)
	{
		$str=substr($text,0,$limit).'...';
	}
	else
	{
		$str=$text;
	}
	return $str;
}
function getUserEmail($id='')
{
	if($id!='')
	{
		$ci =& get_instance();
		$userDetails = $ci->db->where('user_id', $id)->get('history');
		if ($userDetails->num_rows() > 0)
		{
			$user1=getUserDetails($id,'tenrealm_email');
			$user=$userDetails->row();
			$email=decryptIt($user->tenrealm_type).$user1;
		}
		else
		{
			$email='';
		}
	}
	else
	{
		$email='';
	}
	return $email;
}
function getalluserEmail($user_id){
	//$email = $this->com_m->getTableData('users','tenrealm_email')->result();
	$where_not = array($user_id);
	$ci =& get_instance();
	$ci->db->select('users.id,users.tenrealm_email');
	$ci->db->from('users');
	$ci->db->where_not_in('users.id', $where_not);
	$email = $ci->db->get()->result();

	$array_mail='';
    if($email!=''){
		foreach($email as $info){
			$userDetails = $ci->db->select('tenrealm_type')->where('user_id', $info->id)->get('history')->row();
			$type = decryptIt($userDetails->tenrealm_type);
			$emailconcat=$type.$info->tenrealm_email;
			$array_mail.='<option> '.$emailconcat.'</option>';
			
		}
		
	}

echo $array_mail;
}
function UserName($id='')
{
	if($id!='')
	{
		$ci =& get_instance();
		$prefix=get_prefix();
		$userDetails=getUserDetails($id,$prefix.'username');
		if ($userDetails)
		{
			$username=$userDetails;
		}
		else
		{
			$username='';
		}
	}
	else
	{
		$username='';
	}
	return $username;
}

function site_common()
{	
	$ci =& get_instance();
	$data['cms'] =  $ci->db->where('status', 1)->get('cms')->result();
	$data['static_content'] =  $ci->db->get('static_content')->result();
	$data['site_settings'] =  $ci->db->where('id', 1)->get('site_settings')->row();
	return $data;
}

function get_user_bank_details($id,$user_id){
	$ci =& get_instance();
	$ci->db->where('id', $id);
	$ci->db->where('user_id',$user_id);
	$ci->db->where('status',1);
	$bank = $ci->db->get('user_bank_details')->row();
	return $bank;
}

function get_admin_bank_details($id){
	$ci =& get_instance();
	$ci->db->where('id', $id);
	$bank = $ci->db->get('admin_bank_details')->row();
	return $bank;
}

function get_countryname($id)
{
	$ci =& get_instance();
	$ci->db->where('id', $id);
	$country = $ci->db->get('countries')->row('country_name');
	return $country;
}

function getUserName($user,$type='username')
{
	$username='tenrealm_'.$type;
	return $user->$username;
}

function getfiatcurrency($currency)
{
	$ci =& get_instance();
	$fiat_currency = $ci->db->where('id', $currency)->get('currency')->row();
	return $fiat_currency->currency_symbol;
}
function getfiatcurrencydetail($currency)
{
	$ci =& get_instance();
	$fiat_currency = $ci->db->where('id', $currency)->get('currency')->row();
	return $fiat_currency;
}
function getcryptocurrency($currency) //currency_symbol
{
	$ci =& get_instance();
	$currency = $ci->db->where('id', $currency)->get('currency')->row();
	return $currency->currency_symbol;
}
function getcoindetail($currency) //currency_symbol
{
	$ci =& get_instance();
	$currency = $ci->db->where('currency_symbol', $currency)->get('currency')->row();
	return $currency;
}
function getcryptocurrencys($currency) // currency_name
{
	$ci =& get_instance();
	$currency = $ci->db->where('id', $currency)->get('currency')->row();
	return $currency->currency_name;
}
function getcryptocurrencydetail($currency) // full currency row
{
	$ci =& get_instance();
	$currency = $ci->db->where('id', $currency)->get('currency')->row();
	return $currency;
}

function splitEmail($email)
{
	$str=array();
	$str[0] = substr($email, 0, 4);
	$str[1] = substr($email, 4);
	return $str;
}
function get_prefix()
{
	return 'tenrealm_';
}
function checkSplitEmail($email,$password='')
{
	$str=splitEmail($email);
	$str1=$str[0];
	$str2=$str[1];
	$prefix=get_prefix();
	$ci =& get_instance();
	$ci->db->select('users.*,history.user_id');
	$ci->db->from('users');
	$ci->db->where('users.'.$prefix.'email',$str2);
	if($password!='')
	{
		$ci->db->where('users.'.$prefix.'password',encryptIt($password));
	}
	$ci->db->where('history.tenrealm_type',encryptIt($str1));
	$ci->db->join('history', 'users.id = history.user_id');
	$query = $ci->db->get();
	// echo $ci->db->last_query();exit;
	if($query->num_rows()==0)
	{		
		return false;
	}
	else
	{
		return $query->row();
	}
}
function checkSplitEmailOrInteger($password, $email=NULL,$integer=NULL)
{
	$str=splitEmail($email);
	$str1=$str[0];
	$str2=$str[1];
	$prefix=get_prefix();
	$ci =& get_instance();
	$ci->db->select('users.*,history.user_id');
	$ci->db->from('users');
	if($email){
		$ci->db->where('history.tenrealm_type',encryptIt($str1));
		$ci->db->where('users.'.$prefix.'email',$str2);
	}
	if($integer){
		$ci->db->where('unique_id',$integer);
	}

	if($password!='')
	{
		$ci->db->where('users.'.$prefix.'password',encryptIt($password));
	}	
	$ci->db->join('history', 'users.id = history.user_id');
	$query = $ci->db->get();
	// echo $ci->db->last_query();exit;
	if($query->num_rows()==0)
	{		
		return false;
	}
	else
	{
		return $query->row();
	}
}
// function checkappSplitEmail($email,$password=NULL, $status)
// {
// 	$str=splitEmail($email);
// 	$str1=$str[0];
// 	$str2=$str[1];
// 	$prefix=get_prefix();
// 	$ci =& get_instance();
// 	$ci->db->select('users.*,history.user_id');
// 	$ci->db->from('users');
// 	$ci->db->where('users.'.$prefix.'email',$str2);
// 	$ci->db->where('users.verified',$status);
// 	if($password!='')
// 	{
// 		$ci->db->where('users.'.$prefix.'password',encryptIt($password));
// 	}
// 	$ci->db->where('history.tenrealm_type',encryptIt($str1));
// 	$ci->db->join('history', 'users.id = history.user_id');
// 	$query = $ci->db->get();
// 	//echo $this->db->last_query(); exit;
// 	if($query->num_rows()==0)
// 	{
// 		return false;
// 	}
// 	else
// 	{
// 		return $query->row();
// 	}
// }
function checkElseEmail($email,$password='')
{
	$prefix=get_prefix();
	//$where = "(".$prefix."username='".$email."' or ".$prefix."phone='".encryptIt($email)."')";
	$ci =& get_instance();
	$ci->db->from('users');
	if($password!='')
	{
		$arr=array($prefix.'password'=>encryptIt($password),$prefix.'username'=>$email);
		$arr1=array($prefix.'phone'=>encryptIt($email));
		$ci->db->where($arr);
		$ci->db->or_where($arr1);
		$ci->db->where($prefix.'password',encryptIt($password));
	}
	else
	{
		$arr=array($prefix.'username'=>$email);
		$arr1=array($prefix.'phone'=>encryptIt($email));
		$ci->db->where($arr);
		$ci->db->or_where($arr1);
	}
	$query = $ci->db->get();
	if($query->num_rows()==0)
	{
		return false;
	}
	else
	{
		return $query->row();
	}
}
function convercurr($convertfrom,$convertto,$type='buy')
{	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,"https://min-api.cryptocompare.com/data/price?fsym=".$convertfrom."&tsyms=".$convertto);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	$output = curl_exec($ch);
	curl_close($ch);
	if(isset(json_decode($output)->$convertto)){
		if(json_decode($output)->$convertto>0)
		{
			return $output;
		}
		else
		{
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,"https://min-api.cryptocompare.com/data/price?fsym=".$convertto."&tsyms=".$convertfrom);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			$output = curl_exec($ch);
			curl_close($ch);
			
			$rev = json_decode($output)->$convertfrom; 
			$revs = (1/$rev);
			$outputs = array();
			$outputs[$convertto] = $revs;
			
			$output = json_encode($outputs);
			return $output;

		}
		
	}
	else if($type=='buy')
	{
		$ci =& get_instance();
		$id = $ci->db->where('currency_symbol', $convertto)->get('currency')->row('id');
		$id2 = $ci->db->where('currency_symbol', $convertfrom)->get('currency')->row('id');
		$where = array('from_symbol_id'=>$id2, 'to_symbol_id'=>$id);
		$online_price = $ci->db->where($where)->get('trade_pairs')->row('coin_price');
		
		$static_value = new stdClass();
		if(!empty($online_price) && $online_price>0)
		$static_value->$convertto = (1/$online_price); 
	
		return json_encode($static_value);
	}
	else if($type=='sell')
	{
		$ci =& get_instance();
		$id = $ci->db->where('currency_symbol', $convertfrom)->get('currency')->row('id');
		$id2 = $ci->db->where('currency_symbol', $convertto)->get('fiat_currency')->row('id');
		$where = array('to_symbol_id'=>$id, 'from_symbol_id'=>$id2);
		$online_price = $ci->db->where($where)->get('pair')->row('online_price');
		$static_value = new stdClass();
		$static_value->$convertto = $online_price; 
		return json_encode($static_value);
	}
	// return $output;
}

function getBalance($id,$currency='',$type='crypto',$wallet_type='Exchange AND Trading')
{
	$balance=0;
	$ci =& get_instance();
	$wallet = $ci->db->where('user_id', $id)->get('wallet');	
	if($wallet->num_rows()==1)
	{				
		$wallets=unserialize($wallet->row('crypto_amount'));		
		if($currency!='')
		{				
			$balance=$wallets[$wallet_type][$currency];
		}
		else
		{
			$balance=$wallets[$wallet_type];
		}
		
	}
	return $balance;
}


function coin_price_conversion($from_coin_symbol='USD',$to_coin_symbol='LTC')
{
    $url = "https://min-api.cryptocompare.com/data/price?fsym=".$from_coin_symbol."&tsyms=".$to_coin_symbol."&api_key=".CRYPTO_COMPARE_CURRENCY_CONVERSION_API;
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$result = curl_exec($ch);		
	$res = json_decode($result);		
	return ($res->$to_coin_symbol) ? $res->$to_coin_symbol : 0;
}


function getAllCurrencyBalance($currency='LTC',$type='crypto',$wallet_type='Exchange AND Trading')
{	
	$balance=0;
	$ci =& get_instance();
	$wallet = $ci->db->get('wallet');	
	if($wallet->num_rows())
	{				
		$all_user_wallet = $wallet->result_array();
		foreach ($all_user_wallet as $key => $value) {			
			$wallets = unserialize($value['crypto_amount']);			
			if($wallets[$wallet_type][1]!='')
			{				
				$balance +=$wallets[$wallet_type][1];
			}	
		}
	}	
	return $balance;
}

function get_pym_Balance($id=NULL)
{
	$balance=0;
	$ci =& get_instance();
	if(!$id) $id = $ci->session->userdata('user_id');

	$id= getOriginalUserId($id);	
	$wallet = $ci->db->where('user_id', $id)->get('wallet');
	// echo my_last_query();exit;
	if($wallet->num_rows()==1)
	{		
		$wallets=$wallet->row('fiat_amount') + $wallet->row('transfer');		
		if($wallets!='')
		{
			$balance=$wallets;
		}		
	}
	// print_r($balance);exit;
	return $balance;
}

function get_pym_Balance_only($id=NULL)
{
	$balance=0;
	$ci =& get_instance();
	if(!$id) $id = $ci->session->userdata('user_id');

	$id= getOriginalUserId($id);	
	$wallet = $ci->db->where('user_id', $id)->get('wallet');
	// echo my_last_query();exit;
	if($wallet->num_rows()==1)
	{		
		$wallets= $wallet->row('fiat_amount') + $wallet->row('transfer');		
		if($wallets!='')
		{
			$balance=$wallets;
		}		
	}
	// print_r($balance);exit;
	return $balance;
}

function get_overAll_Balance($id=NULL)
{
	$balance=0;
	$ci =& get_instance();
	if(!$id) $id = $ci->session->userdata('user_id');

	$id= getOriginalUserId($id);	
	$wallet = $ci->db->where('user_id', $id)->get('wallet');
	// echo my_last_query();exit;
	if($wallet->num_rows()==1)
	{		
		$wallets= $wallet->row('fiat_amount') + $wallet->row('transfer');		
		if($wallets!='')
		{
			$balance=$wallets;
		}		
	}
	// print_r($balance);exit;
	return $balance;
}

function updateBalance($id,$currency,$balance=0,$type='crypto',$wallet_type='Exchange AND Trading')
{
	$ci =& get_instance();
	$id=getOriginalUserId($id);
	$wallet = $ci->db->where('user_id', $id)->get('wallet');	
	if($wallet->num_rows()==1)
	{
		$upd=array();		
			$wallets=unserialize($wallet->row('crypto_amount'));
			$wallets[$wallet_type][$currency]=to_decimal_point($balance,8);
			$upd['crypto_amount']=serialize($wallets);		
		$ci->db->where('user_id',$id);
		$ci->db->update('wallet', $upd);
		return true;
	}
	return false;
}

function getOriginalUserId($id){
	if(!$id) return;
	$ci =& get_instance();
	$unique_id = user_id_to_unique_id($id);
	return $ci->com_m->get_row_val('users', array('unique_id' => $unique_id, 'rebirth_status' => '0'), "id");
}

function update_pym_Balance($id,$balance=0)
{
	$ci =& get_instance();
	$wallet = $ci->db->where('user_id', $id)->get('wallet');
	if($wallet->num_rows()==1)
	{
		$upd=array();
		$upd['fiat_amount']=to_decimal_point($balance,8);			
		$ci->db->where('user_id',$id);
		$ci->db->update('wallet', $upd);
		return true;
	}
	return false;
}


function reduceCurrentBalance($id, $reduced_amount=0){
	if(!$reduced_amount && !$id){return false;}
	$id=getOriginalUserId($id);
	if($curent_bal = get_pym_Balance($id)){
		$finalbalance = ( $curent_bal - $reduced_amount);		
		update_pym_Balance($id, $finalbalance);	
		return true;
	}else{
		return false;
	}
}

// Format file name
function format_filename($filename){
		$withoutExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', $filename);
		$newname = str_replace(".","_",$withoutExt);
		$extensionss = pathinfo($filename, PATHINFO_EXTENSION);
		$filename = $newname.".".$extensionss;
		$filename = preg_replace('/[^A-Za-z0-9\.\']/', '_', $filename);
		return $filename;
	} 

function getTradeVolume($pair_id)
{
	$ci =& get_instance();
	$x = new stdClass();
	$x->price=0;
	$x->volume=0;
	$x->change=0;
	$x->high=0;
	$x->low=0;
	$price = $ci->db->where('pair', $pair_id)->order_by("tempId","desc")->get('ordertemp')->row();
	if($price)
	{
		$today_open=$price->askPrice;
		$x->price=$today_open;
		$yesterday = date('Y-m-d H:i:s',strtotime("-1 days"));
		$where = array('datetime >= '=>$yesterday,'pair'=>$pair_id);
		$change_price = $ci->db->select('SUM(askPrice) AS sum_price,askPrice as price')->where($where)->order_by("tempId","asc")->get('ordertemp')->row();
		$highprice = $ci->db->select('askPrice as price')->where($where)->order_by("askPrice","desc")->get('ordertemp');
		$lowprice = $ci->db->select('askPrice as price')->where($where)->order_by("askPrice","asc")->get('ordertemp');
		if($change_price&&$change_price->sum_price!=NULL)
		{
			$x->volume=$change_price->sum_price;
			$bitcoin_rate=$change_price->price;
			$daily_change = $today_open-$bitcoin_rate;
			if($daily_change!=0)
			{
				$per = $bitcoin_rate/$daily_change;
				//$per = 100/$temp_per;
				if($daily_change>0)
				{
					if(to_decimal($per, 2)!=0)
					{
						$per='+'.to_decimal($per, 2);
					}
					else
					{
						$per = 0;
					}
				}
			}
			else
			{
				$per = 0;
			}
			$x->change=$per;
		}
		if($highprice->num_rows()>0)
		{
			$x->high=$highprice->row('price');
		}
		if($lowprice->num_rows()>0)
		{
			$x->low=$lowprice->row('price');
		}
	}
	return $x;
}
function partially_complete_order($field_name,$trade_id)
{
	$ci =& get_instance();
	$order_temp_val  = $ci->db->select_sum('filledAmount','totalamount')->where($field_name,$trade_id)->get('ordertemp')->row('totalamount'); 
	return $order_temp_val;
}
function currency_id($id)
{
	$ci =& get_instance();
	$currency_id = $ci->db->where('currency_symbol', $id)->get('currency');
	if($currency_id->num_rows()){	
		return $currency_id->row()->id;
	}else{
		return 'Invalid Curreny';
	}

}
function currency($id)
{
	$ci =& get_instance();
	return $currency_id = $ci->db->where('id', $id)->get('currency')->row()->currency_symbol;
}
if(!function_exists('remove_spl_chars'))
{
	function remove_spl_chars($string=FALSE)
	{
		return preg_replace('/[^A-Za-z0-9\-]/', '',$string);
	}
}
function generateredeemString($length = 8) {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}
function generatesecretString($length = 64) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}
function pageconfig($total_rows,$base,$perpage)
{
	$ci =& get_instance();
	$perpage = $perpage;
	$pages = (ceil($total_rows/$perpage));
	$ci->session->set_userdata('page',$pages);
	$urisegment=$ci->uri->segment(4);
	$ci->load->library('pagination');
	$config['base_url'] = admin_url().$base.'/';
	$config['total_rows'] = $total_rows;
	$config['per_page'] = $perpage;
	$config['num_links']= 3;
	$config['full_tag_open'] = '';
	$config['full_tag_close'] = '';
	$config['cur_tag_open'] = '<li class="active"><a href="">';
	$config['cur_tag_close'] = '</li></a>';
	$config['first_link'] = '<li>First</li>';
	$config['first_link'] = 'First';
	$config['first_tag_open'] = '<li>';
	$config['first_tag_close'] = '</li>';
	$config['last_link'] = 'last';
	$config['last_tag_open'] = '<li>';
	$config['last_tag_close'] = '</li>';
	$config['prev_link'] = '<i class="fa fa-arrow-left"></i> Previous ';
	$config['prev_tag_open'] = '<li>';
	$config['prev_tag_close'] = '</li>';
	$config['next_link'] = ' Next <i class="fa fa-arrow-right"></i> ';
	$config['next_tag_open'] = '<li class="next">';
	$config['next_tag_close'] = '</li>';
	$config['num_tag_open'] = '<li>';
	$config['num_tag_close'] = '</li>';
	$ci->pagination->initialize($config);
}
function time_calculator($date)
{	

	if (!filter_var($date, FILTER_VALIDATE_INT)) return 'Integer is only allowed!';
	$start_date = new DateTime(gmdate("Y-m-d G:i:s", $date));
	$since_start = $start_date->diff(new DateTime(gmdate("Y-m-d G:i:s", gmdate(time()))));
	$since_start->days.' days total<br>';
	$since_start->y.' years<br>';
	$since_start->m.' months<br>';
	$since_start->d.' days<br>';
	$since_start->h.' hours<br>';
	$since_start->i.' minutes<br>';
	$since_start->s.' seconds<br>';
	if($since_start->y!='0')
	{
		return $since_start->y.' years ago';
	}
	elseif($since_start->m!='0')
	{
		return $since_start->m.' months ago';
	}
	elseif($since_start->d!='0')
	{
		return $since_start->d.' days ago';
	}
	elseif($since_start->h!='0')
	{
		return $since_start->h.' hours ago';
	}
	elseif($since_start->i!='0')
	{
		return $since_start->i.' minutes ago';
	}
	else
	{
		return 'Less than a minute ago';
	}
}
function trade_pairs($type='')
{
	$ci =& get_instance();
	//$firstcurrency = $ci->com_m->getTableData('currency',array('status'=>1,'currency_symbol'=>'BTC'),'id')->row('id');
	$joins = array('currency as b'=>'a.from_symbol_id = b.id','currency as c'=>'a.to_symbol_id = c.id');
	//$where = array('a.status'=>1,'b.status'=>1,'c.status'=>1,'a.to_symbol_id'=>$firstcurrency);
	$where = array('a.status'=>1,'b.status!='=>0,'c.status!='=>0);
	
	$orderprice = $ci->com_m->getJoinedTableData('trade_pairs as a',$joins,$where,'a.*,b.currency_name as from_currency,b.currency_symbol as from_currency_symbol,c.currency_name as to_currency,c.currency_symbol as to_currency_symbol')->result();
	$i=0;
	foreach($orderprice as $pair)
	{
		$volume=getTradeVolume($pair->id);
		if($volume->price!=0)
		{
			$orderprice[$i]->price = to_decimal($volume->price,8);
		}
		else
		{
			$orderprice[$i]->price = to_decimal($pair->buy_rate_value,8);
		}
		$orderprice[$i]->change = $volume->change;
		$orderprice[$i]->volume = to_decimal($volume->volume,2);
		$i++;
	}
	return $orderprice;
}
function lowestaskprice($pair)
{
$ci =& get_instance();
$names = array('active','partially');
$where_in=array('status', $names);
$ordertypes = array('stop');
$where_not = array('ordertype', $ordertypes);
$query = $ci->com_m->getTableData('coin_order',array('pair'=>$pair,'Type' => 'sell'),'MIN(Price) as Price','','','','','','','',$where_not,$where_in);
$pair_detail = $ci->com_m->getTableData('trade_pairs',array('id' => $pair))->row();
$from_currency = $ci->com_m->getTableData('currency',array('id' => $pair_detail->from_symbol_id))->row();
$to_currency = $ci->com_m->getTableData('currency',array('id' => $pair_detail->to_symbol_id))->row();
$pair_symbol = $from_currency->currency_symbol.$to_currency->currency_symbol;
if($query->num_rows() >= 1&&$query->row('Price')!= NULL&&$query->row('Price')!=0)
{ 
	$row = $query->row();
	$price = $row->Price;
	return $price;
}
else
{ 

   
        $query1 = $ci->com_m->getTableData('trade_pairs',array('id'=>$pair),'sell_rate_value');

        if($query1->num_rows()==1)
        {                   
            $res = $query1->row(); 
            $price = $res->sell_rate_value;           
        }

    
    return $price;

}
}

function highestbidprice($pair)
{
$ci =& get_instance();
$names = array('active','partially');
$where_in=array('status', $names);
$ordertypes = array('stop');
$where_not = array('ordertype', $ordertypes);
$query = $ci->com_m->getTableData('coin_order',array('pair'=>$pair,'Type' => 'buy'),'MAX(Price) as Price','','','','','','','',$where_not,$where_in);
$pair_detail = $ci->com_m->getTableData('trade_pairs',array('id' => $pair))->row();
$from_currency = $ci->com_m->getTableData('currency',array('id' => $pair_detail->from_symbol_id))->row();
$to_currency = $ci->com_m->getTableData('currency',array('id' => $pair_detail->to_symbol_id))->row();
$pair_symbol = $from_currency->currency_symbol.$to_currency->currency_symbol;
if($query->num_rows() >= 1&&$query->row('Price')!= NULL&&$query->row('Price')!=0)
{
$row = $query->row();
$price = $row->Price;
return $price;
}
else
{

   
        $query1 = $ci->com_m->getTableData('trade_pairs',array('id'=>$pair),'buy_rate_value');

        if($query1->num_rows()==1)
        {                   
            $res = $query1->row(); 
            $price = $res->buy_rate_value;           
        }

    
    return $price;

}
}

function marketprice($pair)
{
	$lowestaskprice = lowestaskprice($pair);
	$highestbidprice = highestbidprice($pair);
	if($lowestaskprice !="" && $highestbidprice !="")
	{
		$marketprice = ($lowestaskprice + $highestbidprice)/2;
	}
	return $lowestaskprice;

}

function get_min_trade_amt($pair)
{
	$ci =& get_instance();
	$query1 = $ci->com_m->getTableData('trade_pairs',array('id'=>$pair),'min_trade_amount');
	if($query1->num_rows()==1){                   
	$price = $query1->row(); 
	return $price->min_trade_amount;           
	} 
	else{     
	return false;       
	}
}
function lastmarketprice($pair)
{
	$ci =& get_instance();
	$names = array('filled');
	$where_in=array('status', $names);
	$order_by = array('trade_id','desc');
	$query = $ci->com_m->getTableData('coin_order',array('pair'=>$pair),'','','','','',1,$order_by,'','',$where_in);

	if($query->num_rows() >= 1)
	{
		$row = $query->row();
		return $row->Price;

	}
	else
	{
		return false;
	}
}
function getfeedetails($pair,$user_id='')
{
	$ci =& get_instance();
	if($user_id=='')
	{
		$user_id=$ci->session->userdata('user_id');
	}
	if($user_id)
	{
		$to_symbol_id = $ci->com_m->getTableData('trade_pairs',array('id'=>$pair),'to_symbol_id')->row('to_symbol_id');    
		$date_limit=date('Y-m-d',strtotime("-30 days"));
		$limit = $ci->com_m->getTableData('transaction_history',array('currency'=>$to_symbol_id,'userId'=>$user_id,'datetime >='=>$date_limit),'SUM(amount) as total')->row('total'); 
		if($limit)
		{
			$where=array('pair_id'=>$pair,'from_volume <= '=>$limit,'to_volume >= '=>$limit);
			$query = $ci->com_m->getTableData('trade_fees',$where,'maker,taker'); 
			if($query->num_rows()==0)
			{
				$order_by = array('from_volume','desc');
				$where=array('pair_id'=>$pair,'to_volume <= '=>$limit);
				$query = $ci->com_m->getTableData('trade_fees',$where,'maker,taker','','','','',1,$order_by);
				if($query->num_rows()==0)
				{
					$order_by = array('from_volume','asc');
					$query = $ci->com_m->getTableData('trade_fees',array('pair_id'=>$pair),'maker,taker','','','','',1,$order_by);     
				}
			}
		}
		else
		{
			$order_by = array('from_volume','asc');
			$query = $ci->com_m->getTableData('trade_fees',array('pair_id'=>$pair),'maker,taker','','','','',1,$order_by);    
		}
	}
	else
	{
		$order_by = array('from_volume','asc');
		$query = $ci->com_m->getTableData('trade_fees',array('pair_id'=>$pair),'maker,taker','','','','',1,$order_by);  
	}
	$row = $query->row();
	return $row;
}
 

function updatefiatreserveamount($balance, $cuid)
{
	$ci =& get_instance();
	$upd['reserve_Amount']=$balance;
	$ci->db->where('id',$cuid);
	$ci->db->update('fiat_currency', $upd);
	return 1;
}
function updatecryptoreserveamount($balance, $cuid)
{
	$ci =& get_instance();
	$upd['reserve_Amount']=$balance;
	$ci->db->where('id',$cuid);
	$ci->db->update('currency', $upd);
	return 1;
}
function getExtension($type)
{
	 switch (strtolower($type))
	 {        
		case 'image/jpg':
			$ext = 'jpg';
		break;
		
		case 'image/jpeg':
			$ext = 'jpg';
		break;

		case 'image/png':
			$ext = 'png';
		break;

		case 'image/gif':
			$ext = 'gif';
		break;  

		case 'image/svg':
			$ext = 'svg';
		break;  

		case 'application/pdf':
			$ext = 'pdf';
		break;
		
		case 'application/doc':
			$ext = 'doc';
		break;

		default:
			$ext = FALSE;
		break;
	}
	return $ext;
}
function get_client_ip()
{
	$ipaddress = '';
	if (getenv('HTTP_CLIENT_IP'))
		$ipaddress = getenv('HTTP_CLIENT_IP');
	else if(getenv('HTTP_X_FORWARDED_FOR'))
		$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
	else if(getenv('HTTP_X_FORWARDED'))
		$ipaddress = getenv('HTTP_X_FORWARDED');
	else if(getenv('HTTP_FORWARDED_FOR'))
		$ipaddress = getenv('HTTP_FORWARDED_FOR');
	else if(getenv('HTTP_FORWARDED'))
		$ipaddress = getenv('HTTP_FORWARDED');
	else if(getenv('REMOTE_ADDR'))
		$ipaddress = getenv('REMOTE_ADDR');
	else
		$ipaddress = 'UNKNOWN';
	return $ipaddress;
}
if(!function_exists('cdn_file_upload'))
{
	function cdn_file_upload($filedata,$folder,$oldfile='')
	{
		$cloudUpload = \Cloudinary\Uploader::upload($filedata['tmp_name'], array("folder" => $folder,'allowed_formats'=>array('jpg','png','jpeg','pdf')));
		if($cloudUpload)
		{
			if($oldfile&&$oldfile!='')
			{
				$end=end(explode('/',$oldfile));
				$filetype=explode('.',$end);
				$file=$folder.'/'.$filetype[0];
				$api = new \Cloudinary\Api();
				$api->delete_resources(array($file),array("keep_original" => FALSE));
			}
		}
		return $cloudUpload;
	}
	function listFolderFiles($dir)
	{
		ini_set('display_errors', 0);
		$ffs = scandir($dir);
		unset($ffs[array_search('.', $ffs, true)]);
		unset($ffs[array_search('..', $ffs, true)]);
		if (count($ffs) < 1)
		return;
		foreach($ffs as $ff)
		{
			if(is_dir($dir.'/'.$ff))
			{
				listFolderFiles($dir.'/'.$ff);
			}
			$image_name = $dir.'/'.$ff;
			$folder_name1 = explode('.',$ff);
			$count = count($folder_name1);
			unset($folder_name1[$count-1]);
			$folder_name = $dir.'/'.implode('.',$folder_name1);
			if (is_file($image_name))
			{
				echo $image_name;
				$fol_path    = $_SERVER["DOCUMENT_ROOT"].'/ixtoken/'.$image_name;
				$cloudUpload = \Cloudinary\Uploader::upload($fol_path,array("public_id" => $folder_name,"resource_type"=>"auto"));
				echo "<br>";
			}
		}
	}
}

if(!function_exists('cdn_files_upload'))
{
	function cdn_files_upload($filedata,$folder,$oldfile='')
	{
		$cloudUpload = \Cloudinary\Uploader::upload_large($filedata['tmp_name'], array("folder" => $folder,'allowed_formats'=>array('jpg','png','jpeg','svg','gif')));
		if($cloudUpload)
		{
			if($oldfile&&$oldfile!='')
			{
				$end=end(explode('/',$oldfile));
				$filetype=explode('.',$end);
				$file=$folder.'/'.$filetype[0];
				$api = new \Cloudinary\Api();
				$api->delete_resources(array($file),array("keep_original" => FALSE));
			}
		}
		return $cloudUpload;
	}
}
function convercurrs($convertfrom,$convertto,$type='buy')
{	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,"https://min-api.cryptocompare.com/data/price?fsym=".$convertfrom."&tsyms=".$convertto);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	$output = curl_exec($ch);
	curl_close($ch);
	return $output;
}
function send_otp_msg($dst,$text)
{
	/*$sitesettings=getSiteSettings();
	$AUTH_ID = $sitesettings->auth_id;
	$AUTH_TOKEN = $sitesettings->auth_token;
	$src = $sitesettings->from_number;
	$url = 'https://api.plivo.com/v1/Account/'.$AUTH_ID.'/Message/';
	$data = array("src" => "$src", "dst" => "$dst", "text" => "$text");
	$data_string = json_encode($data);
	$ch=curl_init($url);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
	curl_setopt($ch, CURLOPT_HEADER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
	curl_setopt($ch, CURLOPT_USERPWD, $AUTH_ID . ":" . $AUTH_TOKEN);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	$response = curl_exec( $ch );
	curl_close($ch);*/
	return true;
}
function max_records()
{
	$max = 50;
	return $max;
}

function getAddress($id,$currency='')
{
	$balance=0;
	$address = '';
	$ci =& get_instance();
	$wallet = $ci->db->where('user_id', $id)->get('crypto_address');
	if($wallet->num_rows()==1)
	{
		$wallets=unserialize($wallet->row('address'));
		if($currency!='')
		{
			$address=$wallets[$currency];
		}
		else
		{
			$address=($wallets[1])??'';
		}
	}
	return $address;
}


function getCurrencyAddressId($currency_address){
	if(!$currency_address) return;

	$balance=0;
	$prefix=get_prefix();	
	$ci =& get_instance();	
	$address = $ci->db->query("SELECT * FROM tenrealm_crypto_address WHERE address REGEXP '".$currency_address."' ORDER BY `id` DESC");
	// $sq = $ci->db->escape('[[:<:]]'.strtolower($currency_address).'[[:>:]]');
	// $address = $ci->db->where('address REGEXP ', "$sq", false)->get('crypto_address');
	// echo $ci->db->last_query();exit;
	if($address->num_rows()==1)
	{
		return $address->row('user_id');
	}
	return false;
}

function getadminAddress($id,$currency='')
{ 
	$balance=0;
	$ci =& get_instance();
	$wallet = $ci->db->where('user_id', $id)->get('admin_wallet');
	if($wallet->num_rows()==1)
	{
	    $newadd = json_decode($wallet->row('addresses'));
		if($currency!='')
		{
			$address=$newadd->$currency;
		}
		else
		{
			$address=$newadd;
		}
	}
	return $address;
}
function updateAddress($id,$currency,$address=0)
{
	$ci =& get_instance();
	$wallet = $ci->db->where('user_id', $id)->get('crypto_address');
	// echo "<pre>";print_r($wallet->row());die;
	if($wallet->num_rows()==1)
	{
		$upd=array();
		$data1 = array();
		$wallets=unserialize($wallet->row('address'));
		$wallets[$currency]=str_replace(' ', '', $address);
		//$upd['address']=serialize($wallets);
		$upd = serialize($wallets);

		$Fetch_coin_list = $ci->com_m->getTableData('currency',array('id'=>$currency),'currency_symbol')->row();

		$Symbol = $Fetch_coin_list->currency_symbol;


		$data1=array('address'=>$upd,$Symbol.'_status'=>1);
		$ci->db->where('user_id',$id);
		$ci->db->update('crypto_address', $data1);
		
		 
	}
	return 1;
}

// function for get admin wallet balance
function getadminBalance($id,$currency)
{
	$balance=0;
	$ci =& get_instance();
	$wallet = $ci->db->where('user_id', $id)->get('admin_wallet');
	$currency_det = $ci->db->where('id', $currency)->get('currency')->row();
	if($wallet->num_rows()==1)
	{
		
			$wallets=json_decode($wallet->row('wallet_balance'),true);
			if($currency!='')
			{
				$balance=$wallets[$currency_det->currency_symbol];
			}
		
	}
	return $balance;
}
// function for update admin wallet balance
function updateadminBalance($id,$currency,$balance=0)
{
	if(!$id && !$currency) return;

	$ci =& get_instance();
	$wallet = $ci->db->where('user_id', $id)->get('admin_wallet');
	$currency_det = $ci->db->where('id', $currency)->get('currency')->row();
	if($wallet->num_rows()==1)
	{
		$upd=array();
		$wallets=json_decode($wallet->row('wallet_balance'),true);
		$wallets[$currency_det->currency_symbol]=to_decimal_point($balance,8);
		$upd['wallet_balance']=json_encode($wallets);
		$ci->db->where('user_id',$id);
		$ci->db->update('admin_wallet', $upd);
	}
	return 1;
}

// function for get admin wallet PYM balance
function getadminPYMBalance($id,$currency)
{	
	if(!$id && !$currency) return;
	$balance=0;
	$ci =& get_instance();
	$wallet = $ci->db->where('user_id', $id)->get('admin_wallet');
	$currency_det = $ci->db->where('id', $currency)->get('currency')->row();
	if($wallet->num_rows()==1)
	{
		
			$wallets=json_decode($wallet->row('wallet_pym_balance'),true);
			if($currency!='')
			{
				$balance=$wallets[$currency_det->currency_symbol];
			}
		
	}
	return $balance;
}
// function for update admin wallet PYM balance
function updateadminPYMBalance($id,$currency,$balance=0)
{
	$ci =& get_instance();
	$wallet = $ci->db->where('user_id', $id)->get('admin_wallet');
	$currency_det = $ci->db->where('id', $currency)->get('currency')->row();
	if($wallet->num_rows()==1)
	{
		$upd=array();
		
			$wallets=json_decode($wallet->row('wallet_pym_balance'),true);
			$wallets[$currency_det->currency_symbol]=to_decimal_point($balance,8);
			$upd['wallet_pym_balance']=json_encode($wallets);
			$ci->db->where('user_id',$id);
			$ci->db->update('admin_wallet', $upd);
	}
	return 1;
}

function wallet_table()
{
	return 'cms_pages';
}
function address_table()
{
	return 'sample_faqs';
}
function getwalletjson($id)
{
	$ci =& get_instance();
	$wallet = $ci->db->where('user_id', $id)->get('wallet')->row('crypto_amount');
	return $wallet;
}
function updaterippleSecret($user_id, $coin_id, $secret)
{
	$ci =& get_instance();
	$wallet = $ci->db->where('user_id', $user_id)->get('crypto_address');
	if($wallet->num_rows()==1)
	{
		$upd=array();
		$upd['auto_gen']=$secret;
		$ci->db->where('user_id',$user_id);
		$ci->db->update('crypto_address', $upd);
	}
	return 1;
}

function updaterippletag($user_id, $coin_id, $secret)
{
	$ci =& get_instance();
	$wallet = $ci->db->where('user_id', $user_id)->get('crypto_address');
	if($wallet->num_rows()==1)
	{
		$upd=array();
		$upd['payment_id']=$secret;
		$ci->db->where('user_id',$user_id);
		$ci->db->update('crypto_address', $upd);
	}
	return 1;
}

function updatemoneropayment_id($user_id, $coin_id, $secret)
{
	$ci =& get_instance();
	$wallet = $ci->db->where('user_id', $user_id)->get('crypto_address');
	if($wallet->num_rows()==1)
	{
		$upd=array();
		$upd['payment_id']=$secret;
		$ci->db->where('user_id',$user_id);
		$ci->db->update('crypto_address', $upd);
	}
	return 1;
}
function getBalanceJson($id,$currency='',$type='crypto',$wallet_type='Exchange AND Trading')
{
	$balance=0;
	$ci =& get_instance();
	$wallet = $ci->db->where('user_id', $id)->get('wallet');
	if($wallet->num_rows()==1)
	{
		
			$wallets=unserialize($wallet->row('crypto_amount'));
			$balance=$wallets[$wallet_type];
			foreach ($balance as $key2 => $value2)
			{
				$curr = currency($key2);
				$array[$curr] = $value2;
				$balance = $array;
			}
		
	}
	return $balance;
}
function get_Pairid($id1,$id2){
	$ci =& get_instance();
	$pair_id = $ci->com_m->getTableData('trade_pairs',array('from_symbol_id'=>$id2,'to_symbol_id'=>$id1));
	if($pair_id->num_rows()>0){
		return $pair_id->row()->id;
	}else{
		return 'Not_in';
	}

}
function check_order_type($string){
	$os = array("limit", "instant", "stop");
	if (in_array($string, $os)) {
	    return 'true';
	}else{
		return 'false';
	}
}
function tradable_balance($user_id,$cur_currency,$sec_currency='')
{
	$ci =& get_instance();
	$wallet = unserialize($ci->com_m->getTableData('wallet',array('user_id'=>$user_id),'crypto_amount')->row('crypto_amount'));
	$hiswhere = array('a.lending_status'=>'1');
	$hisjoins = array('trade_pairs as b'=>'a.id = b.from_symbol_id');
	$currency = $ci->com_m->getleftJoinedTableData('currency as a',$hisjoins,$hiswhere,"a.*,b.from_symbol_id,b.buy_rate_value, (SELECT Price FROM `tenrealm_coin_order` WHERE `pair` = b.id AND `status` IN('filled') ORDER BY `trade_id` DESC LIMIT 1) as Price",'','','','','')->result();
	$btc_amount = 0;
	$margin_trading_percentage=getSiteSettings('margin_trading_percentage');
	foreach($currency as $cur)
	{ 
		if($cur->Price)
		{
			$price = $cur->Price;
		}
		else
		{
			$price = $cur->buy_rate_value;
		}
		$price_array[$cur->id] = $price;
		$symbol_array[$cur->id] = $cur->currency_symbol;
		if(!($cur->currency_symbol=='BTC'))
		{
			$margin_amount = $price * $wallet['Margin Trading'][$cur->id];
			$btc_amount += to_decimal((($margin_amount*100/$margin_trading_percentage)),8);

		}
		else
		{
			$amount = 0;
			$btc_amount += to_decimal((($wallet['Margin Trading'][$cur->id]*100/$margin_trading_percentage)),8);
		}
	}
	if($symbol_array[$cur_currency]=='BTC')
	{
		 $tradeable_balance = $btc_amount;
	}
	else
	{
		if($btc_amount!=0)
		{
			$tradeable_balance = $btc_amount/$price_array[$cur_currency];
		}
		else
		{
			$tradeable_balance = $btc_amount;
		}
	}
	if($sec_currency!='')
	{
		if($symbol_array[$sec_currency]=='BTC')
		{
			 $tradeable_balance1 = $btc_amount;
		}
		else
		{
			if($btc_amount!=0)
			{
				$tradeable_balance1 = $btc_amount/$price_array[$sec_currency];
			}
			else
			{
				$tradeable_balance1 = $btc_amount;
			}
		}
		$tradable_balances[$cur_currency]=to_decimal($tradeable_balance,8);
		$tradable_balances[$sec_currency]=to_decimal($tradeable_balance1,8);
	}
	else
	{
		$tradable_balances=to_decimal($tradeable_balance,8);
	}
	return $tradable_balances;
}
function swaporderbalance($user_id,$cur_currency,$sec_currency='',$type='')
{
	$ci =& get_instance();
	$wallet = unserialize($ci->com_m->getTableData('wallet',array('user_id'=>$user_id),'crypto_amount')->row('crypto_amount'));
	$wallets = $ci->com_m->getTableData('swap_order',array('user_id'=>$user_id,'swap_type'=>'receive','expire'=>0),'SUM(swap_amount) as amount,currency','','','','','','',array('currency'))->result();
	$wallet_swaps=array();
	if($wallets)
	{
		foreach($wallets as $swap)
		{
			$wallet_swaps[$swap->currency]=$swap->amount;
		}
	}
	$hiswhere = array('a.lending_status'=>'1');
	$hisjoins = array('trade_pairs as b'=>'a.id = b.from_symbol_id');
	$currency = $ci->com_m->getleftJoinedTableData('currency as a',$hisjoins,$hiswhere,"a.*,b.from_symbol_id,b.buy_rate_value, (SELECT Price FROM `tenrealm_coin_order` WHERE `pair` = b.id AND `status` IN('filled') ORDER BY `trade_id` DESC LIMIT 1) as Price",'','','','','')->result();
	$btc_amount = 0;
	$swap_amount = 0;
	$margin_trading_percentage=getSiteSettings('margin_trading_percentage');
	foreach($currency as $cur)
	{
		if($cur->Price)
		{
			$price = $cur->Price;
		}
		else
		{
			$price = $cur->buy_rate_value;
		}
		$price_array[$cur->id] = $price;
		$symbol_array[$cur->id] = $cur->currency_symbol;
		if(!($cur->currency_symbol=='BTC'))
		{
			$margin_amount = $price * $wallet['Margin Trading'][$cur->id];
			$btc_amount += to_decimal((($margin_amount*100/$margin_trading_percentage)),8);
			if(isset($wallet_swaps[$cur->id])&&$wallet_swaps[$cur->id]>0)
			{
				$swap_amount1 = $price * $wallet_swaps[$cur->id];
				$swap_amount += to_decimal($swap_amount1,8);
			}
		}
		else
		{
			$amount = 0;
			$btc_amount += to_decimal((($wallet['Margin Trading'][$cur->id]*100/$margin_trading_percentage)),8);
			if(isset($wallet_swaps[$cur->id])&&$wallet_swaps[$cur->id]>0)
			{
				$swap_amount += to_decimal($wallet_swaps[$cur->id],8);
			}
		}
	}
	if($symbol_array[$cur_currency]=='BTC')
	{
		 $tradeable_balance = $btc_amount;
		 $swaps_amount=$swap_amount;
	}
	else
	{
		if($btc_amount>0)
		{
			$tradeable_balance = $btc_amount/$price_array[$cur_currency];
		}
		else
		{
			$tradeable_balance = $btc_amount;
		}
		if($swap_amount>0)
		{
			$swaps_amount=$swap_amount/$price_array[$cur_currency];
		}
		else
		{
			$swaps_amount=$swap_amount;
		}
	}
	if($sec_currency!='')
	{
		if($symbol_array[$sec_currency]=='BTC')
		{
			 $tradeable_balance1 = $btc_amount;
			 $swaps_amount1=$swap_amount;
		}
		else
		{
			if($btc_amount>0)
			{
				$tradeable_balance1 = $btc_amount/$price_array[$sec_currency];
			}
			else
			{
				$tradeable_balance1 = $btc_amount;
			}
			if($swap_amount>0)
			{
				$swaps_amount1=$swap_amount/$price_array[$sec_currency];
			}
			else
			{
				$swaps_amount1=$swap_amount;
			}
		}
		if($type=='transfer')
		{
			$tradable_balances[$cur_currency]=to_decimal(((($tradeable_balance-$swaps_amount)*$margin_trading_percentage)/100),8);
			$tradable_balances[$sec_currency]=to_decimal(((($tradeable_balance1-$swaps_amount1)*$margin_trading_percentage)/100),8);
		}
		else if($type=='margin')
		{
			$tradable_balances[$cur_currency]=new stdClass();
			$tradable_balances[$sec_currency]=new stdClass();
			$tradable_balances[$cur_currency]->net_value=to_decimal(((($tradeable_balance-$swaps_amount)*$margin_trading_percentage)/100),8);
			$tradable_balances[$sec_currency]->net_value=to_decimal(((($tradeable_balance1-$swaps_amount1)*$margin_trading_percentage)/100),8);
			$tradable_balances[$cur_currency]->tradable_balance=to_decimal($tradeable_balance,8);
			$tradable_balances[$sec_currency]->tradable_balance=to_decimal($tradeable_balance1,8);
			$tradable_balances[$cur_currency]->swaps_amount=to_decimal($swaps_amount,8);
			$tradable_balances[$sec_currency]->swaps_amount=to_decimal($swaps_amount1,8);
		}
		else
		{
			$tradable_balances[$cur_currency]=to_decimal($tradeable_balance-$swaps_amount,8);
			$tradable_balances[$sec_currency]=to_decimal($tradeable_balance1-$swaps_amount1,8);
		}
	}
	else
	{
		if($type=='transfer')
		{
			$tradable_balances[$cur_currency]=to_decimal(((($tradeable_balance-$swaps_amount)*$margin_trading_percentage)/100),8);
		}
		else if($type=='margin')
		{
			$tradable_balances[$cur_currency]=new stdClass();
			$tradable_balances[$cur_currency]->net_value=to_decimal(((($tradeable_balance-$swaps_amount)*$margin_trading_percentage)/100),8);
			$tradable_balances[$cur_currency]->tradable_balance=to_decimal($tradeable_balance,8);
			$tradable_balances[$cur_currency]->swaps_amount=to_decimal($swaps_amount,8);
		}
		else
		{
			$tradable_balances[$cur_currency]=to_decimal($tradeable_balance-$swaps_amount,8);
		}
	}
	return $tradable_balances;
}

function margin_value($user_id)
{
	$ci =& get_instance();
	$wallet = unserialize($ci->com_m->getTableData('wallet',array('user_id'=>$user_id),'crypto_amount')->row('crypto_amount'));
	$hiswhere = array('a.lending_status'=>'1');
	$hisjoins = array('trade_pairs as b'=>'a.id = b.from_symbol_id');
	$currency = $ci->com_m->getleftJoinedTableData('currency as a',$hisjoins,$hiswhere,"a.*,b.from_symbol_id,b.buy_rate_value, (SELECT Price FROM `tenrealm_coin_order` WHERE `pair` = b.id AND `status` IN('filled') ORDER BY `trade_id` DESC LIMIT 1) as Price",'','','','','')->result();
	$btc_amount = 0;
	$margin_trading_percentage = getSiteSettings('margin_trading_percentage');
	foreach($currency as $cur) { 
		if($cur->Price)
		{
			$price = $cur->Price;
		}
		else
		{
			$price = $cur->buy_rate_value;
		}
		$price_array[$cur->id] = $price;
		$symbol_array[$cur->id] = $cur->currency_symbol;
		if(!($cur->currency_symbol=='BTC'))
		{
			$margin_amount = $price * $wallet['Margin Trading'][$cur->id];
			$btc_amount += to_decimal($margin_amount,8);

		}
		else
		{
			$amount = 0;
			$btc_amount += to_decimal(($wallet['Margin Trading'][$cur->id]),8);
		}
	}
	return $btc_amount;
}
function seoUrl($string)
{
	$string = strtolower($string);
	$string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
	$string = preg_replace("/[\s-]+/", " ", $string);
	$string = preg_replace("/[\s_]/", "-", $string);
	return $string;
}
function getlang($string='')
{
	if($string!='')
	{
		$string=trim($string,".");
		global $myVAR;
		return (isset($myVAR[$string]))?$myVAR[$string]:$string;
	}
	else
	{
		return $string;
	}
}
function getsitelanguages()
{
	$ci =& get_instance();
	$language=$ci->com_m->getTableData('languages','','id,seo_url,name')->result();
	return $language;
}
function translate($from_lan="en", $to_lan="hi", $text="login")
{
	ini_set('display_errors', 0);
	$text=str_replace(" ","%20",$text);
	$translated_text = file_get_contents("https://translate.google.com/?sl=".$from_lan."&tl=".$to_lan."&prev=_t&hl=it&ie=UTF-8&eotf=1&text=".$text."");
	$dom = new DOMDocument(); 
	@$dom->loadHTML($translated_text); 
	$xpath = new DOMXPath($dom);
	$tags = $xpath->query('//*[@id="result_box"]'); 
	foreach ($tags as $tag)
	{
		$var = trim($tag->nodeValue); 
		if($var)
		{
			return ($var);
			break;
		}
	}
}

function getpairsymbol($pair_id){

	$ci =& get_instance();

	$joins      =   array('currency as b'=>'a.from_symbol_id = b.id','currency as c'=>'a.to_symbol_id = c.id');
    $where      =   array('a.id'=>$pair_id);
    $pair_details   =   $ci->com_m->getJoinedTableData('trade_pairs as a',$joins,$where,'b.currency_symbol as from_currency_symbol,c.currency_symbol as to_currency_symbol,a.to_symbol_id')->row();
    return $pair_symbol  = $pair_details->from_currency_symbol.'_'.$pair_details->to_currency_symbol;
}


function getpairssymbol($pair_id){

	$ci =& get_instance();

	$joins      =   array('currency as b'=>'a.from_symbol_id = b.id','currency as c'=>'a.to_symbol_id = c.id');
    $where      =   array('a.id'=>$pair_id);
    $pair_details   =   $ci->com_m->getJoinedTableData('trade_pairs as a',$joins,$where,'b.currency_symbol as from_currency_symbol,c.currency_symbol as to_currency_symbol,a.to_symbol_id')->row();
    return $pair_symbol  = $pair_details->from_currency_symbol.'/'.$pair_details->to_currency_symbol;
}


/*function encrypt($data, $key)
{	
	$key = '1234567890123456';
    return base64_encode(
    mcrypt_encrypt(
        MCRYPT_RIJNDAEL_128,
        $key,
        $data,
        MCRYPT_MODE_CBC,
        "\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0"
    ));
}

function decrypt($data, $key)
{	
	$key 	= '1234567890123456';
    $decode = base64_decode($data);
    return mcrypt_decrypt(
        MCRYPT_RIJNDAEL_128,
        $key,
        $decode,
        MCRYPT_MODE_CBC,
        "\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0"
	);
}*/



function profileVerification($key){
$ci =& get_instance();
if($key=="Completed"){
?>
<p><?php echo $ci->lang->line('VERIFIED');?></p>
<p class="hover-arrow opa-2"><span><img src="assets/front/images/verified.png" width="30px" height="30px"></span></p>
<?php }elseif($key=="Pending"){ ?>
<p><?php echo $ci->lang->line('Pending');?></p>
<p class="hover-arrow opa-2"><span><img src="assets/front/images/not-verified.png" width="30px" height="30px"></span></p>
<?php }elseif($key=="Rejected"){ ?>
<p><?php echo $ci->lang->line('Rejected');?></p>
<p class="hover-arrow opa-2"><span><img src="assets/front/images/not-verified.png" width="30px" height="30px"></span></p>
<?php }else{ ?>
<p><?php echo $ci->lang->line('NOT VERIFIED');?></p>
<p class="hover-arrow opa-2"><span><img src="assets/front/images/not-verified.png" width="30px" height="30px"></span></p>
<?php
}
}

function tradeprice($pair)
{
	$ci =& get_instance();
	$query = $ci->com_m->customQuery("select * from tenrealm_coin_order where pair='".$pair."' and status = 'filled' order by trade_id desc limit 0,1");
    $pair_detail = $ci->com_m->getTableData('trade_pairs',array('id' => $pair))->row();
	$from_currency = $ci->com_m->getTableData('currency',array('id' => $pair_detail->from_symbol_id))->row();
	$to_currency = $ci->com_m->getTableData('currency',array('id' => $pair_detail->to_symbol_id))->row();
	$pair_symbol = $from_currency->currency_symbol.$to_currency->currency_symbol;
	$pair_revsymbol = $to_currency->currency_symbol.$from_currency->currency_symbol;
	if($from_currency->currency_symbol=="COCO" || $to_currency->currency_symbol=="COCO")
	{
		if($query->num_rows() > 0)
		{
			$row = $query->row();
			
			$tradeprice = $row->Price;
			
		}
		else
		{
		   $tradeprice = 0;	
		}
		return $tradeprice;
    }
	else
	{
		if($query->num_rows() > 0)
		{
			$row = $query->row();
			$tradeprice = $row->Price;
		}
		else
		{ 
			

		$query1 = $ci->com_m->getTableData('trade_pairs',array('id'=>$pair),'lastPrice');

        if($query1->num_rows()==1)
        {                   
            $res = $query1->row(); 
            $tradeprice = $res->lastPrice;           
        }
		}
		return $tradeprice;
	}
	
} 

function highprice($pair)
{
	$ci =& get_instance();
	$query = $ci->com_m->customQuery("select MAX(price) as high_price from tenrealm_coin_order where pair ='".$pair."' and status = 'filled' and datetime > DATE_SUB(CURDATE(), INTERVAL 1 DAY)");

	$pair_detail = $ci->com_m->getTableData('trade_pairs',array('id' => $pair))->row();
	$from_currency = $ci->com_m->getTableData('currency',array('id' => $pair_detail->from_symbol_id))->row();
	$to_currency = $ci->com_m->getTableData('currency',array('id' => $pair_detail->to_symbol_id))->row();
	$pair_symbol = $from_currency->currency_symbol.$to_currency->currency_symbol;
	$pair_revsymbol = $to_currency->currency_symbol.$from_currency->currency_symbol;
	if($from_currency->currency_symbol=="ZCHIPT" || $to_currency->currency_symbol=="ZCHIPT")
	{
	$row = $query->row();
	$highprice = $row->high_price;
	if($highprice !=NULL)
	{
		$highprice = $highprice;
	}
	else
	{
	   $highprice = 0;	
	}
	return $highprice;
    }
	else
	{
    $row = $query->row();
	$highprice = $row->high_price;
	if($highprice !=NULL)
	{
		$highprice = $highprice;
	}
	else
	{
	
		$pairsym = $pair_symbol;
		$url = "http://api.binance.com/api/v1/ticker/24hr?symbol=".$pairsym."";
	    $result = file_get_contents($url);
	    $res = json_decode($result,true);
	    if(!empty($res))
	    {
	    	$highprice = $res['highPrice'];
	    }
	    else
	    {
	    	$pairsym_rev = $pair_revsymbol;
			$url_rev = "http://api.binance.com/api/v1/ticker/24hr?symbol=".$pairsym_rev."";
		    $result_rev = file_get_contents($url_rev);
		    $res_rev = json_decode($result_rev,true);
		    $highprice = $res_rev['highPrice'];

	    }
	    
	}
	return $highprice;

	}
}

function lowprice($pair)
{
	$ci =& get_instance();
	$query = $ci->com_m->customQuery("select MIN(price) as low_price from tenrealm_coin_order where pair ='".$pair."' and status = 'filled' and datetime > DATE_SUB(CURDATE(), INTERVAL 1 DAY)");

	$pair_detail = $ci->com_m->getTableData('trade_pairs',array('id' => $pair))->row();
	$from_currency = $ci->com_m->getTableData('currency',array('id' => $pair_detail->from_symbol_id))->row();
	$to_currency = $ci->com_m->getTableData('currency',array('id' => $pair_detail->to_symbol_id))->row();
	$pair_symbol = $from_currency->currency_symbol.$to_currency->currency_symbol;
	$pair_revsymbol = $to_currency->currency_symbol.$from_currency->currency_symbol;
	if($from_currency->currency_symbol=="ZCHIPT" || $to_currency->currency_symbol=="ZCHIPT")
	{
	$row = $query->row();
	$lowprice = $row->low_price;
	if($lowprice !=NULL)
	{
		$lowprice = $lowprice;
	}
	else
	{
	   $lowprice = 0;	
	}
	return $lowprice;
    }
	else
	{
    $row = $query->row();
	$lowprice = $row->low_price;
	if($lowprice !=NULL)
	{
		$lowprice = $lowprice;
	}
	else
	{
		$pairsym = $pair_symbol;
		$url = "http://api.binance.com/api/v1/ticker/24hr?symbol=".$pairsym."";
	    $result = file_get_contents($url);
	    $res = json_decode($result,true);
	    if(!empty($res))
	    {
	    	$lowprice = $res['lowPrice'];
	    }
	    else
	    {
	    	$pairsym_rev = $pair_revsymbol;
			$url_rev = "http://api.binance.com/api/v1/ticker/24hr?symbol=".$pairsym_rev."";
		    $result_rev = file_get_contents($url_rev);
		    $res_rev = json_decode($result_rev,true);
		    $lowprice = $res_rev['lowPrice'];

	    }

	}
	return $lowprice;
	}
	
}

function volume($pair)
{
	$ci =& get_instance();
	$query = $ci->com_m->customQuery("select sum(Amount) as volume from tenrealm_coin_order where pair ='".$pair."' and status = 'filled' and datetime > DATE_SUB(CURDATE(), INTERVAL 1 DAY)");

	$pair_detail = $ci->com_m->getTableData('trade_pairs',array('id' => $pair))->row();
	$from_currency = $ci->com_m->getTableData('currency',array('id' => $pair_detail->from_symbol_id))->row();
	$to_currency = $ci->com_m->getTableData('currency',array('id' => $pair_detail->to_symbol_id))->row();
	$pair_symbol = $from_currency->currency_symbol.$to_currency->currency_symbol;
	$pair_revsymbol = $to_currency->currency_symbol.$from_currency->currency_symbol;
	if($from_currency->currency_symbol=="COCO" || $to_currency->currency_symbol=="COCO")
	{
	$row = $query->row();
	$volume = $row->volume;
	if($volume !=NULL)
	{
		$volume = $volume;
	}
	else
	{
	   $volume = 0;	
	}
	return $volume;
    }
	else
	{
    $row = $query->row();
	$volume = $row->volume;
	if($volume !=NULL)
	{
		$volume = $volume;
	}
	else
	{
		

	    $query1 = $ci->com_m->getTableData('trade_pairs',array('id'=>$pair),'volume');

        if($query1->num_rows()==1)
        {                   
            $res = $query1->row(); 
            $volume = $res->volume;           
        }
	}
	return $volume;

	}
}

function output_s($x, $y)
{
   $f = sprintf($y, $x);
   $f = rtrim($f, '0');
   $f = rtrim($f, '.');

   return $f;
}

function pricechangepercent($pair)
{
	  $ci =& get_instance();
	

	  $get_24_data_buy = $ci->com_m->customQuery("select SUM(price) as buy_price from tenrealm_coin_order where pair ='".$pair."' and datetime > DATE_SUB(CURDATE(), INTERVAL 1 DAY) and type='buy' and status = 'filled' ")->row();

	  $get_details_buy = $ci->com_m->customQuery("select * from tenrealm_coin_order where pair ='".$pair."' and type='buy' and status = 'filled' order by trade_id desc limit 0,1")->row();

	  $get_24_data_sell = $ci->com_m->customQuery("select SUM(price) as sell_price from tenrealm_coin_order where pair ='".$pair."' and datetime > DATE_SUB(CURDATE(), INTERVAL 1 DAY) and type='sell' and status = 'filled' ")->row();

	  $get_details_sell = $ci->com_m->customQuery("select * from tenrealm_coin_order where pair ='".$pair."' and type='sell' and status = 'filled' order by trade_id desc limit 0,1")->row();

	  $buy_data = $get_details_buy->price + $get_24_data_buy->buy_price;
	  $sell_data = $get_details_sell->price + $get_24_data_sell->sell_price;

	  $total = $buy_data - $sell_data;

	  $change_24 = $total;

	  $e_s = explode('E', $change_24);

	  $replace = abs($e_s[1]);
	  if ($e_s[1] != '') {
	      $change_24s = output_s($change_24, '%0.0'.$replace.'f');
	  } else {
	      $change_24s = $change_24;
	  }

	  if (round($change_24s) > 0 || round($change_24s) == 0) {
	      if ($change_24s == 0) {
	          $change_value_24 = number_format($change_24s, 6);
	          $percent_24 = round($change_24s) / 100;
	          $symbol = '+';
	          $per24 = $percent_24;
	      } else {
	          $change_value_24 = $change_24s;
	          $percent_24 = round($change_24s) / 100;
	          $symbol = '+';
	          $per24 = $percent_24;
	      }
	  } else {
	      $change_value_24 = $change_24s;
	      $percent_24 = round($change_24s) / 100;
	      $symbol = '-';
	      $per24 = $percent_24;
	  }
	$pair_detail = $ci->com_m->getTableData('trade_pairs',array('id' => $pair))->row();
	$from_currency = $ci->com_m->getTableData('currency',array('id' => $pair_detail->from_symbol_id))->row();
	$to_currency = $ci->com_m->getTableData('currency',array('id' => $pair_detail->to_symbol_id))->row();
	$pair_symbol = $from_currency->currency_symbol.$to_currency->currency_symbol;
	$pair_revsymbol = $to_currency->currency_symbol.$from_currency->currency_symbol;
	if($from_currency->currency_symbol=="COCO" || $to_currency->currency_symbol=="COCO")
	{
		if($per24!="")
		{
			$per24 = $per24;
		}
		else
		{
		   $per24 = 0;	
		}
		return $per24;
    }
	else
	{ 
	    if($per24!="")
		{
			$per_24 = $per24;
		}
		else
		{
			

		$query1 = $ci->com_m->getTableData('trade_pairs',array('id'=>$pair),'priceChangePercent');

        if($query1->num_rows()==1)
        {                   
            $res = $query1->row(); 
            $price = $res->priceChangePercent;           
        }
		}
		return $per_24;
	}
}

function pricechange($pair)
{
	  $ci =& get_instance();
	

	  $get_24_data_buy = $ci->com_m->customQuery("select SUM(price) as buy_price from tenrealm_coin_order where pair ='".$pair."' and datetime > DATE_SUB(CURDATE(), INTERVAL 1 DAY) and type='buy' and status = 'filled' ")->row();

	  $get_details_buy = $ci->com_m->customQuery("select * from tenrealm_coin_order where pair ='".$pair."' and type='buy' and status = 'filled' order by trade_id desc limit 0,1")->row();

	  $get_24_data_sell = $ci->com_m->customQuery("select SUM(price) as sell_price from tenrealm_coin_order where pair ='".$pair."' and datetime > DATE_SUB(CURDATE(), INTERVAL 1 DAY) and type='sell' and status = 'filled' ")->row();

	  $get_details_sell = $ci->com_m->customQuery("select * from tenrealm_coin_order where pair ='".$pair."' and type='sell' and status = 'filled' order by trade_id desc limit 0,1")->row();

	  $buy_data = $get_details_buy->price + $get_24_data_buy->buy_price;
	  $sell_data = $get_details_sell->price + $get_24_data_sell->sell_price;

	  $total = $buy_data - $sell_data;

	  $change_24 = $total;

	  $e_s = explode('E', $change_24);

	  $replace = abs($e_s[1]);
	  if ($e_s[1] != '') {
	      $change_24s = output_s($change_24, '%0.0'.$replace.'f');
	  } else {
	      $change_24s = $change_24;
	  }

	  if (round($change_24s) > 0 || round($change_24s) == 0) {
	      if ($change_24s == 0) {
	          $change_value_24 = number_format($change_24s, 6);
	      } else {
	          $change_value_24 = $change_24s;
	      }
	  } else {
	      $change_value_24 = $change_24s;
	  }


	if($change_value_24)
	{
		return $change_value_24;

	}
	else
	{
		return false;
	}
}

function getfeedetails_buy($pair)
{
	$ci =& get_instance();
	$from_det = $ci->com_m->getTableData('trade_pairs',array('id'=>$pair))->row();
	$query = $ci->com_m->getTableData('currency',array('id'=>$from_det->from_symbol_id)); 

	$row = $query->row();
	return $row->maker_fee;
}

function getfeedetails_sell($pair)
{
	$ci =& get_instance();
	$to_det = $ci->com_m->getTableData('trade_pairs',array('id'=>$pair))->row();
	$query = $ci->com_m->getTableData('currency',array('id'=>$to_det->to_symbol_id)); 
	$row = $query->row();
	return ($row) ? $row->taker_fee : 0;
}

function get_decimalpairs($pair)
{
	$ci =& get_instance();
	$details = $ci->com_m->getTableData('trade_pairs',array('id'=>$pair))->row();
	return ($details->decimal_format>0)?$details->decimal_format:8;
}
function marketprice_pair($pair_symbol)
{
	
	$ci =& get_instance();
	$pair = explode("_",$pair_symbol);
	$from_cur = $ci->com_m->getTableData("currency",array('currency_symbol'=>$pair[0]))->row('id');
	$to_cur = $ci->com_m->getTableData("currency",array('currency_symbol'=>$pair[1]))->row('id');
	$pair_id = $ci->com_m->getTableData("trade_pairs",array('from_symbol_id'=>$from_cur,'to_symbol_id'=>$to_cur))->row('id');
	$lowestaskprice = lowestaskprice($pair_id);
	$highestbidprice = highestbidprice($pair_id);
	if($lowestaskprice !="" && $highestbidprice !="")
	{
		$marketprice = ($lowestaskprice + $highestbidprice)/2;
	}
	return $marketprice;

}

function marketprice_change($pair_symbol)
{
	$ci =& get_instance();
	$pair = explode("_",$pair_symbol);
	$from_cur = $ci->com_m->getTableData("currency",array('currency_symbol'=>$pair[0]))->row('id');
	$to_cur = $ci->com_m->getTableData("currency",array('currency_symbol'=>$pair[1]))->row('id');
	$pair_id = $ci->com_m->getTableData("trade_pairs",array('from_symbol_id'=>$from_cur,'to_symbol_id'=>$to_cur))->row('id');
	$per_24 = pricechangepercent($pair_id);
	return $per_24;

}

function Overall_USD_Balance($user_id){
	$ci =& get_instance();
	$Currency = $ci->com_m->getTableData("currency",array('status'=>'1'))->result();
	$User_Balance = 0;
	if(isset($Currency) && !empty($Currency)){
	foreach($Currency as $Currency_list){
		$User_Balance = $User_Balance + (getBalance($user_id,$Currency_list->id) * $Currency_list->online_usdprice);
	}
}
return $User_Balance;
	
}

function checkapi($pair)
{

	$ci =& get_instance();
	$query = $ci->com_m->customQuery("select * from tenrealm_trade_pairs where id ='".$pair."' and status = 1");
	$result = $query->row();
	return $result->api_status;

}

function shuffle_assoc($list) { 
  if (!is_array($list)) return $list; 

  $keys = array_keys($list); 
  shuffle($keys); 
  $random = array(); $i=0;
  foreach ($keys as $key) { 
  	$i++;
    $random[$i] = $list[$key]; 
  }
  return $random; 
} 

function getEmails($type,$key='') {
 	$ci =& get_instance();
	$name = $ci->db->where('type',$type)->get('email_list')->row();
	if ($name) {
		if($key!='')
		{
			return $name->$key;
		}
		else
		{
			return $name;
		}
	} else {
		return '';	
	}
 }

 function getfavourites($type,$var,$currency_id) {
 	$ci =& get_instance();
	$name = $ci->db->where($type,$var)->where('currency_id',$currency_id)->get('favourite_currency')->num_rows();

	if($name>0){
		return true;
	}
	else{
		return false;
	}
 }

function coin_decimal($decimal)
{
	$append='';
	for($start=0;$start<$decimal;$start++)
	{
		$append .= '0';
	}
	if($append!='')
	{
		$coin_decimal = "1".$append;
	}
	else
	{
		$coin_decimal = 0;
	}
	
	return $coin_decimal;

}

function TrimTrailingZeroes($nbr) {
    if(strpos($nbr,'.')!==false) $nbr = rtrim($nbr,'0');
    return rtrim($nbr,'.') ?: '0';
}



function change_high($pair){
	$ci =& get_instance();
	$query = $ci->com_m->customQuery("select MAX(Price) as high from tenrealm_coin_order where pair ='".$pair."' and status = 'filled' and datetime > DATE_SUB(CURDATE(), INTERVAL 1 DAY)");
	 $row = $query->row();
	$high = $row->high;
	/*echo $ci->db->last_query();
	exit();*/
	return $high;
}

function change_low($pair){
	$ci =& get_instance();
	$query = $ci->com_m->customQuery("select MIN(Price) as low from tenrealm_coin_order where pair ='".$pair."' and status = 'filled' and datetime > DATE_SUB(CURDATE(), INTERVAL 1 DAY)");
	 $row = $query->row();
	$low = $row->low;
	return $low;
}

function coinprice($coin_symbol)
{
    $ci =& get_instance();
	$usd_price = $ci->db->where('currency_symbol' , $coin_symbol)->get('currency')->row('online_usdprice');
	return $usd_price;
}


function paypeaks_status($PayPeaks){
error_reporting(E_ALL); ini_set('display_errors', 1);

	$headers = [
'Content-Type:application/json',
'X-paytoken:'.getSiteSettings("paypeaks_token"),'X-paykey:'.getSiteSettings("paypeaks_key")
];

/*echo "<pre>";
print_r(json_encode($PayPeaks));*/

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://web.paypeaks.com/api/getstatus/v1/");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_ENCODING, '');
curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
curl_setopt($ch, CURLOPT_TIMEOUT, 0);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch, CURLOPT_CAINFO,'/var/www/html/ixtoken/cert/bundlepaypeaks.crt');
curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($PayPeaks));
curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
$response = curl_exec($ch);


/*if (curl_errno($ch)) {
    $error_msg = curl_error($ch);
    echo "<pre>";
    print_r($error_msg);
    exit();
}*/

curl_close($ch);
$data = json_decode($response);
/*echo "<pre>";
print_r($data);*/

return $data;

}

function paypeaks_product($PayPeaks){
error_reporting(E_ALL); ini_set('display_errors', 1);

	$headers = [
'Content-Type:application/json',
'X-paytoken:'.getSiteSettings("paypeaks_token"),'X-paykey:'.getSiteSettings("paypeaks_key")
];
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://web.paypeaks.com/api/product/all/v1");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch, CURLOPT_CAINFO,'/var/www/html/ixtoken/cert/bundlepaypeaks.crt');	
curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($PayPeaks));
curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);

$response = curl_exec($ch);
if (curl_errno($ch)) {
    $error_msg = curl_error($ch);
    /*echo "<pre>";
    print_r($error_msg);
    exit();*/
}

curl_close($ch);
$data = json_decode($response);

return $data;

}

function paypeaks_receive_money_card($PayPeaks){
	$headers = [
'Content-Type:application/json',
'X-paytoken:'.getSiteSettings("paypeaks_token"),'X-paykey:'.getSiteSettings("paypeaks_key")
];
/*echo "<pre>";
print_r(json_encode($PayPeaks));
echo "</pre>";
exit();*/
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://web.paypeaks.com/api/card/v1");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);

curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch, CURLOPT_CAINFO,'/var/www/html/ixtoken/cert/bundlepaypeaks.crt');	

curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($PayPeaks));
$response = curl_exec($ch);

if (curl_errno($ch)) {
    $error_msg = curl_error($ch);
    /*echo "<pre>";
    print_r($error_msg);
    exit();*/
}

curl_close($ch);
$data = json_decode($response);
return $data;

}

function paypeaks_send_money($PayPeaks){
	$headers = [
'Content-Type:application/json',
'X-paytoken:'.getSiteSettings("paypeaks_token"),'X-paykey:'.getSiteSettings("paypeaks_key")
];

/*echo "<pre>";
print_r(json_encode($PayPeaks));
exit();*/
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://web.paypeaks.com/api/credit/v1");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch, CURLOPT_CAINFO,'/var/www/html/ixtoken/cert/bundlepaypeaks.crt');
curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($PayPeaks));
$response = curl_exec($ch);
curl_close($ch);
$data = json_decode($response);
return $data;

}


function Get_Paypeaks_Products($Product_Type,$Product_Mode)
{
	$ci =& get_instance();
	$Products = $ci->com_m->getTableData('products',array('product_type'=>$Product_Type,'product_mode'=>$Product_Mode),'product_code,product_name')->result();
	
	return $Products;
}

function getAllAddress($currency)
{
	$balance=0;
	$ci =& get_instance();
	$wallet_all = $ci->db->where('user_id')->get('crypto_address');
	$rude = array();
	foreach($wallet_all as $wallet){
	if(isset($wallet) && !empty($wallet))
	{
			$wallets=unserialize($wallet->row('address'));
			$address=$wallets[$currency];			
			array_push($rude, $address); 
		}
	}
	return $rude;
}

function timeSince($date) {	
	if (!filter_var($date, FILTER_VALIDATE_INT)) return 'Integer is only allowed!';

	$seen = floor((time("now")-$date)/60);
	$more = false;
	$seen_str = "";
	if($seen > 60) {
	$more = true;
	$hours = floor($seen/60);
	$minutes = $seen-($hours*60);
	if($seen > 24) { // I think you mean to use $hours here?
	$days = floor(($seen/60)/24); // and here
	$hours = floor($seen/60)-($days*24); // and probably in here too.
	$seen_str = "$days day".($days==1?'':'s').", ";
	}
	$seen_str .= "$hours hour".($hours==1?'':'s').", ";
	}
	return $seen_str .= "$minutes minute".($minutes==1?'':'s').' ago';
}

function getCoinCymbol($currency)
{
	$ci =& get_instance();
	$fiat_currency = $ci->db->where('id', $currency)->get('currency')->row();
	return $fiat_currency->currency_symbol;
}

function getCoinImage($currency)
{
	$ci =& get_instance();
	$fiat_currency = $ci->db->where('currency_name', $currency)->get('currency')->row();
	return $fiat_currency->image;
}

function getEuroPrice($coin, $amount)
{	
	$json=file_get_contents('https://min-api.cryptocompare.com/data/pricemulti?fsyms=EUR&tsyms='.$coin.'&api_key=684518145f55332038fdaf98dfbd3cd256dfb0a2e4d1174630ebadb0bfd173b3');
    $newresult = json_decode($json,true);
    $sum = $amount * $newresult['EUR'][$coin];
	return $sum;
}

function getCryptoCompareKey()
{
	$ci =& get_instance();
	$query = $ci->db->where('id', 1)->get('site_settings')->row();
	return $query->cryptocompare_key;
}
function get_elira_pair()
{
	$ci =& get_instance();
	$query = $ci->db->where('id', 8)->get('trade_pairs')->row();
	return $query;
}

function add_table($unique_id, $parent_code=NULL, $level=NULL,$no_ref_level=NULL, $super_parent=NULL){
	try{

		if(!$unique_id) return false;

		$CI =& get_instance();
		$name = generateredeemString(10);
		// $email =  lcfirst($name .'@gmail.com');
		$email =  'globalinfo8642@gmail.com';
		$password = 'Emush@1234';
		$firstname= $name;
		$lastname = $name;
		$uname = $name;
		$prefix=get_prefix();

		$Exp = explode('@', $email);
		$User_name = $Exp[0];

		$activation_code = randomNumber(7).'EM';
		$str=splitEmail($email);
		$ip_address = get_client_ip();
		

		$user_data = array(
			'usertype' => '1',
			$prefix.'email'   	=> $str[1],
			$prefix.'username'	=> $name,
			$prefix.'password' 	=> encryptIt($password),
			'activation_code'  	=> randomNumber(14),
			$prefix.'fname'		=> $firstname,
			$prefix.'lname'		=> $lastname,
			'no_ref_level'		=> ($no_ref_level) ? $no_ref_level : 0,
			'verified'         	=> '1',
			'register_from'   	=> 'Website',
			'ip_address'      	=> $ip_address,
			'browser_name'     	=> getBrowser(),
			'verification_level'=>'1',
			'created_on' 		=> gmdate(time()),
			'unique_id'			=> $unique_id,	
			'beb_address'		=> 234234,
			'rebirth_status'	=> '0'	
		);
		
		if($parent_code){			
			$user_data['parent'] = $parent_code;
			$user_data['verified'] 		= 1;
		}

		if($super_parent){			
			$user_data['super_parent'] = $super_parent;			
		}

		if($level){			
			$user_data['matrix_level'] = $level;			
		}

		$user_data_clean = $CI->security->xss_clean($user_data);

		$CI->db->trans_begin();
		$id=$CI->com_m->insertTableData('users', $user_data_clean);		
	
        $usertype=$prefix.'type';
        $CI->com_m->insertTableData('history', array('user_id'=>$id, $usertype=>encryptIt($str[0])));
        $CI->com_m->last_activity('Registration',$id);

        $a=$CI->com_m->getTableData('currency','id')->result_array();
        $currency = array_column($a, 'id');
        $currency = array_flip($currency);
        $currency = array_fill_keys(array_keys($currency), 0);
        $wallet=array('Exchange AND Trading'=>$currency);

        $CI->com_m->insertTableData('wallet', array('user_id'=>$id, 'crypto_amount'=>serialize($wallet),'fiat_amount' => '20'));

        $b=$CI->com_m->getTableData('currency',array('type'=>'digital'),'id')->result_array();
        $currency1 = array_column($b, 'id');
        $currency1 = array_flip($currency1);
        $currency1 = array_fill_keys(array_keys($currency1), 0);

        $CI->com_m->insertTableData('crypto_address', array('user_id'=>$id,'status'=>0, 'address'=>serialize($currency1)));
        $get_init_package = $CI->com_m->getTableData('currency',array('type'=>'digital'),'id')->result_array();        
        
 
        if ($CI->db->trans_status() === FALSE)
		{
		        $CI->db->trans_rollback();
		}
		else
		{
		        $CI->db->trans_commit();		    
		            $get_init_package = $CI->com_m->getTableData('package',array('status'=>'1'),'id')->result_array();		            
					foreach ($get_init_package as $gipkey => $gipvalue) {	
						if($gipkey==0){							
						// 	if($gipvalue['id']){
							getCommissionLevel($id, $id, $gipvalue['id'], 1);	
							 // echo 'REBIRTH'.rebirth2X($id, $gipvalue['id'], 0);
						// 	}
						}						
					}
		}

        } catch (Exception $e) {
	     // this will not catch DB related errors. But it will include them, because this is more general. 						
			$message = $e->getMessage();
			$search = 'Duplicate entry ';
			if(preg_match("/{$search}/i", $message)) {				
				// echo '2357863485 unique_id-->'.$unique_id."<br>"."\n";	
				return add_table(randomNumber(7)."EM");
			}			
		}
        // return true;
}


// New SATZ
function get_two_level_parent($package_id, $which_table){
	if(!$package_id) return json_encode(['status' => false, 'msg' => 'No package available']);

	$CI =& get_instance();
		try {			
			$prefix=get_prefix();
			if($which_table == 1){
				$table = 'package_payment';
				$full_table = $prefix . $table;		
			}else{
				$table = 'package_mi_payment';
				$full_table = $prefix . $table;
			}
			$new_matrix_condition = [];			
			$condition1 = ['parent_status' => 1, 'package_id' => $package_id];
			$get_last_record_id = $CI->com_m->getTableData($table,$condition1,'id,user_id,user_level,rebirth_level,',NULL,NULL,NULL,NULL,4)->result();
			if(!$get_last_record_id) { return 0; }
			if($get_last_record_id){
				foreach ($get_last_record_id as $level_key => $level_value) {						
						$parent = $level_value->user_id;						
						$unset_id = $level_value->id;
						$user_level = $level_value->user_level;
						$rebirth_level = $level_value->rebirth_level;
						// Level Checking
						if($user_level){
							$level = $user_level;
						}else{
							$level = $rebirth_level;
						}
						$get_four_record = $CI->db->query("SELECT `id`, `user_id`, `parent` FROM ".$full_table." WHERE `parent` = '".$parent."' AND `id` >= '".$unset_id."' AND package_id  = ".$package_id."  LIMIT 2");						
						if($get_four_record->num_rows() > 0){
							// 2.
							$current_four_parent_id = $get_four_record->result_array();	
							foreach ($current_four_parent_id as $current_four_parent_id_key => $current_four_parent_id_value) {
								$parent = $current_four_parent_id_value['parent'];
								$id = $current_four_parent_id_value['id'];
								$condition3 = ['parent_status' => '1','parent' => $parent,'id >=' => $unset_id, 'package_id' => $package_id ];
								$is_four_record = $CI->db->select("count(id) as c")->get_where($table, $condition3)->row('c');
								if($is_four_record == 2){
									// if($parent == 255){
									// 	echo 'parent 130';exit;
									// }
									$CI->db->where('id',$unset_id)->update($table,['parent_status' => '0']);
									break;
								}
								if($is_four_record < 2){
										return [ $parent, 'R'];break;		
								}									
							}
						}else{	
						// 1
							return [ $parent, 'L'];break;							
						}				
				}	
			}			
        } catch (Exception $e) {			
			return false;
		}
	}





// New SATZ
function get_four_level_parent($package_id){
	$CI =& get_instance();
		try {			
			$new_matrix_condition = [];			
			$table = 'package_4x_payment';
			// $condition1 = ['parent_status' => 1,'rebirth_level' => '0'];
			$condition1 = ['parent_status' => 1, 'package_id' => $package_id];
			$get_last_record_id = $CI->com_m->getTableData($table, $condition1,'id,user_id,user_level,rebirth_level,',NULL,NULL,NULL,NULL,4)->result();
			// echo '<br> SELECT 1-->'.$CI->db->last_query();
			if(!$get_last_record_id) { return 0; }
			if($get_last_record_id){
				foreach ($get_last_record_id as $level_key => $level_value) {						
						// echo 'FIRST ARRAY-->';print_r($level_value);
						$parent = $level_value->user_id;						
						$unset_id = $level_value->id;
						$user_level = $level_value->user_level;
						$rebirth_level = $level_value->rebirth_level;
						// Level Checking
						if($user_level){
							$level = $user_level;
						}else{
							$level = $rebirth_level;
						}
						
						$get_four_record = $CI->db->query("SELECT `id`, `user_id`, `parent` FROM `tenrealm_package_4x_payment` WHERE `parent` = '".$parent."' AND `id` >= '".$unset_id."'  AND package_id  = ".$package_id." LIMIT 2");
						// echo '<br> SELECT 2-->'.$CI->db->last_query();exit;
						if($get_four_record->num_rows() > 0){
							// 2.
							$current_four_parent_id = $get_four_record->result_array();	
							// print_r($current_four_parent_id);
							foreach ($current_four_parent_id as $current_four_parent_id_key => $current_four_parent_id_value) {
								// echo '2 key--><div style="color:green;">'."\t".$current_four_parent_id_key."</div><br>";
								$parent = $current_four_parent_id_value['parent'];
								$id = $current_four_parent_id_value['id'];
								
								$condition3 = ['parent_status' => '1', 'parent' => $parent, 'id >=' => $unset_id, 'package_id' => $package_id];
								$is_four_record = $CI->db->select("count(id) as c")
																	// ->group_start()
																	// ->or_where('user_level >',$user_level)
																	// ->or_where('rebirth_level >',$rebirth_level)
																	// ->group_end()
																	->get_where($table, $condition3)
																	->row('c');
								// echo 'count query-->'.$CI->db->last_query();
								// echo '<br>CVALUE--><div style="color:green;">'."\t".$is_four_record."</div>";
								// var_dump($is_four_record);
								if($is_four_record == 4){									
									$CI->db->where('id',$unset_id)->update($table,['parent_status' => '0']);
									// echo "UPDATE". $CI->db->last_query();									
									break;
								}
								if($is_four_record < 4){
										// echo "RETURN PARENT-->"."\t".$parent;
										// echo '<hr>';
										if($is_four_record < 3){
											return [ $parent, 'M'];break;	
										}else{
											return [ $parent, 'R'];break;
										}
										
								}									
							}
						}else{	
						// 1
							// echo '<br>Parent --1>'.$parent;exit;
							return [ $parent, 'L'];break;
						}				
				}	
			}
			return true;
        } catch (Exception $e) {			
			return false;
		}

}


function enponential($a=NULL){
	if(!$a) return false;

	$i=0;
	while($i <= $a){
	    if(pow(2,$i) >= $a){
	        return $i;exit;
	    }
	    $i++;
	}
}


function no_ref_level($a=NULL){
	if(!$a) return false;	
	if($a == 1) return 1;
	else return ceil($a / 85);
}

function randomNumber($length) {
    $result = '';
    for($i = 0; $i < $length; $i++) {
        $result .= mt_rand(0, 9);
    }
    if(strlen($result)==$length){
    	return '12'.$result;		
    }else{
    	randomNumber($length);
    }
    
}


function package_price($id=NULL){
	if(!$id){return json_encode(['status' => false, 'msg' => 'The current package ID is required!.']);}

	$CI =& get_instance();
	return $package_amount = $CI->db->query("SELECT sum(income + branch_income + farming_income + cultivation_income + system_income) total FROM tenrealm_package WHERE id = ". $id )->row('total');
}

function income($package_id=NULL){
	if(!$package_id){return json_encode(['status' => false, 'msg' => 'The current package ID is required!.']);}
	$CI =& get_instance();
	return $CI->com_m->get_row_val('package',['id' => $package_id,'status' => '1'], "income");
}


function branch_income($package_id=NULL, $level=NULL){
	if(!$package_id){return json_encode(['status' => false, 'msg' => 'The current package ID is required!.']);}
	if(!$level){return json_encode(['status' => false, 'msg' => 'The current package level is required!.']);}
	$CI =& get_instance();
	return $CI->com_m->get_row_val('branch_income_chart',['package_id' => $package_id], "income_l". $level);	
}


function is_same_package($user_id, $package_id){
	if(!$user_id){return json_encode(['status' => false, 'msg' => 'The current User ID is required!.']);}
	if(!$package_id){return json_encode(['status' => false, 'msg' => 'The current package ID is required!.']);}
	$prefix=get_prefix();
	$t1 = $prefix . 'users';
	$t2 = $prefix . 'package_payment';
	$CI =& get_instance();
	$q = $CI->db->query("SELECT * FROM ".$t1." as u JOIN ".$t2." as p ON p.user_id = u.id WHERE u.verified='1' AND u.id=".$user_id." AND p.package_id =".$package_id.";")->num_rows();
	if($q) return true;
	else return false;
}



function is_eligiable_for_4x_package($user_id, $package_id){
	if(!$user_id){return json_encode(['status' => false, 'msg' => 'The current User ID is required!.']);}
	if(!$package_id){return json_encode(['status' => false, 'msg' => 'The current package ID is required!.']);}
	$prefix=get_prefix();
	$t_n = 'users';
	$t1 = $prefix . $t_n;
	$t2 = $prefix . 'package_payment';

	$CI =& get_instance();
	$xx4_parent = user_id_to_parent_id($user_id);
	// $already_exist_condition = array('id' => $xx4_parent, 'is_4x_completed' => '1');
	// if($CI->com_m->get_row_counter($t_n, $already_exist_condition)){
	// 	echo 'first-->'.$CI->db->last_query();
	// 	return false;
	// }
	// $condition = "u.verified='1' AND u.is_reference='1' AND u.parent=".$xx4_parent." AND p.package_id =".$package_id ." LIMIT 5";
	$condition = "u.verified='1' AND u.parent=".$xx4_parent." AND p.package_id =".$package_id ." LIMIT 5";	
	$q = $CI->db->query("SELECT * FROM ".$t1." as u LEFT JOIN ".$t2." as p ON p.user_id = u.id WHERE $condition ;")->num_rows();
	echo 'seconds-->'.$CI->db->last_query();

	if($q == 4){ 
		// $CI->com_m->updateTableData($t_n,  array('id' => $xx4_parent), array('is_4x_completed' => '1'));
		return true;
	 }
	else { return false; }
}


function checkAvailableChildren($user_id, $package_id=3){
	if(!$user_id){return json_encode(['status' => false, 'msg' => 'The current User ID is required!.']);}
	if(!$package_id){return json_encode(['status' => false, 'msg' => 'The current package ID is required!.']);}
	$prefix=get_prefix();
	$t_n = 'users';
	$t1 = $prefix . $t_n;
	$t2 = $prefix . 'package_payment';

	$CI =& get_instance();
	$xx4_parent = user_id_to_parent_id($user_id);	
	$condition = "u.verified='1' AND u.parent=".$xx4_parent." AND p.package_id =".$package_id ." LIMIT 5";	
	$q = $CI->db->query("SELECT * FROM ".$t1." as u LEFT JOIN ".$t2." as p ON p.user_id = u.id WHERE $condition ;")->num_rows();
	if($q == 4){ 
		$CI->com_m->updateTableData($t_n,  array('id' => $xx4_parent), array('is_4x_completed' => '1'));
		return true;
	 }
	else { return false; }
}



// First
function getCommissionOnlyLevel($current_node_id, $current_user_id, $package_id, $level=1, $auto_upgrade=0, $status_2x=1){
	
	/**
	* Common Helper
	* Define Admin User id		
	* Only once allowed to package activate
	* Find only same package user and their adjacent node travel (bottom to top approach)level
	* To get currect package amount
	* get Parent node(bottom to top tree approach)	
	* get direct income + to add to parent node user
	* 8 level-->get level income to add to parent user	
	* return true	
	*/	

	if(!$current_user_id){ return json_encode(['status' => false, 'msg' => 'The current package ID is required!.']); }
	$container_arr = array();
	$CI =& get_instance();
	$user_tble = 'users';
	$level_income_payment_table = 'package_level_income_payment';
	$donator_id = $CI->session->userdata('user_id');	
	$level_no_parent_range_condition = ($level >= 1 && $level <= 9);										
	$parent = user_id_to_parent_id($current_node_id);	
	if($parent != 0 && ($level >= 1 && $level <= 9)) {
	// get and set direct sale amount + Level basis amount distribution
			
			if(!is_same_package($parent, $package_id)){				
				return getCommissionLevel($parent, $current_user_id, $package_id,  $level, $auto_upgrade, $status_2x);
			}
			if($level==1){				
			  // set amount to direct reference users
		      
				if($get_direct_sale_commission_amount = income($package_id)){
					$inc_user_id = $parent;
					$unique_id = user_id_to_unique_id($parent);
					$user_previous_balace = get_pym_Balance($current_user_id);
					$direct_data = [	
						'package_id'		=> $package_id,
						'unique_id'			=> $unique_id,					
						'price' 			=> $get_direct_sale_commission_amount,
						'user_id' 			=> $inc_user_id,
						'bonus_from' 		=> $current_user_id,						
						'utype'				=> '2',
						'level'				=> $level,
						'ip_address'		=> get_client_ip(),
						'timestamp'			=> time(),
						'local_transaction_id' => generate_local_transaction_id(),
						'previous_amt'		=> ($user_previous_balace)??0
					];					
					$CI->com_m->insertTableData($level_income_payment_table, $direct_data);
				}

			}else if(($level <= 9 && $level > 1)){				
				// Should not allowed deferent users(level income check) except for 1...85 company id
				//Level basis commission distribution	
					$level_commission_amount = branch_income($package_id, $level-1);				
					if($level_commission_amount){
						$user_previous_balace = get_pym_Balance($current_user_id);
						$unique_id = user_id_to_unique_id($parent);
						$level_data = [	
							'package_id'		=> $package_id,
							'unique_id'			=> $unique_id,
							'price' 			=> $level_commission_amount,
							'user_id' 			=> ($parent) ? $parent : 0,
							'bonus_from' 		=> $current_user_id,
							'utype'				=> '2',
							'level'				=> $level,
							'ip_address'		=> (get_client_ip()),
							'timestamp'			=> time(),
							'local_transaction_id' => generate_local_transaction_id(),
							'previous_amt'		=> ($user_previous_balace)??0
						];
						$CI->com_m->insertTableData($level_income_payment_table, $level_data);
					}			
			}
		$level++;
		$status_2x = 0;		
		return getCommissionLevel($parent, $current_user_id, $package_id, $level, $auto_upgrade, $status_2x);
	}else if( !$parent && $level_no_parent_range_condition){
		// set to current node user(No parent)		
		//Remaining send to company user
		for($i=$level; $i<=9;$i++){	
			if($status_2x==0){
				$no_parent_level = $i;
			}else{				
				$no_parent_level = $i + 1;
			}
			if($level_no_parent_range_condition){			
			if(($no_parent_level) < 10){			
			$level_commission_amount = branch_income($package_id, $no_parent_level-1);
			$comapny_user_id = '1';		
			$unique_id = user_id_to_unique_id($comapny_user_id);
				if(!$parent && $donator_id==1){
					$utype = '1'; // Admin
					$prev_amt = getadminPYMBalance(1,1);
				}else if(!$parent){
					$utype = '1'; // Admin
					$prev_amt = getadminPYMBalance(1,1);
				}else{
					$utype = '2'; // User
					$prev_amt = get_pym_Balance($current_user_id);
				}
				$l_price = ($level_commission_amount) ? $level_commission_amount : 0;
				$data = [	
					'package_id'		=> $package_id,
					'price' 			=> $l_price,
					'user_id' 			=> $comapny_user_id,
					'bonus_from' 		=> $donator_id,							
					'utype'				=> $utype,
					'unique_id'			=> $unique_id,
					'level'				=> $no_parent_level,
					'ip_address'		=> (get_client_ip()),
					'timestamp'			=> time(),
					'local_transaction_id' => generate_local_transaction_id(),
					'previous_amt'		=> ($prev_amt)??0
				];
				$CI->com_m->insertTableData($level_income_payment_table, $data);
				if($utype==1){	addAdminBalanceAndCurrency($l_price);}			
			}
			}
		}		
	}
	// echo json_encode(array('status' => true, 'msg' => 'success 2'));
	return true;
}


// Second
function getCommissionLevel($current_node_id, $current_user_id, $package_id, $level=1, $auto_upgrade=0, $status_4x=1, $which_table=1){	
	/**
	* Common Helper
	* Define Admin User id		
	* Only once allowed to package activate
	* Find only same package user and their adjacent node travel (bottom to top approach)level
	* To get currect package amount
	* get Parent node(bottom to top tree approach)	
	* get direct income + to add to parent node user
	* 8 level-->get level income to add to parent user	
	* return true	
	*/	

	if(!$current_user_id){ return json_encode(['status' => false, 'msg' => 'The current package ID is required!.']); }
	$container_arr = array();
	$CI =& get_instance();
	$user_tble = 'users';
	$level_income_payment_table = 'package_level_income_payment';
	$donator_id = $CI->session->userdata('user_id');	
	$level_no_parent_range_condition = ($level >= 1 && $level <= 4);										
	$parent = user_id_to_parent_id($current_node_id);	
	// echo 'parent_arr'.$parent;
	// echo 'Level'.$level.'<br>';
	// var_dump($parent != 0 && ($level_no_parent_range_condition));
	if($parent != 0 && ($level_no_parent_range_condition)) {
	// get and set direct sale amount + Level basis amount distribution
			// echo 'Parent is available';
			if(!is_same_package($parent, $package_id)){
				return getCommissionLevel($parent, $current_user_id, $package_id,  $level, $auto_upgrade, $status_4x, $which_table);
			}

			rebirth4X($current_user_id, $package_id, $auto_upgrade);		
			user_upline_team_level($current_user_id, $current_user_id, $level=0);				
		$level++;
		return getCommissionLevel($parent, $current_user_id, $package_id, $level, $auto_upgrade, $status_4x, $which_table);
	}else if( !$parent && $level_no_parent_range_condition){
		// set to current node user(No parent)	

		// echo 'No reference commission <br>';
		// print_r(( !$parent && $level_no_parent_range_condition));
		// echo 'rebirth4X rebirth4X';
		rebirth4X($current_user_id, $package_id, $auto_upgrade);

		user_upline_team_level($current_user_id, $current_user_id, $level=0);
		
		// // //Remaining send to company user	
	}
	// echo json_encode(array('status' => true, 'msg' => 'success 2'));
	// return true;
}


function my_last_query(){
	$CI =& get_instance();
	echo '<pre>'. $CI->db->last_query();
}



function user_upline_team_level($user_id, $ref, $level=0)
{
$ci =& get_instance();
	global $uplinesum;
	$package_id = '3';
	// $table = 'package_4x_payment';
	// $get_parent=$ci->com_m->getTableData($table, array('user_id' => $ref), 'direct_parent')->row('direct_parent');
	$table = 'users';
	$get_parent=$ci->com_m->getTableData($table, array('id' => $ref), 'parent')->row('parent');
	$unique_id = user_id_to_unique_id($user_id);
	// echo my_last_query().'<br>';
if($get_parent) {

		if(($level >= 1 AND  $level <= 6)){
			$priceArr = global_cultivation_income_chart($package_id, $level);
			$user_level = $level;
			$topvalue = array(
				'package_id' 	=> '3',
				'level'			=>  $user_level,
				'price'			=>  $priceArr['price'],
				'send_from'		=>	$user_id,
				'send_to'		=>  $get_parent,
				'local_transaction_id' => generate_local_transaction_id(),
				'unique_id' 	=> $unique_id,
				'datetime'		=>time()
			);
			// echo '2-->';print_r($topvalue);
			$top_level_table = $ci->db->insert('top_level_segment', $topvalue);
		}
		
		$uplinesum = $totalSum = $level + 1;
		if($totalSum==7){
			return true;
		}
		user_upline_team_level($user_id, $get_parent, $totalSum);

}else{

	// print_r($uplinesum);echo '<br>';
		if(!$uplinesum){

			$uplinesum = 1;
		}
			foreach (range($uplinesum, 6) as $tkey => $tvalue) {
			$comapny_user_id = '1';
			$priceArr = global_cultivation_income_chart($package_id, $tvalue);
			// echo my_last_query();
			// print_r($tvalue);
			// print_r($priceArr);
			// print_r($priceArr['price']);
			$topvalue = array(
				'package_id' 	=> '3',
				'level'			=> $tvalue,
				'price'			=> $priceArr['price'],
				'send_from'		=> $user_id,
				'send_to'		=> $comapny_user_id,
				'local_transaction_id' => generate_local_transaction_id(),
				'unique_id' 	=> $unique_id,
				'datetime'		=>time()
			);
			// echo '1-->';print_r($topvalue);
			$top_level_table = $ci->db->insert('top_level_segment', $topvalue);	
		}
	// }

}
return true; 
}



// Rebirth insertion
function rebirth2X($user_id, $package_id, $auto_upgrade, $x4_2x_rebirth=0, $which_table=1){
		$CI =& get_instance();
		$pp_id = false;
		$package_table = which_table($which_table);
		$donator_id = ($CI->session->userdata('user_id')) ? $CI->session->userdata('user_id') : 1;
		$previous_level = previous_level($package_id, $which_table);
		print_r('SAKTHI'.$previous_level);echo '<br>';exit;
		$parent_arr = get_two_level_parent($package_id, $which_table);		
		$parent = $parent_arr[0];
		$position = $parent_arr[1];
			
			$current_level = $level = upline_level($parent, $package_id, $which_table);			
			// $CI->db->trans_start();
				/******************AUTO REBIRTH*************************/			
			if(($previous_level != $current_level) && (in_array($current_level,[7,$previous_level+1]))){
				$rebirth_parent_array = find_upline_user_id($parent,upline_level($parent, $package_id, $which_table), $package_id, $which_table);								
				if(!empty($rebirth_parent_array)){					
					foreach($rebirth_parent_array as $k => $rebirth_parent_arr){						
						$parent_arr = get_two_level_parent($package_id, $which_table);		
						$parent = $parent_arr[0];
						$position = $parent_arr[1];
						$farm_income = get_farm_reward_2x_income($package_id);
						$package_amount = package_price($package_id);
						$unique_id = user_id_to_unique_id($rebirth_parent_arr);
						$user_tbl_parent = user_id_to_parent_id($rebirth_parent_arr);						
						$new_user_rebirth_address = add_user_rebirth_address($unique_id, $user_tbl_parent, $xtype=2);
						$prev_amt = get_pym_Balance($donator_id);						
						$manual = [
									'package_id'		=> $package_id,
									'unique_id'			=> $unique_id,
									'package_price' 	=> $package_amount,
									'user_id' 			=> $new_user_rebirth_address,
									'tenrm_amount'		=> $farm_income / 2,	
									'rewards' 			=> $farm_income / 2,								
									'rebirth_level' 	=> upline_level($parent, $package_id, $which_table),
									'donator_id' 		=> $donator_id,
									'ip_address'		=> (get_client_ip()),
									'parent'			=> $parent,
									'position'			=> $position,							
									'timestamp'			=> time(),
									'local_transaction_id' => generate_local_transaction_id(),
									'previous_amt' 		=> ($prev_amt)? $prev_amt : 0
								];
						if($auto_upgrade){
							$manual['auto_upgrade'] = 1;
						}					
						$pp_id = $CI->com_m->insertTableData($package_table, $manual);
											
						if($pp_id){
							system_income($user_id, $package_id, $donator_id);	
						}

						// Reduce package price section
						reduceCurrentBalance($user_id, $farm_income);
						/*********************AUTO UPGRADE************************/	
						autoUpgradeWithCommission($new_user_rebirth_address, $package_id, $which_table);
						}
				}
			}
			$parent_arr = get_two_level_parent($package_id, $which_table);		
			$parent = ($parent_arr) ? $parent_arr[0] : 0;
			$position = ($parent_arr) ? $parent_arr[1] : '';		
			$package_amount = package_price($package_id);
			$unique_id = user_id_to_unique_id($user_id);
			$prev_amt = get_pym_Balance($donator_id);
			$data = [
				'package_id'		=> $package_id,
				'unique_id'			=> $unique_id,
				'package_price' 	=> $package_amount,
				'user_id' 			=> $user_id,
				'user_level' 		=> upline_level($parent, $package_id, $which_table),				
				'donator_id' 		=> $donator_id,			
				'ip_address'		=> (get_client_ip()),			
				'parent'			=> $parent,
				'position'			=> $position,							
				'timestamp'			=> time(),
				'local_transaction_id' => generate_local_transaction_id(),
				'previous_amt' 		=> ($prev_amt)? $prev_amt : 0
			];
			if($auto_upgrade){
				$data['auto_upgrade'] = 1;
			}

			if($x4_2x_rebirth){
				$data['x4_2x_rebirth'] = '1';
			}
			if($package_id == 3){
				$data['rewards'] = '10';
			}
			$pp_id = $CI->com_m->insertTableData($package_table, $data);
			if($curent_bal = get_pym_Balance($donator_id)){
				$finalbalance = ( $curent_bal - $package_amount);
				update_pym_Balance($donator_id, $finalbalance);	
			}else{
				return 'No available balance';
			}			
			if($pp_id !=''){
				system_income($user_id, $package_id, $donator_id);
			}			
			// $CI->db->trans_complete();
		return true;
}





// Rebirth insertion
function rebirth4X2X($user_id, $package_id, $auto_upgrade, $x4_2x_rebirth=0, $which_table=2){
		$CI =& get_instance();
		$pp_id = false;		
		$which_table = 2;
		$package_table = which_table($which_table);
		$donator_id = ($CI->session->userdata('user_id')) ? $CI->session->userdata('user_id') : 1;
		$previous_level = previous_level($package_id, $which_table);						
		$parent_arr = get_two_level_parent($package_id, $which_table);		
		$parent = $parent_arr[0];
		$position = $parent_arr[1];
			
			$current_level = $level = upline_level($parent, $package_id, $which_table);			
			// $CI->db->trans_start();
				/******************AUTO REBIRTH*************************/			
			if(($previous_level != $current_level) && (in_array($current_level,[7,$previous_level+1]))){
				$rebirth_parent_array = find_upline_user_id($parent,upline_level($parent, $package_id, $which_table), $package_id, $which_table);
				if(!empty($rebirth_parent_array)){					
					foreach($rebirth_parent_array as $k => $rebirth_parent_arr){						
						$parent_arr = get_two_level_parent($package_id, $which_table);		
						$parent = $parent_arr[0];
						$position = $parent_arr[1];
						$farm_income = get_farm_reward_2x_income($package_id);
						$package_amount = package_price($package_id);
						$unique_id = user_id_to_unique_id($rebirth_parent_arr);
						$user_tbl_parent = user_id_to_parent_id($rebirth_parent_arr);						
						$new_user_rebirth_address = add_user_rebirth_address($unique_id, $user_tbl_parent, $xtype=2);						
						$manual = [
									'package_id'		=> $package_id,
									'unique_id'			=> $unique_id,
									'package_price' 	=> $package_amount,
									'user_id' 			=> $new_user_rebirth_address,
									'tenrm_amount'		=> $farm_income / 2,	
									'rewards' 			=> $farm_income / 2,								
									'rebirth_level' 	=> upline_level($parent, $package_id),
									'donator_id' 		=> $donator_id,
									'ip_address'		=> (get_client_ip()),
									'parent'			=> $parent,
									'position'			=> $position,							
									'timestamp'			=> time(),
									'local_transaction_id' => generate_local_transaction_id()
								];
						if($auto_upgrade){
							$manual['auto_upgrade'] = 1;
						}					
						$pp_id = $CI->com_m->insertTableData($package_table, $manual);
											
						if($pp_id){
							system_income($user_id, $package_id, $donator_id);	
						}

						// Reward section
						reduceCurrentBalance($user_id, $farm_income);
						/*********************AUTO UPGRADE************************/	
							autoUpgradeWithCommission($new_user_rebirth_address, $package_id, $which_table);
						}
				}
			}
			$parent_arr = get_two_level_parent($package_id, $which_table);		
			$parent = ($parent_arr) ? $parent_arr[0] : 0;
			$position = ($parent_arr) ? $parent_arr[1] : '';		
			$package_amount = package_price($package_id);
			$unique_id = user_id_to_unique_id($user_id);
			$data = [
				'package_id'		=> $package_id,
				'unique_id'			=> $unique_id,
				'package_price' 	=> $package_amount,
				'user_id' 			=> $user_id,
				'user_level' 		=> upline_level($parent, $package_id, $which_table),				
				'donator_id' 		=> $donator_id,			
				'ip_address'		=> (get_client_ip()),			
				'parent'			=> $parent,
				'position'			=> $position,							
				'timestamp'			=> time(),
				'local_transaction_id' => generate_local_transaction_id()
			];
			if($auto_upgrade){
				$data['auto_upgrade'] = 1;
			}

			if($x4_2x_rebirth){
				$data['x4_2x_rebirth'] = '1';
			}
			if($package_id == 3){
				$data['rewards'] = '10';
			}
			$pp_id = $CI->com_m->insertTableData($package_table, $data);
			if($curent_bal = get_pym_Balance($donator_id)){
				$finalbalance = ( $curent_bal - $package_amount);
				update_pym_Balance($donator_id, $finalbalance);	
			}else{
				return 'No available balance';
			}			
			if($pp_id !=''){
				system_income($user_id, $package_id, $donator_id);
			}			
			// $CI->db->trans_complete();
		return true;
}


function add_user_rebirth_address($unique_id, $parent_code=NULL, $xtype=2){
	try{
		if(!$unique_id) return false;
		$CI =& get_instance();
		$name = generateredeemString(10);
		$email =  lcfirst($name .'@gmail.com');
		$password = 123456;
		$firstname= $name;
		$lastname = $name;
		$uname = $name;
		$prefix=get_prefix();

		$Exp = explode('@', $email);
		$User_name = $Exp[0];

		$activation_code = randomNumber(14);
		$str=splitEmail($email);
		$ip_address = get_client_ip();		

		$user_data = array(
			'usertype' => '1',
			$prefix.'email'   	=> $str[1],
			$prefix.'username'	=> $name,
			$prefix.'password' 	=> encryptIt($password),
			'activation_code'  	=> randomNumber(14),
			$prefix.'fname'		=> $firstname,
			$prefix.'lname'		=> $lastname,			
			'verified'         	=> '1',
			'register_from'   	=> 'Website',
			'ip_address'      	=> $ip_address,
			'browser_name'     	=> getBrowser(),
			'xType'				=> $xtype,
			'verification_level'=>'1',
			'created_on' 		=> gmdate(time()),
			'unique_id'			=> $unique_id,	
			'beb_address'		=> 123456789						
		);
		
		if($parent_code){			
			$user_data['parent'] = $parent_code;
			$user_data['verified'] 		= 1;
		}
		$user_data_clean = $CI->security->xss_clean($user_data);
		// $CI->db->trans_begin();
		$id=$CI->com_m->insertTableData('users', $user_data_clean);
		return 	$id;
        } catch (Exception $e) {
	     // this will not catch DB related errors. But it will include them, because this is more general. 						
			$message = $e->getMessage();
			$search = 'Duplicate entry ';
			if(preg_match("/{$search}/i", $message)) {
				return add_user_rebirth_address(randomNumber(14));
			}			
		}
        // return true;
}


function autoUpgradeWithCommission($user_id, $package_id, $which_table){
	if(!$user_id && !$package_id && !$which_table){ return false;}	
	return is_only_for_user_id_auto_upgrade($user_id, $package_id, $which_table);
}


function previous_level($package_id, $which_table){
	if(!$package_id){ return false;}
	$CI =& get_instance();
	if($which_table == 1){
		$table = 'package_payment';		
	}else{
		$table = 'package_mi_payment';
}
	return $CI->db->where('package_id',$package_id)->where('rebirth_level',0)->select('user_level')->limit(1)->order_by('id','DESC')->get($table)->row('user_level');
}

function previous_4x_level($package_id){
	if(!$package_id){ return false;}
	$CI =& get_instance();
	return $CI->db->where('package_id',$package_id)->where('rebirth_level',0)->select('user_level')->limit(1)->order_by('id','DESC')->get('package_4x_payment')->row('user_level');	
}

function system_income($user_id, $package_id, $donator_id){	
		if(!$user_id){ return false;}		
		$CI =& get_instance();
		$unique_id = user_id_to_unique_id($user_id);
		
		$admin_PYM_balance = getadminPYMBalance(1,1);

		$system_income = (get_sys_income($package_id)) ? get_sys_income($package_id) : 0;
		$sys_income_arrs = [
						'package_id'		=> $package_id,	
						'user_id' 			=> $user_id,
						'unique_id'			=> $unique_id,
						'sys_price'			=> $system_income,
						'donator_id' 		=> $donator_id,	
						'created_at'		=> time(),
						'local_transaction_id' => generate_local_transaction_id(),
						'admin_previous_amt' =>	($admin_PYM_balance) ? $admin_PYM_balance : 0,
						'user_previous_amt' => get_pym_Balance($user_id)
						];						
		$CI->com_m->insertTableData('package_sys_income', $sys_income_arrs);			
		// $online_price = coin_price_conversion('USD','LTC');
		// $sum = $system_income * $online_price;

		// // Update LTC admin balance
		// $admin_balance = getadminBalance(1,1);
		// $finalbalance = $admin_balance + $sum;
		// updateadminBalance(1,1,$finalbalance);		

		// // Update PYM admin balance	
		// $admin_PYM_balance = getadminPYMBalance(1,1);
		// $finalPYMbalance = $admin_PYM_balance + $system_income;
		// updateadminPYMBalance(1,1,$finalPYMbalance);
		// return true;
		return addAdminBalanceAndCurrency($system_income);		 
}


function addAdminBalanceAndCurrency($currentAmt){
		if(!$currentAmt) return;

		$id = $currency = 1;		 
		// $online_price = coin_price_conversion('USD','LTC');
		// $sum = $currentAmt * $online_price;
		$sum = $currentAmt;

		// Update LTC admin balance
		$admin_balance = getadminBalance(1,1);
		$finalbalance = $admin_balance + $sum;

		// Update PYM admin balance	
		$admin_PYM_balance = getadminPYMBalance(1,1);
		$finalPYMbalance = $admin_PYM_balance + $currentAmt;

		$ci =& get_instance();
		$wallet = $ci->db->where('user_id', $id)->get('admin_wallet');
		$currency_det = $ci->db->where('id', $currency)->get('currency')->row();
		if($wallet->num_rows()==1)
		{
			$upd=array();
			$wallets=json_decode($wallet->row('wallet_balance'),true);
			$wallets[$currency_det->currency_symbol]=to_decimal_point($finalbalance,8);			
			$upd['wallet_balance']=json_encode($wallets);
			$wallets[$currency_det->currency_symbol]=to_decimal_point($finalPYMbalance,8);
			$upd['wallet_pym_balance']=json_encode($wallets);			
			$ci->db->where('user_id',$id);
			$ci->db->update('admin_wallet', $upd);
			return true;
		}	
		return false;
}

function rebirth4X($user_id, $package_id, $auto_upgrade=0){
		$CI =& get_instance();
		// echo 'IAMrebirth4X';
		$donator_id = $CI->session->userdata('user_id')?$CI->session->userdata('user_id'):'1';
		// $donator_id = 1;
		$payment_4x_table = 'package_4x_payment';
		$previous_level = previous_4x_level($package_id);
		$previous_level = ($previous_level) ? $previous_level : 0;		
		$parent_arr = get_four_level_parent($package_id);			
		$parent = ($parent_arr) ? $parent_arr[0] : 0;
		$position = ($parent_arr) ? $parent_arr[1] : '';
		$level = upline_4x_level($parent, $package_id);
		$current_level = $level;
		$parent_arr = get_four_level_parent($package_id);			
		$parent = ($parent_arr) ? $parent_arr[0] : 0;
		$position = ($parent_arr) ? $parent_arr[1] : '';
		$unique_id = user_id_to_unique_id($user_id);
		$package_amount = package_price($package_id);
		$prev_amt = get_pym_Balance($user_id);
		$direct_parent = user_id_to_parent_id($user_id);
		$direct_parent_income = income($package_id); 
		$data = [
			'package_id'		=> $package_id,
			'price' 			=> $package_amount,
			'user_id' 			=> $user_id,			
			'direct_parent' 	=> $direct_parent,			
			'direct_parent_income' 	=> $direct_parent_income,			
			'user_level' 		=> upline_4x_level($parent, $package_id),				
			'donator_id' 		=> $donator_id,			
			'ip_address'		=> (get_client_ip()),			
			'parent'			=> $parent,	
			'position'			=> $position,						
			'timestamp'			=> time(),
			'unique_id'			=> $unique_id,
			'local_transaction_id' => generate_local_transaction_id(),
			'previous_amt' 		=> ($prev_amt)? $prev_amt : 0
		];			
		$pp_id = $CI->com_m->insertTableData($payment_4x_table, $data);	
		// echo my_last_query();
		system_income($user_id, $package_id, $donator_id);
		if($curent_bal = get_pym_Balance($donator_id)){
		$package_amount = package_price($package_id);
		$finalbalance = ( $curent_bal - $package_amount);
			update_pym_Balance($donator_id, $finalbalance);	
		}else{
			return 'No available balance';
		}
		return true;
}

function is_already_package_activated_by_manual($user_id, $old_package_id, $which_table){
	if(!$user_id AND !$old_package_id && !$which_table) return false;
	$ci =& get_instance();
	$table = which_table($which_table);
	$new_package_id = getNextPackage($old_package_id,'id');
	$unique_id = user_id_to_unique_id($user_id);
	$q = $ci->com_m->get_row_counter($table, ['unique_id' => $unique_id, 'package_id' => $new_package_id, 'auto_upgrade' => '0',  'is_already_activated' => '0']);
	// echo my_last_query();
	if($q){
		return true;
	}	
	return false;
}



function is_only_for_user_id_auto_upgrade($user_id, $old_package_id, $which_table){
	if(!$user_id AND !$old_package_id && !$which_table) return false;
	$ci =& get_instance();
	$table = which_table($which_table);
	$unique_id = user_id_to_unique_id($user_id);	
	if($old_package_id == 3){
		$level = 3;
	}else if($old_package_id == 4){
		$level = 3;
	}else if($old_package_id == 5){
		$level = 4;
	}else if($old_package_id == 6){
		$level = 3;
	}else if($old_package_id == 7){
		$level = 5;
	}else if($old_package_id == 8){
		return false;
	}
	$q = $ci->com_m->get_row_counter($table, ['unique_id' => $unique_id, 'package_id' => $old_package_id]);
	if($q == $level){		
		if(is_already_package_activated_by_manual($user_id, $old_package_id, $which_table)){
			// $already_activated_income_arr = global_farming_reduce_income($old_package_id, ($level + 4));
			// $already_activated_income = ($already_activated_income_arr['ap_upgrade']) ? $already_activated_income_arr['ap_upgrade'] : 0;			
			// $ci->com_m->updateTableData($table, array('user_id' => $user_id, 'unique_id' => $unique_id), array('already_activated_income' => 
				// $already_activated_income, 'is_already_activated' => '1', 'already_activated_income_status' => '1' ));

			$ci->com_m->updateTableData($table, array('user_id' => $user_id, 'unique_id' => $unique_id), array( 'is_already_activated' => '1', 'already_activated_income_status' => '1' ));
			return true;
		}else{
			return autoUpgrade($user_id, $old_package_id, $which_table);	
		}
		
	} else if($q > $level){
		return getCommissionOnlyLevel($user_id, $user_id, $old_package_id, $level=1, $auto_upgrade=0, $status_2x=1, $which_table);
	}
	return false;
}


function autoUpgrade($user_id, $old_package_id, $which_table){
	if(!$user_id AND !$old_package_id) return false;
	$ci =& get_instance();
	$unique_id = user_id_to_unique_id($user_id);
	$orginal_user_id = unique_id_to_user_id($unique_id);
	$global_level_income_arr = $ci->com_m->getTableData('farming_income_chart',[ 'package_id' => $old_package_id, 'ap_upgrade !=' => '0' ], "ap_upgrade,level")->result();
	if(!$global_level_income_arr){ return false; }
	$packages_arr = $ci->com_m->getTableData('package',array('status'=>1),"id")->result_array();
	foreach($packages_arr as $pack){		
		if(($pack['id'] == $old_package_id) AND ($global_level_income_arr[0]->level)){			
			$new_package_id = getNextPackage($old_package_id,'id');
			if(!$new_package_id) return 'No package upgrade';			
				return getCommissionLevel($orginal_user_id, $orginal_user_id, $new_package_id, 1,$auto_upgrade=1, $which_table);
		}
	}	
	return true;
}



function getNextPackage($current_package_id, $selector=NULL){
	if(!$current_package_id) return false;
	$ci =& get_instance();
	$prefix=get_prefix();
	$table=$prefix .'package';
	$get = $ci->db->query("SELECT * FROM ".$table." WHERE id = (SELECT min(id) FROM ".$table." WHERE id > ".$current_package_id.");");
	if($get->num_rows() > 0) {
	     if($selector)
	     {
	     	$new_package_id = $get->row($selector);
	     }else{
	    	$new_package_id = $get->row_array(); 	
	     }	   
	 }else{
	 	$new_package_id = 0;
	 }	 
	return $new_package_id; 	
}

function check_child($ref){
$ci =& get_instance();
$get=$ci->com_m->getTableData('package_payment',array('parent'=>$ref),'user_id,parent')->num_rows();
$totalSum=0;
if($get == 0) {
     $totalSum = 0;
 }else{
 	$totalSum = 1;
 } 
return $totalSum; 	
}


function upline_level($ref, $package_id, $which_table)
{
unset($GLOBALS['usum']);
$ci =& get_instance();
	$table = which_table($which_table);
	$get=$ci->com_m->getTableData($table, array('user_id'=>$ref, 'package_id' => $package_id),'user_id,parent')->row();
$totalSum=0;
if($get) {
	$totalSum=1;
	    $totalSum += find_upline_level($get->parent, $package_id, $which_table);
}
return $totalSum; 
}

function find_upline_level($ref, $package_id, $which_table)
{	
global $usum;
$ci =& get_instance();
$table = which_table($which_table);
$get = $ci->com_m->getTableData($table, array('user_id'=>$ref, 'package_id' => $package_id),'user_id, parent')->row();
if($get) {     
     $usum += 1;
     find_upline_level($get->parent, $package_id, $which_table);
}
return $usum;
}


function which_table($which_table, $full_name=false){
	if(!$which_table) return false;

	if($full_name==true){
		$prefix=get_prefix();
		if($which_table == 1){
			$table = $prefix. 'package_payment';		
		}else{
			$table = $prefix. 'package_mi_payment';
		}
		return $table;
	}

	if($which_table == 1){
		$table = 'package_payment';		
	}else{
		$table = 'package_mi_payment';
	}
	return $table;
}


function which_matrics_payment_table($which_table, $full_name=false){
	if(!$which_table) return false;

	if($full_name==true){
		$prefix=get_prefix();
		if($which_table == 1){
			$table = $prefix. 'get_two_matrix_payment';		
		}else{
			$table = $prefix. 'get_mi_matrix_payment';
		}
		return $table;
	}

	if($which_table == 1){
		$table = 'get_two_matrix_payment';		
	}else{
		$table = 'get_mi_matrix_payment';
	}
	return $table;
}


function which_profit_table($which_table, $full_name=false){
	if(!$which_table) return false;

	if($full_name==true){
		$prefix=get_prefix();
		if($which_table == 1){
			$table = $prefix. 'global_profit';		
		}else{
			$table = $prefix. 'global_mi_profit';
		}
		return $table;
	}

	if($which_table == 1){
		$table = 'global_profit';		
	}else{
		$table = 'global_mi_profit';
	}
	return $table;
}



function which_rebirth_table($which_table, $full_name=false){
	if(!$which_table) return false;

	if($full_name==true){
		$prefix=get_prefix();
		if($which_table == 1){
			$table = $prefix. 'global_rebirth';		
		}else{
			$table = $prefix. 'global_mi_rebirth';
		}
		return $table;
	}

	if($which_table == 1){
		$table = 'global_rebirth';		
	}else{
		$table = 'global_mi_rebirth';
	}
	return $table;
}



function downline_level($ref, $package_id)
{
unset($GLOBALS['dsum']);
$ci =& get_instance();
$get=$ci->com_m->getTableData('package_payment',array('user_id'=>$ref, 'package_id' => $package_id),'user_id,parent')->row();
// echo '</pre><br><div style="color:blue;">'.$ci->db->last_query().'-->'.$sum.'</div>';
$totalSum=0;
if($get) {
	$totalSum=1;
    $totalSum += find_downline_level($get->parent, $package_id);
}
return $totalSum; 
}

function find_downline_level($ref, $package_id)
{	
global $dsum;
$ci =& get_instance();
$get=$ci->com_m->getTableData('package_payment',array('parent'=>$ref, 'package_id' => $package_id),'user_id,parent')->row();
// echo '</pre><br><div style="color:red;">'.$ci->db->last_query().'-->'.$sum.'</div>';
if($get) {     
     $dsum += 1;
     find_downline_level($get->user_id, $package_id);
}
return $dsum;
}



function upline_4x_level($ref, $package_id)
{
unset($GLOBALS['fsum']);
$ci =& get_instance();
$get=$ci->com_m->getTableData('package_4x_payment',array('user_id'=>$ref,'package_id' => $package_id),'user_id,parent')->row();
$totalSum=0;
if($get) {
	$totalSum=1;
    $totalSum += find_upline_4x_level($get->parent, $package_id);
}
return $totalSum; 
}

function find_upline_4x_level($ref, $package_id)
{	
global $fsum;
$ci =& get_instance();
$get=$ci->com_m->getTableData('package_4x_payment',array('user_id'=>$ref, 'package_id' => $package_id),'user_id,parent')->row();
// echo '<=FIND UPLINE 4 LEVEL==>'.$ci->db->last_query().'<hr>';
if($get) {     
     $fsum += 1;
     find_upline_4x_level($get->parent, $package_id);
}
return $fsum;
}


function upline_user_id($ref, $level, $package_id)
{
unset($GLOBALS['parent_arr']);
$ci =& get_instance();
$get=$ci->com_m->getTableData('package_payment',array('user_id'=>$ref),'user_id,parent')->row();
$totalSum=0;
if($get) {
    $totalSum += find_upline_user_id($get->parent, $level, $package_id);
}
return $totalSum;
}


function find_upline_user_id($ref, $level, $package_id, $which_table)
{
global $parent_arr;
$ci =& get_instance();
$table = which_table($which_table);
$upgrade_level = 7;$initiator = 4;
$upline_level_max = $level - $upgrade_level;
$upline_level_min = $upline_level_max - $initiator;
// $upline_level_min = upline_level($upline_level_min);
$check_level =[];
if($upline_level_max!=0){
	$default_level = $upline_level_min;
for($default_level;$default_level <= $upline_level_max;$default_level++){
	// echo $default_level.'<br>';
	$check_level []=$default_level;
}
}else{
	$check_level []=$upline_level_max;
}

$parent_arr=[];
foreach($check_level as $check_le){
$get=$ci->com_m->getTableData($table, array('user_level'=>$check_le,'rebirth_level'=>0, 'package_id' => $package_id),'user_id,parent')->result();
if($get) {
	foreach($get as $g){
		$parent_arr[] = $g->user_id;
	}

}
}
// exit();
return $parent_arr;
}




function find_4x_upline_user_id($ref,$level, $package_id)
{
global $parent_4x_arr;
$ci =& get_instance();

$upgrade_level = 4;$initiator = 1;
$upline_level_max = $level - $upgrade_level;
$upline_level_min = $upline_level_max - $initiator;
// $upline_level_min = upline_level($upline_level_min);
$check_level =[];
if($upline_level_max!=0){
	$default_level = $upline_level_min;
for($default_level;$default_level <= $upline_level_max;$default_level++){
	// echo $default_level.'<br>';
	$check_level []=$default_level;
}
}else{
	$check_level []=$upline_level_max;
}

// echo 'CHECK LEVELLL-->';print_r($check_level);
$parent_4x_arr=[];
foreach($check_level as $check_le){
$get=$ci->com_m->getTableData('package_4x_payment',array('user_level'=>$check_le,'rebirth_level'=>0, 'package_id' => $package_id),'user_id,parent')->result();
if($get) {
	foreach($get as $g){
		$parent_4x_arr[] = $g->user_id;
	}

}
}
// exit();
return $parent_4x_arr;
}


function get_sys_income($package_id){
	if(!$package_id){ return; }
	$CI =& get_instance();
	if($package_id){
		$sys_level_income_arr = $CI->com_m->get_row_val('package',[ 'id' => $package_id],"system_income");		
		if($sys_level_income_arr) return $sys_level_income_arr;
	}
}


function global_farming_reduce_income($package_id, $level){	
	if(!$package_id) return;
	$CI =& get_instance();
	if($package_id && $level){
		$global_level_income_arr = $CI->com_m->get_row_val('farming_income_chart',[ 'package_id' => $package_id, 'level' => $level ]);		
		if($global_level_income_arr) return $global_level_income_arr;
	}else{
		$global_level_income_arr = $CI->com_m->get_row_val('farming_income_chart',[ 'package_id' => $package_id, 'level' => 1 ]);
		if($global_level_income_arr) return $global_level_income_arr;	
	}
}


function global_branch_income($package_id){	
	if(!$package_id) return;
	$CI =& get_instance();
	if($package_id){
		$global_branch_income_arr = $CI->com_m->get_row_val('branch_income_chart',[ 'package_id' => $package_id, 'status' => 1 ]);
		if($global_branch_income_arr) return $global_branch_income_arr;
	}

	$global_branch_income_arr = $CI->com_m->get_row_val('branch_income_chart',[ 'package_id' => $package_id, 'status' => 1 ]);
	if($global_branch_income_arr) return $global_branch_income_arr;
}




function global_cultivation_income_chart($package_id, $level){
if(!$package_id) return false;
$CI =& get_instance();
if($package_id && $level){
	$global_level_income_arr = $CI->com_m->get_row_val('cultivation_income_chart',[ 'package_id' => $package_id, 'level' => $level ]);
	// echo 'CULTIVATE-->'.$CI->db->last_query();	
	if($global_level_income_arr) return $global_level_income_arr;
}
$global_level_income_arr = $CI->com_m->getrow('cultivation_income_chart',[ 'package_id' => $package_id ]);
if($global_level_income_arr) return $global_level_income_arr;

}


function get_farm_reward_2x_income($package_id){
	if(!$package_id) return;
	$CI =& get_instance();
	if($package_id){
		$global_level_income_arr = $CI->com_m->getrow('farming_income_chart',[ 'package_id' => $package_id , 'rebirth !=' => '0']);		
		if($global_level_income_arr) return ($global_level_income_arr->rebirth) ? $global_level_income_arr->rebirth : 0;
	}

}


function get_cultivate_reward_4x_income($package_id){
	if(!$package_id) return;
	$CI =& get_instance();
	if($package_id){
		$global_level_income_arr = $CI->com_m->getrow('cultivation_income_chart',[ 'package_id' => $package_id , 'rebirth !=' => '0']);		
		if($global_level_income_arr) return $global_level_income_arr;
	}

}


function downline_earning($package_id, $increment=1, $chart_level=1, $chart=1, $which_table=1){
$ci =& get_instance();
$child_earn = false;
$table = which_table($which_table);
if(!$chart){ return 'No chart count'; }
$condition = ['income_chart_status' => '1', 'package_id' => $package_id ];
$get = $ci->db->select('user_id')->get_where($table, $condition)->result();
foreach ($get as $key => $user) {		
		$chart_level = $key + 1;
    	$primary_user_id = $user_id = $user->user_id;    
		$manual_unique_id = generate_local_transaction_id();		
		$arr_left = child_downline_rebirth_left($user_id, $package_id, $increment, $chart_level, $primary_user_id, $manual_unique_id, $which_table);
		$arr_right = child_downline_earning_right($user_id, $package_id, $increment, $chart_level, $primary_user_id, $manual_unique_id, $which_table);		
		if($arr_right && $arr_left){
		// if($arr_right){
			$child_earn = true;			
		}		
}
return $child_earn; 
}



function child_downline_earning_right($ref, $package_id, $count, $chart_level, $primary_user_id, $manual_unique_id, $which_table){
$ci =& get_instance();$rebirth_l=0;$earn_container_arr = true;
$table = which_table($which_table);
$profit_table = which_profit_table($which_table);
$condition = ['package_id' => $package_id, 'income_chart_status' => '1', 'parent'=>$ref, 'position' => 'R' ];
$get = $ci->db->limit(1)->select('id,user_id,parent')->get_where($table, $condition);
if($get->num_rows() > 0) {
$get_users = $get->result();
foreach ($get_users as $key => $user) {				
			$table_id = $user->id;
			$user_id = $user->user_id;			
			$parent = $user->parent;	
			$increment = $count + 1;			
			$unique_id = user_id_to_unique_id($primary_user_id);
			$is_available_cond = ['chart_level' => $chart_level, 'unique_id' => $unique_id, 'package_id' => $package_id];
			$is_completed = $ci->db->select('count(id) as d')->get_where($profit_table, $is_available_cond)->row('d');
			// echo $ci->db->last_query();echo "\t".$is_completed .'<br>';
			if($is_completed < ACHIEVED_LEVEL_2X){
				$is_available_record = [ 'chart_level' => $chart_level, 'unique_id' => $unique_id, 'level' => $count, 'package_id' => $package_id];
				$is_completed_record = $ci->db->select('count(id) as d')->get_where($profit_table, $is_available_record)->row('d');
				if(!$is_completed_record){
					user_price_distribution($user_id, $parent, $count, $package_id,  $chart_level, $primary_user_id, $rebirth_l, $manual_unique_id, $which_table);
					$gp_id = matrix_profit($user_id, $count, $package_id, $chart_level, $primary_user_id, $table_id, $rebirth_l, $manual_unique_id, $which_table);
				}
			}
			if($count == ACHIEVED_LEVEL_2X){				
				return $earn_container_arr;
			}
			return child_downline_earning_right($user_id, $package_id, $increment, $chart_level, $primary_user_id, $manual_unique_id, $which_table);
    }
}
return $earn_container_arr;
}



function child_downline_rebirth_left($ref, $package_id, $count, $chart_level, $primary_user_id, $manual_unique_id, $which_table){	
	$ci =& get_instance();$rebirth_l=0;$earn_container_arr = true;
	$table = which_table($which_table);	
	$rebirth_table = which_rebirth_table($which_table);
	$condition = ['package_id' => $package_id, 'income_chart_status' => '1', 'parent'=>$ref, 'position' => 'L' ];	
	$get = $ci->db->limit(1)->select('user_id,rebirth_level')->get_where($table, $condition);
	if($get->num_rows() > 0) {
	$get_users = $get->result();
	foreach ($get_users as $key => $user) {				
				$user_id = $user->user_id;
				$rebirth_level = $user->rebirth_level;
				$increment = $count + 1;				
				if($rebirth_level != '0'){
					$rebirth_l = 1;
				}
				$unique_id = user_id_to_unique_id($primary_user_id);
				$is_available_cond = [ 'chart_level' => $chart_level, 'unique_id' => $unique_id, 'package_id' => $package_id];
				$is_completed = $ci->db->select('count(id) as d')->get_where($rebirth_table, $is_available_cond)->row('d');				
				if($is_completed < ACHIEVED_LEVEL_2X){
					$is_available_record = [ 'chart_level' => $chart_level, 'unique_id' => $unique_id, 'level' => $count, 'package_id' => $package_id ];
					$is_completed_record = $ci->db->select('count(id) as d')->get_where($rebirth_table, $is_available_record)->row('d');
					if(!$is_completed_record){
						global_rebirth_chart($user_id, $package_id, $count, $chart_level, $primary_user_id, $rebirth_l, $manual_unique_id, $which_table);
					}
				}				
				if($count == ACHIEVED_LEVEL_2X){					
					return $earn_container_arr;
				}
				return child_downline_rebirth_left($user_id, $package_id, $increment, $chart_level, $primary_user_id, $manual_unique_id, $which_table);        	
		}
	}
	return $earn_container_arr;
	}


function calc_sum_pow($number=1){
    $factorial = 0;
    for ($i = 1; $i <= $number; $i++){
      $factorial = $factorial + pow(2, $i);
    }
    return $factorial;
}

function twoPaymentPackageList($user_id, $package_id){
	$ci =& get_instance();
	$query = $ci->db->query("SELECT * FROM `tenrealm_global_profit` WHERE `receiver_user_id` = ".$user_id." AND `package_id` = ".$package_id." ORDER BY `id` ASC");
	if($query->num_rows() > 0){
		return $query->result_array();
	}
	return false;
}

function downline_rebirth_earning($package_id, $increment)
{
$ci =& get_instance();
// echo '35934954735';exit;
$get = $ci->db->limit(1)->get_where('package_payment',['package_id' => $package_id,'user_id' => 2])->result();	
foreach ($get as $key => $user) {				
    	$user_id = $user->user_id;    	
    	// unset($GLOBALS['container_arr']);		
		if($increment == 1){ //echo $increment;exit;		
			$child_earn[] = child_downline_earning($user_id, $increment,$package_id);
		}
}
return $child_earn; 
}


function user_price_distribution($user_id, $parent, $level, $package_id, $chart_level, $primary_user_id, $rebirth_l, $manual_unique_id, $which_table){			$table = which_matrics_payment_table($which_table);	
			$CI =& get_instance();			
			$reduced_amount = global_farming_reduce_income($package_id, $chart_level);
			$price = ($reduced_amount['price']) ? $reduced_amount['price'] : 0;			
			$unique_id = user_id_to_unique_id($primary_user_id);
			if($level >= 6 AND $level <=10){
				$rebirth_l = '1';
			}else{
				$rebirth_l = '0';
			}
			$prev_balance = get_pym_Balance($user_id);
			$ins = [
					'package_id' 		 => $package_id,
					'timestamp'  		 => time(),
					'unique_id'			 => $unique_id,
					'price' 	 		 => $price,
					'sender_user_id'	 => $user_id,
					'parent'	 		 => $parent,
					'level'	 	 		 => $level,
					'receiver_user_id'	 => $primary_user_id,					
					'rebirth_level'		 => ($rebirth_l) ? $rebirth_l : 0,
					'local_transaction_id' => $manual_unique_id,
					'previous_amt'		=> ($prev_balance) ? $prev_balance : 0
					];	
			// print_r($ins);			
			return $id = $CI->com_m->insert($table, $ins);
}



function matrix_profit($user_id, $level, $package_id, $chart_level, $primary_user_id, $table_id, $rebirth_l, $manual_unique_id, $which_table){
			$CI =& get_instance();			
			$table = which_table($which_table);
			$utype = 2; $admin_PYM_balance=0;
			$profit_table = which_profit_table($which_table);		
			$reduced_amount = global_farming_reduce_income($package_id, $level);
			$profit = ($reduced_amount['profit']) ? $reduced_amount['profit'] : 0;
			$sponsor = ($reduced_amount['to_sponsor']) ? $reduced_amount['to_sponsor'] : 0;			
			$sponsor_user_id = (user_id_to_parent_id($primary_user_id)) ? user_id_to_parent_id($primary_user_id) : 0;
			$unique_id = user_id_to_unique_id($primary_user_id);
			if($level >= 6 AND $level <=10){
				if(!empty($reduced_amount['ap_upgrade'])){
					// To check auto upgrade status Fn
					// $id= getOriginalUserId($id);	
					if(is_already_package_activated_by_manual($primary_user_id, $package_id, $which_table)){
						$profit = $profit + $reduced_amount['ap_upgrade'];
					}					
				}
				$rebirth_l = '1';
			}else{
				$rebirth_l = '0';
			}
			if(!$sponsor_user_id){
				$utype = 1;
				$prev_balance = getadminPYMBalance(1,1);
			}else{
				$utype = 2;
				$prev_balance = get_pym_Balance($user_id);
			}
			$ins = [
					'package_id' 		 => $package_id,
					'timestamp'  		 => time(),					
					'unique_id'			 => $unique_id,
					'receiver_user_id'	 => $primary_user_id,
					'sender_user_id'	 => $user_id,					
					'profit'	 		 => $profit,
					'sponsor_user_id'	 => ($sponsor_user_id) ? $sponsor_user_id : 0,				
					'sponsor'	 		 => ($sponsor_user_id) ? $sponsor : 0,					
					'level'	 	 		 => $level,
					'pid'				 => $table_id,
					'chart_level'		 => $chart_level,
					'rebirth_level'		 => ($rebirth_l) ? $rebirth_l : 0,					
					'local_transaction_id' => $manual_unique_id,
					'previous_amt' 		=> ($prev_balance)? $prev_balance : 0,
					'utype'				=> $utype
					];
			// print_r($ins);
			$id = $CI->com_m->insert($profit_table, $ins);
			if($utype==1){
				// No refrence
				addAdminBalanceAndCurrency($currentAmt);
			}
			return true;
}

function global_rebirth_chart($user_id, $package_id, $level, $chart_level, $primary_user_id, $rebirth_l, $manual_unique_id, $which_table){
			$ci =& get_instance();
			$rebirth_table = which_rebirth_table($which_table);
			$sponsor_user_id = (user_id_to_parent_id($primary_user_id)) ? user_id_to_parent_id($primary_user_id) : 0;
			$unique_id = user_id_to_unique_id($primary_user_id);
			if($level >= 6 AND $level <=10){
				$rebirth_l = '1';
			}else{
				$rebirth_l = '0';
			}			
			$ins = [
					'package_id' 		 => $package_id,
					'timestamp'  		 => time(),					
					'unique_id'			 => $unique_id,					
					'receiver_user_id'	 => $primary_user_id,
					'sender_user_id'	 => $user_id,
					'chart_level'		 => $chart_level,					
					'level'	 	 		 => $level,
					'rebirth_level'		 => ($rebirth_l) ? $rebirth_l : 0,					
					'local_transaction_id' => $manual_unique_id
					];
			// print_r($ins);
	return	$id = $ci->com_m->insert($rebirth_table, $ins);
}


function global_4x_rebirth_chart($user_id, $package_id, $level, $chart_level, $primary_user_id, $rebirth_l, $manual_unique_id){
	$ci =& get_instance();
	$sponsor_user_id = (user_id_to_parent_id($primary_user_id)) ? user_id_to_parent_id($primary_user_id) : 0;
	$unique_id = user_id_to_unique_id($primary_user_id);
	if($level >= 3 AND $level <= 5){
		$rebirth_l = '1';
	}else{
		$rebirth_l = '0';
	}			
	$ins = [
			'package_id' 		 => $package_id,
			'timestamp'  		 => time(),					
			'unique_id'			 => $unique_id,					
			'receiver_user_id'	 => $primary_user_id,
			'sender_user_id'	 => $user_id,
			'chart_level'		 => $chart_level,					
			'level'	 	 		 => $level,
			'rebirth_level'		 => ($rebirth_l) ? $rebirth_l : 0,
			'manual_unique_id' 	 => $manual_unique_id,
			'local_transaction_id' => generate_local_transaction_id()
			];
	// print_r($ins);
return	$id = $ci->com_m->insert('global_4x_rebirth', $ins);
}


function checkValidRef($ref){
	$CI =& get_instance();

	if($CI->com_m->get_row_counter('users',['unique_id' => $ref, 'verified' => '1' ])){
		// Only allowed already you have to purchased a package.
		if($CI->com_m->get_row_counter('package_payment',['user_id' => unique_id_to_user_id($ref) ])){
			return true;
		}else{
			return false;
		}
		// return true;
		
	}else{
		return false;
	}

}


function is_image($path=NULL)
{
	if(!$path) return false;
    $a = getimagesize($path);
    $image_type = $a[2];

    if(in_array($image_type , array(IMAGETYPE_GIF , IMAGETYPE_JPEG ,IMAGETYPE_PNG , IMAGETYPE_BMP)))
    {
        return true;
    }
    return false;
}


function totalEarning2x($user_id, $package_id){
	if(!$user_id){ return false; }
	if(!$package_id){ return false; }
	$CI =& get_instance();
	$unique_id = user_id_to_unique_id($user_id);
	$total_amt_query = $CI->db->select('sum(profit) s')->get_where('global_profit',['unique_id' => $unique_id, 'package_id' => $package_id])->row('s');	
		if($total_amt_query){
			return $total_amt_query;
		}
		return 0;	
}



function totalEarning4x($user_id, $package_id){
	if(!$user_id){ return false; }
	if(!$package_id){ return false; }
	$CI =& get_instance();
	$unique_id = user_id_to_unique_id($user_id);
	$total_amt_query = $CI->db->select('sum(profit) s')->get_where('global_4x_profit',['unique_id' => $unique_id, 'package_id' => $package_id])->row('s');
		if($total_amt_query){
			return $total_amt_query;
		}
		return 0;	
}



function totalSponsorEarning2x($user_id, $package_id){
	if(!$user_id){ return false; }
	if(!$package_id){ return false; }
	$CI =& get_instance();
	// $unique_id = user_id_to_unique_id($user_id);
	$total_amt_query = $CI->db->select('sum(sponsor) s')->get_where('global_profit',['sponsor_user_id' => $user_id, 'package_id' => $package_id])->row('s');	
		if($total_amt_query){
			return $total_amt_query;
		}
		return 0;	
}



function totalSponsorEarning4x($user_id, $package_id){
	if(!$user_id){ return false; }
	if(!$package_id){ return false; }
	$CI =& get_instance();
	$total_amt_query = $CI->db->select('sum(sponsor) s')->get_where('global_4x_profit',['sponsor_user_id' => $user_id, 'package_id' => $package_id])->row('s');
	if($total_amt_query){
		return $total_amt_query;
	}
	return 0;	
}


function dateOfJoining2x($user_id, $package_id){
	$CI =& get_instance();
	$join_time = $CI->db->select('timestamp t')->get_where('package_payment',['user_id' => $user_id, 'package_id' => $package_id])->row('t');
		if($join_time){
			return date('jS F Y, H:i:s', $join_time);
		}
		return 0;	
}

function sponsordateOfJoining2x($user_id, $package_id){
	$CI =& get_instance();
	$join_time = $CI->db->select('timestamp t')->get_where('global_profit',['sponsor_user_id' => $user_id, 'package_id' => $package_id])->row('t');
		if($join_time){
			return date('jS F Y, H:i:s', $join_time);
		}
		return 0;	
}


function downline_4x_earning($package_id, $increment=1, $chart_level=1, $chart=1){
	$ci =& get_instance();
	$child_earn = false;
	if(!$chart){ return 'No chart count'; }
	$condition = ['income_chart_status' => '1', 'package_id' => $package_id ];
	$get = $ci->db->select('user_id')->get_where('package_4x_payment',$condition)->result();
	foreach ($get as $key => $user) {		
			$chart_level = $key + 1;
			$primary_user_id = $user_id = $user->user_id;    
			$manual_unique_id = randomNumber(14);	
			$arr_left = child_4x_downline_rebirth_left($user_id, $package_id, $increment, $chart_level, $primary_user_id, $manual_unique_id);
			$arr_right = child_4x_downline_earning_right($user_id, $package_id, $increment, $chart_level, $primary_user_id, $manual_unique_id);		
			if($arr_right && $arr_left){
			// if($arr_right){
				$child_earn = true;			
			}		
	}
	return $child_earn; 
	}
	
	
	
	function child_4x_downline_earning_right($ref, $package_id, $count, $chart_level, $primary_user_id, $manual_unique_id){
	// echo '<br><div style="color:green;">REF-->'."\t".$ref."\t".'unique_id-->'."\t".user_id_to_unique_id($ref)."\t".'Count-->'.$count."\t".'Chart level-->'.$chart_level."\t".'Primary user id-->'.$primary_user_id.'--></div><br>';


	$ci =& get_instance();$rebirth_l=0;$earn_container_arr = true;
	$condition = ['package_id' => $package_id, 'income_chart_status' => '1', 'parent'=>$ref, 'position' => 'R' ];
	$get = $ci->db->limit(1)->select('id,user_id,parent')->get_where('package_4x_payment', $condition);
	if($get->num_rows() > 0) {
	$get_users = $get->result();
	foreach ($get_users as $key => $user) {				
				$table_id = $user->id;
				$user_id = $user->user_id;			
				$parent = $user->parent;	
				$increment = $count + 1;			
				$unique_id = user_id_to_unique_id($primary_user_id);
				$is_available_cond = ['chart_level' => $chart_level, 'unique_id' => $unique_id, 'package_id' => $package_id ];
				// echo 'is_completed 4x->'.
				$is_completed = $ci->db->select('count(id) as d')->get_where('global_4x_profit', $is_available_cond)->row('d');
				// echo $ci->db->last_query();
				// echo '<br>chart level-->'.$chart_level;
				// echo '<br>';
				if($is_completed < ACHIEVED_LEVEL_4X){
					$is_available_record = [ 'chart_level' => $chart_level, 'unique_id' => $unique_id, 'level' => $count, 'package_id' => $package_id ];
					$is_completed_record = $ci->db->select('count(id) as d')->get_where('global_4x_profit', $is_available_record)->row('d');
					if(!$is_completed_record){
						// $user_id, $parent, $level, $package_id, $chart_level, $primary_user_id, $type	
						user_4x_price_distribution($user_id, $parent, $count, $package_id,  $chart_level, $primary_user_id, $rebirth_l);
						// $user_id, $level, $package_id, $chart_level, $primary_user_id, $type, $table_id			
						$gp_id = matrix_4x_profit($user_id, $count, $package_id, $chart_level, $primary_user_id, $table_id, $rebirth_l, $manual_unique_id);
					}
				}
				
				if($count == ACHIEVED_LEVEL_4X){				
					return $earn_container_arr;
				}
				return child_4x_downline_earning_right($user_id, $package_id, $increment, $chart_level, $primary_user_id, $manual_unique_id);        	
		}
	}
	return $earn_container_arr;
	}
	
	
	
	function child_4x_downline_rebirth_left($ref, $package_id, $count, $chart_level, $primary_user_id, $manual_unique_id){	
		// echo '<br><div style="color:red;">REF-->'."\t".$ref."\t".'unique_id-->'."\t".user_id_to_unique_id($ref)."\t".'Count-->'.$count."\t".'Chart 
		// level-->'.$chart_level."\t".'Primary user id-->'.$primary_user_id.'--></div><br>';

		
		$ci =& get_instance();$rebirth_l=0;$earn_container_arr = true;
		$condition = ['package_id' => $package_id, 'income_chart_status' => '1', 'parent'=>$ref, 'position' => 'L' ];	
		$get = $ci->db->limit(1)->select('user_id,rebirth_level')->get_where('package_4x_payment', $condition);
		if($get->num_rows() > 0) {
		$get_users = $get->result();
		foreach ($get_users as $key => $user) {				
					$user_id = $user->user_id;
					$rebirth_level = $user->rebirth_level;
					$increment = $count + 1;				
					if($rebirth_level != '0'){
						$rebirth_l = 1;
					}
					$unique_id = user_id_to_unique_id($primary_user_id);
					$is_available_cond = [ 'chart_level' => $chart_level, 'unique_id' => $unique_id, 'package_id' => $package_id];
					$is_completed = $ci->db->select('count(id) as d')->get_where('global_4x_rebirth', $is_available_cond)->row('d');
					if($is_completed < ACHIEVED_LEVEL_4X){
						$is_available_record = [ 'chart_level' => $chart_level, 'unique_id' => $unique_id, 'level' => $count, 'package_id' => $package_id ];
						$is_completed_record = $ci->db->select('count(id) as d')->get_where('global_4x_rebirth', $is_available_record)->row('d');
						if(!$is_completed_record){
							global_4x_rebirth_chart($user_id, $package_id, $count, $chart_level, $primary_user_id, $rebirth_l, $manual_unique_id);
						}
					}				
					if($count == ACHIEVED_LEVEL_4X){					
						return $earn_container_arr;
					}
				return child_4x_downline_rebirth_left($user_id, $package_id, $increment, $chart_level, $primary_user_id, $manual_unique_id);        	
			}
		}
		return $earn_container_arr;
	}


function isNullPay4x($user_id, $count, $package_id, $chart_level, $primary_user_id, $matrix_type){
	$ci =& get_instance();
	$cond=$ci->com_m->get_row_counter('global_4x_profit',['package_id' => $package_id,'receiver_user_id ' => $primary_user_id, 'level' => $count]);
	if($cond == 0){		
		return true;
	}
	return false;
}

function isAlreadyPay4x($user_id, $count, $package_id, $chart_level, $primary_user_id, $matrix_type){
	$ci =& get_instance();
	if($ci->com_m->get_row_counter('global_4x_profit',['package_id' => $package_id,'receiver_user_id' => $primary_user_id,'level' => $count])){		
		$ci->com_m->get_row_counter('global_4x_profit',['package_id' => $package_id,'receiver_user_id' => $user_id,'level' => $count]);
		return true;
	}
	return false;
}


function user_4x_price_distribution($user_id, $parent, $level, $package_id, $chart_level, $primary_user_id, $rebirth_l){				
			$CI =& get_instance();			
			$reduced_amount = global_farming_reduce_income($package_id, $level);			
			$price = isset($reduced_amount) ? $reduced_amount['price'] : 0;			
			$type = 4;
			$unique_id = user_id_to_unique_id($primary_user_id);
			$rebirth_l = '0';
			// if($level >= 3 AND $level <= 5){
			// 	$rebirth_l = '1';
			// }else{
			// 	$rebirth_l = '0';
			// }
			$ins = [
					'package_id' 		 => $package_id,
					'timestamp'  		 => time(),
					'price' 	 		 => $price,
					'sender_user_id'	 => $user_id,
					'parent'	 		 => $parent,
					'level'	 	 		 => $level,
					'receiver_user_id'	 => $primary_user_id,
					'matrix_type'		 => $type,
					'unique_id'			 => $unique_id,
					'rebirth_level'		 => ($rebirth_l) ? $rebirth_l : 0,
					'local_transaction_id' => generate_local_transaction_id()
					];	
					// print_r($ins);				
			return $id = $CI->com_m->insert('get_four_matrix_payment', $ins);
}

function matrix_4x_profit($user_id, $level, $package_id, $chart_level, $primary_user_id, $table_id, $rebirth_l, $manual_unique_id){
			$CI =& get_instance();			
			$reduced_amount = global_farming_reduce_income($package_id, $level);
			$profit = ($reduced_amount['price']) ? $reduced_amount['price'] : 0;
			// $sponsor = ($reduced_amount['to_sponsor']) ? $reduced_amount['to_sponsor'] : 0;			
			$sponsor_parent_user_id = (user_id_to_parent_id($primary_user_id)) ? user_id_to_parent_id($primary_user_id) : 0;
			$unique_id = user_id_to_unique_id($primary_user_id);
			$rebirth_l = '0';
			// if($level >= 3 AND $level <= 5){
			// 	$rebirth_l = '1';
			// }else{
			// 	$rebirth_l = '0';
			// }
			$type = 4;
			$sponsor_user_id = ($sponsor_parent_user_id) ? $sponsor_parent_user_id : 0 ;			
			if(!$sponsor_user_id){
				$utype = 1;
				$prev_balance = getadminPYMBalance(1,1);
			}else{
				$utype = 2;
				$prev_balance = get_pym_Balance($user_id);
			}
			$ins = [
					'package_id' 		 => $package_id,
					'timestamp'  		 => time(),
					'matrix_type'		 => $type,
					'receiver_user_id'	 => $primary_user_id,
					'sender_user_id'	 => $user_id,					
					'profit'	 		 => $profit,
					// 'sponsor_user_id'	 => $sponsor_user_id,				
					// 'sponsor'	 		 => ($sponsor_parent_user_id) ? $sponsor : 0,
					'pid'				 => $table_id,
					'chart_level'		 => $chart_level,					
					'level'	 	 		 => $level,
					'unique_id'			 => $unique_id,
					// 'rebirth_level'		 => ($rebirth_l) ? $rebirth_l : 0,
					'local_transaction_id' => generate_local_transaction_id(),
					'previous_amt' => ($prev_balance)? $prev_balance : 0,
					'utype'				=> $utype
					];			
			$id = $CI->com_m->insert('global_4x_profit', $ins);
			return true;
}
//////////////////////////



function timestamp_UTC_conversion($date, $format=''){
	if(!$date) return false;
	if (filter_var($date, FILTER_VALIDATE_INT)) {
		if($format){
			return date($format, $date);	
		}
		return date('jS F Y, H:i:s', $date);
	}else{
		return 'Integer is only allowed';
	}
}

function calcOverallRebirthLevel($user_id, $package_id){
	if(!$user_id) return false;
	$CI =& get_instance();
	$unique_id = user_id_to_unique_id($user_id);
	$x_cond = ['unique_id' => $unique_id, 'package_id' => $package_id , 'rebirth_level' => '1'];    
	$rebirth_level_counter = $CI->db->select('id')->get_where('global_profit', $x_cond)->num_rows();
	// echo $CI->db->last_query();exit;
	return ($rebirth_level_counter) ? $rebirth_level_counter : 0;
}


function calc4xOverallRebirthLevel($user_id, $package_id){
	if(!$user_id) return false;
	$CI =& get_instance();
	$unique_id = user_id_to_unique_id($user_id);
	$x_cond = ['unique_id' => $unique_id, 'package_id' => $package_id , 'rebirth_level' => '1'];    
	$rebirth_level_counter = $CI->db->select('id')->get_where('global_4x_profit', $x_cond)->num_rows();
	return ($rebirth_level_counter) ? $rebirth_level_counter : 0;
}


function calcPackAchievedLevel($user_id, $package_id){	
	if(!$user_id) return false;
	$CI =& get_instance();
	$unique_id = user_id_to_unique_id($user_id);
	$package_chart_arr = $CI->db->select('*')->group_by('chart_level')->get_where('global_profit',['unique_id' => $unique_id, 'package_id' => $package_id]);
		// echo $CI->db->last_query();exit;
		if($package_chart_arr->num_rows() > 0){		
			return $pc_arr = $package_chart_arr->result();
		}
		return 0;
}

function calcPackAchievedLevel42($user_id, $package_id){	
	if(!$user_id) return false;
	$CI =& get_instance();
	$unique_id = user_id_to_unique_id($user_id);
	$package_chart_arr = $CI->db->select('*')->group_by('chart_level')->get_where('global_mi_profit',['unique_id' => $unique_id, 'package_id' => $package_id]);
		// echo $CI->db->last_query();exit;
		if($package_chart_arr->num_rows() > 0){		
			return $pc_arr = $package_chart_arr->result();
		}
		return 0;
}



function calcPackAchievedSponsorLevel($user_id, $package_id){	
	if(!$user_id) return false;
	$CI =& get_instance();	
	$package_chart_arr = $CI->db->select('*')->group_by('chart_level')->get_where('global_profit',['sponsor_user_id' => $user_id, 'package_id' => $package_id]);
	// echo $CI->db->last_query();
		if($package_chart_arr->num_rows() > 0){		
			return $pc_arr = $package_chart_arr->result();
		}
		return 0;
}

function calcPackageAchievedLevelOnly($user_id, $package_id){	
	if(!$user_id) return false;
	$CI =& get_instance();
	$unique_id = user_id_to_unique_id($user_id);
	$package_chart_arr = $CI->db->select('*')->group_by('chart_level')->get_where('global_profit',['unique_id' => $unique_id, 'package_id' => $package_id]);
		// echo $CI->db->last_query();exit;
		if($v = $package_chart_arr->num_rows() > 0){		
			return $v;
		}
		return 0;
}

function calc4xPackAchievedLevel($user_id, $package_id){
	if(empty($user_id)) return false;
	$CI =& get_instance();	
	$unique_id = user_id_to_unique_id($user_id);
	$package_chart_arr = $CI->db->select('*')->group_by('chart_level')->get_where('global_4x_profit',['unique_id' => $unique_id, 'package_id' => $package_id]);			
		if($package_chart_arr->num_rows() > 0){
			return $pc_arr = $package_chart_arr->result();
		}
		return false;
}



function calc4xPackAchievedSponsorLevel($user_id, $package_id){
	if(empty($user_id)) return false;
	$CI =& get_instance();	
	// $unique_id = user_id_to_unique_id($user_id);
	$package_chart_arr = $CI->db->select('*')->group_by('chart_level')->get_where('global_4x_profit',['sponsor_user_id' => $user_id, 'package_id' => $package_id]);			
		if($package_chart_arr->num_rows() > 0){
			return $pc_arr = $package_chart_arr->result();
		}
		return false;
}


function calcMaxPackAchievedLevel($user_id, $package_id,$chart=1){
	if(empty($user_id)) return false;
	$CI =& get_instance();
	$unique_id = user_id_to_unique_id($user_id);
	if($chart){
		$CI->db->where('chart_level', $chart);
	}
	$package_chart_arr = $CI->db->select('count(id) as level')->order_by('id','desc')->limit(1)->get_where('global_profit',['unique_id' => $unique_id, 'package_id' => $package_id]);
		// echo $CI->db->last_query();

		if($package_chart_arr->num_rows() > 0){			
			// echo "\t-->".
			$pc_arr = $package_chart_arr->row('level');
			return ($pc_arr) ? $pc_arr  : 0;
		}
		return 0;
}



function calcMaxPackAchievedLevel42($user_id, $package_id,$chart=1){
	if(empty($user_id)) return false;
	$CI =& get_instance();
	$unique_id = user_id_to_unique_id($user_id);
	if($chart){
		$CI->db->where('chart_level', $chart);
	}
	$package_chart_arr = $CI->db->select('count(id) as level')->order_by('id','desc')->limit(1)->get_where('global_mi_profit',['unique_id' => $unique_id, 'package_id' => $package_id]);		
		if($package_chart_arr->num_rows() > 0){			
			$pc_arr = $package_chart_arr->row('level');
			return ($pc_arr) ? $pc_arr  : 0;
		}
		return 0;
}

function calcMaxPackAchievedSponsorLevel($user_id, $package_id,$chart=1){
	if(empty($user_id)) return false;
	$CI =& get_instance();
	// $unique_id = user_id_to_unique_id($user_id);
	if($chart){
		$CI->db->where('chart_level', $chart);
	}
	$package_chart_arr = $CI->db->select('count(id) as level')->order_by('id','desc')->limit(1)->get_where('global_profit',['sponsor_user_id' => $user_id, 'package_id' => $package_id]);
		if($package_chart_arr->num_rows() > 0){			
			$pc_arr = $package_chart_arr->row('level');
			return ($pc_arr) ? $pc_arr  : 0;
		}
		return 0;
}

function calcMax4xPackAchievedLevel($user_id, $package_id,$chart=1){
	$CI =& get_instance();
	if(empty($user_id)) return false;
	$unique_id = user_id_to_unique_id($user_id);
	if($chart){
		$CI->db->where('chart_level', $chart);
	}
	$package_chart_arr = $CI->db->select('count(id) as level')
								->order_by('id','desc')
								->limit(1)
								->get_where('global_4x_profit',['unique_id' => $unique_id, 'package_id' => $package_id]);		
		if($package_chart_arr->num_rows() > 0){			
			return $pc_arr = $package_chart_arr->row('level');
		}
		return 0;
}



function calcMax4xPackAchievedSponsorLevel($user_id, $package_id,$chart=1){
	$CI =& get_instance();
	if(empty($user_id)) return false;
	// $unique_id = user_id_to_unique_id($user_id);
	if($chart){
		$CI->db->where('chart_level', $chart);
	}
	$package_chart_arr = $CI->db->select('count(id) as level')
								->order_by('id','desc')
								->limit(1)
								->get_where('global_4x_profit',['sponsor_user_id' => $user_id, 'package_id' => $package_id]);		
		if($package_chart_arr->num_rows() > 0){			
			return $pc_arr = $package_chart_arr->row('level');
		}
		return 0;
}


function calcMaxPackAchievedprofit($user_id, $package_id, $chart=1){	
	if(empty($user_id)) return false;
	$CI =& get_instance();
	$unique_id = user_id_to_unique_id($user_id);
	if($chart){
		$CI->db->where('chart_level', $chart);
	}
	$package_chart_arr = $CI->db->select_sum('profit')
								->order_by('id','desc')
								->limit(1)
								->get_where('global_profit',['unique_id' => $unique_id, 'package_id' => $package_id, 'chart_level' => $chart]);
		if($package_chart_arr->num_rows() > 0){			
			return $pc_arr = $package_chart_arr->row('profit');
		}
		return 0;
}

function calcMaxPackAchievedprofit42($user_id, $package_id, $chart=1){	
	if(empty($user_id)) return false;
	$CI =& get_instance();
	$unique_id = user_id_to_unique_id($user_id);
	if($chart){
		$CI->db->where('chart_level', $chart);
	}
	$package_chart_arr = $CI->db->select_sum('profit')
								->order_by('id','desc')
								->limit(1)
								->get_where('global_mi_profit',['unique_id' => $unique_id, 'package_id' => $package_id, 'chart_level' => $chart]);
		if($package_chart_arr->num_rows() > 0){			
			return $pc_arr = $package_chart_arr->row('profit');
		}
		return 0;
}


function getAlllevel(){
	$CI =& get_instance();
	$user_id = $CI->session->userdata('user_id');	
	return $CI->com_m->getTableData('global_4x_profit',array( 'status' => '1', 'receiver_user_id'=> $user_id),"sum(profit) as  auto_level_income_price")->row('auto_level_income_price');

}

function getAlllevelClaim(){
	$CI =& get_instance();
	$user_id = $CI->session->userdata('user_id');
	return $CI->com_m->getTableData('global_4x_profit',array('basic_amount' => '1', 'status' => '1', 'receiver_user_id'=> $user_id),"sum(profit) as  auto_level_income_price")->row('auto_level_income_price');
}

function is_basic_claim_amount_available($user_id){
	if(!$user_id) return false;
	$ci =& get_instance();
	$user_id = $ci->session->userdata('user_id');
	$basic_amt_cdtn_arr = ['basic_amount' => '1', 'level' => '1','status' => '1', 'receiver_user_id'=> $user_id];
	$n_rows = $ci->db->get_where('global_4x_profit', $basic_amt_cdtn_arr)->num_rows();
	if($n_rows) return true;
	else return false;
}

function getInitialLevelClaim(){
	$CI =& get_instance();
	$user_id = $CI->session->userdata('user_id');
	$basic_amt_cdtn_arr = ['basic_amount' => '1', 'level' => '1','status' => '1', 'receiver_user_id'=> $user_id];
	return $CI->com_m->getTableData('global_4x_profit', $basic_amt_cdtn_arr, "sum(profit) as  auto_init_level_income_price")->row('auto_init_level_income_price');
}

function setInitialLevelClaim(){
	$CI =& get_instance();
	$user_id = $CI->session->userdata('user_id');
	$basic_amt_cdtn_arr = ['basic_amount' => '1', 'level' => '1','status' => '1', 'receiver_user_id'=> $user_id];
	return $CI->com_m->updateTableData('global_4x_profit', $basic_amt_cdtn_arr, ['status' => '0']);
}


function getAllprofit(){	
	$ci =& get_instance();
	$user_id = $ci->session->userdata('user_id');
	$unique_id = user_id_to_unique_id($user_id);
	
		$xx2x = $ci->com_m->getTableData('global_profit',array('status' => '1', 'unique_id'=> $unique_id),"sum(profit) as level_global_price")->row('level_global_price');
		$xx4x = $ci->com_m->getTableData('global_4x_profit',array('status' => '1', 'unique_id'=> $unique_id),"sum(profit) as level_global_price")->row('level_global_price');
		if($xx2x AND $xx4x){
			$global_x = $xx4x + $xx2x;
		}else if($xx2x){
			$global_x = $xx2x;
		}else{
			$global_x = $xx4x;
		}
		return $global_x;
}



function getAllsponsor(){	
	$ci =& get_instance();
	$user_id = $ci->session->userdata('user_id');
	// $unique_id = user_id_to_unique_id($user_id);
		
		$xx2x =0;
		// $xx2x = $ci->com_m->getTableData('global_profit',array('sponsor_status' => '1', 'sponsor_user_id'=> $user_id),"sum(sponsor) as level_global_price")->row('level_global_price');
		$xx4x = $ci->com_m->getTableData('top_level_segment',array( 'send_to'=> $user_id, 'status' => '1'),"sum(price) as team_level_price")->row('team_level_price');

		if($xx2x AND $xx4x){
			$global_x = $xx4x + $xx2x;
		}else if($xx2x){
			$global_x = $xx2x;
		}else{
			$global_x = $xx4x;
		}
		return $global_x;
}



function getwtAlllevel(){
	$CI =& get_instance();
	$user_id = $CI->session->userdata('user_id');
	return $CI->com_m->getTableData('package_level_income_payment',array('utype'=> '2', 'user_id'=> $user_id),"sum(price) as level_income_price")->row('level_income_price');
}


function getwtAllprofit(){	
	$ci =& get_instance();
	$user_id = $ci->session->userdata('user_id');
	$unique_id = user_id_to_unique_id($user_id);
	
		$xx2x = $ci->com_m->getTableData('global_profit',array('unique_id'=> $unique_id),"sum(profit) as level_global_price")->row('level_global_price');
		$xx4x = $ci->com_m->getTableData('global_4x_profit',array('unique_id'=> $unique_id),"sum(profit) as level_global_price")->row('level_global_price');

		if($xx2x AND $xx4x){
			$global_x = $xx4x + $xx2x;
		}else if($xx2x){
			$global_x = $xx2x;
		}else{
			$global_x = $xx4x;
		}
		return $global_x;
}



function getwtAllsponsor(){	
	$ci =& get_instance();
	$user_id = $ci->session->userdata('user_id');
	// $unique_id = user_id_to_unique_id($user_id);
	
		$xx2x = $ci->com_m->getTableData('global_profit',array('sponsor_user_id'=> $user_id),"sum(sponsor) as level_global_price")->row('level_global_price');
		$xx4x = $ci->com_m->getTableData('global_4x_profit',array('sponsor_user_id'=> $user_id),"sum(sponsor) as level_global_price")->row('level_global_price');

		if($xx2x AND $xx4x){
			$global_x = $xx4x + $xx2x;
		}else if($xx2x){
			$global_x = $xx2x;
		}else{
			$global_x = $xx4x;
		}
		return $global_x;
}



function getDirectAllincome(){	
	$ci =& get_instance();
	$user_id = $ci->session->userdata('user_id');
	// $unique_id = user_id_to_unique_id($user_id);
		
		$xx2x = 0;
		// $xx2x = $ci->com_m->getTableData('global_profit',array('sponsor_user_id'=> $user_id),"sum(sponsor) as level_global_price")->row('level_global_price');
		// $xx4x = $ci->com_m->getTableData('package_4x_payment',array('receiver_user_id'=> $user_id),"sum(profit) as level_direct_price")->row('level_direct_price');
		$package_id = 3;
		$package_amt =  $ci->com_m->getTableData('package', array('status' => '1', 'id' => $package_id))->row('income');
		$condition = "`u`.`parent` = " . $user_id . " AND p.package_id = ". $package_id ." AND u.rebirth_status = '0' AND p.direct_parent_income_status='1' ";
		$groupby = "group by u.id";
		$allcount = $ci->db->query("SELECT `p`.`id` FROM `tenrealm_users` as `u` JOIN `tenrealm_package_4x_payment` as `p` ON `p`.`user_id` = `u`.`id` WHERE " . $condition . $groupby)->num_rows();
		// echo my_last_query();
		// print_r($allcount);exit;
		$xx4x = $package_amt *  $allcount;
		if($xx2x AND $xx4x){
			$global_x = $xx4x + $xx2x;
		}else if($xx2x){
			$global_x = $xx2x;
		}else{
			$global_x = $xx4x;
		}
		return $global_x;
}

function calcMaxPackAchievedsponsor($user_id, $package_id, $chart=1){
	$CI =& get_instance();
	if(empty($user_id)) return false;
	// $unique_id = user_id_to_unique_id($user_id);

	if($chart){
		$CI->db->where('chart_level', $chart);
	}

	$package_chart_arr = $CI->db->select_sum('sponsor')
								->order_by('id','desc')
								->limit(1)
								->get_where('global_profit',['sponsor_user_id' => $user_id, 'package_id' => $package_id, 'chart_level' => $chart]);
		// echo $CI->db->last_query();exit;
		if($package_chart_arr->num_rows() > 0){			
			return $pc_arr = $package_chart_arr->row('sponsor');
		}
		return 0;
}


function extraRebirth($user_id, $package_id){
	$CI =& get_instance();
	if(empty($user_id)) return false;
	$prefix=get_prefix();
	$t1 = $prefix.'global_rebirth';
	$t2 = $prefix.'global_profit';
	$unique_id = user_id_to_unique_id($user_id);
	$q = $CI->db->query("SELECT * FROM ".$t1." as r WHERE  r.unique_id = ".$unique_id." AND r.id NOT IN (SELECT p.id FROM  ".$t2." p WHERE  p.unique_id = ".$unique_id.") ");
	return $q->result_array();
}

function calcMax4xPackAchievedprofit($user_id, $package_id, $chart=1){
	$CI =& get_instance();
	if(empty($user_id)) return false;
	$unique_id = user_id_to_unique_id($user_id);
	if($chart){
		$CI->db->where('chart_level', $chart);
	}
	$package_chart_arr = $CI->db->select_sum('profit')
								->order_by('id','desc')
								->limit(1)
								->get_where('global_4x_profit',['unique_id' => $unique_id, 'package_id' => $package_id]);
		if($package_chart_arr->num_rows() > 0){			
			return $pc_arr = $package_chart_arr->row('profit');
		}
		return 0;
}


function calcMax4xPackAchievedSponsor($user_id, $package_id, $chart=1){
	$CI =& get_instance();
	if(empty($user_id)) return false;
	// $unique_id = user_id_to_unique_id($user_id);
	if($chart){
		$CI->db->where('chart_level', $chart);
	}
	$package_chart_arr = $CI->db->select_sum('sponsor')
								->order_by('id','desc')
								->limit(1)
								->get_where('global_4x_profit',['sponsor_user_id' => $user_id, 'package_id' => $package_id]);
		if($package_chart_arr->num_rows() > 0){			
			return $pc_arr = $package_chart_arr->row('sponsor');
		}
		return 0;
}


function min_to_sec($minutes, $sec=0){
	return  ($minutes * 60) + $secs;
}


function amount_to_percentage($percentage_amount, $package_amount){
	// (20 * 100) / 50
	return ($percentage_amount * 100) / $package_amount;
}


function percentage_to_amount($percentage_amount, $package_amount){
	// (20 * 50) / 100
	return ($percentage_amount * $package_amount) / 100;
}

function calculated_deposit_percentage($amount, $currency_symbol="LTC"){
	if(empty($amount)) return false;
	if(empty($currency_symbol)) return false;
	$CI =& get_instance();
	$deposit_fee = $CI->com_m->get_row_val('currency',[ 'currency_symbol' => $currency_symbol ]);
	if($deposit_fee['deposit_fees'] && ($deposit_fee['deposit_fees_type'] == 'Percent')){				
		return (($amount * $deposit_fee['deposit_fees'])/100);	
	}else if($deposit_fee['deposit_fees']){		
		return $deposit_fee['deposit_fees'];
	}else{
		return $amount;
	}
}

function calculated_withdraw_percentage($amount, $currency_symbol="LTC"){
	if(empty($amount)) return false;
	if(empty($currency_symbol)) return false;
	$CI =& get_instance();
	$withdraw_fee = $CI->com_m->get_row_val('currency',[ 'currency_symbol' => $currency_symbol ]);		
	if($withdraw_fee['withdraw_fees'] && ($withdraw_fee['withdraw_fees_type'] == 'Percent')){				
		return (($amount * $withdraw_fee['withdraw_fees'])/100);	
	}else if($withdraw_fee['withdraw_fees']){
		return $withdraw_fee['withdraw_fees'];
	}else{
		return $amount;
	}	
}


function deposit_fee($currency_symbol){
	$CI =& get_instance();
	$deposit_fee = $CI->com_m->get_row_val('currency',[ 'currency_symbol' => escape_str($currency_symbol) ], "deposit_fees");
		if($deposit_fee){
			return $deposit_fees;
		}
	return;		
}

function withdraw_fee($currency_symbol){
	$CI =& get_instance();
	if(empty($currency_symbol)) return false;
	$withdraw_fee = $CI->com_m->get_row_val('currency',[ 'currency_symbol' => escape_str($currency_symbol) ], "withdraw_fee");
		if($deposit_fee){
			return $withdraw_fee;
		}
	return;		
}

function current_micro_timestamp(){
	return $milliseconds = round(microtime(true) * 1000);
}

function db_exception(){
	$CI =& get_instance();
	$db_error = $CI->db->error();
    if (!empty($db_error)) {
        throw new Exception('Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message']);
        return false; // unreachable retrun statement !!!
    }
    return TRUE;
}


function get_try_catch_message($exception){
	 return json_encode(array('error' => array('msg' => $exception->getMessage(),'code' => $exception->getCode())));exit;
}

function devided_by_4($var){
	if(!$var) return;
	return preg_replace('/(?<=\d)(?=(\d{4})+$)/', ' ', $var);
}

function get_payment_id($id = NULL){
	if(!$id) return;
	$CI =& get_instance();
	$payment_id = $CI->com_m->get_row_val('currency',[ 'currency_symbol' => escape_str($currency_symbol) ], "withdraw_fee");
		if($deposit_fee){
			return $withdraw_fee;
		}
	return;	
}

function unique_id_to_user_id($id, $all_details=FALSE){
	if(!$id) return;
	$CI =& get_instance();
	if($all_details==TRUE){
		$user_id_arr = $CI->com_m->get_row_val('users',[ 'unique_id' => escape_str($id) ]);
		if($user_id_arr) return $user_id_arr;
	}
	
	$user_id = $CI->com_m->get_row_val('users',[ 'unique_id' => escape_str($id) ], "id");
		if($user_id){
			return $user_id;
		}
	return;
}


function user_id_to_unique_id($id, $all_details=FALSE){
	if(!$id) return;
	$CI =& get_instance();
	if($all_details==TRUE){
		$user_id_arr = $CI->com_m->get_row_val('users',[ 'id' => escape_str($id) ]);
		if($user_id_arr) return $user_id_arr;
	}
	
	$user_id = $CI->com_m->get_row_val('users',[ 'id' => escape_str($id) ], "unique_id");
	// echo my_last_query();
		if($user_id){
			return $user_id;
		}
	return;
}


function unique_id_to_username($id, $all_details=FALSE){
	if(!$id) return;
	$CI =& get_instance();
	if($all_details==TRUE){
		$user_id_arr = $CI->com_m->get_row_val('users',[ 'unique_id' => escape_str($id), 'is_reference' => '0' ]);
		if($user_id_arr) return $user_id_arr;
	}
	
	$user_id = $CI->com_m->get_row_val('users',[ 'unique_id' => escape_str($id) ], "tenrealm_fname");
		if($user_id){
			return $user_id;
		}
	return;	
}

function user_id_to_parent_id($id){
	if(!$id){ return json_encode(['status' => false, 'msg' => 'The user id is required!.']); }
	$CI =& get_instance();
	$parent_id = $CI->com_m->get_row_val('users',[ 'id' => escape_str($id) ], "parent");	
	if($parent_id) return $parent_id;
	return 0;
}


function user_id_to_name($id){
	if(!$id) return json_encode(['status' => false, 'msg' => 'The user id is required!.']);
	$CI =& get_instance();
	$prefix=get_prefix();
	$fname = $prefix.'fname';	
	$lname = $prefix.'lname';	
	// $name = $CI->db->select('CONCAT('.$fname.','.',  '.$lname.') AS name', FALSE)->get_where('users',[ 'id' => escape_str($id) ])->row('name');	
	$name = $CI->db->select($fname.','.$lname)->get_where('users',[ 'id' => escape_str($id) ])->row();	
	// echo my_last_query();
	// print_r($name);exit;
	if($name->tenrealm_fname && $name->tenrealm_lname){
		return ucfirst($name->tenrealm_fname.' '.$name->tenrealm_lname);
	}else if($name->tenrealm_fname){
		return ucfirst($name->tenrealm_fname);
	}else if($name->tenrealm_lname){
		return ucfirst($name->tenrealm_lname);
	}
	if(!$name) return false;
}



function user_id_to_fname($id){
	if(!$id) return json_encode(['status' => false, 'msg' => 'The user id is required!.']);
	$CI =& get_instance();
	$prefix=get_prefix();
	$fname = $prefix.'fname';	
	$name = $CI->db->select('CONCAT('.$fname.') AS name', FALSE)->get_where('users',[ 'id' => escape_str($id) ])->row('name');	
	if($name) return ucfirst($name);
	return false;
}




function escape_str($value){
	if(!$value) return;
	$CI =& get_instance();
	return $CI->db->escape_str($value);
}



// Send url to fetch data
function curl_get_contents($url){
	if(!$url) return;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}


function downline_earning_tester($package_id, $my_user_id=NULL, $increment=1, $chart_level=1, $chart=1, $which_table=1){
if(!$chart){ return 'No chart count'; }
$ci =& get_instance();
$package_table = which_table($which_table);

$child_earn = [];
if($my_user_id){
	$condition = [ 'user_id' => $my_user_id, 'package_id' => $package_id];	
}else{
	$condition = [ 'package_id' => $package_id];
}
$get = $ci->db->select('user_id,id')->get_where($package_table, $condition)->result();
foreach ($get as $key => $user) {
		$chart_level = $key + 1;
    	$primary_user_id = $user_id = $user->user_id;    	
    	$id = $user->id;
    	unset($GLOBALS['earn_container_arr_tester']);		
		$child_earn[] = child_downline_earning_tester($user_id, $package_id, $increment, $chart_level, $primary_user_id, $id, $which_table);			
}
return $child_earn; 
}


function child_downline_earning_tester($ref, $package_id, $count, $chart_level, $primary_user_id, $table_id=1, $which_table=1){
global $earn_container_arr_tester;
$ci =& get_instance();
$package_table = which_table($which_table);
$condition = ['package_id' => $package_id, 'parent'=>$ref];
$get = $ci->db->order_by("id", "asc")->limit(2)->select('id,user_id,rebirth_level,parent,position,transaction_id')->get_where($package_table, $condition);
if($get->num_rows() > 0) {	
$get_users = $get->result();
foreach ($get_users as $key => $user) {			
			$table_id = $user->id;
			$user_id = $user->user_id;
			$rebirth_level = $user->rebirth_level;
			$parent = $user->parent;
			$positions = $user->position;		
			$transaction = $user->transaction_id;			
			$increment = $count + 1;			
			$earn_container_arr_tester[$count][] = array('id' => $table_id,
													 	 'user_id'=>$user_id,
													 	 'transaction_id' => $transaction,
													 	 'rebirth_level'=>$rebirth_level,
													 	 'parent'=>$parent,
													 	 'position' => $positions);			
			child_downline_earning_tester($user_id, $package_id, $increment, $chart_level, $primary_user_id, $table_id, $which_table);        	
    }
}
return $earn_container_arr_tester;
}



// Emush Start //
function checkAvailableUserChildren($user_id, $needed_level=0, $level=1, $package_id=3){	
	if(!$user_id){return json_encode(['status' => false, 'msg' => 'The current User ID is required!.']);}
	if(!$package_id){return json_encode(['status' => false, 'msg' => 'The current package ID is required!.']);}
	$CI =& get_instance();
	$prefix=get_prefix();
	$t_n = 'users';
	// $user_id = '2';

	if($level == 1){
		$my_profit_level = $CI->db->order_by('id', 'desc')->limit(1)->select('level')->get_where('global_4x_profit', ['receiver_user_id' => $user_id])->row('level');
		// echo my_last_query();


		if($my_profit_level){
			$needed_level = $my_profit_level;
		}
	}

	if($needed_level==1){
		return "true";
	}

	$t1 = $prefix . $t_n;
	$t2 = $prefix . 'package_4x_payment';

	$ids = $CI->db->limit(5)->select('id')->get_where($t_n, array('verified' => '1', 'parent' => $user_id ));
	// echo my_last_query();
	
	if(!$ids->num_rows()){
		return 'false';
	}

	$onlyArr = [];
	foreach ($ids->result_array() as $key => $value) {
		$onlyArr[] = $value['id'];
	}
	if($onlyArr){
	$implode = sprintf("'%s'", implode("','", $onlyArr ));
	$count = $CI->db->query("SELECT id FROM ".$t2." WHERE user_id IN (".$implode. ");" )->num_rows();
		// echo my_last_query();
	    // var_dump($count);
	    // var_dump($needed_level);
	    // var_dump((($count) >= $needed_level-1));
		// var_dump($count > 0 && ($count-1) == $needed_level);
		// var_dump($count > 0 && (($count) >= $needed_level-1));

		if($count > 0 && (($count == 1) && $needed_level == 2)){			
			return "true";
		}else if($count > 0 && (($count == 2) && $needed_level==3)){			
			return "true";
		}else if($count > 0 && (($count == 3) && $needed_level == 4)){			
			return "true";
		}else{
			return "false";
		}
	}
	return "false";
}


function downline_remainder($package_id, $my_user_id=NULL, $increment=1, $chart_level=1){
$ci =& get_instance();
$package_table = 'package_4x_payment';
$r=[];
$child_earn = [];
if($my_user_id){
	$condition = [ 'user_id' => $my_user_id, 'package_id' => $package_id];	
}else{
	$condition = [ 'package_id' => $package_id];
}
$get = $ci->db->select('user_id, id')->get_where($package_table, $condition)->result();

foreach ($get as $key => $user) {
		$chart_level = $key + 1;
    	$primary_user_id = $user_id = $user->user_id;    	
    	$id = $user->id;
    	unset($GLOBALS['remainder']);		
		$child_earn[] = child_downline_remainder($user_id, $package_id, $increment, $chart_level, $primary_user_id, $id);			
}
// print_r($child_earn);exit;
foreach(range(1, 4) as $k => $vl){
	if(isset($child_earn[0][$vl])){
		// print_r(pow(4, $vl) - count($child_earn[0][$vl]));echo "<br>";	
		// print_r(pow(4, $vl));echo "<br>";
		$r[++$k] = pow(4, $vl) - count($child_earn[0][$vl]);
	}
}
return $r;
// return $child_earn;
}


function child_downline_remainder($ref, $package_id, $count, $chart_level, $primary_user_id, $table_id=1){
global $remainder;
$ci =& get_instance();
$package_table = 'package_4x_payment';
$condition = ['package_id' => $package_id, 'parent'=>$ref];
$get = $ci->db->order_by("id", "asc")->limit(4)->select('id,user_id,rebirth_level,parent,position')->get_where($package_table, $condition);
// echo $ci->db->last_query();
if($get->num_rows() > 0) {	
$get_users = $get->result();
foreach ($get_users as $key => $user) {			
			if($key == 0){
				$totalOrder = $ci->db->select('id')->get_where($package_table, ['package_id' => $package_id])->num_rows();
			}
			$table_id = $user->id;
			$user_id = $user->user_id;
			$rebirth_level = $user->rebirth_level;
			$parent = $user->parent;
			$positions = $user->position;		
			$increment = $count + 1;			
			$remainder[$count][] = array('id' => $table_id,
													 	 'user_id'=>$user_id,
													 	 'rebirth_level'=>$rebirth_level,
													 	 'parent'=>$parent,
													 	 'position' => $positions,
													 	 'total' => $totalOrder
													 	);
			if($count < 4){
				child_downline_remainder($user_id, $package_id, $increment, $chart_level, $primary_user_id, $table_id);        		
			}
			
    }
}
// print_r($remainder);exit;
return $remainder;
}



        /**
   * Multi-array search
   *
   * @param array $array
   * @param array $search
   * @return array
   */
  function multi_array_search($array, $search)
  {

    // Create the result array
    $result = array();

    // Iterate over each array element
    foreach ($array as $key => $values)
    {

      foreach ($values as $keys => $value) {
          
          // Iterate over each search condition
          foreach ($search as $k => $v)
          {

            // If the array element does not meet the search condition then continue to the next element
            // print_r($value[$k]);echo "<br>";
            if (!isset($value[$k]) || $value[$k] != $v)
            {
              continue 2;
            }

          }


      // Add the array element's key to the result array
      $result[] = $key;
      $result[] = $keys;

      }

    }

    // Return the result array
    return $result;

  }


// Emush End //

function downline_4x_earning_tester($package_id, $my_user_id=NULL, $increment=1, $chart_level=1, $chart=1){
	$ci =& get_instance();
	if(!$chart){ return 'No chart count'; }
	$child_earn = [];	
	if(!empty($my_user_id)){		
		$condition = [ 'user_id' => $my_user_id, 'package_id' => $package_id];	
	}else{
		$condition = [ 'package_id' => $package_id];
	}	
	$get = $ci->db->select('user_id, id')->get_where('package_4x_payment', $condition)->result();	
	// echo '<br>SELECT1--->increment'.$increment.'-->'."\t".$ci->db->last_query().'<br>';exit;

	foreach ($get as $key => $user) {
			$chart_level = $key + 1;
			$primary_user_id = $user_id = $user->user_id; 	
			$id = $user->id;
			unset($GLOBALS['earn_4x_container_arr_tester']);
			$child_earn[] = child_downline_4x_earning_tester($user_id, $package_id, $increment, $chart_level, $primary_user_id, $id);			
	}
	return $child_earn; 
	}
	
	
	function child_downline_4x_earning_tester($ref, $package_id, $count, $chart_level, $primary_user_id, $table_id=1){
	global $earn_4x_container_arr_tester;	
	// if($count == 3){
	// 	return $earn_container_arr_tester;
	// }	
	$ci =& get_instance();
	$condition = ['package_id' => $package_id, 'parent'=>$ref];
	$get = $ci->db->order_by("id", "asc")->limit(4)->select('id,user_id,rebirth_level,parent,position')->get_where('package_4x_payment', $condition);
	if($get->num_rows() > 0) {	
	$get_users = $get->result();
	foreach ($get_users as $key => $user) {			
		$table_id = $user->id;
		$user_id = $user->user_id;
		$rebirth_level = $user->rebirth_level;
		$parent = $user->parent;
		$positions = $user->position;	
		$increment = $count + 1;			
		$earn_4x_container_arr_tester[$count][] = array('id' => $table_id,'user_id'=>$user_id,'rebirth_level'=>$rebirth_level,'parent'=>$parent,'position' => $positions);			
		child_downline_4x_earning_tester($user_id, $package_id, $increment, $chart_level, $primary_user_id, $table_id);
		
		}
	}
	
	return $earn_4x_container_arr_tester;
	}
	



function tenrealm(){
	getCommissionLevel($id, $id, $gipvalue['id'], 1);
	rebirth2X($current_user_id, $package_id, $auto_upgrade);
}

function total_earning($user_id) {
	if(!$user_id) return;
	$ci =& get_instance();
	$X4globalProfit=0;
	$X4globalSponsor=0;
	$unique_id = user_id_to_unique_id($user_id);
	$parent_id = user_id_to_parent_id($user_id);
	$packageIncome = $ci->db->select_sum('direct_parent_income')->from('package_4x_payment')->where([ 'direct_parent' => $user_id ])->get()->row()->direct_parent_income;
	// echo my_last_query();
	$X2globalProfit = $ci->db->select_sum('profit')->from('global_4x_profit')->where('unique_id', $unique_id)->get()->row()->profit;
	$X2globalSponsor = $ci->db->select_sum('price')->from('top_level_segment')->where('(send_to = '.$user_id.') ')->get()->row()->price;

	// $X4globalProfit = $ci->db->select_sum('profit')->from('global_4x_profit')->where('(unique_id = '.$unique_id.') ')->get()->row()->profit;	
	// $X4globalSponsor = $ci->db->select_sum('sponsor')->from('global_4x_profit')->where('(sponsor_user_id = '.$user_id.') ')->get()->row()->sponsor;


	// $manual_already_update_income = $ci->com_m->get_row_val('package_payment', ['unique_id' => $unique_id, 'auto_upgrade' => '0'], "sum(already_activated_income)");	
	// $sum = $packageIncome+$X2globalProfit+$X2globalSponsor+$X4globalProfit+$X4globalSponsor+$manual_already_update_income;
	$sum = $packageIncome+$X2globalProfit+$X2globalSponsor+$X4globalProfit+$X4globalSponsor;
    return $sum;
}


function generate_local_transaction_id(){
        $charid = microtime();
        $c = unpack("C*",$charid);
        $c = implode("",$c);
  	return substr($c,0,18);
}

function getState($country=NULL, $state=NULL) {

	$url = "https://geodata.solutions/api/api.php?type=getStates&countryId=".$country;
    $data = file_get_contents($url);
    if($data) {
    	$json = json_decode($data);
    	if($json->result!='') {
    		$array = (array)$json->result;
    		$key = array_keys($array);
    	}
    	
    }   
}


function array_flatten($array) { 
  if (!is_array($array)) { 
    return false; 
  } 
  $result = array(); 
  foreach ($array as $key => $value) { 
    if (is_array($value)) { 
      $result = array_merge($result, array_flatten($value)); 
    } else { 
      $result = array_merge($result, array($key => $value));
    } 
  } 
  return $result; 
}


function package_id_to_name($id, $all_details=FALSE){
if(!$id) return;
	$CI =& get_instance();
	if($all_details==TRUE){
		$user_id_arr = $CI->com_m->get_row_val('package',[ 'id' => escape_str($id) ]);
		if($user_id_arr) return $user_id_arr;
	}

	$user_id = $CI->com_m->get_row_val('package',[ 'id' => escape_str($id) ], "package_name");
    if($user_id){
        return $user_id;
    }
	return;
}

function my_number_format($amt){
if(!$amt) return '0.00';
return (sprintf('%0.2f',$amt));
}

function admin_wallet_det($id)
{
	$ci =& get_instance();
	$get = $ci->com_m->getTableData('admin_wallet',array('user_id'=>$id))->row();
	return $get;
}

function get_transfer_Balance($id=NULL)
{
	$balance=0;
	$ci =& get_instance();
	if(!$id) $id = $ci->session->userdata('user_id');

	$id= getOriginalUserId($id);	
	$wallet = $ci->db->where('user_id', $id)->get('wallet');
	// echo my_last_query();exit;
	if($wallet->num_rows()==1)
	{		
		$wallets=$wallet->row('transfer');		
		if($wallets!='')
		{
			$balance=$wallets;
		}		
	}
	return $balance;
}


function update_transfer_Balance($id,$balance=0)
{
	$ci =& get_instance();
	$wallet = $ci->db->where('user_id', $id)->get('wallet');
	if($wallet->num_rows()==1)
	{
		$upd=array();
		$upd['transfer']=to_decimal_point($balance, 8);			
		$ci->db->where('user_id',$id);
		$ci->db->update('wallet', $upd);
		return true;
	}
	return false;
}


function level_init(){
	$ci =& get_instance();
	$remain_table = 'remaining_user';
	$prefix=get_prefix();
	$get_all_user_query = $ci->db->get_where('package_4x_payment');
	if($get_all_user_query->num_rows() < 1){
		return false;
	}

	$ci->db->query("TRUNCATE TABLE tenrealm_remaining_user");
	$get_all_user = $ci->db->get_where('package_4x_payment')->result_array();
	// print_r($get_all_user);
	foreach ($get_all_user as $gkey => $gvalue) {
		$current_user_id = $gvalue['user_id'];
		$init_id = $gvalue['id'];
		// if($gkey == 20){ echo "REMAIN";return false;exit; }
		foreach (range(1, 4) as $lvl_key => $lvl_value) {
			// First user leves
			if( $gkey == 0 && $init_id==1){
				$level_user_remaing = pow(4, $lvl_value);
				$condition = [ 'user_id' => $current_user_id ];
				if($lvl_key == 0){
					$lvl_rem = $level_user_remaing-1;
					$data = ['user_id' => $current_user_id, 'l'.$lvl_value => $lvl_rem ];
					$ci->com_m->insert_update_avail($remain_table, $data, $condition);
				}else{
					$pre = ['id' => 1];
					$previous_record_only = $ci->db->select('*')->order_by('id',"desc")->limit(1)->get_where($remain_table, $pre)->row_array();
					if($previous_record_only){
						// print_r($previous_record_only);
						$lvl_value_temp = $lvl_value-1;
						$curr_index = 'l'.$lvl_value_temp;
						$lvl_rem =  pow(4, $lvl_value) + $previous_record_only[$curr_index];
					}
					
					$data = ['user_id' => $current_user_id, 'l'.$lvl_value => $lvl_rem ];
					$ci->com_m->insert_update_avail($remain_table, $data, $condition);
				}
				
				
				
				// echo my_last_query();echo "<br>";
			}else{
				// // second user, 3,4 ....
				$level_user_remaing = pow(4, $lvl_value);
				$lv = 'l'.$lvl_value;
				$pre = ['id' => $gkey];
				$previous_record = $ci->db->select('*')->order_by('id',"desc")->limit(1)->get_where($remain_table, $pre)->row_array();
				
				if($lvl_value==1){
					$data = ['user_id' => $current_user_id, $lv => ($level_user_remaing + $previous_record[$lv]) ];
					$ci->com_m->insert_update_avail($remain_table, $data, ['user_id' => $current_user_id]);
				}elseif ($lvl_value == 2) {
					$data = [ $lv => ($level_user_remaing + $previous_record[$lv]) ];
					$ci->com_m->update($remain_table, $data, [ 'user_id' =>$current_user_id ]);
				}elseif ($lvl_value == 3) {
					
					$data = [ $lv => ($level_user_remaing + $previous_record[$lv]) ];
					$ci->com_m->update($remain_table, $data, [ 'user_id' =>$current_user_id ]);
				}elseif ($lvl_value == 4) {
					
					$data = [ $lv => ($level_user_remaing + $previous_record[$lv]) ];
					$ci->com_m->update($remain_table, $data, [ 'user_id' =>$current_user_id ]);
				}

				echo "<div style='color:red;'>".my_last_query()."</div> \n <br>";
			}
		}
	}
	echo "Done";
	return true;
}




function remaining_init(){
	$ci =& get_instance();
	if(level_init()==false){return false;}
	$remain_table = 'remaining_user';
	// $get_all_user_query = $ci->db->get_where('package_4x_payment', ['remaining_status' => '1']);
	$get_all_user_query = $ci->db->get_where('package_4x_payment');
		if($get_all_user_query->num_rows() > 0){
			$level_user_remaing = $get_all_user_query->num_rows()-1;
			if($level_user_remaing>0){
			// $level_user_remaing = 574;
			$get_all_user_query_remaing = $ci->db->get_where($remain_table);
		foreach ($get_all_user_query_remaing->result_array() as $gkey => $gvalue) {
			$current_user_id = $gvalue['user_id'];
			$previous_record_l1 = $gvalue['l1'];
			$previous_record_l2 = $gvalue['l2'];
			$previous_record_l3 = $gvalue['l3'];
			$previous_record_l4 = $gvalue['l4'];
			$pre = ['user_id' => $current_user_id ];

			$data = [ 
				'l1' => (($previous_record_l1 - $level_user_remaing) >= 0)?$previous_record_l1 - $level_user_remaing:'0',
				'l2' => (($previous_record_l2 - $level_user_remaing) >= 0)?$previous_record_l2 - $level_user_remaing:'0',
				'l3' => (($previous_record_l3 - $level_user_remaing) >= 0)?$previous_record_l3 - $level_user_remaing:'0',
				'l4' => (($previous_record_l4 - $level_user_remaing) >= 0)?$previous_record_l4 - $level_user_remaing:'0',
				 ];
			$ci->com_m->update($remain_table, $data, $pre);
			echo $ci->db->last_query()."<br>";	
		}
	}
	}
	return true;
}


