<?php 
if(!empty($_POST))
{
	$res = httpRequest('http://api.icdn.me:8001/auth-user/register','post',$_POST);
}

?>
<div class="mwin" id="login">
    <div class="hd radius5tr clearfix">
        <h3>注册用户</h3>
        <div class="con clearfix">
            <span class="lborder"></span>
            <a href="<?php echo 'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['REQUEST_URI']).'/login.php'; ?>" target="_self">返回登录</a>
        </div>
    </div>
    <div class="bd">
        <form action="" method="POST">
            <p><label>Email address<br><input class="grayipt" type="text" name="email"></label></p>
            <p><label>Username<br><input class="grayipt" type="text" name="username" ></label></p>
            <p><label>Password<br><input class="grayipt" type="password" name="password"></label></p>
            
            <p class="btns clearfix">
                <input class="btn" type="submit" value="注册">
            </p>
        </form>
    </div>
</div>
