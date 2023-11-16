# ContaoDownloadarchiveBundle

The downloadarchive extension offers the possibility to organize files from the file system in differnet archives.

Each archive can get his own visibility for gustes and/or registered members.

You can add a title, description and preview image for each file of an 
archive and define what action should be used when an image is clicked.

## Install composer packages
    docker run -it --rm \
    -v ".:/var/www/html" \
    laemmi/php-fpm:8.1 \
    composer install