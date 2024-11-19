
! function(i, t) {
	var e, a = '';
	e = {
			options: {
					defaultColor: !1,
					change: !1,
					clear: !1,
					hide: !0,
					palettes: !0,
					width: 255,
					mode: "hsv",
					type: "full",
					slider: "horizontal"
			},
			_createHueOnly: function() {
					var e, o = this,
							t = o.element;
					t.hide(), e = "hsl(" + t.val() + ", 100, 50)", t.iris({
							mode: "hsl",
							type: "hue",
							hide: !1,
							color: e,
							change: function(e, t) {
									i.isFunction(o.options.change) && o.options.change.call(this, e, t)
							},
							width: o.options.width,
							slider: o.options.slider
					})
			},
			_create: function() {
					if (i.support.iris) {
							var o = this,
									e = o.element;
							if (i.extend(o.options, e.data()), "hue" === o.options.type) return o._createHueOnly();
							o.close = i.proxy(o.close, o), o.initialValue = e.val(), e.addClass("wp-color-picker"), e.parent("label").length || (e.wrap("<label></label>"), o.wrappingLabelText = i('<span class="screen-reader-text"></span>').insertBefore(e).text('Color value')), o.wrappingLabel = e.parent(), o.wrappingLabel.wrap('<div class="wp-picker-container" />'), o.wrap = o.wrappingLabel.parent(), o.toggler = i('<button type="button" class="button wp-color-result" aria-expanded="false"><span class="wp-color-result-text"></span></button>').insertBefore(o.wrappingLabel).css({
									backgroundColor: o.initialValue
							}), o.toggler.find(".wp-color-result-text").text("Select Color"), o.pickerContainer = i('<div class="wp-picker-holder" />').insertAfter(o.wrappingLabel), o.button = i('<input type="button" class="button button-small" />'), o.options.defaultColor ? o.button.addClass("wp-picker-default").val('Default').attr("aria-label", "Select default color") : o.button.addClass("wp-picker-clear").val("Clear").attr("aria-label", 'Clear color'), o.wrappingLabel.wrap('<span class="wp-picker-input-wrap hidden" />').after(o.button), o.inputWrapper = e.closest(".wp-picker-input-wrap"), e.iris({
									target: o.pickerContainer,
									hide: o.options.hide,
									width: o.options.width,
									mode: o.options.mode,
									palettes: o.options.palettes,
									change: function(e, t) {
											o.toggler.css({
													backgroundColor: t.color.toString()
											}), i.isFunction(o.options.change) && o.options.change.call(this, e, t)
									}
							}), e.val(o.initialValue), o._addListeners(), o.options.hide || o.toggler.click()
					}
			},
			_addListeners: function() {
					var o = this;
					o.wrap.on("click.wpcolorpicker", function(e) {
							e.stopPropagation()
					}), o.toggler.click(function() {
							o.toggler.hasClass("wp-picker-open") ? o.close() : o.open()
					}), o.element.change(function(e) {
							var t = i(this).val();
							"" !== t && "#" !== t || (o.toggler.css("backgroundColor", ""), i.isFunction(o.options.clear) && o.options.clear.call(this, e))
					}), o.button.click(function(e) {
							var t = i(this);
							t.hasClass("wp-picker-clear") ? (o.element.val(""), o.toggler.css("backgroundColor", ""), i.isFunction(o.options.clear) && o.options.clear.call(this, e)) : t.hasClass("wp-picker-default") && o.element.val(o.options.defaultColor).change()
					})
			},
			open: function() {
					this.element.iris("toggle"), this.inputWrapper.removeClass("hidden"), this.wrap.addClass("wp-picker-active"), this.toggler.addClass("wp-picker-open").attr("aria-expanded", "true"), i("body").trigger("click.wpcolorpicker").on("click.wpcolorpicker", this.close)
			},
			close: function() {
					this.element.iris("toggle"), this.inputWrapper.addClass("hidden"), this.wrap.removeClass("wp-picker-active"), this.toggler.removeClass("wp-picker-open").attr("aria-expanded", "false"), i("body").off("click.wpcolorpicker", this.close)
			},
			color: function(e) {
					if (e === t) return this.element.iris("option", "color");
					this.element.iris("option", "color", e)
			},
			defaultColor: function(e) {
					if (e === t) return this.options.defaultColor;
					this.options.defaultColor = e
			}
	}, i.widget("wp.wpColorPicker", e)
}(jQuery);