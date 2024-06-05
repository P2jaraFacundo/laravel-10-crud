
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Report</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Surname</th>
                <th>Clases Asistidas</th>
                <th>Condición</th>
                <th>Porcentaje</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $student->name }}</td>
                <td>{{ $student->surname }}</td>
                {{-- <td>{{ $totalClasses }}</td> --}}
                <td>{{ $attendedClasses }}</td>
                <td>{{ $condition }}</td>
                <td>{{ $percentage }}%</td>
            </tr>
        </tbody>
    </table>
</body>
</html>
