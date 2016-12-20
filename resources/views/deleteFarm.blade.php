<!DOCTYPE html>
<html>
<head>
	<title>Edit Farm</title>
</head>
<body>
<form action="{{ url('farm-delete') }}" method="POST">
	{{csrf_field()}}
	<select name="plant">
		@foreach($plants as $plant)
		<option value="{{ $plant->id }}">{{ $plant->plantname }} - {{ $plant->startdate}}</option>
		@endforeach
	</select>
	<button>Delete</button>
</form>
</body>
</html>