"object" == typeof navigator &&
	(function (e, t) {
		"object" == typeof exports && "undefined" != typeof module
			? (module.exports = t())
			: "function" == typeof define && define.amd
			? define("Plyr", t)
			: ((e = "undefined" != typeof globalThis ? globalThis : e || self).Plyr =
					t());
	})(this, function () {
		"use strict";
		!(function () {
			if ("undefined" != typeof window)
				try {
					var e = new window.CustomEvent("test", { cancelable: !0 });
					if ((e.preventDefault(), !0 !== e.defaultPrevented))
						throw new Error("Could not prevent default");
				} catch (e) {
					var t = function (e, t) {
						var i, n;
						return (
							((t = t || {}).bubbles = !!t.bubbles),
							(t.cancelable = !!t.cancelable),
							(i = document.createEvent("CustomEvent")).initCustomEvent(
								e,
								t.bubbles,
								t.cancelable,
								t.detail
							),
							(n = i.preventDefault),
							(i.preventDefault = function () {
								n.call(this);
								try {
									Object.defineProperty(this, "defaultPrevented", {
										get: function () {
											return !0;
										},
									});
								} catch (e) {
									this.defaultPrevented = !0;
								}
							}),
							i
						);
					};
					(t.prototype = window.Event.prototype), (window.CustomEvent = t);
				}
		})();
		var e =
			"undefined" != typeof globalThis
				? globalThis
				: "undefined" != typeof window
				? window
				: "undefined" != typeof global
				? global
				: "undefined" != typeof self
				? self
				: {};
		function t(e, t) {
			return e((t = { exports: {} }), t.exports), t.exports;
		}
		var i = function (e) {
				return e && e.Math == Math && e;
			},
			n =
				i("object" == typeof globalThis && globalThis) ||
				i("object" == typeof window && window) ||
				i("object" == typeof self && self) ||
				i("object" == typeof e && e) ||
				(function () {
					return this;
				})() ||
				Function("return this")(),
			s = function (e) {
				try {
					return !!e();
				} catch (e) {
					return !0;
				}
			},
			r = !s(function () {
				return (
					7 !=
					Object.defineProperty({}, 1, {
						get: function () {
							return 7;
						},
					})[1]
				);
			}),
			a = {}.propertyIsEnumerable,
			o = Object.getOwnPropertyDescriptor,
			l = {
				f:
					o && !a.call({ 1: 2 }, 1)
						? function (e) {
								var t = o(this, e);
								return !!t && t.enumerable;
						  }
						: a,
			},
			c = function (e, t) {
				return {
					enumerable: !(1 & e),
					configurable: !(2 & e),
					writable: !(4 & e),
					value: t,
				};
			},
			u = {}.toString,
			h = function (e) {
				return u.call(e).slice(8, -1);
			},
			d = "".split,
			p = s(function () {
				return !Object("z").propertyIsEnumerable(0);
			})
				? function (e) {
						return "String" == h(e) ? d.call(e, "") : Object(e);
				  }
				: Object,
			m = function (e) {
				if (null == e) throw TypeError("Can't call method on " + e);
				return e;
			},
			f = function (e) {
				return p(m(e));
			},
			g = function (e) {
				return "object" == typeof e ? null !== e : "function" == typeof e;
			},
			y = function (e, t) {
				if (!g(e)) return e;
				var i, n;
				if (t && "function" == typeof (i = e.toString) && !g((n = i.call(e))))
					return n;
				if ("function" == typeof (i = e.valueOf) && !g((n = i.call(e))))
					return n;
				if (!t && "function" == typeof (i = e.toString) && !g((n = i.call(e))))
					return n;
				throw TypeError("Can't convert object to primitive value");
			},
			b = {}.hasOwnProperty,
			v = function (e, t) {
				return b.call(e, t);
			},
			w = n.document,
			k = g(w) && g(w.createElement),
			T = function (e) {
				return k ? w.createElement(e) : {};
			},
			S =
				!r &&
				!s(function () {
					return (
						7 !=
						Object.defineProperty(T("div"), "a", {
							get: function () {
								return 7;
							},
						}).a
					);
				}),
			E = Object.getOwnPropertyDescriptor,
			A = {
				f: r
					? E
					: function (e, t) {
							if (((e = f(e)), (t = y(t, !0)), S))
								try {
									return E(e, t);
								} catch (e) {}
							if (v(e, t)) return c(!l.f.call(e, t), e[t]);
					  },
			},
			C = function (e) {
				if (!g(e)) throw TypeError(String(e) + " is not an object");
				return e;
			},
			P = Object.defineProperty,
			x = {
				f: r
					? P
					: function (e, t, i) {
							if ((C(e), (t = y(t, !0)), C(i), S))
								try {
									return P(e, t, i);
								} catch (e) {}
							if ("get" in i || "set" in i)
								throw TypeError("Accessors not supported");
							return "value" in i && (e[t] = i.value), e;
					  },
			},
			L = r
				? function (e, t, i) {
						return x.f(e, t, c(1, i));
				  }
				: function (e, t, i) {
						return (e[t] = i), e;
				  },
			I = function (e, t) {
				try {
					L(n, e, t);
				} catch (i) {
					n[e] = t;
				}
				return t;
			},
			_ = "__core-js_shared__",
			O = n[_] || I(_, {}),
			M = Function.toString;
		"function" != typeof O.inspectSource &&
			(O.inspectSource = function (e) {
				return M.call(e);
			});
		var N,
			R,
			j,
			$ = O.inspectSource,
			U = n.WeakMap,
			q = "function" == typeof U && /native code/.test($(U)),
			F = t(function (e) {
				(e.exports = function (e, t) {
					return O[e] || (O[e] = void 0 !== t ? t : {});
				})("versions", []).push({
					version: "3.10.1",
					mode: "global",
					copyright: "© 2021 Denis Pushkarev (zloirock.ru)",
				});
			}),
			D = 0,
			H = Math.random(),
			B = function (e) {
				return (
					"Symbol(" +
					String(void 0 === e ? "" : e) +
					")_" +
					(++D + H).toString(36)
				);
			},
			V = F("keys"),
			W = function (e) {
				return V[e] || (V[e] = B(e));
			},
			z = {},
			K = n.WeakMap;
		if (q) {
			var Y = O.state || (O.state = new K()),
				G = Y.get,
				X = Y.has,
				Q = Y.set;
			(N = function (e, t) {
				return (t.facade = e), Q.call(Y, e, t), t;
			}),
				(R = function (e) {
					return G.call(Y, e) || {};
				}),
				(j = function (e) {
					return X.call(Y, e);
				});
		} else {
			var J = W("state");
			(z[J] = !0),
				(N = function (e, t) {
					return (t.facade = e), L(e, J, t), t;
				}),
				(R = function (e) {
					return v(e, J) ? e[J] : {};
				}),
				(j = function (e) {
					return v(e, J);
				});
		}
		var Z = {
				set: N,
				get: R,
				has: j,
				enforce: function (e) {
					return j(e) ? R(e) : N(e, {});
				},
				getterFor: function (e) {
					return function (t) {
						var i;
						if (!g(t) || (i = R(t)).type !== e)
							throw TypeError("Incompatible receiver, " + e + " required");
						return i;
					};
				},
			},
			ee = t(function (e) {
				var t = Z.get,
					i = Z.enforce,
					s = String(String).split("String");
				(e.exports = function (e, t, r, a) {
					var o,
						l = !!a && !!a.unsafe,
						c = !!a && !!a.enumerable,
						u = !!a && !!a.noTargetGet;
					"function" == typeof r &&
						("string" != typeof t || v(r, "name") || L(r, "name", t),
						(o = i(r)).source ||
							(o.source = s.join("string" == typeof t ? t : ""))),
						e !== n
							? (l ? !u && e[t] && (c = !0) : delete e[t],
							  c ? (e[t] = r) : L(e, t, r))
							: c
							? (e[t] = r)
							: I(t, r);
				})(Function.prototype, "toString", function () {
					return ("function" == typeof this && t(this).source) || $(this);
				});
			}),
			te = n,
			ie = function (e) {
				return "function" == typeof e ? e : void 0;
			},
			ne = function (e, t) {
				return arguments.length < 2
					? ie(te[e]) || ie(n[e])
					: (te[e] && te[e][t]) || (n[e] && n[e][t]);
			},
			se = Math.ceil,
			re = Math.floor,
			ae = function (e) {
				return isNaN((e = +e)) ? 0 : (e > 0 ? re : se)(e);
			},
			oe = Math.min,
			le = function (e) {
				return e > 0 ? oe(ae(e), 9007199254740991) : 0;
			},
			ce = Math.max,
			ue = Math.min,
			he = function (e) {
				return function (t, i, n) {
					var s,
						r = f(t),
						a = le(r.length),
						o = (function (e, t) {
							var i = ae(e);
							return i < 0 ? ce(i + t, 0) : ue(i, t);
						})(n, a);
					if (e && i != i) {
						for (; a > o; ) if ((s = r[o++]) != s) return !0;
					} else
						for (; a > o; o++)
							if ((e || o in r) && r[o] === i) return e || o || 0;
					return !e && -1;
				};
			},
			de = { includes: he(!0), indexOf: he(!1) }.indexOf,
			pe = function (e, t) {
				var i,
					n = f(e),
					s = 0,
					r = [];
				for (i in n) !v(z, i) && v(n, i) && r.push(i);
				for (; t.length > s; ) v(n, (i = t[s++])) && (~de(r, i) || r.push(i));
				return r;
			},
			me = [
				"constructor",
				"hasOwnProperty",
				"isPrototypeOf",
				"propertyIsEnumerable",
				"toLocaleString",
				"toString",
				"valueOf",
			],
			fe = me.concat("length", "prototype"),
			ge = {
				f:
					Object.getOwnPropertyNames ||
					function (e) {
						return pe(e, fe);
					},
			},
			ye = { f: Object.getOwnPropertySymbols },
			be =
				ne("Reflect", "ownKeys") ||
				function (e) {
					var t = ge.f(C(e)),
						i = ye.f;
					return i ? t.concat(i(e)) : t;
				},
			ve = function (e, t) {
				for (var i = be(t), n = x.f, s = A.f, r = 0; r < i.length; r++) {
					var a = i[r];
					v(e, a) || n(e, a, s(t, a));
				}
			},
			we = /#|\.prototype\./,
			ke = function (e, t) {
				var i = Se[Te(e)];
				return i == Ae || (i != Ee && ("function" == typeof t ? s(t) : !!t));
			},
			Te = (ke.normalize = function (e) {
				return String(e).replace(we, ".").toLowerCase();
			}),
			Se = (ke.data = {}),
			Ee = (ke.NATIVE = "N"),
			Ae = (ke.POLYFILL = "P"),
			Ce = ke,
			Pe = A.f,
			xe = function (e, t) {
				var i,
					s,
					r,
					a,
					o,
					l = e.target,
					c = e.global,
					u = e.stat;
				if ((i = c ? n : u ? n[l] || I(l, {}) : (n[l] || {}).prototype))
					for (s in t) {
						if (
							((a = t[s]),
							(r = e.noTargetGet ? (o = Pe(i, s)) && o.value : i[s]),
							!Ce(c ? s : l + (u ? "." : "#") + s, e.forced) && void 0 !== r)
						) {
							if (typeof a == typeof r) continue;
							ve(a, r);
						}
						(e.sham || (r && r.sham)) && L(a, "sham", !0), ee(i, s, a, e);
					}
			},
			Le = function () {
				var e = C(this),
					t = "";
				return (
					e.global && (t += "g"),
					e.ignoreCase && (t += "i"),
					e.multiline && (t += "m"),
					e.dotAll && (t += "s"),
					e.unicode && (t += "u"),
					e.sticky && (t += "y"),
					t
				);
			};
		function Ie(e, t) {
			return RegExp(e, t);
		}
		var _e,
			Oe,
			Me = {
				UNSUPPORTED_Y: s(function () {
					var e = Ie("a", "y");
					return (e.lastIndex = 2), null != e.exec("abcd");
				}),
				BROKEN_CARET: s(function () {
					var e = Ie("^r", "gy");
					return (e.lastIndex = 2), null != e.exec("str");
				}),
			},
			Ne = RegExp.prototype.exec,
			Re = F("native-string-replace", String.prototype.replace),
			je = Ne,
			$e =
				((_e = /a/),
				(Oe = /b*/g),
				Ne.call(_e, "a"),
				Ne.call(Oe, "a"),
				0 !== _e.lastIndex || 0 !== Oe.lastIndex),
			Ue = Me.UNSUPPORTED_Y || Me.BROKEN_CARET,
			qe = void 0 !== /()??/.exec("")[1];
		($e || qe || Ue) &&
			(je = function (e) {
				var t,
					i,
					n,
					s,
					r = this,
					a = Ue && r.sticky,
					o = Le.call(r),
					l = r.source,
					c = 0,
					u = e;
				return (
					a &&
						(-1 === (o = o.replace("y", "")).indexOf("g") && (o += "g"),
						(u = String(e).slice(r.lastIndex)),
						r.lastIndex > 0 &&
							(!r.multiline || (r.multiline && "\n" !== e[r.lastIndex - 1])) &&
							((l = "(?: " + l + ")"), (u = " " + u), c++),
						(i = new RegExp("^(?:" + l + ")", o))),
					qe && (i = new RegExp("^" + l + "$(?!\\s)", o)),
					$e && (t = r.lastIndex),
					(n = Ne.call(a ? i : r, u)),
					a
						? n
							? ((n.input = n.input.slice(c)),
							  (n[0] = n[0].slice(c)),
							  (n.index = r.lastIndex),
							  (r.lastIndex += n[0].length))
							: (r.lastIndex = 0)
						: $e && n && (r.lastIndex = r.global ? n.index + n[0].length : t),
					qe &&
						n &&
						n.length > 1 &&
						Re.call(n[0], i, function () {
							for (s = 1; s < arguments.length - 2; s++)
								void 0 === arguments[s] && (n[s] = void 0);
						}),
					n
				);
			});
		var Fe = je;
		xe({ target: "RegExp", proto: !0, forced: /./.exec !== Fe }, { exec: Fe });
		var De,
			He,
			Be = "process" == h(n.process),
			Ve = ne("navigator", "userAgent") || "",
			We = n.process,
			ze = We && We.versions,
			Ke = ze && ze.v8;
		Ke
			? (He = (De = Ke.split("."))[0] + De[1])
			: Ve &&
			  (!(De = Ve.match(/Edge\/(\d+)/)) || De[1] >= 74) &&
			  (De = Ve.match(/Chrome\/(\d+)/)) &&
			  (He = De[1]);
		var Ye = He && +He,
			Ge =
				!!Object.getOwnPropertySymbols &&
				!s(function () {
					return !Symbol.sham && (Be ? 38 === Ye : Ye > 37 && Ye < 41);
				}),
			Xe = Ge && !Symbol.sham && "symbol" == typeof Symbol.iterator,
			Qe = F("wks"),
			Je = n.Symbol,
			Ze = Xe ? Je : (Je && Je.withoutSetter) || B,
			et = function (e) {
				return (
					(v(Qe, e) && (Ge || "string" == typeof Qe[e])) ||
						(Ge && v(Je, e) ? (Qe[e] = Je[e]) : (Qe[e] = Ze("Symbol." + e))),
					Qe[e]
				);
			},
			tt = et("species"),
			it = !s(function () {
				var e = /./;
				return (
					(e.exec = function () {
						var e = [];
						return (e.groups = { a: "7" }), e;
					}),
					"7" !== "".replace(e, "$<a>")
				);
			}),
			nt = "$0" === "a".replace(/./, "$0"),
			st = et("replace"),
			rt = !!/./[st] && "" === /./[st]("a", "$0"),
			at = !s(function () {
				var e = /(?:)/,
					t = e.exec;
				e.exec = function () {
					return t.apply(this, arguments);
				};
				var i = "ab".split(e);
				return 2 !== i.length || "a" !== i[0] || "b" !== i[1];
			}),
			ot = function (e) {
				return function (t, i) {
					var n,
						s,
						r = String(m(t)),
						a = ae(i),
						o = r.length;
					return a < 0 || a >= o
						? e
							? ""
							: void 0
						: (n = r.charCodeAt(a)) < 55296 ||
						  n > 56319 ||
						  a + 1 === o ||
						  (s = r.charCodeAt(a + 1)) < 56320 ||
						  s > 57343
						? e
							? r.charAt(a)
							: n
						: e
						? r.slice(a, a + 2)
						: s - 56320 + ((n - 55296) << 10) + 65536;
				};
			},
			lt = { codeAt: ot(!1), charAt: ot(!0) },
			ct = lt.charAt,
			ut = function (e, t, i) {
				return t + (i ? ct(e, t).length : 1);
			},
			ht = function (e) {
				return Object(m(e));
			},
			dt = Math.floor,
			pt = "".replace,
			mt = /\$([$&'`]|\d{1,2}|<[^>]*>)/g,
			ft = /\$([$&'`]|\d{1,2})/g,
			gt = function (e, t, i, n, s, r) {
				var a = i + e.length,
					o = n.length,
					l = ft;
				return (
					void 0 !== s && ((s = ht(s)), (l = mt)),
					pt.call(r, l, function (r, l) {
						var c;
						switch (l.charAt(0)) {
							case "$":
								return "$";
							case "&":
								return e;
							case "`":
								return t.slice(0, i);
							case "'":
								return t.slice(a);
							case "<":
								c = s[l.slice(1, -1)];
								break;
							default:
								var u = +l;
								if (0 === u) return r;
								if (u > o) {
									var h = dt(u / 10);
									return 0 === h
										? r
										: h <= o
										? void 0 === n[h - 1]
											? l.charAt(1)
											: n[h - 1] + l.charAt(1)
										: r;
								}
								c = n[u - 1];
						}
						return void 0 === c ? "" : c;
					})
				);
			},
			yt = function (e, t) {
				var i = e.exec;
				if ("function" == typeof i) {
					var n = i.call(e, t);
					if ("object" != typeof n)
						throw TypeError(
							"RegExp exec method returned something other than an Object or null"
						);
					return n;
				}
				if ("RegExp" !== h(e))
					throw TypeError("RegExp#exec called on incompatible receiver");
				return Fe.call(e, t);
			},
			bt = Math.max,
			vt = Math.min;
		!(function (e, t, i, n) {
			var r = et(e),
				a = !s(function () {
					var t = {};
					return (
						(t[r] = function () {
							return 7;
						}),
						7 != ""[e](t)
					);
				}),
				o =
					a &&
					!s(function () {
						var t = !1,
							i = /a/;
						return (
							"split" === e &&
								(((i = {}).constructor = {}),
								(i.constructor[tt] = function () {
									return i;
								}),
								(i.flags = ""),
								(i[r] = /./[r])),
							(i.exec = function () {
								return (t = !0), null;
							}),
							i[r](""),
							!t
						);
					});
			if (
				!a ||
				!o ||
				("replace" === e && (!it || !nt || rt)) ||
				("split" === e && !at)
			) {
				var l = /./[r],
					c = i(
						r,
						""[e],
						function (e, t, i, n, s) {
							return t.exec === RegExp.prototype.exec
								? a && !s
									? { done: !0, value: l.call(t, i, n) }
									: { done: !0, value: e.call(i, t, n) }
								: { done: !1 };
						},
						{
							REPLACE_KEEPS_$0: nt,
							REGEXP_REPLACE_SUBSTITUTES_UNDEFINED_CAPTURE: rt,
						}
					),
					u = c[0],
					h = c[1];
				ee(String.prototype, e, u),
					ee(
						RegExp.prototype,
						r,
						2 == t
							? function (e, t) {
									return h.call(e, this, t);
							  }
							: function (e) {
									return h.call(e, this);
							  }
					);
			}
			n && L(RegExp.prototype[r], "sham", !0);
		})("replace", 2, function (e, t, i, n) {
			var s = n.REGEXP_REPLACE_SUBSTITUTES_UNDEFINED_CAPTURE,
				r = n.REPLACE_KEEPS_$0,
				a = s ? "$" : "$0";
			return [
				function (i, n) {
					var s = m(this),
						r = null == i ? void 0 : i[e];
					return void 0 !== r ? r.call(i, s, n) : t.call(String(s), i, n);
				},
				function (e, n) {
					if ((!s && r) || ("string" == typeof n && -1 === n.indexOf(a))) {
						var o = i(t, e, this, n);
						if (o.done) return o.value;
					}
					var l = C(e),
						c = String(this),
						u = "function" == typeof n;
					u || (n = String(n));
					var h = l.global;
					if (h) {
						var d = l.unicode;
						l.lastIndex = 0;
					}
					for (var p = []; ; ) {
						var m = yt(l, c);
						if (null === m) break;
						if ((p.push(m), !h)) break;
						"" === String(m[0]) && (l.lastIndex = ut(c, le(l.lastIndex), d));
					}
					for (var f, g = "", y = 0, b = 0; b < p.length; b++) {
						m = p[b];
						for (
							var v = String(m[0]),
								w = bt(vt(ae(m.index), c.length), 0),
								k = [],
								T = 1;
							T < m.length;
							T++
						)
							k.push(void 0 === (f = m[T]) ? f : String(f));
						var S = m.groups;
						if (u) {
							var E = [v].concat(k, w, c);
							void 0 !== S && E.push(S);
							var A = String(n.apply(void 0, E));
						} else A = gt(v, c, w, k, S, n);
						w >= y && ((g += c.slice(y, w) + A), (y = w + v.length));
					}
					return g + c.slice(y);
				},
			];
		});
		var wt,
			kt,
			Tt,
			St = !s(function () {
				function e() {}
				return (
					(e.prototype.constructor = null),
					Object.getPrototypeOf(new e()) !== e.prototype
				);
			}),
			Et = W("IE_PROTO"),
			At = Object.prototype,
			Ct = St
				? Object.getPrototypeOf
				: function (e) {
						return (
							(e = ht(e)),
							v(e, Et)
								? e[Et]
								: "function" == typeof e.constructor &&
								  e instanceof e.constructor
								? e.constructor.prototype
								: e instanceof Object
								? At
								: null
						);
				  },
			Pt = et("iterator"),
			xt = !1;
		[].keys &&
			("next" in (Tt = [].keys())
				? (kt = Ct(Ct(Tt))) !== Object.prototype && (wt = kt)
				: (xt = !0)),
			(null == wt ||
				s(function () {
					var e = {};
					return wt[Pt].call(e) !== e;
				})) &&
				(wt = {}),
			v(wt, Pt) ||
				L(wt, Pt, function () {
					return this;
				});
		var Lt,
			It = { IteratorPrototype: wt, BUGGY_SAFARI_ITERATORS: xt },
			_t =
				Object.keys ||
				function (e) {
					return pe(e, me);
				},
			Ot = r
				? Object.defineProperties
				: function (e, t) {
						C(e);
						for (var i, n = _t(t), s = n.length, r = 0; s > r; )
							x.f(e, (i = n[r++]), t[i]);
						return e;
				  },
			Mt = ne("document", "documentElement"),
			Nt = W("IE_PROTO"),
			Rt = function () {},
			jt = function (e) {
				return "<script>" + e + "</" + "script>";
			},
			$t = function () {
				try {
					Lt = document.domain && new ActiveXObject("htmlfile");
				} catch (e) {}
				var e, t;
				$t = Lt
					? (function (e) {
							e.write(jt("")), e.close();
							var t = e.parentWindow.Object;
							return (e = null), t;
					  })(Lt)
					: (((t = T("iframe")).style.display = "none"),
					  Mt.appendChild(t),
					  (t.src = String("javascript:")),
					  (e = t.contentWindow.document).open(),
					  e.write(jt("document.F=Object")),
					  e.close(),
					  e.F);
				for (var i = me.length; i--; ) delete $t.prototype[me[i]];
				return $t();
			};
		z[Nt] = !0;
		var Ut =
				Object.create ||
				function (e, t) {
					var i;
					return (
						null !== e
							? ((Rt.prototype = C(e)),
							  (i = new Rt()),
							  (Rt.prototype = null),
							  (i[Nt] = e))
							: (i = $t()),
						void 0 === t ? i : Ot(i, t)
					);
				},
			qt = x.f,
			Ft = et("toStringTag"),
			Dt = function (e, t, i) {
				e &&
					!v((e = i ? e : e.prototype), Ft) &&
					qt(e, Ft, { configurable: !0, value: t });
			},
			Ht = {},
			Bt = It.IteratorPrototype,
			Vt = function () {
				return this;
			},
			Wt = function (e, t, i) {
				var n = t + " Iterator";
				return (
					(e.prototype = Ut(Bt, { next: c(1, i) })),
					Dt(e, n, !1),
					(Ht[n] = Vt),
					e
				);
			},
			zt =
				Object.setPrototypeOf ||
				("__proto__" in {}
					? (function () {
							var e,
								t = !1,
								i = {};
							try {
								(e = Object.getOwnPropertyDescriptor(
									Object.prototype,
									"__proto__"
								).set).call(i, []),
									(t = i instanceof Array);
							} catch (e) {}
							return function (i, n) {
								return (
									C(i),
									(function (e) {
										if (!g(e) && null !== e)
											throw TypeError(
												"Can't set " + String(e) + " as a prototype"
											);
									})(n),
									t ? e.call(i, n) : (i.__proto__ = n),
									i
								);
							};
					  })()
					: void 0),
			Kt = It.IteratorPrototype,
			Yt = It.BUGGY_SAFARI_ITERATORS,
			Gt = et("iterator"),
			Xt = "keys",
			Qt = "values",
			Jt = "entries",
			Zt = function () {
				return this;
			},
			ei = function (e, t, i, n, s, r, a) {
				Wt(i, t, n);
				var o,
					l,
					c,
					u = function (e) {
						if (e === s && f) return f;
						if (!Yt && e in p) return p[e];
						switch (e) {
							case Xt:
							case Qt:
							case Jt:
								return function () {
									return new i(this, e);
								};
						}
						return function () {
							return new i(this);
						};
					},
					h = t + " Iterator",
					d = !1,
					p = e.prototype,
					m = p[Gt] || p["@@iterator"] || (s && p[s]),
					f = (!Yt && m) || u(s),
					g = ("Array" == t && p.entries) || m;
				if (
					(g &&
						((o = Ct(g.call(new e()))),
						Kt !== Object.prototype &&
							o.next &&
							(Ct(o) !== Kt &&
								(zt ? zt(o, Kt) : "function" != typeof o[Gt] && L(o, Gt, Zt)),
							Dt(o, h, !0))),
					s == Qt &&
						m &&
						m.name !== Qt &&
						((d = !0),
						(f = function () {
							return m.call(this);
						})),
					p[Gt] !== f && L(p, Gt, f),
					(Ht[t] = f),
					s)
				)
					if (((l = { values: u(Qt), keys: r ? f : u(Xt), entries: u(Jt) }), a))
						for (c in l) (Yt || d || !(c in p)) && ee(p, c, l[c]);
					else xe({ target: t, proto: !0, forced: Yt || d }, l);
				return l;
			},
			ti = lt.charAt,
			ii = "String Iterator",
			ni = Z.set,
			si = Z.getterFor(ii);
		ei(
			String,
			"String",
			function (e) {
				ni(this, { type: ii, string: String(e), index: 0 });
			},
			function () {
				var e,
					t = si(this),
					i = t.string,
					n = t.index;
				return n >= i.length
					? { value: void 0, done: !0 }
					: ((e = ti(i, n)), (t.index += e.length), { value: e, done: !1 });
			}
		);
		var ri = et("iterator"),
			ai = !s(function () {
				var e = new URL("b?a=1&b=2&c=3", "http://a"),
					t = e.searchParams,
					i = "";
				return (
					(e.pathname = "c%20d"),
					t.forEach(function (e, n) {
						t.delete("b"), (i += n + e);
					}),
					!t.sort ||
						"http://a/c%20d?a=1&c=3" !== e.href ||
						"3" !== t.get("c") ||
						"a=1" !== String(new URLSearchParams("?a=1")) ||
						!t[ri] ||
						"a" !== new URL("https://a@b").username ||
						"b" !== new URLSearchParams(new URLSearchParams("a=b")).get("a") ||
						"xn--e1aybc" !== new URL("http://тест").host ||
						"#%D0%B1" !== new URL("http://a#б").hash ||
						"a1c3" !== i ||
						"x" !== new URL("http://x", void 0).host
				);
			}),
			oi = function (e, t, i) {
				if (!(e instanceof t))
					throw TypeError("Incorrect " + (i ? i + " " : "") + "invocation");
				return e;
			},
			li = Object.assign,
			ci = Object.defineProperty,
			ui =
				!li ||
				s(function () {
					if (
						r &&
						1 !==
							li(
								{ b: 1 },
								li(
									ci({}, "a", {
										enumerable: !0,
										get: function () {
											ci(this, "b", { value: 3, enumerable: !1 });
										},
									}),
									{ b: 2 }
								)
							).b
					)
						return !0;
					var e = {},
						t = {},
						i = Symbol(),
						n = "abcdefghijklmnopqrst";
					return (
						(e[i] = 7),
						n.split("").forEach(function (e) {
							t[e] = e;
						}),
						7 != li({}, e)[i] || _t(li({}, t)).join("") != n
					);
				})
					? function (e, t) {
							for (
								var i = ht(e), n = arguments.length, s = 1, a = ye.f, o = l.f;
								n > s;

							)
								for (
									var c,
										u = p(arguments[s++]),
										h = a ? _t(u).concat(a(u)) : _t(u),
										d = h.length,
										m = 0;
									d > m;

								)
									(c = h[m++]), (r && !o.call(u, c)) || (i[c] = u[c]);
							return i;
					  }
					: li,
			hi = function (e, t, i) {
				if (
					((function (e) {
						if ("function" != typeof e)
							throw TypeError(String(e) + " is not a function");
					})(e),
					void 0 === t)
				)
					return e;
				switch (i) {
					case 0:
						return function () {
							return e.call(t);
						};
					case 1:
						return function (i) {
							return e.call(t, i);
						};
					case 2:
						return function (i, n) {
							return e.call(t, i, n);
						};
					case 3:
						return function (i, n, s) {
							return e.call(t, i, n, s);
						};
				}
				return function () {
					return e.apply(t, arguments);
				};
			},
			di = function (e, t, i, n) {
				try {
					return n ? t(C(i)[0], i[1]) : t(i);
				} catch (t) {
					throw (
						((function (e) {
							var t = e.return;
							if (void 0 !== t) C(t.call(e)).value;
						})(e),
						t)
					);
				}
			},
			pi = et("iterator"),
			mi = Array.prototype,
			fi = function (e) {
				return void 0 !== e && (Ht.Array === e || mi[pi] === e);
			},
			gi = function (e, t, i) {
				var n = y(t);
				n in e ? x.f(e, n, c(0, i)) : (e[n] = i);
			},
			yi = {};
		yi[et("toStringTag")] = "z";
		var bi = "[object z]" === String(yi),
			vi = et("toStringTag"),
			wi =
				"Arguments" ==
				h(
					(function () {
						return arguments;
					})()
				),
			ki = bi
				? h
				: function (e) {
						var t, i, n;
						return void 0 === e
							? "Undefined"
							: null === e
							? "Null"
							: "string" ==
							  typeof (i = (function (e, t) {
									try {
										return e[t];
									} catch (e) {}
							  })((t = Object(e)), vi))
							? i
							: wi
							? h(t)
							: "Object" == (n = h(t)) && "function" == typeof t.callee
							? "Arguments"
							: n;
				  },
			Ti = et("iterator"),
			Si = function (e) {
				if (null != e) return e[Ti] || e["@@iterator"] || Ht[ki(e)];
			},
			Ei = function (e) {
				var t,
					i,
					n,
					s,
					r,
					a,
					o = ht(e),
					l = "function" == typeof this ? this : Array,
					c = arguments.length,
					u = c > 1 ? arguments[1] : void 0,
					h = void 0 !== u,
					d = Si(o),
					p = 0;
				if (
					(h && (u = hi(u, c > 2 ? arguments[2] : void 0, 2)),
					null == d || (l == Array && fi(d)))
				)
					for (i = new l((t = le(o.length))); t > p; p++)
						(a = h ? u(o[p], p) : o[p]), gi(i, p, a);
				else
					for (
						r = (s = d.call(o)).next, i = new l();
						!(n = r.call(s)).done;
						p++
					)
						(a = h ? di(s, u, [n.value, p], !0) : n.value), gi(i, p, a);
				return (i.length = p), i;
			},
			Ai = 2147483647,
			Ci = /[^\0-\u007E]/,
			Pi = /[.\u3002\uFF0E\uFF61]/g,
			xi = "Overflow: input needs wider integers to process",
			Li = Math.floor,
			Ii = String.fromCharCode,
			_i = function (e) {
				return e + 22 + 75 * (e < 26);
			},
			Oi = function (e, t, i) {
				var n = 0;
				for (e = i ? Li(e / 700) : e >> 1, e += Li(e / t); e > 455; n += 36)
					e = Li(e / 35);
				return Li(n + (36 * e) / (e + 38));
			},
			Mi = function (e) {
				var t,
					i,
					n = [],
					s = (e = (function (e) {
						for (var t = [], i = 0, n = e.length; i < n; ) {
							var s = e.charCodeAt(i++);
							if (s >= 55296 && s <= 56319 && i < n) {
								var r = e.charCodeAt(i++);
								56320 == (64512 & r)
									? t.push(((1023 & s) << 10) + (1023 & r) + 65536)
									: (t.push(s), i--);
							} else t.push(s);
						}
						return t;
					})(e)).length,
					r = 128,
					a = 0,
					o = 72;
				for (t = 0; t < e.length; t++) (i = e[t]) < 128 && n.push(Ii(i));
				var l = n.length,
					c = l;
				for (l && n.push("-"); c < s; ) {
					var u = Ai;
					for (t = 0; t < e.length; t++) (i = e[t]) >= r && i < u && (u = i);
					var h = c + 1;
					if (u - r > Li((Ai - a) / h)) throw RangeError(xi);
					for (a += (u - r) * h, r = u, t = 0; t < e.length; t++) {
						if ((i = e[t]) < r && ++a > Ai) throw RangeError(xi);
						if (i == r) {
							for (var d = a, p = 36; ; p += 36) {
								var m = p <= o ? 1 : p >= o + 26 ? 26 : p - o;
								if (d < m) break;
								var f = d - m,
									g = 36 - m;
								n.push(Ii(_i(m + (f % g)))), (d = Li(f / g));
							}
							n.push(Ii(_i(d))), (o = Oi(a, h, c == l)), (a = 0), ++c;
						}
					}
					++a, ++r;
				}
				return n.join("");
			},
			Ni = et("unscopables"),
			Ri = Array.prototype;
		null == Ri[Ni] && x.f(Ri, Ni, { configurable: !0, value: Ut(null) });
		var ji = function (e) {
				Ri[Ni][e] = !0;
			},
			$i = "Array Iterator",
			Ui = Z.set,
			qi = Z.getterFor($i);
		ei(
			Array,
			"Array",
			function (e, t) {
				Ui(this, { type: $i, target: f(e), index: 0, kind: t });
			},
			function () {
				var e = qi(this),
					t = e.target,
					i = e.kind,
					n = e.index++;
				return !t || n >= t.length
					? ((e.target = void 0), { value: void 0, done: !0 })
					: "keys" == i
					? { value: n, done: !1 }
					: "values" == i
					? { value: t[n], done: !1 }
					: { value: [n, t[n]], done: !1 };
			},
			"values"
		),
			(Ht.Arguments = Ht.Array),
			ji("keys"),
			ji("values"),
			ji("entries");
		var Fi = function (e) {
				var t = Si(e);
				if ("function" != typeof t)
					throw TypeError(String(e) + " is not iterable");
				return C(t.call(e));
			},
			Di = ne("fetch"),
			Hi = ne("Headers"),
			Bi = et("iterator"),
			Vi = "URLSearchParams",
			Wi = "URLSearchParamsIterator",
			zi = Z.set,
			Ki = Z.getterFor(Vi),
			Yi = Z.getterFor(Wi),
			Gi = /\+/g,
			Xi = Array(4),
			Qi = function (e) {
				return (
					Xi[e - 1] ||
					(Xi[e - 1] = RegExp("((?:%[\\da-f]{2}){" + e + "})", "gi"))
				);
			},
			Ji = function (e) {
				try {
					return decodeURIComponent(e);
				} catch (t) {
					return e;
				}
			},
			Zi = function (e) {
				var t = e.replace(Gi, " "),
					i = 4;
				try {
					return decodeURIComponent(t);
				} catch (e) {
					for (; i; ) t = t.replace(Qi(i--), Ji);
					return t;
				}
			},
			en = /[!'()~]|%20/g,
			tn = {
				"!": "%21",
				"'": "%27",
				"(": "%28",
				")": "%29",
				"~": "%7E",
				"%20": "+",
			},
			nn = function (e) {
				return tn[e];
			},
			sn = function (e) {
				return encodeURIComponent(e).replace(en, nn);
			},
			rn = function (e, t) {
				if (t)
					for (var i, n, s = t.split("&"), r = 0; r < s.length; )
						(i = s[r++]).length &&
							((n = i.split("=")),
							e.push({ key: Zi(n.shift()), value: Zi(n.join("=")) }));
			},
			an = function (e) {
				(this.entries.length = 0), rn(this.entries, e);
			},
			on = function (e, t) {
				if (e < t) throw TypeError("Not enough arguments");
			},
			ln = Wt(
				function (e, t) {
					zi(this, { type: Wi, iterator: Fi(Ki(e).entries), kind: t });
				},
				"Iterator",
				function () {
					var e = Yi(this),
						t = e.kind,
						i = e.iterator.next(),
						n = i.value;
					return (
						i.done ||
							(i.value =
								"keys" === t
									? n.key
									: "values" === t
									? n.value
									: [n.key, n.value]),
						i
					);
				}
			),
			cn = function () {
				oi(this, cn, Vi);
				var e,
					t,
					i,
					n,
					s,
					r,
					a,
					o,
					l,
					c = arguments.length > 0 ? arguments[0] : void 0,
					u = this,
					h = [];
				if (
					(zi(u, {
						type: Vi,
						entries: h,
						updateURL: function () {},
						updateSearchParams: an,
					}),
					void 0 !== c)
				)
					if (g(c))
						if ("function" == typeof (e = Si(c)))
							for (i = (t = e.call(c)).next; !(n = i.call(t)).done; ) {
								if (
									(a = (r = (s = Fi(C(n.value))).next).call(s)).done ||
									(o = r.call(s)).done ||
									!r.call(s).done
								)
									throw TypeError("Expected sequence with length 2");
								h.push({ key: a.value + "", value: o.value + "" });
							}
						else for (l in c) v(c, l) && h.push({ key: l, value: c[l] + "" });
					else
						rn(
							h,
							"string" == typeof c
								? "?" === c.charAt(0)
									? c.slice(1)
									: c
								: c + ""
						);
			},
			un = cn.prototype;
		!(function (e, t, i) {
			for (var n in t) ee(e, n, t[n], i);
		})(
			un,
			{
				append: function (e, t) {
					on(arguments.length, 2);
					var i = Ki(this);
					i.entries.push({ key: e + "", value: t + "" }), i.updateURL();
				},
				delete: function (e) {
					on(arguments.length, 1);
					for (
						var t = Ki(this), i = t.entries, n = e + "", s = 0;
						s < i.length;

					)
						i[s].key === n ? i.splice(s, 1) : s++;
					t.updateURL();
				},
				get: function (e) {
					on(arguments.length, 1);
					for (var t = Ki(this).entries, i = e + "", n = 0; n < t.length; n++)
						if (t[n].key === i) return t[n].value;
					return null;
				},
				getAll: function (e) {
					on(arguments.length, 1);
					for (
						var t = Ki(this).entries, i = e + "", n = [], s = 0;
						s < t.length;
						s++
					)
						t[s].key === i && n.push(t[s].value);
					return n;
				},
				has: function (e) {
					on(arguments.length, 1);
					for (var t = Ki(this).entries, i = e + "", n = 0; n < t.length; )
						if (t[n++].key === i) return !0;
					return !1;
				},
				set: function (e, t) {
					on(arguments.length, 1);
					for (
						var i,
							n = Ki(this),
							s = n.entries,
							r = !1,
							a = e + "",
							o = t + "",
							l = 0;
						l < s.length;
						l++
					)
						(i = s[l]).key === a &&
							(r ? s.splice(l--, 1) : ((r = !0), (i.value = o)));
					r || s.push({ key: a, value: o }), n.updateURL();
				},
				sort: function () {
					var e,
						t,
						i,
						n = Ki(this),
						s = n.entries,
						r = s.slice();
					for (s.length = 0, i = 0; i < r.length; i++) {
						for (e = r[i], t = 0; t < i; t++)
							if (s[t].key > e.key) {
								s.splice(t, 0, e);
								break;
							}
						t === i && s.push(e);
					}
					n.updateURL();
				},
				forEach: function (e) {
					for (
						var t,
							i = Ki(this).entries,
							n = hi(e, arguments.length > 1 ? arguments[1] : void 0, 3),
							s = 0;
						s < i.length;

					)
						n((t = i[s++]).value, t.key, this);
				},
				keys: function () {
					return new ln(this, "keys");
				},
				values: function () {
					return new ln(this, "values");
				},
				entries: function () {
					return new ln(this, "entries");
				},
			},
			{ enumerable: !0 }
		),
			ee(un, Bi, un.entries),
			ee(
				un,
				"toString",
				function () {
					for (var e, t = Ki(this).entries, i = [], n = 0; n < t.length; )
						(e = t[n++]), i.push(sn(e.key) + "=" + sn(e.value));
					return i.join("&");
				},
				{ enumerable: !0 }
			),
			Dt(cn, Vi),
			xe({ global: !0, forced: !ai }, { URLSearchParams: cn }),
			ai ||
				"function" != typeof Di ||
				"function" != typeof Hi ||
				xe(
					{ global: !0, enumerable: !0, forced: !0 },
					{
						fetch: function (e) {
							var t,
								i,
								n,
								s = [e];
							return (
								arguments.length > 1 &&
									(g((t = arguments[1])) &&
										((i = t.body),
										ki(i) === Vi &&
											((n = t.headers ? new Hi(t.headers) : new Hi()).has(
												"content-type"
											) ||
												n.set(
													"content-type",
													"application/x-www-form-urlencoded;charset=UTF-8"
												),
											(t = Ut(t, {
												body: c(0, String(i)),
												headers: c(0, n),
											})))),
									s.push(t)),
								Di.apply(this, s)
							);
						},
					}
				);
		var hn,
			dn = { URLSearchParams: cn, getState: Ki },
			pn = lt.codeAt,
			mn = n.URL,
			fn = dn.URLSearchParams,
			gn = dn.getState,
			yn = Z.set,
			bn = Z.getterFor("URL"),
			vn = Math.floor,
			wn = Math.pow,
			kn = "Invalid scheme",
			Tn = "Invalid host",
			Sn = "Invalid port",
			En = /[A-Za-z]/,
			An = /[\d+-.A-Za-z]/,
			Cn = /\d/,
			Pn = /^(0x|0X)/,
			xn = /^[0-7]+$/,
			Ln = /^\d+$/,
			In = /^[\dA-Fa-f]+$/,
			_n = /[\u0000\t\u000A\u000D #%/:?@[\\]]/,
			On = /[\u0000\t\u000A\u000D #/:?@[\\]]/,
			Mn = /^[\u0000-\u001F ]+|[\u0000-\u001F ]+$/g,
			Nn = /[\t\u000A\u000D]/g,
			Rn = function (e, t) {
				var i, n, s;
				if ("[" == t.charAt(0)) {
					if ("]" != t.charAt(t.length - 1)) return Tn;
					if (!(i = $n(t.slice(1, -1)))) return Tn;
					e.host = i;
				} else if (Wn(e)) {
					if (
						((t = (function (e) {
							var t,
								i,
								n = [],
								s = e.toLowerCase().replace(Pi, ".").split(".");
							for (t = 0; t < s.length; t++)
								(i = s[t]), n.push(Ci.test(i) ? "xn--" + Mi(i) : i);
							return n.join(".");
						})(t)),
						_n.test(t))
					)
						return Tn;
					if (null === (i = jn(t))) return Tn;
					e.host = i;
				} else {
					if (On.test(t)) return Tn;
					for (i = "", n = Ei(t), s = 0; s < n.length; s++) i += Bn(n[s], qn);
					e.host = i;
				}
			},
			jn = function (e) {
				var t,
					i,
					n,
					s,
					r,
					a,
					o,
					l = e.split(".");
				if ((l.length && "" == l[l.length - 1] && l.pop(), (t = l.length) > 4))
					return e;
				for (i = [], n = 0; n < t; n++) {
					if ("" == (s = l[n])) return e;
					if (
						((r = 10),
						s.length > 1 &&
							"0" == s.charAt(0) &&
							((r = Pn.test(s) ? 16 : 8), (s = s.slice(8 == r ? 1 : 2))),
						"" === s)
					)
						a = 0;
					else {
						if (!(10 == r ? Ln : 8 == r ? xn : In).test(s)) return e;
						a = parseInt(s, r);
					}
					i.push(a);
				}
				for (n = 0; n < t; n++)
					if (((a = i[n]), n == t - 1)) {
						if (a >= wn(256, 5 - t)) return null;
					} else if (a > 255) return null;
				for (o = i.pop(), n = 0; n < i.length; n++) o += i[n] * wn(256, 3 - n);
				return o;
			},
			$n = function (e) {
				var t,
					i,
					n,
					s,
					r,
					a,
					o,
					l = [0, 0, 0, 0, 0, 0, 0, 0],
					c = 0,
					u = null,
					h = 0,
					d = function () {
						return e.charAt(h);
					};
				if (":" == d()) {
					if (":" != e.charAt(1)) return;
					(h += 2), (u = ++c);
				}
				for (; d(); ) {
					if (8 == c) return;
					if (":" != d()) {
						for (t = i = 0; i < 4 && In.test(d()); )
							(t = 16 * t + parseInt(d(), 16)), h++, i++;
						if ("." == d()) {
							if (0 == i) return;
							if (((h -= i), c > 6)) return;
							for (n = 0; d(); ) {
								if (((s = null), n > 0)) {
									if (!("." == d() && n < 4)) return;
									h++;
								}
								if (!Cn.test(d())) return;
								for (; Cn.test(d()); ) {
									if (((r = parseInt(d(), 10)), null === s)) s = r;
									else {
										if (0 == s) return;
										s = 10 * s + r;
									}
									if (s > 255) return;
									h++;
								}
								(l[c] = 256 * l[c] + s), (2 != ++n && 4 != n) || c++;
							}
							if (4 != n) return;
							break;
						}
						if (":" == d()) {
							if ((h++, !d())) return;
						} else if (d()) return;
						l[c++] = t;
					} else {
						if (null !== u) return;
						h++, (u = ++c);
					}
				}
				if (null !== u)
					for (a = c - u, c = 7; 0 != c && a > 0; )
						(o = l[c]), (l[c--] = l[u + a - 1]), (l[u + --a] = o);
				else if (8 != c) return;
				return l;
			},
			Un = function (e) {
				var t, i, n, s;
				if ("number" == typeof e) {
					for (t = [], i = 0; i < 4; i++) t.unshift(e % 256), (e = vn(e / 256));
					return t.join(".");
				}
				if ("object" == typeof e) {
					for (
						t = "",
							n = (function (e) {
								for (var t = null, i = 1, n = null, s = 0, r = 0; r < 8; r++)
									0 !== e[r]
										? (s > i && ((t = n), (i = s)), (n = null), (s = 0))
										: (null === n && (n = r), ++s);
								return s > i && ((t = n), (i = s)), t;
							})(e),
							i = 0;
						i < 8;
						i++
					)
						(s && 0 === e[i]) ||
							(s && (s = !1),
							n === i
								? ((t += i ? ":" : "::"), (s = !0))
								: ((t += e[i].toString(16)), i < 7 && (t += ":")));
					return "[" + t + "]";
				}
				return e;
			},
			qn = {},
			Fn = ui({}, qn, { " ": 1, '"': 1, "<": 1, ">": 1, "`": 1 }),
			Dn = ui({}, Fn, { "#": 1, "?": 1, "{": 1, "}": 1 }),
			Hn = ui({}, Dn, {
				"/": 1,
				":": 1,
				";": 1,
				"=": 1,
				"@": 1,
				"[": 1,
				"\\": 1,
				"]": 1,
				"^": 1,
				"|": 1,
			}),
			Bn = function (e, t) {
				var i = pn(e, 0);
				return i > 32 && i < 127 && !v(t, e) ? e : encodeURIComponent(e);
			},
			Vn = { ftp: 21, file: null, http: 80, https: 443, ws: 80, wss: 443 },
			Wn = function (e) {
				return v(Vn, e.scheme);
			},
			zn = function (e) {
				return "" != e.username || "" != e.password;
			},
			Kn = function (e) {
				return !e.host || e.cannotBeABaseURL || "file" == e.scheme;
			},
			Yn = function (e, t) {
				var i;
				return (
					2 == e.length &&
					En.test(e.charAt(0)) &&
					(":" == (i = e.charAt(1)) || (!t && "|" == i))
				);
			},
			Gn = function (e) {
				var t;
				return (
					e.length > 1 &&
					Yn(e.slice(0, 2)) &&
					(2 == e.length ||
						"/" === (t = e.charAt(2)) ||
						"\\" === t ||
						"?" === t ||
						"#" === t)
				);
			},
			Xn = function (e) {
				var t = e.path,
					i = t.length;
				!i || ("file" == e.scheme && 1 == i && Yn(t[0], !0)) || t.pop();
			},
			Qn = function (e) {
				return "." === e || "%2e" === e.toLowerCase();
			},
			Jn = {},
			Zn = {},
			es = {},
			ts = {},
			is = {},
			ns = {},
			ss = {},
			rs = {},
			as = {},
			os = {},
			ls = {},
			cs = {},
			us = {},
			hs = {},
			ds = {},
			ps = {},
			ms = {},
			fs = {},
			gs = {},
			ys = {},
			bs = {},
			vs = function (e, t, i, n) {
				var s,
					r,
					a,
					o,
					l,
					c = i || Jn,
					u = 0,
					h = "",
					d = !1,
					p = !1,
					m = !1;
				for (
					i ||
						((e.scheme = ""),
						(e.username = ""),
						(e.password = ""),
						(e.host = null),
						(e.port = null),
						(e.path = []),
						(e.query = null),
						(e.fragment = null),
						(e.cannotBeABaseURL = !1),
						(t = t.replace(Mn, ""))),
						t = t.replace(Nn, ""),
						s = Ei(t);
					u <= s.length;

				) {
					switch (((r = s[u]), c)) {
						case Jn:
							if (!r || !En.test(r)) {
								if (i) return kn;
								c = es;
								continue;
							}
							(h += r.toLowerCase()), (c = Zn);
							break;
						case Zn:
							if (r && (An.test(r) || "+" == r || "-" == r || "." == r))
								h += r.toLowerCase();
							else {
								if (":" != r) {
									if (i) return kn;
									(h = ""), (c = es), (u = 0);
									continue;
								}
								if (
									i &&
									(Wn(e) != v(Vn, h) ||
										("file" == h && (zn(e) || null !== e.port)) ||
										("file" == e.scheme && !e.host))
								)
									return;
								if (((e.scheme = h), i))
									return void (
										Wn(e) &&
										Vn[e.scheme] == e.port &&
										(e.port = null)
									);
								(h = ""),
									"file" == e.scheme
										? (c = hs)
										: Wn(e) && n && n.scheme == e.scheme
										? (c = ts)
										: Wn(e)
										? (c = rs)
										: "/" == s[u + 1]
										? ((c = is), u++)
										: ((e.cannotBeABaseURL = !0), e.path.push(""), (c = gs));
							}
							break;
						case es:
							if (!n || (n.cannotBeABaseURL && "#" != r)) return kn;
							if (n.cannotBeABaseURL && "#" == r) {
								(e.scheme = n.scheme),
									(e.path = n.path.slice()),
									(e.query = n.query),
									(e.fragment = ""),
									(e.cannotBeABaseURL = !0),
									(c = bs);
								break;
							}
							c = "file" == n.scheme ? hs : ns;
							continue;
						case ts:
							if ("/" != r || "/" != s[u + 1]) {
								c = ns;
								continue;
							}
							(c = as), u++;
							break;
						case is:
							if ("/" == r) {
								c = os;
								break;
							}
							c = fs;
							continue;
						case ns:
							if (((e.scheme = n.scheme), r == hn))
								(e.username = n.username),
									(e.password = n.password),
									(e.host = n.host),
									(e.port = n.port),
									(e.path = n.path.slice()),
									(e.query = n.query);
							else if ("/" == r || ("\\" == r && Wn(e))) c = ss;
							else if ("?" == r)
								(e.username = n.username),
									(e.password = n.password),
									(e.host = n.host),
									(e.port = n.port),
									(e.path = n.path.slice()),
									(e.query = ""),
									(c = ys);
							else {
								if ("#" != r) {
									(e.username = n.username),
										(e.password = n.password),
										(e.host = n.host),
										(e.port = n.port),
										(e.path = n.path.slice()),
										e.path.pop(),
										(c = fs);
									continue;
								}
								(e.username = n.username),
									(e.password = n.password),
									(e.host = n.host),
									(e.port = n.port),
									(e.path = n.path.slice()),
									(e.query = n.query),
									(e.fragment = ""),
									(c = bs);
							}
							break;
						case ss:
							if (!Wn(e) || ("/" != r && "\\" != r)) {
								if ("/" != r) {
									(e.username = n.username),
										(e.password = n.password),
										(e.host = n.host),
										(e.port = n.port),
										(c = fs);
									continue;
								}
								c = os;
							} else c = as;
							break;
						case rs:
							if (((c = as), "/" != r || "/" != h.charAt(u + 1))) continue;
							u++;
							break;
						case as:
							if ("/" != r && "\\" != r) {
								c = os;
								continue;
							}
							break;
						case os:
							if ("@" == r) {
								d && (h = "%40" + h), (d = !0), (a = Ei(h));
								for (var f = 0; f < a.length; f++) {
									var g = a[f];
									if (":" != g || m) {
										var y = Bn(g, Hn);
										m ? (e.password += y) : (e.username += y);
									} else m = !0;
								}
								h = "";
							} else if (
								r == hn ||
								"/" == r ||
								"?" == r ||
								"#" == r ||
								("\\" == r && Wn(e))
							) {
								if (d && "" == h) return "Invalid authority";
								(u -= Ei(h).length + 1), (h = ""), (c = ls);
							} else h += r;
							break;
						case ls:
						case cs:
							if (i && "file" == e.scheme) {
								c = ps;
								continue;
							}
							if (":" != r || p) {
								if (
									r == hn ||
									"/" == r ||
									"?" == r ||
									"#" == r ||
									("\\" == r && Wn(e))
								) {
									if (Wn(e) && "" == h) return Tn;
									if (i && "" == h && (zn(e) || null !== e.port)) return;
									if ((o = Rn(e, h))) return o;
									if (((h = ""), (c = ms), i)) return;
									continue;
								}
								"[" == r ? (p = !0) : "]" == r && (p = !1), (h += r);
							} else {
								if ("" == h) return Tn;
								if ((o = Rn(e, h))) return o;
								if (((h = ""), (c = us), i == cs)) return;
							}
							break;
						case us:
							if (!Cn.test(r)) {
								if (
									r == hn ||
									"/" == r ||
									"?" == r ||
									"#" == r ||
									("\\" == r && Wn(e)) ||
									i
								) {
									if ("" != h) {
										var b = parseInt(h, 10);
										if (b > 65535) return Sn;
										(e.port = Wn(e) && b === Vn[e.scheme] ? null : b), (h = "");
									}
									if (i) return;
									c = ms;
									continue;
								}
								return Sn;
							}
							h += r;
							break;
						case hs:
							if (((e.scheme = "file"), "/" == r || "\\" == r)) c = ds;
							else {
								if (!n || "file" != n.scheme) {
									c = fs;
									continue;
								}
								if (r == hn)
									(e.host = n.host),
										(e.path = n.path.slice()),
										(e.query = n.query);
								else if ("?" == r)
									(e.host = n.host),
										(e.path = n.path.slice()),
										(e.query = ""),
										(c = ys);
								else {
									if ("#" != r) {
										Gn(s.slice(u).join("")) ||
											((e.host = n.host), (e.path = n.path.slice()), Xn(e)),
											(c = fs);
										continue;
									}
									(e.host = n.host),
										(e.path = n.path.slice()),
										(e.query = n.query),
										(e.fragment = ""),
										(c = bs);
								}
							}
							break;
						case ds:
							if ("/" == r || "\\" == r) {
								c = ps;
								break;
							}
							n &&
								"file" == n.scheme &&
								!Gn(s.slice(u).join("")) &&
								(Yn(n.path[0], !0)
									? e.path.push(n.path[0])
									: (e.host = n.host)),
								(c = fs);
							continue;
						case ps:
							if (r == hn || "/" == r || "\\" == r || "?" == r || "#" == r) {
								if (!i && Yn(h)) c = fs;
								else if ("" == h) {
									if (((e.host = ""), i)) return;
									c = ms;
								} else {
									if ((o = Rn(e, h))) return o;
									if (("localhost" == e.host && (e.host = ""), i)) return;
									(h = ""), (c = ms);
								}
								continue;
							}
							h += r;
							break;
						case ms:
							if (Wn(e)) {
								if (((c = fs), "/" != r && "\\" != r)) continue;
							} else if (i || "?" != r)
								if (i || "#" != r) {
									if (r != hn && ((c = fs), "/" != r)) continue;
								} else (e.fragment = ""), (c = bs);
							else (e.query = ""), (c = ys);
							break;
						case fs:
							if (
								r == hn ||
								"/" == r ||
								("\\" == r && Wn(e)) ||
								(!i && ("?" == r || "#" == r))
							) {
								if (
									(".." === (l = (l = h).toLowerCase()) ||
									"%2e." === l ||
									".%2e" === l ||
									"%2e%2e" === l
										? (Xn(e),
										  "/" == r || ("\\" == r && Wn(e)) || e.path.push(""))
										: Qn(h)
										? "/" == r || ("\\" == r && Wn(e)) || e.path.push("")
										: ("file" == e.scheme &&
												!e.path.length &&
												Yn(h) &&
												(e.host && (e.host = ""), (h = h.charAt(0) + ":")),
										  e.path.push(h)),
									(h = ""),
									"file" == e.scheme && (r == hn || "?" == r || "#" == r))
								)
									for (; e.path.length > 1 && "" === e.path[0]; )
										e.path.shift();
								"?" == r
									? ((e.query = ""), (c = ys))
									: "#" == r && ((e.fragment = ""), (c = bs));
							} else h += Bn(r, Dn);
							break;
						case gs:
							"?" == r
								? ((e.query = ""), (c = ys))
								: "#" == r
								? ((e.fragment = ""), (c = bs))
								: r != hn && (e.path[0] += Bn(r, qn));
							break;
						case ys:
							i || "#" != r
								? r != hn &&
								  ("'" == r && Wn(e)
										? (e.query += "%27")
										: (e.query += "#" == r ? "%23" : Bn(r, qn)))
								: ((e.fragment = ""), (c = bs));
							break;
						case bs:
							r != hn && (e.fragment += Bn(r, Fn));
					}
					u++;
				}
			},
			ws = function (e) {
				var t,
					i,
					n = oi(this, ws, "URL"),
					s = arguments.length > 1 ? arguments[1] : void 0,
					a = String(e),
					o = yn(n, { type: "URL" });
				if (void 0 !== s)
					if (s instanceof ws) t = bn(s);
					else if ((i = vs((t = {}), String(s)))) throw TypeError(i);
				if ((i = vs(o, a, null, t))) throw TypeError(i);
				var l = (o.searchParams = new fn()),
					c = gn(l);
				c.updateSearchParams(o.query),
					(c.updateURL = function () {
						o.query = String(l) || null;
					}),
					r ||
						((n.href = Ts.call(n)),
						(n.origin = Ss.call(n)),
						(n.protocol = Es.call(n)),
						(n.username = As.call(n)),
						(n.password = Cs.call(n)),
						(n.host = Ps.call(n)),
						(n.hostname = xs.call(n)),
						(n.port = Ls.call(n)),
						(n.pathname = Is.call(n)),
						(n.search = _s.call(n)),
						(n.searchParams = Os.call(n)),
						(n.hash = Ms.call(n)));
			},
			ks = ws.prototype,
			Ts = function () {
				var e = bn(this),
					t = e.scheme,
					i = e.username,
					n = e.password,
					s = e.host,
					r = e.port,
					a = e.path,
					o = e.query,
					l = e.fragment,
					c = t + ":";
				return (
					null !== s
						? ((c += "//"),
						  zn(e) && (c += i + (n ? ":" + n : "") + "@"),
						  (c += Un(s)),
						  null !== r && (c += ":" + r))
						: "file" == t && (c += "//"),
					(c += e.cannotBeABaseURL ? a[0] : a.length ? "/" + a.join("/") : ""),
					null !== o && (c += "?" + o),
					null !== l && (c += "#" + l),
					c
				);
			},
			Ss = function () {
				var e = bn(this),
					t = e.scheme,
					i = e.port;
				if ("blob" == t)
					try {
						return new URL(t.path[0]).origin;
					} catch (e) {
						return "null";
					}
				return "file" != t && Wn(e)
					? t + "://" + Un(e.host) + (null !== i ? ":" + i : "")
					: "null";
			},
			Es = function () {
				return bn(this).scheme + ":";
			},
			As = function () {
				return bn(this).username;
			},
			Cs = function () {
				return bn(this).password;
			},
			Ps = function () {
				var e = bn(this),
					t = e.host,
					i = e.port;
				return null === t ? "" : null === i ? Un(t) : Un(t) + ":" + i;
			},
			xs = function () {
				var e = bn(this).host;
				return null === e ? "" : Un(e);
			},
			Ls = function () {
				var e = bn(this).port;
				return null === e ? "" : String(e);
			},
			Is = function () {
				var e = bn(this),
					t = e.path;
				return e.cannotBeABaseURL ? t[0] : t.length ? "/" + t.join("/") : "";
			},
			_s = function () {
				var e = bn(this).query;
				return e ? "?" + e : "";
			},
			Os = function () {
				return bn(this).searchParams;
			},
			Ms = function () {
				var e = bn(this).fragment;
				return e ? "#" + e : "";
			},
			Ns = function (e, t) {
				return { get: e, set: t, configurable: !0, enumerable: !0 };
			};
		if (
			(r &&
				Ot(ks, {
					href: Ns(Ts, function (e) {
						var t = bn(this),
							i = String(e),
							n = vs(t, i);
						if (n) throw TypeError(n);
						gn(t.searchParams).updateSearchParams(t.query);
					}),
					origin: Ns(Ss),
					protocol: Ns(Es, function (e) {
						var t = bn(this);
						vs(t, String(e) + ":", Jn);
					}),
					username: Ns(As, function (e) {
						var t = bn(this),
							i = Ei(String(e));
						if (!Kn(t)) {
							t.username = "";
							for (var n = 0; n < i.length; n++) t.username += Bn(i[n], Hn);
						}
					}),
					password: Ns(Cs, function (e) {
						var t = bn(this),
							i = Ei(String(e));
						if (!Kn(t)) {
							t.password = "";
							for (var n = 0; n < i.length; n++) t.password += Bn(i[n], Hn);
						}
					}),
					host: Ns(Ps, function (e) {
						var t = bn(this);
						t.cannotBeABaseURL || vs(t, String(e), ls);
					}),
					hostname: Ns(xs, function (e) {
						var t = bn(this);
						t.cannotBeABaseURL || vs(t, String(e), cs);
					}),
					port: Ns(Ls, function (e) {
						var t = bn(this);
						Kn(t) || ("" == (e = String(e)) ? (t.port = null) : vs(t, e, us));
					}),
					pathname: Ns(Is, function (e) {
						var t = bn(this);
						t.cannotBeABaseURL || ((t.path = []), vs(t, e + "", ms));
					}),
					search: Ns(_s, function (e) {
						var t = bn(this);
						"" == (e = String(e))
							? (t.query = null)
							: ("?" == e.charAt(0) && (e = e.slice(1)),
							  (t.query = ""),
							  vs(t, e, ys)),
							gn(t.searchParams).updateSearchParams(t.query);
					}),
					searchParams: Ns(Os),
					hash: Ns(Ms, function (e) {
						var t = bn(this);
						"" != (e = String(e))
							? ("#" == e.charAt(0) && (e = e.slice(1)),
							  (t.fragment = ""),
							  vs(t, e, bs))
							: (t.fragment = null);
					}),
				}),
			ee(
				ks,
				"toJSON",
				function () {
					return Ts.call(this);
				},
				{ enumerable: !0 }
			),
			ee(
				ks,
				"toString",
				function () {
					return Ts.call(this);
				},
				{ enumerable: !0 }
			),
			mn)
		) {
			var Rs = mn.createObjectURL,
				js = mn.revokeObjectURL;
			Rs &&
				ee(ws, "createObjectURL", function (e) {
					return Rs.apply(mn, arguments);
				}),
				js &&
					ee(ws, "revokeObjectURL", function (e) {
						return js.apply(mn, arguments);
					});
		}
		function $s(e, t, i) {
			return (
				t in e
					? Object.defineProperty(e, t, {
							value: i,
							enumerable: !0,
							configurable: !0,
							writable: !0,
					  })
					: (e[t] = i),
				e
			);
		}
		function Us(e, t) {
			for (var i = 0; i < t.length; i++) {
				var n = t[i];
				(n.enumerable = n.enumerable || !1),
					(n.configurable = !0),
					"value" in n && (n.writable = !0),
					Object.defineProperty(e, n.key, n);
			}
		}
		function qs(e, t, i) {
			return (
				t in e
					? Object.defineProperty(e, t, {
							value: i,
							enumerable: !0,
							configurable: !0,
							writable: !0,
					  })
					: (e[t] = i),
				e
			);
		}
		function Fs(e, t) {
			var i = Object.keys(e);
			if (Object.getOwnPropertySymbols) {
				var n = Object.getOwnPropertySymbols(e);
				t &&
					(n = n.filter(function (t) {
						return Object.getOwnPropertyDescriptor(e, t).enumerable;
					})),
					i.push.apply(i, n);
			}
			return i;
		}
		function Ds(e) {
			for (var t = 1; t < arguments.length; t++) {
				var i = null != arguments[t] ? arguments[t] : {};
				t % 2
					? Fs(Object(i), !0).forEach(function (t) {
							qs(e, t, i[t]);
					  })
					: Object.getOwnPropertyDescriptors
					? Object.defineProperties(e, Object.getOwnPropertyDescriptors(i))
					: Fs(Object(i)).forEach(function (t) {
							Object.defineProperty(
								e,
								t,
								Object.getOwnPropertyDescriptor(i, t)
							);
					  });
			}
			return e;
		}
		Dt(ws, "URL"),
			xe({ global: !0, forced: !ai, sham: !r }, { URL: ws }),
			(function (e) {
				var t = (function () {
						try {
							return !!Symbol.iterator;
						} catch (e) {
							return !1;
						}
					})(),
					i = function (e) {
						var i = {
							next: function () {
								var t = e.shift();
								return { done: void 0 === t, value: t };
							},
						};
						return (
							t &&
								(i[Symbol.iterator] = function () {
									return i;
								}),
							i
						);
					},
					n = function (e) {
						return encodeURIComponent(e).replace(/%20/g, "+");
					},
					s = function (e) {
						return decodeURIComponent(String(e).replace(/\+/g, " "));
					};
				(function () {
					try {
						var t = e.URLSearchParams;
						return (
							"a=1" === new t("?a=1").toString() &&
							"function" == typeof t.prototype.set &&
							"function" == typeof t.prototype.entries
						);
					} catch (e) {
						return !1;
					}
				})() ||
					(function () {
						var s = function (e) {
								Object.defineProperty(this, "_entries", {
									writable: !0,
									value: {},
								});
								var t = typeof e;
								if ("undefined" === t);
								else if ("string" === t) "" !== e && this._fromString(e);
								else if (e instanceof s) {
									var i = this;
									e.forEach(function (e, t) {
										i.append(t, e);
									});
								} else {
									if (null === e || "object" !== t)
										throw new TypeError(
											"Unsupported input's type for URLSearchParams"
										);
									if ("[object Array]" === Object.prototype.toString.call(e))
										for (var n = 0; n < e.length; n++) {
											var r = e[n];
											if (
												"[object Array]" !==
													Object.prototype.toString.call(r) &&
												2 === r.length
											)
												throw new TypeError(
													"Expected [string, any] as entry at index " +
														n +
														" of URLSearchParams's input"
												);
											this.append(r[0], r[1]);
										}
									else
										for (var a in e)
											e.hasOwnProperty(a) && this.append(a, e[a]);
								}
							},
							r = s.prototype;
						(r.append = function (e, t) {
							e in this._entries
								? this._entries[e].push(String(t))
								: (this._entries[e] = [String(t)]);
						}),
							(r.delete = function (e) {
								delete this._entries[e];
							}),
							(r.get = function (e) {
								return e in this._entries ? this._entries[e][0] : null;
							}),
							(r.getAll = function (e) {
								return e in this._entries ? this._entries[e].slice(0) : [];
							}),
							(r.has = function (e) {
								return e in this._entries;
							}),
							(r.set = function (e, t) {
								this._entries[e] = [String(t)];
							}),
							(r.forEach = function (e, t) {
								var i;
								for (var n in this._entries)
									if (this._entries.hasOwnProperty(n)) {
										i = this._entries[n];
										for (var s = 0; s < i.length; s++) e.call(t, i[s], n, this);
									}
							}),
							(r.keys = function () {
								var e = [];
								return (
									this.forEach(function (t, i) {
										e.push(i);
									}),
									i(e)
								);
							}),
							(r.values = function () {
								var e = [];
								return (
									this.forEach(function (t) {
										e.push(t);
									}),
									i(e)
								);
							}),
							(r.entries = function () {
								var e = [];
								return (
									this.forEach(function (t, i) {
										e.push([i, t]);
									}),
									i(e)
								);
							}),
							t && (r[Symbol.iterator] = r.entries),
							(r.toString = function () {
								var e = [];
								return (
									this.forEach(function (t, i) {
										e.push(n(i) + "=" + n(t));
									}),
									e.join("&")
								);
							}),
							(e.URLSearchParams = s);
					})();
				var r = e.URLSearchParams.prototype;
				"function" != typeof r.sort &&
					(r.sort = function () {
						var e = this,
							t = [];
						this.forEach(function (i, n) {
							t.push([n, i]), e._entries || e.delete(n);
						}),
							t.sort(function (e, t) {
								return e[0] < t[0] ? -1 : e[0] > t[0] ? 1 : 0;
							}),
							e._entries && (e._entries = {});
						for (var i = 0; i < t.length; i++) this.append(t[i][0], t[i][1]);
					}),
					"function" != typeof r._fromString &&
						Object.defineProperty(r, "_fromString", {
							enumerable: !1,
							configurable: !1,
							writable: !1,
							value: function (e) {
								if (this._entries) this._entries = {};
								else {
									var t = [];
									this.forEach(function (e, i) {
										t.push(i);
									});
									for (var i = 0; i < t.length; i++) this.delete(t[i]);
								}
								var n,
									r = (e = e.replace(/^\?/, "")).split("&");
								for (i = 0; i < r.length; i++)
									(n = r[i].split("=")),
										this.append(s(n[0]), n.length > 1 ? s(n[1]) : "");
							},
						});
			})(
				void 0 !== e
					? e
					: "undefined" != typeof window
					? window
					: "undefined" != typeof self
					? self
					: e
			),
			(function (e) {
				if (
					((function () {
						try {
							var t = new e.URL("b", "http://a");
							return (
								(t.pathname = "c d"),
								"http://a/c%20d" === t.href && t.searchParams
							);
						} catch (e) {
							return !1;
						}
					})() ||
						(function () {
							var t = e.URL,
								i = function (t, i) {
									"string" != typeof t && (t = String(t)),
										i && "string" != typeof i && (i = String(i));
									var n,
										s = document;
									if (i && (void 0 === e.location || i !== e.location.href)) {
										(i = i.toLowerCase()),
											((n = (s =
												document.implementation.createHTMLDocument(
													""
												)).createElement("base")).href = i),
											s.head.appendChild(n);
										try {
											if (0 !== n.href.indexOf(i)) throw new Error(n.href);
										} catch (e) {
											throw new Error(
												"URL unable to set base " + i + " due to " + e
											);
										}
									}
									var r = s.createElement("a");
									(r.href = t), n && (s.body.appendChild(r), (r.href = r.href));
									var a = s.createElement("input");
									if (
										((a.type = "url"),
										(a.value = t),
										":" === r.protocol ||
											!/:/.test(r.href) ||
											(!a.checkValidity() && !i))
									)
										throw new TypeError("Invalid URL");
									Object.defineProperty(this, "_anchorElement", { value: r });
									var o = new e.URLSearchParams(this.search),
										l = !0,
										c = !0,
										u = this;
									["append", "delete", "set"].forEach(function (e) {
										var t = o[e];
										o[e] = function () {
											t.apply(o, arguments),
												l && ((c = !1), (u.search = o.toString()), (c = !0));
										};
									}),
										Object.defineProperty(this, "searchParams", {
											value: o,
											enumerable: !0,
										});
									var h = void 0;
									Object.defineProperty(this, "_updateSearchParams", {
										enumerable: !1,
										configurable: !1,
										writable: !1,
										value: function () {
											this.search !== h &&
												((h = this.search),
												c &&
													((l = !1),
													this.searchParams._fromString(this.search),
													(l = !0)));
										},
									});
								},
								n = i.prototype;
							["hash", "host", "hostname", "port", "protocol"].forEach(
								function (e) {
									!(function (e) {
										Object.defineProperty(n, e, {
											get: function () {
												return this._anchorElement[e];
											},
											set: function (t) {
												this._anchorElement[e] = t;
											},
											enumerable: !0,
										});
									})(e);
								}
							),
								Object.defineProperty(n, "search", {
									get: function () {
										return this._anchorElement.search;
									},
									set: function (e) {
										(this._anchorElement.search = e),
											this._updateSearchParams();
									},
									enumerable: !0,
								}),
								Object.defineProperties(n, {
									toString: {
										get: function () {
											var e = this;
											return function () {
												return e.href;
											};
										},
									},
									href: {
										get: function () {
											return this._anchorElement.href.replace(/\?$/, "");
										},
										set: function (e) {
											(this._anchorElement.href = e),
												this._updateSearchParams();
										},
										enumerable: !0,
									},
									pathname: {
										get: function () {
											return this._anchorElement.pathname.replace(
												/(^\/?)/,
												"/"
											);
										},
										set: function (e) {
											this._anchorElement.pathname = e;
										},
										enumerable: !0,
									},
									origin: {
										get: function () {
											var e = { "http:": 80, "https:": 443, "ftp:": 21 }[
													this._anchorElement.protocol
												],
												t =
													this._anchorElement.port != e &&
													"" !== this._anchorElement.port;
											return (
												this._anchorElement.protocol +
												"//" +
												this._anchorElement.hostname +
												(t ? ":" + this._anchorElement.port : "")
											);
										},
										enumerable: !0,
									},
									password: {
										get: function () {
											return "";
										},
										set: function (e) {},
										enumerable: !0,
									},
									username: {
										get: function () {
											return "";
										},
										set: function (e) {},
										enumerable: !0,
									},
								}),
								(i.createObjectURL = function (e) {
									return t.createObjectURL.apply(t, arguments);
								}),
								(i.revokeObjectURL = function (e) {
									return t.revokeObjectURL.apply(t, arguments);
								}),
								(e.URL = i);
						})(),
					void 0 !== e.location && !("origin" in e.location))
				) {
					var t = function () {
						return (
							e.location.protocol +
							"//" +
							e.location.hostname +
							(e.location.port ? ":" + e.location.port : "")
						);
					};
					try {
						Object.defineProperty(e.location, "origin", {
							get: t,
							enumerable: !0,
						});
					} catch (i) {
						setInterval(function () {
							e.location.origin = t();
						}, 100);
					}
				}
			})(
				void 0 !== e
					? e
					: "undefined" != typeof window
					? window
					: "undefined" != typeof self
					? self
					: e
			);
		var Hs = { addCSS: !0, thumbWidth: 15, watch: !0 };
		function Bs(e, t) {
			return function () {
				return Array.from(document.querySelectorAll(t)).includes(this);
			}.call(e, t);
		}
		var Vs = function (e) {
				return null != e ? e.constructor : null;
			},
			Ws = function (e, t) {
				return !!(e && t && e instanceof t);
			},
			zs = function (e) {
				return null == e;
			},
			Ks = function (e) {
				return Vs(e) === Object;
			},
			Ys = function (e) {
				return Vs(e) === String;
			},
			Gs = function (e) {
				return Array.isArray(e);
			},
			Xs = function (e) {
				return Ws(e, NodeList);
			},
			Qs = Ys,
			Js = Gs,
			Zs = Xs,
			er = function (e) {
				return Ws(e, Element);
			},
			tr = function (e) {
				return Ws(e, Event);
			},
			ir = function (e) {
				return (
					zs(e) ||
					((Ys(e) || Gs(e) || Xs(e)) && !e.length) ||
					(Ks(e) && !Object.keys(e).length)
				);
			};
		function nr(e, t) {
			if (1 > t) {
				var i = (function (e) {
					var t = "".concat(e).match(/(?:\.(\d+))?(?:[eE]([+-]?\d+))?$/);
					return t
						? Math.max(0, (t[1] ? t[1].length : 0) - (t[2] ? +t[2] : 0))
						: 0;
				})(t);
				return parseFloat(e.toFixed(i));
			}
			return Math.round(e / t) * t;
		}
		var sr = (function () {
			function e(t, i) {
				(function (e, t) {
					if (!(e instanceof t))
						throw new TypeError("Cannot call a class as a function");
				})(this, e),
					er(t)
						? (this.element = t)
						: Qs(t) && (this.element = document.querySelector(t)),
					er(this.element) &&
						ir(this.element.rangeTouch) &&
						((this.config = Ds({}, Hs, {}, i)), this.init());
			}
			return (
				(function (e, t, i) {
					t && Us(e.prototype, t), i && Us(e, i);
				})(
					e,
					[
						{
							key: "init",
							value: function () {
								e.enabled &&
									(this.config.addCSS &&
										((this.element.style.userSelect = "none"),
										(this.element.style.webKitUserSelect = "none"),
										(this.element.style.touchAction = "manipulation")),
									this.listeners(!0),
									(this.element.rangeTouch = this));
							},
						},
						{
							key: "destroy",
							value: function () {
								e.enabled &&
									(this.config.addCSS &&
										((this.element.style.userSelect = ""),
										(this.element.style.webKitUserSelect = ""),
										(this.element.style.touchAction = "")),
									this.listeners(!1),
									(this.element.rangeTouch = null));
							},
						},
						{
							key: "listeners",
							value: function (e) {
								var t = this,
									i = e ? "addEventListener" : "removeEventListener";
								["touchstart", "touchmove", "touchend"].forEach(function (e) {
									t.element[i](
										e,
										function (e) {
											return t.set(e);
										},
										!1
									);
								});
							},
						},
						{
							key: "get",
							value: function (t) {
								if (!e.enabled || !tr(t)) return null;
								var i,
									n = t.target,
									s = t.changedTouches[0],
									r = parseFloat(n.getAttribute("min")) || 0,
									a = parseFloat(n.getAttribute("max")) || 100,
									o = parseFloat(n.getAttribute("step")) || 1,
									l = n.getBoundingClientRect(),
									c = ((100 / l.width) * (this.config.thumbWidth / 2)) / 100;
								return (
									0 > (i = (100 / l.width) * (s.clientX - l.left))
										? (i = 0)
										: 100 < i && (i = 100),
									50 > i
										? (i -= (100 - 2 * i) * c)
										: 50 < i && (i += 2 * (i - 50) * c),
									r + nr((i / 100) * (a - r), o)
								);
							},
						},
						{
							key: "set",
							value: function (t) {
								e.enabled &&
									tr(t) &&
									!t.target.disabled &&
									(t.preventDefault(),
									(t.target.value = this.get(t)),
									(function (e, t) {
										if (e && t) {
											var i = new Event(t, { bubbles: !0 });
											e.dispatchEvent(i);
										}
									})(t.target, "touchend" === t.type ? "change" : "input"));
							},
						},
					],
					[
						{
							key: "setup",
							value: function (t) {
								var i =
										1 < arguments.length && void 0 !== arguments[1]
											? arguments[1]
											: {},
									n = null;
								if (
									(ir(t) || Qs(t)
										? (n = Array.from(
												document.querySelectorAll(
													Qs(t) ? t : 'input[type="range"]'
												)
										  ))
										: er(t)
										? (n = [t])
										: Zs(t)
										? (n = Array.from(t))
										: Js(t) && (n = t.filter(er)),
									ir(n))
								)
									return null;
								var s = Ds({}, Hs, {}, i);
								if (Qs(t) && s.watch) {
									var r = new MutationObserver(function (i) {
										Array.from(i).forEach(function (i) {
											Array.from(i.addedNodes).forEach(function (i) {
												er(i) && Bs(i, t) && new e(i, s);
											});
										});
									});
									r.observe(document.body, { childList: !0, subtree: !0 });
								}
								return n.map(function (t) {
									return new e(t, i);
								});
							},
						},
						{
							key: "enabled",
							get: function () {
								return "ontouchstart" in document.documentElement;
							},
						},
					]
				),
				e
			);
		})();
		const rr = (e) => (null != e ? e.constructor : null),
			ar = (e, t) => Boolean(e && t && e instanceof t),
			or = (e) => null == e,
			lr = (e) => rr(e) === Object,
			cr = (e) => rr(e) === String,
			ur = (e) => rr(e) === Function,
			hr = (e) => Array.isArray(e),
			dr = (e) => ar(e, NodeList),
			pr = (e) =>
				or(e) ||
				((cr(e) || hr(e) || dr(e)) && !e.length) ||
				(lr(e) && !Object.keys(e).length);
		var mr = or,
			fr = lr,
			gr = (e) => rr(e) === Number && !Number.isNaN(e),
			yr = cr,
			br = (e) => rr(e) === Boolean,
			vr = ur,
			wr = hr,
			kr = dr,
			Tr = (e) =>
				null !== e &&
				"object" == typeof e &&
				1 === e.nodeType &&
				"object" == typeof e.style &&
				"object" == typeof e.ownerDocument,
			Sr = (e) => ar(e, Event),
			Er = (e) => ar(e, KeyboardEvent),
			Ar = (e) => ar(e, TextTrack) || (!or(e) && cr(e.kind)),
			Cr = (e) => ar(e, Promise) && ur(e.then),
			Pr = (e) => {
				if (ar(e, window.URL)) return !0;
				if (!cr(e)) return !1;
				let t = e;
				(e.startsWith("http://") && e.startsWith("https://")) ||
					(t = `http://${e}`);
				try {
					return !pr(new URL(t).hostname);
				} catch (e) {
					return !1;
				}
			},
			xr = pr;
		const Lr = (() => {
			const e = document.createElement("span"),
				t = {
					WebkitTransition: "webkitTransitionEnd",
					MozTransition: "transitionend",
					OTransition: "oTransitionEnd otransitionend",
					transition: "transitionend",
				},
				i = Object.keys(t).find((t) => void 0 !== e.style[t]);
			return !!yr(i) && t[i];
		})();
		function Ir(e, t) {
			setTimeout(() => {
				try {
					(e.hidden = !0), e.offsetHeight, (e.hidden = !1);
				} catch (e) {}
			}, t);
		}
		const _r = {
			isIE: Boolean(window.document.documentMode),
			isEdge: window.navigator.userAgent.includes("Edge"),
			isWebkit:
				"WebkitAppearance" in document.documentElement.style &&
				!/Edge/.test(navigator.userAgent),
			isIPhone: /(iPhone|iPod)/gi.test(navigator.platform),
			isIos:
				("MacIntel" === navigator.platform && navigator.maxTouchPoints > 1) ||
				/(iPad|iPhone|iPod)/gi.test(navigator.platform),
		};
		function Or(e, t) {
			return t.split(".").reduce((e, t) => e && e[t], e);
		}
		function Mr(e = {}, ...t) {
			if (!t.length) return e;
			const i = t.shift();
			return fr(i)
				? (Object.keys(i).forEach((t) => {
						fr(i[t])
							? (Object.keys(e).includes(t) || Object.assign(e, { [t]: {} }),
							  Mr(e[t], i[t]))
							: Object.assign(e, { [t]: i[t] });
				  }),
				  Mr(e, ...t))
				: e;
		}
		function Nr(e, t) {
			const i = e.length ? e : [e];
			Array.from(i)
				.reverse()
				.forEach((e, i) => {
					const n = i > 0 ? t.cloneNode(!0) : t,
						s = e.parentNode,
						r = e.nextSibling;
					n.appendChild(e), r ? s.insertBefore(n, r) : s.appendChild(n);
				});
		}
		function Rr(e, t) {
			Tr(e) &&
				!xr(t) &&
				Object.entries(t)
					.filter(([, e]) => !mr(e))
					.forEach(([t, i]) => e.setAttribute(t, i));
		}
		function jr(e, t, i) {
			const n = document.createElement(e);
			return fr(t) && Rr(n, t), yr(i) && (n.innerText = i), n;
		}
		function $r(e, t, i, n) {
			Tr(t) && t.appendChild(jr(e, i, n));
		}
		function Ur(e) {
			kr(e) || wr(e)
				? Array.from(e).forEach(Ur)
				: Tr(e) && Tr(e.parentNode) && e.parentNode.removeChild(e);
		}
		function qr(e) {
			if (!Tr(e)) return;
			let { length: t } = e.childNodes;
			for (; t > 0; ) e.removeChild(e.lastChild), (t -= 1);
		}
		function Fr(e, t) {
			return Tr(t) && Tr(t.parentNode) && Tr(e)
				? (t.parentNode.replaceChild(e, t), e)
				: null;
		}
		function Dr(e, t) {
			if (!yr(e) || xr(e)) return {};
			const i = {},
				n = Mr({}, t);
			return (
				e.split(",").forEach((e) => {
					const t = e.trim(),
						s = t.replace(".", ""),
						r = t.replace(/[[\]]/g, "").split("="),
						[a] = r,
						o = r.length > 1 ? r[1].replace(/["']/g, "") : "";
					switch (t.charAt(0)) {
						case ".":
							yr(n.class) ? (i.class = `${n.class} ${s}`) : (i.class = s);
							break;
						case "#":
							i.id = t.replace("#", "");
							break;
						case "[":
							i[a] = o;
					}
				}),
				Mr(n, i)
			);
		}
		function Hr(e, t) {
			if (!Tr(e)) return;
			let i = t;
			br(i) || (i = !e.hidden), (e.hidden = i);
		}
		function Br(e, t, i) {
			if (kr(e)) return Array.from(e).map((e) => Br(e, t, i));
			if (Tr(e)) {
				let n = "toggle";
				return (
					void 0 !== i && (n = i ? "add" : "remove"),
					e.classList[n](t),
					e.classList.contains(t)
				);
			}
			return !1;
		}
		function Vr(e, t) {
			return Tr(e) && e.classList.contains(t);
		}
		function Wr(e, t) {
			const { prototype: i } = Element;
			return (
				i.matches ||
				i.webkitMatchesSelector ||
				i.mozMatchesSelector ||
				i.msMatchesSelector ||
				function () {
					return Array.from(document.querySelectorAll(t)).includes(this);
				}
			).call(e, t);
		}
		function zr(e) {
			return this.elements.container.querySelectorAll(e);
		}
		function Kr(e) {
			return this.elements.container.querySelector(e);
		}
		function Yr(e = null, t = !1) {
			Tr(e) &&
				(e.focus({ preventScroll: !0 }),
				t && Br(e, this.config.classNames.tabFocus));
		}
		const Gr = {
				"audio/ogg": "vorbis",
				"audio/wav": "1",
				"video/webm": "vp8, vorbis",
				"video/mp4": "avc1.42E01E, mp4a.40.2",
				"video/ogg": "theora",
			},
			Xr = {
				audio: "canPlayType" in document.createElement("audio"),
				video: "canPlayType" in document.createElement("video"),
				check(e, t, i) {
					const n = _r.isIPhone && i && Xr.playsinline,
						s = Xr[e] || "html5" !== t;
					return {
						api: s,
						ui: s && Xr.rangeInput && ("video" !== e || !_r.isIPhone || n),
					};
				},
				pip: !(
					_r.isIPhone ||
					(!vr(jr("video").webkitSetPresentationMode) &&
						(!document.pictureInPictureEnabled ||
							jr("video").disablePictureInPicture))
				),
				airplay: vr(window.WebKitPlaybackTargetAvailabilityEvent),
				playsinline: "playsInline" in document.createElement("video"),
				mime(e) {
					if (xr(e)) return !1;
					const [t] = e.split("/");
					let i = e;
					if (!this.isHTML5 || t !== this.type) return !1;
					Object.keys(Gr).includes(i) && (i += `; codecs="${Gr[e]}"`);
					try {
						return Boolean(i && this.media.canPlayType(i).replace(/no/, ""));
					} catch (e) {
						return !1;
					}
				},
				textTracks: "textTracks" in document.createElement("video"),
				rangeInput: (() => {
					const e = document.createElement("input");
					return (e.type = "range"), "range" === e.type;
				})(),
				touch: "ontouchstart" in document.documentElement,
				transitions: !1 !== Lr,
				reducedMotion:
					"matchMedia" in window &&
					window.matchMedia("(prefers-reduced-motion)").matches,
			},
			Qr = (() => {
				let e = !1;
				try {
					const t = Object.defineProperty({}, "passive", {
						get: () => ((e = !0), null),
					});
					window.addEventListener("test", null, t),
						window.removeEventListener("test", null, t);
				} catch (e) {}
				return e;
			})();
		function Jr(e, t, i, n = !1, s = !0, r = !1) {
			if (!e || !("addEventListener" in e) || xr(t) || !vr(i)) return;
			const a = t.split(" ");
			let o = r;
			Qr && (o = { passive: s, capture: r }),
				a.forEach((t) => {
					this &&
						this.eventListeners &&
						n &&
						this.eventListeners.push({
							element: e,
							type: t,
							callback: i,
							options: o,
						}),
						e[n ? "addEventListener" : "removeEventListener"](t, i, o);
				});
		}
		function Zr(e, t = "", i, n = !0, s = !1) {
			Jr.call(this, e, t, i, !0, n, s);
		}
		function ea(e, t = "", i, n = !0, s = !1) {
			Jr.call(this, e, t, i, !1, n, s);
		}
		function ta(e, t = "", i, n = !0, s = !1) {
			const r = (...a) => {
				ea(e, t, r, n, s), i.apply(this, a);
			};
			Jr.call(this, e, t, r, !0, n, s);
		}
		function ia(e, t = "", i = !1, n = {}) {
			if (!Tr(e) || xr(t)) return;
			const s = new CustomEvent(t, {
				bubbles: i,
				detail: { ...n, plyr: this },
			});
			e.dispatchEvent(s);
		}
		function na() {
			this &&
				this.eventListeners &&
				(this.eventListeners.forEach((e) => {
					const { element: t, type: i, callback: n, options: s } = e;
					t.removeEventListener(i, n, s);
				}),
				(this.eventListeners = []));
		}
		function sa() {
			return new Promise((e) =>
				this.ready
					? setTimeout(e, 0)
					: Zr.call(this, this.elements.container, "ready", e)
			).then(() => {});
		}
		function ra(e) {
			Cr(e) && e.then(null, () => {});
		}
		function aa(e) {
			return wr(e) ? e.filter((t, i) => e.indexOf(t) === i) : e;
		}
		function oa(e, t) {
			return wr(e) && e.length
				? e.reduce((e, i) => (Math.abs(i - t) < Math.abs(e - t) ? i : e))
				: null;
		}
		function la(e) {
			return !(!window || !window.CSS) && window.CSS.supports(e);
		}
		const ca = [
			[1, 1],
			[4, 3],
			[3, 4],
			[5, 4],
			[4, 5],
			[3, 2],
			[2, 3],
			[16, 10],
			[10, 16],
			[16, 9],
			[9, 16],
			[21, 9],
			[9, 21],
			[32, 9],
			[9, 32],
		].reduce((e, [t, i]) => ({ ...e, [t / i]: [t, i] }), {});
		function ua(e) {
			if (!(wr(e) || (yr(e) && e.includes(":")))) return !1;
			return (wr(e) ? e : e.split(":")).map(Number).every(gr);
		}
		function ha(e) {
			if (!wr(e) || !e.every(gr)) return null;
			const [t, i] = e,
				n = (e, t) => (0 === t ? e : n(t, e % t)),
				s = n(t, i);
			return [t / s, i / s];
		}
		function da(e) {
			const t = (e) => (ua(e) ? e.split(":").map(Number) : null);
			let i = t(e);
			if (
				(null === i && (i = t(this.config.ratio)),
				null === i &&
					!xr(this.embed) &&
					wr(this.embed.ratio) &&
					({ ratio: i } = this.embed),
				null === i && this.isHTML5)
			) {
				const { videoWidth: e, videoHeight: t } = this.media;
				i = [e, t];
			}
			return ha(i);
		}
		function pa(e) {
			if (!this.isVideo) return {};
			const { wrapper: t } = this.elements,
				i = da.call(this, e);
			if (!wr(i)) return {};
			const [n, s] = ha(i),
				r = (100 / n) * s;
			if (
				(la(`aspect-ratio: ${n}/${s}`)
					? (t.style.aspectRatio = `${n}/${s}`)
					: (t.style.paddingBottom = `${r}%`),
				this.isVimeo && !this.config.vimeo.premium && this.supported.ui)
			) {
				const e =
						(100 / this.media.offsetWidth) *
						parseInt(window.getComputedStyle(this.media).paddingBottom, 10),
					i = (e - r) / (e / 50);
				this.fullscreen.active
					? (t.style.paddingBottom = null)
					: (this.media.style.transform = `translateY(-${i}%)`);
			} else this.isHTML5 && t.classList.add(this.config.classNames.videoFixedRatio);
			return { padding: r, ratio: i };
		}
		function ma(e, t, i = 0.05) {
			const n = e / t,
				s = oa(Object.keys(ca), n);
			return Math.abs(s - n) <= i ? ca[s] : [e, t];
		}
		const fa = {
			getSources() {
				if (!this.isHTML5) return [];
				return Array.from(this.media.querySelectorAll("source")).filter((e) => {
					const t = e.getAttribute("type");
					return !!xr(t) || Xr.mime.call(this, t);
				});
			},
			getQualityOptions() {
				return this.config.quality.forced
					? this.config.quality.options
					: fa.getSources
							.call(this)
							.map((e) => Number(e.getAttribute("size")))
							.filter(Boolean);
			},
			setup() {
				if (!this.isHTML5) return;
				const e = this;
				(e.options.speed = e.config.speed.options),
					xr(this.config.ratio) || pa.call(e),
					Object.defineProperty(e.media, "quality", {
						get() {
							const t = fa.getSources
								.call(e)
								.find((t) => t.getAttribute("src") === e.source);
							return t && Number(t.getAttribute("size"));
						},
						set(t) {
							if (e.quality !== t) {
								if (e.config.quality.forced && vr(e.config.quality.onChange))
									e.config.quality.onChange(t);
								else {
									const i = fa.getSources
										.call(e)
										.find((e) => Number(e.getAttribute("size")) === t);
									if (!i) return;
									const {
										currentTime: n,
										paused: s,
										preload: r,
										readyState: a,
										playbackRate: o,
									} = e.media;
									(e.media.src = i.getAttribute("src")),
										("none" !== r || a) &&
											(e.once("loadedmetadata", () => {
												(e.speed = o), (e.currentTime = n), s || ra(e.play());
											}),
											e.media.load());
								}
								ia.call(e, e.media, "qualitychange", !1, { quality: t });
							}
						},
					});
			},
			cancelRequests() {
				this.isHTML5 &&
					(Ur(fa.getSources.call(this)),
					this.media.setAttribute("src", this.config.blankVideo),
					this.media.load(),
					this.debug.log("Cancelled network requests"));
			},
		};
		function ga(e, ...t) {
			return xr(e)
				? e
				: e.toString().replace(/{(\d+)}/g, (e, i) => t[i].toString());
		}
		const ya = (e = "", t = "", i = "") =>
				e.replace(
					new RegExp(
						t.toString().replace(/([.*+?^=!:${}()|[\]/\\])/g, "\\$1"),
						"g"
					),
					i.toString()
				),
			ba = (e = "") =>
				e
					.toString()
					.replace(
						/\w\S*/g,
						(e) => e.charAt(0).toUpperCase() + e.substr(1).toLowerCase()
					);
		function va(e = "") {
			let t = e.toString();
			return (
				(t = (function (e = "") {
					let t = e.toString();
					return (
						(t = ya(t, "-", " ")),
						(t = ya(t, "_", " ")),
						(t = ba(t)),
						ya(t, " ", "")
					);
				})(t)),
				t.charAt(0).toLowerCase() + t.slice(1)
			);
		}
		function wa(e) {
			const t = document.createElement("div");
			return t.appendChild(e), t.innerHTML;
		}
		const ka = {
				pip: "PIP",
				airplay: "AirPlay",
				html5: "HTML5",
				vimeo: "Vimeo",
				youtube: "YouTube",
			},
			Ta = {
				get(e = "", t = {}) {
					if (xr(e) || xr(t)) return "";
					let i = Or(t.i18n, e);
					if (xr(i)) return Object.keys(ka).includes(e) ? ka[e] : "";
					const n = { "{seektime}": t.seekTime, "{title}": t.title };
					return (
						Object.entries(n).forEach(([e, t]) => {
							i = ya(i, e, t);
						}),
						i
					);
				},
			};
		class Sa {
			constructor(e) {
				$s(this, "get", (e) => {
					if (!Sa.supported || !this.enabled) return null;
					const t = window.localStorage.getItem(this.key);
					if (xr(t)) return null;
					const i = JSON.parse(t);
					return yr(e) && e.length ? i[e] : i;
				}),
					$s(this, "set", (e) => {
						if (!Sa.supported || !this.enabled) return;
						if (!fr(e)) return;
						let t = this.get();
						xr(t) && (t = {}),
							Mr(t, e),
							window.localStorage.setItem(this.key, JSON.stringify(t));
					}),
					(this.enabled = e.config.storage.enabled),
					(this.key = e.config.storage.key);
			}
			static get supported() {
				try {
					if (!("localStorage" in window)) return !1;
					const e = "___test";
					return (
						window.localStorage.setItem(e, e),
						window.localStorage.removeItem(e),
						!0
					);
				} catch (e) {
					return !1;
				}
			}
		}
		function Ea(e, t = "text") {
			return new Promise((i, n) => {
				try {
					const n = new XMLHttpRequest();
					if (!("withCredentials" in n)) return;
					n.addEventListener("load", () => {
						if ("text" === t)
							try {
								i(JSON.parse(n.responseText));
							} catch (e) {
								i(n.responseText);
							}
						else i(n.response);
					}),
						n.addEventListener("error", () => {
							throw new Error(n.status);
						}),
						n.open("GET", e, !0),
						(n.responseType = t),
						n.send();
				} catch (e) {
					n(e);
				}
			});
		}
		function Aa(e, t) {
			if (!yr(e)) return;
			const i = yr(t);
			let n = !1;
			const s = () => null !== document.getElementById(t),
				r = (e, t) => {
					(e.innerHTML = t),
						(i && s()) || document.body.insertAdjacentElement("afterbegin", e);
				};
			if (!i || !s()) {
				const s = Sa.supported,
					a = document.createElement("div");
				if ((a.setAttribute("hidden", ""), i && a.setAttribute("id", t), s)) {
					const e = window.localStorage.getItem(`cache-${t}`);
					if (((n = null !== e), n)) {
						const t = JSON.parse(e);
						r(a, t.content);
					}
				}
				Ea(e)
					.then((e) => {
						xr(e) ||
							(s &&
								window.localStorage.setItem(
									`cache-${t}`,
									JSON.stringify({ content: e })
								),
							r(a, e));
					})
					.catch(() => {});
			}
		}
		const Ca = (e) => Math.trunc((e / 60 / 60) % 60, 10);
		function Pa(e = 0, t = !1, i = !1) {
			if (!gr(e)) return Pa(void 0, t, i);
			const n = (e) => `0${e}`.slice(-2);
			let s = Ca(e);
			const r = ((a = e), Math.trunc((a / 60) % 60, 10));
			var a;
			const o = ((e) => Math.trunc(e % 60, 10))(e);
			return (
				(s = t || s > 0 ? `${s}:` : ""),
				`${i && e > 0 ? "-" : ""}${s}${n(r)}:${n(o)}`
			);
		}
		const xa = {
			getIconUrl() {
				const e =
					new URL(this.config.iconUrl, window.location).host !==
						window.location.host ||
					(_r.isIE && !window.svg4everybody);
				return { url: this.config.iconUrl, cors: e };
			},
			findElements() {
				try {
					return (
						(this.elements.controls = Kr.call(
							this,
							this.config.selectors.controls.wrapper
						)),
						(this.elements.buttons = {
							play: zr.call(this, this.config.selectors.buttons.play),
							pause: Kr.call(this, this.config.selectors.buttons.pause),
							restart: Kr.call(this, this.config.selectors.buttons.restart),
							rewind: Kr.call(this, this.config.selectors.buttons.rewind),
							fastForward: Kr.call(
								this,
								this.config.selectors.buttons.fastForward
							),
							mute: Kr.call(this, this.config.selectors.buttons.mute),
							pip: Kr.call(this, this.config.selectors.buttons.pip),
							airplay: Kr.call(this, this.config.selectors.buttons.airplay),
							settings: Kr.call(this, this.config.selectors.buttons.settings),
							captions: Kr.call(this, this.config.selectors.buttons.captions),
							fullscreen: Kr.call(
								this,
								this.config.selectors.buttons.fullscreen
							),
						}),
						(this.elements.progress = Kr.call(
							this,
							this.config.selectors.progress
						)),
						(this.elements.inputs = {
							seek: Kr.call(this, this.config.selectors.inputs.seek),
							volume: Kr.call(this, this.config.selectors.inputs.volume),
						}),
						(this.elements.display = {
							buffer: Kr.call(this, this.config.selectors.display.buffer),
							currentTime: Kr.call(
								this,
								this.config.selectors.display.currentTime
							),
							duration: Kr.call(this, this.config.selectors.display.duration),
						}),
						Tr(this.elements.progress) &&
							(this.elements.display.seekTooltip =
								this.elements.progress.querySelector(
									`.${this.config.classNames.tooltip}`
								)),
						!0
					);
				} catch (e) {
					return (
						this.debug.warn(
							"It looks like there is a problem with your custom controls HTML",
							e
						),
						this.toggleNativeControls(!0),
						!1
					);
				}
			},
			createIcon(e, t) {
				const i = "http://www.w3.org/2000/svg",
					n = xa.getIconUrl.call(this),
					s = `${n.cors ? "" : n.url}#${this.config.iconPrefix}`,
					r = document.createElementNS(i, "svg");
				Rr(r, Mr(t, { "aria-hidden": "true", focusable: "false" }));
				const a = document.createElementNS(i, "use"),
					o = `${s}-${e}`;
				return (
					"href" in a &&
						a.setAttributeNS("http://www.w3.org/1999/xlink", "href", o),
					a.setAttributeNS("http://www.w3.org/1999/xlink", "xlink:href", o),
					r.appendChild(a),
					r
				);
			},
			createLabel(e, t = {}) {
				const i = Ta.get(e, this.config);
				return jr(
					"span",
					{
						...t,
						class: [t.class, this.config.classNames.hidden]
							.filter(Boolean)
							.join(" "),
					},
					i
				);
			},
			createBadge(e) {
				if (xr(e)) return null;
				const t = jr("span", { class: this.config.classNames.menu.value });
				return (
					t.appendChild(
						jr("span", { class: this.config.classNames.menu.badge }, e)
					),
					t
				);
			},
			createButton(e, t) {
				const i = Mr({}, t);
				let n = va(e);
				const s = {
					element: "button",
					toggle: !1,
					label: null,
					icon: null,
					labelPressed: null,
					iconPressed: null,
				};
				switch (
					(["element", "icon", "label"].forEach((e) => {
						Object.keys(i).includes(e) && ((s[e] = i[e]), delete i[e]);
					}),
					"button" !== s.element ||
						Object.keys(i).includes("type") ||
						(i.type = "button"),
					Object.keys(i).includes("class")
						? i.class
								.split(" ")
								.some((e) => e === this.config.classNames.control) ||
						  Mr(i, { class: `${i.class} ${this.config.classNames.control}` })
						: (i.class = this.config.classNames.control),
					e)
				) {
					case "play":
						(s.toggle = !0),
							(s.label = "play"),
							(s.labelPressed = "pause"),
							(s.icon = "play"),
							(s.iconPressed = "pause");
						break;
					case "mute":
						(s.toggle = !0),
							(s.label = "mute"),
							(s.labelPressed = "unmute"),
							(s.icon = "volume"),
							(s.iconPressed = "muted");
						break;
					case "captions":
						(s.toggle = !0),
							(s.label = "enableCaptions"),
							(s.labelPressed = "disableCaptions"),
							(s.icon = "captions-off"),
							(s.iconPressed = "captions-on");
						break;
					case "fullscreen":
						(s.toggle = !0),
							(s.label = "enterFullscreen"),
							(s.labelPressed = "exitFullscreen"),
							(s.icon = "enter-fullscreen"),
							(s.iconPressed = "exit-fullscreen");
						break;
					case "play-large":
						(i.class += ` ${this.config.classNames.control}--overlaid`),
							(n = "play"),
							(s.label = "play"),
							(s.icon = "play");
						break;
					default:
						xr(s.label) && (s.label = n), xr(s.icon) && (s.icon = e);
				}
				const r = jr(s.element);
				return (
					s.toggle
						? (r.appendChild(
								xa.createIcon.call(this, s.iconPressed, {
									class: "icon--pressed",
								})
						  ),
						  r.appendChild(
								xa.createIcon.call(this, s.icon, { class: "icon--not-pressed" })
						  ),
						  r.appendChild(
								xa.createLabel.call(this, s.labelPressed, {
									class: "label--pressed",
								})
						  ),
						  r.appendChild(
								xa.createLabel.call(this, s.label, {
									class: "label--not-pressed",
								})
						  ))
						: (r.appendChild(xa.createIcon.call(this, s.icon)),
						  r.appendChild(xa.createLabel.call(this, s.label))),
					Mr(i, Dr(this.config.selectors.buttons[n], i)),
					Rr(r, i),
					"play" === n
						? (wr(this.elements.buttons[n]) || (this.elements.buttons[n] = []),
						  this.elements.buttons[n].push(r))
						: (this.elements.buttons[n] = r),
					r
				);
			},
			createRange(e, t) {
				const i = jr(
					"input",
					Mr(
						Dr(this.config.selectors.inputs[e]),
						{
							type: "range",
							min: 0,
							max: 100,
							step: 0.01,
							value: 0,
							autocomplete: "off",
							role: "slider",
							"aria-label": Ta.get(e, this.config),
							"aria-valuemin": 0,
							"aria-valuemax": 100,
							"aria-valuenow": 0,
						},
						t
					)
				);
				return (
					(this.elements.inputs[e] = i),
					xa.updateRangeFill.call(this, i),
					sr.setup(i),
					i
				);
			},
			createProgress(e, t) {
				const i = jr(
					"progress",
					Mr(
						Dr(this.config.selectors.display[e]),
						{
							min: 0,
							max: 100,
							value: 0,
							role: "progressbar",
							"aria-hidden": !0,
						},
						t
					)
				);
				if ("volume" !== e) {
					i.appendChild(jr("span", null, "0"));
					const t = { played: "played", buffer: "buffered" }[e],
						n = t ? Ta.get(t, this.config) : "";
					i.innerText = `% ${n.toLowerCase()}`;
				}
				return (this.elements.display[e] = i), i;
			},
			createTime(e, t) {
				const i = Dr(this.config.selectors.display[e], t),
					n = jr(
						"div",
						Mr(i, {
							class: `${i.class ? i.class : ""} ${
								this.config.classNames.display.time
							} `.trim(),
							"aria-label": Ta.get(e, this.config),
						}),
						"00:00"
					);
				return (this.elements.display[e] = n), n;
			},
			bindMenuItemShortcuts(e, t) {
				Zr.call(
					this,
					e,
					"keydown keyup",
					(i) => {
						if (![32, 38, 39, 40].includes(i.which)) return;
						if ((i.preventDefault(), i.stopPropagation(), "keydown" === i.type))
							return;
						const n = Wr(e, '[role="menuitemradio"]');
						if (!n && [32, 39].includes(i.which))
							xa.showMenuPanel.call(this, t, !0);
						else {
							let t;
							32 !== i.which &&
								(40 === i.which || (n && 39 === i.which)
									? ((t = e.nextElementSibling),
									  Tr(t) || (t = e.parentNode.firstElementChild))
									: ((t = e.previousElementSibling),
									  Tr(t) || (t = e.parentNode.lastElementChild)),
								Yr.call(this, t, !0));
						}
					},
					!1
				),
					Zr.call(this, e, "keyup", (e) => {
						13 === e.which && xa.focusFirstMenuItem.call(this, null, !0);
					});
			},
			createMenuItem({
				value: e,
				list: t,
				type: i,
				title: n,
				badge: s = null,
				checked: r = !1,
			}) {
				const a = Dr(this.config.selectors.inputs[i]),
					o = jr(
						"button",
						Mr(a, {
							type: "button",
							role: "menuitemradio",
							class: `${this.config.classNames.control} ${
								a.class ? a.class : ""
							}`.trim(),
							"aria-checked": r,
							value: e,
						})
					),
					l = jr("span");
				(l.innerHTML = n),
					Tr(s) && l.appendChild(s),
					o.appendChild(l),
					Object.defineProperty(o, "checked", {
						enumerable: !0,
						get: () => "true" === o.getAttribute("aria-checked"),
						set(e) {
							e &&
								Array.from(o.parentNode.children)
									.filter((e) => Wr(e, '[role="menuitemradio"]'))
									.forEach((e) => e.setAttribute("aria-checked", "false")),
								o.setAttribute("aria-checked", e ? "true" : "false");
						},
					}),
					this.listeners.bind(
						o,
						"click keyup",
						(t) => {
							if (!Er(t) || 32 === t.which) {
								switch (
									(t.preventDefault(), t.stopPropagation(), (o.checked = !0), i)
								) {
									case "language":
										this.currentTrack = Number(e);
										break;
									case "quality":
										this.quality = e;
										break;
									case "speed":
										this.speed = parseFloat(e);
								}
								xa.showMenuPanel.call(this, "home", Er(t));
							}
						},
						i,
						!1
					),
					xa.bindMenuItemShortcuts.call(this, o, i),
					t.appendChild(o);
			},
			formatTime(e = 0, t = !1) {
				if (!gr(e)) return e;
				return Pa(e, Ca(this.duration) > 0, t);
			},
			updateTimeDisplay(e = null, t = 0, i = !1) {
				Tr(e) && gr(t) && (e.innerText = xa.formatTime(t, i));
			},
			updateVolume() {
				this.supported.ui &&
					(Tr(this.elements.inputs.volume) &&
						xa.setRange.call(
							this,
							this.elements.inputs.volume,
							this.muted ? 0 : this.volume
						),
					Tr(this.elements.buttons.mute) &&
						(this.elements.buttons.mute.pressed =
							this.muted || 0 === this.volume));
			},
			setRange(e, t = 0) {
				Tr(e) && ((e.value = t), xa.updateRangeFill.call(this, e));
			},
			updateProgress(e) {
				if (!this.supported.ui || !Sr(e)) return;
				let t = 0;
				const i = (e, t) => {
					const i = gr(t) ? t : 0,
						n = Tr(e) ? e : this.elements.display.buffer;
					if (Tr(n)) {
						n.value = i;
						const e = n.getElementsByTagName("span")[0];
						Tr(e) && (e.childNodes[0].nodeValue = i);
					}
				};
				if (e)
					switch (e.type) {
						case "timeupdate":
						case "seeking":
						case "seeked":
							(t = (function (e, t) {
								return 0 === e || 0 === t || Number.isNaN(e) || Number.isNaN(t)
									? 0
									: ((e / t) * 100).toFixed(2);
							})(this.currentTime, this.duration)),
								"timeupdate" === e.type &&
									xa.setRange.call(this, this.elements.inputs.seek, t);
							break;
						case "playing":
						case "progress":
							i(this.elements.display.buffer, 100 * this.buffered);
					}
			},
			updateRangeFill(e) {
				const t = Sr(e) ? e.target : e;
				if (Tr(t) && "range" === t.getAttribute("type")) {
					if (Wr(t, this.config.selectors.inputs.seek)) {
						t.setAttribute("aria-valuenow", this.currentTime);
						const e = xa.formatTime(this.currentTime),
							i = xa.formatTime(this.duration),
							n = Ta.get("seekLabel", this.config);
						t.setAttribute(
							"aria-valuetext",
							n.replace("{currentTime}", e).replace("{duration}", i)
						);
					} else if (Wr(t, this.config.selectors.inputs.volume)) {
						const e = 100 * t.value;
						t.setAttribute("aria-valuenow", e),
							t.setAttribute("aria-valuetext", `${e.toFixed(1)}%`);
					} else t.setAttribute("aria-valuenow", t.value);
					_r.isWebkit &&
						t.style.setProperty("--value", (t.value / t.max) * 100 + "%");
				}
			},
			updateSeekTooltip(e) {
				if (
					!this.config.tooltips.seek ||
					!Tr(this.elements.inputs.seek) ||
					!Tr(this.elements.display.seekTooltip) ||
					0 === this.duration
				)
					return;
				const t = `${this.config.classNames.tooltip}--visible`,
					i = (e) => Br(this.elements.display.seekTooltip, t, e);
				if (this.touch) return void i(!1);
				let n = 0;
				const s = this.elements.progress.getBoundingClientRect();
				if (Sr(e)) n = (100 / s.width) * (e.pageX - s.left);
				else {
					if (!Vr(this.elements.display.seekTooltip, t)) return;
					n = parseFloat(this.elements.display.seekTooltip.style.left, 10);
				}
				n < 0 ? (n = 0) : n > 100 && (n = 100),
					xa.updateTimeDisplay.call(
						this,
						this.elements.display.seekTooltip,
						(this.duration / 100) * n
					),
					(this.elements.display.seekTooltip.style.left = `${n}%`),
					Sr(e) &&
						["mouseenter", "mouseleave"].includes(e.type) &&
						i("mouseenter" === e.type);
			},
			timeUpdate(e) {
				const t = !Tr(this.elements.display.duration) && this.config.invertTime;
				xa.updateTimeDisplay.call(
					this,
					this.elements.display.currentTime,
					t ? this.duration - this.currentTime : this.currentTime,
					t
				),
					(e && "timeupdate" === e.type && this.media.seeking) ||
						xa.updateProgress.call(this, e);
			},
			durationUpdate() {
				if (!this.supported.ui || (!this.config.invertTime && this.currentTime))
					return;
				if (this.duration >= 2 ** 32)
					return (
						Hr(this.elements.display.currentTime, !0),
						void Hr(this.elements.progress, !0)
					);
				Tr(this.elements.inputs.seek) &&
					this.elements.inputs.seek.setAttribute(
						"aria-valuemax",
						this.duration
					);
				const e = Tr(this.elements.display.duration);
				!e &&
					this.config.displayDuration &&
					this.paused &&
					xa.updateTimeDisplay.call(
						this,
						this.elements.display.currentTime,
						this.duration
					),
					e &&
						xa.updateTimeDisplay.call(
							this,
							this.elements.display.duration,
							this.duration
						),
					xa.updateSeekTooltip.call(this);
			},
			toggleMenuButton(e, t) {
				Hr(this.elements.settings.buttons[e], !t);
			},
			updateSetting(e, t, i) {
				const n = this.elements.settings.panels[e];
				let s = null,
					r = t;
				if ("captions" === e) s = this.currentTrack;
				else {
					if (
						((s = xr(i) ? this[e] : i),
						xr(s) && (s = this.config[e].default),
						!xr(this.options[e]) && !this.options[e].includes(s))
					)
						return void this.debug.warn(`Unsupported value of '${s}' for ${e}`);
					if (!this.config[e].options.includes(s))
						return void this.debug.warn(`Disabled value of '${s}' for ${e}`);
				}
				if ((Tr(r) || (r = n && n.querySelector('[role="menu"]')), !Tr(r)))
					return;
				this.elements.settings.buttons[e].querySelector(
					`.${this.config.classNames.menu.value}`
				).innerHTML = xa.getLabel.call(this, e, s);
				const a = r && r.querySelector(`[value="${s}"]`);
				Tr(a) && (a.checked = !0);
			},
			getLabel(e, t) {
				switch (e) {
					case "speed":
						return 1 === t ? Ta.get("normal", this.config) : `${t}&times;`;
					case "quality":
						if (gr(t)) {
							const e = Ta.get(`qualityLabel.${t}`, this.config);
							return e.length ? e : `${t}p`;
						}
						return ba(t);
					case "captions":
						return _a.getLabel.call(this);
					default:
						return null;
				}
			},
			setQualityMenu(e) {
				if (!Tr(this.elements.settings.panels.quality)) return;
				const t = "quality",
					i =
						this.elements.settings.panels.quality.querySelector(
							'[role="menu"]'
						);
				wr(e) &&
					(this.options.quality = aa(e).filter((e) =>
						this.config.quality.options.includes(e)
					));
				const n = !xr(this.options.quality) && this.options.quality.length > 1;
				if (
					(xa.toggleMenuButton.call(this, t, n),
					qr(i),
					xa.checkMenu.call(this),
					!n)
				)
					return;
				const s = (e) => {
					const t = Ta.get(`qualityBadge.${e}`, this.config);
					return t.length ? xa.createBadge.call(this, t) : null;
				};
				this.options.quality
					.sort((e, t) => {
						const i = this.config.quality.options;
						return i.indexOf(e) > i.indexOf(t) ? 1 : -1;
					})
					.forEach((e) => {
						xa.createMenuItem.call(this, {
							value: e,
							list: i,
							type: t,
							title: xa.getLabel.call(this, "quality", e),
							badge: s(e),
						});
					}),
					xa.updateSetting.call(this, t, i);
			},
			setCaptionsMenu() {
				if (!Tr(this.elements.settings.panels.captions)) return;
				const e = "captions",
					t =
						this.elements.settings.panels.captions.querySelector(
							'[role="menu"]'
						),
					i = _a.getTracks.call(this),
					n = Boolean(i.length);
				if (
					(xa.toggleMenuButton.call(this, e, n),
					qr(t),
					xa.checkMenu.call(this),
					!n)
				)
					return;
				const s = i.map((e, i) => ({
					value: i,
					checked: this.captions.toggled && this.currentTrack === i,
					title: _a.getLabel.call(this, e),
					badge:
						e.language && xa.createBadge.call(this, e.language.toUpperCase()),
					list: t,
					type: "language",
				}));
				s.unshift({
					value: -1,
					checked: !this.captions.toggled,
					title: Ta.get("disabled", this.config),
					list: t,
					type: "language",
				}),
					s.forEach(xa.createMenuItem.bind(this)),
					xa.updateSetting.call(this, e, t);
			},
			setSpeedMenu() {
				if (!Tr(this.elements.settings.panels.speed)) return;
				const e = "speed",
					t =
						this.elements.settings.panels.speed.querySelector('[role="menu"]');
				this.options.speed = this.options.speed.filter(
					(e) => e >= this.minimumSpeed && e <= this.maximumSpeed
				);
				const i = !xr(this.options.speed) && this.options.speed.length > 1;
				xa.toggleMenuButton.call(this, e, i),
					qr(t),
					xa.checkMenu.call(this),
					i &&
						(this.options.speed.forEach((i) => {
							xa.createMenuItem.call(this, {
								value: i,
								list: t,
								type: e,
								title: xa.getLabel.call(this, "speed", i),
							});
						}),
						xa.updateSetting.call(this, e, t));
			},
			checkMenu() {
				const { buttons: e } = this.elements.settings,
					t = !xr(e) && Object.values(e).some((e) => !e.hidden);
				Hr(this.elements.settings.menu, !t);
			},
			focusFirstMenuItem(e, t = !1) {
				if (this.elements.settings.popup.hidden) return;
				let i = e;
				Tr(i) ||
					(i = Object.values(this.elements.settings.panels).find(
						(e) => !e.hidden
					));
				const n = i.querySelector('[role^="menuitem"]');
				Yr.call(this, n, t);
			},
			toggleMenu(e) {
				const { popup: t } = this.elements.settings,
					i = this.elements.buttons.settings;
				if (!Tr(t) || !Tr(i)) return;
				const { hidden: n } = t;
				let s = n;
				if (br(e)) s = e;
				else if (Er(e) && 27 === e.which) s = !1;
				else if (Sr(e)) {
					const n = vr(e.composedPath) ? e.composedPath()[0] : e.target,
						r = t.contains(n);
					if (r || (!r && e.target !== i && s)) return;
				}
				i.setAttribute("aria-expanded", s),
					Hr(t, !s),
					Br(this.elements.container, this.config.classNames.menu.open, s),
					s && Er(e)
						? xa.focusFirstMenuItem.call(this, null, !0)
						: s || n || Yr.call(this, i, Er(e));
			},
			getMenuSize(e) {
				const t = e.cloneNode(!0);
				(t.style.position = "absolute"),
					(t.style.opacity = 0),
					t.removeAttribute("hidden"),
					e.parentNode.appendChild(t);
				const i = t.scrollWidth,
					n = t.scrollHeight;
				return Ur(t), { width: i, height: n };
			},
			showMenuPanel(e = "", t = !1) {
				const i = this.elements.container.querySelector(
					`#plyr-settings-${this.id}-${e}`
				);
				if (!Tr(i)) return;
				const n = i.parentNode,
					s = Array.from(n.children).find((e) => !e.hidden);
				if (Xr.transitions && !Xr.reducedMotion) {
					(n.style.width = `${s.scrollWidth}px`),
						(n.style.height = `${s.scrollHeight}px`);
					const e = xa.getMenuSize.call(this, i),
						t = (e) => {
							e.target === n &&
								["width", "height"].includes(e.propertyName) &&
								((n.style.width = ""),
								(n.style.height = ""),
								ea.call(this, n, Lr, t));
						};
					Zr.call(this, n, Lr, t),
						(n.style.width = `${e.width}px`),
						(n.style.height = `${e.height}px`);
				}
				Hr(s, !0), Hr(i, !1), xa.focusFirstMenuItem.call(this, i, t);
			},
			setDownloadUrl() {
				const e = this.elements.buttons.download;
				Tr(e) && e.setAttribute("href", this.download);
			},
			create(e) {
				const {
					bindMenuItemShortcuts: t,
					createButton: i,
					createProgress: n,
					createRange: s,
					createTime: r,
					setQualityMenu: a,
					setSpeedMenu: o,
					showMenuPanel: l,
				} = xa;
				(this.elements.controls = null),
					wr(this.config.controls) &&
						this.config.controls.includes("play-large") &&
						this.elements.container.appendChild(i.call(this, "play-large"));
				const c = jr("div", Dr(this.config.selectors.controls.wrapper));
				this.elements.controls = c;
				const u = { class: "plyr__controls__item" };
				return (
					aa(wr(this.config.controls) ? this.config.controls : []).forEach(
						(a) => {
							if (
								("restart" === a && c.appendChild(i.call(this, "restart", u)),
								"rewind" === a && c.appendChild(i.call(this, "rewind", u)),
								"play" === a && c.appendChild(i.call(this, "play", u)),
								"fast-forward" === a &&
									c.appendChild(i.call(this, "fast-forward", u)),
								"progress" === a)
							) {
								const t = jr("div", {
										class: `${u.class} plyr__progress__container`,
									}),
									i = jr("div", Dr(this.config.selectors.progress));
								if (
									(i.appendChild(
										s.call(this, "seek", { id: `plyr-seek-${e.id}` })
									),
									i.appendChild(n.call(this, "buffer")),
									this.config.tooltips.seek)
								) {
									const e = jr(
										"span",
										{ class: this.config.classNames.tooltip },
										"00:00"
									);
									i.appendChild(e), (this.elements.display.seekTooltip = e);
								}
								(this.elements.progress = i),
									t.appendChild(this.elements.progress),
									c.appendChild(t);
							}
							if (
								("current-time" === a &&
									c.appendChild(r.call(this, "currentTime", u)),
								"duration" === a && c.appendChild(r.call(this, "duration", u)),
								"mute" === a || "volume" === a)
							) {
								let { volume: t } = this.elements;
								if (
									((Tr(t) && c.contains(t)) ||
										((t = jr(
											"div",
											Mr({}, u, { class: `${u.class} plyr__volume`.trim() })
										)),
										(this.elements.volume = t),
										c.appendChild(t)),
									"mute" === a && t.appendChild(i.call(this, "mute")),
									"volume" === a && !_r.isIos)
								) {
									const i = { max: 1, step: 0.05, value: this.config.volume };
									t.appendChild(
										s.call(this, "volume", Mr(i, { id: `plyr-volume-${e.id}` }))
									);
								}
							}
							if (
								("captions" === a && c.appendChild(i.call(this, "captions", u)),
								"settings" === a && !xr(this.config.settings))
							) {
								const n = jr(
									"div",
									Mr({}, u, {
										class: `${u.class} plyr__menu`.trim(),
										hidden: "",
									})
								);
								n.appendChild(
									i.call(this, "settings", {
										"aria-haspopup": !0,
										"aria-controls": `plyr-settings-${e.id}`,
										"aria-expanded": !1,
									})
								);
								const s = jr("div", {
										class: "plyr__menu__container",
										id: `plyr-settings-${e.id}`,
										hidden: "",
									}),
									r = jr("div"),
									a = jr("div", { id: `plyr-settings-${e.id}-home` }),
									o = jr("div", { role: "menu" });
								a.appendChild(o),
									r.appendChild(a),
									(this.elements.settings.panels.home = a),
									this.config.settings.forEach((i) => {
										const n = jr(
											"button",
											Mr(Dr(this.config.selectors.buttons.settings), {
												type: "button",
												class: `${this.config.classNames.control} ${this.config.classNames.control}--forward`,
												role: "menuitem",
												"aria-haspopup": !0,
												hidden: "",
											})
										);
										t.call(this, n, i),
											Zr.call(this, n, "click", () => {
												l.call(this, i, !1);
											});
										const s = jr("span", null, Ta.get(i, this.config)),
											a = jr("span", {
												class: this.config.classNames.menu.value,
											});
										(a.innerHTML = e[i]),
											s.appendChild(a),
											n.appendChild(s),
											o.appendChild(n);
										const c = jr("div", {
												id: `plyr-settings-${e.id}-${i}`,
												hidden: "",
											}),
											u = jr("button", {
												type: "button",
												class: `${this.config.classNames.control} ${this.config.classNames.control}--back`,
											});
										u.appendChild(
											jr("span", { "aria-hidden": !0 }, Ta.get(i, this.config))
										),
											u.appendChild(
												jr(
													"span",
													{ class: this.config.classNames.hidden },
													Ta.get("menuBack", this.config)
												)
											),
											Zr.call(
												this,
												c,
												"keydown",
												(e) => {
													37 === e.which &&
														(e.preventDefault(),
														e.stopPropagation(),
														l.call(this, "home", !0));
												},
												!1
											),
											Zr.call(this, u, "click", () => {
												l.call(this, "home", !1);
											}),
											c.appendChild(u),
											c.appendChild(jr("div", { role: "menu" })),
											r.appendChild(c),
											(this.elements.settings.buttons[i] = n),
											(this.elements.settings.panels[i] = c);
									}),
									s.appendChild(r),
									n.appendChild(s),
									c.appendChild(n),
									(this.elements.settings.popup = s),
									(this.elements.settings.menu = n);
							}
							if (
								("pip" === a && Xr.pip && c.appendChild(i.call(this, "pip", u)),
								"airplay" === a &&
									Xr.airplay &&
									c.appendChild(i.call(this, "airplay", u)),
								"download" === a)
							) {
								const e = Mr({}, u, {
									element: "a",
									href: this.download,
									target: "_blank",
								});
								this.isHTML5 && (e.download = "");
								const { download: t } = this.config.urls;
								!Pr(t) &&
									this.isEmbed &&
									Mr(e, {
										icon: `logo-${this.provider}`,
										label: this.provider,
									}),
									c.appendChild(i.call(this, "download", e));
							}
							"fullscreen" === a &&
								c.appendChild(i.call(this, "fullscreen", u));
						}
					),
					this.isHTML5 && a.call(this, fa.getQualityOptions.call(this)),
					o.call(this),
					c
				);
			},
			inject() {
				if (this.config.loadSprite) {
					const e = xa.getIconUrl.call(this);
					e.cors && Aa(e.url, "sprite-plyr");
				}
				this.id = Math.floor(1e4 * Math.random());
				let e = null;
				this.elements.controls = null;
				const t = {
					id: this.id,
					seektime: this.config.seekTime,
					title: this.config.title,
				};
				let i = !0;
				vr(this.config.controls) &&
					(this.config.controls = this.config.controls.call(this, t)),
					this.config.controls || (this.config.controls = []),
					Tr(this.config.controls) || yr(this.config.controls)
						? (e = this.config.controls)
						: ((e = xa.create.call(this, {
								id: this.id,
								seektime: this.config.seekTime,
								speed: this.speed,
								quality: this.quality,
								captions: _a.getLabel.call(this),
						  })),
						  (i = !1));
				let n;
				i &&
					yr(this.config.controls) &&
					(e = ((e) => {
						let i = e;
						return (
							Object.entries(t).forEach(([e, t]) => {
								i = ya(i, `{${e}}`, t);
							}),
							i
						);
					})(e)),
					yr(this.config.selectors.controls.container) &&
						(n = document.querySelector(
							this.config.selectors.controls.container
						)),
					Tr(n) || (n = this.elements.container);
				if (
					(n[Tr(e) ? "insertAdjacentElement" : "insertAdjacentHTML"](
						"afterbegin",
						e
					),
					Tr(this.elements.controls) || xa.findElements.call(this),
					!xr(this.elements.buttons))
				) {
					const e = (e) => {
						const t = this.config.classNames.controlPressed;
						Object.defineProperty(e, "pressed", {
							enumerable: !0,
							get: () => Vr(e, t),
							set(i = !1) {
								Br(e, t, i);
							},
						});
					};
					Object.values(this.elements.buttons)
						.filter(Boolean)
						.forEach((t) => {
							wr(t) || kr(t) ? Array.from(t).filter(Boolean).forEach(e) : e(t);
						});
				}
				if ((_r.isEdge && Ir(n), this.config.tooltips.controls)) {
					const { classNames: e, selectors: t } = this.config,
						i = `${t.controls.wrapper} ${t.labels} .${e.hidden}`,
						n = zr.call(this, i);
					Array.from(n).forEach((e) => {
						Br(e, this.config.classNames.hidden, !1),
							Br(e, this.config.classNames.tooltip, !0);
					});
				}
			},
		};
		function La(e, t = !0) {
			let i = e;
			if (t) {
				const e = document.createElement("a");
				(e.href = i), (i = e.href);
			}
			try {
				return new URL(i);
			} catch (e) {
				return null;
			}
		}
		function Ia(e) {
			const t = new URLSearchParams();
			return (
				fr(e) &&
					Object.entries(e).forEach(([e, i]) => {
						t.set(e, i);
					}),
				t
			);
		}
		const _a = {
				setup() {
					if (!this.supported.ui) return;
					if (
						!this.isVideo ||
						this.isYouTube ||
						(this.isHTML5 && !Xr.textTracks)
					)
						return void (
							wr(this.config.controls) &&
							this.config.controls.includes("settings") &&
							this.config.settings.includes("captions") &&
							xa.setCaptionsMenu.call(this)
						);
					var e, t;
					if (
						(Tr(this.elements.captions) ||
							((this.elements.captions = jr(
								"div",
								Dr(this.config.selectors.captions)
							)),
							(e = this.elements.captions),
							(t = this.elements.wrapper),
							Tr(e) && Tr(t) && t.parentNode.insertBefore(e, t.nextSibling)),
						_r.isIE && window.URL)
					) {
						const e = this.media.querySelectorAll("track");
						Array.from(e).forEach((e) => {
							const t = e.getAttribute("src"),
								i = La(t);
							null !== i &&
								i.hostname !== window.location.href.hostname &&
								["http:", "https:"].includes(i.protocol) &&
								Ea(t, "blob")
									.then((t) => {
										e.setAttribute("src", window.URL.createObjectURL(t));
									})
									.catch(() => {
										Ur(e);
									});
						});
					}
					const i = aa(
						(
							navigator.languages || [
								navigator.language || navigator.userLanguage || "en",
							]
						).map((e) => e.split("-")[0])
					);
					let n = (
						this.storage.get("language") ||
						this.config.captions.language ||
						"auto"
					).toLowerCase();
					"auto" === n && ([n] = i);
					let s = this.storage.get("captions");
					if (
						(br(s) || ({ active: s } = this.config.captions),
						Object.assign(this.captions, {
							toggled: !1,
							active: s,
							language: n,
							languages: i,
						}),
						this.isHTML5)
					) {
						const e = this.config.captions.update
							? "addtrack removetrack"
							: "removetrack";
						Zr.call(this, this.media.textTracks, e, _a.update.bind(this));
					}
					setTimeout(_a.update.bind(this), 0);
				},
				update() {
					const e = _a.getTracks.call(this, !0),
						{
							active: t,
							language: i,
							meta: n,
							currentTrackNode: s,
						} = this.captions,
						r = Boolean(e.find((e) => e.language === i));
					this.isHTML5 &&
						this.isVideo &&
						e
							.filter((e) => !n.get(e))
							.forEach((e) => {
								this.debug.log("Track added", e),
									n.set(e, { default: "showing" === e.mode }),
									"showing" === e.mode && (e.mode = "hidden"),
									Zr.call(this, e, "cuechange", () => _a.updateCues.call(this));
							}),
						((r && this.language !== i) || !e.includes(s)) &&
							(_a.setLanguage.call(this, i), _a.toggle.call(this, t && r)),
						Br(
							this.elements.container,
							this.config.classNames.captions.enabled,
							!xr(e)
						),
						wr(this.config.controls) &&
							this.config.controls.includes("settings") &&
							this.config.settings.includes("captions") &&
							xa.setCaptionsMenu.call(this);
				},
				toggle(e, t = !0) {
					if (!this.supported.ui) return;
					const { toggled: i } = this.captions,
						n = this.config.classNames.captions.active,
						s = mr(e) ? !i : e;
					if (s !== i) {
						if (
							(t ||
								((this.captions.active = s), this.storage.set({ captions: s })),
							!this.language && s && !t)
						) {
							const e = _a.getTracks.call(this),
								t = _a.findTrack.call(
									this,
									[this.captions.language, ...this.captions.languages],
									!0
								);
							return (
								(this.captions.language = t.language),
								void _a.set.call(this, e.indexOf(t))
							);
						}
						this.elements.buttons.captions &&
							(this.elements.buttons.captions.pressed = s),
							Br(this.elements.container, n, s),
							(this.captions.toggled = s),
							xa.updateSetting.call(this, "captions"),
							ia.call(
								this,
								this.media,
								s ? "captionsenabled" : "captionsdisabled"
							);
					}
					setTimeout(() => {
						s &&
							this.captions.toggled &&
							(this.captions.currentTrackNode.mode = "hidden");
					});
				},
				set(e, t = !0) {
					const i = _a.getTracks.call(this);
					if (-1 !== e)
						if (gr(e))
							if (e in i) {
								if (this.captions.currentTrack !== e) {
									this.captions.currentTrack = e;
									const n = i[e],
										{ language: s } = n || {};
									(this.captions.currentTrackNode = n),
										xa.updateSetting.call(this, "captions"),
										t ||
											((this.captions.language = s),
											this.storage.set({ language: s })),
										this.isVimeo && this.embed.enableTextTrack(s),
										ia.call(this, this.media, "languagechange");
								}
								_a.toggle.call(this, !0, t),
									this.isHTML5 && this.isVideo && _a.updateCues.call(this);
							} else this.debug.warn("Track not found", e);
						else this.debug.warn("Invalid caption argument", e);
					else _a.toggle.call(this, !1, t);
				},
				setLanguage(e, t = !0) {
					if (!yr(e))
						return void this.debug.warn("Invalid language argument", e);
					const i = e.toLowerCase();
					this.captions.language = i;
					const n = _a.getTracks.call(this),
						s = _a.findTrack.call(this, [i]);
					_a.set.call(this, n.indexOf(s), t);
				},
				getTracks(e = !1) {
					return Array.from((this.media || {}).textTracks || [])
						.filter((t) => !this.isHTML5 || e || this.captions.meta.has(t))
						.filter((e) => ["captions", "subtitles"].includes(e.kind));
				},
				findTrack(e, t = !1) {
					const i = _a.getTracks.call(this),
						n = (e) => Number((this.captions.meta.get(e) || {}).default),
						s = Array.from(i).sort((e, t) => n(t) - n(e));
					let r;
					return (
						e.every((e) => ((r = s.find((t) => t.language === e)), !r)),
						r || (t ? s[0] : void 0)
					);
				},
				getCurrentTrack() {
					return _a.getTracks.call(this)[this.currentTrack];
				},
				getLabel(e) {
					let t = e;
					return (
						!Ar(t) &&
							Xr.textTracks &&
							this.captions.toggled &&
							(t = _a.getCurrentTrack.call(this)),
						Ar(t)
							? xr(t.label)
								? xr(t.language)
									? Ta.get("enabled", this.config)
									: e.language.toUpperCase()
								: t.label
							: Ta.get("disabled", this.config)
					);
				},
				updateCues(e) {
					if (!this.supported.ui) return;
					if (!Tr(this.elements.captions))
						return void this.debug.warn("No captions element to render to");
					if (!mr(e) && !Array.isArray(e))
						return void this.debug.warn("updateCues: Invalid input", e);
					let t = e;
					if (!t) {
						const e = _a.getCurrentTrack.call(this);
						t = Array.from((e || {}).activeCues || [])
							.map((e) => e.getCueAsHTML())
							.map(wa);
					}
					const i = t.map((e) => e.trim()).join("\n");
					if (i !== this.elements.captions.innerHTML) {
						qr(this.elements.captions);
						const e = jr("span", Dr(this.config.selectors.caption));
						(e.innerHTML = i),
							this.elements.captions.appendChild(e),
							ia.call(this, this.media, "cuechange");
					}
				},
			},
			Oa = {
				enabled: !0,
				title: "",
				debug: !1,
				autoplay: !1,
				autopause: !0,
				playsinline: !0,
				seekTime: 10,
				volume: 1,
				muted: !1,
				duration: null,
				displayDuration: !0,
				invertTime: !0,
				toggleInvert: !0,
				ratio: null,
				clickToPlay: !0,
				hideControls: !0,
				resetOnEnd: !1,
				disableContextMenu: !0,
				loadSprite: !0,
				iconPrefix: "plyr",
				iconUrl: "https://cdn.plyr.io/3.6.8/plyr.svg",
				blankVideo: "https://cdn.plyr.io/static/blank.mp4",
				quality: {
					default: 576,
					options: [4320, 2880, 2160, 1440, 1080, 720, 576, 480, 360, 240],
					forced: !1,
					onChange: null,
				},
				loop: { active: !1 },
				speed: { selected: 1, options: [0.5, 0.75, 1, 1.25, 1.5, 1.75, 2, 4] },
				keyboard: { focused: !0, global: !1 },
				tooltips: { controls: !1, seek: !0 },
				captions: { active: !1, language: "auto", update: !1 },
				fullscreen: { enabled: !0, fallback: !0, iosNative: !1 },
				storage: { enabled: !0, key: "plyr" },
				controls: [
					"play-large",
					"play",
					"progress",
					"current-time",
					"mute",
					"volume",
					"captions",
					"settings",
					"pip",
					"airplay",
					"fullscreen",
				],
				settings: ["captions", "quality", "speed"],
				i18n: {
					restart: "Restart",
					rewind: "Rewind {seektime}s",
					play: "Play",
					pause: "Pause",
					fastForward: "Forward {seektime}s",
					seek: "Seek",
					seekLabel: "{currentTime} of {duration}",
					played: "Played",
					buffered: "Buffered",
					currentTime: "Current time",
					duration: "Duration",
					volume: "Volume",
					mute: "Mute",
					unmute: "Unmute",
					enableCaptions: "Enable captions",
					disableCaptions: "Disable captions",
					download: "Download",
					enterFullscreen: "Enter fullscreen",
					exitFullscreen: "Exit fullscreen",
					frameTitle: "Player for {title}",
					captions: "Captions",
					settings: "Settings",
					pip: "PIP",
					menuBack: "Go back to previous menu",
					speed: "Speed",
					normal: "Normal",
					quality: "Quality",
					loop: "Loop",
					start: "Start",
					end: "End",
					all: "All",
					reset: "Reset",
					disabled: "Disabled",
					enabled: "Enabled",
					advertisement: "Ad",
					qualityBadge: {
						2160: "4K",
						1440: "HD",
						1080: "HD",
						720: "HD",
						576: "SD",
						480: "SD",
					},
				},
				urls: {
					download: null,
					vimeo: {
						sdk: "https://player.vimeo.com/api/player.js",
						iframe: "https://player.vimeo.com/video/{0}?{1}",
						api: "https://vimeo.com/api/oembed.json?url={0}",
					},
					youtube: {
						sdk: "https://www.youtube.com/iframe_api",
						api: "https://noembed.com/embed?url=https://www.youtube.com/watch?v={0}",
					},
					googleIMA: {
						sdk: "https://imasdk.googleapis.com/js/sdkloader/ima3.js",
					},
				},
				listeners: {
					seek: null,
					play: null,
					pause: null,
					restart: null,
					rewind: null,
					fastForward: null,
					mute: null,
					volume: null,
					captions: null,
					download: null,
					fullscreen: null,
					pip: null,
					airplay: null,
					speed: null,
					quality: null,
					loop: null,
					language: null,
				},
				events: [
					"ended",
					"progress",
					"stalled",
					"playing",
					"waiting",
					"canplay",
					"canplaythrough",
					"loadstart",
					"loadeddata",
					"loadedmetadata",
					"timeupdate",
					"volumechange",
					"play",
					"pause",
					"error",
					"seeking",
					"seeked",
					"emptied",
					"ratechange",
					"cuechange",
					"download",
					"enterfullscreen",
					"exitfullscreen",
					"captionsenabled",
					"captionsdisabled",
					"languagechange",
					"controlshidden",
					"controlsshown",
					"ready",
					"statechange",
					"qualitychange",
					"adsloaded",
					"adscontentpause",
					"adscontentresume",
					"adstarted",
					"adsmidpoint",
					"adscomplete",
					"adsallcomplete",
					"adsimpression",
					"adsclick",
				],
				selectors: {
					editable: "input, textarea, select, [contenteditable]",
					container: ".plyr",
					controls: { container: null, wrapper: ".plyr__controls" },
					labels: "[data-plyr]",
					buttons: {
						play: '[data-plyr="play"]',
						pause: '[data-plyr="pause"]',
						restart: '[data-plyr="restart"]',
						rewind: '[data-plyr="rewind"]',
						fastForward: '[data-plyr="fast-forward"]',
						mute: '[data-plyr="mute"]',
						captions: '[data-plyr="captions"]',
						download: '[data-plyr="download"]',
						fullscreen: '[data-plyr="fullscreen"]',
						pip: '[data-plyr="pip"]',
						airplay: '[data-plyr="airplay"]',
						settings: '[data-plyr="settings"]',
						loop: '[data-plyr="loop"]',
					},
					inputs: {
						seek: '[data-plyr="seek"]',
						volume: '[data-plyr="volume"]',
						speed: '[data-plyr="speed"]',
						language: '[data-plyr="language"]',
						quality: '[data-plyr="quality"]',
					},
					display: {
						currentTime: ".plyr__time--current",
						duration: ".plyr__time--duration",
						buffer: ".plyr__progress__buffer",
						loop: ".plyr__progress__loop",
						volume: ".plyr__volume--display",
					},
					progress: ".plyr__progress",
					captions: ".plyr__captions",
					caption: ".plyr__caption",
				},
				classNames: {
					type: "plyr--{0}",
					provider: "plyr--{0}",
					video: "plyr__video-wrapper",
					embed: "plyr__video-embed",
					videoFixedRatio: "plyr__video-wrapper--fixed-ratio",
					embedContainer: "plyr__video-embed__container",
					poster: "plyr__poster",
					posterEnabled: "plyr__poster-enabled",
					ads: "plyr__ads",
					control: "plyr__control",
					controlPressed: "plyr__control--pressed",
					playing: "plyr--playing",
					paused: "plyr--paused",
					stopped: "plyr--stopped",
					loading: "plyr--loading",
					hover: "plyr--hover",
					tooltip: "plyr__tooltip",
					cues: "plyr__cues",
					hidden: "plyr__sr-only",
					hideControls: "plyr--hide-controls",
					isIos: "plyr--is-ios",
					isTouch: "plyr--is-touch",
					uiSupported: "plyr--full-ui",
					noTransition: "plyr--no-transition",
					display: { time: "plyr__time" },
					menu: {
						value: "plyr__menu__value",
						badge: "plyr__badge",
						open: "plyr--menu-open",
					},
					captions: {
						enabled: "plyr--captions-enabled",
						active: "plyr--captions-active",
					},
					fullscreen: {
						enabled: "plyr--fullscreen-enabled",
						fallback: "plyr--fullscreen-fallback",
					},
					pip: { supported: "plyr--pip-supported", active: "plyr--pip-active" },
					airplay: {
						supported: "plyr--airplay-supported",
						active: "plyr--airplay-active",
					},
					tabFocus: "plyr__tab-focus",
					previewThumbnails: {
						thumbContainer: "plyr__preview-thumb",
						thumbContainerShown: "plyr__preview-thumb--is-shown",
						imageContainer: "plyr__preview-thumb__image-container",
						timeContainer: "plyr__preview-thumb__time-container",
						scrubbingContainer: "plyr__preview-scrubbing",
						scrubbingContainerShown: "plyr__preview-scrubbing--is-shown",
					},
				},
				attributes: {
					embed: { provider: "data-plyr-provider", id: "data-plyr-embed-id" },
				},
				ads: { enabled: !1, publisherId: "", tagUrl: "" },
				previewThumbnails: { enabled: !1, src: "" },
				vimeo: {
					byline: !1,
					portrait: !1,
					title: !1,
					speed: !0,
					transparent: !1,
					customControls: !0,
					referrerPolicy: null,
					premium: !1,
				},
				youtube: {
					rel: 0,
					showinfo: 0,
					iv_load_policy: 3,
					modestbranding: 1,
					customControls: !0,
					noCookie: !1,
				},
			},
			Ma = "picture-in-picture",
			Na = "inline",
			Ra = { html5: "html5", youtube: "youtube", vimeo: "vimeo" },
			ja = "audio",
			$a = "video";
		const Ua = () => {};
		class qa {
			constructor(e = !1) {
				(this.enabled = window.console && e),
					this.enabled && this.log("Debugging enabled");
			}
			get log() {
				return this.enabled
					? Function.prototype.bind.call(console.log, console)
					: Ua;
			}
			get warn() {
				return this.enabled
					? Function.prototype.bind.call(console.warn, console)
					: Ua;
			}
			get error() {
				return this.enabled
					? Function.prototype.bind.call(console.error, console)
					: Ua;
			}
		}
		class Fa {
			constructor(e) {
				$s(this, "onChange", () => {
					if (!this.enabled) return;
					const e = this.player.elements.buttons.fullscreen;
					Tr(e) && (e.pressed = this.active);
					const t =
						this.target === this.player.media
							? this.target
							: this.player.elements.container;
					ia.call(
						this.player,
						t,
						this.active ? "enterfullscreen" : "exitfullscreen",
						!0
					);
				}),
					$s(this, "toggleFallback", (e = !1) => {
						if (
							(e
								? (this.scrollPosition = {
										x: window.scrollX || 0,
										y: window.scrollY || 0,
								  })
								: window.scrollTo(this.scrollPosition.x, this.scrollPosition.y),
							(document.body.style.overflow = e ? "hidden" : ""),
							Br(
								this.target,
								this.player.config.classNames.fullscreen.fallback,
								e
							),
							_r.isIos)
						) {
							let t = document.head.querySelector('meta[name="viewport"]');
							const i = "viewport-fit=cover";
							t ||
								((t = document.createElement("meta")),
								t.setAttribute("name", "viewport"));
							const n = yr(t.content) && t.content.includes(i);
							e
								? ((this.cleanupViewport = !n), n || (t.content += `,${i}`))
								: this.cleanupViewport &&
								  (t.content = t.content
										.split(",")
										.filter((e) => e.trim() !== i)
										.join(","));
						}
						this.onChange();
					}),
					$s(this, "trapFocus", (e) => {
						if (_r.isIos || !this.active || "Tab" !== e.key || 9 !== e.keyCode)
							return;
						const t = document.activeElement,
							i = zr.call(
								this.player,
								"a[href], button:not(:disabled), input:not(:disabled), [tabindex]"
							),
							[n] = i,
							s = i[i.length - 1];
						t !== s || e.shiftKey
							? t === n && e.shiftKey && (s.focus(), e.preventDefault())
							: (n.focus(), e.preventDefault());
					}),
					$s(this, "update", () => {
						if (this.enabled) {
							let e;
							(e = this.forceFallback
								? "Fallback (forced)"
								: Fa.native
								? "Native"
								: "Fallback"),
								this.player.debug.log(`${e} fullscreen enabled`);
						} else
							this.player.debug.log(
								"Fullscreen not supported and fallback disabled"
							);
						Br(
							this.player.elements.container,
							this.player.config.classNames.fullscreen.enabled,
							this.enabled
						);
					}),
					$s(this, "enter", () => {
						this.enabled &&
							(_r.isIos && this.player.config.fullscreen.iosNative
								? this.player.isVimeo
									? this.player.embed.requestFullscreen()
									: this.target.webkitEnterFullscreen()
								: !Fa.native || this.forceFallback
								? this.toggleFallback(!0)
								: this.prefix
								? xr(this.prefix) ||
								  this.target[`${this.prefix}Request${this.property}`]()
								: this.target.requestFullscreen({ navigationUI: "hide" }));
					}),
					$s(this, "exit", () => {
						if (this.enabled)
							if (_r.isIos && this.player.config.fullscreen.iosNative)
								this.target.webkitExitFullscreen(), ra(this.player.play());
							else if (!Fa.native || this.forceFallback)
								this.toggleFallback(!1);
							else if (this.prefix) {
								if (!xr(this.prefix)) {
									const e = "moz" === this.prefix ? "Cancel" : "Exit";
									document[`${this.prefix}${e}${this.property}`]();
								}
							} else
								(document.cancelFullScreen || document.exitFullscreen).call(
									document
								);
					}),
					$s(this, "toggle", () => {
						this.active ? this.exit() : this.enter();
					}),
					(this.player = e),
					(this.prefix = Fa.prefix),
					(this.property = Fa.property),
					(this.scrollPosition = { x: 0, y: 0 }),
					(this.forceFallback = "force" === e.config.fullscreen.fallback),
					(this.player.elements.fullscreen =
						e.config.fullscreen.container &&
						(function (e, t) {
							const { prototype: i } = Element;
							return (
								i.closest ||
								function () {
									let e = this;
									do {
										if (Wr.matches(e, t)) return e;
										e = e.parentElement || e.parentNode;
									} while (null !== e && 1 === e.nodeType);
									return null;
								}
							).call(e, t);
						})(this.player.elements.container, e.config.fullscreen.container)),
					Zr.call(
						this.player,
						document,
						"ms" === this.prefix
							? "MSFullscreenChange"
							: `${this.prefix}fullscreenchange`,
						() => {
							this.onChange();
						}
					),
					Zr.call(
						this.player,
						this.player.elements.container,
						"dblclick",
						(e) => {
							(Tr(this.player.elements.controls) &&
								this.player.elements.controls.contains(e.target)) ||
								this.player.listeners.proxy(e, this.toggle, "fullscreen");
						}
					),
					Zr.call(this, this.player.elements.container, "keydown", (e) =>
						this.trapFocus(e)
					),
					this.update();
			}
			static get native() {
				return !!(
					document.fullscreenEnabled ||
					document.webkitFullscreenEnabled ||
					document.mozFullScreenEnabled ||
					document.msFullscreenEnabled
				);
			}
			get usingNative() {
				return Fa.native && !this.forceFallback;
			}
			static get prefix() {
				if (vr(document.exitFullscreen)) return "";
				let e = "";
				return (
					["webkit", "moz", "ms"].some(
						(t) =>
							!(
								!vr(document[`${t}ExitFullscreen`]) &&
								!vr(document[`${t}CancelFullScreen`])
							) && ((e = t), !0)
					),
					e
				);
			}
			static get property() {
				return "moz" === this.prefix ? "FullScreen" : "Fullscreen";
			}
			get enabled() {
				return (
					(Fa.native || this.player.config.fullscreen.fallback) &&
					this.player.config.fullscreen.enabled &&
					this.player.supported.ui &&
					this.player.isVideo
				);
			}
			get active() {
				if (!this.enabled) return !1;
				if (!Fa.native || this.forceFallback)
					return Vr(
						this.target,
						this.player.config.classNames.fullscreen.fallback
					);
				const e = this.prefix
					? document[`${this.prefix}${this.property}Element`]
					: document.fullscreenElement;
				return e && e.shadowRoot
					? e === this.target.getRootNode().host
					: e === this.target;
			}
			get target() {
				return _r.isIos && this.player.config.fullscreen.iosNative
					? this.player.media
					: this.player.elements.fullscreen || this.player.elements.container;
			}
		}
		function Da(e, t = 1) {
			return new Promise((i, n) => {
				const s = new Image(),
					r = () => {
						delete s.onload, delete s.onerror, (s.naturalWidth >= t ? i : n)(s);
					};
				Object.assign(s, { onload: r, onerror: r, src: e });
			});
		}
		const Ha = {
			addStyleHook() {
				Br(
					this.elements.container,
					this.config.selectors.container.replace(".", ""),
					!0
				),
					Br(
						this.elements.container,
						this.config.classNames.uiSupported,
						this.supported.ui
					);
			},
			toggleNativeControls(e = !1) {
				e && this.isHTML5
					? this.media.setAttribute("controls", "")
					: this.media.removeAttribute("controls");
			},
			build() {
				if ((this.listeners.media(), !this.supported.ui))
					return (
						this.debug.warn(
							`Basic support only for ${this.provider} ${this.type}`
						),
						void Ha.toggleNativeControls.call(this, !0)
					);
				Tr(this.elements.controls) ||
					(xa.inject.call(this), this.listeners.controls()),
					Ha.toggleNativeControls.call(this),
					this.isHTML5 && _a.setup.call(this),
					(this.volume = null),
					(this.muted = null),
					(this.loop = null),
					(this.quality = null),
					(this.speed = null),
					xa.updateVolume.call(this),
					xa.timeUpdate.call(this),
					Ha.checkPlaying.call(this),
					Br(
						this.elements.container,
						this.config.classNames.pip.supported,
						Xr.pip && this.isHTML5 && this.isVideo
					),
					Br(
						this.elements.container,
						this.config.classNames.airplay.supported,
						Xr.airplay && this.isHTML5
					),
					Br(this.elements.container, this.config.classNames.isIos, _r.isIos),
					Br(
						this.elements.container,
						this.config.classNames.isTouch,
						this.touch
					),
					(this.ready = !0),
					setTimeout(() => {
						ia.call(this, this.media, "ready");
					}, 0),
					Ha.setTitle.call(this),
					this.poster &&
						Ha.setPoster.call(this, this.poster, !1).catch(() => {}),
					this.config.duration && xa.durationUpdate.call(this);
			},
			setTitle() {
				let e = Ta.get("play", this.config);
				if (
					(yr(this.config.title) &&
						!xr(this.config.title) &&
						(e += `, ${this.config.title}`),
					Array.from(this.elements.buttons.play || []).forEach((t) => {
						t.setAttribute("aria-label", e);
					}),
					this.isEmbed)
				) {
					const e = Kr.call(this, "iframe");
					if (!Tr(e)) return;
					const t = xr(this.config.title) ? "video" : this.config.title,
						i = Ta.get("frameTitle", this.config);
					e.setAttribute("title", i.replace("{title}", t));
				}
			},
			togglePoster(e) {
				Br(this.elements.container, this.config.classNames.posterEnabled, e);
			},
			setPoster(e, t = !0) {
				return t && this.poster
					? Promise.reject(new Error("Poster already set"))
					: (this.media.setAttribute("data-poster", e),
					  this.elements.poster.removeAttribute("hidden"),
					  sa
							.call(this)
							.then(() => Da(e))
							.catch((t) => {
								throw (e === this.poster && Ha.togglePoster.call(this, !1), t);
							})
							.then(() => {
								if (e !== this.poster)
									throw new Error(
										"setPoster cancelled by later call to setPoster"
									);
							})
							.then(
								() => (
									Object.assign(this.elements.poster.style, {
										backgroundImage: `url('${e}')`,
										backgroundSize: "",
									}),
									Ha.togglePoster.call(this, !0),
									e
								)
							));
			},
			checkPlaying(e) {
				Br(
					this.elements.container,
					this.config.classNames.playing,
					this.playing
				),
					Br(
						this.elements.container,
						this.config.classNames.paused,
						this.paused
					),
					Br(
						this.elements.container,
						this.config.classNames.stopped,
						this.stopped
					),
					Array.from(this.elements.buttons.play || []).forEach((e) => {
						Object.assign(e, { pressed: this.playing }),
							e.setAttribute(
								"aria-label",
								Ta.get(this.playing ? "pause" : "play", this.config)
							);
					}),
					(Sr(e) && "timeupdate" === e.type) || Ha.toggleControls.call(this);
			},
			checkLoading(e) {
				(this.loading = ["stalled", "waiting"].includes(e.type)),
					clearTimeout(this.timers.loading),
					(this.timers.loading = setTimeout(
						() => {
							Br(
								this.elements.container,
								this.config.classNames.loading,
								this.loading
							),
								Ha.toggleControls.call(this);
						},
						this.loading ? 250 : 0
					));
			},
			toggleControls(e) {
				const { controls: t } = this.elements;
				if (t && this.config.hideControls) {
					const i = this.touch && this.lastSeekTime + 2e3 > Date.now();
					this.toggleControls(
						Boolean(
							e || this.loading || this.paused || t.pressed || t.hover || i
						)
					);
				}
			},
			migrateStyles() {
				Object.values({ ...this.media.style })
					.filter((e) => !xr(e) && yr(e) && e.startsWith("--plyr"))
					.forEach((e) => {
						this.elements.container.style.setProperty(
							e,
							this.media.style.getPropertyValue(e)
						),
							this.media.style.removeProperty(e);
					}),
					xr(this.media.style) && this.media.removeAttribute("style");
			},
		};
		class Ba {
			constructor(e) {
				$s(this, "firstTouch", () => {
					const { player: e } = this,
						{ elements: t } = e;
					(e.touch = !0), Br(t.container, e.config.classNames.isTouch, !0);
				}),
					$s(this, "setTabFocus", (e) => {
						const { player: t } = this,
							{ elements: i } = t;
						if (
							(clearTimeout(this.focusTimer),
							"keydown" === e.type && 9 !== e.which)
						)
							return;
						"keydown" === e.type && (this.lastKeyDown = e.timeStamp);
						const n = e.timeStamp - this.lastKeyDown <= 20;
						("focus" !== e.type || n) &&
							((() => {
								const e = t.config.classNames.tabFocus;
								Br(zr.call(t, `.${e}`), e, !1);
							})(),
							"focusout" !== e.type &&
								(this.focusTimer = setTimeout(() => {
									const e = document.activeElement;
									i.container.contains(e) &&
										Br(
											document.activeElement,
											t.config.classNames.tabFocus,
											!0
										);
								}, 10)));
					}),
					$s(this, "global", (e = !0) => {
						const { player: t } = this;
						t.config.keyboard.global &&
							Jr.call(t, window, "keydown keyup", this.handleKey, e, !1),
							Jr.call(t, document.body, "click", this.toggleMenu, e),
							ta.call(t, document.body, "touchstart", this.firstTouch),
							Jr.call(
								t,
								document.body,
								"keydown focus blur focusout",
								this.setTabFocus,
								e,
								!1,
								!0
							);
					}),
					$s(this, "container", () => {
						const { player: e } = this,
							{ config: t, elements: i, timers: n } = e;
						!t.keyboard.global &&
							t.keyboard.focused &&
							Zr.call(e, i.container, "keydown keyup", this.handleKey, !1),
							Zr.call(
								e,
								i.container,
								"mousemove mouseleave touchstart touchmove enterfullscreen exitfullscreen",
								(t) => {
									const { controls: s } = i;
									s &&
										"enterfullscreen" === t.type &&
										((s.pressed = !1), (s.hover = !1));
									let r = 0;
									["touchstart", "touchmove", "mousemove"].includes(t.type) &&
										(Ha.toggleControls.call(e, !0), (r = e.touch ? 3e3 : 2e3)),
										clearTimeout(n.controls),
										(n.controls = setTimeout(
											() => Ha.toggleControls.call(e, !1),
											r
										));
								}
							);
						const s = () => {
								if (!e.isVimeo || e.config.vimeo.premium) return;
								const t = i.wrapper,
									{ active: n } = e.fullscreen,
									[s, r] = da.call(e),
									a = la(`aspect-ratio: ${s} / ${r}`);
								if (!n)
									return void (a
										? ((t.style.width = null), (t.style.height = null))
										: ((t.style.maxWidth = null), (t.style.margin = null)));
								const [o, l] = [
										Math.max(
											document.documentElement.clientWidth || 0,
											window.innerWidth || 0
										),
										Math.max(
											document.documentElement.clientHeight || 0,
											window.innerHeight || 0
										),
									],
									c = o / l > s / r;
								a
									? ((t.style.width = c ? "auto" : "100%"),
									  (t.style.height = c ? "100%" : "auto"))
									: ((t.style.maxWidth = c ? (l / r) * s + "px" : null),
									  (t.style.margin = c ? "0 auto" : null));
							},
							r = () => {
								clearTimeout(n.resized), (n.resized = setTimeout(s, 50));
							};
						Zr.call(e, i.container, "enterfullscreen exitfullscreen", (t) => {
							const { target: n } = e.fullscreen;
							if (n !== i.container) return;
							if (!e.isEmbed && xr(e.config.ratio)) return;
							s();
							("enterfullscreen" === t.type ? Zr : ea).call(
								e,
								window,
								"resize",
								r
							);
						});
					}),
					$s(this, "media", () => {
						const { player: e } = this,
							{ elements: t } = e;
						if (
							(Zr.call(e, e.media, "timeupdate seeking seeked", (t) =>
								xa.timeUpdate.call(e, t)
							),
							Zr.call(
								e,
								e.media,
								"durationchange loadeddata loadedmetadata",
								(t) => xa.durationUpdate.call(e, t)
							),
							Zr.call(e, e.media, "ended", () => {
								e.isHTML5 &&
									e.isVideo &&
									e.config.resetOnEnd &&
									(e.restart(), e.pause());
							}),
							Zr.call(e, e.media, "progress playing seeking seeked", (t) =>
								xa.updateProgress.call(e, t)
							),
							Zr.call(e, e.media, "volumechange", (t) =>
								xa.updateVolume.call(e, t)
							),
							Zr.call(
								e,
								e.media,
								"playing play pause ended emptied timeupdate",
								(t) => Ha.checkPlaying.call(e, t)
							),
							Zr.call(e, e.media, "waiting canplay seeked playing", (t) =>
								Ha.checkLoading.call(e, t)
							),
							e.supported.ui && e.config.clickToPlay && !e.isAudio)
						) {
							const i = Kr.call(e, `.${e.config.classNames.video}`);
							if (!Tr(i)) return;
							Zr.call(e, t.container, "click", (n) => {
								([t.container, i].includes(n.target) || i.contains(n.target)) &&
									((e.touch && e.config.hideControls) ||
										(e.ended
											? (this.proxy(n, e.restart, "restart"),
											  this.proxy(
													n,
													() => {
														ra(e.play());
													},
													"play"
											  ))
											: this.proxy(
													n,
													() => {
														ra(e.togglePlay());
													},
													"play"
											  )));
							});
						}
						e.supported.ui &&
							e.config.disableContextMenu &&
							Zr.call(
								e,
								t.wrapper,
								"contextmenu",
								(e) => {
									e.preventDefault();
								},
								!1
							),
							Zr.call(e, e.media, "volumechange", () => {
								e.storage.set({ volume: e.volume, muted: e.muted });
							}),
							Zr.call(e, e.media, "ratechange", () => {
								xa.updateSetting.call(e, "speed"),
									e.storage.set({ speed: e.speed });
							}),
							Zr.call(e, e.media, "qualitychange", (t) => {
								xa.updateSetting.call(e, "quality", null, t.detail.quality);
							}),
							Zr.call(e, e.media, "ready qualitychange", () => {
								xa.setDownloadUrl.call(e);
							});
						const i = e.config.events.concat(["keyup", "keydown"]).join(" ");
						Zr.call(e, e.media, i, (i) => {
							let { detail: n = {} } = i;
							"error" === i.type && (n = e.media.error),
								ia.call(e, t.container, i.type, !0, n);
						});
					}),
					$s(this, "proxy", (e, t, i) => {
						const { player: n } = this,
							s = n.config.listeners[i];
						let r = !0;
						vr(s) && (r = s.call(n, e)), !1 !== r && vr(t) && t.call(n, e);
					}),
					$s(this, "bind", (e, t, i, n, s = !0) => {
						const { player: r } = this,
							a = r.config.listeners[n],
							o = vr(a);
						Zr.call(r, e, t, (e) => this.proxy(e, i, n), s && !o);
					}),
					$s(this, "controls", () => {
						const { player: e } = this,
							{ elements: t } = e,
							i = _r.isIE ? "change" : "input";
						if (
							(t.buttons.play &&
								Array.from(t.buttons.play).forEach((t) => {
									this.bind(
										t,
										"click",
										() => {
											ra(e.togglePlay());
										},
										"play"
									);
								}),
							this.bind(t.buttons.restart, "click", e.restart, "restart"),
							this.bind(
								t.buttons.rewind,
								"click",
								() => {
									(e.lastSeekTime = Date.now()), e.rewind();
								},
								"rewind"
							),
							this.bind(
								t.buttons.fastForward,
								"click",
								() => {
									(e.lastSeekTime = Date.now()), e.forward();
								},
								"fastForward"
							),
							this.bind(
								t.buttons.mute,
								"click",
								() => {
									e.muted = !e.muted;
								},
								"mute"
							),
							this.bind(t.buttons.captions, "click", () => e.toggleCaptions()),
							this.bind(
								t.buttons.download,
								"click",
								() => {
									ia.call(e, e.media, "download");
								},
								"download"
							),
							this.bind(
								t.buttons.fullscreen,
								"click",
								() => {
									e.fullscreen.toggle();
								},
								"fullscreen"
							),
							this.bind(
								t.buttons.pip,
								"click",
								() => {
									e.pip = "toggle";
								},
								"pip"
							),
							this.bind(t.buttons.airplay, "click", e.airplay, "airplay"),
							this.bind(
								t.buttons.settings,
								"click",
								(t) => {
									t.stopPropagation(),
										t.preventDefault(),
										xa.toggleMenu.call(e, t);
								},
								null,
								!1
							),
							this.bind(
								t.buttons.settings,
								"keyup",
								(t) => {
									const i = t.which;
									[13, 32].includes(i) &&
										(13 !== i
											? (t.preventDefault(),
											  t.stopPropagation(),
											  xa.toggleMenu.call(e, t))
											: xa.focusFirstMenuItem.call(e, null, !0));
								},
								null,
								!1
							),
							this.bind(t.settings.menu, "keydown", (t) => {
								27 === t.which && xa.toggleMenu.call(e, t);
							}),
							this.bind(t.inputs.seek, "mousedown mousemove", (e) => {
								const i = t.progress.getBoundingClientRect(),
									n = (100 / i.width) * (e.pageX - i.left);
								e.currentTarget.setAttribute("seek-value", n);
							}),
							this.bind(
								t.inputs.seek,
								"mousedown mouseup keydown keyup touchstart touchend",
								(t) => {
									const i = t.currentTarget,
										n = t.keyCode ? t.keyCode : t.which,
										s = "play-on-seeked";
									if (Er(t) && 39 !== n && 37 !== n) return;
									e.lastSeekTime = Date.now();
									const r = i.hasAttribute(s),
										a = ["mouseup", "touchend", "keyup"].includes(t.type);
									r && a
										? (i.removeAttribute(s), ra(e.play()))
										: !a && e.playing && (i.setAttribute(s, ""), e.pause());
								}
							),
							_r.isIos)
						) {
							const t = zr.call(e, 'input[type="range"]');
							Array.from(t).forEach((e) =>
								this.bind(e, i, (e) => Ir(e.target))
							);
						}
						this.bind(
							t.inputs.seek,
							i,
							(t) => {
								const i = t.currentTarget;
								let n = i.getAttribute("seek-value");
								xr(n) && (n = i.value),
									i.removeAttribute("seek-value"),
									(e.currentTime = (n / i.max) * e.duration);
							},
							"seek"
						),
							this.bind(t.progress, "mouseenter mouseleave mousemove", (t) =>
								xa.updateSeekTooltip.call(e, t)
							),
							this.bind(t.progress, "mousemove touchmove", (t) => {
								const { previewThumbnails: i } = e;
								i && i.loaded && i.startMove(t);
							}),
							this.bind(t.progress, "mouseleave touchend click", () => {
								const { previewThumbnails: t } = e;
								t && t.loaded && t.endMove(!1, !0);
							}),
							this.bind(t.progress, "mousedown touchstart", (t) => {
								const { previewThumbnails: i } = e;
								i && i.loaded && i.startScrubbing(t);
							}),
							this.bind(t.progress, "mouseup touchend", (t) => {
								const { previewThumbnails: i } = e;
								i && i.loaded && i.endScrubbing(t);
							}),
							_r.isWebkit &&
								Array.from(zr.call(e, 'input[type="range"]')).forEach((t) => {
									this.bind(t, "input", (t) =>
										xa.updateRangeFill.call(e, t.target)
									);
								}),
							e.config.toggleInvert &&
								!Tr(t.display.duration) &&
								this.bind(t.display.currentTime, "click", () => {
									0 !== e.currentTime &&
										((e.config.invertTime = !e.config.invertTime),
										xa.timeUpdate.call(e));
								}),
							this.bind(
								t.inputs.volume,
								i,
								(t) => {
									e.volume = t.target.value;
								},
								"volume"
							),
							this.bind(t.controls, "mouseenter mouseleave", (i) => {
								t.controls.hover = !e.touch && "mouseenter" === i.type;
							}),
							t.fullscreen &&
								Array.from(t.fullscreen.children)
									.filter((e) => !e.contains(t.container))
									.forEach((i) => {
										this.bind(i, "mouseenter mouseleave", (i) => {
											t.controls.hover = !e.touch && "mouseenter" === i.type;
										});
									}),
							this.bind(
								t.controls,
								"mousedown mouseup touchstart touchend touchcancel",
								(e) => {
									t.controls.pressed = ["mousedown", "touchstart"].includes(
										e.type
									);
								}
							),
							this.bind(t.controls, "focusin", () => {
								const { config: i, timers: n } = e;
								Br(t.controls, i.classNames.noTransition, !0),
									Ha.toggleControls.call(e, !0),
									setTimeout(() => {
										Br(t.controls, i.classNames.noTransition, !1);
									}, 0);
								const s = this.touch ? 3e3 : 4e3;
								clearTimeout(n.controls),
									(n.controls = setTimeout(
										() => Ha.toggleControls.call(e, !1),
										s
									));
							}),
							this.bind(
								t.inputs.volume,
								"wheel",
								(t) => {
									const i = t.webkitDirectionInvertedFromDevice,
										[n, s] = [t.deltaX, -t.deltaY].map((e) => (i ? -e : e)),
										r = Math.sign(Math.abs(n) > Math.abs(s) ? n : s);
									e.increaseVolume(r / 50);
									const { volume: a } = e.media;
									((1 === r && a < 1) || (-1 === r && a > 0)) &&
										t.preventDefault();
								},
								"volume",
								!1
							);
					}),
					(this.player = e),
					(this.lastKey = null),
					(this.focusTimer = null),
					(this.lastKeyDown = null),
					(this.handleKey = this.handleKey.bind(this)),
					(this.toggleMenu = this.toggleMenu.bind(this)),
					(this.setTabFocus = this.setTabFocus.bind(this)),
					(this.firstTouch = this.firstTouch.bind(this));
			}
			handleKey(e) {
				const { player: t } = this,
					{ elements: i } = t,
					n = e.keyCode ? e.keyCode : e.which,
					s = "keydown" === e.type,
					r = s && n === this.lastKey;
				if (e.altKey || e.ctrlKey || e.metaKey || e.shiftKey) return;
				if (!gr(n)) return;
				if (s) {
					const s = document.activeElement;
					if (Tr(s)) {
						const { editable: n } = t.config.selectors,
							{ seek: r } = i.inputs;
						if (s !== r && Wr(s, n)) return;
						if (32 === e.which && Wr(s, 'button, [role^="menuitem"]')) return;
					}
					switch (
						([
							32, 37, 38, 39, 40, 48, 49, 50, 51, 52, 53, 54, 56, 57, 67, 70,
							73, 75, 76, 77, 79,
						].includes(n) && (e.preventDefault(), e.stopPropagation()),
						n)
					) {
						case 48:
						case 49:
						case 50:
						case 51:
						case 52:
						case 53:
						case 54:
						case 55:
						case 56:
						case 57:
							r || (t.currentTime = (t.duration / 10) * (n - 48));
							break;
						case 32:
						case 75:
							r || ra(t.togglePlay());
							break;
						case 38:
							t.increaseVolume(0.1);
							break;
						case 40:
							t.decreaseVolume(0.1);
							break;
						case 77:
							r || (t.muted = !t.muted);
							break;
						case 39:
							t.forward();
							break;
						case 37:
							t.rewind();
							break;
						case 70:
							t.fullscreen.toggle();
							break;
						case 67:
							r || t.toggleCaptions();
							break;
						case 76:
							t.loop = !t.loop;
					}
					27 === n &&
						!t.fullscreen.usingNative &&
						t.fullscreen.active &&
						t.fullscreen.toggle(),
						(this.lastKey = n);
				} else this.lastKey = null;
			}
			toggleMenu(e) {
				xa.toggleMenu.call(this.player, e);
			}
		}
		var Va = t(function (e, t) {
			e.exports = (function () {
				var e = function () {},
					t = {},
					i = {},
					n = {};
				function s(e, t) {
					e = e.push ? e : [e];
					var s,
						r,
						a,
						o = [],
						l = e.length,
						c = l;
					for (
						s = function (e, i) {
							i.length && o.push(e), --c || t(o);
						};
						l--;

					)
						(r = e[l]), (a = i[r]) ? s(r, a) : (n[r] = n[r] || []).push(s);
				}
				function r(e, t) {
					if (e) {
						var s = n[e];
						if (((i[e] = t), s)) for (; s.length; ) s[0](e, t), s.splice(0, 1);
					}
				}
				function a(t, i) {
					t.call && (t = { success: t }),
						i.length ? (t.error || e)(i) : (t.success || e)(t);
				}
				function o(t, i, n, s) {
					var r,
						a,
						l = document,
						c = n.async,
						u = (n.numRetries || 0) + 1,
						h = n.before || e,
						d = t.replace(/[\?|#].*$/, ""),
						p = t.replace(/^(css|img)!/, "");
					(s = s || 0),
						/(^css!|\.css$)/.test(d)
							? (((a = l.createElement("link")).rel = "stylesheet"),
							  (a.href = p),
							  (r = "hideFocus" in a) &&
									a.relList &&
									((r = 0), (a.rel = "preload"), (a.as = "style")))
							: /(^img!|\.(png|gif|jpg|svg|webp)$)/.test(d)
							? ((a = l.createElement("img")).src = p)
							: (((a = l.createElement("script")).src = t),
							  (a.async = void 0 === c || c)),
						(a.onload =
							a.onerror =
							a.onbeforeload =
								function (e) {
									var l = e.type[0];
									if (r)
										try {
											a.sheet.cssText.length || (l = "e");
										} catch (e) {
											18 != e.code && (l = "e");
										}
									if ("e" == l) {
										if ((s += 1) < u) return o(t, i, n, s);
									} else if ("preload" == a.rel && "style" == a.as)
										return (a.rel = "stylesheet");
									i(t, l, e.defaultPrevented);
								}),
						!1 !== h(t, a) && l.head.appendChild(a);
				}
				function l(e, t, i) {
					var n,
						s,
						r = (e = e.push ? e : [e]).length,
						a = r,
						l = [];
					for (
						n = function (e, i, n) {
							if (("e" == i && l.push(e), "b" == i)) {
								if (!n) return;
								l.push(e);
							}
							--r || t(l);
						},
							s = 0;
						s < a;
						s++
					)
						o(e[s], n, i);
				}
				function c(e, i, n) {
					var s, o;
					if ((i && i.trim && (s = i), (o = (s ? n : i) || {}), s)) {
						if (s in t) throw "LoadJS";
						t[s] = !0;
					}
					function c(t, i) {
						l(
							e,
							function (e) {
								a(o, e), t && a({ success: t, error: i }, e), r(s, e);
							},
							o
						);
					}
					if (o.returnPromise) return new Promise(c);
					c();
				}
				return (
					(c.ready = function (e, t) {
						return (
							s(e, function (e) {
								a(t, e);
							}),
							c
						);
					}),
					(c.done = function (e) {
						r(e, []);
					}),
					(c.reset = function () {
						(t = {}), (i = {}), (n = {});
					}),
					(c.isDefined = function (e) {
						return e in t;
					}),
					c
				);
			})();
		});
		function Wa(e) {
			return new Promise((t, i) => {
				Va(e, { success: t, error: i });
			});
		}
		function za(e) {
			e && !this.embed.hasPlayed && (this.embed.hasPlayed = !0),
				this.media.paused === e &&
					((this.media.paused = !e),
					ia.call(this, this.media, e ? "play" : "pause"));
		}
		const Ka = {
			setup() {
				const e = this;
				Br(e.elements.wrapper, e.config.classNames.embed, !0),
					(e.options.speed = e.config.speed.options),
					pa.call(e),
					fr(window.Vimeo)
						? Ka.ready.call(e)
						: Wa(e.config.urls.vimeo.sdk)
								.then(() => {
									Ka.ready.call(e);
								})
								.catch((t) => {
									e.debug.warn("Vimeo SDK (player.js) failed to load", t);
								});
			},
			ready() {
				const e = this,
					t = e.config.vimeo,
					{ premium: i, referrerPolicy: n, ...s } = t;
				i && Object.assign(s, { controls: !1, sidedock: !1 });
				const r = Ia({
					loop: e.config.loop.active,
					autoplay: e.autoplay,
					muted: e.muted,
					gesture: "media",
					playsinline: !this.config.fullscreen.iosNative,
					...s,
				});
				let a = e.media.getAttribute("src");
				xr(a) && (a = e.media.getAttribute(e.config.attributes.embed.id));
				const o = xr((l = a))
					? null
					: gr(Number(l))
					? l
					: l.match(/^.*(vimeo.com\/|video\/)(\d+).*/)
					? RegExp.$2
					: l;
				var l;
				const c = jr("iframe"),
					u = ga(e.config.urls.vimeo.iframe, o, r);
				if (
					(c.setAttribute("src", u),
					c.setAttribute("allowfullscreen", ""),
					c.setAttribute(
						"allow",
						[
							"autoplay",
							"fullscreen",
							"picture-in-picture",
							"encrypted-media",
							"accelerometer",
							"gyroscope",
						].join("; ")
					),
					xr(n) || c.setAttribute("referrerPolicy", n),
					i || !t.customControls)
				)
					c.setAttribute("data-poster", e.poster), (e.media = Fr(c, e.media));
				else {
					const t = jr("div", {
						class: e.config.classNames.embedContainer,
						"data-poster": e.poster,
					});
					t.appendChild(c), (e.media = Fr(t, e.media));
				}
				t.customControls ||
					Ea(ga(e.config.urls.vimeo.api, u)).then((t) => {
						!xr(t) &&
							t.thumbnail_url &&
							Ha.setPoster.call(e, t.thumbnail_url).catch(() => {});
					}),
					(e.embed = new window.Vimeo.Player(c, {
						autopause: e.config.autopause,
						muted: e.muted,
					})),
					(e.media.paused = !0),
					(e.media.currentTime = 0),
					e.supported.ui && e.embed.disableTextTrack(),
					(e.media.play = () => (za.call(e, !0), e.embed.play())),
					(e.media.pause = () => (za.call(e, !1), e.embed.pause())),
					(e.media.stop = () => {
						e.pause(), (e.currentTime = 0);
					});
				let { currentTime: h } = e.media;
				Object.defineProperty(e.media, "currentTime", {
					get: () => h,
					set(t) {
						const { embed: i, media: n, paused: s, volume: r } = e,
							a = s && !i.hasPlayed;
						(n.seeking = !0),
							ia.call(e, n, "seeking"),
							Promise.resolve(a && i.setVolume(0))
								.then(() => i.setCurrentTime(t))
								.then(() => a && i.pause())
								.then(() => a && i.setVolume(r))
								.catch(() => {});
					},
				});
				let d = e.config.speed.selected;
				Object.defineProperty(e.media, "playbackRate", {
					get: () => d,
					set(t) {
						e.embed
							.setPlaybackRate(t)
							.then(() => {
								(d = t), ia.call(e, e.media, "ratechange");
							})
							.catch(() => {
								e.options.speed = [1];
							});
					},
				});
				let { volume: p } = e.config;
				Object.defineProperty(e.media, "volume", {
					get: () => p,
					set(t) {
						e.embed.setVolume(t).then(() => {
							(p = t), ia.call(e, e.media, "volumechange");
						});
					},
				});
				let { muted: m } = e.config;
				Object.defineProperty(e.media, "muted", {
					get: () => m,
					set(t) {
						const i = !!br(t) && t;
						e.embed.setVolume(i ? 0 : e.config.volume).then(() => {
							(m = i), ia.call(e, e.media, "volumechange");
						});
					},
				});
				let f,
					{ loop: g } = e.config;
				Object.defineProperty(e.media, "loop", {
					get: () => g,
					set(t) {
						const i = br(t) ? t : e.config.loop.active;
						e.embed.setLoop(i).then(() => {
							g = i;
						});
					},
				}),
					e.embed
						.getVideoUrl()
						.then((t) => {
							(f = t), xa.setDownloadUrl.call(e);
						})
						.catch((e) => {
							this.debug.warn(e);
						}),
					Object.defineProperty(e.media, "currentSrc", { get: () => f }),
					Object.defineProperty(e.media, "ended", {
						get: () => e.currentTime === e.duration,
					}),
					Promise.all([e.embed.getVideoWidth(), e.embed.getVideoHeight()]).then(
						(t) => {
							const [i, n] = t;
							(e.embed.ratio = ma(i, n)), pa.call(this);
						}
					),
					e.embed.setAutopause(e.config.autopause).then((t) => {
						e.config.autopause = t;
					}),
					e.embed.getVideoTitle().then((t) => {
						(e.config.title = t), Ha.setTitle.call(this);
					}),
					e.embed.getCurrentTime().then((t) => {
						(h = t), ia.call(e, e.media, "timeupdate");
					}),
					e.embed.getDuration().then((t) => {
						(e.media.duration = t), ia.call(e, e.media, "durationchange");
					}),
					e.embed.getTextTracks().then((t) => {
						(e.media.textTracks = t), _a.setup.call(e);
					}),
					e.embed.on("cuechange", ({ cues: t = [] }) => {
						const i = t.map((e) =>
							(function (e) {
								const t = document.createDocumentFragment(),
									i = document.createElement("div");
								return (
									t.appendChild(i), (i.innerHTML = e), t.firstChild.innerText
								);
							})(e.text)
						);
						_a.updateCues.call(e, i);
					}),
					e.embed.on("loaded", () => {
						if (
							(e.embed.getPaused().then((t) => {
								za.call(e, !t), t || ia.call(e, e.media, "playing");
							}),
							Tr(e.embed.element) && e.supported.ui)
						) {
							e.embed.element.setAttribute("tabindex", -1);
						}
					}),
					e.embed.on("bufferstart", () => {
						ia.call(e, e.media, "waiting");
					}),
					e.embed.on("bufferend", () => {
						ia.call(e, e.media, "playing");
					}),
					e.embed.on("play", () => {
						za.call(e, !0), ia.call(e, e.media, "playing");
					}),
					e.embed.on("pause", () => {
						za.call(e, !1);
					}),
					e.embed.on("timeupdate", (t) => {
						(e.media.seeking = !1),
							(h = t.seconds),
							ia.call(e, e.media, "timeupdate");
					}),
					e.embed.on("progress", (t) => {
						(e.media.buffered = t.percent),
							ia.call(e, e.media, "progress"),
							1 === parseInt(t.percent, 10) &&
								ia.call(e, e.media, "canplaythrough"),
							e.embed.getDuration().then((t) => {
								t !== e.media.duration &&
									((e.media.duration = t),
									ia.call(e, e.media, "durationchange"));
							});
					}),
					e.embed.on("seeked", () => {
						(e.media.seeking = !1), ia.call(e, e.media, "seeked");
					}),
					e.embed.on("ended", () => {
						(e.media.paused = !0), ia.call(e, e.media, "ended");
					}),
					e.embed.on("error", (t) => {
						(e.media.error = t), ia.call(e, e.media, "error");
					}),
					t.customControls && setTimeout(() => Ha.build.call(e), 0);
			},
		};
		function Ya(e) {
			e && !this.embed.hasPlayed && (this.embed.hasPlayed = !0),
				this.media.paused === e &&
					((this.media.paused = !e),
					ia.call(this, this.media, e ? "play" : "pause"));
		}
		function Ga(e) {
			return e.noCookie
				? "https://www.youtube-nocookie.com"
				: "http:" === window.location.protocol
				? "http://www.youtube.com"
				: void 0;
		}
		const Xa = {
				setup() {
					if (
						(Br(this.elements.wrapper, this.config.classNames.embed, !0),
						fr(window.YT) && vr(window.YT.Player))
					)
						Xa.ready.call(this);
					else {
						const e = window.onYouTubeIframeAPIReady;
						(window.onYouTubeIframeAPIReady = () => {
							vr(e) && e(), Xa.ready.call(this);
						}),
							Wa(this.config.urls.youtube.sdk).catch((e) => {
								this.debug.warn("YouTube API failed to load", e);
							});
					}
				},
				getTitle(e) {
					Ea(ga(this.config.urls.youtube.api, e))
						.then((e) => {
							if (fr(e)) {
								const { title: t, height: i, width: n } = e;
								(this.config.title = t),
									Ha.setTitle.call(this),
									(this.embed.ratio = ma(n, i));
							}
							pa.call(this);
						})
						.catch(() => {
							pa.call(this);
						});
				},
				ready() {
					const e = this,
						t = e.config.youtube,
						i = e.media && e.media.getAttribute("id");
					if (!xr(i) && i.startsWith("youtube-")) return;
					let n = e.media.getAttribute("src");
					xr(n) && (n = e.media.getAttribute(this.config.attributes.embed.id));
					const s = xr((r = n))
						? null
						: r.match(
								/^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|&v=)([^#&?]*).*/
						  )
						? RegExp.$2
						: r;
					var r;
					const a = jr("div", {
						id: `${e.provider}-${Math.floor(1e4 * Math.random())}`,
						"data-poster": t.customControls ? e.poster : void 0,
					});
					if (((e.media = Fr(a, e.media)), t.customControls)) {
						const t = (e) => `https://i.ytimg.com/vi/${s}/${e}default.jpg`;
						Da(t("maxres"), 121)
							.catch(() => Da(t("sd"), 121))
							.catch(() => Da(t("hq")))
							.then((t) => Ha.setPoster.call(e, t.src))
							.then((t) => {
								t.includes("maxres") ||
									(e.elements.poster.style.backgroundSize = "cover");
							})
							.catch(() => {});
					}
					e.embed = new window.YT.Player(e.media, {
						videoId: s,
						host: Ga(t),
						playerVars: Mr(
							{},
							{
								autoplay: e.config.autoplay ? 1 : 0,
								hl: e.config.hl,
								controls: e.supported.ui && t.customControls ? 0 : 1,
								disablekb: 1,
								playsinline: e.config.fullscreen.iosNative ? 0 : 1,
								cc_load_policy: e.captions.active ? 1 : 0,
								cc_lang_pref: e.config.captions.language,
								widget_referrer: window ? window.location.href : null,
							},
							t
						),
						events: {
							onError(t) {
								if (!e.media.error) {
									const i = t.data,
										n =
											{
												2: "The request contains an invalid parameter value. For example, this error occurs if you specify a video ID that does not have 11 characters, or if the video ID contains invalid characters, such as exclamation points or asterisks.",
												5: "The requested content cannot be played in an HTML5 player or another error related to the HTML5 player has occurred.",
												100: "The video requested was not found. This error occurs when a video has been removed (for any reason) or has been marked as private.",
												101: "The owner of the requested video does not allow it to be played in embedded players.",
												150: "The owner of the requested video does not allow it to be played in embedded players.",
											}[i] || "An unknown error occured";
									(e.media.error = { code: i, message: n }),
										ia.call(e, e.media, "error");
								}
							},
							onPlaybackRateChange(t) {
								const i = t.target;
								(e.media.playbackRate = i.getPlaybackRate()),
									ia.call(e, e.media, "ratechange");
							},
							onReady(i) {
								if (vr(e.media.play)) return;
								const n = i.target;
								Xa.getTitle.call(e, s),
									(e.media.play = () => {
										Ya.call(e, !0), n.playVideo();
									}),
									(e.media.pause = () => {
										Ya.call(e, !1), n.pauseVideo();
									}),
									(e.media.stop = () => {
										n.stopVideo();
									}),
									(e.media.duration = n.getDuration()),
									(e.media.paused = !0),
									(e.media.currentTime = 0),
									Object.defineProperty(e.media, "currentTime", {
										get: () => Number(n.getCurrentTime()),
										set(t) {
											e.paused && !e.embed.hasPlayed && e.embed.mute(),
												(e.media.seeking = !0),
												ia.call(e, e.media, "seeking"),
												n.seekTo(t);
										},
									}),
									Object.defineProperty(e.media, "playbackRate", {
										get: () => n.getPlaybackRate(),
										set(e) {
											n.setPlaybackRate(e);
										},
									});
								let { volume: r } = e.config;
								Object.defineProperty(e.media, "volume", {
									get: () => r,
									set(t) {
										(r = t),
											n.setVolume(100 * r),
											ia.call(e, e.media, "volumechange");
									},
								});
								let { muted: a } = e.config;
								Object.defineProperty(e.media, "muted", {
									get: () => a,
									set(t) {
										const i = br(t) ? t : a;
										(a = i),
											n[i ? "mute" : "unMute"](),
											n.setVolume(100 * r),
											ia.call(e, e.media, "volumechange");
									},
								}),
									Object.defineProperty(e.media, "currentSrc", {
										get: () => n.getVideoUrl(),
									}),
									Object.defineProperty(e.media, "ended", {
										get: () => e.currentTime === e.duration,
									});
								const o = n.getAvailablePlaybackRates();
								(e.options.speed = o.filter((t) =>
									e.config.speed.options.includes(t)
								)),
									e.supported.ui &&
										t.customControls &&
										e.media.setAttribute("tabindex", -1),
									ia.call(e, e.media, "timeupdate"),
									ia.call(e, e.media, "durationchange"),
									clearInterval(e.timers.buffering),
									(e.timers.buffering = setInterval(() => {
										(e.media.buffered = n.getVideoLoadedFraction()),
											(null === e.media.lastBuffered ||
												e.media.lastBuffered < e.media.buffered) &&
												ia.call(e, e.media, "progress"),
											(e.media.lastBuffered = e.media.buffered),
											1 === e.media.buffered &&
												(clearInterval(e.timers.buffering),
												ia.call(e, e.media, "canplaythrough"));
									}, 200)),
									t.customControls && setTimeout(() => Ha.build.call(e), 50);
							},
							onStateChange(i) {
								const n = i.target;
								clearInterval(e.timers.playing);
								switch (
									(e.media.seeking &&
										[1, 2].includes(i.data) &&
										((e.media.seeking = !1), ia.call(e, e.media, "seeked")),
									i.data)
								) {
									case -1:
										ia.call(e, e.media, "timeupdate"),
											(e.media.buffered = n.getVideoLoadedFraction()),
											ia.call(e, e.media, "progress");
										break;
									case 0:
										Ya.call(e, !1),
											e.media.loop
												? (n.stopVideo(), n.playVideo())
												: ia.call(e, e.media, "ended");
										break;
									case 1:
										t.customControls &&
										!e.config.autoplay &&
										e.media.paused &&
										!e.embed.hasPlayed
											? e.media.pause()
											: (Ya.call(e, !0),
											  ia.call(e, e.media, "playing"),
											  (e.timers.playing = setInterval(() => {
													ia.call(e, e.media, "timeupdate");
											  }, 50)),
											  e.media.duration !== n.getDuration() &&
													((e.media.duration = n.getDuration()),
													ia.call(e, e.media, "durationchange")));
										break;
									case 2:
										e.muted || e.embed.unMute(), Ya.call(e, !1);
										break;
									case 3:
										ia.call(e, e.media, "waiting");
								}
								ia.call(e, e.elements.container, "statechange", !1, {
									code: i.data,
								});
							},
						},
					});
				},
			},
			Qa = {
				setup() {
					this.media
						? (Br(
								this.elements.container,
								this.config.classNames.type.replace("{0}", this.type),
								!0
						  ),
						  Br(
								this.elements.container,
								this.config.classNames.provider.replace("{0}", this.provider),
								!0
						  ),
						  this.isEmbed &&
								Br(
									this.elements.container,
									this.config.classNames.type.replace("{0}", "video"),
									!0
								),
						  this.isVideo &&
								((this.elements.wrapper = jr("div", {
									class: this.config.classNames.video,
								})),
								Nr(this.media, this.elements.wrapper),
								(this.elements.poster = jr("div", {
									class: this.config.classNames.poster,
								})),
								this.elements.wrapper.appendChild(this.elements.poster)),
						  this.isHTML5
								? fa.setup.call(this)
								: this.isYouTube
								? Xa.setup.call(this)
								: this.isVimeo && Ka.setup.call(this))
						: this.debug.warn("No media element found!");
				},
			};
		class Ja {
			constructor(e) {
				$s(this, "load", () => {
					this.enabled &&
						(fr(window.google) && fr(window.google.ima)
							? this.ready()
							: Wa(this.player.config.urls.googleIMA.sdk)
									.then(() => {
										this.ready();
									})
									.catch(() => {
										this.trigger(
											"error",
											new Error("Google IMA SDK failed to load")
										);
									}));
				}),
					$s(this, "ready", () => {
						var e;
						this.enabled ||
							((e = this).manager && e.manager.destroy(),
							e.elements.displayContainer &&
								e.elements.displayContainer.destroy(),
							e.elements.container.remove()),
							this.startSafetyTimer(12e3, "ready()"),
							this.managerPromise.then(() => {
								this.clearSafetyTimer("onAdsManagerLoaded()");
							}),
							this.listeners(),
							this.setupIMA();
					}),
					$s(this, "setupIMA", () => {
						(this.elements.container = jr("div", {
							class: this.player.config.classNames.ads,
						})),
							this.player.elements.container.appendChild(
								this.elements.container
							),
							google.ima.settings.setVpaidMode(
								google.ima.ImaSdkSettings.VpaidMode.ENABLED
							),
							google.ima.settings.setLocale(this.player.config.ads.language),
							google.ima.settings.setDisableCustomPlaybackForIOS10Plus(
								this.player.config.playsinline
							),
							(this.elements.displayContainer =
								new google.ima.AdDisplayContainer(
									this.elements.container,
									this.player.media
								)),
							(this.loader = new google.ima.AdsLoader(
								this.elements.displayContainer
							)),
							this.loader.addEventListener(
								google.ima.AdsManagerLoadedEvent.Type.ADS_MANAGER_LOADED,
								(e) => this.onAdsManagerLoaded(e),
								!1
							),
							this.loader.addEventListener(
								google.ima.AdErrorEvent.Type.AD_ERROR,
								(e) => this.onAdError(e),
								!1
							),
							this.requestAds();
					}),
					$s(this, "requestAds", () => {
						const { container: e } = this.player.elements;
						try {
							const t = new google.ima.AdsRequest();
							(t.adTagUrl = this.tagUrl),
								(t.linearAdSlotWidth = e.offsetWidth),
								(t.linearAdSlotHeight = e.offsetHeight),
								(t.nonLinearAdSlotWidth = e.offsetWidth),
								(t.nonLinearAdSlotHeight = e.offsetHeight),
								(t.forceNonLinearFullSlot = !1),
								t.setAdWillPlayMuted(!this.player.muted),
								this.loader.requestAds(t);
						} catch (e) {
							this.onAdError(e);
						}
					}),
					$s(this, "pollCountdown", (e = !1) => {
						if (!e)
							return (
								clearInterval(this.countdownTimer),
								void this.elements.container.removeAttribute("data-badge-text")
							);
						this.countdownTimer = setInterval(() => {
							const e = Pa(Math.max(this.manager.getRemainingTime(), 0)),
								t = `${Ta.get("advertisement", this.player.config)} - ${e}`;
							this.elements.container.setAttribute("data-badge-text", t);
						}, 100);
					}),
					$s(this, "onAdsManagerLoaded", (e) => {
						if (!this.enabled) return;
						const t = new google.ima.AdsRenderingSettings();
						(t.restoreCustomPlaybackStateOnAdBreakComplete = !0),
							(t.enablePreloading = !0),
							(this.manager = e.getAdsManager(this.player, t)),
							(this.cuePoints = this.manager.getCuePoints()),
							this.manager.addEventListener(
								google.ima.AdErrorEvent.Type.AD_ERROR,
								(e) => this.onAdError(e)
							),
							Object.keys(google.ima.AdEvent.Type).forEach((e) => {
								this.manager.addEventListener(google.ima.AdEvent.Type[e], (e) =>
									this.onAdEvent(e)
								);
							}),
							this.trigger("loaded");
					}),
					$s(this, "addCuePoints", () => {
						xr(this.cuePoints) ||
							this.cuePoints.forEach((e) => {
								if (0 !== e && -1 !== e && e < this.player.duration) {
									const t = this.player.elements.progress;
									if (Tr(t)) {
										const i = (100 / this.player.duration) * e,
											n = jr("span", {
												class: this.player.config.classNames.cues,
											});
										(n.style.left = `${i.toString()}%`), t.appendChild(n);
									}
								}
							});
					}),
					$s(this, "onAdEvent", (e) => {
						const { container: t } = this.player.elements,
							i = e.getAd(),
							n = e.getAdData();
						switch (
							(((e) => {
								ia.call(
									this.player,
									this.player.media,
									`ads${e.replace(/_/g, "").toLowerCase()}`
								);
							})(e.type),
							e.type)
						) {
							case google.ima.AdEvent.Type.LOADED:
								this.trigger("loaded"),
									this.pollCountdown(!0),
									i.isLinear() ||
										((i.width = t.offsetWidth), (i.height = t.offsetHeight));
								break;
							case google.ima.AdEvent.Type.STARTED:
								this.manager.setVolume(this.player.volume);
								break;
							case google.ima.AdEvent.Type.ALL_ADS_COMPLETED:
								this.player.ended
									? this.loadAds()
									: this.loader.contentComplete();
								break;
							case google.ima.AdEvent.Type.CONTENT_PAUSE_REQUESTED:
								this.pauseContent();
								break;
							case google.ima.AdEvent.Type.CONTENT_RESUME_REQUESTED:
								this.pollCountdown(), this.resumeContent();
								break;
							case google.ima.AdEvent.Type.LOG:
								n.adError &&
									this.player.debug.warn(
										`Non-fatal ad error: ${n.adError.getMessage()}`
									);
						}
					}),
					$s(this, "onAdError", (e) => {
						this.cancel(), this.player.debug.warn("Ads error", e);
					}),
					$s(this, "listeners", () => {
						const { container: e } = this.player.elements;
						let t;
						this.player.on("canplay", () => {
							this.addCuePoints();
						}),
							this.player.on("ended", () => {
								this.loader.contentComplete();
							}),
							this.player.on("timeupdate", () => {
								t = this.player.currentTime;
							}),
							this.player.on("seeked", () => {
								const e = this.player.currentTime;
								xr(this.cuePoints) ||
									this.cuePoints.forEach((i, n) => {
										t < i &&
											i < e &&
											(this.manager.discardAdBreak(),
											this.cuePoints.splice(n, 1));
									});
							}),
							window.addEventListener("resize", () => {
								this.manager &&
									this.manager.resize(
										e.offsetWidth,
										e.offsetHeight,
										google.ima.ViewMode.NORMAL
									);
							});
					}),
					$s(this, "play", () => {
						const { container: e } = this.player.elements;
						this.managerPromise || this.resumeContent(),
							this.managerPromise
								.then(() => {
									this.manager.setVolume(this.player.volume),
										this.elements.displayContainer.initialize();
									try {
										this.initialized ||
											(this.manager.init(
												e.offsetWidth,
												e.offsetHeight,
												google.ima.ViewMode.NORMAL
											),
											this.manager.start()),
											(this.initialized = !0);
									} catch (e) {
										this.onAdError(e);
									}
								})
								.catch(() => {});
					}),
					$s(this, "resumeContent", () => {
						(this.elements.container.style.zIndex = ""),
							(this.playing = !1),
							ra(this.player.media.play());
					}),
					$s(this, "pauseContent", () => {
						(this.elements.container.style.zIndex = 3),
							(this.playing = !0),
							this.player.media.pause();
					}),
					$s(this, "cancel", () => {
						this.initialized && this.resumeContent(),
							this.trigger("error"),
							this.loadAds();
					}),
					$s(this, "loadAds", () => {
						this.managerPromise
							.then(() => {
								this.manager && this.manager.destroy(),
									(this.managerPromise = new Promise((e) => {
										this.on("loaded", e), this.player.debug.log(this.manager);
									})),
									(this.initialized = !1),
									this.requestAds();
							})
							.catch(() => {});
					}),
					$s(this, "trigger", (e, ...t) => {
						const i = this.events[e];
						wr(i) &&
							i.forEach((e) => {
								vr(e) && e.apply(this, t);
							});
					}),
					$s(
						this,
						"on",
						(e, t) => (
							wr(this.events[e]) || (this.events[e] = []),
							this.events[e].push(t),
							this
						)
					),
					$s(this, "startSafetyTimer", (e, t) => {
						this.player.debug.log(`Safety timer invoked from: ${t}`),
							(this.safetyTimer = setTimeout(() => {
								this.cancel(), this.clearSafetyTimer("startSafetyTimer()");
							}, e));
					}),
					$s(this, "clearSafetyTimer", (e) => {
						mr(this.safetyTimer) ||
							(this.player.debug.log(`Safety timer cleared from: ${e}`),
							clearTimeout(this.safetyTimer),
							(this.safetyTimer = null));
					}),
					(this.player = e),
					(this.config = e.config.ads),
					(this.playing = !1),
					(this.initialized = !1),
					(this.elements = { container: null, displayContainer: null }),
					(this.manager = null),
					(this.loader = null),
					(this.cuePoints = null),
					(this.events = {}),
					(this.safetyTimer = null),
					(this.countdownTimer = null),
					(this.managerPromise = new Promise((e, t) => {
						this.on("loaded", e), this.on("error", t);
					})),
					this.load();
			}
			get enabled() {
				const { config: e } = this;
				return (
					this.player.isHTML5 &&
					this.player.isVideo &&
					e.enabled &&
					(!xr(e.publisherId) || Pr(e.tagUrl))
				);
			}
			get tagUrl() {
				const { config: e } = this;
				if (Pr(e.tagUrl)) return e.tagUrl;
				return `https://go.aniview.com/api/adserver6/vast/?${Ia({
					AV_PUBLISHERID: "58c25bb0073ef448b1087ad6",
					AV_CHANNELID: "5a0458dc28a06145e4519d21",
					AV_URL: window.location.hostname,
					cb: Date.now(),
					AV_WIDTH: 640,
					AV_HEIGHT: 480,
					AV_CDIM2: e.publisherId,
				})}`;
			}
		}
		const Za = (e) => {
				const t = [];
				return (
					e.split(/\r\n\r\n|\n\n|\r\r/).forEach((e) => {
						const i = {};
						e.split(/\r\n|\n|\r/).forEach((e) => {
							if (gr(i.startTime)) {
								if (!xr(e.trim()) && xr(i.text)) {
									const t = e.trim().split("#xywh=");
									([i.text] = t),
										t[1] && ([i.x, i.y, i.w, i.h] = t[1].split(","));
								}
							} else {
								const t = e.match(
									/([0-9]{2})?:?([0-9]{2}):([0-9]{2}).([0-9]{2,3})( ?--> ?)([0-9]{2})?:?([0-9]{2}):([0-9]{2}).([0-9]{2,3})/
								);
								t &&
									((i.startTime =
										60 * Number(t[1] || 0) * 60 +
										60 * Number(t[2]) +
										Number(t[3]) +
										Number(`0.${t[4]}`)),
									(i.endTime =
										60 * Number(t[6] || 0) * 60 +
										60 * Number(t[7]) +
										Number(t[8]) +
										Number(`0.${t[9]}`)));
							}
						}),
							i.text && t.push(i);
					}),
					t
				);
			},
			eo = (e, t) => {
				const i = {};
				return (
					e > t.width / t.height
						? ((i.width = t.width), (i.height = (1 / e) * t.width))
						: ((i.height = t.height), (i.width = e * t.height)),
					i
				);
			};
		class to {
			constructor(e) {
				$s(this, "load", () => {
					this.player.elements.display.seekTooltip &&
						(this.player.elements.display.seekTooltip.hidden = this.enabled),
						this.enabled &&
							this.getThumbnails().then(() => {
								this.enabled &&
									(this.render(),
									this.determineContainerAutoSizing(),
									(this.loaded = !0));
							});
				}),
					$s(
						this,
						"getThumbnails",
						() =>
							new Promise((e) => {
								const { src: t } = this.player.config.previewThumbnails;
								if (xr(t))
									throw new Error(
										"Missing previewThumbnails.src config attribute"
									);
								const i = () => {
									this.thumbnails.sort((e, t) => e.height - t.height),
										this.player.debug.log(
											"Preview thumbnails",
											this.thumbnails
										),
										e();
								};
								if (vr(t))
									t((e) => {
										(this.thumbnails = e), i();
									});
								else {
									const e = (yr(t) ? [t] : t).map((e) => this.getThumbnail(e));
									Promise.all(e).then(i);
								}
							})
					),
					$s(
						this,
						"getThumbnail",
						(e) =>
							new Promise((t) => {
								Ea(e).then((i) => {
									const n = { frames: Za(i), height: null, urlPrefix: "" };
									n.frames[0].text.startsWith("/") ||
										n.frames[0].text.startsWith("http://") ||
										n.frames[0].text.startsWith("https://") ||
										(n.urlPrefix = e.substring(0, e.lastIndexOf("/") + 1));
									const s = new Image();
									(s.onload = () => {
										(n.height = s.naturalHeight),
											(n.width = s.naturalWidth),
											this.thumbnails.push(n),
											t();
									}),
										(s.src = n.urlPrefix + n.frames[0].text);
								});
							})
					),
					$s(this, "startMove", (e) => {
						if (
							this.loaded &&
							Sr(e) &&
							["touchmove", "mousemove"].includes(e.type) &&
							this.player.media.duration
						) {
							if ("touchmove" === e.type)
								this.seekTime =
									this.player.media.duration *
									(this.player.elements.inputs.seek.value / 100);
							else {
								const t = this.player.elements.progress.getBoundingClientRect(),
									i = (100 / t.width) * (e.pageX - t.left);
								(this.seekTime = this.player.media.duration * (i / 100)),
									this.seekTime < 0 && (this.seekTime = 0),
									this.seekTime > this.player.media.duration - 1 &&
										(this.seekTime = this.player.media.duration - 1),
									(this.mousePosX = e.pageX),
									(this.elements.thumb.time.innerText = Pa(this.seekTime));
							}
							this.showImageAtCurrentTime();
						}
					}),
					$s(this, "endMove", () => {
						this.toggleThumbContainer(!1, !0);
					}),
					$s(this, "startScrubbing", (e) => {
						(mr(e.button) || !1 === e.button || 0 === e.button) &&
							((this.mouseDown = !0),
							this.player.media.duration &&
								(this.toggleScrubbingContainer(!0),
								this.toggleThumbContainer(!1, !0),
								this.showImageAtCurrentTime()));
					}),
					$s(this, "endScrubbing", () => {
						(this.mouseDown = !1),
							Math.ceil(this.lastTime) ===
							Math.ceil(this.player.media.currentTime)
								? this.toggleScrubbingContainer(!1)
								: ta.call(this.player, this.player.media, "timeupdate", () => {
										this.mouseDown || this.toggleScrubbingContainer(!1);
								  });
					}),
					$s(this, "listeners", () => {
						this.player.on("play", () => {
							this.toggleThumbContainer(!1, !0);
						}),
							this.player.on("seeked", () => {
								this.toggleThumbContainer(!1);
							}),
							this.player.on("timeupdate", () => {
								this.lastTime = this.player.media.currentTime;
							});
					}),
					$s(this, "render", () => {
						(this.elements.thumb.container = jr("div", {
							class:
								this.player.config.classNames.previewThumbnails.thumbContainer,
						})),
							(this.elements.thumb.imageContainer = jr("div", {
								class:
									this.player.config.classNames.previewThumbnails
										.imageContainer,
							})),
							this.elements.thumb.container.appendChild(
								this.elements.thumb.imageContainer
							);
						const e = jr("div", {
							class:
								this.player.config.classNames.previewThumbnails.timeContainer,
						});
						(this.elements.thumb.time = jr("span", {}, "00:00")),
							e.appendChild(this.elements.thumb.time),
							this.elements.thumb.container.appendChild(e),
							Tr(this.player.elements.progress) &&
								this.player.elements.progress.appendChild(
									this.elements.thumb.container
								),
							(this.elements.scrubbing.container = jr("div", {
								class:
									this.player.config.classNames.previewThumbnails
										.scrubbingContainer,
							})),
							this.player.elements.wrapper.appendChild(
								this.elements.scrubbing.container
							);
					}),
					$s(this, "destroy", () => {
						this.elements.thumb.container &&
							this.elements.thumb.container.remove(),
							this.elements.scrubbing.container &&
								this.elements.scrubbing.container.remove();
					}),
					$s(this, "showImageAtCurrentTime", () => {
						this.mouseDown
							? this.setScrubbingContainerSize()
							: this.setThumbContainerSizeAndPos();
						const e = this.thumbnails[0].frames.findIndex(
								(e) =>
									this.seekTime >= e.startTime && this.seekTime <= e.endTime
							),
							t = e >= 0;
						let i = 0;
						this.mouseDown || this.toggleThumbContainer(t),
							t &&
								(this.thumbnails.forEach((t, n) => {
									this.loadedImages.includes(t.frames[e].text) && (i = n);
								}),
								e !== this.showingThumb &&
									((this.showingThumb = e), this.loadImage(i)));
					}),
					$s(this, "loadImage", (e = 0) => {
						const t = this.showingThumb,
							i = this.thumbnails[e],
							{ urlPrefix: n } = i,
							s = i.frames[t],
							r = i.frames[t].text,
							a = n + r;
						if (
							this.currentImageElement &&
							this.currentImageElement.dataset.filename === r
						)
							this.showImage(this.currentImageElement, s, e, t, r, !1),
								(this.currentImageElement.dataset.index = t),
								this.removeOldImages(this.currentImageElement);
						else {
							this.loadingImage &&
								this.usingSprites &&
								(this.loadingImage.onload = null);
							const i = new Image();
							(i.src = a),
								(i.dataset.index = t),
								(i.dataset.filename = r),
								(this.showingThumbFilename = r),
								this.player.debug.log(`Loading image: ${a}`),
								(i.onload = () => this.showImage(i, s, e, t, r, !0)),
								(this.loadingImage = i),
								this.removeOldImages(i);
						}
					}),
					$s(this, "showImage", (e, t, i, n, s, r = !0) => {
						this.player.debug.log(
							`Showing thumb: ${s}. num: ${n}. qual: ${i}. newimg: ${r}`
						),
							this.setImageSizeAndOffset(e, t),
							r &&
								(this.currentImageContainer.appendChild(e),
								(this.currentImageElement = e),
								this.loadedImages.includes(s) || this.loadedImages.push(s)),
							this.preloadNearby(n, !0)
								.then(this.preloadNearby(n, !1))
								.then(this.getHigherQuality(i, e, t, s));
					}),
					$s(this, "removeOldImages", (e) => {
						Array.from(this.currentImageContainer.children).forEach((t) => {
							if ("img" !== t.tagName.toLowerCase()) return;
							const i = this.usingSprites ? 500 : 1e3;
							if (t.dataset.index !== e.dataset.index && !t.dataset.deleting) {
								t.dataset.deleting = !0;
								const { currentImageContainer: e } = this;
								setTimeout(() => {
									e.removeChild(t),
										this.player.debug.log(
											`Removing thumb: ${t.dataset.filename}`
										);
								}, i);
							}
						});
					}),
					$s(
						this,
						"preloadNearby",
						(e, t = !0) =>
							new Promise((i) => {
								setTimeout(() => {
									const n = this.thumbnails[0].frames[e].text;
									if (this.showingThumbFilename === n) {
										let s;
										s = t
											? this.thumbnails[0].frames.slice(e)
											: this.thumbnails[0].frames.slice(0, e).reverse();
										let r = !1;
										s.forEach((e) => {
											const t = e.text;
											if (t !== n && !this.loadedImages.includes(t)) {
												(r = !0),
													this.player.debug.log(
														`Preloading thumb filename: ${t}`
													);
												const { urlPrefix: e } = this.thumbnails[0],
													n = e + t,
													s = new Image();
												(s.src = n),
													(s.onload = () => {
														this.player.debug.log(
															`Preloaded thumb filename: ${t}`
														),
															this.loadedImages.includes(t) ||
																this.loadedImages.push(t),
															i();
													});
											}
										}),
											r || i();
									}
								}, 300);
							})
					),
					$s(this, "getHigherQuality", (e, t, i, n) => {
						if (e < this.thumbnails.length - 1) {
							let s = t.naturalHeight;
							this.usingSprites && (s = i.h),
								s < this.thumbContainerHeight &&
									setTimeout(() => {
										this.showingThumbFilename === n &&
											(this.player.debug.log(
												`Showing higher quality thumb for: ${n}`
											),
											this.loadImage(e + 1));
									}, 300);
						}
					}),
					$s(this, "toggleThumbContainer", (e = !1, t = !1) => {
						const i =
							this.player.config.classNames.previewThumbnails
								.thumbContainerShown;
						this.elements.thumb.container.classList.toggle(i, e),
							!e &&
								t &&
								((this.showingThumb = null),
								(this.showingThumbFilename = null));
					}),
					$s(this, "toggleScrubbingContainer", (e = !1) => {
						const t =
							this.player.config.classNames.previewThumbnails
								.scrubbingContainerShown;
						this.elements.scrubbing.container.classList.toggle(t, e),
							e ||
								((this.showingThumb = null),
								(this.showingThumbFilename = null));
					}),
					$s(this, "determineContainerAutoSizing", () => {
						(this.elements.thumb.imageContainer.clientHeight > 20 ||
							this.elements.thumb.imageContainer.clientWidth > 20) &&
							(this.sizeSpecifiedInCSS = !0);
					}),
					$s(this, "setThumbContainerSizeAndPos", () => {
						if (this.sizeSpecifiedInCSS) {
							if (
								this.elements.thumb.imageContainer.clientHeight > 20 &&
								this.elements.thumb.imageContainer.clientWidth < 20
							) {
								const e = Math.floor(
									this.elements.thumb.imageContainer.clientHeight *
										this.thumbAspectRatio
								);
								this.elements.thumb.imageContainer.style.width = `${e}px`;
							} else if (
								this.elements.thumb.imageContainer.clientHeight < 20 &&
								this.elements.thumb.imageContainer.clientWidth > 20
							) {
								const e = Math.floor(
									this.elements.thumb.imageContainer.clientWidth /
										this.thumbAspectRatio
								);
								this.elements.thumb.imageContainer.style.height = `${e}px`;
							}
						} else {
							const e = Math.floor(
								this.thumbContainerHeight * this.thumbAspectRatio
							);
							(this.elements.thumb.imageContainer.style.height = `${this.thumbContainerHeight}px`),
								(this.elements.thumb.imageContainer.style.width = `${e}px`);
						}
						this.setThumbContainerPos();
					}),
					$s(this, "setThumbContainerPos", () => {
						const e = this.player.elements.progress.getBoundingClientRect(),
							t = this.player.elements.container.getBoundingClientRect(),
							{ container: i } = this.elements.thumb,
							n = t.left - e.left + 10,
							s = t.right - e.left - i.clientWidth - 10;
						let r = this.mousePosX - e.left - i.clientWidth / 2;
						r < n && (r = n), r > s && (r = s), (i.style.left = `${r}px`);
					}),
					$s(this, "setScrubbingContainerSize", () => {
						const { width: e, height: t } = eo(this.thumbAspectRatio, {
							width: this.player.media.clientWidth,
							height: this.player.media.clientHeight,
						});
						(this.elements.scrubbing.container.style.width = `${e}px`),
							(this.elements.scrubbing.container.style.height = `${t}px`);
					}),
					$s(this, "setImageSizeAndOffset", (e, t) => {
						if (!this.usingSprites) return;
						const i = this.thumbContainerHeight / t.h;
						(e.style.height = e.naturalHeight * i + "px"),
							(e.style.width = e.naturalWidth * i + "px"),
							(e.style.left = `-${t.x * i}px`),
							(e.style.top = `-${t.y * i}px`);
					}),
					(this.player = e),
					(this.thumbnails = []),
					(this.loaded = !1),
					(this.lastMouseMoveTime = Date.now()),
					(this.mouseDown = !1),
					(this.loadedImages = []),
					(this.elements = { thumb: {}, scrubbing: {} }),
					this.load();
			}
			get enabled() {
				return (
					this.player.isHTML5 &&
					this.player.isVideo &&
					this.player.config.previewThumbnails.enabled
				);
			}
			get currentImageContainer() {
				return this.mouseDown
					? this.elements.scrubbing.container
					: this.elements.thumb.imageContainer;
			}
			get usingSprites() {
				return Object.keys(this.thumbnails[0].frames[0]).includes("w");
			}
			get thumbAspectRatio() {
				return this.usingSprites
					? this.thumbnails[0].frames[0].w / this.thumbnails[0].frames[0].h
					: this.thumbnails[0].width / this.thumbnails[0].height;
			}
			get thumbContainerHeight() {
				if (this.mouseDown) {
					const { height: e } = eo(this.thumbAspectRatio, {
						width: this.player.media.clientWidth,
						height: this.player.media.clientHeight,
					});
					return e;
				}
				return this.sizeSpecifiedInCSS
					? this.elements.thumb.imageContainer.clientHeight
					: Math.floor(
							this.player.media.clientWidth / this.thumbAspectRatio / 4
					  );
			}
			get currentImageElement() {
				return this.mouseDown
					? this.currentScrubbingImageElement
					: this.currentThumbnailImageElement;
			}
			set currentImageElement(e) {
				this.mouseDown
					? (this.currentScrubbingImageElement = e)
					: (this.currentThumbnailImageElement = e);
			}
		}
		const io = {
			insertElements(e, t) {
				yr(t)
					? $r(e, this.media, { src: t })
					: wr(t) &&
					  t.forEach((t) => {
							$r(e, this.media, t);
					  });
			},
			change(e) {
				Or(e, "sources.length")
					? (fa.cancelRequests.call(this),
					  this.destroy.call(
							this,
							() => {
								(this.options.quality = []),
									Ur(this.media),
									(this.media = null),
									Tr(this.elements.container) &&
										this.elements.container.removeAttribute("class");
								const { sources: t, type: i } = e,
									[{ provider: n = Ra.html5, src: s }] = t,
									r = "html5" === n ? i : "div",
									a = "html5" === n ? {} : { src: s };
								Object.assign(this, {
									provider: n,
									type: i,
									supported: Xr.check(i, n, this.config.playsinline),
									media: jr(r, a),
								}),
									this.elements.container.appendChild(this.media),
									br(e.autoplay) && (this.config.autoplay = e.autoplay),
									this.isHTML5 &&
										(this.config.crossorigin &&
											this.media.setAttribute("crossorigin", ""),
										this.config.autoplay &&
											this.media.setAttribute("autoplay", ""),
										xr(e.poster) || (this.poster = e.poster),
										this.config.loop.active &&
											this.media.setAttribute("loop", ""),
										this.config.muted && this.media.setAttribute("muted", ""),
										this.config.playsinline &&
											this.media.setAttribute("playsinline", "")),
									Ha.addStyleHook.call(this),
									this.isHTML5 && io.insertElements.call(this, "source", t),
									(this.config.title = e.title),
									Qa.setup.call(this),
									this.isHTML5 &&
										Object.keys(e).includes("tracks") &&
										io.insertElements.call(this, "track", e.tracks),
									(this.isHTML5 || (this.isEmbed && !this.supported.ui)) &&
										Ha.build.call(this),
									this.isHTML5 && this.media.load(),
									xr(e.previewThumbnails) ||
										(Object.assign(
											this.config.previewThumbnails,
											e.previewThumbnails
										),
										this.previewThumbnails &&
											this.previewThumbnails.loaded &&
											(this.previewThumbnails.destroy(),
											(this.previewThumbnails = null)),
										this.config.previewThumbnails.enabled &&
											(this.previewThumbnails = new to(this))),
									this.fullscreen.update();
							},
							!0
					  ))
					: this.debug.warn("Invalid source format");
			},
		};
		class no {
			constructor(e, t) {
				if (
					($s(this, "play", () =>
						vr(this.media.play)
							? (this.ads &&
									this.ads.enabled &&
									this.ads.managerPromise
										.then(() => this.ads.play())
										.catch(() => ra(this.media.play())),
							  this.media.play())
							: null
					),
					$s(this, "pause", () =>
						this.playing && vr(this.media.pause) ? this.media.pause() : null
					),
					$s(this, "togglePlay", (e) =>
						(br(e) ? e : !this.playing) ? this.play() : this.pause()
					),
					$s(this, "stop", () => {
						this.isHTML5
							? (this.pause(), this.restart())
							: vr(this.media.stop) && this.media.stop();
					}),
					$s(this, "restart", () => {
						this.currentTime = 0;
					}),
					$s(this, "rewind", (e) => {
						this.currentTime -= gr(e) ? e : this.config.seekTime;
					}),
					$s(this, "forward", (e) => {
						this.currentTime += gr(e) ? e : this.config.seekTime;
					}),
					$s(this, "increaseVolume", (e) => {
						const t = this.media.muted ? 0 : this.volume;
						this.volume = t + (gr(e) ? e : 0);
					}),
					$s(this, "decreaseVolume", (e) => {
						this.increaseVolume(-e);
					}),
					$s(this, "airplay", () => {
						Xr.airplay && this.media.webkitShowPlaybackTargetPicker();
					}),
					$s(this, "toggleControls", (e) => {
						if (this.supported.ui && !this.isAudio) {
							const t = Vr(
									this.elements.container,
									this.config.classNames.hideControls
								),
								i = void 0 === e ? void 0 : !e,
								n = Br(
									this.elements.container,
									this.config.classNames.hideControls,
									i
								);
							if (
								(n &&
									wr(this.config.controls) &&
									this.config.controls.includes("settings") &&
									!xr(this.config.settings) &&
									xa.toggleMenu.call(this, !1),
								n !== t)
							) {
								const e = n ? "controlshidden" : "controlsshown";
								ia.call(this, this.media, e);
							}
							return !n;
						}
						return !1;
					}),
					$s(this, "on", (e, t) => {
						Zr.call(this, this.elements.container, e, t);
					}),
					$s(this, "once", (e, t) => {
						ta.call(this, this.elements.container, e, t);
					}),
					$s(this, "off", (e, t) => {
						ea(this.elements.container, e, t);
					}),
					$s(this, "destroy", (e, t = !1) => {
						if (!this.ready) return;
						const i = () => {
							(document.body.style.overflow = ""),
								(this.embed = null),
								t
									? (Object.keys(this.elements).length &&
											(Ur(this.elements.buttons.play),
											Ur(this.elements.captions),
											Ur(this.elements.controls),
											Ur(this.elements.wrapper),
											(this.elements.buttons.play = null),
											(this.elements.captions = null),
											(this.elements.controls = null),
											(this.elements.wrapper = null)),
									  vr(e) && e())
									: (na.call(this),
									  fa.cancelRequests.call(this),
									  Fr(this.elements.original, this.elements.container),
									  ia.call(this, this.elements.original, "destroyed", !0),
									  vr(e) && e.call(this.elements.original),
									  (this.ready = !1),
									  setTimeout(() => {
											(this.elements = null), (this.media = null);
									  }, 200));
						};
						this.stop(),
							clearTimeout(this.timers.loading),
							clearTimeout(this.timers.controls),
							clearTimeout(this.timers.resized),
							this.isHTML5
								? (Ha.toggleNativeControls.call(this, !0), i())
								: this.isYouTube
								? (clearInterval(this.timers.buffering),
								  clearInterval(this.timers.playing),
								  null !== this.embed &&
										vr(this.embed.destroy) &&
										this.embed.destroy(),
								  i())
								: this.isVimeo &&
								  (null !== this.embed && this.embed.unload().then(i),
								  setTimeout(i, 200));
					}),
					$s(this, "supports", (e) => Xr.mime.call(this, e)),
					(this.timers = {}),
					(this.ready = !1),
					(this.loading = !1),
					(this.failed = !1),
					(this.touch = Xr.touch),
					(this.media = e),
					yr(this.media) &&
						(this.media = document.querySelectorAll(this.media)),
					((window.jQuery && this.media instanceof jQuery) ||
						kr(this.media) ||
						wr(this.media)) &&
						(this.media = this.media[0]),
					(this.config = Mr(
						{},
						Oa,
						no.defaults,
						t || {},
						(() => {
							try {
								return JSON.parse(this.media.getAttribute("data-plyr-config"));
							} catch (e) {
								return {};
							}
						})()
					)),
					(this.elements = {
						container: null,
						fullscreen: null,
						captions: null,
						buttons: {},
						display: {},
						progress: {},
						inputs: {},
						settings: { popup: null, menu: null, panels: {}, buttons: {} },
					}),
					(this.captions = {
						active: null,
						currentTrack: -1,
						meta: new WeakMap(),
					}),
					(this.fullscreen = { active: !1 }),
					(this.options = { speed: [], quality: [] }),
					(this.debug = new qa(this.config.debug)),
					this.debug.log("Config", this.config),
					this.debug.log("Support", Xr),
					mr(this.media) || !Tr(this.media))
				)
					return void this.debug.error(
						"Setup failed: no suitable element passed"
					);
				if (this.media.plyr)
					return void this.debug.warn("Target already setup");
				if (!this.config.enabled)
					return void this.debug.error("Setup failed: disabled by config");
				if (!Xr.check().api)
					return void this.debug.error("Setup failed: no support");
				const i = this.media.cloneNode(!0);
				(i.autoplay = !1), (this.elements.original = i);
				const n = this.media.tagName.toLowerCase();
				let s = null,
					r = null;
				switch (n) {
					case "div":
						if (((s = this.media.querySelector("iframe")), Tr(s))) {
							if (
								((r = La(s.getAttribute("src"))),
								(this.provider = (function (e) {
									return /^(https?:\/\/)?(www\.)?(youtube\.com|youtube-nocookie\.com|youtu\.?be)\/.+$/.test(
										e
									)
										? Ra.youtube
										: /^https?:\/\/player.vimeo.com\/video\/\d{0,9}(?=\b|\/)/.test(
												e
										  )
										? Ra.vimeo
										: null;
								})(r.toString())),
								(this.elements.container = this.media),
								(this.media = s),
								(this.elements.container.className = ""),
								r.search.length)
							) {
								const e = ["1", "true"];
								e.includes(r.searchParams.get("autoplay")) &&
									(this.config.autoplay = !0),
									e.includes(r.searchParams.get("loop")) &&
										(this.config.loop.active = !0),
									this.isYouTube
										? ((this.config.playsinline = e.includes(
												r.searchParams.get("playsinline")
										  )),
										  (this.config.youtube.hl = r.searchParams.get("hl")))
										: (this.config.playsinline = !0);
							}
						} else (this.provider = this.media.getAttribute(this.config.attributes.embed.provider)), this.media.removeAttribute(this.config.attributes.embed.provider);
						if (xr(this.provider) || !Object.values(Ra).includes(this.provider))
							return void this.debug.error("Setup failed: Invalid provider");
						this.type = $a;
						break;
					case "video":
					case "audio":
						(this.type = n),
							(this.provider = Ra.html5),
							this.media.hasAttribute("crossorigin") &&
								(this.config.crossorigin = !0),
							this.media.hasAttribute("autoplay") &&
								(this.config.autoplay = !0),
							(this.media.hasAttribute("playsinline") ||
								this.media.hasAttribute("webkit-playsinline")) &&
								(this.config.playsinline = !0),
							this.media.hasAttribute("muted") && (this.config.muted = !0),
							this.media.hasAttribute("loop") && (this.config.loop.active = !0);
						break;
					default:
						return void this.debug.error("Setup failed: unsupported type");
				}
				(this.supported = Xr.check(
					this.type,
					this.provider,
					this.config.playsinline
				)),
					this.supported.api
						? ((this.eventListeners = []),
						  (this.listeners = new Ba(this)),
						  (this.storage = new Sa(this)),
						  (this.media.plyr = this),
						  Tr(this.elements.container) ||
								((this.elements.container = jr("div", { tabindex: 0 })),
								Nr(this.media, this.elements.container)),
						  Ha.migrateStyles.call(this),
						  Ha.addStyleHook.call(this),
						  Qa.setup.call(this),
						  this.config.debug &&
								Zr.call(
									this,
									this.elements.container,
									this.config.events.join(" "),
									(e) => {
										this.debug.log(`event: ${e.type}`);
									}
								),
						  (this.fullscreen = new Fa(this)),
						  (this.isHTML5 || (this.isEmbed && !this.supported.ui)) &&
								Ha.build.call(this),
						  this.listeners.container(),
						  this.listeners.global(),
						  this.config.ads.enabled && (this.ads = new Ja(this)),
						  this.isHTML5 &&
								this.config.autoplay &&
								this.once("canplay", () => ra(this.play())),
						  (this.lastSeekTime = 0),
						  this.config.previewThumbnails.enabled &&
								(this.previewThumbnails = new to(this)))
						: this.debug.error("Setup failed: no support");
			}
			get isHTML5() {
				return this.provider === Ra.html5;
			}
			get isEmbed() {
				return this.isYouTube || this.isVimeo;
			}
			get isYouTube() {
				return this.provider === Ra.youtube;
			}
			get isVimeo() {
				return this.provider === Ra.vimeo;
			}
			get isVideo() {
				return this.type === $a;
			}
			get isAudio() {
				return this.type === ja;
			}
			get playing() {
				return Boolean(this.ready && !this.paused && !this.ended);
			}
			get paused() {
				return Boolean(this.media.paused);
			}
			get stopped() {
				return Boolean(this.paused && 0 === this.currentTime);
			}
			get ended() {
				return Boolean(this.media.ended);
			}
			set currentTime(e) {
				if (!this.duration) return;
				const t = gr(e) && e > 0;
				(this.media.currentTime = t ? Math.min(e, this.duration) : 0),
					this.debug.log(`Seeking to ${this.currentTime} seconds`);
			}
			get currentTime() {
				return Number(this.media.currentTime);
			}
			get buffered() {
				const { buffered: e } = this.media;
				return gr(e)
					? e
					: e && e.length && this.duration > 0
					? e.end(0) / this.duration
					: 0;
			}
			get seeking() {
				return Boolean(this.media.seeking);
			}
			get duration() {
				const e = parseFloat(this.config.duration),
					t = (this.media || {}).duration,
					i = gr(t) && t !== 1 / 0 ? t : 0;
				return e || i;
			}
			set volume(e) {
				let t = e;
				yr(t) && (t = Number(t)),
					gr(t) || (t = this.storage.get("volume")),
					gr(t) || ({ volume: t } = this.config),
					t > 1 && (t = 1),
					t < 0 && (t = 0),
					(this.config.volume = t),
					(this.media.volume = t),
					!xr(e) && this.muted && t > 0 && (this.muted = !1);
			}
			get volume() {
				return Number(this.media.volume);
			}
			set muted(e) {
				let t = e;
				br(t) || (t = this.storage.get("muted")),
					br(t) || (t = this.config.muted),
					(this.config.muted = t),
					(this.media.muted = t);
			}
			get muted() {
				return Boolean(this.media.muted);
			}
			get hasAudio() {
				return (
					!this.isHTML5 ||
					!!this.isAudio ||
					Boolean(this.media.mozHasAudio) ||
					Boolean(this.media.webkitAudioDecodedByteCount) ||
					Boolean(this.media.audioTracks && this.media.audioTracks.length)
				);
			}
			set speed(e) {
				let t = null;
				gr(e) && (t = e),
					gr(t) || (t = this.storage.get("speed")),
					gr(t) || (t = this.config.speed.selected);
				const { minimumSpeed: i, maximumSpeed: n } = this;
				(t = (function (e = 0, t = 0, i = 255) {
					return Math.min(Math.max(e, t), i);
				})(t, i, n)),
					(this.config.speed.selected = t),
					setTimeout(() => {
						this.media.playbackRate = t;
					}, 0);
			}
			get speed() {
				return Number(this.media.playbackRate);
			}
			get minimumSpeed() {
				return this.isYouTube
					? Math.min(...this.options.speed)
					: this.isVimeo
					? 0.5
					: 0.0625;
			}
			get maximumSpeed() {
				return this.isYouTube
					? Math.max(...this.options.speed)
					: this.isVimeo
					? 2
					: 16;
			}
			set quality(e) {
				const t = this.config.quality,
					i = this.options.quality;
				if (!i.length) return;
				let n = [
						!xr(e) && Number(e),
						this.storage.get("quality"),
						t.selected,
						t.default,
					].find(gr),
					s = !0;
				if (!i.includes(n)) {
					const e = oa(i, n);
					this.debug.warn(
						`Unsupported quality option: ${n}, using ${e} instead`
					),
						(n = e),
						(s = !1);
				}
				(t.selected = n),
					(this.media.quality = n),
					s && this.storage.set({ quality: n });
			}
			get quality() {
				return this.media.quality;
			}
			set loop(e) {
				const t = br(e) ? e : this.config.loop.active;
				(this.config.loop.active = t), (this.media.loop = t);
			}
			get loop() {
				return Boolean(this.media.loop);
			}
			set source(e) {
				io.change.call(this, e);
			}
			get source() {
				return this.media.currentSrc;
			}
			get download() {
				const { download: e } = this.config.urls;
				return Pr(e) ? e : this.source;
			}
			set download(e) {
				Pr(e) &&
					((this.config.urls.download = e), xa.setDownloadUrl.call(this));
			}
			set poster(e) {
				this.isVideo
					? Ha.setPoster.call(this, e, !1).catch(() => {})
					: this.debug.warn("Poster can only be set for video");
			}
			get poster() {
				return this.isVideo
					? this.media.getAttribute("poster") ||
							this.media.getAttribute("data-poster")
					: null;
			}
			get ratio() {
				if (!this.isVideo) return null;
				const e = ha(da.call(this));
				return wr(e) ? e.join(":") : e;
			}
			set ratio(e) {
				this.isVideo
					? yr(e) && ua(e)
						? ((this.config.ratio = ha(e)), pa.call(this))
						: this.debug.error(`Invalid aspect ratio specified (${e})`)
					: this.debug.warn("Aspect ratio can only be set for video");
			}
			set autoplay(e) {
				const t = br(e) ? e : this.config.autoplay;
				this.config.autoplay = t;
			}
			get autoplay() {
				return Boolean(this.config.autoplay);
			}
			toggleCaptions(e) {
				_a.toggle.call(this, e, !1);
			}
			set currentTrack(e) {
				_a.set.call(this, e, !1);
			}
			get currentTrack() {
				const { toggled: e, currentTrack: t } = this.captions;
				return e ? t : -1;
			}
			set language(e) {
				_a.setLanguage.call(this, e, !1);
			}
			get language() {
				return (_a.getCurrentTrack.call(this) || {}).language;
			}
			set pip(e) {
				if (!Xr.pip) return;
				const t = br(e) ? e : !this.pip;
				vr(this.media.webkitSetPresentationMode) &&
					this.media.webkitSetPresentationMode(t ? Ma : Na),
					vr(this.media.requestPictureInPicture) &&
						(!this.pip && t
							? this.media.requestPictureInPicture()
							: this.pip && !t && document.exitPictureInPicture());
			}
			get pip() {
				return Xr.pip
					? xr(this.media.webkitPresentationMode)
						? this.media === document.pictureInPictureElement
						: this.media.webkitPresentationMode === Ma
					: null;
			}
			static supported(e, t, i) {
				return Xr.check(e, t, i);
			}
			static loadSprite(e, t) {
				return Aa(e, t);
			}
			static setup(e, t = {}) {
				let i = null;
				return (
					yr(e)
						? (i = Array.from(document.querySelectorAll(e)))
						: kr(e)
						? (i = Array.from(e))
						: wr(e) && (i = e.filter(Tr)),
					xr(i) ? null : i.map((e) => new no(e, t))
				);
			}
		}
		var so;
		return (no.defaults = ((so = Oa), JSON.parse(JSON.stringify(so)))), no;
	});
