Posty
========

<iframe src="//benschwarz.github.io/bower-badges/embed.html?pkgname=posty" width="160" height="32" allowtransparency="true" frameborder="0" scrolling="0"></iframe>

Full and partial UK post code API using Zoopla written in PHP, Python, and Ruby. Example has been written in Angular, and uses the PHP version by default.

Install with the lovely Bower: `bower install posty`.

Getting Started
--------

 * Change the `ZOOPLA_API_KEY` for yours;
 * Abide by the <a href="http://developer.zoopla.com/">Zoopla API guidelines</a>;
 * Don't bombard Nominatim with requests;

Please see the `example/index.html` for an example of how it works. However, essentially you pass `postCode` to the implementation of your choice (Ruby, PHP, Python), and let Posty do the rest for you!

Since Zoopla limit requests &ndash; 100 per hour, Posty uses Nominatim for full post-code searching, and only utilises Zoopla for partial post-code searching (SE14, NG9, LE6, et cetera...).