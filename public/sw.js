// importScripts('/cache-polyfill.js');

// import 'cache-polyfill'

var CACHE_NAME = 'a2hc-v1';
var urlsToCache = [
  './?v1',
  'index.html?v1',
  'offline.html?v1',
  'sw.js?v1',
  'manifest.json?v1',
  'A2HS.js?v1',
  '/icon/logo.png?v1',
  '/icon/logo192.png?v1',
  '/icon/logo256.png?v1',
  '/icon/logo512.png?v1',

  // Keperluan load aplikasi
  './plugins/fontawesome-free/css/all.min.css',
  './dist/css/adminlte.min.css',
  './plugins/jquery/jquery.min.js',
  './plugins/bootstrap/js/bootstrap.bundle.min.js',
  './plugins/chart.js/Chart.min.js',
  './dist/js/adminlte.min.js',
  './dist/js/demo.js',
  './js/app.js',
  'A2HS.js',

];


self.addEventListener('install', function (event) {
  console.log('installing service worker');
  event.waitUntil(
    caches.open(CACHE_NAME)
      .then(function (cache) {
        console.log('cache opened');
        var x = cache.addAll(urlsToCache);
        console.log('cache added');
        return x;
      })
  );
});

self.addEventListener('fetch', function (event) {
  event.respondWith(
    caches.match(event.request).then(function (response) {
      return fetch(event.request).then(function (response) {
        if (response.status === 404) {
          //return caches.match('offline.html');
          console.log("Offline");
          event.respondWith(pullFromCache(event));
        }
        return response
      });
    }).catch(function () {
      return caches.match('index.html');
    })
  );
});

function pullFromCache(event) {
  return caches.match(event.request).then((response) => {
    return caches.open(CACHE_NAME).then((cache) => {
      cache.put(event.request, response.clone());
      return response;
    });
  });
}