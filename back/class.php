<?php

    class tar {
        public  $file_name;
        public  $path;
        //public  $ext;
        public  $data;
        public  $length;
        public  $in_folder;
        
        function    __construct(string $file_name, bool $in_folder = false, string $path = NULL) {
            $this->file_name = $file_name;
            //$this->ext = $ext;
            $this->in_folder = $in_folder;
            $this->path = $path;
        }
    }
?>