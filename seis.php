<!doctype html>
<html lang="en">
<?php
include("head.php");

?>


<body>
    <?php
    include("header.php");
    ?>
    <meta name='author' content="Josh ,Chung-Hung Lo">
    <div id="main" class="container">
        <header class="container">
            <div class="row">
                <h2 class="col-lg-2 col-sm-12 d-flex align-items-center"> NOTICE </h2>
                <p class="col-lg-7 col-sm-12">This page ONLY provides the seismicity map.
                    <br>
                    If you need the detailed event list, please visit the
                    <a href="https://gdmsn.cwb.gov.tw/index.php" target='_blank'>CWB_GDMS</a>.
                </p>
            </div>

        </header>

        <!-- map and chosen -->
        <div id="workspace" class="container ">
            <div id="position" class="row">
                <!-- left map -->
                <div id="Map" class="col-lg-6 col-sm-12"></div>
                <div id="legPos">
                    <div id="depscale"></div>
                    <div id="MLscale"></div>
                </div>

                <!-- legend -->

                <!-- right chosen -->
                <form id="filter" class="col-lg-6 col-sm-12">
                    <!-- catalog-->
                    <div class="panel">
                        <div class="panel-label panel-label-corner">Catalog</div>
                        <div class="d-flex justify-content row ">
                            <select id="catalog" name="catalog" class="form-control  col-11">
                                <option>Recent 90 days</option>
                                <option>Archived</option>
                            </select>

                            <!-- help icon -->
                            <div id="helpIcon" class="col-1">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000">
                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                    <path d="M11 7h2v2h-2zm0 4h2v6h-2zm1-9C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z" />
                                </svg>
                                <div class="hover col-sm-12"><b>Recent 90 days</b> : CWB Rapid Reports
                                    <br>
                                    <b>Archived</b> : revised by CWB. (1991-01-01~)
                                </div>
                            </div>


                        </div>
                    </div>
                    <!-- date-->
                    <div class="panel" id="date_panel" style="background-color: rgb(200, 200, 200)">
                        <div id="dateUTC" class="panel-label panel-label-corner">Date (UTC) </div>
                        <div class="text-end">
                            <input id="datefrom" type="date" name="date" class="form-control col-lg-5 col-md-3 " min="1991-01-01" max="9999-12-31" disabled="disabled">-
                            <input id="dateto" type="date" name="date" class="form-control col-lg-5 col-md-3 " max="9999-12-31" disabled="disabled">
                        </div>
                    </div>
                    <!-- depth -->
                    <div class="panel">
                        <div class="panel-label panel-label-corner">Depth (km)</div>
                        <div class="panel-tight text-end">
                            <input type="text" class="form-control number text-end" id="depthMin" name="depth" min="0" value="0">-
                            <input type="text" class="form-control number text-end" id="depthMax" name="depth" max="6371" value="1000">
                        </div>
                    </div>

                    <!--Magnitude -->
                    <div class="panel">
                        <div class="panel-label panel-label-corner">ML</div>
                        <div class="panel-tight text-end">
                            <input type="text" class="form-control number text-end" id="magMin" name="mag" value="3">-
                            <input type="text" class="form-control number text-end" id="magMax" name="mag" value="10" max="10">
                        </div>
                    </div>
                    <!-- location -->
                    <div class="panel">
                        <div class="panel-label panel-label-corner">Location</div>
                        <div class="panel-tight text-center">
                            <table class="nsew-table">
                                <tbody>
                                    <tr>
                                        <td>
                                            <label for="lonMin">W</label>
                                            <input type="text" size="8" class="form-control number " id="lonMin" name="lonMin" value="120">
                                        </td>
                                        <td>
                                            <label for="latMax">N</label><br>
                                            <input type="text" size="8" class="form-control number " id="latMax" name="latMax" value="26">
                                            <br>
                                            <input type="text" size="8" class="form-control number " id="latMin" name="latMin" value="21">
                                            <br>
                                            <label for="latMin">S</label>
                                        </td>
                                        <td>
                                            <input type="text" size="8" class="form-control number" id="lonMax" name="lonMax" value="126">
                                            <label for="lonMax">E</label>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- legend  function-->
                    <div class="panel">
                        <div class="panel-label panel-label-corner"> Functions</div>
                        <div class="panel-tight  row ">
                            <!-- <div class="offset-lg-5  offset-md-6  offset-sm-4"> -->
                            <!-- <div class="text-start p-1"> -->
                            <div class=" text-start col-lg-6  col-sm-12 marginTop">
                                <input type="checkbox" id="Depth_legend" onclick="openLegend(0)" checked="">
                                <b>Depth Legend</b>
                            </div>
                            <!-- <div class=" text-start p-1"> -->
                            <div class="text-start col-lg-6  col-sm-12 marginTop">
                                <input type="checkbox" id="ML_legend" onclick="openLegend(1)" checked="">
                                <b>ML Legend</b>
                            </div>
                            <!-- <div class=" text-start p-1"> -->
                            <div class="w-100"></div>
                            <div class="text-start col-lg-6  col-sm-12">
                                <input type="checkbox" id="grid" onclick="toggleGrid()">
                                <b>Grid Line</b>
                            </div>
                            <!-- <div class=" text-start p-1"> -->
                            <div class="text-start col-lg-6 col-sm-12">
                                <input type="checkbox" id="fault" onclick="toggleFault()">
                                <b>Fault Line</b>
                            </div>
                            <!-- </div> -->
                        </div>
                    </div>


                    <div class="panel">
                        <div class="panel-label panel-label-corner"> Size</div>
                        <div class="panel-tight text-end row">
                            <div class="col-md-12  ">
                                <label for="circle_size "><b>Circle Size</b></label>
                                <input type="text" class="form-control number text-end" id="circle_size" value="5">
                            </div>
                        </div>
                    </div>
                    <!-- submit bottom-->
                    <div class="container">
                        <input id="submit" type="button" value="submit" class="btn btn-success" onclick="get_events()">
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div id="crossPanel" class="container ">
        <div class="accordion" id="accordionPanelsStayOpenExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                        Cross Section Panel
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
                    <div class="accordion-body">
                        <!--經緯度 -->
                        <div class="panel-body">

                            <label>Point A Location</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">Lon</span>
                                        <input id="form-location-a-lon" class="form-control text-end" value="120.00" onchange="changeposition(0)">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">Lat</span>
                                        <input id="form-location-a-lat" class="form-control text-end" value="24.00" onchange="changeposition(0)">
                                    </div>
                                </div>
                            </div>
                            <!--/.row-->
                            <label>Point B Location</label>
                            <div class="row">
                                <div class="col-md-6 text-right">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">Lon</span>
                                        <input id="form-location-b-lon" class="form-control text-end" value="121.83" onchange="changeposition(1)">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">Lat</span>
                                        <input id="form-location-b-lat" class="form-control text-end" value="23.42" onchange="changeposition(1)">
                                    </div>
                                </div>
                            </div>
                            <!--/.row-->

                            <div class="row">
                                <div class="col-md-6 text-right">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">Depth Max</span>
                                        <input id="form-depth-max" class="form-control text-end" value="60">
                                        <span class="input-group-text">km</span>
                                    </div>
                                </div>
                                <div class="col-md-6 text-right">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">Project Width</span>
                                        <input id="form-depth-max" class="form-control text-end" value="5">
                                        <span class="input-group-text">km</span>
                                    </div>
                                    <!--/.row-->
                                </div>
                            </div>
                            <!-- /經緯度 -->
                        </div>
                    </div>
                    <div class="container text-end">
                        <input id="submit" type="button" value="Draw AB Cross Section" class="btn btn-info" onclick="drawCrossSection()">
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div id="output_area" class="container">
        <h4 class="col-12">Criteria</h4>
        <span>Event catalog is provided by <a href="https://www.cwb.gov.tw/eng/" target='_blank'>Central Weather Bureau, Taiwan</a>.</span>
        <br>
        <span>Fault lines are provided by <a href="http://tao.cgu.org.tw/index.php/articles/archive/geophysics/item/1376-tao" target='_blank'>Shyu et al., 2016</a>.</span>
        <br><br>
        <p id="output"></p>
    </div>


    <div id="load">
        <div class="d-flex justify-content-center row">
            <div class="  spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="visually-hidden"></span>
            </div>
            <br>
            <span class="align-middle text-center">Loading...</span>
        </div>
    </div>



    <?php
    include("footer.php");
    ?>



</body>
<?php include("jsInclude.php"); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- leaflet js -->
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin="anonymous"></script>
<script src="https://unpkg.com/@geoman-io/leaflet-geoman-free@latest/dist/leaflet-geoman.min.js"></script>
<script src="https://d3js.org/d3.v7.min.js"></script>

<!--map-->
<script type="text/javascript" src="./js/seis/checkinput.js"></script>
<script type="text/javascript" src="./js/seis/latlon.js"></script>
<script type="text/javascript" src="./js/seis/getNowTime.js"></script>
<script type="text/javascript" src="./js/seis/map.js"></script>
<script type="text/javascript" src="./js/seis/changemode.js"></script>
<script type="text/javascript" src="./js/seis/Leaflet.Icon.Glyph.js"></script>
<script type="text/javascript" src="./js/seis/crossSection.js"></script>

</html>