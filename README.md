# _Lib Tech - 2014-2015 WordPress Theme_

**WordPress theme for the lib-tech.com Wordpress website.**

The primary goals of this build process are a clean, component based organization, mixed with automation for CSS/SASS and JavaScript concatenation and minification/uglification.

## Author(s) / Inspiration
Build process, base styles, and JavaScript by [Brian Behrens](http://github.com/brainbrian) with help from [Nick Katarow](http://github.com/nkatarow).

Original [HTML5 Reset WordPress Theme](https://github.com/murtaugh/HTML5-Reset-WordPress-Theme) built by [Tim Murtaugh](https://github.com/murtaugh).

SASS Structure and base styles inspired by [Brad Frost](http://bradfrostweb.com/)'s [Pattern Lab](http://demo.patternlab.io/).

## What it does

**CSS/SASS**

CSS development files are compiled into the **_/compiled/** directory from the files imported by the **_ui/css/libtech.main.scss** file. They are then compressed into a production file (**_ui/css/libtech.main.css**) without debug info or a source map. The main CSS file is then minified for a final production build (**_ui/css/libtech.main.min.css**). Note that whenever a new .scss file is added, it must be manually added to the **_ui/css/libtech.main.scss** file.

The CSS directory structure broken into four categories.

* **helpers** - Used primarily for things like CSS reset/normalize files, SASS variables and mixins.
* **base** - Intended for base, classless, global styles for HTML elements. In addition, utilities like clear fixes and offscreen text can be considered base styles.
* **components** - Where the majority of your custom styling should take place. For best organization, create a new file for each new component you build and take advantage of SASS nesting techniques to keep your components self contained.
* **lib** - 3rd party CSS that is used to style JavaScript components imported from 3rd party libraries should live here.

**JavaScript**

The JavaScript build process varies slightly from the CSS process for easier debugging in development. Details on the differences between the development and production processes can be found in the **Usage** section below.

The JavaScript directory structure broken into two categories.

* **components** - Outside of the **_/js/libtech.main.js** file, all of your JS components should be placed here. By default, this comes with an empty name spaced file to used as a template.
* **libs** - Put all 3rd party JS libraries here. They can be loaded into the header or footer by specifying them at the top of the **Gruntfile.js** file. 3rd party library files can also be included conditionally outside of the compiled header and footer files. This comes with jQuery 1.11.1, Modernizr 2.7.2, FitVids 1.1.0, and Respond.js 1.4.2 by default.

**Templates**

The included templates are largely unchanged from the HTML5 Reset WordPress Theme. There are include files in the **header.php** and **footer.php** that include the appropriate JavaScript and CSS files based on your **Gruntfile.js** configuration. Modify both files (**_/inc/header-includes.php** and **_/inc/footer-includes.php**) to reference the correct development host (default is **libtech.dev**) and namespace within the file names.

* **_/inc/header-includes.php** - If the development host is detected, the extended syntax **_/css/libtech.main.css** and compiled list of scripts as described in the **Usage** section below (**_/inc/header-scripts.php**) files will be loaded. If the host is anything other than the one mentioned in the if/then, the compiled and minified **_/css/libtech.main.min.css** and the concatenated and uglified **_/js/libtech.header.min.js** will be loaded instead.

* **_/inc/footer-includes.php** - Similar to the **header-includes.php** file above, this performs the same test, but instead will either load the compiled list of scripts (**_/inc/footer-scripts.php**) or the concatenated and uglified **_/js/libtech.footer.min.js** will be loaded instead.

## Setup
To get the app up and running, you will need to make sure you have the following software installed prior to running. If you've already got these all installed, skip to the app dependencies.

### System Dependancies
* [Node](http://nodejs.org/) - Download and install using the link provided.
* [NPM](https://npmjs.org/) - This should be installed automatically with Node.js.
* [Grunt](http://gruntjs.com/getting-started) - Run the following command after Node/NPM are installed:

```
$ npm install grunt-cli -g
```

* [Sass](http://sass-lang.com/) - Assuming you're running ruby, run the following command (if you get an error, try running with sudo):

```
gem install sass
```

### Application Dependencies
Once you have the proper system dependencies installed, run the following command in the application's root directory:

```
npm install
```

## Usage
Below you'll fine a list of commands to perform varying tasks followed by a detailed description of what each does.

```
grunt run
```
* **CSS/SASS**
	* The run grunt task will check the **_/css/libtech.main.scss** file and compile all the specified scss files into **_/compiled/libtech.main.css**. This CSS style is expanded, have a sourcemap file, trace, debug info and line number. This is the CSS file loaded when viewing the development site.
* **JavaScript**
	* The run grunt task will also run through the js files included in the **Gruntfile.js** and create the two PHP files to include (**_/inc/header-scripts.php** and **_/inc/footer-scripts.php**). **header-scripts.php** includes only libraries that live in the **headerScripts** array variable at the top of the **Gruntfile.js** configuration. **footer-scripts.php** includes those in the **footerScripts** array variable at the top of the **Gruntfile.js** configuration, which currently includes the main JavaScript application file (**_/js/libtech.main.js**).

```
grunt watch
```
The watch task will look for changes on all SCSS and JS files, automatically run the same processes as the default grunt task, and reload your webpage for you. (**Note:** If new files are added, you will make sure they are added as described above and the default grunt task will need to be run first.)

```
grunt build
```
The build task should be run when you're ready to generate or update your optimized production files.

* **CSS/SASS**
	* Again, the task will check your **_/css/libtech.main.scss** file for which SASS files to include.
	* This time, it will compile to **_/css/libtech.main.css** but will be compressed and will not include any of the debug options turned on for the development build.
	* From that compiled file, CSS minification will be performed, further compressing the file size to a new production ready file **_/css/libtech.main.min.css**.
* **JavaScript**
	* Again, the **_/inc/header-scripts.php** and **_/inc/footer-scripts.php** files will be created.
	* From those, two files will be created (**_/js/libtech.header.min.js** and **_/js/libtech.footer.min.js**) where all of the separate files listed in the PHP includes will be concatenated.
	* From there, both of the concatinated JS files will be uglified (compressed).

## Libraries Included
* jQuery
* Modernizr
* FitVids
* RespondJS
* GSAP
