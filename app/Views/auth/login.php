<!DOCTYPE html>
<html>
<head>
<title>Login</title>

<style>

body{
margin:0;
font-family:Segoe UI;

/* BACKGROUND GAMBAR */
background: url('/images/apotek.jpg') no-repeat center center;
background-size: cover;
height:100vh;

display:flex;
justify-content:center;
align-items:center;
}

/* BOX LOGIN */
.login{
width:350px;
background: rgba(255,255,255,0.7);
padding:30px;
text-align:center;
border-radius:20px;

/* efek blur */
backdrop-filter: blur(8px);
}

/* LOGO */
.logo{
width:120px;
margin-bottom:20px;
}

/* TITLE */
.login h2{
margin-bottom:20px;
}

/* INPUT */
.input-group{
text-align:left;
margin-bottom:15px;
}

.input-group label{
font-weight:bold;
}

.input-group input{
width:100%;
padding:12px;
border-radius:10px;
border:none;
margin-top:5px;
background:#eee;
box-sizing:border-box;
}

/* BUTTON */
button{
margin-top:10px;
padding:10px;
width:100%;
border:none;
border-radius:20px;
background:#ddd;
font-weight:bold;
cursor:pointer;
}

button:hover{
background:#ccc;
}

/* FORGOT */
.forgot{
margin-top:10px;
font-size:13px;
text-align:left;
}

</style>

</head>

<body>

<div class="login">

<!-- LOGO -->
<img src="/images/logo.png" class="logo">

<h2>Login Apotek</h2>

<form action="/login" method="post">

<div class="input-group">
<label>Username</label>
<input type="text" name="username">
</div>

<div class="input-group">
<label>Password</label>
<input type="password" name="password">
</div>

<button>LOG IN</button>

<div class="forgot">Forgot Password</div>

</form>

</div>

</body>
</html>