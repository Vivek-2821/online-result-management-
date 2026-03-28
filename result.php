<?php
// Function to safely grab POST variables
function getPostVar($key, $default = '')
{
    return isset($_POST[$key]) ? htmlspecialchars($_POST[$key]) : $default;
}

// Student Details
$studentName = getPostVar('studentName', 'Unknown Student');
$rollNumber = getPostVar('rollNumber', 'N/A');

// Marks
$cn = getPostVar('cn', '0');
$os = getPostVar('os', '0');
$dbms = getPostVar('dbms', '0');
$se = getPostVar('se', '0');
$wt = getPostVar('wt', '0');

// Live calculation values (sent from JS)
// Ideally, you'd recalculate these in PHP for security, 
// but since this is a demonstration of the JS calculation interacting with PHP, 
// we'll primarily use the JS results, while ensuring they are fetched.
$totalMarks = getPostVar('totalMarks', '0');
$percentage = getPostVar('percentage', '0');
$grade = getPostVar('grade', '-');
$sgpa = getPostVar('sgpa', '0.00');
$cgpa = getPostVar('cgpa', '0.00');

// Optional: Server-side validation/recalculation
$serverTotal = intval($cn) + intval($os) + intval($dbms) + intval($se) + intval($wt);
$serverPercentage = ($serverTotal / 500) * 100;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Result Statement</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;800&display=swap" rel="stylesheet">
</head>

<body>
    <div class="background-elements">
        <div class="blob blob-1"></div>
        <div class="blob blob-2"></div>
    </div>

    <div class="container result-container">
        <div class="glass-card result-card">
            <div class="header">
                <h1>Result Statement</h1>
                <p>Academic Year 2026</p>
            </div>

            <div class="student-info glass-panel">
                <p>Student Name: <span><?php echo $studentName; ?></span></p>
                <p>Roll No: <span><?php echo $rollNumber; ?></span></p>
            </div>

            <table class="marks-table glass-panel">
                <thead>
                    <tr>
                        <th>Subject</th>
                        <th>Max Marks</th>
                        <th>Marks Obtained</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Computer Networks</td>
                        <td>100</td>
                        <td><span class="mark-badge"><?php echo $cn; ?></span></td>
                    </tr>
                    <tr>
                        <td>Operating Systems</td>
                        <td>100</td>
                        <td><span class="mark-badge"><?php echo $os; ?></span></td>
                    </tr>
                    <tr>
                        <td>Database Management Systems</td>
                        <td>100</td>
                        <td><span class="mark-badge"><?php echo $dbms; ?></span></td>
                    </tr>
                    <tr>
                        <td>Software Engineering</td>
                        <td>100</td>
                        <td><span class="mark-badge"><?php echo $se; ?></span></td>
                    </tr>
                    <tr>
                        <td>Web Technologies</td>
                        <td>100</td>
                        <td><span class="mark-badge"><?php echo $wt; ?></span></td>
                    </tr>
                </tbody>
            </table>

            <div class="final-result glass-panel">
                <div class="stat-container">
                    <div class="final-circle">
                        <span><?php echo $totalMarks; ?></span>
                    </div>
                    <span class="stat-label">Total / 500</span>
                </div>

                <div class="stat-container">
                    <div class="final-circle" style="border-color: var(--secondary-color);">
                        <span><?php echo $percentage; ?></span>
                    </div>
                    <span class="stat-label">Percent (%)</span>
                </div>

                <div class="stat-container">
                    <div class="final-circle" style="border-color: #f59e0b;">
                        <span><?php echo $sgpa; ?></span>
                    </div>
                    <span class="stat-label">SGPA</span>
                </div>

                <div class="stat-container">
                    <div class="final-circle" style="border-color: #3b82f6;">
                        <span><?php echo $cgpa; ?></span>
                    </div>
                    <span class="stat-label">CGPA</span>
                </div>

                <div class="stat-container">
                    <div class="final-circle" style="border-color: #10b981;">
                        <span class="stat-value grade-<?php echo strtolower(str_replace('+', 'plus', $grade)); ?>"><?php echo $grade; ?></span>
                    </div>
                    <span class="stat-label">Grade</span>
                </div>
            </div>

            <div class="actions">
                <button onclick="window.print()" class="submit-btn" style="width: auto; padding: 0.8rem 2rem;">Print
                    Result</button>
                <a href="index.html" class="btn-secondary">Calculate Another</a>
            </div>
        </div>
    </div>
</body>

</html>