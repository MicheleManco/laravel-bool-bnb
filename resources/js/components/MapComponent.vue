<template>
    <div class="container">
        <div id="map" class="map" style="height: 400px"></div>
    </div>
</template>

<script>
import tt from "@tomtom-international/web-sdk-maps";

export default {
    props: {
        latitude: String,
        longitude: String,
    },

    data() {
        return {
            coordinates: [this.longitude, this.latitude],
        };
    },
    mounted() {
        var map = tt.map({
            container: "map",
            key: "GJpBcQsMGEGTQjwmKY9ABdIiOR9gVzuk",
            center: this.coordinates,
            zoom: 15,
        });

        var marker = new tt.Marker({ color: "red" })
            .setLngLat(this.coordinates)
            .addTo(map);

        map.addControl(new tt.FullscreenControl());
        map.addControl(new tt.NavigationControl());
    },
};
</script>
