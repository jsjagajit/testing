
<script type="text/javascript">
	/*****No back*/
	history.pushState(null, null, location.href);
	window.onpopstate = function () {
		history.go(1);
	};
  //window.onbeforeunload = function() { return "Your work will be lost."; };
  var myVar = setInterval(myTimer, 1000);
	function myTimer() {
		$.get("gettime.php", function(data, status){//alert(data);
			document.getElementById("demo").innerHTML = data;
			//alert(data.indexOf('start'));
			if (data.indexOf('start') == -1) { 
				$("button[type=submit]").removeAttr("disabled");
			}
			if(data == "Time is over"){
				clearInterval(myVar);			
				//window.location = "finalresult.php?q=result";
				window.location = "finalpage.php?q=result";
				result_details
			}
    	});
	}
  </script>
    <div class="row footer">
        <div class="col-md-3 box">
            
        </div>
    </div>