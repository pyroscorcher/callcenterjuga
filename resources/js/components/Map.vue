<template>
  <div ref="mapContainer" style="height: 500px;"></div>
</template>

<script setup>
import { onMounted } from 'vue'
import L from 'leaflet'
import 'leaflet/dist/leaflet.css'
import { ref, onMounted } from 'vue'
import L from '@/lib/leaflet'

onMounted(() => {
  const map = L.map('map').setView([-6.5971, 106.8060], 13)

  L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenStreetMap contributors',
  }).addTo(map)

  L.marker([-6.5971, 106.8060])
    .addTo(map)
    .bindPopup('Hello Laravel + Vue!')
})
</script>