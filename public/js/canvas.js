let SELECT_MODE = false;
// Digital Image Processing reference: https://www.tutorialspoint.com/dip/optical_character_recognition.htm
class Canvas{

    constructor(canvas = document.getElementById("canvas")){
        this.canvas = canvas;
        this.img = document.getElementById("tempImage");

        this.ctx = canvas.getContext("2d")

        this.original_width = this.img.width;
        this.original_height =this.img.height;
        this.layers = [];
    }

    static saveImage(button){
        //download as png
        canvas.render()

        var link = document.getElementById('download-link');
        link.setAttribute('download', fileName);
        link.setAttribute('href', canvas.canvas.toDataURL("image/png").replace("image/png", "image/octet-stream"));
        link.click();

        canvas.render(true)
    }

    //render the canvas HTML
    render(resetCanvas=false){
        // var canvas = document.getElementById("canvas");
        // var ctx = canvas.getContext("2d");
        // //create a temporary image tag to draw it on canvas
        // let img = document.getElementById("tempImage");

        // let width = img.width;
        // let height = img.height;
        this.canvas.width = this.original_width;
        this.canvas.height = this.original_height;

        // console.log({filters})

        if(resetCanvas == true){
            this.ctx.filter='none';
        }else{
            this.ctx.filter = `blur(${filters.blur}px) brightness(${filters.brightness}%) contrast(${filters.contrast}%) grayscale(${filters.grayscale}%) hue-rotate(${filters.hue}deg) invert(${filters.invert}%) saturate(${filters.saturate}%) sepia(${filters.sepia}%)`;
        }

        this.ctx.drawImage(this.img, 0, 0, this.original_width,    this.original_height,     // source rectangle
        0, 0, this.original_width, this.original_height);
        this.ctx.save(); //save default canvas state
        return this.canvas;
    }

    // Drawing on canvas
    draw(startCoords,e){
        var layer = e.target;

        layer.width = this.original_width;
        layer.height = this.original_height;
        var ctx = layer.getContext("2d");
        var rect = layer.getBoundingClientRect(); //get canvas offsets

        //we use a scale due to the different sizes between the canvas and the actual element
        let scaleX = layer.width / rect.width;
        let scaleY = layer.height / rect.height;

        let x = (e.clientX - rect.left) * scaleX;
        let y = (e.clientY - rect.top) * scaleY;

        let startX = (startCoords.x - rect.left) * scaleX;
        let startY = (startCoords.y - rect.top) * scaleY;

        ctx.clearRect(0, 0, rect.width, rect.height);
        console.log({ctx})

        //create new layer
        // ctx.clearRect(0,0,900,900)
        ctx.beginPath();
        ctx.lineWidth = Math.round(rect.width * 0.002);
        // ctx.lineWidth = 2;
        // ctx.setLineDash([4]);
        ctx.strokeStyle = "red";
        ctx.rect(startX, startY, x-startX, y-startY);
        // ctx.rect(0,0,e.clientX,e.clientY);
        // ctx.fillStyle = "#FF000010";
        // ctx.fillRect(startX, startY, x-startX, y-startY);
        ctx.stroke();

    }

    //create new layer
    rasterizeLayer(){
        var layer;
        console.log('rasterize')
        var layer_id = this.layers.length + 1;

        console.log(this.layers.length)
        if(this.layers.length == 0){
            $(this.canvas).after(`<canvas id='layer-${layer_id}'>`)
        }else{
            layer_id = this.layers.length + 1;
            $(this.canvas).after(`<canvas id='layer-${layer_id}'>`);
        }

        layer = $(`#layer-${layer_id}`);
        $(layer).css({
            "position":"absolute",
            "left":"1.25rem",
            "top":"1.25rem",
            "width":"calc(100% - 2.5rem)",
            "height":"calc(100% - 2.5rem)",
            // "width":`${$("#canvas").width()}`,
            // "height":`${$("#canvas").height()}`,
        })

        this.layers.push(layer);
        // console.log({layer_id}, {layer})
        return layer;
    }

    saveImage(button){
        //download as png
        var link = document.getElementById('download-link');
        link.setAttribute('download', fileName);
        link.setAttribute('href', canvas.canvas.toDataURL("image/png").replace("image/png", "image/octet-stream"));
        link.click();

        canvas.render(true)
    }
}

let startCoords = {x:0,y:0};
// let canvas;
function canvasSelect(e){
    console.log({startCoords})

    canvas.draw(startCoords, e)
}

function canvasToggleSelectMode(el){
    //if already in select mode, toggle it off
    // if($(el).children().eq(0).hasClass("action-icon-selected")){
    if(SELECT_MODE == true){
        SELECT_MODE = false;
        console.log("select mode off")
        $("canvas").off('mousedown mousemove mouseup');
        $(el).children().eq(0).removeClass("action-icon-selected")
    }
    //init select mode
    else{
        SELECT_MODE = true;
        console.log("select mode on")

        // canvas = new Canvas();
        $(el).children().eq(0).addClass("action-icon-selected");
        $("canvas").on('mousedown',function(e){
            console.log("mousedown")
            e.preventDefault();
            e.stopPropagation();



            var layer = canvas.rasterizeLayer()
            startCoords.x = e.clientX;
            startCoords.y = e.clientY;

            $(layer).on('mousemove', canvasSelect);
            $(layer).on('mouseup', function(e){
                SELECT_MODE = false;
                console.log("mouseup")
                // canvas.rasterizeLayer(e)
                $(layer).off('mousemove mouseup');
            });

        })
    }

}

