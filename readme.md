# CSV File Manipulator

## Tech Specs

-   **Vanilla PHP 7**

    -   The specs for this app suggested I use vanilla PHP instead of a
        framework, so that's what I did. The only class that I did not develop
        from a blank page was the autoloader class. That was a class I had
        laying around from another project, but I developed it from a blank
        page, just not during this project. The structure of the project is very
        Laravel-ish. I have routes defined in index.php that could be direct
        drop-ins for a Laravel project. The routes are mapped to a Pages
        controller that does a little logic and then spits out a view. The views
        are php/html files that are like templates.

-   **Javascript.**

    -   The only Javascript I "wrote" for this app was copied and pasted from
        the mdbootstrap site to initialize the data table. There is some
        Javascript included for the app, but that is all for bootstrap.

-   **Html / CSS.**

    -   I am not a designer, so bootstrap does all the heavy lifting in terms of
        making the presentation acceptable. I am using the material design
        version of bootstrap, but the classes I chose to use are mostly the
        regular bootstrap classes.

-   **Git / Github.**
    -   The project uses git and github. There is a link in the upper right hand
        corner to view the source. I directly downloaded mdbootstrap rather than
        use npm. I have excluded the bootstrap files from the repository, so if
        you clone it, you will need to download mdbootstrap as an additional
        step.
