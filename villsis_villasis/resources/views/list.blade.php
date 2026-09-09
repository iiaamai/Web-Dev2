<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>List of Students</title>
	<style>
		:root { 
      color-scheme: light; 
      font-family: Arial, sans-serif; 
      background: pink; 
      color: black; 
    }
    h1 { 
      margin: 0 8px;  
      color: black;
    }
		body { 
      margin: 0;
      padding: 48px 20px; 
    }
		main { 
      max-width: 760px; 
      margin: 0 auto; 
    }
		h1 { 
      margin-bottom: 8px; 
    }
		.intro { 
      color: black; 
      margin-top: 0; 
    }
		table { 
      width: 100%; 
      border-collapse: collapse; 
      margin-top: 28px; 
      background: white; 
      box-shadow: 10px 30px rgba(23, 33, 43, .08); 
    }
		th, td { 
      padding: 16px 20px; 
      text-align: left; 
      border-bottom: 1px; 
    }
		th { 
      background: black; 
      color: pink; 
      font-size: .85rem; 
      letter-spacing: .04em; 
      text-transform: uppercase; 
    }
		tr:last-child td { 
      border-bottom: 0; 
    }
		a { 
      display: inline-block; 
      padding: 8px 14px; 
      border-radius: 4px; 
      background: pink; 
      color: white; 
      text-decoration: none; 
      font-weight: 700; 
    }
		a:hover { 
      background: #095d64; 
    }
		@media (max-width: 520px) { body { padding: 28px 12px; } th, td { padding: 12px 10px; } }
	</style>
</head>
<body>
	<main>
		<h1>Students</h1>
    <p class="intro">Click View to see a Student's Details.</p>
		<table>
			<thead>
				<tr><th>ID</th><th>Name</th><th>Action</th></tr>
			</thead>
			<tbody>
				@foreach ($students as $student)
					<tr>
						<td>{{ $student['id'] }}</td>
						<td>{{ $student['name'] }}</td>
            <td><a href="{{ route('students.show', ['id' => $student['id']]) }}">View</a></td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</main>
</body>
</html>
