

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PHP Show Data</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
<div class="container list-quiz">
    <h1 class="page-header">Danh sách phim</h1>
    <div id="show-film">

    </div>

    <div class="row">
        <p class="col-md-2 col-md-offset-5">
            <button id='load-more' type="button" class="btn btn-primary btn-block">Xem thêm</button>
        </p>
    </div>

</div>

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        var position = 0;
        $("#show-film").load('load-data.php', {position: position});

        $("#load-more").click(function () {
            $.ajax({
                url : 'load-data.php',
                type : 'POST',
                data : {position: position + 4},
                success : function (data) {
                    if (data.length > 0) {
                        $(".film-info:last").after(data);
                        console.log($("#show-film").height());
                        position += 4;
                        $("html").animate({scrollTop: $("#show-film").height()}, 1000, 'swing');
                    } else {
                        $("#load-more").hide();
                    }
                }
            });
        });
    });
</script>
</body>
</html>