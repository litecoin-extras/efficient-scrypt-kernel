
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../docs-assets/ico/favicon.png">
    <script src="jquery.min.js"></script>
   <script type="text/javascript" src="jquery-ui.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script language="javascript" type="text/javascript" src="jquery.jqplot.min.js"></script>
    <script type="text/javascript" src="jqplot.barRenderer.min.js"></script>
    <script type="text/javascript" src="jqplot.categoryAxisRenderer.min.js"></script>
    <script type="text/javascript" src="jqplot.pointLabels.min.js"></script>
    <title>Bitcoin Safety Analysis</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <style>body {
            padding-top: 50px;
            padding-bottom: 20px;
        }
#hintergrund {
    display:none;
    z-index:1;
    position: fixed;
    height:100%;
    width:100%;
    top:0px;
    left:0px;
    background:#000000;
}
 
#popup {
    display: none;
    z-index: 2;
    position: fixed;
    width:900px;
    top: 20%;
    left: 50%;
    margin-left: -250px;
    background: none repeat scroll 0 0 #FFFFFF;
    border: 8px solid #ccc;
    border-radius: 5px 5px 5px 5px;
    font-family: Verdana, Geneva, sans-serif;
    font-size: 14px;
    color: #000;
}
 
div.schliessen {
    position: relative;
    height: 30px;
    width: 30px;
    left: 27px;
    bottom: 24px;
    background: url("close.png") no-repeat scroll 0 0 transparent;
    float: right;
    cursor: pointer;
}
 
#popup_inhalt {
    margin: 8px 14px;
  overflow-y:auto; height:400px;
   overflow-x: hidden;

}
</style>

</head>

<body>
<?
$handle = fopen("serverload.txt", "r");
if ($handle) {
$perhour = fgets($handle);
    $earning = fgets($handle);

    $connections = fgets($handle);

    $totalshares = fgets($handle);

}
?>
<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Bitcoin Address-Space Safety Analysis - BTC/Share: <?=number_format($earning,8,",",".");?> (changes every 5 seconds), Speed: <?=$perhour;?></a>
        </div>
        <div class="navbar-collapse collapse">
            <form class="navbar-form navbar-right" role="form">

                <div class="form-group">

                </div>
            </form>
        </div><!--/.navbar-collapse -->
    </div>
</div>

<!-- Main jumbotron for a primary marketing message or call to action -->
<div class="jumbotron">
    <div class="container"><div class="row">
            <div class="col-xs-6">        <div id="chart1" style="font-size: 8pt; height:300px; width:560px;"></div>
            </div>
            <div class="col-xs-6">        <div id="chart2" style="font-size: 8pt; height:300px; width:600px;"></div>
            </div>
        </div>

    </div>
</div>

<div class="container">
    <!-- Example row of columns -->
    <div class="row">
        <div class="col-md-4">
            <h2>What Are We Doing?</h2>
            <p>We are trying to motivate as many users as possible, to help us to access the security of bitcoin addresses. This project is intented to be for scientific purpose only, however we want to motivate new users to participate by giving you <b>a certain amount of BTC</b> for your computational power.</b></p>
            <p>Just get the python script from github (we are all open source) and launch it like this:</p>
            <pre>python script.py YOURBTCADDRESS</pre>
            <p>Do not forget to include your bitcoin address, so you can get your payouts. Windows user may launch the python script from Terminal, or create a shortcut to the script and adding the BTC Address as an argument in the shortcut options.</p>
            <p><a class="btn btn-default" target="_blank" href="https://github.com/TheGoodLookingJack/efficient-scrypt-kernel/blob/master/generate_even_more_rendezvous_points.py" role="button">Get The Script on GITHUB</a></p>
        </div>
        <div class="col-md-4">
<div class="alert alert-success">


        <strong>Live Key Counter:</strong> <b><span id="keys"><font color="gray"><i>(wait)</i></font></span></b> keys submitted so far.
<script language="JavaScript">
function poll() {
        $.ajax({
            url: "serverload.txt",
            type: "GET",
            success: function(data) {
                console.log("polling: " + data);
		kk = data.split("\n");
		document.getElementById("keys").innerHTML = kk[3];
            }
        });
	console.log("polling started.");
    }
setInterval(poll,2000);


</script>

      </div>

            <h2>What Do I Actually See Here?</h2>
            <p>We are generating random Bitcoin addresses, that match (in the least significant 32 bits) a few of our rendezvous points on the elliptic curve (<a href="http://en.wikipedia.org/wiki/Elliptic_Curve_DSA" target="_blank">read more</a>).
                Bitcoin addresses themselves are just points on this very elliptic curve. Now if the distribution of BTC addresses is completely random, we should experience a totally balanced distribution of hit rendezvous points (<b>The bar-chart on the right hand side shows these rendezvous points and their distribution</b>).</p>
            <p>Time will tell, how random BTC addresses actually are. If the right "point cloud" evolves to a straight blue line, our BTC adresses should be safe. Hence if it doesn't, this will open new topics to be discussed.</p>
        </div>
        <div class="col-md-4">
            <p><a class="btn btn-primary btn-lg popup_oeffnen" role="button">Click here to see all balances.</a></p>

            <h2>The Payment</h2>
            <p>You of course shall be rewarded for your effort in helping me out in this study. That's why the python program, that actually does all these calculations, will report your found shares (together with your solutions) to our server. Also this server is open source and can be found in the GITHUB.</p>
            <p>We are giving away on average 2,00 US$ per hour to our contributors (a total of 48,00 US$ per day). To make this challenge fair, we have implemented a "difficulty" mechanism similar to Bitcoin itself. The payout per found share (or triple) is calculated as follows:</p>
            <pre>payout_per_hour = 2 US$;
shares_in_last_5sec = x;
estimated_shares_per_hour = (x/5)*60*60;
price = payout_per_hour / estimated_shares_per_hour;</pre>
            <p><b>NOTE: This means, if you are the only one that submitted shares in the last 5 seconds, you will have 100% of the possible payout.</b></p>
        </div>
    </div>

    <hr>


</div> <!-- /container -->


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->


<script class="code" type="text/javascript">
jQuery(function($) {
 
    var popup_zustand = false;
 
    $(".popup_oeffnen").click(function() {
 
        if(popup_zustand == false) {
            $("#popup").fadeIn("normal");
            $("#hintergrund").css("opacity", "0.7");
            $("#hintergrund").fadeIn("normal");
            popup_zustand = true;
        }
 
    return false;
    });
 
    $(".schliessen").click(function() {
 
        if(popup_zustand == true) {
            $("#popup").fadeOut("normal");
            $("#hintergrund").fadeOut("normal");
            popup_zustand = false;
        }
 
    });
 
});
    $(document).ready(function(){


        var line1=[
            <?$handle = fopen("serverspeed.txt", "r");
            if ($handle) {
                $cnt=0;
		$lastone=0;
                while (($line = fgets($handle)) !== false) {
                    // process the line read.
                    $tt = (time()-200*5+$cnt*5)*1000;
		    if(intval($line)==0) $line = $lastone/1.3;
		    if(intval(lastone)!=0){
		    	if(intval($line) > $lastone*1.3) $line = $lastone*1.3;
		    	if(intval($line) < $lastone/1.3) $line = $lastone/1.3;
		    }
                    echo "[$tt,$line],";
	            $lastone = $line;
                    $cnt++;
                }
            } else {
                // error opening the file.
            }?>

        ];
        var plot1 = $.jqplot('chart1', [line1], {
            title:'Network key/h Speed',
            axes:{xaxis:{renderer:$.jqplot.DateAxisRenderer},yaxis: {min:0
            }},
            series:[{lineWidth:2, color: "rgb(88,0,0)",  fill: true, fillColor: "rgba(227, 167, 111, 0.7)"}],
	    seriesDefaults: {
            rendererOptions: {
                //////
                // Turn on line smoothing.  By default, a constrained cubic spline
                // interpolation algorithm is used which will not overshoot or
                // undershoot any data points.
                //////
                smooth: true
            }
        }
        });
    });
</script>
<script class="code" type="text/javascript">
    $(document).ready(function(){

        var s1 = [<?
            $dir = dir(".");
	    $cntt=0;
	    $mama = 0;
            while (($file = $dir->read()) !== false){
                //Make sure it's a .txt file
                if(strlen($file) < 5 || substr($file, -4) != '.dat')
                    continue;
                $filexx = file_get_contents($file, true);
                $mama=$mama+intval($filexx);
                if($cntt>0 && $cntt%20==0){echo "[$cntt, $mama],"; $mama=0;}
		$cntt++;
            }
             ?>];

        // Can specify a custom tick Array.
        // Ticks should match up one for each y value (category) in the series.

        var plot2 = $.jqplot('chart2', [s1], {
            title:'Distribution of BTC Addresses (collisions with one of ~5500 rendezvous points)',
            axes:{yaxis: {min:0
            }},
            series:[{lineWidth:1, hideZeros: true}]
	    ,seriesDefaults: {
            rendererOptions: {
                //////
                // Turn on line smoothing.  By default, a constrained cubic spline
                // interpolation algorithm is used which will not overshoot or
                // undershoot any data points.
                //////
                smooth: true
            }
        },pointLabels:{hideZeros: true}

        });
    });
</script>
<script class="include" language="javascript" type="text/javascript" src="jqplot.dateAxisRenderer.min.js"></script>

<div id="popup">
 
        <div class="schliessen"></div>
 
        <div id="popup_inhalt">
            <p><h2>Contributors and Earnings</h2></p>
            <p style="text-align:justify;">
		<table class="table">  
        <thead>  
          <tr>  
            <th>Bitcoin Address</th>  
            <th>Total Earned</th>  
            <th>Already Paid Out</th>  
          </tr>  
        </thead>  
        <tbody>  
<?
$file = @fopen('users.txt', "r") ;  


// while there is another line to read in the file
while (!feof($file))
{
    // Get the current line that the file is reading
    $currentLine = fgets($file) ;
    $teile = explode(" ", $currentLine);
	if($teile[0]=="test" || $teile[0]=="") continue;
?>
 <tr>  
            <td><?=$teile[0];?></td>  
            <td><?=number_format($teile[1],8,",",".");?></td>  
            <td><?=number_format($teile[2],8,",",".");?></td>  
          </tr>  

<?


}   

fclose($file) ;?>
        </tbody>  
      </table>  
	    </p>
        </div>
 
    </div>
</body>
</html>
