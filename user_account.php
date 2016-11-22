<?php
    include_once "common/base.php";
    include_once "common/header.php";
?>

    <body>
        <p>Put something here.</p>

        <form action="upload.php" method="post" enctype="multipart/form-data">
            Select image to upload:
            <input type="file" name="fileToUpload" id="fileToUpload">
            <input type="submit" value="Upload Image" name="submit">
        </form>
    </body>

    <?php include_once "common/footer.php"; ?>