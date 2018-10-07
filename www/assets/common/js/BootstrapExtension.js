import $ from 'jquery';

export default class CheckboxListExtension {
	constructor(naja) {
		naja.addEventListener('init', this.init.bind(this));
		naja.snippetHandler.addEventListener('afterUpdate', (event) => {
			this.setup(document.getElementById(event.snippet.id));
		});
	}

	init() {
		this.setup($('body'));
	}

	setup(el) {
		const $el = $(el);
		$el.find('[data-toggle="tab"]').tab();
		$el.find('[data-toggle="tooltip"]').tooltip();
		$el.find('[data-toggle="dropdown"]').dropdown();
		$el.find('[data-toggle="popover"]').popover();
	}
}