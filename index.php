<?php
header('Access-Control-Allow-Origin: *');
	$url='http://svcs.ebay.com/services/search/FindingService/v1?siteid=0&SECURITY-APPNAME=Universi-67b4-4a4e-b184-7ff2bd4b59e2&OPERATION-NAME=findItemsAdvanced&SERVICE-VERSION=1.0.0&RESPONSE-DATA-FORMAT=XML&outputSelector[1]=SellerInfo&outputSelector[2]=PictureURLSuperSize&outputSelector[3]=StoreInfo&paginationInput.pageNumber='.(int)$_GET['pageNum'];

//Variable to Be used
	$countj=0;$keywords='';$from='';$to='';$new='';$used='';$verygood='';$good='';$acceptable='';$buyitnow='';$auction='';$classifiedads='';$return='';$free='';$expedited='';$maxhandling='';$sort='';
	$condtest='';$buyingtest='';$results='';$toprated='';$ru=0;
//Creating the URL
		$keywords=$_GET['inputKeywords'];$tempkey=urlencode($keywords);$temp="&keywords=".$tempkey;$url.=$temp;$sort=$_GET['sortby'];
		$temp="&sortOrder=".$sort;$url.=$temp;$results=$_GET['resultsperpage'];$temp="&paginationInput.entriesPerPage=".$results;
		$url.=$temp;$from=$_GET['inputfrom'];
		if($from!='')
		{
			$temp="&itemFilter(".$countj.").name=MinPrice&itemFilter(".$countj.").value=".$from;
			$url.=$temp;
			$countj++;
		}
		$to=$_GET['inputto'];
		if($to!='')
		{

			$temp="&itemFilter(".$countj.").name=MaxPrice&itemFilter(".$countj.").value=".$to;
			$url.=$temp;
			$countj++;

		}

  if (isset($_GET['buyingformatcheckboxes']) && is_array($_GET['buyingformatcheckboxes']))
{
   // let's iterate thru the array
	$i=0;



   	$buyingtest="&itemFilter(".$countj.").name=ListingType";
      if (in_array('buyitnow', $_GET['buyingformatcheckboxes']))
      {
      	$buyingtest.="&itemFilter(".$countj.").value(".$i.")=FixedPrice";
      	$i++;
      }
      if (in_array('auction', $_GET['buyingformatcheckboxes']))
      {
      	$buyingtest.="&itemFilter(".$countj.").value(".$i.")=Auction";
      	$i++;
      }
      if (in_array('classifiedads', $_GET['buyingformatcheckboxes']))
      {
      	$buyingtest.="&itemFilter(".$countj.").value(".$i.")=Classified";
      	$i++;
      }


   $url.=$buyingtest;
   $countj++;
}

	if(isset($_GET['inputReturnAccepted']))
		{

		$temp="&itemFilter(".$countj.").name=ReturnsAcceptedOnly&itemFilter(".$countj.").value=true";
		$url.=$temp;
		$countj++;
	}

if(isset($_GET['inputFreeShipping']))
{
		$temp="&itemFilter(".$countj.").name=FreeShippingOnly&itemFilter(".$countj.").value=true";
		$url.=$temp;
		$countj++;
	}

	if(isset($_GET['inputExpeditedShipping']))
		{
		$temp="&itemFilter(".$countj.").name=ExpeditedShippingType&itemFilter(".$countj.").value=Expedited";
		$url.=$temp;
		$countj++;
	}
		$maxhandling=$_GET['maxhandlingtime'];
		if($maxhandling!='')
		{
			$temp="&itemFilter(".$countj.").name=MaxHandlingTime&itemFilter(".$countj.").value=".$maxhandling;
			$url.=$temp;
			$countj++;

		}


		if (isset($_GET['conditioncheckboxes']) && is_array($_GET['conditioncheckboxes']))
		{
		   // let's iterate thru the array
			$i=0;



		   	$condtest="&itemFilter(".$countj.").name=Condition";
		      if (in_array('new', $_GET['conditioncheckboxes']))
		      {
		      	$condtest.="&itemFilter(".$countj.").value(".$i.")=1000";
		      	$i++;
		      }
		      if (in_array('used', $_GET['conditioncheckboxes']))
		      {
		      	$condtest.="&itemFilter(".$countj.").value(".$i.")=3000";
		      	$i++;
		      }
		      if (in_array('verygood', $_GET['conditioncheckboxes']))
		      {
		      	$condtest.="&itemFilter(".$countj.").value(".$i.")=4000";
		      	$i++;
		      }
		      if (in_array('good', $_GET['conditioncheckboxes']))
		      {
		      	$condtest.="&itemFilter(".$countj.").value(".$i.")=5000";
		      	$i++;
		      }
		      if (in_array('acceptable', $_GET['conditioncheckboxes']))
		      {
		      	$condtest.="&itemFilter(".$countj.").value(".$i.")=6000";
		      	$i++;
		      }

		   $url.=$condtest;
		   $countj++;
		}


$loop=0;
$fetchxml = simplexml_load_file($url);

if(($fetchxml->paginationOutput->totalEntries)==0)
{
	$global_array= array('ack'=>'No Results Found');
}
else{


if ($fetchxml->ack == "Success") {

$count=0;
$page_count=0;
$item_count=0;
$temp_array_count=0;

$global_array['ack']= (string)$fetchxml->ack;
$global_array["resultCount"]=(string)$fetchxml->paginationOutput->totalEntries;
$global_array["pageNumber"]=(string)$fetchxml->paginationOutput->pageNumber;
$global_array["itemCount"]=(string)$fetchxml->paginationOutput->entriesPerPage;
foreach($fetchxml->searchResult->item as $item){
	$itemNum = "item".$item_count;
	//echo $item->title."<br><br><br><br>";
	$arr['basicInfo'] = array("title"=>(string)$item->title,"viewItemURL"=>(string)$item->viewItemURL,
			"galleryURL"=>(string)$item->galleryURL,
			"pictureURLSuperSize"=>(string)$item->pictureURLSuperSize,
			"convertedCurrentPrice"=>(string)$item->sellingStatus->convertedCurrentPrice,
			"shippingServiceCost"=>(string)$item->shippingInfo->shippingServiceCost,
			"conditionDisplayName"=>(string)$item->condition->conditionDisplayName,
			"listingType"=>(string)$item->listingInfo->listingType,
			"location"=>(string)$item->location,
			"categoryName"=>(string)$item->primaryCategory->categoryName,
			"topRatedListing"=>(string)$item->topRatedListing);

			$arr["sellerInfo"] = array("sellerUserName"=>(string)$item->sellerInfo->sellerUserName,
			"feedbackScore"=>(string)$item->sellerInfo->feedbackScore,
			"positiveFeedbackPercent"=>(string)$item->sellerInfo->positiveFeedbackPercent,
			"feedbackRatingStar"=>(string)$item->sellerInfo->feedbackRatingStar,
			"topRatedSeller"=>(string)$item->sellerInfo->topRatedSeller,
			"sellerStoreName"=>(string)$item->storeInfo->storeName,
			"sellerStoreURL"=>(string)$item->storeInfo->storeURL);

			$arr["shippingInfo"] = array("shippingType"=>(string)$item->shippingInfo->shippingType,
									"shipToLocations"=>(string)$item->shippingInfo->shipToLocations,
									"expeditedShipping"=>(string)$item->shippingInfo->expeditedShipping,
									"oneDayShippingAvailable"=>(string)$item->shippingInfo->oneDayShippingAvailable,
									"returnsAccepted"=>(string)$item->returnsAccepted,
									"handlingTime"=>(string)$item->shippingInfo->handlingTime
									);

	$global_array[$itemNum] = $arr;
	$item_count++;
	}



	}
	 }
  $json= json_encode($global_array);
	$json = urldecode(str_replace('//',"",$json));
	$json_fixquotes=urldecode(str_replace('\"',"&quot;",$json));
	$json_nolsashes=stripslashes($json_fixquotes);

	echo $json_nolsashes;

?>
