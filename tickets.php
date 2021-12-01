<?php

function ticket($tag,$team1,$logo1,$team2,$logo2,$location,$date,$price,$product_id){

$element="
<form action=\"football.php\" method=\"post\">
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
                <button name=\"favorite\" class=\"addFavorite\">add to favorite</button>
            </div>
    </div>
</form>
";
echo $element;
}


function cartTicket($team1,$logo1,$team2,$logo2,$location,$date,$price,$product_id){

$element="
<form action=\"cart.php?action=remove&id=$product_id\" method=\"post\">
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
                <button type=\"submit\" name=\"remove\" class=\"remove\">remove</button>
            </div>
    </div>
</form>
";
echo $element;
}
?>