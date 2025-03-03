self.addEventListener('install', function (event) {
    event.waitUntil(
        caches.open('my-cache').then(function (cache) {
            return cache.addAll([
                '/',
                '/path/to/your/styles.css',
                '/path/to/your/scripts.js',
                '/path/to/your/images/*'
            ]);
        })
    );
});

self.addEventListener('fetch', function (event) {
    event.respondWith(
        caches.match(event.request).then(function (response) {
            return response || fetch(event.request);
        })
    );
});

