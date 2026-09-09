<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>{{ $student['name'] }} | Student Details</title>
	<style>
		:root { 
      font-family: Arial, sans-serif; 
      background: pink; 
      color: black; 
    }
		body { 
	      margin: 0;
	      padding: 48px 20px; 
  }
		main { 
      max-width: 620px; 
      margin: auto; 
    }
		.back { /* Back button styling */
      color: black; 
		  text-decoration: none;
		  font-weight: 700; 
    }
		section { 
      margin-top: 24px; 
      padding: 28px; 
      background: white; 
      box-shadow: 10px 30px rgba(23, 33, 43, .08); 
    }
		h1 { 
      margin: 8px; 
    }
		.id { 
      color: gray; 
      border-color: black;
      margin: 10px; 
    }
		h2 { 
      font-size: 1.1rem; 
      border-bottom: 1px solid white; 
      padding-bottom: 12px; 
    }
		li { 
      padding: 8px; 
    }
	</style>
</head>
<body>
	<main>
		<a class="back" href="{{ route('students.index') }}">Back to Student Lists</a>
		<section>
			<h1>{{ $student['name'] }}</h1>
			<p class="id">Student ID: {{ $student['id'] }}</p>
			<h2>Subjects Taken</h2>
			<ul>
				@foreach ($student['subjects'] as $subject)
					<li>{{ $subject }}</li>
				@endforeach
			</ul>
		</section>
	</main>
</body>
</html>
