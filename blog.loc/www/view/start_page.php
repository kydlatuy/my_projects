<?php if (isset($_SESSION['islogin'])):?>
<a href="/profile">PROFILE</a>
<?php endif; ?>
<?php if (!isset($_SESSION['islogin'])): ?>
<a href="/auth/login">LOGIN</a>
<a href="/auth/register">REGISTER</a>
<?php endif; ?>