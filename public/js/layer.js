class Layer{
    constructor(canvas, layerID){
        this.id = layerID;
        this.canvas = canvas.canvas;
        $(this.canvas).after(`<canvas class='layer' id='layer-${layerID}'>`);

        this.layer = document.getElementById(`layer-${layerID}`);
        this.ctx = this.layer.getContext("2d")
        this.original_width = canvas.original_width;
        this.original_height = canvas.original_width;

        $(this.layer).css({
            "position":"absolute",
            "left":"1.25rem",
            "top":"1.25rem",
            "width":"calc(100% - 2.5rem)",
            "height":"calc(100% - 2.5rem)",
        });
    }


}
