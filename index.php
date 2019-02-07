<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require "class_available_dates.php";
require "class_csv.php";
$nrDates = 0;
$csv ="";
$interval ="";
if($_GET){
	$start =  $_GET['start'];
	$end = $_GET['end'];
	$interval = $_GET['interval'];

	$dates = new available_dates();
	$toCsv = new exportCsv();

	$data = $dates->set_range($start, $end, $interval);
	$nrDates = count($data);
	$csv = $toCsv->toFile($data);
}
?>
    <html>
    <head>
        <title>Beschikbare datums</title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    </head>
    <body>
        <br>
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Aantal beschikbare datums: <?php echo $nrDates;?></h5>
	            <form>
	                <div class=" form-group">
	                    <div class="row">
	                        <div class="col-md-4">
	                            <label for="start">Interval :</label>
	                            <input type="text" id="interval"class="form-control"  name="interval" value="<?php echo $interval?>">
	                        </div>
	                        <div class="col-md-4">
	                            <label for="start">Start date:</label>
	                            <input type="date" class="form-control" id="start" name="start" value="<?php echo $start?>">
	                        </div>
	                        <div class="col-md-4">
	                            <label for="start">End date:</label>
	                            <input type="date" class="form-control" id="end" name="end" value="<?php echo $end?>">
	                        </div>
	                        </div>
							<div class="row">
	    						<div class="col-md-12">	&nbsp;</div>
	    					</div>
	                        <div class="row">
	                        <div class="col-md-4">
	                            <input type="submit" class="btn btn-outline-primary" value="Zoek datums">
	                            <input type="submit" id="clear" class="btn btn-secondary" value="Clear">
	                        </div>
	                    </div>
	                </div>
	            </form>
	        </div>
	    </div>
	    <div class="row">
	    	<div class="col-md-12">	&nbsp;</div>
	    </div>
		<div class="row">
	        <div class="col-md-12">
	       	 <div class="card">
	       	 		<div class="card-body" data-contents>
	       	 			<h6 class="card-title pull-right">CSV Preview</h5>
	       	 			<input type="submit" data-btn="csv" class="btn btn-primary pull-right" value="Export to CSV"><br>
	       	 			<div data-csv>
	       	 				<?php echo $csv?>
	       	 			</div>	
	       	 		</div>
	       		 </div>
	        </div>
	    </div>    
	</div>
<script>
$( document ).ready(function() {
    $("#clear").on("click", function() {
		$("#start").val("");
	    $("#end").val("");
	    $("#interval").val("");
   });
	$("[data-btn='csv']").on("click", function() {
		var csv = $("[data-csv]").html();
		csv = csv.replace(/\s+/g, '');
		    var hiddenElement = document.createElement('a');
		    hiddenElement.href = 'data:text/csv;charset=utf-8,' + encodeURI(csv);
		    hiddenElement.target = '_blank';
		    hiddenElement.download = 'dates.csv';
		    hiddenElement.click();
	});
});
</script>
</body>
</html>