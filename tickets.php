<?php
//session_start();
$_SESSION['ticketNR']=0;
function ticket($table,$tag,$team1,$logo1,$team2,$logo2,$location,$date,$price,$product_id){
if($table == "tennis.php"){
    $nr=$_SESSION['ticketNR'];
    $element="
    <form action=\"$table\" method=\"post\">
        <div class=\"ticket\" id=\"$nr\">
                <div class=\"info\">
                    <div class=\"teams\">
                        <ul>
                            <li>$team1</li>
                            <li><img style=\"height:17px; margin-bottom:4px;\" src=\"$logo1\"></li>
                            <li>vs</li>
                            <li><img style=\"height:17px; margin-bottom:4px;\" src=\"$logo2\"></li>
                            <li>$team2</li>
                        </ul>
                    </div>
                    <div class=\"locatie\">$location</div>
                    <div class=\"data\">$date</div>  
                </div>
                <h3>$$price</h3>
                <div class=\"addButtons\">
                    <button type=\"submit\" name=\"add\" class=\"addToCart\">add to cart</button>
                    <input type=\"hidden\" name=\"product_id\" value=\"$product_id\">
                    <input type=\"hidden\" name=\"tag\" value=\"$tag\">
                    <input type=\"hidden\" name=\"nr\" value=\"$nr\">
                    <button name=\"favorite\" class=\"addFavorite\">add to favorite</button>
                </div>
        </div>
    </form>
    ";
    $_SESSION['ticketNR']=$_SESSION['ticketNR']+1;
}
else{
    $nr=$_SESSION['ticketNR'];
    $element="
    <form action=\"$table\" method=\"post\">
        <div class=\"ticket\" id=\"$nr\">
                <div class=\"info\">
                    <div class=\"teams\">
                        <ul>
                            <li>$team1</li>
                            <li><img src=\"$logo1\"></li>
                            <li>vs</li>
                            <li><img src=\"$logo2\"></li>
                            <li>$team2</li>
                        </ul>
                    </div>
                    <div class=\"locatie\">$location</div>
                    <div class=\"data\">$date</div>  
                </div>
                <h3>$$price</h3>
                <div class=\"addButtons\">
                    <button type=\"submit\" name=\"add\" class=\"addToCart\">add to cart</button>
                    <input type=\"hidden\" name=\"product_id\" value=\"$product_id\">
                    <input type=\"hidden\" name=\"tag\" value=\"$tag\">
                    <input type=\"hidden\" name=\"nr\" value=\"$nr\">
                    <button name=\"favorite\" class=\"addFavorite\">add to favorite</button>
                </div>
        </div>
    </form>
    ";
    $_SESSION['ticketNR']=$_SESSION['ticketNR']+1;
}
echo $element;
}

function ticketAdmin($table,$tag,$team1,$logo1,$team2,$logo2,$location,$date,$price,$product_id){
    if($table == "tennis"){
    $element="
    <form action=\"admin.php\" method=\"post\">
        <div class=\"ticket\">
                <div class=\"info\">
                    <div class=\"teams\">
                        <ul>
                            <li>$team1</li>
                            <li><img style=\"height:17px; margin-bottom:4px;\" src=\"$logo1\"></li>
                            <li>vs</li>
                            <li><img style=\"height:17px; margin-bottom:4px;\" src=\"$logo2\"></li>
                            <li>$team2</li>
                        </ul>
                    </div>
                    <div class=\"locatie\">$location</div>
                    <div class=\"data\">$date</div>  
                </div>
                <h3>$$price</h3>
                <div class=\"addButtons\">
                    <button type=\"submit\" name=\"edit\" class=\"addToCart\">edit</button>
                    <input type=\"hidden\" name=\"product_id\" value=\"$product_id\">
                    <input type=\"hidden\" name=\"tag\" value=\"$tag\">
                    <input type=\"hidden\" name=\"table\" value=\"$table\">
                    <button name=\"remove\" class=\"addFavorite\">remove</button>
                </div>
        </div>
    </form>
    ";
}
else{
    $element="
    <form action=\"admin.php\" method=\"post\">
        <div class=\"ticket\">
                <div class=\"info\">
                    <div class=\"teams\">
                        <ul>
                            <li>$team1</li>
                            <li><img src=\"$logo1\"></li>
                            <li>vs</li>
                            <li><img src=\"$logo2\"></li>
                            <li>$team2</li>
                        </ul>
                    </div>
                    <div class=\"locatie\">$location</div>
                    <div class=\"data\">$date</div>  
                </div>
                <h3>$$price</h3>
                <div class=\"addButtons\">
                    <button type=\"submit\" name=\"edit\" class=\"addToCart\">edit</button>
                    <input type=\"hidden\" name=\"product_id\" value=\"$product_id\">
                    <input type=\"hidden\" name=\"tag\" value=\"$tag\">
                    <input type=\"hidden\" name=\"table\" value=\"$table\">
                    <button name=\"remove\" class=\"addFavorite\">remove</button>
                </div>
        </div>
    </form>
    ";
}
echo $element;
}


function cartTicket($table,$tag,$team1,$logo1,$team2,$logo2,$location,$date,$price,$product_id,$number){
if(isset($_SESSION['tickets'])){
    if (!str_contains($_SESSION['tickets'], $product_id.$tag)) 
        $_SESSION['tickets']=$_SESSION['tickets']." ".$product_id.$tag.$number;
}
else
    $_SESSION['tickets']=$product_id.$tag.$number;
    
$price=$price*$number;
if($table == "tennis.php"){
    $element="
    <form action=\"cart.php?action=remove&id=$product_id&tag=$tag\" method=\"post\">
        <div class=\"ticket\">
                <div class=\"info\">
                    <div class=\"teams\">
                        <ul>
                            <li>$team1</li>
                            <li><img style=\"height:17px; margin-bottom:4px;\" src=\"$logo1\"></li>
                            <li>vs</li>
                            <li><img style=\"height:17px; margin-bottom:4px;\" src=\"$logo2\"></li>
                            <li>$team2</li>
                        </ul>
                    </div>
                    <div class=\"locatie\">$location</div>
                    <div class=\"data\">$date</div>  
                </div>
                <div class=\"pret\" style=\"background-color: #111111;\">
                    <div class=\"price\"><h3>$$price</h3></div>
                    <div class=\"num\">
                        <ul class=\"number\">
                            <li class=\"numberEl\"><button type=\"submit\" name=\"minus\">-</button></li>
                            <li class=\"numberEl\">$number</li>
                            <li class=\"numberEl\"><button type=\"submit\" name=\"plus\">+</button></li>
                        </ul>
                    </div>
                </div>
                <div class=\"addButtons\">
                    <input type=\"hidden\" name=\"product_id\" value=\"$product_id\">
                    <input type=\"hidden\" name=\"tag\" value=\"$tag\">
                    <button type=\"submit\" name=\"remove\" class=\"remove\">remove</button>
                </div>
        </div>
    </form>
    ";
}
else{
    $element="
    <form action=\"cart.php?action=remove&id=$product_id&tag=$tag\" method=\"post\">
        <div class=\"ticket\">
                <div class=\"info\">
                    <div class=\"teams\">
                        <ul>
                            <li>$team1</li>
                            <li><img src=\"$logo1\"></li>
                            <li>vs</li>
                            <li><img src=\"$logo2\"></li>
                            <li>$team2</li>
                        </ul>
                    </div>
                    <div class=\"locatie\">$location</div>
                    <div class=\"data\">$date</div>  
                </div>
                <div class=\"pret\" style=\"background-color: #111111;\">
                    <div class=\"price\"><h3>$$price</h3></div>
                    <div class=\"num\">
                        <ul class=\"number\">
                            <li class=\"numberEl\"><button type=\"submit\" name=\"minus\">-</button></li>
                            <li class=\"numberEl\">$number</li>
                            <li class=\"numberEl\"><button type=\"submit\" name=\"plus\">+</button></li>
                        </ul>
                    </div>
                </div>
                <div class=\"addButtons\">
                    <input type=\"hidden\" name=\"product_id\" value=\"$product_id\">
                    <input type=\"hidden\" name=\"tag\" value=\"$tag\">
                    <button type=\"submit\" name=\"remove\" class=\"remove\">remove</button>
                </div>
        </div>
    </form>
    "; 
}
echo $element;
}

function favTicket($table,$tag,$team1,$logo1,$team2,$logo2,$location,$date,$price,$product_id){
if($table == "tennis.php"){
    $element="
    <form action=\"favorite.php?action=remove&id=$product_id&tag=$tag\" method=\"post\">
        <div class=\"ticket\">
                <div class=\"info\">
                    <div class=\"teams\">
                        <ul>
                            <li>$team1</li>
                            <li><img style=\"height:17px; margin-bottom:4px;\" src=\"$logo1\"></li>
                            <li>vs</li>
                            <li><img style=\"height:17px; margin-bottom:4px;\" src=\"$logo2\"></li>
                            <li>$team2</li>
                        </ul>
                    </div>
                    <div class=\"locatie\">$location</div>
                    <div class=\"data\">$date</div>  
                </div>
                <h3>$$price</h3>
                <div class=\"addButtons\">
                    <button type=\"submit\" name=\"add\" class=\"addToCart\">add to cart</button>
                    <input type=\"hidden\" name=\"product_id\" value=\"$product_id\">
                    <input type=\"hidden\" name=\"tag\" value=\"$tag\">
                    <button type=\"submit\" name=\"remove\" class=\"remove\">remove</button>
                </div>
        </div>
    </form>
    ";
}
else{
    $element="
    <form action=\"favorite.php?action=remove&id=$product_id&tag=$tag\" method=\"post\">
        <div class=\"ticket\">
                <div class=\"info\">
                    <div class=\"teams\">
                        <ul>
                            <li>$team1</li>
                            <li><img src=\"$logo1\"></li>
                            <li>vs</li>
                            <li><img src=\"$logo2\"></li>
                            <li>$team2</li>
                        </ul>
                    </div>
                    <div class=\"locatie\">$location</div>
                    <div class=\"data\">$date</div>  
                </div>
                <h3>$$price</h3>
                <div class=\"addButtons\">
                    <button type=\"submit\" name=\"add\" class=\"addToCart\">add to cart</button>
                    <input type=\"hidden\" name=\"product_id\" value=\"$product_id\">
                    <input type=\"hidden\" name=\"tag\" value=\"$tag\">
                    <button type=\"submit\" name=\"remove\" class=\"remove\">remove</button>
                </div>
        </div>
    </form>
    ";
}
echo $element;
}

function orderTicket($table,$tag,$team1,$logo1,$team2,$logo2,$location,$date,$price,$product_id,$number){
if($table == "tennis.php"){
    $nr=$_SESSION['ticketNR'];
    $element="
    <div class=\"oticket\" id=\"$nr\">
            <div class=\"oinfo\">
                <div class=\"oteams\">
                    <ul>
                        <li>$team1</li>
                        <li><img style=\"height:17px; margin-bottom:4px;\" src=\"$logo1\"></li>
                        <li>vs</li>
                        <li><img style=\"height:17px; margin-bottom:4px;\" src=\"$logo2\"></li>
                        <li>$team2</li>
                    </ul>
                </div>
                <div class=\"locatie\">$location</div>
                <div class=\"data\">$date</div>  
            </div>
            <h3>$$price</h3>
            <h3 class=\"multiply\" style=\"padding-left: 20%;><span style=\"font-family: Arial, Helvetica, sans-serif;text-transform: lowercase;  background-color: #111111;
\">x</span><span style=\"font-size:30px;  background-color: #111111;
\">$number</span></h3>
    </div>
    ";
    $_SESSION['ticketNR']=$_SESSION['ticketNR']+1;
}
else{
    $nr=$_SESSION['ticketNR'];
    $element="
    <div class=\"oticket\" id=\"$nr\">
            <div class=\"oinfo\">
                <div class=\"oteams\">
                    <ul>
                        <li>$team1</li>
                        <li><img src=\"$logo1\"></li>
                        <li>vs</li>
                        <li><img src=\"$logo2\"></li>
                        <li>$team2</li>
                    </ul>
                </div>
                <div class=\"locatie\">$location</div>
                <div class=\"data\">$date</div>  
            </div>
            <h3>$$price</h3>
            <h3 class=\"multiply\" style=\"padding-left: 20%;\"><span style=\"font-family: Arial, Helvetica, sans-serif;text-transform: lowercase;  background-color: #111111;
\">x</span><span style=\"font-size:30px;  background-color: #111111;
\">$number</span></h3>
    </div>
    ";
    $_SESSION['ticketNR']=$_SESSION['ticketNR']+1;
}
echo $element;
}

?>