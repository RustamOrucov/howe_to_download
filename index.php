<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['download']) && !empty($_GET['download'])) {
        $mypath = './upload/text.txt';
        $fileName=$_GET['download'];
        // echo $fileName;
        $path='./upload/'.$fileName;
        if(file_exists($path)){
            // header in muxtelif istifade qaydlari 
            $ext=pathinfo($path, PATHINFO_EXTENSION);
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename='.uniqid().'.'.$ext);
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Pragma: public');
            header('Content-Length: '. filesize($path));
            ob_clean();
            flush();
            readfile($path);
            $message='<div class="alert alert-success" role="alert">
        file yuklendi
      </div>';
            exit;
        }

        else {
            $message= '<div class="alert alert-danger" role="alert"> bele bir file yoxdur </div>';
        }

    } else {
        $message= '<div class="alert alert-success" role="alert">
        yuklemek ucun buttona click edin
        </div>';
    }
}

?>



<?php require_once('./partials/header/header.php'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card mt-3 bg-light">
                <div class="card-body">
                    <a href="index.php?download=text.txt"><i class="fa-solid fa-download fa-beat"></i></a>
                <?=$message?>
                </div>
            </div>
        </div>
    </div>
</div>


<?php require_once('./partials/js/js.php'); ?>