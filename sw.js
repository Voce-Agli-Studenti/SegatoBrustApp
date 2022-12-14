const staticCache = 'staticCache';
const dynamicCache = 'dynamicCache';

const assets = [
	'/assets/css/style.css?v=1.0',
	'/assets/css/style.min.css?v=1.54',
	'/assets/js/pwa.js?v=2',
	'/assets/js/app.js?v=1.2',
	'/assets/js/swup.js?v=1',
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
		return self.registration.showNotification(data.title, data.options);
	};

	if (event.data) {
		const message = event.data.text();
		event.waitUntil(sendNotification(message));
	}
});

self.addEventListener('notificationclick', (event) => {
	event.notification.close();

	if (event.notification.data.action == "open_news") {
		let news_id = event.notification.data.news_id;
		const promiseChain = clients.openWindow("https://data.iacca.ml/articleextractor/?disable_proxy&id=" + news_id);
		event.waitUntil(promiseChain);
	} else {
		const promiseChain = clients.openWindow("/news/");
		event.waitUntil(promiseChain);
		clients.openWindow("/news/");
	}
}, false);

self.addEventListener('fetch', (event) => {
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