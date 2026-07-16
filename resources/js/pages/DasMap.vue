<template>
    <div ref="mapContainer" class="w-full h-screen"></div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import L from 'leaflet'
import 'leaflet/dist/leaflet.css'

const mapContainer = ref(null)

onMounted(async () => {
    const map = L.map(mapContainer.value).setView([-2.5, 118], 5)

    L.tileLayer(
        'https://tile.openstreetmap.org/{z}/{x}/{y}.png',
        {
            attribution: '&copy; OpenStreetMap Contributors'
        }
    ).addTo(map)

    const response = await fetch('/geojson/batas_das.geojson')
    const geojson = await response.json()

    const dasLayer = L.geoJSON(geojson, {
        style: {
            color: '#2563eb',
            weight: 1,
            fillOpacity: 0.25
        },
        onEachFeature(feature, layer) {
            const p = feature.properties

            layer.bindPopup(`
                <b>DAS:</b> ${p.nama_das ?? '-'}<br>
                <b>Kode:</b> ${p.kd_das ?? '-'}<br>
                <b>Luas:</b> ${p.luas_ha ?? '-'} ha<br>
                <b>Wilayah:</b> ${p.wil_kerja ?? '-'}
            `)
        }
    }).addTo(map)

    map.fitBounds(dasLayer.getBounds())
})
</script>