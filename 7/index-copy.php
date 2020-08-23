
<!DOCTYPE html>
<html>
<head>
    <title>Seven</title>
    <link href="https://fonts.googleapis.com/css?family=Archivo+Black|Maven+Pro" rel="stylesheet">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <style type="text/css">
        html {
            margin: 0;
            padding: 0;
            font-size: 100%;
        }
        body {
            background: #11998e;  /* fallback for old browsers */
			background: -webkit-linear-gradient(to right, #38ef7d, #11998e);  /* Chrome 10-25, Safari 5.1-6 */
			background: linear-gradient(to right, #38ef7d, #11998e); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

            font-family: 'Maven Pro';
        }
        .container {
            margin: 15% auto 0;
            width: 100%;
            color: #FFF;
            text-align: center;
            position: relative;
        }
        h1 {
            font-size: 15em;
            font-family: 'Archivo Black';
            margin: 5px;
            line-height: 1em;
        }
        p, a.reset {
            font-size: 3.5em;
            letter-spacing: 1px;
            margin: 0;
            padding: 10px;
            border: solid 1px #FFF;
            border-radius: 5px;
            display: inline-block;
        }

        a.reset {
        	text-decoration: none;
        	color: #11998e;
            font-size: 1em;
            background-color: #FFF;
            text-transform: uppercase;
            padding: 10px 20px;
            margin-top: 0px;
            position: absolute;
            right: 5%;
            bottom: 5%;
            box-shadow: -4px 4px 1px 0px #36eb7d;
        }
        .swal-button:hover, a.reset:hover {
			box-shadow: none;
        }

        #author, #author a {
            font-size: 1.3em;
            letter-spacing: 1px;
            padding: 5px;
            /* font-family: 'Maven Pro'; */
            color: #FFF;
        }
        #author a {
            text-decoration: none;
        }

        .sweetbox{
            color: red;
        }

        .swal-modal {
            width: 350px!important;

        }
        .swal-text {
            font-size: 1.4rem!important;
        }
        .swal-content input {
            padding: 16px 10px;
        }
        .swal-button {
            background: green;
            color: white;
            box-shadow: -3px 3px 0 #36eb7d;

            /* box-shadow: -4px 4px 1px 0px #36eb7d; */
        }
        @media (max-width: 768px){
            .container {
                margin: 27% auto 0;
            }

                a.reset {
            	text-decoration: none;
            	color: #11998e;
                font-size: 1em;
                background-color: #FFF;
                text-transform: uppercase;
                padding: 10px 20px;
                margin-top: 20px;
                position: initial;
            }
        }

    </style>
</head>
<body>

<div class="container">           
                <h1 id="show-days"></h1>
                <p id="minsec"></p>
                <div id="author">
                    Watched by <a href="https://twitter.com/zeelz">@zeelz</a>
                </div>

                <a class="reset" href="#">Reset</a>


</div>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
	function twoDigits(num){
		num = String(num);
		if(num.length < 2) num = "0" + num;
		return num;
	}

    var bd = new Date("2019-10-21T00:00:00");

	
    var reset = document.querySelector('.reset');
	reset.addEventListener('click', function(e){
        var resetSalt = Math.floor(Math.random(199,1000) * 1000);
        swal({
            title: "What is the reset key?",
            content: {
                element: "input",
                attributes: {
                  placeholder: `What's key + ${resetSalt}?`,
                  type: "text",
                }
            }
        })
        .then(authenticated => {
            if(authenticated == resetSalt + 199 ){
                bd = new Date();
                swal("Date reset!",{
                    icon: 'success'
                });
            }
            else {
                swal("Incorrect reset key!",{
                    icon: 'error'
                });
            }
        });
		e.preventDefault();
	});

	var fullCircle = false;

	function showTime(){

		var now = new Date();
		// var bd = new Date("2019-10-19T00:00:00");

		// var diff = bd.getTime() - now.getTime() + 7*(1000*60*60*24);
		if(fullCircle){ // now - sep
			var diff = now.getTime() - bd.getTime();
		}
		else { // sep + 7days - now
			var diff = bd.getTime() - now.getTime() + 7*(1000*60*60*24);
		}
		
		var miliDay = 1000*60*60*24;
		var miliHour = 1000*60*60;
		var miliMinute = 1000*60;

		var daysFrac = diff / miliDay;
		var days = Math.floor(daysFrac);

		var miliAfterDays = diff - (days * miliDay);
		var hoursFrac = miliAfterDays / miliHour;
		var hours = Math.floor(hoursFrac);

		var miliAfterHours = miliAfterDays - (hours * miliHour);
		var minutesFrac = miliAfterHours / miliMinute;
		var minutes = Math.floor(minutesFrac);

		var miliAfterMinutes = miliAfterHours - (minutes * miliMinute);
		var secondsFrac = miliAfterMinutes / 1000;
		var seconds = Math.floor(secondsFrac);

		// 7 days completion checker
		fullCircle = (days === 0 && hours === 0 && minutes === 0 && seconds === 0)? true : fullCircle;

		document.getElementById('show-days').innerHTML = (String(days) !== "0")? days : "";

		document.getElementById('minsec').innerHTML = twoDigits(hours)+ ":" +twoDigits(minutes)+ ":" +twoDigits(seconds);
	}
	// showTime();
	var intervalId = setInterval(showTime, 1000);

	// clearInterval(intervalId);

</script>
</body>
</html>



