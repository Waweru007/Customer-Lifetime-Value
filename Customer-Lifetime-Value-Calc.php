<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="keywords" content="">
<title>AI FOCUS</title>

 
</head>
<style type="text/css">
     body {
          background-image: url("pics/ai2.jpg");
          background-size: 100%;
          opacity: ;
          background-repeat: no-repeat;
     }
     p {
          padding: 20%;
          padding-top: 0;
          padding-bottom: 0;
          font-size: 120%;
     }
</style>
<body>
<article class="content" style="min-height: 400px">

<div class="data" style="background: inherit; text-align:center;">
	<h1 style="color: #000; font-size: 250%">AI Focus Customer Lifetime Value Calculator</h1>
  <div class="post" style="min-height: 500px">

     <form method="post" class="" action=""><br>
          <input type="int" style="width: 50%; height: 30px;" name="retention" placeholder="Retention Rate in decimal" required><br><br>
          <input type="int" style="width: 50%; height: 30px;" name="TotalCustomers" placeholder="Total Number of active customers in your database" required><br><br>
          <input type="int" style="width: 50%; height: 30px;" name="avPurchase" placeholder="Average Purchase Per Customer" required><br><br>
          <input type="int" style="width: 50%; height: 30px;" name="avPurchasePerYear" placeholder="Average Number of Purchases Per Year" required><br><br>
          <input type="int" style="width: 50%; height: 30px;" name="marginRate" placeholder="Margin Rate In Decimals" required><br><br>
          <input type="submit" name="submit" value="Submit">
     </form>
     <?php
     if(isset($_POST['submit'])) {
     	$retention = $_POST['retention'];
          $avPurchase = $_POST['avPurchase'];
          $avPurchasePerYear = $_POST['avPurchasePerYear'];
          $marginRate = $_POST['marginRate'];
          $TotalCustomers = $_POST['TotalCustomers'];

          $grossMargin = $avPurchase * $avPurchasePerYear * $marginRate;

     	$deno = 1 + 0.25 - $retention;   ///this is for future revenue
          $deno2 = 0.25 + $retention;       ///for the lost revenue
          $Chrn = 1 - $retention;


     	$rate = $retention/$deno;
          $rate2 = $Chrn/$deno2;

     	$lcv = $grossMargin * $rate;      //this one has  all the decimals
          $LCV = number_format($lcv, 2);    // this one is lcv in 2 decimal places 
          $LcVLoss = $grossMargin* $rate2;
          $LCVLoss = number_format($LcVLoss, 2);
          


          
          $Churn = $Chrn * 100;
          $totalrevenue = $LCV*$TotalCustomers;   //this one has all the decimals
          $TotalRevenue = number_format($totalrevenue, 2);   //in two decimal places
          $totalLostRevenue = $LcVLoss*$TotalCustomers;   //with no decimal place format
          $TotalLostRevenue = number_format($totalLostRevenue, 2);

          $retentionRate = $retention * 100;

          echo '<div style="background-color: #FFF; background-opacity: 0.8; min-height: 200px">
          <br><p>Customer Lifetime Valuer,This is the amount of money that you expect from each customer on average = <b>$'.$LCV.'</b> </p>';


          echo "<p> Churn Rate which is the rate at which you lose new customers  = <b>".$Churn."%</b> </p>";

          echo "<p> Total Future Revenue Discounted to Today's Value = <b>$".$TotalRevenue." </b></p>";

          echo "<p> Total Lost Future Revenue Discounted to Today's Value because of your high Churn rate = <b>$".$TotalLostRevenue." </b></p>";
          echo "<p>Based on your retention rate of <b>".$retentionRate."%</b>, we can see that you are losing <b>$".$LCVLoss."</b> every year from each customer on average. All factors held constant, your company will lose a total of <b>$".$TotalLostRevenue."</b> in its lifetime. You need to work on your churn rate in order to retain these revenues.</p>";


          echo "<hr /></div>";



     }
     ?>

  </div>
    
</div>
</article>

</body>
</html>