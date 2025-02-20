<?php
session_start();
require_once 'functions.php';
if(is_not_logged_in()){
    redirect_to("page_login.php");
    exit();
}



if (!empty($_GET["id"]) && is_numeric($_GET["id"])) {
    $user_id=$_GET["id"];
    $status_info=get_user_status();
    $user_current_status=get_current_status($user_id);

   // $user_current_status["status_id"]// это массив
    if($_POST){
        $user_status=$_POST['status_id'];
        set_user_status($user_id,$user_status);//установка статуса
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
    <?php require_once 'navbar.php';?>
    <main id="js-page-content" role="main" class="page-content mt-3">
        <div class="subheader">
            <h1 class="subheader-title">
                <i class='subheader-icon fal fa-sun'></i> Установить статус
            </h1>

        </div>
        <form action="" method="post">
            <div class="row">
                <div class="col-xl-6">
                    <div id="panel-1" class="panel">
                        <div class="panel-container">
                            <div class="panel-hdr">
                                <h2>Установка текущего статуса</h2>
                            </div>
                            <div class="panel-content">
                                <div class="row">
                                    <div class="col-md-4">
                                        <!-- status -->
                                        <div class="form-group">
                                            <label class="form-label" for="example-select">Выберите статус</label>
                                            <select class="form-control" id="example-select" name="status_id">
                                                <?php foreach ($status_info as $info): ?>
                                                    <?php if ($info["status_id"] == $user_current_status["status_id"]): ?>
                                                        <option value="<?php echo $info["status_id"] ?>" selected><?php echo $info["status_value"] ?></option>
                                                    <?php else: ?>
                                                        <option value="<?php echo $info["status_id"]; ?>"><?php echo $info["status_value"] ?></option>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-3 d-flex flex-row-reverse">
                                        <button class="btn btn-warning" >Set Status</button>
                                    </div>
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