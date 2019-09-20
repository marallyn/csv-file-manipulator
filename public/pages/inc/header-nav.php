<div class="container">
    <!--Navbar -->
    <nav class="mb-3 navbar navbar-expand-lg navbar-dark primary-color">
        <span class="navbar-brand">CSV File Manipulator</span>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-333"
                aria-controls="navbarSupportedContent-333" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent-333">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo view()->url(''); ?>">Welcome</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo view()->url('upload'); ?>">Upload</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo view()->url('data'); ?>">Data</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo view()->url('add-column'); ?>">Add Column</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto nav-flex-icons">
                <li class="nav-item">
                    <a class="nav-link waves-effect waves-light"
                       href="https://github.com/marallyn/csv-file-manipulator">
                        <i class="fab fa-github"></i>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    <!--/.Navbar -->
</div>
