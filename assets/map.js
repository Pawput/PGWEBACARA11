// ==========================================
// KONFIGURASI PETA LEAFLET
// ==========================================

// Membuat peta utama
var map = L.map("map").setView(
    [-7.9, 110.35],
    10
);

// ==========================================
// BASEMAP OPENSTREETMAP
// ==========================================

var osm = L.tileLayer(
    "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
    {
        maxZoom: 19,
        attribution:
            '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }
);

osm.addTo(map);

// ==========================================
// GEOSERVER WMS CONFIGURATION
// ==========================================

var geoserverURL =
    "http://localhost:8080/geoserver/wms";

// Layer administrasi kecamatan Bantul
var layerBantul = L.tileLayer.wms(
    geoserverURL,
    {
        layers: "pgweb:Bantul_Admin_Kec",
        format: "image/png",
        transparent: true,
        version: "1.1.0"
    }
);

// Menampilkan layer pada peta
layerBantul.addTo(map);

// ==========================================
// BASEMAP CONTROL
// ==========================================

var baseMaps = {
    "OpenStreetMap": osm
};

// ==========================================
// OVERLAY CONTROL
// ==========================================

var overlayMaps = {
    "Batas Kecamatan Bantul": layerBantul
};

// Menambahkan kontrol layer
L.control.layers(
    baseMaps,
    overlayMaps,
    {
        collapsed: false
    }
).addTo(map);

// ==========================================
// SCALE CONTROL
// ==========================================

L.control.scale({
    position: "bottomleft",
    metric: true,
    imperial: false
}).addTo(map);

// ==========================================
// KOORDINAT PETA
// ==========================================

map.on("click", function (e) {

    var latitude = e.latlng.lat.toFixed(6);
    var longitude = e.latlng.lng.toFixed(6);

    L.popup()
        .setLatLng(e.latlng)
        .setContent(
            "<b>Koordinat Lokasi</b><br>" +
            "Latitude: " + latitude + "<br>" +
            "Longitude: " + longitude
        )
        .openOn(map);

});

// ==========================================
// STATUS LAYER GEOSERVER
// ==========================================

layerBantul.on("loading", function () {

    console.log("Memuat layer GeoServer...");

});

layerBantul.on("load", function () {

    console.log("Layer Bantul berhasil dimuat.");

});

layerBantul.on("tileerror", function (error) {

    console.error(
        "Terjadi kesalahan saat memuat WMS:",
        error
    );

});

// ==========================================
// INFORMASI PETA
// ==========================================

console.log("WebGIS PGWEB Acara 11 aktif.");
console.log("GeoServer:", geoserverURL);
console.log("Workspace: pgweb");
console.log("Layer: Bantul_Admin_Kec");
