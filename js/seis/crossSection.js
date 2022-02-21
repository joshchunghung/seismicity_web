Map.pm.Toolbar.copyDrawControl('Polyline', {
    name: 'polyline',
    block: 'custom',
    title: 'Draw cross-section line',
    actions: actions,
});

// 刪除原本的icon，讓預設功能失效
const icon = $(".leaflet-pm-toolbar.leaflet-pm-custom.leaflet-bar.leaflet-control");
el = icon[0].lastChild;
elClone = el.cloneNode(true);
el.parentNode.replaceChild(elClone, el);

// 添加圖示
let polylines = new L.layerGroup();
function setpoly() {
    var pts =
        [
            [markerA.getLatLng().lat, markerA.getLatLng().lng],
            [markerB.getLatLng().lat, markerB.getLatLng().lng]
        ];

    polylines.clearLayers();
    linecolor = 'black';
    if ($('.leaflet-layer[style*="z-index: 4"]').length === 1) {
        linecolor = 'white';
    }
    var polyline = L.polyline(pts, { color: linecolor });
    polylines.addLayer(polyline);
    polylines.addTo(Map);


}
function changeposition(pt) {
    var marker;
    var cha;
    if (pt == 0) {
        marker = markerA;
        cha = 'a';
    } else if (pt == 1) {
        marker = markerB;
        cha = 'b';
    }
    marker.setLatLng([parseFloat($("#form-location-" + cha + "-lat").val()), parseFloat($("#form-location-" + cha + "-lon").val())]);
    setpoly();
}
//  監聽 經緯度
$('.control-icon.leaflet-pm-icon-rectangle')[0].addEventListener('click', () => {
    Map.eachLayer(layer => {
        if (layer._drawnByGeoman) { layer.remove() }
    })

    if (Map.hasLayer(polylines)) {
        Map.removeLayer(polylines)
        Map.removeLayer(markerA)
        Map.removeLayer(markerB)
        polylines.clearLayers()
        $('#crossPanel').hide();

    }
})

//  監聽 abline
$('.control-icon.leaflet-pm-icon-polyline')[0].addEventListener('click', (e) => {
    e.preventDefault();

    Map.eachLayer(layer => {
        if (layer._drawnByGeoman) { layer.remove() }
    })

    if (Map.hasLayer(polylines)) {
        Map.removeLayer(polylines)
        Map.removeLayer(markerA)
        Map.removeLayer(markerB)
        polylines.clearLayers()
        $('#crossPanel').hide();

    } else {
        $('#crossPanel').show();
        markerA = L.marker([parseFloat($("#form-location-a-lat").val()), parseFloat($("#form-location-a-lon").val())], { icon: L.icon.glyph({ prefix: '', cssClass: 'sans-serif', glyph: 'A' }), draggable: true }).addTo(Map);
        markerB = L.marker([parseFloat($("#form-location-b-lat").val()), parseFloat($("#form-location-b-lon").val())], { icon: L.icon.glyph({ prefix: '', cssClass: 'sans-serif', glyph: 'B' }), draggable: true }).addTo(Map);
        setpoly();

        markerA.on('dragend', function (e) {
            //console.log(markerA.getLatLng().lat);
            $("#form-location-a-lat").val(markerA.getLatLng().lat.toFixed(2));
            $("#form-location-a-lon").val(markerA.getLatLng().lng.toFixed(2));
            setpoly();
        });
        markerB.on('dragend', function (e) {
            //console.log(markerA.getLatLng().lat);
            $("#form-location-b-lat").val(markerB.getLatLng().lat.toFixed(2));
            $("#form-location-b-lon").val(markerB.getLatLng().lng.toFixed(2));
            setpoly();
        });

    }
});



function drawCrossSection() {
    $('#load').show();
    let cosObj = new URLSearchParams();
    cosObj.append('stdate', '333');
    axios.post('./py/test.py', cosObj)
        .then(response => {
            $('#load').hide();
            console.log(response.data)
        })
        .catch((error) => {
            $('#load').hide();
            getError(1)
        });


}


