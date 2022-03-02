<template>
  <div class="container">
    <div id="map" class="map" style="height: 300px"></div>
    <h1>{{city}}</h1>
    {{address}}
  </div>
</template>

<script>
import tt from "@tomtom-international/web-sdk-maps";
// import axios from "axios";

export default {
  props: {
    address: String,
    city: String,
    cap: String,
  },

  data() {
    return {
      coordinates: [],
    };
  },
  mounted() {
    this.getAddressLatLong();
  },

  methods: {
    initMap() {
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
    getAddressLatLong() {
      const address = `${this.address}, ${this.city}, ${this.cap}`;
      const endpoint = `https://api.tomtom.com/search/2/search/${address}.json?limit=1&key=GJpBcQsMGEGTQjwmKY9ABdIiOR9gVzuk`;
      const encodedEndpoint = encodeURIComponent(endpoint);

      fetch(endpoint)
        .then((a) => a.json())
        .then((r) => {
          const lat = r.results[0].position.lat;
          const lon = r.results[0].position.lon;
          this.coordinates.push(lon);
          this.coordinates.push(lat);

          console.log({ lat, lon });
          this.initMap();
        })
        .catch((e) => console.error("errror: ", e));
    },
  },
};
</script>
