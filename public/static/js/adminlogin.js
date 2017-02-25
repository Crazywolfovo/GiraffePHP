/**
 * 前端登录业务类
 */
var login = {
    check : function() {
        // 获取登录页面中的用户名 和 密码
        var username = $('input[name="username"]').val();
        var password = $('input[name="password"]').val();

        // if(!username) {
        //     dialog.error('用户名不能为空');
        // }
        // if(!password) {
        //     dialog.error('密码不能为空');
        // }

        var url = "showlogin/login";
        var data = {'username':username,'password':password};
        //alert(url);
        $.post(url,data,function(result){
            if(result.status == 0) {
                return dialog.error(result.message);
            }
            if(result.status == 1) {
                //console.log(result.message);
                return dialog.success(result.message,'admin');
            }
        },'json');
    }
}