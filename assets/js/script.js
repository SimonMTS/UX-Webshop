$( document ).ready(function() {
    if ( $("div.order-list").length ) {
        order_list_size();
        $("div.order-list div").show();
    }

    $(".fa-star").click(function(){
        var rating = parseInt($(this).attr("class").split(" ")[2].replace("star", "")) + 1;
        $(".form-control").val(rating);

        document.rating.submit();
    });

    $(".fa-star").mouseover(function(){
        $(".fa-star").css('color', 'lightgray');
        $(".active").css('color', 'gold');
        
        var rating = parseInt($(this).attr("class").split(" ")[2].replace("star", ""))+1;

        for (i=0;i<rating;i++) {
            $(".star"+i).css('color', 'gray');
        }
    });
    $(".stars").mouseleave(function(){
        $(".fa-star").css('color', 'lightgray');
        $(".active").css('color', 'gold');
    });

    $("a.del").click(function(e){
        e.preventDefault();

        document.getElementsByClassName("btn-primary")[0].setAttribute("onclick", "window.location.href='" + this.href + "'");

        $("#myModal").modal();

        document.querySelector('video').playbackRate = 1.4;
        document.getElementById("myVideo").play();
        document.getElementById("myAudio").play();
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