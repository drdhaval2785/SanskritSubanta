SanskritSubanta
==============

# IMPORTANT: THIS REPO IS DEPRECATED!

This code is now subsumed under the [`drdhaval2785/SanskritVerb repository`](https://github.com/drdhaval2785/SanskritVerb) and all development will continue there. Please open any issues and pull requests to the **SanskritVerb** repo.

### Online Demos

* [*tiṅanta* generation (verb conjugation)](http://www.sanskritworld.in/sanskrittool/SanskritVerb/tiGanta.html)
* [*subanta* generation (noun declension)](http://www.sanskritworld.in/sanskrittool/subanta.html)
* [*sandhi* generation](http://www.sanskritworld.in/sanskrittool/sandhi.html)

### Running the Code Locally with XAMPP

This is a one time exercise. Once you have completed the steps below, you should only open your browser (Firefox, Chrome, Internet Explorer, etc.) and browse to `localhost/SanskritVerb/tiGanta.html` to access a frontend that will allow you to interact with the machine.

1. Download the latest version of [XAMPP](https://www.apachefriends.org/index.html)
2. Install XAMPP
3. Locate XAMPP directory. Usually it is `c://xampp`
4. Go to `xampp/htdocs` directory
5. Create a directory named `sanskrit`
6. Copy-and-paste the files mentioned in the next section in `sanskrit` directory (This is a one-time job)
7. Go to the `xampp` folder and click on `xampp-control`
8. Click start for **Apache**, **MySQL**, **Filezilla** (This you have to do all time you start your computer — this functions as server for your html and php files)

### For Sandhi generation:

This is an attempt to create an open source sandhi joiner.

The text used is **Siddhāntakaumudī**.

Install `sandhi.html`, `sandhi.php`, `dev-slp.php`, `slp-dev.php`, `function.php` and the `mystyle.css` in your localhost and run the `sandhi.html`.

Input your words and provide necessary user input. Machine will fetch the output from the PHP files and display it on screen. Be patient. It may take nearly a minute or so.

**For offline usage, please run `localhost/sanskrit/sandhi.html` from your browser.**

### For Subanta generation:

Install `dev-slp.php`, `slp-dev.php`, `function.php`, `mystyle.css`, `subanta.html`, `subanta.php`, `ajax.php` and `script.js` in your system and then input a word.

Give the feedback if the machine asks for any.

Then machine will give you derivation of all 21 vibhakti sets of that particular word.

**For offline usage, please run `localhost/sanskrit/subanta.html` from your browser.**
