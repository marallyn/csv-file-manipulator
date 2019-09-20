<?php include_once 'inc/header.php'; ?>

<body>
    <?php include_once 'inc/header-nav.php'; ?>

    <main class="container">
        <h1>Your Amazing Data File</h1>

        <?php echo $tableHtml; ?>

        <a href="<?php echo view()->url('add-column'); ?>" class="btn btn-primary">Add Column</a>
    </main>

    <?php include_once 'inc/js-footer.php'; ?>
    <!-- MDBootstrap Datatables  -->
    <script type="text/javascript" src="js/addons/datatables.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
        $('.dataTables_length').addClass('bs-select');
    });
    </script>

</body>

</html>
