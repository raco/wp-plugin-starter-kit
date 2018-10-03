# WordPress Plugin Starter Kit (Boilerplate)

Super-easy WordPress plugin boilerplate which you can use to develop your own plugin for WordPress.

**Features:**
- Easy to get started
- Clean and well-commented object-oriented code
- Developed using best WordPress practices
- Modern workflow with npm and gulp
- Useful modules are included

**Included Modules:**
- Custom Database Tables with CRUD (Create, Read, Update, Delete) feature
- Custom Taxonomies and Custom Post Types
- AJAX
- Shortcode (with TinyMCE plugin)
- Plugin Settings (Settings page with tabs is included)

**Coming soon:**
- Frontend Widgets
- Admin Dashboard Widgets
- Custom Metaboxes
- Guides and How-to Manuals


## Usage

### Installation
```
cd wp-content/plugins
git clone https://github.com/maxkostinevich/wp-plugin-starter-kit.git your-plugin-name
cd your-plugin-name
rm -rf .git
rm README.md
npm install --only=dev
```

**IMPORTANT STEPS BEFORE PROCEED**
- 1. Change Application Name and Author in **package.json**
- 2. Edit pluginConfig var in **gulpfile.js**: change plugin name, plugin slug, author, etc.

### Scaffold your project
```
// this command will replace plugin variables and rename plugin files according to values defined in the pluginConfig (see gulpfile.js)

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
v2.2.1 - May 24, 2016
** Fixes **
    - Fix dbDelta() query
    - Prefix is added to settings tabs
    - Code formatting changed
```

```
v2.2.0 - Apr 07, 2016
** NEW **
    - Setting field: colorpicker
    - Setting field: multiple colorpicker
    - Setting field: HTML
    - Setting field: Text field with media-uploader button
    - /.assets/ folder could be used to store plugin sources (psd, svg-fonts, etc)
    
** Updates **
    - Admin class has been splitted
    - Plugin_Name_Public class has been renamed to Plugin_Name and moved to /includes/ folder
** Fixes **
    - AJAX access-level
    - Prevent files from direct access
```

```
v2.1.0 - Jan 22, 2016
** NEW **
    - Settings Page has been added
    - Example of plugin settings
    - Example of settings page with tabs
    - PHP Error reporting has been added

** Updates **
    - Plugin version is now stored in the database
    - Code formatting and comments
    - All plugin modules are marked with comments ** Plugin Module: <MODULE NAME> ** and ** Module End: <MODULE NAME> **

** Fixes **
    - Issue with Plugin_Name_CPT class
    - Issue with calling non-static method in Plugin_Name_DB class
```

```
v2.0.0 - Dec 21, 2015
** Deployment workflow has been changed **
    - All plugin files are moved from /app/ folder to the root folder
    - Build task has been updated

** Fixes **
    - Issue with Plugin Author URL
```

```
v1.0.0 - Dec 16, 2015
** Initial commit **
```

## [GPL-2.0+ License](http://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html)
(c) 2015 - 2016 [Max Kostinevich](https://maxkostinevich.com) - All rights reserved.
