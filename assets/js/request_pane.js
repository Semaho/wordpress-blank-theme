var RequestPane = function(elem)
{
    // DOM.
    this.$elem    = jQuery(elem);
    this.$fader   = this.$elem.find('.request__fader');
    this.$pane    = this.$elem.find('.request__pane');
    this.$form    = this.$elem.find('#request-form');
    this.$openers = jQuery('[data-open="requestpane"]');
 
    // Events.
    // Using jQuery.proxy allows to access RequestPane properties with 'this' in called fn.
    this.$openers.on('click', jQuery.proxy(this.open, this));
    this.$fader.on('click', jQuery.proxy(this.close, this));
    this.$form.on('submit', jQuery.proxy(this.onFormSubmit, this));
};


RequestPane.prototype.open = function(event)
{
    this.$fader.fadeIn(150);
    this.$pane.addClass('request__pane--open');
};


RequestPane.prototype.close = function(event)
{
    this.$fader.fadeOut(150);
    this.$pane.removeClass('request__pane--open');
};


RequestPane.prototype.onFormSubmit = function(event)
{
    event.preventDefault();

    var values = {};
    
    jQuery.each(jQuery(event.currentTarget).serializeArray(), function(i, field) {
        values[field.name] = field.value;
    });

    jQuery.post(ajaxurl, values);
};


jQuery(document).ready(function()
{
    // Creates one instance per component,
    // allows to have the same component multiple times on same page.
    // Preference: target a data attribute for distinction between style and functionality.
    jQuery('[data-component="requestpane"]').each(function() {
        var comp = new RequestPane(this);
    });
});