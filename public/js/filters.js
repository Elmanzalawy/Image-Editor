//Filter Editor
let filters = {
    blur: $("#blur-input").val(),
    brightness: $("#brightness-input").val(),
    contrast: $("#contrast-input").val(),
    grayscale: $("#grayscale-input").val(),
    hue: $("#hue-input").val(),
    invert: $("#invert-input").val(),
    saturate: $("#saturate-input").val(),
    sepia: $("#sepia-input").val()
};

const DefaultFilters = Object.freeze({
    blur: 0,
    brightness: 100,
    contrast: 100,
    grayscale: 0,
    hue: 0,
    invert: 0,
    saturate: 100,
    sepia: 0,
});

function resetFilters(){
    applyFilters(DefaultFilters);

    for (const property in DefaultFilters) {
        $(`#${property}-input`).val(DefaultFilters[property]);

        filters[property] = DefaultFilters[property];
    }
    let canvas = new Canvas();
    canvas.render(true)

}

function applyFilters(filters){
    $("#canvas").css({
        "filter":`blur(${filters.blur}px) brightness(${filters.brightness}%) contrast(${filters.contrast}%) grayscale(${filters.grayscale}%) hue-rotate(${filters.hue}deg) invert(${filters.invert}%) saturate(${filters.saturate}%) sepia(${filters.sepia}%)`
    })

}

//on filter input change
$(".filter-input").each(function(){
    $(this).on('input', function(){

        filters.blur = $("#blur-input").val();
        filters.brightness = $("#brightness-input").val();
        filters.contrast = $("#contrast-input").val();
        filters.grayscale = $("#grayscale-input").val();
        filters.hue = $("#hue-input").val();
        filters.invert = $("#invert-input").val();
        filters.saturate = $("#saturate-input").val();
        filters.sepia = $("#sepia-input").val();

        applyFilters(filters);

        //filter:'none'; =>resets filters
    })
    .on('change', function(){
        console.log('test');
    });
})

