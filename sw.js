importScripts('offline/service-worker-cache-polyfill.js');

self.addEventListener('install', function(e) {
 e.waitUntil(
   caches.open('webflix').then(function(cache) {
     return cache.addAll([
       '/',
          '/index.php',
          '/index.html?homescreen=1',
          '/?homescreen=1',
          '/main.min.js',
          '/rss.php',
          '/subscriptions.php',
          '/rss_listings.php',
          '/profile.php',
'/inc/header.php',
'/inc/nav.php',
'/inc/footer.php',
                '/css/webflix.css',
          '/css/romance.css',
          '/css/animate.css',
          '/css/boostrap-4.0.0.css',
          '/css/dc.css',
          '/css/gangsta.css',
          '/css/marvel.css',
         '/js/bootstrap-4.0.0.js',
          '/js/jquery-3.2.1.min.js',
          '/js/pouchdb-6.3.4.js',
          '/js/jquery.cookie.js',
          '/js/popper.min.js',
          '/js/sw.js',
          '/images/aven1.jpg',
'/images/batman.jpg',
'/images/cb1.jpg',
'/images/dc.jpg',
'/images/dc2.jpg',
'/images/dc3.jpg',
'/images/diary-of-a-wimpy-kid.jpg',
'/images/gdf1.jpg',
'/images/gf1.jpg',
'/images/gf2.jpg',
'/images/ghost1.jpg',
'/images/heroichollywood.jpeg',
'/images/jp1.jpg',
'/images/kiss.jpg',
'/images/LogoNic.png',
'/images/LoTR1.jpg',
'/images/LoTR2.jpg',
'/images/mainAvengers-4-Trailer-Description.jpg',
'/images/maincinema blend.jpg',
'/images/mainheroichollywood.png',
'/images/mainironman.jpg',
'/images/mainjaysilent_newline.jpg',
'/images/mainjosswhedon.jpg',
'/images/mainlego2.jpg',
'/images/mainmovieweb.jpg',
'/images/mainrdj.jpg',
'/images/mainreddit.png',
'/images/mainstarfox64.jpg',
'/images/mainstarlinkstarfox2.0.jpg',
'/images/marvelcomp.png',
'/images/mposter.jpg',
'/images/mvl1.png',
'/images/mvl4.jpg',
'/images/nh1.jpg',
'/images/ny1.jpg',
'/images/potter1.jpeg',
'/images/pulpf.jpg',
'/images/spider-man-2.jpg',
'/images/star-16.png',
'/images/The_Lego_Movie_2_The_Second_Part_theatrical_poster.jpg',
'/images/The-Jungle-Book.jpg',
'/images/thumbstarfox64.jpg',
'/images/thumbstarlinkstarfox2.0.jpg',
'/images/titanic1.jpg',
'/images/titanic1.jpg',
'/images/up.jpg',
'/images/zakpenn.jpg',
'/images/profile_pics/defaults/default_grey.png',
'/images/profile_pics/defaults/default-profile-picture.jpg',
'/images/profile_pics/5cb0adc3e07bddan.jpg',
'/images/main/rdj.jpg',
'/images/main/josswhedon.jpg',
          '/manifest.json',
        ])
        .then(() => self.skipWaiting());
  })
);
});

self.addEventListener('activate', event => {
event.waitUntil(self.clients.claim());
});

self.addEventListener('fetch', event => {
event.respondWith(
  caches.open(cacheName)
    .then(cache => cache.match(event.request, {ignoreSearch: true}))
    .then(response => {
    return response || fetch(event.request);
  })
);
});


self.addEventListener('message', (event) => {
  if (!event.data){
    return;
  }
  
  switch (event.data) {
    case 'force-activate':
      self.skipWaiting();
      self.clients.claim();
      self.clients.matchAll().then((clients) => {
        clients.forEach((client) => client.postMessage('reload-window'));
      });
      break;
    default:
      // NOOP
      break;
  }
});