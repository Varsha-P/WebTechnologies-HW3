<html>
<head>
<style>
	sup {
	font-size: 30px;
	}
	
	ab { 
		font: "georgia";
	}
	
</style>
	<script type="text/javascript">
		function clear_form()
		{
			//window.location.assign("http://cs-server.usc.edu:22384/check.php");
			 window.location="http://cs-server.usc.edu:22384/check.php";
		}
		
		function is_all_blank(def)
		{
			return !(/[^\t\n\r ]/.test(def));
		}
		function check_price_validation(val)
		{
			return (/[\d\*/./?\d\*]/.test(val));
		}
		function check_values(abc)
		{
			//alert(abc.key_words.value);
		if(is_all_blank(abc.key_words.value))
		{
			alert("Key words is a required field. Please enter value for Key Words!");
			return false;
		}
			else
			{
				//alert("hello");
				if(!is_all_blank(abc.from.value)&&is_all_blank(abc.to.value))
				{
				var i = parseFloat(abc.from.value);
				if(!check_price_validation(i))
				{
					alert("Wrong format for 'from' field! Has to be a positive number(integer/decimal)");
					return false;
				}
				
				}
				else if(!is_all_blank(abc.to.value)&&is_all_blank(abc.from.value))
				{
					var j = parseFloat(abc.to.value);
					if(!check_price_validation(j))
					{
						alert("Wrong format for 'to' field! Has to be a positive number(integer/decimal)");
						return false;
					}
				}
				else if(!is_all_blank(abc.from.value)&&!is_all_blank(abc.to.value))
				{
				var i = parseFloat(abc.from.value);
				if(!check_price_validation(i))
				{
					alert("Wrong format for 'from' field! Has to be a positive number(integer/decimal)");
					return false;
				}	
					var j = parseFloat(abc.to.value);
					if(!check_price_validation(j))
					{
						alert("Wrong format for 'to' field! Has to be a positive number(integer/decimal)");
						return false;
					}
					else
					{
						if(i>j)
						{
							alert("Value of 'from' field cannot be greater than the value of 'to' field!!!");
							return false;
						}
					}
				}
				if(!is_all_blank(abc.days.value))
				{
					var x = parseInt(abc.days.value);
				if(!x>=1)
				{
					alert("Minimum 1 day(s)");
					return false;
				}
				}
				return true;
				   }	
		}
	</script>

	</head>	<body>
	<br/>
	<br/>
	<pre>                                                                          <img src="./ebay.jpg" alt="ebay" width="200px" height="100px"/><sup><sup><sup><sup><sup><ab><b>Shopping</b></ab></sup></sup></sup></sup></sup></pre>
<form method="post" name="form1" action="">
	<!--<div width=400px><fieldset style=" border: 2px groove; margin: 0 auto;">-->
		<table align="center" style="border:3px solid black; padding-top:10px; padding-left:10px;padding-right:25px;padding-bottom:15px;">
			<tr><td><b>Key Words*:</b>	</td>
				<td><input type="text" size=100 name="key_words" value="<?php echo isset($_POST["key_words"]) ? $_POST["key_words"] : "" ?>"></td></tr> 
	<tr><td><hr/></td><td><hr/></td></tr>
			<tr><td><b>Price Range:</b></td><td>from $<input type="text" name="from" size="8" value="<?php echo isset($_POST["from"]) ? $_POST["from"] : "" ?>"> to $<input type="text" name="to" size="8" value="<?php echo isset($_POST["to"]) ? $_POST["to"] : "" ?>"> </td></tr>
			<tr><td><hr/></td><td><hr/></td></tr>
			
			<pre><tr><td><b>Condition:</b></td><td><input type="checkbox" name="condition[]" value="new" <?php if(isset($_POST["condition"])):foreach ($_POST["condition"] as $item) {if ($item == "new"){ echo "checked";break;}}endif; ?>>New                             <input type="checkbox" name="condition[]" value="used" <?php if(isset($_POST["condition"])):foreach ($_POST["condition"] as $item) {if ($item == "used"){ echo "checked";break;}}endif; ?>>Used                             <input type="checkbox" name="condition[]" value="very_good" <?php if(isset($_POST["condition"])):foreach ($_POST["condition"] as $item) {if ($item == "very_good"){ echo "checked";break;}}endif; ?>>Very Good                               <input type="checkbox" name="condition[]" value="good" <?php if(isset($_POST["condition"])):foreach ($_POST["condition"] as $item) {if ($item == "good"){ echo "checked";break;}}endif; ?>>Good                                   <input type="checkbox" name="condition[]" value="acceptable" <?php if(isset($_POST["condition"])):foreach ($_POST["condition"] as $item) {if ($item == "acceptable"){ echo "checked";break;}}endif; ?>>Acceptable</td></tr></pre>
			<tr><td><hr/></td><td><hr/></td></tr>
			<pre><tr><td><b>Buying formats:</b></td><!--&nbsp;&nbsp;--><td><input type="checkbox" name="buying_formats[]" value="buy_it_now" <?php if(isset($_POST["buying_formats"])):foreach ($_POST["buying_formats"] as $item) {if ($item == "buy_it_now"){ echo "checked";break;}}endif; ?>>Buy It Now         <input type="checkbox" name="buying_formats[]" value="auction" <?php if(isset($_POST["buying_formats"])):foreach ($_POST["buying_formats"] as $item) {if ($item == "auction"){ echo "checked";break;}}endif; ?>>Auction           <input type="checkbox" name="buying_formats[]" value="classified_ads" <?php if(isset($_POST["buying_formats"])):foreach ($_POST["buying_formats"] as $item) {if ($item == "classified_ads"){ echo "checked";break;}}endif; ?>>Classified Ads</td></tr></pre> <!--modified the spelling here-->
			<tr><td><hr/></td><td><hr/></td></tr>
			<tr><td><b>Seller:</b></td><td><input type="checkbox" name="return_accepted[]" value="returnAccepted" <?php if(isset($_POST["returnAccepted"])) echo "checked='checked'"; ?>>Return Accepted</td></tr>
			<tr><td><hr/></td><td><hr/></td></tr>
			<tr><td><b>Shipping:</b></td><td><input type="checkbox" name="free_shipping[]" value="free_ship" <?php if(isset($_POST["free_shipping"])) echo "checked='checked'"; ?>>Free Shipping</td></tr>
			<tr><td></td><td><input type="checkbox" name="expedited_shipping_available[]" value="Expedited" <?php if(isset($_POST["expedited_shipping_available"])) echo "checked='checked'"; ?>>Expedited shipping available</td></tr>
			<tr><td></td><td>Max handling time (days): <input type="text" name="days" size="8" value="<?php echo isset($_POST["days"]) ? $_POST["days"] : "" ?>"></td></tr>
			<tr><td><hr/></td><td><hr/></td></tr>
			<tr><td><b>Sort by:</b></td><td><select name="sort_by"><option selected value="best_match" <?php if(isset($_POST["sort_by"])&& ($_POST["sort_by"])== "best_match") echo "selected='selected'"; ?>>Best Match</option><option value="price_high_f" <?php if(isset($_POST["sort_by"])&& ($_POST["sort_by"])== "price_high_f") echo "selected='selected'"; ?>>Price: highest first</option><option value="price_ship_h_f" <?php if(isset($_POST["sort_by"])&& ($_POST["sort_by"])== "price_ship_h_f") echo "selected='selected'"; ?>>Price + Shipping: highest first</option><option value="price_ship_low_f" <?php if(isset($_POST["sort_by"])&& ($_POST["sort_by"])== "price_ship_low_f") echo "selected='selected'"; ?>>Price + Shipping: lowest first</option></select></td></tr>
			<tr><td><hr/></td><td><hr/></td></tr><tr><td class="abcd"><b>Resuts Per Page:&nbsp;</b></td><td class="abcd"><select name="results_per_page"><option selected value="5" <?php if(isset($_POST["results_per_page"])&& ($_POST["results_per_page"])== "5") echo "selected='selected'"; ?>>5</option><option value="10" <?php if(isset($_POST["results_per_page"])&& ($_POST["results_per_page"])== "10") echo "selected='selected'"; ?>>10</option><option value="15" <?php if(isset($_POST["results_per_page"])&& ($_POST["results_per_page"])== "15") echo "selected='selected'"; ?>>15</option><option value="20" <?php if(isset($_POST["results_per_page"])&& ($_POST["results_per_page"])== "20") echo "selected='selected'"; ?>>20</option></select></td></tr><tr>												<td></td>										<td align="right"><input type="button" value="clear" onclick="clear_form()"></button><button value="search" onClick="if(check_values(this.form)==false) { return false; }">search</button></td></tr></table>
	<!--</fieldset></div>-->
</form>

<?php
if(!empty($_POST)) 
{
$url_to_be_sent = "http://svcs.eBay.com/services/search/FindingService/v1?siteid=0&SECURITY-APPNAME=wwwusced-da80-4202-8808-cad10533c967&OPERATION-NAME=findItemsAdvanced&SERVICE-VERSION=1.0.0&RESPONSE-DATA-FORMAT=XML&keywords=";	
$kw = urlencode($_POST["key_words"]);
$url_to_be_sent.=$kw;
$sb=$_POST["sort_by"];
if($sb=="best_match")
$url_to_be_sent.="&sortOrder=BestMatch";
else
if($sb=="price_high_f")
$url_to_be_sent.="&sortOrder=CurrentPriceHighest";
else
if($sb=="price_ship_h_f")
$url_to_be_sent.="&sortOrder=PricePlusShippingHighest";
else
if($sb=="price_ship_low_f")
$url_to_be_sent.="&sortOrder=PricePlusShippingLowest";    //modified the spelling here 
$url_to_be_sent.="&paginationInput.entriesPerPage=".$_POST["results_per_page"];
$index=0;	
if(strlen($_POST["from"])>0)
{
$url_to_be_sent.="&itemFilter[".$index."].name=MinPrice&itemFilter[".$index."].value=".$_POST["from"];   
$index+=1;
}
if(strlen($_POST["to"])>0)
{
$url_to_be_sent.="&itemFilter[".$index."].name=MaxPrice&itemFilter[".$index."].value=".$_POST["to"]; 
$index+=1;
}	
if(!empty($_POST["condition"]))
{
	$k = 0;
foreach($_POST["condition"] as $co)
{    
if($co=="new")
    $place=1000;
    else
        if($co=="used")
        $place=3000;
        else
        if($co=="very_good")
        $place=4000;
        else
        if($co=="good")
        $place=5000;
        else
        if($co=="acceptable")
        $place=6000;
$url_to_be_sent.="&itemFilter[".$index."].name=Condition&itemFilter[".$index."].value[".$k."]=".$place; 
$k+=1;
}
$index+=1;
}
	
$sel=0;
    
if(!empty($_POST["buying_formats"]))
{
// Loop to store and display values of individual checked checkbox.
foreach($_POST["buying_formats"] as $buyfor)
{    
if($buyfor=="buy_it_now")
    $bf="FixedPrice";
    else
        if($buyfor=="auction")
        $bf="Auction";
        else
        if($buyfor=="classified_ads")
        $fb="Classified";
$url_to_be_sent.="&itemFilter[".$index."].name=ListingType&itemFilter[".$index."].value[".$sel."]=".$bf;
$sel+=1;
}
$index+=1;
}
	
	
if(isset($_POST["return_accepted"]))
$ra="true";
else
    $ra="false";

$url_to_be_sent.="&itemFilter[".$index."].name=ReturnsAcceptedOnly&itemFilter[".$index."].value=".$ra;
$index+=1;
if(isset($_POST["free_shipping"]))
$fshp="true";
else
    $fshp="false";
$url_to_be_sent.="&itemFilter[".$index."].name=FreeShippingOnly&itemFilter[".$index."].value=".$fshp;
$index+=1;	
if(isset($_POST["expedited_shipping_available"]))
{
$url_to_be_sent.="&itemFilter[".$index."].name=ExpeditedShippingType&itemFilter[".$index."].value=Expedited";
$index+=1;
}	
if(strlen($_POST["days"])>0)
$url_to_be_sent.="&itemFilter[".$index."].name=MaxHandlingTime&itemFilter[".$index."].value=".$_POST["days"];	
	//echo $url_to_be_sent;


//http://developer.ebay.com/DevZone/finding/CallRef/findItemsAdvanced.html

$check = simplexml_load_file($url_to_be_sent);
	echo $check;
if ($check->ack == "Success") 
{
  $output = '';
  $entries = $check->paginationOutput->totalEntries;
	$x = "div align=\"center\"><h1>No results found</h1></div>";
  if($entries==0)
  echo $x;
	else
	{
		$common = "<div align=\"center\">";
		
  echo "<br><h2>".$common.$entries." Results found for <i>".$_POST["key_words"]."</i></h2></div>";
  $output.=$common."<table border=\"1\" cellpadding=\"1px\" cellspacing=\"0\">";
		
  foreach($check->searchResult->item as $c) 
  {
    $image = $c->galleryURL;
    $url = $c->viewItemURL;
    $b = $c->listingInfo->listingType;
    $top = $c->topRatedListing;
    $t = $c->title;
    $condition = $c->condition->conditionDisplayName;
    $acceptsreturn = $c->returnsAccepted;
    $freeshipping = $c->shippingInfo->shippingServiceCost;
    $expeditedshipping = $c->shippingInfo->expeditedShipping;
    $timetoship = $c->shippingInfo->handlingTime;
    $price = $c->sellingStatus->convertedCurrentPrice;
    $sc = $c->shippingInfo->shippingServiceCost;
    $location = $c->location;
    if (!empty($c->galleryURL))
    $output.= "<tr><td><img src=\"$image\" width=150px height=200px></td>";
	  else 
		  $output.="<tr><td>Image not available!</td>";
    if ((!empty($c->viewItemURL))&&(!empty($c->title)))
    $output.="<td><table><tr></tr><tr></tr><tr></tr><tr><td><a href=\"$url\">$t</a></td></tr>"; 
      else
		  $output.="<td><table><tr></tr><tr></tr><tr></tr><tr><td></td></tr";
    if (!empty($c->condition->conditionDisplayName))
    {
        if($condition == 1000)
        {
            $output.="<tr><td><b>Condition: New</b>";
        }
        else if ($condition == 3000)
        {
            $output.="<tr><td><b>Condition: Used</b>";
        }
        else if ($condition == 4000)
        {
            $output.="<tr><td><b>Condition: Very Good</b>";
        }
        else if ($condition == 5000)
        {
           $output.="<tr><td><b>Condition: Good</b>";
        }
        else if ($condition == 6000)
        {            
            $output.="<tr><td><b>Condition: Acceptable</b>";
        }
        else
        {
            $output.="<tr><td><b>Condition: ".$condition."</b>";
        }
    }
    else
       $output.="<tr><td><b>Condition:    </b>";
      
    if (!empty($c->topRatedListing))
    {
        if($top == "true")
        {
			$im = "</td><td><img src=\"http://cs-server.usc.edu:45678/hw/hw6/itemTopRated.jpg\"height=\"50\" width=\"50\">";
            $output.=$im;
        }
    }
      
    $output.="</td></tr>";
    //try float: right    .... for toprated image
    //$output.="<tr><td></td></tr>"; 
    //$output.="<tr><td></td></tr>"; 
    
     if (!empty($c->listingInfo->listingType))
     {
      if ($b == "FixedPrice" || $b == "StoreInventory")
          $output.="<tr><td><b>Buy It Now</b></td></tr>";
          else if($b == "Auction")
          $output.="<tr><td><b>Auction</b></td></tr>";
          else if($b == "Classified")
          $output.="<tr><td><b>Classified Ad</b></td></tr>";
          else
            $output.="<tr><td><b>".$b."</b></td></tr>";
     }
    
    
    $output.="<tr><td></td></tr>"; 
    $output.="<tr><td></td></tr>"; 
    
    if (!empty($c->returnsAccepted))
    {
    if($acceptsreturn=="true")
    $output.="<tr><td>Seller accepts return</td></tr>";
    }
    
    $shippingType = $c->shippingInfo->shippingType;
    
    if(((!empty($c->shippingInfo->shippingServiceCost))&&($freeshipping==0.0)) || ($shippingType == 'FREE'))
    $output.="<tr><td>FREE Shipping -- ";
    else
    $output.="<tr><td>Shipping Not Free -- ";
    
    if (!empty($c->shippingInfo->expeditedShipping))
    {
    if($expeditedshipping=="true")
    $output.="Expedited Shipping Available -- ";
    }
    
    if(!empty($c->shippingInfo->handlingTime))
    {
    $output.="Handled for shipping in ".$timetoship." day(s)";
    }
    $output.="</td></tr>";
    $output.="<tr><td></td></tr>"; 
    $output.="<tr><td></td></tr>"; 
    $output.="<tr><td></td></tr>"; 
    if(!empty($c->sellingStatus->convertedCurrentPrice))
        $output.="<tr><td><b>Price: ".$price."</b>";
    else
         $output.="<tr><td><b>Price: </b>";
        
    if(!empty($c->shippingInfo->shippingServiceCost)&&($sc!=0.0))
        $output.="<b>(+".$sc." for shipping) </b>";
    
    if(!empty($c->location))
        $output.="<i>From ".$location."</i>";
    else
        $output.="<i>From </i>";
      
    $output.="</td></tr>";
        
    $output.="</table></td></tr>";
  }
    $output.="</table></div>";
	}
}
else
{
	$output  = "<h3>Error! Request was not successful!</h3>";
}
	echo $output;
}
?>

</body>
</html>


