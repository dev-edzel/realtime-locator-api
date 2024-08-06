import "./bootstrap";
import.meta.glob(["../js/*"])

document.addEventListener('DOMContentLoaded', function () {
    const map = L.map('map').setView([14.5547, 121.0244], 13);
    const busMarkers = {};

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    const rootUrl = "http://127.0.0.1:8000";

    const connectWebSocket = (busId) => {
        window.Echo.channel(`bus-location.${busId}`)
            .listen('location.updated', (e) => {
                updateBusLocation(busId, e.latitude, e.longitude);
            });
    };

    const updateBusLocation = (busId, latitude, longitude) => {
        if (busMarkers[busId]) {
            busMarkers[busId].setLatLng([latitude, longitude]);
        } else {
            busMarkers[busId] = L.marker([latitude, longitude]).addTo(map)
                .bindPopup(`Bus ID: ${busId}`)
                .openPopup();
        }
        map.setView([latitude, longitude], 13);
    };

    const getBusLocations = async () => {
        try {
            const response = await axios.get(`${rootUrl}/api/buses`);
            const buses = response.data;
            buses.forEach(bus => {
                connectWebSocket(bus.id);
                getLatestLocation(bus.id);
                setInterval(() => getLatestLocation(bus.id), 10000);
            });
        } catch (err) {
            console.log(err.message);
        }
    };

    const getLatestLocation = async (busId) => {
        try {
            const response = await axios.get(`${rootUrl}/api/bus/latest-location/${busId}`);
            const location = response.data;
            updateBusLocation(busId, location.latitude, location.longitude);
        } catch (err) {
            console.log(err.message);
        }
    };

    const updateBusLocationServer = async (busId, latitude, longitude) => {
        try {
            await axios.post(`${rootUrl}/api/bus/update-location`, {
                bus_id: busId,
                location: 'current',
                latitude: latitude,
                longitude: longitude
            });
        } catch (err) {
            console.log(err.message);
        }
    };

    const startUpdatingBusLocations = () => {
        setInterval(async () => {
            try {
                const response = await axios.get(`${rootUrl}/api/buses`);
                const buses = response.data;
                buses.forEach(async bus => {
                    const locationResponse = await axios.get(`${rootUrl}/api/bus/latest-location/${bus.id}`);
                    const location = locationResponse.data;
                    updateBusLocationServer(bus.id, location.latitude, location.longitude);
                });
            } catch (err) {
                console.log(err.message);
            }
        }, 10000);
    };

    getBusLocations();
    startUpdatingBusLocations();
});
