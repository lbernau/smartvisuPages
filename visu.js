/**
 * refresh view on cache update.
 */
function updateSite(event) {
	window.applicationCache.swapCache();
	window.location.reload();
}
window.applicationCache.addEventListener('updateready',	updateSite, false);

/**
 * enable screensaver "qlock"
 * 
 * idleTimer() takes an optional argument that defines the idle timeout
 * timeout is in milliseconds; defaults to 30000
 */
$(document).on('pageinit', function(event) {
	if (
		jQuery().idleTimer && event.target.id !== 'qlock' 
		&& navigator.userAgent.match(/(iPad)|(iPhone)|(iPod)|(android)|(webOS)/i) != null
		&& (Modernizr && Modernizr.mq('(min-width: 768px)'))
	) {
		$.idleTimer(120000, document); //2 minutes
	}
});

$(document).bind('idle.idleTimer', function() {
	$.mobile.changePage("index.php?page=qlock/qlock");
});

$(document).bind('active.idleTimer', function(event) {
	parent.history.back();
});