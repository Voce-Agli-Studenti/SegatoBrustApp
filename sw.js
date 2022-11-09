const staticCache = 'staticCache';
const dynamicCache = 'dynamicCache';

const assets = [
	'/assets/css/style.css',
	'/assets/js/pwa.js',
	'https://unpkg.com/swup@latest/dist/swup.min.js',
	'/assets/js/swup.js',
	'/assets/js/tailwindcss.js',
	'https://cdn.jsdelivr.net/npm/daisyui@2.33.0/dist/full.css',
];

const destinationsToCache = [
	'script',
	'style',
	'image'
];

self.addEventListener('install', event => {
	// SW installed
	event.waitUntil(
		caches.open(staticCache).then(cache => {
			cache.addAll(assets)
		}).then(caches.open(dynamicCache).then(cache => {
			cache.add("/offline/")
		}))
	);
});

self.addEventListener('activate', event => {
	// SW activated
});

/* self.addEventListener('fetch', event => {


	event.respondWith(
		fetch(event.request).catch(function () {
			return caches.match(event.request);
		}),
	);



	event.respondWith(
		caches.match(event.request).then(cacheRes => {
			return cacheRes || fetch(event.request).then(fetchRes => {
				return caches.open(dynamicCache).then(cache => {
					cache.put(event.request.url, fetchRes.clone())
					return fetchRes;
				});
			});
		}).catch(() => {
			return caches.match("/offline/")
		})
	);
}); */


self.addEventListener('fetch', (event) => {
	console.log(event.request);

	if (event.request.method != "GET") {
		return;
	}

	if (destinationsToCache.includes(event.request.destination)) {
		event.respondWith(caches.open(staticCache).then((cache) => {
			// Go to the cache first
			return cache.match(event.request.url).then((cachedResponse) => {
				// Return a cached response if we have one
				if (cachedResponse) {
					return cachedResponse;
				}

				// Otherwise, hit the network
				return fetch(event.request).then((fetchedResponse) => {
					// Add the network response to the cache for later visits
					cache.put(event.request, fetchedResponse.clone());

					// Return the network response
					return fetchedResponse;
				});
			});
		}));
	} else {
		console.log("caching dynamic content");
		// Open the cache
		event.respondWith(caches.open(dynamicCache).then((cache) => {
			// Go to the network first
			return fetch(event.request.url).then((fetchedResponse) => {
				cache.put(event.request, fetchedResponse.clone());

				return fetchedResponse;
			}).catch(() => {


				return cache.match(event.request.url).then((cachedResponse) => {
					// Return a cached response if we have one
					if (cachedResponse) {
						return cachedResponse;
					}
					// If the network is unavailable, get
					return cache.match("/offline/");					
				});
			});
		}));

	}
});