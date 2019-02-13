
<div class="container">

    <section>
        <div id="container_demo" >
            <a class="hiddenanchor" id="toregister"></a>
            <a class="hiddenanchor" id="tologin"></a>
            <div id="wrapper">
                <div id="login" class="animate form">
                    <form  action="mysuperscript.php" autocomplete="on">
                        <h1>Log in</h1>
                        <p>
                            <label for="username" class="uname" data-icon="u" > Your email or username </label>
                            <input id="username" name="username" required="required" type="text" placeholder="myusername or mymail@mail.com"/>
                        </p>
                        <p>
                            <label for="password" class="youpasswd" data-icon="p"> Your password </label>
                            <input id="password" name="password" required="required" type="password" placeholder="eg. X8df!90EO" />
                        </p>
                        <p class="login button">
                            <input type="submit" value="Login" />
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
                            <span class="error text-danger" id="user_name_error">Hello</span>
                        </p>
                        <!--<p>
                            <label for="emailsignup" class="youmail" data-icon="e" > Your email</label>
                            <input id="emailsignup" name="user_email" required="required" type="email" placeholder="mysupermail@mail.com"/>
                        <?php echo form_error('user_email', '<span class="error text-danger">', '</span>'); ?>
                        </p>
                        <p>
                            <label for="passwordsignup" class="youpasswd" data-icon="p">Your password </label>
                            <input id="passwordsignup" name="user_pass" required="required" type="password" placeholder="eg. X8df!90EO"/>
                        <?php echo form_error('user_pass', '<span class="error text-danger">', '</span>'); ?>
                        </p>
                        <p>
                            <label for="passwordsignup_confirm" class="youpasswd" data-icon="p">Please confirm your password </label>
                            <input id="passwordsignup_confirm" name="user_confirm_pass" required="required" type="password" placeholder="eg. X8df!90EO"/>
                        <?php echo form_error('user_confirm_pass', '<div class="error text-danger">', '</div>'); ?>
                        </p>-->
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
    $('#sign_up_btn').on('click',function(){
        var user_name = $('#user_name').val();
        $.ajax({
            type : "POST",
            url  : "<?php echo base_url('login/register_user')?>",
            dataType : "JSON",
            data : {user_name:user_name},
            success: function(data){
                
            },
            error: function(data){
                var data= $("#user_name_error").text("Samiul");
                console.log(data);
                
            }
        });
        return false;
    });

});
</script>
<style>
    .text-danger{
        color:red;
    }
</style>