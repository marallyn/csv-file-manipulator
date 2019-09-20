<?php include_once 'inc/header.php'; ?>

<body>
    <?php include_once 'inc/header-nav.php'; ?>

    <div class="container" style="max-width: 40rem">
        <?php include_once 'inc/errors.php'; ?>

        <h1>Upload some data</h1>

        <form action="/upload" class="border border-light p-5" enctype="multipart/form-data" method="POST">
            <input type="hidden" name="MAX_FILE_SIZE" value="50000" />

            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Upload</span>
                </div>

                <div class="custom-file">
                    <input class="custom-file-input" id="data_file" name="data_file" type="file">
                    <label class="custom-file-label" for="data_file">
                        Choose file
                    </label>
                </div>
            </div>

            <button class="btn btn-primary mt-4" type="submit">Upload</button>
        </form>

        <h1 class="mt-4">Or ... Use Existing Data</h1>

        <!-- <ul class="list-group">
            <?php
            foreach ($files as $file) {
                echo "<li class=\"list-group-item\">$file</li>";
            }
            ?>
        </ul> -->


        <div class="list-group">
            <?php
            foreach ($files as $file) {
                echo "<a href=\"" . view()->url("data?file=$file") . "\" class=\"list-group-item list-group-item-action\">$file</a>";
            }
            ?>
        </div>

    </div>




    <?php include_once 'inc/js-footer.php'; ?>

</body>

</html>
