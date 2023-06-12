
<div align="center">
    <h2>WebMeIn</h2>
    <img style="filter: invert(100%) sepia(100%) saturate(0%) hue-rotate(33deg) brightness(113%) contrast(102%)" src="public/assets/img/LOGO.svg"/>
</div>

# About WebMeIn
WebMeIn was created in order to develop competences by students of secondary schools, and above all of technical schools.</br>
The application aims to collect various types of web technology courses that will support high school students, especially technical schools. The application will mainly be created by a community that will be able to create new content and edit existing content !

# Requirement
- Php 8.0+
- Composer 2.3.5
- Node 16.13
- Npm 8.3.0
## How configure
- configure .env
- configure v-hosts
## Commands in repo directory
- composer install
- npm install 
- npm install vite
- php artisan storage:link
- composer require davcpas1234/laravelpdfviewer
- php artisan vendor:publish --provider="Davcpas1234\LaravelPdfViewer\LaravelPdfViewerServiceProvider"
### Database
- php artisan migrate
- create in database in table categories category like (bootstrap, laravel, vue, ...)

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
