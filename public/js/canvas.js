

function saveImage(button){
    let canvas = new Canvas();

    //download as png
    var link = document.getElementById('download-link');
    link.setAttribute('download', fileName);
    link.setAttribute('href', canvas.canvas.toDataURL("image/png").replace("image/png", "image/octet-stream"));
    link.click();

    canvas.render(true)
}

// Digital Image Processing reference: https://www.tutorialspoint.com/dip/optical_character_recognition.htm
class Canvas{

    constructor(canvas = document.getElementById("canvas")){
        this.canvas = canvas;
        this.img = document.getElementById("tempImage");

        this.ctx = canvas.getContext("2d")

        this.original_width = this.img.width;
        this.original_height =this.img.height;
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
        return this.canvas;
    }

    // Drawing on canvas
    draw(startCoords,e){

        var rect = this.canvas.getBoundingClientRect(); //get canvas offsets

        //we use a scale due to the different sizes between the canvas and the actual element
        let scaleX = this.canvas.width / rect.width;
        let scaleY = this.canvas.height / rect.height;

        let x = (e.clientX - rect.left) * scaleX;
        let y = (e.clientY - rect.top) * scaleY;

        let startX = (startCoords.x - rect.left) * scaleX;
        let startY = (startCoords.y - rect.top) * scaleY;

        // this.ctx.clearRect(300, 300, 300, 300);
        this.render();
        this.ctx.beginPath();
        this.ctx.lineWidth = Math.round(this.canvas.width * 0.002);
        // this.ctx.setLineDash([4]);
        this.ctx.strokeStyle = "red";
        this.ctx.rect(startX, startY, x-startX, y-startY);
        // this.ctx.fillStyle = "#FF000010";
        // this.ctx.fillRect(startX, startY, x-startX, y-startY);
        this.ctx.stroke();


    }
}

let startCoords = {x:0,y:0};
let canvas;
function canvasSelect(e){
    canvas.draw(startCoords, e)
    // $("#canvas").on('mouseup',function(e){
    //     mouseDown = false;
    // });
    // e = new MouseEvent("ev");
    // document.dispatchEvent(e);
    // console.log(e)
    // console.log(`Frame: ${animationId} -- ${mouseDown}`)
    // console.log({startCoords})
    // console.log(e.clientX, e.clientY)
    // if(mouseDown==true){
    //     animationId = requestAnimationFrame(selectLoop);
    // }
}

$("#canvas").on('mousedown',function(e){
    e.preventDefault();
    e.stopPropagation();
    canvas = new Canvas();

    startCoords.x = e.clientX;
    startCoords.y = e.clientY;

    mouseDown=true;
    this.addEventListener('mousemove', canvasSelect);
    // selectLoop()
    // let canvas = new Canvas();
}).on('mouseup', function(e){
    mouseDown = false;
    this.removeEventListener('mousemove', canvasSelect);
});
