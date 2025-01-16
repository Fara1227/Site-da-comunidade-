<?php
// Database configuration
$host = 'localhost'; // Database host
$dbname = 'db_site'; // Database name
$username = 'root'; // Database username
$password = ''; // Database password

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare and execute the SQL statement
    $stmt = $pdo->query("SELECT * FROM products"); // Assuming you have a 'products' table
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Database connection failed: " . $e->getMessage();
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loja</title>
    <link rel="stylesheet" href="css/loja.css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
</head>
<body>
<div id="wrapper">
    <div class="cart-icon-top"></div>
    <div class="cart-icon-bottom"></div>
    <div  id="checkout"><a href='checkout.php'>CHECKOUT</a></div>
    <div id="info">
        <p class="i1"></p>
    </div>
    <div id="header">    
        <ul>
            <li><img id="img" src="imagens/LogoPCM.png" width="30cm" height="50cm"></img></li>
        <li><a href="index.php">Home</a></li>
             <li><a href="log_in.php">Chat</a></li>
             <li><a href="loja.php">Loja</a></li>
             <li><a target="_blank" href="https://www.cuf.pt/saude-a-z/sindrome-de-asperger">About</a></li>
             <li><a href="log_in.php">login</a></li>                                           
        </ul>		
    </div>

    <div id="sidebar">
        <h3>CART</h3>
        <div id="cart">
            <span class="empty">No items in cart.</span>       
        </div>
        
        <h3>CATEGORIES</h3>
        <div class="checklist categories">
            <ul>
                <li><a href=""><span></span>New Arrivals</a></li>
                <li><a href=""><span></span>Accessories</a></li>
                <li><a href=""><span></span>Bags</a></li>
                <li><a href=""><span></span>Dresses</a></li>
                <li><a href=""><span></span>Jackets</a></li>
                <li><a href=""><span></span>Jewelry</a></li>
                <li><a href=""><span></span>Shoes</a></li>
                <li><a href=""><span></span>Shirts</a></li>
                <li><a href=""><span></span>Sweaters</a></li>
                <li><a href=""><span></span>T-shirts</a></li>
            </ul>
        </div>
        
        <h3>COLORS</h3>
        <div class="checklist colors">
            <ul>
                <li><a href=""><span></span>Beige</a></li>
                <li><a href=""><span style="background:#222"></span>Black</a></li>
                <li><a href=""><span style="background:#6e8cd5"></span>Blue</a></li>
                <li><a href=""><span style="background:#f56060"></span>Brown</a></li>
                <li><a href=""><span style="background:#44c28d"></span>Green</a></li>
            </ul>
            <ul>
                <li><a href=""><span style="background:#999"></span>Grey</a></li>
                <li><a href=""><span style="background:#f79858"></span>Orange</a></li>
                <li><a href=""><span style="background:#b27ef8"></span>Purple</a></li>
                <li><a href=""><span style="background:#f56060"></span>Red</a></li>
                <li><a href=""><span style="background:#fff;border: 1px solid #e8e9eb;width:13px;height:13px;"></span>White</a></li>
            </ul>        
        </div>
        
        <h3>SIZES</h3>
        <div class="checklist sizes">
            <ul>
                <li><a href=""><span></span>XS</a></li>
                <li><a href=""><span></span>S</a></li>
                <li><a href=""><span></span>M</a></li>
            </ul>
            <ul>
                <li><a href=""><span></span>L</a></li>
                <li><a href=""><span></span>XL</a></li>
                <li><a href=""><span></span>XXL</a></li>
            </ul>        
        </div>
        
        <h3>PRICE RANGE</h3>
        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/245657/price-range.png" alt="" />
    </div>

    <div id="grid-selector">
        <div id="grid-menu">
            View:
            <ul>           	   
                <li class="largeGrid"><a href=""></a></li>
                <li class="smallGrid"><a class="active" href=""></a></li>
            </ul>
        </div>
        Showing 1–9 of <?php echo count($products); ?> results 
    </div>

    <div id="grid">
        <?php foreach ($products as $product): ?>
            <div class="product">
                <div class="info-large">
                    <h4><?php echo htmlspecialchars($product['name']); ?></h4>
                    <div class="price-big">
                        <span>$<?php echo number_format($product['price'], 2); ?></span>
                    </div>
                    <h3>COLORS</h3>
                    <div class="colors-large">
                        <ul>
                            <li><a href="" style="background:#222"><span></span></a></li>
                            <li><a href="" style="background:#6e8cd5"><span></span></a></li>
                            <li><a href="" style="background:#f56060"><span></span></a></li>
                            <li><a href="" style="background:#44c28d"><span></span></a></li>
                        </ul> 
                    </div>
                    <h3>SIZE</h3>
                    <div class="sizes-large">
                        <span>XS</span>
                        <span>S</span>
                        <span>M</span>
                        <span>L</span>
                        <span>XL</span>
                        <span>XXL</span>
                    </div>
                    <button class="add-cart-large">Add To Cart</button>                          
                </div>
                <div class="make3D">
                    <div class="product-front">
                        <div class="shadow"></div>
                        <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" />
                        <div class="image_overlay"></div>
                        <div class="add_to_cart">Add to cart</div>
                        <div class="view_gallery">View gallery</div>
                        <div class="stats">        	
                            <div class="stats-container">
                                <span class="product_price">$<?php echo number_format($product['price'], 2); ?></span>
                                <span class="product_name"><?php echo htmlspecialchars($product['name']); ?></span>    
                                <p><?php echo htmlspecialchars($product['description']); ?></p>                                            
                                <div class="product-options">
                                    <strong>SIZES</strong>
                                    <span>XS, S, M, L, XL, XXL</span>
                                    <strong>COLORS</strong>
                                    <div class="colors">
                                        <div class="c-blue"><span></span></div>
                                        <div class="c-red"><span></span></div>
                                        <div class="c-white"><span></span></div>
                                        <div class="c-green"><span></span></div>
                                    </div>
                                </div>                       
                            </div>                         
                        </div>
                    </div>
                    <div class="product-back">
                        <div class="shadow"></div>
                        <div class="carousel">
                            <ul class="carousel-container">
                                <li><img src="<?php echo htmlspecialchars($product['image']); ?>" alt="" /></li>
                                <li><img src="<?php echo htmlspecialchars($product['image2']); ?>" alt="" /></li>
                                <li><img src="<?php echo htmlspecialchars($product['image3']); ?>" alt="" /></li>
                                <!-- Add more images if available -->
                            </ul>
                            <div class="arrows-perspective">
                                <div class="carouselPrev">
                                    <div class="y"></div>
                                    <div class="x"></div>
                                </div>
                                <div class="carouselNext">
                                    <div class="y"></div>
                                    <div class="x"></div>
                                </div>
                            </div>
                        </div>
                        <div class="flip-back">
                            <div class="cy"></div>
                            <div class="cx"></div>
                        </div>
                    </div>	  
                </div>	
            </div>
        <?php endforeach; ?>
    </div>
</div>


<footer class="credit">Author: A Place call Me - Distributed By: A Place call Me><br>
                       Todos o dinheiro ganho sera doado
</footer>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="javascript/loja.js"></script>

</body>
</html>