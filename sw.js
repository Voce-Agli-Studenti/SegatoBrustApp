const staticCache = 'staticCache';
const dynamicCache = 'dynamicCache';

const assets = [
	'/assets/css/style.css',
	'/assets/css/style.min.css?v=1.2',
	'/assets/js/pwa.js',
	'/assets/js/app.js',
	'/assets/js/swup.js',
	'https://unpkg.com/swup@latest/dist/swup.min.js',
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

self.addEventListener('push', function (event) {
	if (!(self.Notification && self.Notification.permission === 'granted')) {
		return;
	}

	
	const sendNotification = data => {
		data = JSON.parse(data);
		console.log(data);
		return self.registration.showNotification(data.title, data.options);
	};

	if (event.data) {
		const message = event.data.text();
		event.waitUntil(sendNotification(message));
	}
});

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