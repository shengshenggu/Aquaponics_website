<!DOCTYPE html>
<html>
<head>
	<title>Edit Farm</title>
</head>
<body>
<form action="{{ url('farm/'.$farm->id) }}" method="POST">
	{{csrf_field()}}
	<input type="number" name="user_id" value="{{ $farm->user_id }}"/>
	<input type="number" name="plant_id" value="{{ $farm->plant_id }}">
	<input type="text" name="plantname" value="{{ $farm->plantname }}">
	<input type="date" name="startdate" value="{{ $farm->startdate }}">
	<input type="date" name="enddate" value="{{ $farm->enddate }}">
	<button>OK</button>
</form>
</body>
</html>