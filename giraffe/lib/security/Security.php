<?php
/* 功能说明：防护XSS,SQL,代码执行，文件包含等多种高危漏洞 */
namespace giraffe\lib\security;
class Security {
	private static $url_arr = array('xss' => "\\=\\+\\/v(?:8|9|\\+|\\/)|\\%0acontent\\-(?:id|location|type|transfer\\-encoding)" );
	private static $args_arr = array (
			'xss' => "[\\'\\\"\\;\\*\\<\\>].*\\bon[a-zA-Z]{3,15}[\\s\\r\\n\\v\\f]*\\=|\\b(?:expression)\\(|\\<script[\\s\\\\\\/]|\\<\\!\\[cdata\\[|\\b(?:eval|alert|prompt|msgbox)\\s*\\(|url\\((?:\\#|data|javascript)",
			'sql' => "[^\\{\\s]{1}(\\s|\\b)+(?:select\\b|update\\b|insert(?:(\\/\\*.*?\\*\\/)|(\\s)|(\\+))+into\\b).+?(?:from\\b|set\\b)|[^\\{\\s]{1}(\\s|\\b)+(?:create|delete|drop|truncate|rename|desc)(?:(\\/\\*.*?\\*\\/)|(\\s)|(\\+))+(?:table\\b|from\\b|database\\b)|into(?:(\\/\\*.*?\\*\\/)|\\s|\\+)+(?:dump|out)file\\b|\\bsleep\\([\\s]*[\\d]+[\\s]*\\)|benchmark\\(([^\\,]*)\\,([^\\,]*)\\)|(?:declare|set|select)\\b.*@|union\\b.*(?:select|all)\\b|(?:select|update|insert|create|delete|drop|grant|truncate|rename|exec|desc|from|table|database|set|where)\\b.*(charset|ascii|bin|char|uncompress|concat|concat_ws|conv|export_set|hex|instr|left|load_file|locate|mid|sub|substring|oct|reverse|right|unhex)\\(|(?:master\\.\\.sysdatabases|msysaccessobjects|msysqueries|sysmodules|mysql\\.db|sys\\.database_name|information_schema\\.|sysobjects|sp_makewebtask|xp_cmdshell|sp_oamethod|sp_addextendedproc|sp_oacreate|xp_regread|sys\\.dbms_export_extension)",
			'other' => "\\.\\.[\\\\\\/].*\\%00([^0-9a-fA-F]|$)|%00[\\'\\\"\\.]",
	);
	private $referer;
	private $query_string;
	private $post;
	private $get;
	private $cookie;

	public function __construct() {
		$this->referer = empty ( $_SERVER ['HTTP_REFERER'] ) ? array () : array ($_SERVER ['HTTP_REFERER']);
		$this->query_string = empty ( $_SERVER ["QUERY_STRING"] ) ? array () : array ($_SERVER ["QUERY_STRING"]);
		$this->post = empty($_POST) ? array() : $_POST;
		$this->get = empty($_GET) ? array() : $_GET;
		$this->cookie = empty($_COOKIE) ? array() : $_COOKIE;
	}
	public function init(){
		if (!empty($this->query_string))
		$this->check_data ($this->query_string,self::$url_arr);
		if (!empty($this->get))
		$this->check_data ($this->get,self::$args_arr);
		if (!empty($this->post))
		$this->check_data ($this->post,self::$args_arr);
		if (!empty($this->cookie))
		$this->check_data ($this->cookie,self::$args_arr);
		if (!empty($this->referer))
		$this->check_data ($this->referer,self::$args_arr);
	}
	public function check_data($arr, $v) {
		foreach ( $arr as $key => $value ) {
			if (! is_array( $key )) {
				$this->check( $key,$v );
			} else {
				$this->check_data( $key,$v );
			}
			if (! is_array( $value )) {
				$this->check( $value,$v );
			} else {
				$this->check_data( $value,$v );
			}
		}
	}
	private function check($str, $v){
		foreach ( $v as $key => $value ) {
			if (preg_match( "/" . $value . "/is",$str ) == 1 || preg_match( "/" . $value . "/is",urlencode( $str ) ) == 1) {
				exit('您的提交带有不合法参数,谢谢合作');
			}
		}
	}
}