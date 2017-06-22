$( document ).ready(function() {
    order_list_size();
    $("div.order-list div").show();
});

$( window ).resize(function() {
    order_list_size();
});

function order_list_size() {
    $("div.order-list div").width( $("div.order-list").width() + (($("html").width() - $("div.users").width()) / 2) - 5 );

    window.setTimeout(
        '$("div.order-list div").width( $("div.order-list").width() + (($("html").width() - $("div.users").width()) / 2) - 5 );', 
        100
    );
    
    window.setTimeout(
        '$("div.order-list div").width( $("div.order-list").width() + (($("html").width() - $("div.users").width()) / 2) - 5 );', 
        500
    );
}