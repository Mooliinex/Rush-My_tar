
                    <?php 
                    
                        require_once("back/my_tar.php");
                    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="fonts.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <title>Document</title>
</head>
<body>

    <div class="main">
        <div class="main_container">
            <div class="main_content mc_1">
                <form method="POST" action="" enctype="multipart/form-data">
                    <input name="archive_name" id="archive_name" placeholder="Nom de l'archive" type="text" autocomplete="off" required>
                    <input type="file" id="archive_file" name="archive_file[]" multiple required>
                    <div class="gen_down">
                        <button type="submit">Générer un fichier tar</button>
                        <a href="" >Télécharger l'archive</a>
                    </div>
                    
                </form>
            </div>
            <div class="main_content mc_2">
                <h2>Fichier uploadés</h2>
                <hr>
                <div class="add_files">
                    <?php
                        $f_file = $_FILES["archive_file"]["name"];
                        foreach($f_file as $f_file):{
                            ?>
                            <p><?= $f_file; ?></p>
                        <?php
                        }
                    endforeach;
                    ?>
                
                    <?php
                        $upload_dir = '/uploads';
                        for ($i = 0; $i < count($_FILES["archive_file"]["tmp_name"]); $i++) {
                            if (!$value = $_FILES["archive_file"]["tmp_name"][$i])
                                echo "VALUE=NULL";
                            $name = $_FILES["archive_file"]["name"][$i];
                            if (!$value = $_FILES["archive_file"]["name"][$i])
                                echo "NAME=NULL";
                            if (!move_uploaded_file($value, "$upload_dir/$name"))
                                echo "ERROR";
                        }

                        if (isset($_FILES["archive_file"]) && isset($_POST["archive_name"]))
                        {
                            $arr_files = $_FILES["archive_file"]["name"];
                            $archive_name = $_POST["archive_name"];
                            main_compr($arr_files, $archive_name);
                            echo "**************\n";
                        }
                        
                    ?>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>