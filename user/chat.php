<?php

session_start();
if (strlen($_SESSION['id'] == 0)) {
    header('location:logout.php');
} else {

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Welcome </title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/heroic-features.css" rel="stylesheet">
        <link href="css/chat.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>

    <body>
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="welcome.php">Welcome !</a>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="#"><?php echo $_SESSION['name']; ?></a>
                        </li>
                        <li>
                            <a href="chat.php">Chat</a>
                        </li>
                        <li>
                            <a href="logout.php">Logout</a>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">


            <div class="tabs">
                <div class="container">
                    <div class="row">
                        <div class="col-md-2">
                            <ul class="nav-stacked flex-column">
                                <?php
                                include '../dbconnection.php';

                                $ret = mysqli_query($con, "select * from users");

                                $cnt = 1;
                                while ($row = mysqli_fetch_array($ret)) {
                                    if ($_SESSION['id'] != $row['id']) {
                                ?>
                                        <li class="<?= ($cnt == 1) ? 'active' : '' ?>" data-id="<?= $row['id'] ?>"><a href="#tab_<?= $row['id'] ?>" data-toggle="pill"><?= $row['fname'] . ' ' . $row['lname']; ?></a></li>

                                <?php $cnt++;
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <div class="tab-content">

                                <?php
                                $ret = mysqli_query($con, "select * from users");
                              
                                $cnt = 1;
                                while ($data = mysqli_fetch_array($ret)) {
                                    if ($_SESSION['id'] != $data['id']) {
                                    
                                       
                                ?>
                                        <div class="tab-pane <?= ($cnt == 1) ? 'active' : '' ?>" id="tab_<?= $data['id'] ?>" data-id="<?= $data['id'] ?>">

                                            <p><?= $data['fname'] . ' ' . $data['lname']; ?></p>

                                            <hr>
                                            <div id="class_<?= $data['id'] ?>"></div>





                                            <form method="POST" id="form_<?= $data['id'] ?>" class="form-inline">
                                                <input type="hidden" name="message_from" value="<?= $_SESSION['id'] ?>">
                                                <input type="hidden" name="message_to" value="<?= $data['id'] ?>">

                                                <input type="text" name="message" class="form-control" placeholder="Message goes here ">

                                                <button type="submit" name="send" class="btn btn-primary mb-2"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>

                                            </form>



                                        </div>
                                <?php $cnt++;
                                    }
                                } ?>

                                <div id="output"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        </div>
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script>
            function codeAddress() {

                var thisID = $('.active').data('id');

                $.ajax({

                    method: "POST",
                    url: "chating.php",
                    data: {
                        "from": <?= $_SESSION['id'] ?>,
                        "to": thisID
                    },
                    success: function(result) {
                        $("#class_" + thisID).html("");

                        $("#class_" + thisID).html(result);

                    }

                });
            }
            window.onload = codeAddress;
            $('document').ready(function() {
                var $a = $(".tabs li");

                $a.click(function() {

                    $(".tab-pane").removeClass('active show');
                    $a.removeClass("active");
                    $(this).addClass("active");
                    var idd = $(this).attr("data-id");

                    $("#tab_" + idd).addClass('active show');

                    $.ajax({

                        method: "POST",
                        url: "chating.php",
                        data: {
                            "from": <?= $_SESSION['id'] ?>,
                            "to": idd
                        },
                        success: function(result) {
                            $("#class_" + idd).html("");

                            $("#class_" + idd).html(result);
                            // string='<ul>';
                            // $.each(result, function(key, value) {

                            //     string += "<li style='background-color: transparent;'>"+value['message']+'</li>' ;
                            // });
                            // string+='</ul>';
                            // console.log(string);
                            //     $("#class_" + idd).append(string);
                        }

                    });

                });
            });
        </script>
    </body>

    </html>
    <?php }

if (isset($_POST['send'])) {
    $ate = date('d-M-Y');
    $msg = mysqli_query($con, "insert into chat(message_from,message_to,message) values('$_POST[message_from]','$_POST[message_to]','$_POST[message]')");
    if ($msg) {
    ?><script>
            var thisID = $('.active').data('id');
            $("#tab_" + thisID).addClass('active show');
        </script>
<?php
    }
}
?>