
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

//Vue.component('example', require('./components/Example.vue'));

//const app = new Vue({
    //el: '#app'
//});

Date.prototype.stdTimezoneOffset = function() {
    const jan = new Date(this.getFullYear(), 0, 1);
    const jul = new Date(this.getFullYear(), 6, 1);
    return Math.max(jan.getTimezoneOffset(), jul.getTimezoneOffset());
};

Date.prototype.dst = function() {
    return this.getTimezoneOffset() < this.stdTimezoneOffset();
};

Date.prototype.toLocalTime = function() {
    const newDate = new Date(this.getTime()+this.getTimezoneOffset()*60*1000);
    let offset = this.getTimezoneOffset() / 60;
    const hours = this.getHours();

    if (this.dst()) offset--;

    newDate.setHours(hours - offset);

    return newDate;
};

$("#addModal").on("show.bs.modal", function(e) {
    const link = $(e.relatedTarget);
    $(this).find("#addBody").load(link.attr("href"));
});

$('a[href^="/food/remove"], a[href^="/food/catalog/remove"]').on('click', function(e) {
    e.preventDefault();
    $("#removeLink").attr('href', $(this).attr('href'));
});

$("#removeModal").on("show.bs.model", function(e) {
    const link = $(e.relatedTarget);
    $("#removeLink").attr("href", link.attr("href"));
});

