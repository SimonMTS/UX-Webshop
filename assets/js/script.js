$( document ).ready(function() {
    order_list_size();
    $("div.order-list div").show();

    $(".fa-star").click(function(){
        var rating = parseInt($(this).attr("class").split(" ")[2].replace("star", "")) + 1;
        $(".form-control").val(rating);

        document.rating.submit();
    });
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