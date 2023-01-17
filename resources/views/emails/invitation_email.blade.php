<html>
<head></head>
<body style="margin: 0px; padding: 0px; font-family: Helvetica;">
	<div style="background: black; color: white; padding: 20px; font-size: 52px;font-weight: bold;">Business Gate</div>	
	<div style="padding: 0px 20px 0px 20px; font-size: 18px; ">
		<h1 style="font-size: 28px; font-weight: bold;">You are invited to join the Business Gate!</h1>
		<p>{{$data->name}} has invited you to join Business Gate application.</p>
		<p>Please download the app and complete registration below.</p>
		<div>
            <a href='https://play.google.com/store/apps/details?id=com.business.gate' target="_blanl"><img height="48px" src="{{ $message->embed('images/google.png') }}"></a>
            &nbsp;&nbsp;
            <a href='https://play.google.com/store/apps/details?id=com.business.gate' target="_blanl"><img height="48px" src="{{ $message->embed('images/apple.png') }}"></a>
        </div>
	</div>
</body>
</html>