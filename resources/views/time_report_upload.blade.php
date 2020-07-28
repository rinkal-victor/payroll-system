<!DOCTYPE html>
<html>
<head>
    <title>test</title>
</head>
<body>
<form action="/api/timeReport/processUpload" method="POST" enctype="multipart/form-data">
    {{ csrf_token() }}
    Upload File:
    <br />
    <input type="file" name="file" required/>
    <br /><br />
    <input type="submit" value=" Save " />
</form>
</body>
</html>
