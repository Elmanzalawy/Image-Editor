<div class="col-lg-2 fade-in editor-ui" id="options-col">
    <div class="card bg-deep-dark my-2">
        <div class="card-header text-center">
            <h5>Edit Options</h5>
        </div>
        <div class="card-body">
                <h6><a data-toggle="collapse" href="#filtersCollapse" role="button" aria-expanded="false" aria-controls="filtersCollapse" onclick="toggleEditOptionsArrow(this)">
                    <span><i class="fas fa-arrow-right"></i></span> Filters
                </a>
                </h6>
                <div class="collapse" id="filtersCollapse">
                    <div class="form-group">
                        <label for="formControlRange">Blur</label>
                        <input id="blur-input" type="range" default='0' min="0" max="10"  value="0" class="filter-input form-control-range" id="formControlRange">
                    </div>
                    <div class="form-group">
                        <label for="formControlRange">Brightness</label>
                        <input id='brightness-input' min="0" max="200" value="100" step="1" type="range" class="filter-input form-control-range" id="formControlRange">
                    </div>
                    <div class="form-group">
                        <label for="formControlRange">Contrast</label>
                        <input id='contrast-input' type="range" min="0" max="200" value="100" step="1" class="filter-input form-control-range" id="formControlRange">
                    </div>
                    <div class="form-group">
                        <label for="formControlRange">Grayscale</label>
                        <input id='grayscale-input' type="range" min="0" max="100" value="0" step="1" class="filter-input form-control-range" id="formControlRange">
                    </div>
                    <div class="form-group">
                        <label for="formControlRange">Hue Rotate</label>
                        <input id='hue-input' type="range" min="0" max="360" value="0" step="1" class="filter-input form-control-range" id="formControlRange">
                    </div>
                    <div class="form-group">
                        <label for="formControlRange">Inversion</label>
                        <input id='invert-input' type="range" min="0" max="100" value="0" step="1" class="filter-input form-control-range" id="formControlRange">
                    </div>
                    <div class="form-group">
                        <label for="formControlRange">Saturation</label>
                        <input id='saturate-input' type="range" min="0" max="200" value="100" step="1" class="filter-input form-control-range" id="formControlRange">
                    </div>
                    <div class="form-group">
                        <label for="formControlRange">Sepia</label>
                        <input id='sepia-input' type="range" min="0" max="100" value="0" step="1" class="filter-input form-control-range" id="formControlRange">
                    </div>

                    <div class="form-group">
                        <button class="form-control btn btn-outline-danger btn-sm" onclick="resetFilters()"><i class="fas fa-undo"></i> Reset Filters</button>
                    </div>
                </div>
        </div>
    </div>

    <div class="card bg-deep-dark my-2">
        <div class="card-header text-center">
            <h5>Layers</h5>
        </div>
        <div class="card-body" id="layers-container">
        </div>
    </div>
</div>
