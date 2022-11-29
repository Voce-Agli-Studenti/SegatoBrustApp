$("#push-subscription-button").click(function() {
  if (isPushEnabled) {
		push_unsubscribe();
	} else {
		push_subscribe();
	}
});