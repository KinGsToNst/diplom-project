<?php
session_start();
require_once 'functions.php';
if(is_not_logged_in()){
    redirect_to("page_login.php");
}




if (!empty($_GET["id"]) && is_numeric($_GET["id"])) {
$user_id=$_GET["id"];

$current_avatar=get_current_avatar($user_id);


 if($_FILES){
    $image=$_FILES['image'];
    var_dump($image);
    //если файл не загружен то перенаправляем к пользователю
    if($_FILES['image']['error']>0){
        set_flash_message("danger","вы не загрузили картинку");
        redirect_to("users.php");
        exit();
    }else{
        upload_avatar_profile($user_id,$image);
    }


}


}else{
    if($_GET['logout']==true) {
        // Если да, то разрушаем сессию
        session_destroy();
        // Перенаправляем пользователя на страницу входа или на другую страницу, куда вы хотите
        header("Location: page_login.php");
        exit;
    }
    set_flash_message('danger','вы не передали значение id');
    redirect_to("users.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <meta name="description" content="Chartist.html">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
    <link id="vendorsbundle" rel="stylesheet" media="screen, print" href="css/vendors.bundle.css">
    <link id="appbundle" rel="stylesheet" media="screen, print" href="css/app.bundle.css">
    <link id="myskin" rel="stylesheet" media="screen, print" href="css/skins/skin-master.css">
    <link rel="stylesheet" media="screen, print" href="css/fa-solid.css">
    <link rel="stylesheet" media="screen, print" href="css/fa-brands.css">
</head>
<body>
<?php require 'navbar.php';?>
    <main id="js-page-content" role="main" class="page-content mt-3">
        <div class="subheader">
            <h1 class="subheader-title">
                <i class='subheader-icon fal fa-image'></i> Загрузить аватар
            </h1>
                <?php display_flash_message('success');?>
                <?php display_flash_message('danger');?>
        </div>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-xl-6">
                    <div id="panel-1" class="panel">
                        <div class="panel-container">
                            <div class="panel-hdr">
                                <h2>Текущий аватар</h2>
                            </div>
                            <div class="panel-content">
                                <div class="form-group">
                                    <?php if($current_avatar['image']):?>
                                        <img src="<?=$current_avatar['image'];?>" alt="" class="img-responsive" width="200">
                                    <?php else:?>
                                        <img src="img/demo/authors/josh.png" alt="" class="img-responsive" width="200">
                                    <?php endif;?>
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="example-fileinput">Выберите аватар</label>
                                    <input type="file" name="image" id="example-fileinput" class="form-control-file">
                                </div>


                                <div class="col-md-12 mt-3 d-flex flex-row-reverse">
                                    <button class="btn btn-warning">Загрузить</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </main>

    <script src="js/vendors.bundle.js"></script>
    <script src="js/app.bundle.js"></script>
    <script>

        $(document).ready(function()
        {

            $('input[type=radio][name=contactview]').change(function()
                {
                    if (this.value == 'grid')
                    {
                        $('#js-contacts .card').removeClassPrefix('mb-').addClass('mb-g');
                        $('#js-contacts .col-xl-12').removeClassPrefix('col-xl-').addClass('col-xl-4');
                        $('#js-contacts .js-expand-btn').addClass('d-none');
                        $('#js-contacts .card-body + .card-body').addClass('show');

                    }
                    else if (this.value == 'table')
                    {
                        $('#js-contacts .card').removeClassPrefix('mb-').addClass('mb-1');
                        $('#js-contacts .col-xl-4').removeClassPrefix('col-xl-').addClass('col-xl-12');
                        $('#js-contacts .js-expand-btn').removeClass('d-none');
                        $('#js-contacts .card-body + .card-body').removeClass('show');
                    }

                });

                //initialize filter
                initApp.listFilter($('#js-contacts'), $('#js-filter-contacts'));
        });

    </script>
</body>
</html>