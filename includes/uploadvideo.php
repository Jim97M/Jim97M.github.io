<?php 

echo var_dump($_FILES);
echo var_dump($_POST);


$targtPath = "../vidoes" . basename($_FILES['inpFile']['name']);
move_uploaded_file($_FILES['inpFile']['name'], $targtPath);