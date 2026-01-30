{{-- Sebaran Lokasi Section dengan Leaflet GIS - Fokus Kota Ternate --}}
<section id="sebaran-lokasi" style="padding: 80px 0; background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe21c 100%);">

    <div class="container">

        <!-- Section Title -->
        <div class="section-title-map">
            <h2>Sebaran Lokasi Kegiatan</h2>
            <p>Peta interaktif menampilkan berbagai lokasi kegiatan Rakernas XII JKPI 2026 di Kota Ternate</p>
        </div>

        <!-- Map Container -->
        <div class="map-container-jkpi">
            <div id="map-jkpi"></div>

            <!-- Map Controls -->
            <div class="map-controls-jkpi">
                <button class="control-btn-jkpi" onclick="resetMapJKPI()">
                    <i class="bi bi-arrow-clockwise"></i> Reset View
                </button>
                <button class="control-btn-jkpi" onclick="showAllMarkersJKPI()">
                    <i class="bi bi-geo-alt-fill"></i> Tampilkan Semua
                </button>
                <button class="control-btn-jkpi" onclick="toggleFullscreen()">
                    <i class="bi bi-fullscreen"></i> Fullscreen
                </button>
            </div>
        </div>

        <!-- Statistics Overview -->
        <div class="stats-overview-jkpi">
            <div class="stat-card-jkpi">
                <i class="bi bi-geo-alt-fill"></i>
                <div class="stat-number-jkpi" id="total-locations-jkpi">15</div>
                <div class="stat-label-jkpi">Total Lokasi</div>
            </div>
            <div class="stat-card-jkpi">
                <i class="bi bi-building"></i>
                <div class="stat-number-jkpi">5</div>
                <div class="stat-label-jkpi">Situs Heritage</div>
            </div>
            <div class="stat-card-jkpi">
                <i class="bi bi-shop"></i>
                <div class="stat-number-jkpi">3</div>
                <div class="stat-label-jkpi">Area Pameran</div>
            </div>
            <div class="stat-card-jkpi">
                <i class="bi bi-clock"></i>
                <div class="stat-number-jkpi">5</div>
                <div class="stat-label-jkpi">Hari Kegiatan</div>
            </div>
        </div>

    </div>

    {{-- Leaflet JavaScript --}}
    @push('scripts')
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/leaflet.markercluster@1.5.3/dist/leaflet.markercluster.js"></script>

        <script>
            // Initialize map - centered on Ternate
            const mapJKPI = L.map('map-jkpi').setView([0.7893, 127.3614], 13);

            // Add tile layer
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors',
                maxZoom: 19
            }).addTo(mapJKPI);

            // Custom icon function
            function createCustomIconJKPI(icon, color) {
                return L.divIcon({
                    className: 'custom-div-icon',
                    html: `<div class="custom-marker-icon" style="border-color: ${color};">
                          <i class="bi ${icon}" style="color: ${color};"></i>
                       </div>`,
                    iconSize: [35, 35],
                    iconAnchor: [17.5, 35],
                    popupAnchor: [0, -35]
                });
            }

            // Location data - Fokus di Kota Ternate
            const locationsJKPI = [
                // Venue Utama
                {
                    name: "Hotel Ternate Kota",
                    category: "venue-main",
                    lat: 0.7893,
                    lng: 127.3614,
                    description: "Venue utama penyelenggaraan sidang pleno dan seminar JKPI 2026",
                    distance: "Pusat Kota",
                    time: "0 menit",
                    icon: "bi-building-fill",
                    color: "#667eea"
                },

                // Heritage Sites
                {
                    name: "Benteng Oranje",
                    category: "heritage-site",
                    lat: 0.7825,
                    lng: 127.3580,
                    description: "Benteng peninggalan Belanda untuk heritage tour",
                    distance: "1.2 km",
                    time: "5 menit",
                    icon: "bi-bank",
                    color: "#f5576c"
                },
                {
                    name: "Museum Kesultanan Ternate",
                    category: "heritage-site",
                    lat: 0.7910,
                    lng: 127.3700,
                    description: "Museum sejarah Kesultanan Ternate dan koleksi pusaka",
                    distance: "1.5 km",
                    time: "7 menit",
                    icon: "bi-bank",
                    color: "#f5576c"
                },
                {
                    name: "Benteng Kastela",
                    category: "heritage-site",
                    lat: 0.7650,
                    lng: 127.3450,
                    description: "Benteng bersejarah di pesisir Ternate",
                    distance: "3.8 km",
                    time: "12 menit",
                    icon: "bi-bank",
                    color: "#f5576c"
                },
                {
                    name: "Keraton Kesultanan Ternate",
                    category: "heritage-site",
                    lat: 0.7905,
                    lng: 127.3695,
                    description: "Istana Kesultanan Ternate yang masih aktif hingga kini",
                    distance: "1.4 km",
                    time: "6 menit",
                    icon: "bi-bank",
                    color: "#f5576c"
                },
                {
                    name: "Benteng Tolukko",
                    category: "heritage-site",
                    lat: 0.8125,
                    lng: 127.3525,
                    description: "Benteng bersejarah dengan pemandangan Gunung Gamalama",
                    distance: "4.2 km",
                    time: "15 menit",
                    icon: "bi-bank",
                    color: "#f5576c"
                },

                // Pasar Malam & Exhibition Area
                {
                    name: "Taman Merdeka",
                    category: "market-area",
                    lat: 0.7860,
                    lng: 127.3640,
                    description: "Lokasi Pasar Malam Indonesia dan pameran UMKM",
                    distance: "800 m",
                    time: "3 menit",
                    icon: "bi-shop",
                    color: "#00f2fe"
                },
                {
                    name: "Gamalama Mall",
                    category: "market-area",
                    lat: 0.7820,
                    lng: 127.3590,
                    description: "Area pameran produk unggulan daerah",
                    distance: "1.1 km",
                    time: "5 menit",
                    icon: "bi-shop",
                    color: "#00f2fe"
                },
                {
                    name: "Pasar Bastiong",
                    category: "market-area",
                    lat: 0.7755,
                    lng: 127.3615,
                    description: "Pasar tradisional untuk pameran kuliner nusantara",
                    distance: "2.0 km",
                    time: "8 menit",
                    icon: "bi-shop",
                    color: "#00f2fe"
                },

                // Workshop Rooms
                {
                    name: "Gedung DPRD Kota Ternate",
                    category: "workshop-room",
                    lat: 0.7870,
                    lng: 127.3680,
                    description: "Ruang workshop dan seminar pelestarian pusaka",
                    distance: "1.0 km",
                    time: "4 menit",
                    icon: "bi-people-fill",
                    color: "#38f9d7"
                },
                {
                    name: "Kampus IAIN Ternate",
                    category: "workshop-room",
                    lat: 0.7720,
                    lng: 127.3520,
                    description: "Lokasi diskusi kelompok dan pelatihan konservasi",
                    distance: "2.5 km",
                    time: "9 menit",
                    icon: "bi-people-fill",
                    color: "#38f9d7"
                },
                {
                    name: "Hotel Bela Internasional",
                    category: "workshop-room",
                    lat: 0.7880,
                    lng: 127.3625,
                    description: "Ruang seminar dan workshop ekonomi kreatif",
                    distance: "1.2 km",
                    time: "5 menit",
                    icon: "bi-people-fill",
                    color: "#38f9d7"
                },

                // Stage Culture
                {
                    name: "Stadion Gelora Kie Raha",
                    category: "stage-culture",
                    lat: 0.7950,
                    lng: 127.3750,
                    description: "Panggung utama pertunjukan seni budaya nusantara",
                    distance: "1.8 km",
                    time: "8 menit",
                    icon: "bi-music-note-beamed",
                    color: "#fee140"
                },
                {
                    name: "Taman Budaya Sultan Baabullah",
                    category: "stage-culture",
                    lat: 0.7840,
                    lng: 127.3620,
                    description: "Venue pertunjukan tari tradisional dan seni budaya",
                    distance: "900 m",
                    time: "4 menit",
                    icon: "bi-music-note-beamed",
                    color: "#fee140"
                },
                {
                    name: "Lapangan Ahmad Yani",
                    category: "stage-culture",
                    lat: 0.7885,
                    lng: 127.3605,
                    description: "Area pertunjukan seni jalanan dan festival kuliner",
                    distance: "1.0 km",
                    time: "4 menit",
                    icon: "bi-music-note-beamed",
                    color: "#fee140"
                }
            ];

            // Store markers
            let markersJKPI = [];
            let markerClusterGroupJKPI = L.markerClusterGroup();

            // Add markers
            locationsJKPI.forEach(location => {
                const marker = L.marker([location.lat, location.lng], {
                    icon: createCustomIconJKPI(location.icon, location.color)
                }).bindPopup(`
                <div class="popup-content-jkpi">
                    <h4>${location.name}</h4>
                    <p>${location.description}</p>
                    <div class="distance-info">
                        <span><i class="bi bi-geo-alt-fill"></i> ${location.distance}</span>
                        <span><i class="bi bi-clock-fill"></i> ${location.time}</span>
                    </div>
                </div>
            `);

                marker.category = location.category;
                markersJKPI.push(marker);
                markerClusterGroupJKPI.addLayer(marker);
            });

            mapJKPI.addLayer(markerClusterGroupJKPI);

            // Functions
            function resetMapJKPI() {
                mapJKPI.setView([0.7893, 127.3614], 13);
                markerClusterGroupJKPI.clearLayers();
                markersJKPI.forEach(marker => markerClusterGroupJKPI.addLayer(marker));
            }

            function showAllMarkersJKPI() {
                const group = new L.featureGroup(markersJKPI);
                mapJKPI.fitBounds(group.getBounds().pad(0.1));
            }

            function filterMarkersJKPI(category) {
                markerClusterGroupJKPI.clearLayers();
                const filtered = markersJKPI.filter(m => m.category === category);
                filtered.forEach(marker => markerClusterGroupJKPI.addLayer(marker));

                if (filtered.length > 0) {
                    const group = new L.featureGroup(filtered);
                    mapJKPI.fitBounds(group.getBounds().pad(0.2));
                }
            }

            function toggleFullscreen() {
                const mapElement = document.getElementById('map-jkpi');
                if (!document.fullscreenElement) {
                    mapElement.requestFullscreen();
                } else {
                    document.exitFullscreen();
                }
            }

            // Add scale
            L.control.scale({
                metric: true,
                imperial: false,
                position: 'bottomleft'
            }).addTo(mapJKPI);

            // Update counter
            document.getElementById('total-locations-jkpi').textContent = locationsJKPI.length;
        </script>
    @endpush

</section>
