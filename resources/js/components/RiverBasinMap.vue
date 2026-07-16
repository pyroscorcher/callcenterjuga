<template>
  <div ref="mapContainer" class="w-full h-[600px] rounded-lg"></div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import L from 'leaflet'
import 'leaflet/dist/leaflet.css'
import shp from 'shpjs'

// Fix Leaflet marker icons for Vite
import markerIcon2x from 'leaflet/dist/images/marker-icon-2x.png'
import markerIcon from 'leaflet/dist/images/marker-icon.png'
import markerShadow from 'leaflet/dist/images/marker-shadow.png'

delete L.Icon.Default.prototype._getIconUrl
L.Icon.Default.mergeOptions({
  iconRetinaUrl: markerIcon2x,
  iconUrl: markerIcon,
  shadowUrl: markerShadow,
})

const mapContainer = ref(null)

onMounted(async () => {
  // Create map centered on Indonesia
  const map = L.map(mapContainer.value).setView([-2.5, 118], 5)

  // OpenStreetMap tiles
  L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenStreetMap contributors',
  }).addTo(map)

  try {
    // Load shapefile ZIP
  const response = await fetch('/shapefile/Batas_DAS_KLHK.zip')

  console.log('Status:', response.status)

  const buffer = await response.arrayBuffer()

  console.log('Buffer size:', buffer.byteLength)

  const geojson = await shp(buffer)

  console.log(geojson)

    // Add river basin layer
    const layer = L.geoJSON(geojson, {
      style: {
        color: '#2563EB',
        weight: 1,
        fillColor: '#60A5FA',
        fillOpacity: 0.3,
      },
      onEachFeature: (feature, layer) => {
        if (feature.properties) {
          const props = Object.entries(feature.properties)
            .map(([key, value]) => `<b>${key}</b>: ${value}`)
            .join('<br>')

          layer.bindPopup(props)
        }
      },
    }).addTo(map)

    // Zoom to shapefile bounds
    map.fitBounds(layer.getBounds())
  } catch (error) {
    console.error('Error loading shapefile:', error)
  }
})
</script>
  