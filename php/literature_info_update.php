<?php
$key = $_POST['key'];
$IDliterature = $_POST['IDliterature'];
$literature_title = $_POST['literature_title'];
$literature_author = $_POST['literature_author'];
$literature_publisher = $_POST['literature_publisher'];
$literature_year = $_POST['literature_year'];
$literature_language = $_POST['literature_language'];

require_once('dbSelect.php');

$data = array();
switch ($key) {
    case 1:
        $select_sql = ('SELECT * FROM acc_literature WHERE IDliterature = "'.mysqli_real_escape_string($mysqli, $IDliterature).'"');
        $result = mysqli_query($mysqli, $select_sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $data = array(
                'key' => $key,
                'literature_title' => $row['title'],
                'literature_author' => $row['author'],
                'literature_publisher' => $row['publisher'],
                'literature_year' => $row['year'],
                'literature_language' => $row['language']
            );
        }
        break;
    case 2:
        if ($IDliterature == 0){
            $insert_sql = ('INSERT INTO acc_literature (literature_title, literature_author, literature_publisher, literature_year, literature_language)
            VALUES (NULL,
            "'.mysqli_real_escape_string($mysqli, $literature_title).'",
            "'.mysqli_real_escape_string($mysqli, $literature_author).'",
            "'.mysqli_real_escape_string($mysqli, $literature_publisher).'",
            "'.mysqli_real_escape_string($mysqli, $literature_year).'",
            "'.mysqli_real_escape_string($mysqli, $literature_language).'"
            )');
            $result = mysqli_query($mysqli, $insert_sql);
            $data = array(
                'key' => $key,
                'literature_title' => $literature_title,
                'literature_author' => $literature_author,
                'literature_publisher' => $literature_publisher,
                'literature_year' => $literature_year,
                'literature_language' => $literature_language
            );
        }
        else {
            $update_sql = ('UPDATE acc_literature SET
                literature_title = "' . mysqli_real_escape_string($mysqli, $literature_title) . '",
                literature_author = "' . mysqli_real_escape_string($mysqli, $literature_author) . '",
                literature_publisher = "' . mysqli_real_escape_string($mysqli, $literature_publisher) . '",
                literature_year = "' . mysqli_real_escape_string($mysqli, $literature_year) . '",
                literature_language = "' . mysqli_real_escape_string($mysqli, $literature_language) . '"
                WHERE IDliterature = "' . mysqli_real_escape_string($mysqli, $IDliterature) . '"');
            $result = mysqli_query($mysqli, $update_sql);
            $data = array(
                'key' => $key,
                'literature_title' => $literature_title,
                'literature_author' => $literature_author,
                'literature_publisher' => $literature_publisher,
                'literature_year' => $literature_year,
                'literature_language' => $literature_language
            );
        }
        break;
}

echo json_encode($data,JSON_UNESCAPED_UNICODE);