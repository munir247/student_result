<?php
function calculateResult($marks) {
    // Check for valid mark range and fail condition
    foreach ($marks as $mark) {
        if ($mark < 0 || $mark > 100) {
            return "Mark range is invalid.";
        }
    }

    // Check for failing condition
    foreach ($marks as $mark) {
        if ($mark < 33) {
            return "The student has failed.";
        }
    }

    // Calculate total and average marks
    $totalMarks = array_sum($marks);
    $averageMarks = $totalMarks / count($marks);

    // Determine the grade based on average marks
    $grade = '';
    switch (true) {
        case ($averageMarks >= 80):
            $grade = 'A+';
            break;
        case ($averageMarks >= 70):
            $grade = 'A';
            break;
        case ($averageMarks >= 60):
            $grade = 'A-';
            break;
        case ($averageMarks >= 50):
            $grade = 'B';
            break;
        case ($averageMarks >= 40):
            $grade = 'C';
            break;
        case ($averageMarks >= 33):
            $grade = 'D';
            break;
        default:
            $grade = 'F'; // This case should not be reached due to earlier checks
            break;
    }

    return [
        'totalMarks' => $totalMarks,
        'averageMarks' => number_format($averageMarks, 1),
        'grade' => $grade
    ];
}

// Handle form submission
$result = null;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get marks from the form
    $marks = [
        (int)$_POST['subject1'],
        (int)$_POST['subject2'],
        (int)$_POST['subject3'],
        (int)$_POST['subject4'],
        (int)$_POST['subject5']
    ];

    // Calculate the result
    $result = calculateResult($marks);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Result Calculator</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #555;
        }

        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            transition: border-color 0.3s;
        }

        input[type="number"]:focus {
            border-color: #007bff;
            outline: none;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        p {
            text-align: center;
            font-size: 18px;
            color: #444;
        }
    </style>
</head>
<body>
<h1>Student Result Calculator</h1>
<form method="POST">
    <label for="subject1">Subject 1 Marks:</label>
    <input type="number" id="subject1" name="subject1" required><br><br>

    <label for="subject2">Subject 2 Marks:</label>
    <input type="number" id="subject2" name="subject2" required><br><br>

    <label for="subject3">Subject 3 Marks:</label>
    <input type="number" id="subject3" name="subject3" required><br><br>

    <label for="subject4">Subject 4 Marks:</label>
    <input type="number" id="subject4" name="subject4" required><br><br>

    <label for="subject5">Subject 5 Marks:</label>
    <input type="number" id="subject5" name="subject5" required><br><br>

    <input type="submit" value="Calculate Result">
</form>

<?php if ($result): ?>
    <h2>Result:</h2>
    <?php if (is_array($result)): ?>
        <p>Total Marks: <?php echo $result['totalMarks']; ?></p>
        <p>Average Marks: <?php echo $result['averageMarks']; ?></p>
        <p>Grade: <?php echo $result['grade']; ?></p>
    <?php else: ?>
        <p><?php echo $result; ?></p>
    <?php endif; ?>
<?php endif; ?>
</body>
</html>
