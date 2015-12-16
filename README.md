# WordPress Plugin Starter Kit

Super-easy WordPress plugin boilerplate for your next project.


## Usage

### Installation
```
cd wp-content/plugins
git clone https://github.com/maxkostinevich/wpplugin-starter-kit.git your-plugin-name-starter-kit
cd your-plugin-name-starter-kit
npm install --only=dev
```

**IMPORTANT: STEPS BEFORE PROCEED**
1. Change Application Name and Author in **package.json**
2. Edit pluginConfig var in **gulpfile.js**: change plugin name, plugin slug, authour, etc.

### Scaffold your project
```
// this command will replace plugin variables and rename plugin files according values defined in pluginConfig (see gulpfile.js)

gulp bootstrap
```

### Build
Build task will copy files from **/app/** to **wp-content/plugins/your-plugin-name/**
```
gulp build:plugin // build project (see wp-content/plugins/your-plugin-name/ folder)
gulp build:archive // create ZIP archive from ../your-plugin-name/ folder (see /build folder)
gulp build // build project and create ZIP archive
```

## [CC BY 4.0 License](http://creativecommons.org/licenses/by/4.0/)
2015 (c) [Max Kostinevich](https://maxkostinevich.com) - All rights reserved.
