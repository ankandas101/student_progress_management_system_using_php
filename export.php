<?php if(!isset($conn)){ include 'db_connect.php'; } ?>
<?php  
//export.php 
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Create a new Spreadsheet object
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Create column headers
$sheet->setCellValue('A1', 'ID');
$sheet->setCellValue('B1', 'First Name');
$sheet->setCellValue('C1', 'Last Name');
$sheet->setCellValue('D1', 'Email');
$sheet->setCellValue('E1', 'Type');
$sheet->setCellValue('F1', 'Avatar');
$sheet->setCellValue('G1', 'Date Created');
$sheet->setCellValue('H1', 'S_ID');



// Fetch data from MySQL table
$sql = "SELECT * FROM students";
$result = $conn->query($sql);

// Populate data into Excel
if ($result->num_rows > 0) {
    $rowIndex = 2;
    while ($row = $result->fetch_assoc()) {
        $sheet->setCellValue('A'.$rowIndex, $row['id']);
        $sheet->setCellValue('B'.$rowIndex, $row['firstname']);
        $sheet->setCellValue('C'.$rowIndex, $row['lastname']);
        $sheet->setCellValue('D'.$rowIndex, $row['email']);
        $sheet->setCellValue('E'.$rowIndex, $row['type']);
        $sheet->setCellValue('F'.$rowIndex, $row['avatar']);
        $sheet->setCellValue('G'.$rowIndex, $row['date_created']);
        $sheet->setCellValue('H'.$rowIndex, $row['s_id']);
        $rowIndex++;
    }
} else {
    echo "0 results";
}

// Close MySQL connection
$conn->close();

// Save Excel file
$writer = new Xlsx($spreadsheet);
$writer->save('data_export.xlsx');

echo "Excel file has been generated successfully.";

?>