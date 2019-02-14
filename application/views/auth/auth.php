
<div class="container">

    <section>
        <div id="container_demo" >
            <a class="hiddenanchor" id="toregister"></a>
            <a class="hiddenanchor" id="tologin"></a>
            <div id="wrapper">
                <div id="login" class="animate form">
                    <form  id="loginForm" autocomplete="on">
                        <h1>Log in</h1>
                        <p>
                            <label for="lusername" class="uname" data-icon="u" > Your email or username </label>
                            <input id="lusername" name="username" required="required" type="text" placeholder="myusername or mymail@mail.com"/>
                            <span class="error text-danger" id="lusername_error"></span>
                        </p>
                        <p>
                            <label for="lpassword" class="youpasswd" data-icon="p"> Your password </label>
                            <input id="lpassword" name="password" required="required" type="password" placeholder="eg. X8df!90EO" />
                            <span class="error text-danger" id="lpassword_error"></span>
                        </p>
                        <p class="login button">
                            <input type="button" id="loginBtn" value="Login" />
                        </p>
                        <p class="change_link">
                            Not a member yet ?
                            <a href="#toregister" class="to_register">Join us</a>
                        </p>
                    </form>
                </div>

                <div id="register" class="animate form">
                    <form id="register_form" autocomplete="on">
                        <h1> Sign up </h1>
                        <p>
                            <label for="user_name" class="uname" data-icon="u">Your username</label>
                            <input id="user_name" name="user_name" required="required" type="text" placeholder="mysuperusername690" />
                            <span class="error text-danger" id="user_name_error"></span>
                        </p>
                        <p>
                            <label for="user_email" class="youmail" data-icon="e" > Your email</label>
                            <input id="user_email" name="user_email" required="required" type="email" placeholder="mysupermail@mail.com"/>
                            <span class="error text-danger" id="user_email_error"></span>
                        </p>
                        <p>
                            <label for="passwordsignup" class="youpasswd" data-icon="p">Your password </label>
                            <input id="user_pass" name="user_pass" required="required" type="password" placeholder="eg. X8df!90EO"/>
                            <span class="error text-danger" id="user_pass_error"></span>
                        </p>
                        <p>
                            <label for="passwordsignup_confirm" class="youpasswd" data-icon="p">Please confirm your password </label>
                            <input id="user_confirm_pass" name="user_confirm_pass" required="required" type="password" placeholder="eg. X8df!90EO"/>
                            <span class="error text-danger" id="user_confirm_pass_error"></span>
                        </p>
                        <p class="signin button">
                            <input type="button" id="sign_up_btn" value="Sign up"/>
                        </p>
                        <p class="change_link">
                            Already a member ?
                            <a href="#tologin" class="to_register"> Go and log in </a>
                        </p>
                    </form>
                </div>

            </div>
        </div>
    </section>
</div>

<script>
$(document).ready(function () {

    // register new user

    $('#sign_up_btn').on('click',function(){
        var user_name = $('#user_name').val();
        var user_email = $('#user_email').val();
        var user_pass = $('#user_pass').val();
        var user_confirm_pass = $('#user_confirm_pass').val();

        $.ajax({
            type : "POST",
            url  : "<?php echo base_url('login/register_user') ?>",
            dataType : "JSON",
            data : {user_name:user_name,user_pass:user_pass,user_confirm_pass:user_confirm_pass},
            success: function(data){
            if($.isEmptyObject(data.error)){
                    $("#user_name_error").html("");
                    $("#user_email_error").html("");
                    $("#user_pass_error").html("");
                    $("#user_confirm_pass_error").html("");

                    console.log(data.redirect);

                    window.location.href = data.redirect;

                }else{
                    $("#user_name_error").html(data.error.user_name);
                    $("#user_email_error").html(data.error.user_email);
                    $("#user_pass_error").html(data.error.user_pass);
                    $("#user_confirm_pass_error").html(data.error.user_confirm_pass);
                    // $(".print-error-msg").html(data.error);
                    console.log(data.error);
                }
            }
        });
        return false;
    });

    // login user

    $('#loginBtn').on('click',function(){

        var user_name = $('#lusername').val();
        var user_pass = $('#lpassword').val();

        $.ajax({
            type : "POST",
            url  : "<?php echo base_url('login/login_validation') ?>",
            dataType : "JSON",
            data : {user_name:user_name,user_pass:user_pass},
            success: function(data){
            if($.isEmptyObject(data.error)){
                    $("#lusername_error").html("");
                    $("#lpassword_error").html("");

                    window.location.href = data.redirect;

                }else{
                    $("#lusername_error").html(data.error.user_name);
                    $("#lpassword_error").html(data.error.user_pass);
                    
                    console.log(data.error);
                }
            }
        });
        return false;
    });

});
</script>
<style>
    .text-danger{
        color:red;
        font-size: 12px;
        position: relative;
        left: 8%;
        top: 3px;
    }
</style>