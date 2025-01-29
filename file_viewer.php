<html>
    <head>
    <?php
            include 'head.php'; 
            $name = $_GET['name'];
            $path = "questionnaires/";
            // Store the file name into variable
            $file = $path.$name;
            $filename = $name;
            
            // Header content type
            header('Content-type: application/pdf');
            
            header('Content-Disposition: inline; filename="' . $filename . '"');
            
            header('Content-Transfer-Encoding: binary');
            
            header('Accept-Ranges: bytes');
            
            // Read the file
            @readfile($file);

    ?>
    </head>

</html>