/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!****************************!*\
  !*** ./resources/js/sw.js ***!
  \****************************/
// names of cache variables
// if any file has been changed from specified
// cache then we should change version of cache name
// in case to delete old cache - only for static caches
// version of application from .env
var app_version = "1.33"; // static caches

var imagesCache = 'images-cache-v' + app_version;
var cssCache = 'css-cache-v' + app_version;
var jsCache = 'jss-cache-v' + app_version;
var assetsCache = 'assets-cache-v' + app_version;
var pluginsCache = 'plugins-cache-v' + app_version; // dynamic caches

var pagesCache = 'pages-cache';
var usersProfilesCache = 'users-profiles-cache';
var usersAvatarsCache = 'users-avatars-cache'; // all names of cache variables

var keysOfStaticCaches = [imagesCache, cssCache, jsCache, assetsCache, pluginsCache];
var keysOfDynamicCaches = [pagesCache, usersProfilesCache, usersAvatarsCache]; // urls to cache

var imagesToCache = ['/favicon.ico', '/assets/images/background.jpg', '/assets/icons/16x16.png', '/assets/icons/32x32.png', '/assets/icons/72x72.png', '/assets/icons/96x96.png', '/assets/icons/144x144.png', '/assets/icons/152x152.png', '/assets/icons/192x192.png', '/assets/icons/384x384.png', '/assets/icons/512x512.png', '/assets/icons/apple-touch-icon.png', '/assets/images/slider-images/image1.jpg', '/assets/images/slider-images/image2.jpg', '/assets/images/slider-images/image3.jpg', '/assets/images/slider-images/image4.jpg', '/assets/images/slider-images/image5.jpg', '/assets/images/help_images/download_files/tip_1.jpg', '/assets/images/help_images/download_files/tip_2.jpg', '/assets/images/help_images/download_files/tip_3.jpg'];
var cssToCache = ['/css/app.css', '/css/custom/layout.css', '/css/custom/classes.css', '/css/pages/banned.css', '/css/pages/download.css', '/css/pages/help.css', '/css/pages/offline-fallback.css', '/css/pages/options.css', '/css/pages/profile.css', '/css/pages/ranking.css', '/css/pages/welcome.css', '/css/snake_mini_game/snake.css'];
var jsToCache = ['/js/snake_mini_game/game.js', '/js/snake_mini_game/snake.js', '/js/app.js'];
var assetsToCache = ['/assets/uncensored_words.json'];
var pluginsToCache = ['/assets/plugins/Bootstrap/bootstrap.css', '/assets/plugins/Bootstrap/bootstrap.css.map', '/assets/plugins/Bootstrap/bootstrap.min.js', '/assets/plugins/Bootstrap/bootstrap.min.js.map', '/assets/plugins/BootstrapIcons/fonts/bootstrap-icons.woff', '/assets/plugins/BootstrapIcons/fonts/bootstrap-icons.woff2', '/assets/plugins/BootstrapIcons/fonts/bootstrap-icons.woff2?856008caa5eb66df68595e734e59580d', '/assets/plugins/BootstrapIcons/bootstrap-icons.css', '/assets/plugins/DataTables/DataTables-1.10.25/images/sort_both.png', '/assets/plugins/DataTables/DataTables-1.10.25/images/sort_asc.png', '/assets/plugins/DataTables/datatables.js', '/assets/plugins/DataTables/datatables.min.js', '/assets/plugins/DataTables/datatables.css', '/assets/plugins/DataTables/datatables.min.css', '/assets/plugins/DataTables/pl.json', '/assets/plugins/dropify/css/demo.css', '/assets/plugins/dropify/css/dropify.css', '/assets/plugins/dropify/css/dropify.min.css', '/assets/plugins/dropify/fonts/dropify.eot', '/assets/plugins/dropify/fonts/dropify.svg', '/assets/plugins/dropify/fonts/dropify.ttf', '/assets/plugins/dropify/fonts/dropify.woff', '/assets/plugins/dropify/js/dropify.js', '/assets/plugins/dropify/js/dropify.min.js', '/assets/plugins/jQuery/jquery-3.6.0.min.js', '/assets/plugins/jQueryBlockUI/jquery.blockUI.js', '/assets/plugins/toastr/toastr.css', '/assets/plugins/toastr/toastr.min.css', '/assets/plugins/toastr/toastr.js.map', '/assets/plugins/toastr/toastr.min.js', '/assets/plugins/cookieBar/jquery.cookieBar.css', '/assets/plugins/cookieBar/jquery.cookieBar.js', '/assets/plugins/cookieBar/jquery.cookieBar.min.js'];
var pagesToCache = ['/', '/strona-offline', '/pobierz-gre', '/pomoc', '/ranking', '/ranking/punkty', '/ranking/monety', '/ranking/easy', '/ranking/medium', '/ranking/hard', '/ranking/speed'];
var usersAvatarsToCache = ['/assets/images/avatar.png']; // install event - only once

self.addEventListener('install', function (event) {
  // caching everything
  event.waitUntil(caches.open(imagesCache).then(function (cache) {
    cache.addAll(imagesToCache);
  }), caches.open(cssCache).then(function (cache) {
    cache.addAll(cssToCache);
  }), caches.open(jsCache).then(function (cache) {
    cache.addAll(jsToCache);
  }), caches.open(assetsCache).then(function (cache) {
    cache.addAll(assetsToCache);
  }), caches.open(pluginsCache).then(function (cache) {
    cache.addAll(pluginsToCache);
  }), caches.open(usersAvatarsCache).then(function (cache) {
    cache.addAll(usersAvatarsToCache);
  }), caches.open(pagesCache).then(function (cache) {
    cache.addAll(pagesToCache);
  }));
}); // activate event

self.addEventListener('activate', function (event) {
  // removing old versions of cache
  // if array of cache keys doesnt contain specified key
  // then removing it from cache storage
  event.waitUntil(caches.keys().then(function (keys) {
    return Promise.all(keys // delete cache when cache's name is NOT in static caches and NOT in dynamics caches
    .filter(function (key) {
      return keysOfStaticCaches.includes(key) == false && keysOfDynamicCaches.includes(key) == false;
    }).map(function (key) {
      return caches["delete"](key);
    }));
  }));
}); // fetch event

self.addEventListener('fetch', function (event) {
  // getting cached assets
  event.respondWith(caches.match(event.request).then(function (cacheResponse) {
    // self.registration.scope is for example --> http://127.0.0.1:8000/login
    // so URL will be '/login'
    var pathname = event.request.url.split(self.registration.scope);
    var URL = '/' + pathname[1]; // checking if URL matches pagesToCache

    if (pagesToCache.includes(URL)) {
      var fetchResponse = fetch(event.request);
      fetchResponse.then(function (result) {
        // if there is a internet connection
        // so we can clone data and replace it with old one
        if (result.status == 200) {
          return caches.open(pagesCache).then(function (cache) {
            cache.put(URL, result.clone());
          });
        }
      }); // returning new fetched data when there is a internet connenction

      return fetch(event.request) // if there was a problem, for example no internet connection
      // returning data from old cache
      ["catch"](function () {
        return cacheResponse;
      });
    } // if requested thing is user's avatar image
    else if (URL.includes('/storage/users_avatars/') && URL.includes('?') == false) {
      var _fetchResponse = fetch(event.request);

      _fetchResponse.then(function (result) {
        if (result.status == 200) {
          return caches.open(usersAvatarsCache).then(function (cache) {
            cache.put(URL, result.clone());
          });
        }
      });

      return fetch(event.request)["catch"](function () {
        return cacheResponse;
      });
    } // if requested thing is user's profile page
    else if (URL.includes('/profil/')) {
      var _fetchResponse2 = fetch(event.request);

      _fetchResponse2.then(function (result) {
        if (result.status == 200) {
          return caches.open(usersProfilesCache).then(function (cache) {
            cache.put(URL, result.clone());
          });
        }
      });

      return fetch(event.request)["catch"](function () {
        return cacheResponse;
      });
    } // if requested thing is static
    else {
      return cacheResponse || fetch(event.request);
    }
  })["catch"](function () {
    // there is no internet connection and requested thing isn't cached
    // if requested thing is subpage and it isn't cached - show offline fallback
    if (event.request.destination == 'document') {
      return caches.match('/strona-offline');
    }
  }));
});
/******/ })()
;