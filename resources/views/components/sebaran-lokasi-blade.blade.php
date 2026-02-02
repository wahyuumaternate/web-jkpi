{{-- Sebaran Lokasi Section dengan Leaflet GIS + Google Maps Button (Fixed Styling) --}}
<section id="sebaran-lokasi" style="padding: 80px 0; background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe216 100%);">

    {{-- Leaflet CSS --}}
    @push('styles')
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet.markercluster@1.5.3/dist/MarkerCluster.css" />
        <link rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/leaflet.markercluster@1.5.3/dist/MarkerCluster.Default.css" />

        <style>
            .section-title-map {
                text-align: center;
                margin-bottom: 50px;
            }

            .section-title-map h2 {
                font-size: 2.8rem;
                font-weight: 800;
                color: #099aa7;
                margin-bottom: 15px;
                position: relative;
                display: inline-block;
            }

            .section-title-map h2::after {
                content: '';
                position: absolute;
                bottom: -10px;
                left: 50%;
                transform: translateX(-50%);
                width: 80px;
                height: 4px;
                background: linear-gradient(90deg, #099aa7, #077b86);
                border-radius: 2px;
            }

            .section-title-map p {
                font-size: 1.1rem;
                color: #666;
                max-width: 800px;
                margin: 20px auto 0;
            }

            #map-jkpi {
                height: 700px;
                width: 100%;
                border-radius: 15px;
                box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
                border: 3px solid #099aa7;
            }

            .map-container-jkpi {
                position: relative;
                margin-bottom: 40px;
            }

            .location-legend-jkpi {
                background: white;
                padding: 25px;
                border-radius: 12px;
                box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
                margin-top: 30px;
            }

            .legend-title-jkpi {
                font-size: 1.3rem;
                font-weight: 700;
                color: #099aa7;
                margin-bottom: 20px;
                display: flex;
                align-items: center;
                gap: 10px;
            }

            .legend-item-jkpi {
                display: flex;
                align-items: center;
                padding: 12px;
                margin-bottom: 10px;
                border-radius: 8px;
                transition: all 0.3s;
                cursor: pointer;
            }

            .legend-item-jkpi:hover {
                background: #f0f9fa;
                transform: translateX(5px);
            }

            .legend-icon-jkpi {
                width: 40px;
                height: 40px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                margin-right: 15px;
                font-size: 1.2rem;
                color: white;
            }

            .legend-text-jkpi h5 {
                margin: 0;
                font-size: 1rem;
                font-weight: 600;
                color: #333;
            }

            .legend-text-jkpi p {
                margin: 0;
                font-size: 0.85rem;
                color: #777;
            }

            .venue-main {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            }

            .heritage-site {
                background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            }

            .market-area {
                background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            }

            .workshop-room {
                background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
            }

            .stage-culture {
                background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
            }

            .map-controls-jkpi {
                position: absolute;
                top: 20px;
                right: 20px;
                z-index: 1000;
                background: white;
                padding: 15px;
                border-radius: 10px;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            }

            .control-btn-jkpi {
                display: block;
                width: 100%;
                padding: 8px 15px;
                margin-bottom: 8px;
                border: none;
                background: #099aa7;
                color: white;
                border-radius: 6px;
                cursor: pointer;
                font-size: 0.9rem;
                transition: all 0.3s;
            }

            .control-btn-jkpi:hover {
                background: #077b86;
                transform: translateY(-2px);
            }

            .stats-overview-jkpi {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                gap: 20px;
                margin-top: 30px;
            }

            .stat-card-jkpi {
                background: white;
                padding: 25px;
                border-radius: 12px;
                text-align: center;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
                transition: all 0.3s;
            }

            .stat-card-jkpi:hover {
                transform: translateY(-5px);
                box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            }

            .stat-card-jkpi i {
                font-size: 2.5rem;
                color: #099aa7;
                margin-bottom: 15px;
            }

            .stat-number-jkpi {
                font-size: 2rem;
                font-weight: 800;
                color: #099aa7;
                margin-bottom: 5px;
            }

            .stat-label-jkpi {
                font-size: 0.95rem;
                color: #666;
                font-weight: 500;
            }

            .custom-marker-icon {
                background: white;
                border: 3px solid #099aa7;
                border-radius: 50%;
                width: 35px;
                height: 35px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1.2rem;
                box-shadow: 0 3px 10px rgba(0, 0, 0, 0.3);
            }

            .popup-content-jkpi {
                padding: 0;
                min-width: 280px;
            }

            .popup-image-jkpi {
                width: 100%;
                height: 180px;
                object-fit: cover;
                border-radius: 8px 8px 0 0;
                margin-bottom: 12px;
            }

            .popup-body-jkpi {
                padding: 0 12px 12px 12px;
            }

            .popup-content-jkpi h4 {
                margin: 0 0 8px 0;
                color: #099aa7;
                font-weight: 700;
                font-size: 1.1rem;
            }

            .popup-content-jkpi p {
                margin: 5px 0;
                font-size: 0.9rem;
                color: #555;
                line-height: 1.4;
            }

            .popup-content-jkpi .distance-info {
                display: flex;
                gap: 15px;
                margin-top: 10px;
                padding-top: 10px;
                border-top: 1px solid #eee;
            }

            .distance-info span {
                display: flex;
                align-items: center;
                gap: 5px;
                font-size: 0.85rem;
                color: #099aa7;
                font-weight: 600;
            }

            .leaflet-popup-content-wrapper {
                padding: 0;
                border-radius: 12px;
                overflow: hidden;
            }

            .leaflet-popup-content {
                margin: 0;
                width: auto !important;
            }

            @media (max-width: 768px) {
                #map-jkpi {
                    height: 500px;
                }

                .section-title-map h2 {
                    font-size: 2rem;
                }

                .map-controls-jkpi {
                    top: 10px;
                    right: 10px;
                    padding: 10px;
                }
            }
        </style>
    @endpush

    <div class="container">

        <!-- Section Title -->
        <div class="section-title-map">
            <h2>Sebaran Lokasi Kegiatan</h2>
            <p>Peta interaktif menampilkan berbagai lokasi kegiatan Rakernas XII JKPI 2026 di Kota Ternate. Klik marker
                untuk detail dan dapatkan rute perjalanan</p>
        </div>
        {{-- <!-- Statistics Overview -->
        <div class="stats-overview-jkpi mb-5">
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
        </div> --}}
        <!-- Map Container -->
        <div class="map-container-jkpi">
            <div id="map-jkpi"></div>

            <!-- Map Controls -->
            <div class="map-controls-jkpi d-none d-md-block">
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


        <!-- Legend -->
        <div class="location-legend-jkpi ">
            <div class="legend-title-jkpi">
                <i class="bi bi-list-ul"></i>
                Kategori Lokasi di Kota Ternate
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="legend-item-jkpi" onclick="filterMarkersJKPI('venue-main')">
                        <div class="legend-icon-jkpi venue-main">
                            <i class="bi bi-building"></i>
                        </div>
                        <div class="legend-text-jkpi">
                            <h5>Venue Utama</h5>
                            <p>Gedung sidang pleno dan seminar</p>
                        </div>
                    </div>
                    <div class="legend-item-jkpi" onclick="filterMarkersJKPI('heritage-site')">
                        <div class="legend-icon-jkpi heritage-site">
                            <i class="bi bi-bank"></i>
                        </div>
                        <div class="legend-text-jkpi">
                            <h5>Situs Heritage</h5>
                            <p>Benteng, museum, dan keraton</p>
                        </div>
                    </div>
                    <div class="legend-item-jkpi" onclick="filterMarkersJKPI('market-area')">
                        <div class="legend-icon-jkpi market-area">
                            <i class="bi bi-shop"></i>
                        </div>
                        <div class="legend-text-jkpi">
                            <h5>Area Pasar Malam</h5>
                            <p>Pameran UMKM dan festival kuliner</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="legend-item-jkpi" onclick="filterMarkersJKPI('workshop-room')">
                        <div class="legend-icon-jkpi workshop-room">
                            <i class="bi bi-people"></i>
                        </div>
                        <div class="legend-text-jkpi">
                            <h5>Ruang Workshop</h5>
                            <p>Seminar dan diskusi kelompok</p>
                        </div>
                    </div>
                    <div class="legend-item-jkpi" onclick="filterMarkersJKPI('stage-culture')">
                        <div class="legend-icon-jkpi stage-culture">
                            <i class="bi bi-music-note-beamed"></i>
                        </div>
                        <div class="legend-text-jkpi">
                            <h5>Panggung Seni</h5>
                            <p>Pertunjukan seni dan budaya</p>
                        </div>
                    </div>
                </div>
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

            // Function to open Google Maps directions
            function openGoogleMapsRoute(lat, lng, placeName) {
                const googleMapsUrl =
                    `https://www.google.com/maps/dir/?api=1&destination=${lat},${lng}&destination_place_id=${encodeURIComponent(placeName)}`;
                window.open(googleMapsUrl, '_blank');
            }

            // Function to open Waze directions
            function openWazeRoute(lat, lng) {
                const wazeUrl = `https://waze.com/ul?ll=${lat},${lng}&navigate=yes`;
                window.open(wazeUrl, '_blank');
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
                    color: "#667eea",
                    image: "{{ asset('culture3.jpg') }}"
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
                    color: "#f5576c",
                    image: "{{ asset('culture3.jpg') }}"
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
                    color: "#f5576c",
                    image: "{{ asset('culture3.jpg') }}"
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
                    color: "#f5576c",
                    image: "{{ asset('culture3.jpg') }}"
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
                    color: "#f5576c",
                    image: "{{ asset('culture3.jpg') }}"
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
                    color: "#f5576c",
                    image: "{{ asset('culture3.jpg') }}"
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
                    color: "#00f2fe",
                    image: "{{ asset('culture3.jpg') }}"
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
                    color: "#00f2fe",
                    image: "{{ asset('culture3.jpg') }}"
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
                    color: "#00f2fe",
                    image: "{{ asset('culture3.jpg') }}"
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
                    color: "#38f9d7",
                    image: "{{ asset('culture3.jpg') }}"
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
                    color: "#38f9d7",
                    image: "{{ asset('culture3.jpg') }}"
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
                    color: "#38f9d7",
                    image: "{{ asset('culture3.jpg') }}"
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
                    color: "#fee140",
                    image: "{{ asset('culture3.jpg') }}"
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
                    color: "#fee140",
                    image: "{{ asset('culture3.jpg') }}"
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
                    color: "#fee140",
                    image: "{{ asset('culture3.jpg') }}"
                }
            ];

            // Store markers
            let markersJKPI = [];
            let markerClusterGroupJKPI = L.markerClusterGroup();

            // Add markers with INLINE STYLED buttons
            locationsJKPI.forEach(location => {
                const marker = L.marker([location.lat, location.lng], {
                    icon: createCustomIconJKPI(location.icon, location.color)
                }).bindPopup(`
                <div class="popup-content-jkpi">
                    <img src="${location.image}" alt="${location.name}" class="popup-image-jkpi" loading="lazy" onerror="this.src='{{ asset('culture3.jpg') }}'">
                    <div class="popup-body-jkpi">
                        <h4>${location.name}</h4>
                        <p>${location.description}</p>
                        <div class="distance-info">
                            <span><i class="bi bi-geo-alt-fill"></i> ${location.distance}</span>
                            <span><i class="bi bi-clock-fill"></i> ${location.time}</span>
                        </div>
                        
                        <!-- Google Maps Button dengan FULL INLINE STYLE -->
                        <a href="#" onclick="openGoogleMapsRoute(${location.lat}, ${location.lng}, '${location.name}'); return false;" 
                           style="display: block; width: 100%; margin-top: 12px; padding: 10px 15px; background: linear-gradient(135deg, #099aa7 0%, #099aa7 100%); color: white !important; text-align: center; text-decoration: none; border-radius: 8px; font-weight: 600; font-size: 0.9rem; box-shadow: 0 3px 10px rgba(66, 133, 244, 0.3); border: none; cursor: pointer; transition: all 0.3s ease;">
                            <i class="bi bi-map" style="margin-right: 6px;"></i>Dapatkan Rute (Google Maps)
                        </a>
                        
                       
                    </div>
                </div>
            `, {
                    maxWidth: 300,
                    className: 'custom-popup-jkpi'
                });

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
