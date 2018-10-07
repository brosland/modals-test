import Nette from 'nette-forms';
import $ from 'jquery';

export default class FormErrorsExtension {
	constructor(naja) {
		naja.addEventListener('init', this.init.bind(this));
		naja.snippetHandler.addEventListener('afterUpdate', (event) => {
			this.setup(document.getElementById(event.snippet.id));
		});
	}

	init() {
		Nette.addError = this.addError;

		this.setup($('body'));
	}

	setup(el) {
		var ext = this;

		$(el).find('[data-nette-rules]').each(function (i, el) {
			var $control = $(el);
			$control.change(function (e) {
				if (Nette.validateControl(el, null, true)) {
					ext.removeError(el);
				}
			});

			if ($control.is('input:text') ||
				$control.is('input:password') ||
				$control.is('textarea')) {
				$control.keyup(function (e) {
					if (Nette.validateControl(el, null, true)) {
						ext.removeError(el);
					}
				});
			}

			var $feedback = $control.closest('.form-group').find('.invalid-feedback');

			if ($.trim($feedback.html()) !== '') {
				$control.addClass('is-invalid');
			}
		});
	}

	addError(el, message) {
		var $el = $(el);

		$el.addClass('is-invalid');
		$el.closest('.form-group').find('.invalid-feedback').html(message);

		if (!$el.is(':focus')) {
			el.focus();
		}
	}

	removeError(el) {
		var $el = $(el);

		$el.removeClass('is-invalid');
		$el.closest('.form-group').find('.invalid-feedback').html('');
	}
}