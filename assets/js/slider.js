$(document).ready(() => {
    $.each($(".avatar"), (index, element) => {
        $(element).css("background-image", "url('"+$(element).attr("data-image")+"')");
    });

    // let temp;
    // $("#prev").click(() => {
    //     let temp = $(".content < a").last();
    //     // console.log(temp);
    //     $(temp).remove();
        
    //     $("#slider-content").prepend(temp);
    //     // console.log($(".content"));
    // });

    // $("#next").click(() => {
    //     let temp = $(".content < a")[0];
    //     $($(".content < a")[0]).remove();
        
    //     $("#slider-content").append(temp);
    //     // console.log($(".content"));
    // });

    $("#prev").click(() => {
        let temp = $(".slider-content a").last();
        // console.log(temp);
        $(temp).remove();
        
        $("#slider-content").prepend(temp);
        // console.log($(".content"));
    });

    $("#next").click(() => {
        let temp = $(".slider-content a")[0];
        $($(".slider-content a")[0]).remove();
        
        $("#slider-content").append(temp);
        // console.log($(".content"));
    });
});