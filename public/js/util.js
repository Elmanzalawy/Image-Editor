function bootstrapAlert(type = "success", message, triggerElement = "main"){
    $(triggerElement).before(`<div class="alert alert-${type}" style="position:sticky width:100%; z-index:9999;">${message}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>`);
}

//change UI while editing
function editorMode(){
    $("main").children(".container")
    .removeClass('container')
    .addClass('container-fluid')
    .css({
        "padding-top":"2rem"
    });

    $(".default-ui").hide();
    $(".editor-ui").show();
}

function cancelEditing(){
    resetFilters();
    $("#tempImage").remove();

    $("main").children(".container-fluid")
    .removeClass('container-fluid')
    .addClass('container')
    .css({
        "padding-top":"0rem"
    });

    $(".default-ui").show();
    $(".editor-ui").hide();
}

function toggleEditOptionsArrow(link){
    let arrow = $(link).find(".fa-arrow-right");

    if($(arrow).hasClass('toggled')){
        $(arrow).css({
            "transform":"rotate(0deg)",
            "transition":"transform 0.3s linear"
        }).removeClass('toggled');
    }else{
        $(arrow).css({
            "transform":"rotate(90deg)",
            "transition":"transform 0.3s linear"
        });
        $(arrow).addClass("toggled");
    }
}


