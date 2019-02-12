(function () {
	'use strict';
	const app = window.app = {};
	
	const token = $('meta[name="csrf-token"]').attr('content') || '';
	const locale = $('meta[name="app-locale"]').attr('content') || 'en';
	
	var _hDiv = $('<div/>');
	app.h = function (str) {
		return _hDiv.text(str).html();
	};
	
	app.get = function (name, url) {
	if (!url) url = window.location.href;
		name = name.replace(/[\[\]]/g, '\\$&');
		var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
			results = regex.exec(url);
		if (!results) return null;
		if (!results[2]) return '';
		return decodeURIComponent(results[2].replace(/\+/g, ' '));
	};
	
	var _loadingTemplate = '<div class="modal-set" style="z-index:9999;"><div class="all-loading"><p><img alt="" src="/img/loading.gif"></p></div></div>';
	var $loading;
	var closers = [];
	app.loading = function () {
		if (!$loading) {
			$loading = $(_loadingTemplate).appendTo('body');
		}
		
		var closer = function () {
			var i=0,l=closers.length;
			for (;i<l;i++) {
				if (closers[i] == closer) {
					closers.splice(i, 1);
					if (!closers.length) {
						$loading.remove();
						$loading = null;
					}
					return;
				}
			}
		};
		closers.push(closer);
		return closer;
	};
	
	var $modal;
	app.modal = function (content, onClose, autoRemove) {
		if (!(this instanceof app.modal)) {
			return new app.modal(content, onClose, autoRemove);
		}
		
		this.$el = $('<div class="modal modal-set"><div class="modal-content-wrap modal-dialog"></div></div>');
		this.$el.find('.modal-content-wrap').append(content);
		
		if (!$modal) {
			$modal = $('<div id="modal" class="is-hide"></div>');
			$modal.appendTo('body');
		}
		this.$el.addClass('is-hide');
		$modal.append(this.$el);
		
		this.onClose = onClose;
		this.autoRemove = autoRemove;
		
		var _self = this;
		this.$el.on('app-modal-closeall', function () {
			_self.close(false);
		});
	};
	app.modal.prototype = {
		show: function () {
			this.$el.appendTo($modal).removeClass('is-hide');
			$modal.removeClass('is-hide');
			return this;
		},
	    hide: function () {
	      this.$el.appendTo($modal).addClass('is-hide');
	      $modal.addClass('is-hide');
	      return this;
	    },
		close: function (value) {
			var ret;
			if (this.onClose) {
				ret = this.onClose(value, this);
			}
			
			if (ret !== false) {
				this.$el.addClass('is-hide');
				if (!$modal.find('.modal-set:not(.is-hide)').length) {
					$modal.addClass('is-hide');
				}
				
				if (this.autoRemove !== false) {
					this.remove();
				}
			}
			
			return this;
		},
		remove: function () {
			this.$el.trigger('app-modal-remove').off().remove();
			return this;
		},
		closeAll: function () {
			if ($modal) {
				$modal.trigger('app-modal-closeall');
			}
		}
	};
	app.modal.popup = function (kwargs) {
		kwargs = kwargs !== undefined ? kwargs : {};
		
		var $elem = $('<div class="modal-content"><div class="modal-header is-hide"></div><div class="modal-body"><div class="modal-body-inner"></div></div></div>');
		
		if (kwargs.modalClass) {
			$elem.addClass(kwargs.modalClass);
		}
		
		var $modalHeader = $elem.find('.modal-header');
		if (kwargs.title !== false) {
			$modalHeader.append($('<h4/>').addClass('modal-title').text(kwargs.title));
		}
		
		var $modalBodyInner = $elem.find('.modal-body-inner');
		$modalBodyInner.append(kwargs.content);
		if (kwargs.modalInnerClass) {
			$modalBodyInner.addClass(kwargs.modalInnerClass);
		}
		
		var modal = app.modal($elem, kwargs.onClose, kwargs.autoRemove);
		
		var $close;
		if (kwargs.closeButton !== false) {
			$close = $('<button class="btn-modal-x" type="button" class="close" data-dismiss="modal">&times;</button>');
			$modalHeader.removeClass('is-hide').append($close);
			
			$close.on('click', function () {
				modal.close(false);
			});
		}
		
		if (kwargs.ok === undefined) {
			kwargs.ok = 'OK';
		}
		
		if (kwargs.cancel === undefined) {
			kwargs.cancel = 'Close';
		}
		
		var $ok;
		var $cancel;
		if (kwargs.ok || kwargs.cancel) {
			var $modalFooter = $('<div class="modal-footer"></div>').appendTo(modal.$el.find('.modal-body-inner'));
			if (kwargs.cancel) {
				$cancel = $('<button type="button" class="btn btn-modal-dismiss" data-dismiss="modal"></button>').text(kwargs.cancel);
				$cancel.on('click', function () {
					modal.close(false);
				});
				$modalFooter.append($cancel);
			}
			if (kwargs.ok) {
				$ok = $('<button type="button" class="btn btn-modal-success" data-success="modal"></button>').text(kwargs.ok);
				$ok.on('click', function () {
					modal.close(true);
				});
				$modalFooter.append($ok);
			}
		}
		
		modal.$el.on('app-modal-remove', function () {
			$ok && $ok.off();
			$cancel && $cancel.off();
			$close && $close.off();
		});
		
		return modal;
	};
	app.modal.message = function (kwargs) {

		if (!kwargs.type){
			kwargs.type = '';
		}

		kwargs.content = $('<div class="modal-message"><strong>'+ app.h(kwargs.message).replace(/\r?\n/, '<br>') +'</strong></div>');
		
		var modal = app.modal.popup(kwargs);
		
		if (kwargs.links) {
			var $message = modal.$el.find('.modal-message');
			$.each(kwargs.links, function (i, link) {
				var $a = $('<a class="is-link"></a>').text(link.title || link.url).attr('href', link.url);
				if (link.target) {
					$a.attr('target', link.target);
				}
				$message.append($('<p/>').append($a));
			});
		}
		
		return modal.show();
	};
	app.modal.confirm = function (title, message, onClose) {
		return app.modal.message ({
			title: title,
			message: message,
			onClose: onClose
		});
	};
	app.api = function (url, data, fn, msg, kwargs) {
		kwargs = kwargs !== undefined ? kwargs : {};
		
		var defer = $.ajax(url, {
			dataType: 'json',
			method: 'POST',
			data: data,
			contentType: kwargs.contentType,
			processData: kwargs.processData
		});
		
		var onError;
		if (kwargs && kwargs.hasOwnProperty('onError')){
			onError = kwargs.onError;
		}

		defer.done (function (res) {
			if (res.ok) {
				fn && fn(res.data);
			}
			else {
				app.modal.alert('', res.error);
			}
		}).fail (function (xhr, statusText) {
			if (app.unload) {
				return;
			}
			if (statusText === 'abort') {
				return;
			}
			
			if (typeof onError  === 'function') {
				onError(xhr);
			}
		});
		return defer;
	};
	app.form = function ($form, $trigger, onSuccess, onSubmit) {
		$form.on('submit', function (e) {
			
			if ($form.attr('target')) {
				return;
			}
			
			e.preventDefault();
			
			if ($form.hasClass('is-loading')) {
				return false;
			}
			$form.addClass('is-loading');
			
			if ($trigger) {
				$trigger.addClass('is-disable');
			}
			
			$form.addClass('was-validated');
			if (typeof $form[0].checkValidity  === 'function' && $form[0].checkValidity() === false) {
				e.preventDefault();
				e.stopPropagation();
			} else {
				app.api($form.attr('data-api'), $form.serialize(), function (data) {
					$form.find('.is-error').removeClass('is-error');
					$form.find('.errors').empty();
					if (data.errors) {
						$form.trigger('reset-placeholder');
						
						// app.setErrors($form, data.errors);
						
						$form.trigger('app-api-form-error');
					} else {
						$form[0].reset();
						
						if (typeof onSuccess  === 'function') {
							onSuccess(data);
						}
						else {
							let msg = 'Your settings have been sent.';
							if (data.message) {
								msg = data.message;
							}
							
							return app.modal.message({
								title: '',
								message: msg,
								cancel: false,
								closeButton: false,
								onClose: function (){
									var $errorInput = $('.is-error:not(:hidden)');
									var $error = $('.errors p');
									var $target;
									if ($errorInput.length) {
										$target = $errorInput.eq(0);
									} else if ($error.length) {
										$target = $error.eq(0);
									} else {
										return;
									}
								}
							});
						}
					}
				}).always(function () {
					$form.removeClass('was-validated');
				});
			}
			
			$form.removeClass('is-loading');
			if ($trigger) {
				$trigger.removeClass('is-disable');
			}
		});
		
		if ($trigger) {
			$trigger.on('click', function (e) {
				e.preventDefault();
				
				if ($trigger.hasClass('is-disable')) {
					return false;
				}
				$trigger.addClass('is-disable');
				
				if (typeof onSubmit  === 'function') {
					onSubmit();
				}
				
				$form.submit();
			});
		}
	};
	
})();