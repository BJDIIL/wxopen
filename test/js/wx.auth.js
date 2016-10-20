/**
 * 发起授权示例
 * 自动跳转至授权页，授权确认后，回调url
 * @author liushuai <849351660@qq.com>
 * datetime 2016年9月23日19:29:43
 */
// 待授权appid
var appid = "wxc7e7261cb4370370";
// 授权方式 显式授权snsapi_userinfo（当需要获取用户头像等信息时）
//         静默授权snsapi_base 只获取用户的openid
var scope = "snsapi_userinfo";
// 回调函数 返回用户的基本信息userinfp
var callback_url = "http://wx.rkastore.com/master-up/test/callback.php";

function init() {
    wxopen.getUserData(callback_url, scope);
}
var wxopen = new WX(appid, init);
wxopen.init();
