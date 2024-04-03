let cacheName = 'v1.0';
let offlineNotification = null;
let cacheAssets = [
    '/view/index.php',
    '/view/acceuil.php',
    '/view/cgu.php',
    '/view/compte.php',
    '/view/entete.php',
    '/view/entreprise.php',
    '/view/error.php',
    '/view/footer.php',
    '/view/mention.php',
    '/view/offre.php',
    '/view/recherche.php',
    '/view/main.js',
    '/view/style.css',
    '/view/manifest.json'
]

self.addEventListener('install', e => {
      console.log('Service Worker: Installation');
      e.waitUntil(
            caches
              .open(cacheName)
              .then(cache => {
                cache.addAll(cacheAssets);
              })
              .then(() => self.skipWaiting())
          );
    offlineNotification = null;

});    

self.addEventListener('activate', e => {
    console.log('Service Worker: Activation');
    e.waitUntil(
        caches.open('my-cache').then(function(cache) {
            return cache.addAll(cacheAssets);
        })
    );
});

self.addEventListener('fetch', e => {
    console.log('Service Worker: Fetch');
    e.respondWith(fetch(e.request).catch(() => caches.match(e.request)));
});

