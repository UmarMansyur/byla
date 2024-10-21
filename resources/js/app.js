import './bootstrap';
if ('serviceWorker' in navigator) {
  navigator.serviceWorker.register('/service-worker.js')
  .then(function(registration) {
      console.log('ServiceWorker registration successful with scope: ', registration.scope);
  }).catch(function(error) {
      console.log('ServiceWorker registration failed: ', error);
  });
}

const beamsClient = new PusherPushNotifications.Client({
  instanceId: 'fd24bee3-d6eb-46ef-b8c4-6b7fa04d0454',
});

beamsClient.start()
  .then(() => beamsClient.addDeviceInterest('transaksi-update'))
  .then(() => console.log('Successfully registered and subscribed!'))
  .catch(console.error);
