const CACHE = "pwa0.0.1";

self.addEventListener('install', event => {
  const indexPage = new Request('/');
  event.waitUntil(
    fetch(indexPage).then(response => {
      const response2 = response.clone();
      return caches.open(CACHE).then(cache => cache.put(indexPage, response2));
    })
  );
});

self.addEventListener('activate', event => {
  event.waitUntil(
    self.clients.claim().then(() =>
      self.clients.matchAll().then(clients => {
        clients.forEach(client => client.postMessage({ type: 'blockScreenshots' }));
      })
    )
  );
});

self.addEventListener('fetch', event => {
  event.respondWith(
    fetch(event.request).then(networkResponse => networkResponse)
  );
});

self.addEventListener('push', event => {
  const data = event.data ? event.data.json() : {};
  const title = data.title || 'Notification';
  const options = {
    body: data.body || '',
    icon: data.icon || '/templates/icons_pwa/icon-192x192.png',
    data: data.url || '/'
  };
  event.waitUntil(self.registration.showNotification(title, options));
});

self.addEventListener('notificationclick', event => {
  event.notification.close();
  const url = event.notification.data;
  event.waitUntil(
    clients.openWindow(url)
  );
});
