<div class="login-page">

    <form action="/authorization" class="login-block" method="post">
        <div class="login-container">
            <h1>Welcome</h1>
            <div class="textField">
                <input required type="text" name="nickname" placeholder="Nickname" class="input-box">
            </div>

            <div class="textField">
                <input required type="password" name="password" placeholder="Пароль" class="input-box">
            </div>

            <button type="submit" name="login" class="login-sign-in button-long">sign in</button>

            <div class="login-footer">
                <p>No account on Intelpos?</p>
                <a href="/registration" class="button-short">create</a>
            </div>
        </div>
    </form>
</div>