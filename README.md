# _LIB TECH - WordPress Theme_

_Description: WordPress theme for the Lib-Tech.com website_

##Author

Brian Behrens (<http://github.com/brainbrian>)

## Setup

### Requirements

To get the theme up & running you wil need to make sure you have 3 pieces of software installed on your machine:

- [Node.js](http://nodejs.org/)
- [NPM](https://npmjs.org/) - This should be installed automatically with Node.js.
- [Grunt](http://gruntjs.com/getting-started) - Run the following command: 

```
$ npm install grunt-cli -g
```

### Install Dependencies

Once you have Node, NPM & Grunt, you will need to run the following command from your project's directory to install the dependencies:

```
$ sudo npm install
```

If you do not have [SASS](http://sass-lang.com/install) installed, run the following command:

```
$ sudo gem install sass
```

To check if SASS is installed properly, run the following command:

```
$ sass -v
```

## Build

To run the app within a dev environment, build with the following command:

```
$ grunt run
```

To run the app within a prod environment, build with the following command:

```
$ grunt build
```