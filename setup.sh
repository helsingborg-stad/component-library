#!/bin/bash
# Script to change plugin name occurances

rm README.md
mv ./README_template.md README.md

echo "\033[35mWordPress Plugin Boilerplate setup. Please follow the steps in this setup guide to properly setup your new WordPress Plugin Boilerplate.\033[0m"

echo "\033[34m\033[1mEnter the name of your plugin (readable):\033[0m "
read plugin_name
find ./ -type f ! -name "Init.sh" -exec sed -i '' -e "s/(#plugin_name#)/$plugin_name/g" {} >/dev/null 2>&1 \;

echo "\033[34m\033[1mEnter short plugin description:\033[0m "
read plugin_description
find ./ -type f ! -name "Init.sh" -exec sed -i '' -e "s/(#plugin_description#)/$plugin_description/g" {} >/dev/null 2>&1 \;

echo "\033[34m\033[1mEnter plugin url:\033[0m "
read plugin_url
find ./ -type f ! -name "Init.sh" -exec sed -i '' -e "s:(#plugin_url#):$plugin_url:g" {} >/dev/null 2>&1 \;

echo "\033[34m\033[1mEnter plugin slug:\033[0m "
read plugin_slug
find ./ -type f ! -name "Init.sh" -exec sed -i '' -e "s/(#plugin_slug#)/$plugin_slug/g" {} >/dev/null 2>&1 \;

echo "\033[34m\033[1mEnter plugin name in capitals without punctiuation or white spaces LIKETHIS:\033[0m "
read plugin_cap
find ./ -type f ! -name "Init.sh" -exec sed -i '' -e "s/(#plugin_cap#)/$plugin_cap/g" {} >/dev/null 2>&1 \;

echo "\033[34m\033[1mEnter plugin namespace:\033[0m "
read plugin_namespace
find ./ -type f ! -name "Init.sh" -exec sed -i '' -e "s/(#plugin_namespace#)/$plugin_namespace/g" {} >/dev/null 2>&1 \;

echo "\033[34m\033[1mEnter plugin author name:\033[0m "
read plugin_author
find ./ -type f ! -name "Init.sh" -exec sed -i '' -e "s/(#plugin_author#)/$plugin_author/g" {} >/dev/null 2>&1 \;

echo "\033[34m\033[1mEnter plugin author url:\033[0m "
read plugin_author_url
find ./ -type f ! -name "Init.sh" -exec sed -i '' -e "s:(#plugin_author_url#):$plugin_author_url:g" {} >/dev/null 2>&1 \;

# Rename plugin-name.* to plugin_slug
mv ./plugin-name.php ${plugin_slug}.php
mv ./source/js/plugin-name.js ./source/js/${plugin_slug}.js
mv ./source/sass/plugin-name.scss ./source/sass/${plugin_slug}.scss

echo "\033[34m\033[1mLean back while I install required node modules for you…\033[0m"
npm install

# Clean up
rm setup.sh
find . -maxdepth 1 -name '*.DS_Store' -delete

echo "\033[92m\033[1mAll done!\033[0m"
