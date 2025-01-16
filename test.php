<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A Place Called Me</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #fff;
            color: #000;
        }

        #header{
	height:92px; 
	background:#fff url("https://s3-us-west-2.amazonaws.com/s.cdpn.io/245657/header-icons.png") 1448px -2px no-repeat;
	border-bottom:1px solid #eee;
}
#header ul{padding:33px 0 0 45px;}
#header li{
	list-style:none;
	float:left;
	margin-right:30px;	
}
#header li a{
	font-weight:700;
	color:#333;
	font-size:14px;	
	text-decoration:none;
	text-transform:uppercase;
	letter-spacing:1px;
}
#headerli a:hover{
	color:#000;
	cursor:pointer;
}

        .logo {
            font-size: 24px;
            font-weight: bold;
        }

        .nav-links {
            display: flex;
            gap: 20px;
        }

        .auth-links {
            display: flex;
            gap: 15px;
        }

        main {
            text-align: center;
            padding: 40px 20px;
        }

        .hero-image {
            width: 100%;
            max-width: 800px;
            height: auto;
            margin: 20px auto;
            border-radius: 15px;
            overflow: hidden;
        }

        .button-container {
            margin: 20px 0;
        }

        .cta-button {
            background-color: #000;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            font-size: 16px;
            border-radius: 5px;
        }

        .section {
            margin: 40px 0;
        }

        .section-title {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .section-content {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 20px;
        }

        .box {
            width: 300px;
            height: 150px;
            background-color: #ddd;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 18px;
            color: #666;
        }

        footer {
            background-color: #000;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        .footer-links {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 10px;
        }

        .footer-links a {
            color: #fff;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">A Place Called Me</div>
        <nav>
        <div id="header">    
        <ul>
            <li><img id="img" src="imagens/LogoPCM.png" width="50cm" height="80cm"></img></li>
        <li><a href="index.php">Home</a></li>
             <li><a href="#chat">Chat</a></li>
             <li><a href="loja.php">Loja</a></li>
             <li><a href="contacts.php">Contact</a></li>
             <li><a href="log_in.php">login</a></li>
             <li><a href="https://www.cuf.pt/saude-a-z/sindrome-de-asperger">About</a></li>                                           
        </ul>		
    </div> 
        </nav>
        <div class="auth-links">
            <a href="#">Log In</a>
            <a href="#">Sign In</a>
        </div>
    </header>

    <main>
        <h1>A Place Called Me</h1>
        <div class="hero-image">
            <img src="/mnt/data/Desktop%20-%201.png" alt="Hero" style="width: 100%; height: auto; border-radius: 15px;">
        </div>
        <div class="button-container">
            <p>Not Working? Watch Video</p>
            <a href="#" class="cta-button">Here!</a>
        </div>

        <div class="section">
            <h2 class="section-title">Loja</h2>
            <div class="section-content">
                <div class="box">Loja</div>
            </div>
        </div>

        <div class="section">
            <h2 class="section-title">News</h2>
            <div class="section-content">
                <div class="box">News 1</div>
                <div class="box">News 2</div>
                <div class="box">News 3</div>
                <div class="box">News 4</div>
            </div>
        </div>
    </main>

    <footer>
        <p>Contact us:</p>
        <div class="footer-links">
            <a href="#">Instagram</a>
            <a href="#">Email</a>
        </div>
    </footer>
</body>
</html>

