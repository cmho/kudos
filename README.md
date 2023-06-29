# How To

Basically, you can drop this onto a php-enabled webserver and have it Just Work, with **one caveat**. You have to have ImageMagick installed along with the php Imagick extension.

Assuming you're on an Ubuntu box, this should do it:

```
sudo apt-get install -y libmagickwand-dev 
sudo apt-get install -y imagemagick
pecl install imagick
```

If it says to enable any modules for your web server, use the provided commands. Then, reload your web server to load all the new extensions.
