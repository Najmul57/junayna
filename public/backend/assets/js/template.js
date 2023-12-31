if ("undefined" == typeof jQuery) throw new Error("template requires jQuery");

function w3_open() {
   document.getElementById("mySidebar").style.display = "block", document.getElementById("myOverlay").style.display = "block"
}

function w3_close() {
   document.getElementById("mySidebar").style.display = "none", document.getElementById("myOverlay").style.display = "none"
}


function displayContent() {
   loader.style.display = "none"
}! function (t) {
   "use strict";
   var e = "Masteradmin.layout",
      n = {
         slimscroll: !1,
         resetHeight: !0
      },
      o = ".wrapper",
      i = ".content-wrapper",
      s = ".layout-boxed",
      a = ".main-footer",
      r = ".main-header",
      l = ".sidebar",
      c = ".control-sidebar",
      d = ".sidebar-menu",
      u = ".main-header .logo",
      h = "fixed",
      f = "hold-transition",
      p = function (t) {
         this.options = t, this.bindedResize = !1, this.activate()
      };

   function m(o) {
      return this.each(function () {
         var i = t(this),
            s = i.data(e);
         if (!s) {
            var a = t.extend({}, n, i.data(), "object" == typeof o && o);
            i.data(e, s = new p(a))
         }
         if ("string" == typeof o) {
            if (void 0 === s[o]) throw new Error("No method named " + o);
            s[o]()
         }
      })
   }
   p.prototype.activate = function () {
      this.fix(), this.fixSidebar(), t("body").removeClass(f), this.options.resetHeight && t("body, html, " + o).css({
         height: "auto",
         "min-height": "100%"
      }), this.bindedResize || (t(window).resize(function () {
         this.fix(), this.fixSidebar(), t(u + ", " + l).one("webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend", function () {
            this.fix(), this.fixSidebar()
         }.bind(this))
      }.bind(this)), this.bindedResize = !0), t(d).on("expanded.tree", function () {
         this.fix(), this.fixSidebar()
      }.bind(this)), t(d).on("collapsed.tree", function () {
         this.fix(), this.fixSidebar()
      }.bind(this))
   }, p.prototype.fix = function () {
      t(s + " > " + o).css("overflow", "hidden");
      var e = t(a).outerHeight() || 0,
         n = t(r).outerHeight() + e,
         d = t(window).height(),
         u = t(l).height() || 0;
      if (t("body").hasClass(h)) t(i).css("min-height", d - e);
      else {
         var f;
         d >= u ? (t(i).css("min-height", d - n), f = d - n) : (t(i).css("min-height", u), f = u);
         var p = t(c);
         void 0 !== p && p.height() > f && t(i).css("min-height", p.height())
      }
   }, p.prototype.fixSidebar = function () {
      t("body").hasClass(h) ? this.options.slimscroll && void 0 !== t.fn.slimScroll && (t(l).slimScroll({
         destroy: !0
      }).height("auto"), t(l).slimScroll({
         height: t(window).height() - t(r).height() + "px",
         color: "rgba(0,0,0,0.2)",
         size: "3px"
      })) : void 0 !== t.fn.slimScroll && t(l).slimScroll({
         destroy: !0
      }).height("auto")
   };
   var g = t.fn.layout;
   t.fn.layout = m, t.fn.layout.Constuctor = p, t.fn.layout.noConflict = function () {
      return t.fn.layout = g, this
   }, t(window).on("load", function () {
      m.call(t("body"))
   })
}(jQuery),
function (t) {
   "use strict";
   var e = "Masteradmin.pushmenu",
      n = {
         collapseScreenSize: 767,
         expandOnHover: !1,
         expandTransitionDelay: 200
      },
      o = ".sidebar-collapse",
      i = ".main-sidebar",
      s = ".content-wrapper",
      a = ".sidebar-form .form-control",
      r = '[data-toggle="push-menu"]',
      l = ".sidebar-mini",
      c = "",
      d = "sidebar-collapse",
      u = "sidebar-open",
      h = "",
      f = "expanded.pushMenu",
      p = "collapsed.pushMenu",
      m = function (t) {
         this.options = t, this.init()
      };

   function g(o) {
      return this.each(function () {
         var i = t(this),
            s = i.data(e);
         if (!s) {
            var a = t.extend({}, n, i.data(), "object" == typeof o && o);
            i.data(e, s = new m(a))
         }
         "toggle" == o && s.toggle()
      })
   }
   m.prototype.init = function () {
      t(s).on(function () {
         t(window).width() <= this.options.collapseScreenSize && t("body").hasClass(u) && this.close()
      }.bind(this)), t(a).on(function (t) {
         t.stopPropagation()
      })
   }, m.prototype.toggle = function () {
      var e = t(window).width(),
         n = !t("body").hasClass(d);
      e <= this.options.collapseScreenSize && (n = t("body").hasClass(u)), n ? this.close() : this.open()
   }, m.prototype.open = function () {
      t(window).width() > this.options.collapseScreenSize ? t("body").removeClass(d).trigger(t.Event(f)) : t("body").addClass(u).trigger(t.Event(f))
   }, m.prototype.close = function () {
      t(window).width() > this.options.collapseScreenSize ? t("body").addClass(d).trigger(t.Event(p)) : t("body").removeClass(u + " " + d).trigger(t.Event(p))
   }, m.prototype.expandOnHover = function () {
      t(i).hover(function () {
         t("body").is(l + o) && t(window).width() > this.options.collapseScreenSize && this.expand()
      }.bind(this), function () {
         t("body").is(c) && this.collapse()
      }.bind(this))
   }, m.prototype.collapse = function () {
      setTimeout(function () {
         t("body").removeClass(h).addClass(d)
      }, this.options.expandTransitionDelay)
   };
   var b = t.fn.pushMenu;
   t.fn.pushMenu = g, t.fn.pushMenu.Constructor = m, t.fn.pushMenu.noConflict = function () {
      return t.fn.pushMenu = b, this
   }, t(document).on("click", r, function (e) {
      e.preventDefault(), g.call(t(this), "toggle")
   }), t(window).on("load", function () {
      g.call(t(r))
   })
}(jQuery),
function (t) {
   "use strict";
   var e = "Masteradmin.tree",
      n = {
         animationSpeed: 500,
         accordion: !0,
         followLink: !1,
         trigger: ".treeview a"
      },
      o = ".treeview",
      i = ".treeview-menu",
      s = ".menu-open, .active",
      a = '[data-widget="tree"]',
      r = ".active",
      l = "menu-open",
      c = "tree",
      d = "collapsed.tree",
      u = "expanded.tree",
      h = function (e, n) {
         this.element = e, this.options = n, t(this.element).addClass(c), t(o + r, this.element).addClass(l), this._setUpListeners()
      };

   function f(o) {
      return this.each(function () {
         var i = t(this);
         if (!i.data(e)) {
            var s = t.extend({}, n, i.data(), "object" == typeof o && o);
            i.data(e, new h(i, s))
         }
      })
   }
   h.prototype.toggle = function (t, e) {
      var n = t.next(i),
         s = t.parent(),
         a = s.hasClass(l);
      s.is(o) && (this.options.followLink && "#" != t.attr("href") || e.preventDefault(), a ? this.collapse(n, s) : this.expand(n, s))
   }, h.prototype.expand = function (e, n) {
      var o = t.Event(u);
      if (this.options.accordion) {
         var a = n.siblings(s),
            r = a.children(i);
         this.collapse(r, a)
      }
      n.addClass(l), e.slideDown(this.options.animationSpeed, function () {
         t(this.element).trigger(o)
      }.bind(this))
   }, h.prototype.collapse = function (e, n) {
      var i = t.Event(d);
      e.find(s).removeClass(l), n.removeClass(l), e.slideUp(this.options.animationSpeed, function () {
         e.find(s + " > " + o).slideUp(), t(this.element).trigger(i)
      }.bind(this))
   }, h.prototype._setUpListeners = function () {
      var e = this;
      t(this.element).on("click", this.options.trigger, function (n) {
         e.toggle(t(this), n)
      })
   };
   var p = t.fn.tree;
   t.fn.tree = f, t.fn.tree.Constructor = h, t.fn.tree.noConflict = function () {
      return t.fn.tree = p, this
   }, t(window).on("load", function () {
      t(a).each(function () {
         f.call(t(this))
      })
   })
}(jQuery),
function (t) {
   "use strict";
   var e = "Masteradmin.controlsidebar",
      n = {
         slide: !0
      },
      o = ".control-sidebar",
      i = '[data-toggle="control-sidebar"]',
      s = ".control-sidebar-open",
      a = ".control-sidebar-bg",
      r = ".wrapper",
      l = ".layout-boxed",
      c = "control-sidebar-open",
      d = "collapsed.controlsidebar",
      u = "expanded.controlsidebar",
      h = function (t, e) {
         this.element = t, this.options = e, this.hasBindedResize = !1, this.init()
      };

   function f(o) {
      return this.each(function () {
         var i = t(this),
            s = i.data(e);
         if (!s) {
            var a = t.extend({}, n, i.data(), "object" == typeof o && o);
            i.data(e, s = new h(i, a))
         }
         "string" == typeof o && s.toggle()
      })
   }
   h.prototype.init = function () {
      t(this.element).is(i) || t(this).on("click", this.toggle), this.fix(), t(window).resize(function () {
         this.fix()
      }.bind(this))
   }, h.prototype.toggle = function (e) {
      e && e.preventDefault(), this.fix(), t(o).is(s) || t("body").is(s) ? this.collapse() : this.expand()
   }, h.prototype.expand = function () {
      this.options.slide ? t(o).addClass(c) : t("body").addClass(c), t(this.element).trigger(t.Event(u))
   }, h.prototype.collapse = function () {
      t("body, " + o).removeClass(c), t(this.element).trigger(t.Event(d))
   }, h.prototype.fix = function () {
      t("body").is(l) && this._fixForBoxed(t(a))
   }, h.prototype._fixForBoxed = function (e) {
      e.css({
         position: "absolute",
         height: t(r).height()
      })
   };
   var p = t.fn.controlSidebar;
   t.fn.controlSidebar = f, t.fn.controlSidebar.Constructor = h, t.fn.controlSidebar.noConflict = function () {
      return t.fn.controlSidebar = p, this
   }, t(document).on("click", i, function (e) {
      e && e.preventDefault(), f.call(t(this), "toggle")
   })
}(jQuery),
function (t) {
   "use strict";
   var e = "Masteradmin.boxwidget",
      n = {
         animationSpeed: 500,
         collapseTrigger: '[data-widget="collapse"]',
         removeTrigger: '[data-widget="remove"]',
         collapseIcon: "fa-minus",
         expandIcon: "fa-plus",
         removeIcon: "fa-times"
      },
      o = ".box",
      i = ".collapsed-box",
      s = ".box-body",
      a = ".box-footer",
      r = ".box-tools",
      l = "collapsed-box",
      c = "collapsed.boxwidget",
      d = "expanded.boxwidget",
      u = "removed.boxwidget",
      h = function (t, e) {
         this.element = t, this.options = e, this._setUpListeners()
      };

   function f(o) {
      return this.each(function () {
         var i = t(this),
            s = i.data(e);
         if (!s) {
            var a = t.extend({}, n, i.data(), "object" == typeof o && o);
            i.data(e, s = new h(i, a))
         }
         if ("string" == typeof o) {
            if (void 0 === s[o]) throw new Error("No method named " + o);
            s[o]()
         }
      })
   }
   h.prototype.toggle = function () {
      !t(this.element).is(i) ? this.collapse() : this.expand()
   }, h.prototype.expand = function () {
      var e = t.Event(d),
         n = this.options.collapseIcon,
         o = this.options.expandIcon;
      t(this.element).removeClass(l), t(this.element).find(r).find("." + o).removeClass(o).addClass(n), t(this.element).find(s + ", " + a).slideDown(this.options.animationSpeed, function () {
         t(this.element).trigger(e)
      }.bind(this))
   }, h.prototype.collapse = function () {
      var e = t.Event(c),
         n = this.options.collapseIcon,
         o = this.options.expandIcon;
      t(this.element).find(r).find("." + n).removeClass(n).addClass(o), t(this.element).find(s + ", " + a).slideUp(this.options.animationSpeed, function () {
         t(this.element).addClass(l), t(this.element).trigger(e)
      }.bind(this))
   }, h.prototype.remove = function () {
      var e = t.Event(u);
      t(this.element).slideUp(this.options.animationSpeed, function () {
         t(this.element).trigger(e), t(this.element).remove()
      }.bind(this))
   }, h.prototype._setUpListeners = function () {
      var e = this;
      t(this.element).on("click", this.options.collapseTrigger, function (t) {
         t && t.preventDefault(), e.toggle()
      }), t(this.element).on("click", this.options.removeTrigger, function (t) {
         t && t.preventDefault(), e.remove()
      })
   };
   var p = t.fn.boxWidget;
   t.fn.boxWidget = f, t.fn.boxWidget.Constructor = h, t.fn.boxWidget.noConflict = function () {
      return t.fn.boxWidget = p, this
   }, t(window).on("load", function () {
      t(o).each(function () {
         f.call(t(this))
      })
   })
}(jQuery),
function (t) {
   "use strict";
   var e = "Masteradmin.todolist",
      n = {
         iCheck: !1,
         onCheck: function () {},
         onUnCheck: function () {}
      },
      o = {
         data: '[data-widget="todo-list"]'
      },
      i = "done",
      s = function (t, e) {
         this.element = t, this.options = e, this._setUpListeners()
      };

   function a(o) {
      return this.each(function () {
         var i = t(this),
            a = i.data(e);
         if (!a) {
            var r = t.extend({}, n, i.data(), "object" == typeof o && o);
            i.data(e, a = new s(i, r))
         }
         if ("string" == typeof a) {
            if (void 0 === a[o]) throw new Error("No method named " + o);
            a[o]()
         }
      })
   }
   s.prototype.toggle = function (t) {
      t.parents(o.li).first().toggleClass(i), t.prop("checked") ? this.check(t) : this.unCheck(t)
   }, s.prototype.check = function (t) {
      this.options.onCheck.call(t)
   }, s.prototype.unCheck = function (t) {
      this.options.onUnCheck.call(t)
   }, s.prototype._setUpListeners = function () {
      var e = this;
      t(this.element).on("change ifChanged", "input:checkbox", function () {
         e.toggle(t(this))
      })
   };
   var r = t.fn.todoList;
   t.fn.todoList = a, t.fn.todoList.Constructor = s, t.fn.todoList.noConflict = function () {
      return t.fn.todoList = r, this
   }, t(window).on("load", function () {
      t(o.data).each(function () {
         a.call(t(this))
      })
   })
}(jQuery),
function (t) {
   "use strict";
   var e = "Masteradmin.directchat",
      n = '[data-widget="chat-pane-toggle"]',
      o = ".direct-chat",
      i = "direct-chat-contacts-open",
      s = function (t) {
         this.element = t
      };

   function a(n) {
      return this.each(function () {
         var o = t(this),
            i = o.data(e);
         i || o.data(e, i = new s(o)), "string" == typeof n && i.toggle(o)
      })
   }
   s.prototype.toggle = function (t) {
      t.parents(o).first().toggleClass(i)
   };
   var r = t.fn.directChat;
   t.fn.directChat = a, t.fn.directChat.Constructor = s, t.fn.directChat.noConflict = function () {
      return t.fn.directChat = r, this
   }, t(document).on("click", n, function (e) {
      e && e.preventDefault(), a.call(t(this), "toggle")
   }), t(".inner-content-div").slimScroll({
      height: "200"
   }), t(".sm-scrol").slimScroll({
      height: "250"
   }), t(".direct-chat-messages").slimScroll({
      height: "420"
   }), t(".chat-box-one").slimScroll({
      height: "550"
   }), t(".chat-box-one2").slimScroll({
      height: "580"
   }), t(".chat-box-one-side").slimScroll({
      height: "650"
   }), t(".chat-box-one-side2").slimScroll({
      height: "500"
   }), t(".chat-box-one-side3").slimScroll({
      height: "685"
   }), t(".notification-side").slimScroll({
      height: "325"
   }), t(".suggestions-side").slimScroll({
      height: "300"
   }), t(".events-side").slimScroll({
      height: "265"
   }), t(".pat-div").slimScroll({
      height: "204"
   }), t(".demo-panel-bx").slimScroll({
      height: "auto"
   }), t(".search-box a, .search-box .app-search .srh-btn").on("click", function () {
      t(".app-search").toggle(200)
   }), t(document).on("click", ".box-btn-close", function () {
      t(this).parents(".box").fadeOut(600, function () {
         1 == t(this).parent().children().length ? t(this).parent().remove() : t(this).remove()
      })
   }), t(document).on("click", ".box-btn-slide", function () {
      t(this).toggleClass("rotate-180").parents(".box").find(".box-content, .box-body").slideToggle()
   }), t(document).on("click", ".box-btn-maximize", function () {
      t(this).parents(".box").toggleClass("box-maximize").removeClass("box-fullscreen")
   }), t(document).on("click", ".box-btn-fullscreen", function () {
      t(this).parents(".box").toggleClass("box-fullscreen").removeClass("box-maximize")
   }), t(document).on("click", 'a[href="#"]', function (t) {
      t.preventDefault()
   }), t(".open-left-block").on("click", function () {
      t(".left-block").toggleClass("open-panel"), t(".open-left-block").toggleClass("mdi-menu")
   }), t(document).on("click", ".file-browser", function () {
      var e = t(this);
      if (e.hasClass("form-control")) setTimeout(function () {
         e.closest(".file-group").find('[type="file"]').trigger("click")
      }, 300);
      else {
         var n = e.closest(".file-group").find('[type="file"]');
         n.on("click", function (t) {
            t.stopPropagation()
         }), n.trigger("click")
      }
   }), t(document).on("change", '.file-group [type="file"]', function () {
      for (var e = t(this)[0], n = e.files.length, o = "", i = 0; i < n; ++i) o += e.files.item(i).name + ", ";
      o = o.substr(0, o.length - 2), t(this).closest(".file-group").find(".file-value").val(o).text(o).focus()
   }), t(document).on("change", ".custom-file-input", function () {
      var e = t(this).val().split("\\").pop();
      t(this).next(".custom-file-control").attr("data-input-value", e)
   }), t(".custom-file-control:not([data-input-value])").attr("data-input-value", "Choose file..."), t(".todo-list").todoList({
      onCheck: function () {
         window.console.log(t(this), "The element has been checked")
      },
      onUnCheck: function () {
         window.console.log(t(this), "The element has been unchecked")
      }
   }), t("#thismonth").sparkline([8, 5, 4, 7, 9, 7, 10, 9], {
      type: "bar",
      height: "35",
      barWidth: "4",
      resize: !0,
      barSpacing: "4",
      barColor: "#843cf7"
   }), t("#lastyear").sparkline([8, 5, 4, 7, 9, 7, 10, 9], {
      type: "bar",
      height: "35",
      barWidth: "4",
      resize: !0,
      barSpacing: "4",
      barColor: "#ec4b71"
   }), t("#chat-circle, #chat-box-toggle, #chat-popup").click(function () {
      t("#chat-box-body").toggleClass("show")
   })
}(jQuery), $(function () {
      "use strict";
      $('[data-provide~="fullscreen"]').on("click", function () {
         screenfull.toggle($("#container")[0])
      })
   }),
   function (t) {
      "use strict";
      t('.sidebar-menu li a[href="' + window.location.pathname.split("/").pop() + '"]').parent().addClass("active"), t(".sidebar-menu li.active").parents("li").addClass("active")
   }(jQuery),
   function (t) {
      "use strict";
      t('.sm li a[href="' + window.location.pathname.split("/").pop() + '"]').parent().addClass("current"), t(".sm li.current").parents("li").addClass("current")
   }(jQuery), $(function () {
      "use strict";
      feather.replace()
   }),
   function (t) {
      "use strict";
      var e = e || {},
         n = document.querySelectorAll.bind(document);

      function o(t) {
         var e = "";
         for (var n in t) t.hasOwnProperty(n) && (e += n + ":" + t[n] + ";");
         return e
      }
      var i = {
            duration: 750,
            show: function (t, e) {
               if (2 === t.button) return !1;
               var n = e || this,
                  s = document.createElement("div");
               s.className = "waves-ripple", n.appendChild(s);
               var a, r, l, c, d, u = (c = {
                     top: 0,
                     left: 0
                  }, d = (a = n) && a.ownerDocument, r = d.documentElement, void 0 !== a.getBoundingClientRect && (c = a.getBoundingClientRect()), l = function (t) {
                     return null !== (e = t) && e === e.window ? t : 9 === t.nodeType && t.defaultView;
                     var e
                  }(d), {
                     top: c.top + l.pageYOffset - r.clientTop,
                     left: c.left + l.pageXOffset - r.clientLeft
                  }),
                  h = t.pageY - u.top,
                  f = t.pageX - u.left,
                  p = "scale(" + n.clientWidth / 100 * 10 + ")";
               "touches" in t && (h = t.touches[0].pageY - u.top, f = t.touches[0].pageX - u.left), s.setAttribute("data-hold", Date.now()), s.setAttribute("data-scale", p), s.setAttribute("data-x", f), s.setAttribute("data-y", h);
               var m = {
                  top: h + "px",
                  left: f + "px"
               };
               s.className = s.className + " waves-notransition", s.setAttribute("style", o(m)), s.className = s.className.replace("waves-notransition", ""), m["-webkit-transform"] = p, m["-moz-transform"] = p, m["-ms-transform"] = p, m["-o-transform"] = p, m.transform = p, m.opacity = "1", m["-webkit-transition-duration"] = i.duration + "ms", m["-moz-transition-duration"] = i.duration + "ms", m["-o-transition-duration"] = i.duration + "ms", m["transition-duration"] = i.duration + "ms", m["-webkit-transition-timing-function"] = "cubic-bezier(0.250, 0.460, 0.450, 0.940)", m["-moz-transition-timing-function"] = "cubic-bezier(0.250, 0.460, 0.450, 0.940)", m["-o-transition-timing-function"] = "cubic-bezier(0.250, 0.460, 0.450, 0.940)", m["transition-timing-function"] = "cubic-bezier(0.250, 0.460, 0.450, 0.940)", s.setAttribute("style", o(m))
            },
            hide: function (t) {
               s.touchup(t);
               var e = this,
                  n = (e.clientWidth, null),
                  a = e.getElementsByClassName("waves-ripple");
               if (!(a.length > 0)) return !1;
               var r = (n = a[a.length - 1]).getAttribute("data-x"),
                  l = n.getAttribute("data-y"),
                  c = n.getAttribute("data-scale"),
                  d = 350 - (Date.now() - Number(n.getAttribute("data-hold")));
               d < 0 && (d = 0), setTimeout(function () {
                  var t = {
                     top: l + "px",
                     left: r + "px",
                     opacity: "0",
                     "-webkit-transition-duration": i.duration + "ms",
                     "-moz-transition-duration": i.duration + "ms",
                     "-o-transition-duration": i.duration + "ms",
                     "transition-duration": i.duration + "ms",
                     "-webkit-transform": c,
                     "-moz-transform": c,
                     "-ms-transform": c,
                     "-o-transform": c,
                     transform: c
                  };
                  n.setAttribute("style", o(t)), setTimeout(function () {
                     try {
                        e.removeChild(n)
                     } catch (t) {
                        return !1
                     }
                  }, i.duration)
               }, d)
            },
            wrapInput: function (t) {
               for (var e = 0; e < t.length; e++) {
                  var n = t[e];
                  if ("input" === n.tagName.toLowerCase()) {
                     var o = n.parentNode;
                     if ("i" === o.tagName.toLowerCase() && -1 !== o.className.indexOf("waves-effect")) continue;
                     var i = document.createElement("i");
                     i.className = n.className + " waves-input-wrapper";
                     var s = n.getAttribute("style");
                     s || (s = ""), i.setAttribute("style", s), n.className = "waves-button-input", n.removeAttribute("style"), o.replaceChild(i, n), i.appendChild(n)
                  }
               }
            }
         },
         s = {
            touches: 0,
            allowEvent: function (t) {
               var e = !0;
               return "touchstart" === t.type ? s.touches += 1 : "touchend" === t.type || "touchcancel" === t.type ? setTimeout(function () {
                  s.touches > 0 && (s.touches -= 1)
               }, 500) : "mousedown" === t.type && s.touches > 0 && (e = !1), e
            },
            touchup: function (t) {
               s.allowEvent(t)
            }
         };

      function a(e) {
         var n = function (t) {
            if (!1 === s.allowEvent(t)) return null;
            for (var e = null, n = t.target || t.srcElement; null !== n.parentNode;) {
               if (!(n instanceof SVGElement) && -1 !== n.className.indexOf("waves-effect")) {
                  e = n;
                  break
               }
               n = n.parentNode
            }
            return e
         }(e);
         null !== n && (i.show(e, n), "ontouchstart" in t && (n.addEventListener("touchend", i.hide, !1), n.addEventListener("touchcancel", i.hide, !1)), n.addEventListener("mouseup", i.hide, !1), n.addEventListener("mouseleave", i.hide, !1), n.addEventListener("dragend", i.hide, !1))
      }
      e.displayEffect = function (e) {
         "duration" in (e = e || {}) && (i.duration = e.duration), i.wrapInput(n(".waves-effect")), "ontouchstart" in t && document.body.addEventListener("touchstart", a, !1), document.body.addEventListener("mousedown", a, !1)
      }, e.attach = function (e) {
         "input" === e.tagName.toLowerCase() && (i.wrapInput([e]), e = e.parentNode), "ontouchstart" in t && e.addEventListener("touchstart", a, !1), e.addEventListener("mousedown", a, !1)
      }, t.Waves = e, document.addEventListener("DOMContentLoaded", function () {
         e.displayEffect()
      }, !1)
   }(window), document.addEventListener("DOMContentLoaded", function () {
      // loader = document.getElementById("loader"), loadNow(1);
   }), new PerfectScrollbar(".multinav-scroll");
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]')),
   tooltipList = tooltipTriggerList.map(function (t) {
      return new bootstrap.Tooltip(t)
   });