<?php require("watermark.php"); ?>

<!DOCTYPE HTML>
<html>
    <head>
        <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>

        <form action="" id="upload-form" method="post" class="pure-form" enctype="multipart/form-data">
            <div id="image-cropper">
            <div class="cropit-preview"></div>
            <div id="control">
                <input type="range" class="cropit-image-zoom-input" style="width:180px" />
                <input type="button" class="pure-button pure-button-primary" value="Crop Image" id="crop-btn" style="width:180px"></input>
            </div>
            <input type="file" id="filepath" class="cropit-image-input" style="width:100%" />
            <input type="hidden" id="resource_image" name="data"/>
            <p id="a"></p>
        </form>

    </body>

    <script src="https://code.jquery.com/jquery-2.2.3.min.js"></script>
    <script src="js/jquery.cropit.js"></script>
    <script>

        $('#image-cropper').cropit({
            imageBackground: true,
            imageBackgroundBorderWidth: 15 // Width of background border
        });

        $('#crop-btn').click(function() {
            var string = $("#filepath").val()
            if (string != "") {
                var imageData = $('#image-cropper').cropit('export');
                $("#resource_image").val(imageData);
                $("#upload-form").submit();
            }
            else {
                alert("กรุณาเลือกภาพที่ต้องการก่อน");
            }
        });

    </script>

</html>