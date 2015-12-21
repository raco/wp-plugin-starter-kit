# WordPress Plugin Starter Kit

Super-easy WordPress plugin boilerplate for your next project.


## Usage

### Installation
```
cd wp-content/plugins
git clone https://github.com/maxkostinevich/wp-plugin-starter-kit.git your-plugin-name
cd your-plugin-name
npm install --only=dev
```

**IMPORTANT STEPS BEFORE PROCEED**
- 1. Change Application Name and Author in **package.json**
- 2. Edit pluginConfig var in **gulpfile.js**: change plugin name, plugin slug, authour, etc.

### Scaffold your project
```
// this command will replace plugin variables and rename plugin files according values defined in pluginConfig (see gulpfile.js)

gulp bootstrap
```

### Build
Build task will copy plugin files into **wp-content/plugins/your-plugin-name/build/** folder and minify css and js files
```
gulp build:plugin // build project (see wp-content/plugins/your-plugin-name/build/ folder)
gulp build:archive // create ZIP archive from ../your-plugin-name/ folder (see /build/ folder)
gulp build // build project and create ZIP archive
```

## Changelog

```
v2.0.0 - Dec 21, 2015
** Workflow changed **
    - All plugin files are moved from /app/ folder to the root folder
    - Build task has been updated

** Fixed **
    - Issue with Plugin Author URL
```

```
v1.0.0 - Dec 16, 2015
** Initial commit **
```

## [CC BY 4.0 License](http://creativecommons.org/licenses/by/4.0/)
2015 (c) [Max Kostinevich](https://maxkostinevich.com) - All rights reserved.
