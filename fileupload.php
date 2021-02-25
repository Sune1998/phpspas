<?php
$targetDir = "/opt/lampp/htdocs/uploads/";
$targetFile = basename($_FILES["fileToUpload"]["name"]);
$uploadOk =1;
$imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));

# tjekker om at der er tale om en rigtigt fil ved tjekke mime type
if(isset($_POST["submit"])){
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false){
        echo "file is an image -" . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "file is not an image.";
        $uploadOk = 0;
    }
}

# tjekker om filen allrede eksister
if (file_exists($targetFile)) {
    echo "sorry file exists";
    $uploadOk = 0;
}
# tjekker om filen er for stor
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "den er for stor";
    $uploadOk = 0;
}

# hvilken fil format du må uploade
if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif"){
    echo "wrong file type";
    $uploadOk = 0;
}

# tjekker om filen er blewvet uploade
if ($uploadOk == 0){
    echo "din fil blev ikke uploade";
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],$targetFile)){
        echo "filen". htmlspecialchars(basename($_FILES["fileToUpload"]["name"])). "has benn uploaded";
    } else {
        echo "soory file not uploaded";
    }
}