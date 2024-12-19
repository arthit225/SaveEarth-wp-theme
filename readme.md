# Local > Staging Dev Setup

*   **Local Setup**
1. clone[](https://github.com/benshrimpton/deartomorrow)
2. Import DB file into DB. ( `db.sql.zip` file is existing in root folder. You can import this DB file in your own way)
3. download [uploads.zip](https://deartomorrostg.wpenginepowered.com/wp-content/uploads.zip) file and extract it under `wp-content` folder.
4. Activate the new theme - 'Deartomorrow 2024'.
*   **Development and Pushing to Staging**
5. When you develop on your local
    1. Define`IS_VITE_DEVELOPMENT` as `true` from `wp-content\themes\deartomorrow2024\functions.php`
    2. run the following command
        1. yarn install
        2. yarn dev
    3. You can update the files on local and the changes will be rendered to the local site.
6. If you want to push to staging
    1. Define`IS_VITE_DEVELOPMENT` as false from `wp-content\themes\deartomorrow2024\functions.php`
    2. run the following command
        1. yarn build
7. Commit the changed files to `dev` and merge into `stage` branch of git.
    1. It will be auto deployed to staging site([https://deartomorrostg.wpenginepowered.com/](https://deartomorrostg.wpenginepowered.com/))
8. If you change the DB part
    1. You can export DB file from local and import it into staging site.
    2. You can do the work of DB part on staging site directly.

  
