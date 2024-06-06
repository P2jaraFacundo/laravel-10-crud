<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Report</title>
</head>
<body>
    <h1 style='text-align: center;'>Student Report</h1>
    <table style='width: 100%; border-collapse: collapse;'>
        <thead>
            <tr>
                <th style='text-align: center; padding: 8px; border: 1px solid #000;'>Surname</th>
                <th style='text-align: center; padding: 8px; border: 1px solid #000;'>Name</th>
                <th style='text-align: center; padding: 8px; border: 1px solid #000;'>AttendedClasses</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
            <tr>
                <td style='text-align: center; padding: 8px; border: 1px solid #000;'>{{ $student->surname }}</td>
                <td style='text-align: center; padding: 8px; border: 1px solid #000;'>{{ $student->name }}</td>
                <td style='text-align: center; padding: 8px; border: 1px solid #000;'>{{ $student->assists ? $student->assists->count() : 0 }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</body>
</html>
