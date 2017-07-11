<!DOCTYPE html>
<html lang='en'>
<head>

</head>
<body class='container'>
<form method="post" action="/avatars" enctype="multipart/form-data">
{{ csrf_field() }}
<input type="file" name="avatar"></input>
<button type="submit">save</button>
</form>

</body>
</html> 
