<!DOCTYPE html>
<html>
<head>
	<title>Notify</title>
</head>
<body>
	<h1> Your server: {{ $server->name }} is {{ $server->is_up == 0 ? 'down' : 'up' }}!</h1>
</body>
</html>