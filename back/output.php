<?php
    function output(&$arr_obj, string $archive_name) : bool {
        $out = "";

        foreach ($arr_obj as $obj) {
            $out .=  "******************************\n";
            $out .= "name=" . $obj->file_name . "\n";
            $out .= "in_folder=" . $obj->in_folder . "\n";
            $out .= "path=" . $obj->path . "\n";
            $out .= "length=" . $obj->length . "\n";
            $out .= "data=" . $obj->data . "\n";
        }
        file_put_contents("/var/www/html/$archive_name.mytar", $out);
        return true;
    }
?>