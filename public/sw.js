// importScripts('/cache-polyfill.js');

// import 'cache-polyfill'

var CACHE_NAME = 'aset-tree-v1';
var urlsToCache = [
    '/login',
    // '/',
    // '/offline',
    // 'offline.html',
    '/',
    '/offline.html',
    'index.html?v1',
    'offline.html?v1',
    'sw.js?v1',
    'manifest.json?v1',
    'A2HS.js?v1',
    '/icon/logo.png?v1',
    '/icon/logo192.png?v1',
    '/icon/logo256.png?v1',
    '/icon/logo512.png?v1',
    '/icon/Logo.png',
    '/css/bootstrap.min.css',
    '/css/atlantis.min.css',

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
            var x = cache.addAll(urlsToCache);
            return x;
        })
    );
});

self.addEventListener('fetch', function (event) {
    event.respondWith(
        caches.match(event.request).then(function (response) {
            if (response) {
                return response;
            }

            return fetch(event.request).then(function (response) {
                if (!response || response.status !== 200 || response.type !== 'basic') {
                    return response
                }

                let responseToCache = response.clone()

                caches.open(CACHE_NAME).then(function (cache) {
                    cache.put(event.request, responseToCache)
                })

                return response
            })
        }).catch(function(){
          return caches.match('offline.html')
        })
    );
});

self.addEventListener('activate', function (event) {
    let cacheWhiteList = CACHE_NAME;

    event.waitUntil(
        caches.keys().then(function (cacheNames) {
            return Promise.all(
                cacheNames.filter(function (cacheName) {
                    // Return true if you want to remove this cache,
                    // but remember that caches are shared across
                    // the whole origin
                }).map(function (cacheName) {
                    return caches.delete(cacheName);
                })
            );
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
