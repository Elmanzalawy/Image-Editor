function bootstrapAlert(type = "success", message, triggerElement = "main"){
    $(triggerElement).before(`<div class="alert alert-${type}" style="position:sticky width:100%; z-index:9999;">${message}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>`);
}
