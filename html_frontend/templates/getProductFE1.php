<?php
    $path = dirname(getcwd(),2).'\database'.'\dbhelper.php';
    require_once $path;
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
	<?php
    
    if(isset($_GET['name'])){
        $d = $_GET['name'];
    }
    if(isset($_GET['type'])){
        if($_GET['type']=="all"){
            $w = "";
        }else
        $w = $_GET['type'];;
    } 
    if(isset($_GET['low'])){
        if($_GET['low']==""){
            $e = 0;
        }else
        $e = $_GET['low'];
    }
    if(isset($_GET['high'])){
        if($_GET['high']==""){
            $r = 0;
        }else
        $r = $_GET['high'];
    }
        if($w=="all"){
            $sql = 'select * from product where ProductName like "%'.$d.'%" limit 0,8';
        }else{
            if($r==0&&$e==0){
                $sql = 'select * from product where ProductName like "%'.$d.'%" AND ProductType like "%'.$w.'%" limit 0,8';

            }else{
                if($e!=0&&$r==0){
                    $sql = 'select * from product where ProductName like "%'.$d.'%" AND ProductType like "%'.$w.'%" AND ProductPrice >= '.$e.' limit 0,8';
                }else if($r!=0&&$e==0){
                    $sql = 'select * from product where ProductName like "%'.$d.'%" AND ProductType like "%'.$w.'%" AND ProductPrice <= '.$r.' limit 0,8';
                }else{
                    $sql = 'select * from product where ProductName like "%'.$d.'%" AND ProductType like "%'.$w.'%" AND ProductPrice >= '.$e.' AND ProductPrice <= '.$r.' limit 0,8';

                }
            }
        }
	  $ListProduct = executeResult($sql);
        foreach($ListProduct as $Product){
            echo '<div class="product-card">';
            echo '<div class="badge">Hot</div>';
            echo '<div class="product-tumb">';
            echo '<img src=';
            echo '"../../pic/product/'.$Product['ProductThumbnail'].'">';
            echo '</div>';
            echo '<div class="product-details">';
            echo '<span class="product-catagory">'.$Product['ProductType'].'</span>';
            echo '<h4><a href="">'.$Product['ProductName'].'</a></h4>';
            echo '<div class="product-bottom-details">';
            echo '<div class="product-price">$'.$Product['ProductPrice'].'</div>';
            echo '<div class="product-links">';
            echo '<a onClick=\'window.open("product-detail.php?productId='.$Product['ProductID'].'","_self")\'><i class="fa fa-shopping-cart"></i></a>';

            echo '<a href=""><i class="fa fa-heart"></i></a>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        } 
	  
	?>
</body>
</html>