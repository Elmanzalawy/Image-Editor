function renderCanvas(resetCanvas=false){
    var canvas = document.getElementById("canvas");
    var ctx = canvas.getContext("2d");
    //create a temporary image tag to draw it on canvas
    let img = document.getElementById("tempImage");

    let width = img.width;
    let height = img.height;
    canvas.width = width;
    canvas.height = height;
    let canvasWidth = canvas.width;
    let canvasHeight = canvas.height;

    // console.log({filters})

    if(resetCanvas == true){
        ctx.filter='none';
    }else{
        ctx.filter = `blur(${filters.blur}px) brightness(${filters.brightness}%) contrast(${filters.contrast}%) grayscale(${filters.grayscale}%) hue-rotate(${filters.hue}deg) invert(${filters.invert}%) saturate(${filters.saturate}%) sepia(${filters.sepia}%)`;
    }

    ctx.drawImage(img, 0, 0, img.width,    img.height,     // source rectangle
    0, 0, canvas.width, canvas.height);
    return canvas;
}

function saveImage(button){
    var canvas = renderCanvas();

    //download as png
    var link = document.getElementById('download-link');
    link.setAttribute('download', fileName);
    link.setAttribute('href', canvas.toDataURL("image/png").replace("image/png", "image/octet-stream"));
    link.click();

    renderCanvas(true)

}
