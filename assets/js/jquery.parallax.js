/*
Plugin: jQuery Parallax
Version 1.1.3
Author: Ian Lunn
Twitter: @IanLunn
Author URL: http://www.ianlunn.co.uk/
Plugin URL: http://www.ianlunn.co.uk/plugins/jquery-parallax/

Dual licensed under the MIT and GPL licenses:
http://www.opensource.org/licenses/mit-license.php
http://www.gnu.org/licenses/gpl.html
*/

(function (e) {
	var t = e(window);
	var n = t.height();
	t.resize(function () {
		n = t.height()
	});
	e.fn.parallax = function (r, i, s) {
		function f() {
			var s = t.scrollTop();
			o.each(function () {
				var t = e(this);
				var o = t.offset().top;
				var a = u(t);
				var f = t.attr("data-parallax");
				var l;
				if (o + a < s || o > s + n) {
					return
				}
				if (f == "element") {
					l = t.offset().top;
					t.css("top", Math.round(-1 * (l - s) * i) + "px");
				} else {
					l = t.offset().top;
					t.css("backgroundPosition", r + " " + Math.round((l - s) * i) + "px")
				}
			})
		}
		var o = e(this);
		var u;
		var a = 0;
		if (s) {
			u = function (e) {
				return e.outerHeight(true)
			}
		} else {
			u = function (e) {
				return e.height()
			}
		} if (arguments.length < 1 || r === null) r = "50%";
		if (arguments.length < 2 || i === null) i = .1;
		if (arguments.length < 3 || s === null) s = true;
		t.bind("scroll", f).resize(f);
		f()
	}
})(jQuery)