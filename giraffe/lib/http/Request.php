<?php
namespace giraffe\lib\http;
class Request
{
	public static function get($key = null, $default = null) {
		if (null === $key) {
			return $_GET;
		}
		return (isset ( $_GET [$key] )) ? $_GET [$key] : $default;
	}
	public static function post($key = null, $default = null) {
		if (null === $key) {
			return $_POST;
		}
		return (isset ( $_POST [$key] )) ? $_POST [$key] : $default;
	}
	public static function cookie($key = null, $default = null) {
		if (null === $key) {
			return $_COOKIE;
		}
		return (isset ( $_COOKIE [$key] )) ? $_COOKIE [$key] : $default;
	}
	public static function server($key = null, $default = null) {
		if (null === $key) {
			return $_SERVER;
		}
		return (isset ( $_SERVER [$key] )) ? $_SERVER [$key] : $default;
	}
	public static function env($key = null, $default = null) {
		if (null === $key) {
			return $_ENV;
		}
		return (isset ( $_ENV [$key] )) ? $_ENV [$key] : $default;
	}
	public static function session($key = null, $default = null) {
		isset ( $_SESSION ) || session_start ();
		if (null === $key) {
			return $_SESSION;
		}
		return (isset ( $_SESSION [$key] )) ? $_SESSION [$key] : $default;
	}
	public static function header($header) {
		if (empty ( $header )) {
			return null;
		}
		// Try to get it from the $_SERVER array first
		$temp = 'HTTP_' . strtoupper ( str_replace ( '-', '_', $header ) );
		if (! empty ( $_SERVER [$temp] )) {
			return $_SERVER [$temp];
		}
		// This seems to be the only way to get the Authorization header on
		// Apache
		if (function_exists ( 'apache_request_headers' )) {
			$headers = apache_request_headers ();
			if (! empty ( $headers [$header] )) {
				return $headers [$header];
			}
		}
		return false;
	}
	public static function currentUrl() {
		$url = 'http';

		if ('on' == self::server ( 'HTTPS' ))
			$url .= 's';

		$url .= "://" . self::server ( 'SERVER_NAME' );

		$port = self::server ( 'SERVER_PORT' );
		if (80 != $port)
			$url .= ":{$port}";

		return $url . self::server ( 'REQUEST_URI' );
	}
	public static function isPost() {
		if ('POST' == self::server ( 'REQUEST_METHOD' )) {
			return true;
		}
		return false;
	}
	public static function isGet() {
		if ('GET' == self::server ( 'REQUEST_METHOD' )) {
			return true;
		}
		return false;
	}
	public static function isPut() {
		if ('PUT' == self::server ( 'REQUEST_METHOD' )) {
			return true;
		}
		return false;
	}
	public static function isDelete() {
		if ('DELETE' == self::server ( 'REQUEST_METHOD' )) {
			return true;
		}
		return false;
	}
	public static function isHead() {
		if ('HEAD' == self::server ( 'REQUEST_METHOD' )) {
			return true;
		}
		return false;
	}
	public static function isOptions() {
		if ('OPTIONS' == self::server ( 'REQUEST_METHOD' )) {
			return true;
		}
		return false;
	}
	public static function isAjax() {
		return ('XMLHttpRequest' == self::header ( 'X_REQUESTED_WITH' ));
	}
	public static function isFlashRequest() {
		return ('Shockwave Flash' == self::header ( 'USER_AGENT' ));
	}
	public static function isSecure() {
		return ('https' === self::scheme ());
	}
	public static function isSpider($ua = null) {
		is_null ( $ua ) && $ua = $_SERVER ['HTTP_USER_AGENT'];
		$ua = strtolower ( $ua );
		$spiders = array (
				'bot',
				'crawl',
				'spider',
				'slurp',
				'sohu-search',
				'lycos',
				'robozilla'
		);
		foreach ( $spiders as $spider ) {
			if (false !== strpos ( $ua, $spider ))
				return true;
		}
		return false;
	}
	public static function scheme() {
		return ('on' == self::server ( 'HTTPS' )) ? 'https' : 'http';
	}
	public static function clientIp($default = '0.0.0.0') {
		$keys = array (
				'HTTP_X_FORWARDED_FOR',
				'HTTP_CLIENT_IP',
				'REMOTE_ADDR'
		);

		foreach ( $keys as $key ) {
			if (empty ( $_SERVER [$key] ))
				continue;
			$ips = explode ( ',', $_SERVER [$key], 1 );
			$ip = $ips [0];
			$l = ip2long ( $ip );
			if ((false !== $l) && ($ip === long2ip ( $l )))
				return $ip;
		}

		return $default;
	}
	public static function file_get_contents($url){
		$context = stream_context_create ( array (
				'http' => array ('timeout' => 30)
		) ); // 超时时间，单位为秒
		return file_get_contents ( $url, 0, $context );
	}
}