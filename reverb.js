function _RRR() {
	var e = document.createElement("script");
	e.src = "https://d1g5417jjjo7sf.cloudfront.net/assets/embed/reverb.js", e.onload = function() {
		//We should really restore what was references to $ here, but because of loading remote content we can't currently do that
		//$ = reverb_old;
	}, document.body.appendChild(e);
}
var reverb_old = typeof $ !== 'undefined' ? $ : null;
$ = jQuery;
window.addEventListener ? window.addEventListener("load", _RRR, !1) : window.attachEvent ? window.attachEvent("onload", _RRR) : window.onload = _RRR;