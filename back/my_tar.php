<?php
    include "class.php";
    include "output.php";

/* DEFINITION DES FONCTIONS */ 
    
    function get_data(string $file, string $path = NULL) {
        $path_file = $path . $file;
        $path_file = realpath($path_file);
        $fd = fopen($path_file, "r");
        
        if (filesize($path_file) == 0) {
            fclose($fd);
            return NULL;
        }
        $data_temp = fread($fd, filesize($path_file));
        fclose($fd);        
        return ($data_temp);
    }


    //créer un objet 'fichier'
    function create_file(string $file, bool $in_folder = false, string $path = NULL) {
        $obj = new tar($file, $in_folder, $path);
        $obj->length = filesize(realpath($path . $file));
        $obj->data = get_data($file, $path);
        return $obj;
    }

    //Trouver les fichiers dans le ou les dossiers de façon récursive
    function find_file_rec(string $dir_name) : array {
        $root = scandir($dir_name);
        //tableau qu'on renvoie
        $files = [];
        
        foreach($root as $value) {
            //pour des dossiers qu'on veut éviter
            if ($value == '.' || $value == '..') {continue;}
        
            //Verifie si les fichiers sont bien des fichiers
            if (is_file("$dir_name/$value")) {
                $files[] = "$dir_name/$value";
                continue;
            }
        
            //Récursive
            foreach (find_file_rec("$dir_name/$value") as $value) {
                $files[] = $value;
            }
        }
        return ($files);
    }

    function parse_arr_file(&$arr_obj, $file) {
        //Parcourir le tableau de chemin de fichier.
        $sep_name = [];
        //chaque fichiers
        for ($i = 0; $i < count($file); $i++){
            $path = NULL;
            $sep_name = explode('/', $file[$i]);
            $name = $sep_name[count($sep_name) - 1];
            //echo "NAME : " . $name . "\n";

            //chemin
            for ($y = 0; $y < count($sep_name) - 1; $y++)
                $path .= $sep_name[$y] . '/';
            $obj = create_file($name, true, $path);
            $arr_obj[] = $obj;
        }
    }

    function main_compr($files_tab, $archive_name) {
        $arr_obj = [];
        var_dump($files_tab);
        for ($i = 0; $i < count($files_tab); $i++) {
            
            echo ($files_tab[$i] . "\n");
            //Verifie si les fichiers sont bien des fichiers oui c'est bizarre
            if (is_file($files_tab[$i])) {
                echo "TEST FILE\n";
                //creation d'un obj
                $arr_obj[$i] = create_file($files_tab[$i]);
            }
            else if (is_dir($files_tab[$i])) {
                echo "TEST DIR\n";

                //Lister recursivement les fichiers dans les dossiers.
                $files = find_file_rec($files_tab[$i]);

                //Créer des objets (classe) pour chaques dossiers trouvés
                //j'ai pas fais
                parse_arr_file($arr_obj, $files);
                
            }
            else
            return null;
        }
        var_dump($arr_obj);
        if (!output($arr_obj, $archive_name))
            return null;
    }

/*----------------------------------------*/
            /*Execution*/

?>