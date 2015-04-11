<div class="mwin" id="login">
    <div class="hd radius5tr clearfix">
        <h3>管理系统</h3>
        <div class="con clearfix">
            <span class="lborder"></span>
            <a href="<?php echo 'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['REQUEST_URI']).'/register.php'; ?>" target="_self">注册</a>
        </div>
    </div>
    <div class="bd">
        <form action="login.php" method="POST">
            <p class="red"><?php echo $errorMsg; ?></p>
            <p><label>用户名<br><input class="grayipt" type="text" name="username" ></label></p>
            <p><label>密码<br><input class="grayipt" type="password" name="password"></label></p>
            <p class="btns clearfix">
                <!-- <label><input type="checkbox" name="remember" value="1">记住我</label> -->
                <input class="btn" type="submit" value="登录">
            </p>
        </form>
    </div>
</div>
