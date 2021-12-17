<div class="login-page">
    <form class="login-block" method="post">
        <div class="login-container">
            <h1>Welcome</h1>
            <div class="textField">
                <input required type="text" name=nickname placeholder="Nickname" class="input-box">
            </div>

            <div class="textField">
                <input required type="email" name=mail placeholder="Email" class="input-box">
            </div>

            <div class="textField">
                <input required type="password" name=password placeholder="Password" class="user-password input-box">
            </div>

            <div class="textField">
                <input required type="password" name=password-repeate placeholder="Password"
                       class="user-password-repeate input-box">
            </div>

            <input type="submit" name="createUser" class="registration-create-user button-long" value="create"/>

            <div class="login-footer">
                <p>Already have account on Intelpos?</p>
                <a href="/login" class="button-short">sign in</a>
            </div>
        </div>
    </form>
</div>