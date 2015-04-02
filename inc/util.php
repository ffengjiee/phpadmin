<?php
/**
 * common functions
 * cache functions
 * create by lane
 * @2012-01-01
*/
function generateUserPassword($pass) {
    global $config;
    return $config ? md5(md5($config[PREKEY4PASSWORD] . $pass)) : md5(md5($pass));
}

function checkFileMTime($file, $secs) {
    $update = false;
    if (file_exists($file)) {
        $mtime = filemtime($file);
        $now = time();
        $update = $now - $mtime >= $secs ? true : false;
    }else {
        $update = true;
    }

    return $update;
}

function isImgUrl($url) {
    return strpos($url, '.jpg') + strpos($url, '.gif');
}

function rs2Array($rs) {
    $rows = array();
    while ($row = mysql_fetch_array($rs)) {
        $rows[] = $row;
    }
    return $rows;
}

function getRndArray($arr, $num) {
    if ($num > count($arr)) {
        $num = count($arr);
    }
    $arrKeys = array_rand($arr, $num);
    $out = array();
    foreach ($arrKeys as $key) {
        $out[] = $arr[$key];
    }
    return $out;
}

/**
 * cache save and get
*/
function cacheSave($key, $value, $cacheFolder = '') {
    $cachePath = dirname(__FILE__) . "/../cache/";
    //check cache folder if exits
    if (!file_exists($cachePath . $cacheFolder)) {
        mkdir($cachePath . $cacheFolder, 0777, true);
    }
    $cacheFile = $cachePath . $cacheFolder . $key . '.htm';
    return file_put_contents($cacheFile, $value);
}

function cacheGet($key, $cacheFolder = '') {
    $cachePath = dirname(__FILE__) . "/../cache/";
    $cacheFile = $cachePath . $cacheFolder . $key . '.htm';
    if (file_exists($cacheFile)) {
        return file_get_contents($cacheFile);
    }else {
        return '';
    }
}

//parameter filter
function cleanParameters(&$arr) {
    $filters = array(
        '&#39;' => '/\\\\?\'/',
        '&quot;' => '/\\\\?\"/',
    );
    foreach ($arr as $key => $val) {
        $temp = $val;
        foreach ($filters as $replace => $reg) {
            $temp = preg_replace($reg, $replace, $temp);
        }
        $arr[$key] = $temp;
    }
}

/**
 * 临时使用，已经不用了。
 **/
function httpRequest($url, $method='get', $params=array() )
{

	$query_string = str_replace('%7E', '~', http_build_query($params));
	$ch = curl_init();
	$curl_opts = array(
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_HEADER => false,
			CURLOPT_HTTPHEADER=>array('Authorization: Token e9a41b74bc29ed8284ad707b5e8a54a9dc36d19b'),
			CURLOPT_FOLLOWLOCATION => false,
			
	);
	if ($method == 'post') {
		$curl_opts[CURLOPT_URL] = $url;
		$curl_opts[CURLOPT_POSTFIELDS] = $query_string;
	} 
	else if($method == 'delete'){
		$curl_opts[CURLOPT_URL] = $url . '?' . $query_string;
		$curl_opts[CURLOPT_CUSTOMREQUEST] = 'DELETE';
	}
	else {
		$curl_opts[CURLOPT_URL] = $url . '?' . $query_string;
		$curl_opts[CURLOPT_POST] = false;
	}
	curl_setopt_array($ch, $curl_opts);
	$response = curl_exec($ch);
	if (curl_errno($ch)) {
		throw new  Exception ( '初始化错误' );
		//CLog::warning('curl exec fail');
		curl_close($ch);
		return 'curl_exec fail';
	}
	curl_close($ch);
	return $response;
}
