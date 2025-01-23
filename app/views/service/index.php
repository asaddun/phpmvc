<div class="container">
    <form id="serviceForm" action="#" method="POST">
        <div name="Personal Data">
            <div class="text-center">
                <h4>Personal Data</h4>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="mb-2">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="(Character Name)">
                    </div>
                </div>
                <div class="w-100"></div>
                <div class="col-md-3">
                    <div class="mb-2">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone"
                            placeholder="(Character Phone)">
                    </div>
                </div>
                <div class="w-100"></div>
                <div class="col-md-3">
                    <div class="mb-2">
                        <label for="vehicle" class="form-label">Vehicle</label>
                        <input type="text" class="form-control" id="vehicle" name="vehicle">
                    </div>
                </div>
            </div>
        </div>
        <hr>

        <div name="Upgrades" class="mb-4">
            <div class="text-center">
                <h4>Upgrades</h4>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="engine">Engine:</label>
                        <select name="services[engine]" id="engine" class="form-select"
                            aria-label="Default select example">
                            <option value="0">No Changes</option>
                            <option value="1">Stock</option>
                            <option value="2">Stage I</option>
                            <option value="3">Stage II</option>
                            <option value="4">Stage III</option>
                            <option value="5">Stage IV</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="transmisi">Transmission:</label>
                        <select name="services[transmisi]" id="transmisi" class="form-select"
                            aria-label="Default select example">
                            <option value="0">No Changes</option>
                            <option value="6">Stock</option>
                            <option value="7">Street</option>
                            <option value="8">Sport</option>
                            <option value="9">Race</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="suspension">Suspension:</label>
                        <select name="services[suspension]" id="suspension" class="form-select"
                            aria-label="Default select example">
                            <option value="0">No Changes</option>
                            <option value="10">Stock</option>
                            <option value="11">Lower</option>
                            <option value="12">Street</option>
                            <option value="13">Sport</option>
                            <option value="14">Race</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="brake">Brakes:</label>
                        <select name="services[brake]" id="brake" class="form-select"
                            aria-label="Default select example">
                            <option value="0">No Changes</option>
                            <option value="15">Stock</option>
                            <option value="16">Street</option>
                            <option value="17">Sport</option>
                            <option value="18">Race</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="turbo">Turbo:</label>
                        <select name="services[turbo]" id="turbo" class="form-select"
                            aria-label="Default select example">
                            <option value="0">No Changes</option>
                            <option value="19">No Turbo</option>
                            <option value="20">Turbo</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="trunk">Trunk:</label>
                        <select name="services[trunk]" id="trunk" class="form-select"
                            aria-label="Default select example">
                            <option value="0">No Changes</option>
                            <option value="21">Capacity</option>
                            <option value="22">Slot</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <hr>

        <div name="Modifications" class="mb-4">
            <div class="text-center">
                <h4>Modifications</h4>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="bodyworks">Bodyworks:</label>
                        <input type="number" class="form-control" id="bodyworks" name="bodyworks" value="0"
                            min="0">
                        <div class="form-text">(Spoiler, Bumper, Side Skirt, Exhaust, Interior, etc..)</div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="tints">Tints:</label>
                        <select name="services[tints]" id="tints" class="form-select"
                            aria-label="Default select example">
                            <option value="0">No Changes</option>
                            <option value="24">No Tint</option>
                            <option value="25">Slight</option>
                            <option value="26">Moderate</option>
                            <option value="27">Full</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Tires:</label><br>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="services[rims]" value="28"
                                id="rims">
                            <label class="form-check-label" for="rims">
                                Rims
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="services[smoke]" value="29"
                                id="smoke">
                            <label class="form-check-label" for="smoke">
                                Smoke
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="services[radius]" value="30"
                                id="radius">
                            <label class="form-check-label" for="radius">
                                Radius
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="services[width]" value="31"
                                id="width">
                            <label class="form-check-label" for="width">
                                Width
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="services[chamber]" value="32"
                                id="chamber">
                            <label class="form-check-label" for="chamber">
                                Chamber
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="services[tiresuspension]"
                                value="33" id="tiresuspension">
                            <label class="form-check-label" for="tiresuspension">
                                Suspension Height
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="horns">Horns:</label>
                        <select name="services[horns]" id="horns" class="form-select"
                            aria-label="Default select example">
                            <option value="0">No Changes</option>
                            <option value="34">Stock</option>
                            <option value="35">Truck</option>
                            <option value="36">Police</option>
                            <option value="37">Clown</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <hr>

        <div name="Color & Paint" class="mb-4">
            <div class="text-center">
                <h4>Color & Paint</h4>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="colors">Colors:</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="services[fullcolor]"
                                value="38" id="full">
                            <label class="form-check-label" for="full">
                                Full Color
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="services[primarycolor]"
                                value="39" id="primary">
                            <label class="form-check-label" for="primary">
                                Primary
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="services[secondarycolor]"
                                value="40" id="secondary">
                            <label class="form-check-label" for="secondary">
                                Secondary
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="services[rimscolor]"
                                value="41" id="rimscolor">
                            <label class="form-check-label" for="rimscolor">
                                Rims
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="services[pearlescent]"
                                value="42" id="pearlescent">
                            <label class="form-check-label" for="pearlescent">
                                Pearlescent
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="headlights">Headlights:</label>
                        <select name="services[headlights]" id="headlights" class="form-select"
                            aria-label="Default select example">
                            <option value="0">No Changes</option>
                            <option value="43">Stock</option>
                            <option value="44">White Xenon</option>
                            <option value="45">Color Xenon</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="neon">Neon:</label>
                        <select name="services[neon]" id="neon" class="form-select"
                            aria-label="Default select example">
                            <option value="0">No Changes</option>
                            <option value="46">Neon</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <hr>

        <div name="Miscellaneous" class="mb-4">
            <div class="text-center">
                <h4>Miscellaneous</h4>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-2">
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="services[customplate]"
                                value="47" id="customplate">
                            <label class="form-check-label" for="customplate">
                                Custom Plate
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="services[engineswap]"
                                value="48" id="engineswap">
                            <label class="form-check-label" for="engineswap">
                                Engine Swap
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="services[backfire]" value="49"
                                id="backfire">
                            <label class="form-check-label" for="backfire">
                                Backfire/Anti-lag
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>

        <div class="text-center">
            <button type="submit" class="btn btn-primary mb-3">Booking</button>
        </div>
    </form>
</div>