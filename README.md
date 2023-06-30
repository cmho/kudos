# Kudos

This is a small script that allows you to create arbitrary works that people can leave kudos on by clicking a link. Each work allows one kudos per IP address. You also get a url for each work to display the number of kudos that have been left as an image, which is easily include-able most places. You can use it on your writing! You can use it for scripts like this! You can do WHATEVER YOU WANT ✨

## How To

Basically, you can drop this onto a php-enabled webserver and have it Just Work, with **one caveat**. You have to have ImageMagick installed along with the php Imagick extension, and also make sure you have the Sqlite3 extension installed. This means you'll need a web host where you have admin access, or where you can get someone who has that access to install packages for you. [DigitalOcean](https://digitalocean.com/) will get you that hosting for $4 a month if you so choose—it'll run on the smallest specs they have.

(It's totally reasonable to also share one of these instances with a group of friends.)

Assuming you're on an Ubuntu box, this should do it:

```
sudo apt-get install -y libmagickwand-dev 
sudo apt-get install -y imagemagick
pecl install imagick

sudo apt-get install -y libsqlite3-0 libsqlite3-dev php-sqlite3
```

If it says to enable any modules for your web server, use the provided commands. Then, reload your web server to load all the new extensions.

## Using This Thing

The first thing you'll want to do is go to `[web root]/kudos.php?addwork` and, well, add some work IDs. These are arbitrary strings, so you can do numbers, or abbreviations, or whole-ass sentences, though they will get sanitized to prevent someone messing with your database. Once you submit the form, it'll give you a pair of links: one for people to visit to give kudos, and the other to an image that displays the number of kudos.

When you're linking to the `/kudos?give=[id]` link, you may want to add the `target="_blank"` attribute to the link so it opens in a new window and doesn't navigate people away from the page!


## Customizing

There are some customizable settings in config.php! You don't need to edit them to have it work, but you might want to. You can change the font by dropping additional font files into your install and changing the file in the text settings.

If you like, you can also change the look and feel of the interface by editing the html in `template.php` and the css in `style.css`. Just don't touch the line that says `<?= $content; ?>` since that prints the page content.

## Licensing, Modification, Etc

This is free! I may or may not make updates in the future to improve it and add functionality, but I wanted to make it as simple as possible so that the maximum number of people could use it easily. People are also welcome to fork it and adapt the code for their own purposes; no credit is required.
