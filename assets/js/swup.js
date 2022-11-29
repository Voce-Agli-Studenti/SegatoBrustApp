var isPushEnabled = false;

const options = {
  cache: false,
  animateHistoryBrowsing: true,
};

const swup = new Swup(options);

swup.on('animationOutStart', function () {
  $(".btn-quick-action").addClass("hidden").removeClass("flex");
});

swup.on('animationInStart', function () {
  $(".btn-quick-action").addClass("hidden").removeClass("flex");
});

swup.on('contentReplaced', function () {
  // PUSH NOTIFICATIONS //

  push_updateSubscription();

  if (!('serviceWorker' in navigator)) {
    console.warn('Service workers are not supported by this browser');
    changePushButtonState('incompatible');
    return;
  }

  if (!('PushManager' in window)) {
    console.warn('Push notifications are not supported by this browser');
    changePushButtonState('incompatible');
    return;
  }

  if (!('showNotification' in ServiceWorkerRegistration.prototype)) {
    console.warn('Notifications are not supported by this browser');
    changePushButtonState('incompatible');
    return;
  }

  // Check the current Notification permission.
  // If its denied, the button should appears as such, until the user changes the permission manually
  if (Notification.permission === 'denied') {
    console.warn('Notifications are denied by the user');
    changePushButtonState('incompatible');
    return;
  }

  navigator.serviceWorker.register('/sw.js').then(
    () => {
      console.log('[SW] Service worker has been registered');
      push_updateSubscription();
    },
    e => {
      console.error('[SW] Service worker registration failed', e);
      changePushButtonState('incompatible');
    }
  );

  // END PUSH NOTIFICATIONS //
})

swup.on('animationInDone', function () {
  $('input[autofocus]').trigger('focus');

  // Show quick action buttons
  $(".btn-quick-action").addClass("flex").removeClass("hidden");
});


