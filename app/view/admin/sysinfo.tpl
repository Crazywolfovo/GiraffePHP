{extends file="layout.tpl"}
{block name="serverinfo"}
<div class="container">
	<div class="col-md-8 col-sm-offset-2 text-center">
		<h2>欢迎使用Mr.Y CMS-SYSTEM</h2>
	</div>
	<table data-toggle="table">
		<thead>
			<tr><th>服务器相关信息</th><th></th></tr>
		</thead>
		<tbody>
			<tr><td>服务器计算机名称</td><td>{$COMPUTERNAME}</td></tr>
			<tr><td>服务器IP地址</td><td>{$HTTP_HOST}</td></tr>
			<tr><td>服务器域名</td><td>{$SERVER_NAME}</td></tr>
			<tr><td>服务器端口</td><td>{$SERVER_PORT}</td></tr>
			<tr><td>服务器最大请求数</td><td>{$PHP_FCGI_MAX_REQUESTS}</td></tr>
			<tr><td>服务器操作系统</td><td>{$OS}</td></tr>
			<tr><td>服务器版本</td><td>{$SERVER_SOFTWARE}</td></tr>
			<tr><td>服务器语言种类</td><td>{$HTTP_ACCEPT_LANGUAGE|substr:'0':'5'}</td></tr>
			<tr><td>客户端支持</td><td>{$HTTP_USER_AGENT}</td></tr>
		</tbody>
	</table>
</div>
{/block}
