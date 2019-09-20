<?php include_once 'inc/header.php'; ?>

<body>
    <?php include_once 'inc/header-nav.php'; ?>

    <div class="container" style="max-width: 40rem">
        <?php include_once 'inc/errors.php'; ?>

        <h1>Add a Column</h1>

        <h3>These are the existing columns:</h3>

        <ul class="list-group">
            <?php
            foreach ($columns as $col) {
                echo "<li class=\"list-group-item list-group-item-warning\">$col</li>";
            }
            ?>
        </ul>

        <div class="alert alert-info my-3" role="alert">
            Only use the above column names with these operators:
            <div class="text-center font-weight-bold display-4">
                *&nbsp;&nbsp;-&nbsp;&nbsp;+&nbsp;&nbsp;/&nbsp;&nbsp;&amp;
            </div>
            in your formula.
        </div>

        <form action="<?php echo view()->url('add-column'); ?>" class="border border-light p-5" method="POST">
            <div class="md-form form-lg">
                <input type="text" id="colName" name="colName" class="form-control form-control-lg">
                <label for="colName">Column name</label>
            </div>

            <div class="md-form">
                <input type="text" id="formula" name="formula" class="form-control">
                <label for="formula">Formula</label>
            </div>


            <!-- <label class="mb-0 ml-2" for="newFileName">
                Existing file name: <php echo $fileName;?>
            </label>
            <div class="md-form input-group mt-0 mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text md-addon" id="existingFileName">
                        New file name
                    </span>
                </div>
                <input type="text" class="form-control" id="newFileName" name="newFileName"
                       aria-describedby="existingFileName">
            </div> -->

            <button class="btn btn-primary mt-4" type="submit">Add Column</button>
        </form>
    </div>

    <?php include_once 'inc/js-footer.php'; ?>

</body>

</html>
