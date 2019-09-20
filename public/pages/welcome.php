<?php include_once 'inc/header.php'; ?>

<body>
    <?php include_once 'inc/header-nav.php'; ?>

    <div class="container" style="max-width: 40rem">
        <?php include_once 'inc/errors.php'; ?>

        <h1>CSV File Manipulator</h1>

        <p>
            Do you have some csv data? Have you ever wanted to upload that data to a server and then look at it in your
            browser? Well, you have come to the right place.
        </p>

        <p>
            To get started, head on over to <a class="font-weight-bold" href="<?php echo view()->url('upload'); ?>">the
                upload page</a> to upload
            your favorite csv file.
            Don't worry if you can't find one, we have a couple you can borrow.
        </p>

        <p>
            After you have uploaded / selected some data to work with, you can look at it on <a class="font-weight-bold"
               href="<?php echo view()->url('data'); ?>">our data page.</a> From there you have the option to add a new
            column to the data on <a class="font-weight-bold" href="<?php echo view()->url('add-column'); ?>">our add
                column page.</a> The column you add uses a formula
            that you provide to derive the column data from one or more of the existing columns.
        </p>

        <p>
            Thanks for visiting, and enjoy the CSV File Manipulator!
        </p>

        <h1>Tech Specs</h1>

        <ul class="list-group">
            <li class="list-group-item bg-primary">
                <span class="font-weight-bold">Vanilla PHP 7</span>. The specs for this app suggested I use vanilla PHP
                instead of a framework, so that's what I did. The only class that I did not develop from a blank page
                was the autoloader class. That was a class I had laying around from another project, but I developed it
                from a blank page, just not during this project. The structure of the project is very Laravel-ish. I
                have routes defined in index.php that could be direct drop-ins for a Laravel project. The routes are
                mapped to a Pages controller that does a little logic and then spits out a view. The views are php/html
                files that are like templates.
            </li>
            <li class="list-group-item bg-success">
                <span class="font-weight-bold">Javascript.</span> The only Javascript I "wrote" for this app was copied
                and pasted from the mdbootstrap site to initialize the data table. There is some Javascript included for
                the app, but that is all for bootstrap.
            </li>
            <li class="list-group-item bg-primary">
                <span class="font-weight-bold">Html / CSS.</span> I am not a designer, so bootstrap does all the heavy
                lifting in terms of making the presentation acceptable. I am using the material design version of
                bootstrap, but the classes I chose to use are mostly the regular bootstrap classes.
            </li>
            <li class="list-group-item bg-success">
                <span class="font-weight-bold">Git / Github.</span> The project uses git and github. There is a link in
                the upper right hand corner to view the source. I directly downloaded mdbootstrap rather than use npm. I
                have excluded the bootstrap files from the repository, so if you clone it, you will need to download
                mdbootstrap as an additional step.
            </li>
        </ul>

    </div>

</body>

</html>
