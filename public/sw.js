(()=>{var s="images-cache-v2.12",e="css-cache-v2.12",a="js-cache-v2.12",n="assets-cache-v2.12",t="plugins-cache-v2.12",i="pages-cache",o="users-profiles-cache",c="users-avatars-cache",r=[s,e,a,n,t],p=[i,o,c],g=["/favicon.ico","/assets/images/background.jpg","/assets/icons/16x16.png","/assets/icons/32x32.png","/assets/icons/72x72.png","/assets/icons/96x96.png","/assets/icons/144x144.png","/assets/icons/152x152.png","/assets/icons/192x192.png","/assets/icons/384x384.png","/assets/icons/512x512.png","/assets/icons/apple-touch-icon.png","/assets/images/slider_images/image1.png","/assets/images/slider_images/image2.png","/assets/images/slider_images/image3.png","/assets/images/slider_images/image4.png","/assets/images/slider_images/image5.png","/assets/images/slider_images/image6.png","/assets/images/snake_mini_game/board_background_brown.png","/assets/images/snake_mini_game/board_background_green.png","/assets/images/snake_mini_game/board_background_purple.png"],u=["/css/app.css","/css/components/send-message.css","/css/custom/classes.css","/css/custom/layout.css","/css/pages/help.css","/css/pages/options.css","/css/pages/profile.css","/css/pages/welcome.css","/css/snake_mini_game/buttons.css","/css/snake_mini_game/food.css","/css/snake_mini_game/options.css","/css/snake_mini_game/score.css","/css/snake_mini_game/snake-mini-game.css","/css/snake_mini_game/snake.css"],l=["/js/snake_mini_game/food.js","/js/snake_mini_game/game.js","/js/snake_mini_game/grid.js","/js/snake_mini_game/input.js","/js/snake_mini_game/options.js","/js/snake_mini_game/score.js","/js/snake_mini_game/snake.js","/js/app.js"],m=["/assets/uncensored_words.json"],f=["/assets/plugins/Bootstrap/bootstrap.css","/assets/plugins/Bootstrap/bootstrap.css.map","/assets/plugins/Bootstrap/bootstrap.min.js","/assets/plugins/Bootstrap/bootstrap.min.js.map","/assets/plugins/BootstrapIcons/fonts/bootstrap-icons.woff","/assets/plugins/BootstrapIcons/fonts/bootstrap-icons.woff2","/assets/plugins/BootstrapIcons/fonts/bootstrap-icons.woff2?856008caa5eb66df68595e734e59580d","/assets/plugins/BootstrapIcons/bootstrap-icons.css","/assets/plugins/cookieBar/jquery.cookieBar.css","/assets/plugins/cookieBar/jquery.cookieBar.js","/assets/plugins/cookieBar/jquery.cookieBar.min.js","/assets/plugins/DataTables/DataTables-1.10.25/images/sort_both.png","/assets/plugins/DataTables/DataTables-1.10.25/images/sort_asc.png","/assets/plugins/DataTables/datatables.js","/assets/plugins/DataTables/datatables.min.js","/assets/plugins/DataTables/datatables.css","/assets/plugins/DataTables/datatables.min.css","/assets/plugins/DataTables/pl.json","/assets/plugins/dropify/css/demo.css","/assets/plugins/dropify/css/dropify.css","/assets/plugins/dropify/css/dropify.min.css","/assets/plugins/dropify/fonts/dropify.eot","/assets/plugins/dropify/fonts/dropify.svg","/assets/plugins/dropify/fonts/dropify.ttf","/assets/plugins/dropify/fonts/dropify.woff","/assets/plugins/dropify/js/dropify.js","/assets/plugins/dropify/js/dropify.min.js","/assets/plugins/jQuery/jquery-3.6.0.min.js","/assets/plugins/jQueryBlockUI/jquery.blockUI.js","/assets/plugins/js-cookie/js.cookie.js","/assets/plugins/js-cookie/js.cookie.min.js","/assets/plugins/js-cookie/js.cookie.min.mjs","/assets/plugins/js-cookie/js.cookie.mjs","/assets/plugins/toastr/toastr.css","/assets/plugins/toastr/toastr.min.css","/assets/plugins/toastr/toastr.js.map","/assets/plugins/toastr/toastr.min.js"],d=["/","/gra","/strona-offline","/pobierz-gre","/pomoc","/ranking","/ranking/punkty","/ranking/monety","/ranking/easy","/ranking/medium","/ranking/hard","/ranking/speed"],h=["/assets/images/avatar.png"];self.addEventListener("install",(function(o){o.waitUntil(caches.open(s).then((function(s){s.addAll(g)})),caches.open(e).then((function(s){s.addAll(u)})),caches.open(a).then((function(s){s.addAll(l)})),caches.open(n).then((function(s){s.addAll(m)})),caches.open(t).then((function(s){s.addAll(f)})),caches.open(c).then((function(s){s.addAll(h)})),caches.open(i).then((function(s){s.addAll(d)})))})),self.addEventListener("activate",(function(s){s.waitUntil(caches.keys().then((function(s){return Promise.all(s.filter((function(s){return 0==r.includes(s)&&0==p.includes(s)})).map((function(s){return caches.delete(s)})))})))})),self.addEventListener("fetch",(function(s){s.respondWith(caches.match(s.request).then((function(e){var a="/"+s.request.url.split(self.registration.scope)[1];return d.includes(a)?(fetch(s.request).then((function(s){if(200==s.status)return caches.open(i).then((function(e){e.put(a,s.clone())}))})),fetch(s.request).catch((function(){return e}))):a.includes("/storage/users_avatars/")&&0==a.includes("?")?(fetch(s.request).then((function(s){if(200==s.status)return caches.open(c).then((function(e){e.put(a,s.clone())}))})),fetch(s.request).catch((function(){return e}))):a.includes("/profil/")&&0==a.includes("/profil/ustawienia")?(fetch(s.request).then((function(s){if(200==s.status)return caches.open(o).then((function(e){e.put(a,s.clone())}))})),fetch(s.request).catch((function(){return e}))):e||fetch(s.request)})).catch((function(){if("document"==s.request.destination)return caches.match("/strona-offline")})))}))})();
//# sourceMappingURL=sw.js.map