var Burger = function(elem)
{
    // DOM.
    this.$elem    = jQuery(elem);
    this.isOpened = false;
 
    // Events.
    // Using jQuery.proxy allows to access Burger properties with 'this' in called fn.
    this.$elem.on('click', jQuery.proxy(this.onBurgerClick, this));
};


Burger.prototype.onBurgerClick = function(event)
{
    this.isOpened ? this.close() : this.open();
    this.isOpened = !this.isOpened;
};


Burger.prototype.open = function()
{
    this.$elem.addClass('burger--opened');

    // Mobile menu opening stuff here.
};


Burger.prototype.close = function()
{
    this.$elem.removeClass('burger--opened');

    // Mobile menu closing stuff here.
};


jQuery(document).ready(function()
{
    // Creates one instance per component,
    // allows to have the same component multiple times on same page.
    // Preference: target a data attribute for distinction between style and functionality.
    jQuery('[data-component="burger"]').each(function() {
        var comp = new Burger(this);
    });
});