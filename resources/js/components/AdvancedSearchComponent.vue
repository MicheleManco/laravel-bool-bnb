<template>
  <div>
    <a href="/">Torna indietro</a>

    <h2>Cerca una città</h2>

    <input
      type="text"
      placeholder="Cerca una città"
      v-model="searchText"
      @keyup.enter="getSearchLatLong()"
    />

    <button class="btn btn-primary" @click="getSearchLatLong()">
      Cerca
    </button>

    <h2>Filtri</h2>
    <div>

      <input type="range" min="0" max="30" step="1" v-model="searchRadius"> {{searchRadius}} KM

      <select v-model="selectedCategory">
        <option value="-1">Categoria</option>
        <option
          v-for="(category, j) in categories"
          :key="j"
          :value="category.id"
        >
          {{ category.name }}
        </option>
      </select>

      <select v-model="selectedRooms">
        <option value="-1">Stanze</option>
        <option v-for="number in numbers" :key="number" :value="number">
          {{ number }}
        </option>
        <option value="5">5+</option>
      </select>

      <select v-model="selectedBeds">
        <option value="-1">Letti</option>
        <option v-for="number in numbers" :key="number" :value="number">
          {{ number }}
        </option>
        <option value="5">5+</option>
      </select>

      <select v-model="selectedBathrooms">
        <option value="-1">Bagni</option>
        <option v-for="number in numbers" :key="number" :value="number">
          {{ number }}
        </option>
        <option value="5">5+</option>
      </select>

      <div>
        <span v-for="(service, i) in services" :key="i">
          <input
            type="checkbox"
            :value="service.id"
            v-model="selectedServices"
          />
          {{ service.name }}
        </span>
      </div>
    </div>
    <button class="btn btn-secondary" @click="filteredByPrice()">
      ordina per prezzo
    </button>
    <hr />
    <div class="result-container" style="display: flex; justify-content: space-between;">
        <div>
            <div v-for="(filteredApartment, i) in filteredApartments" :key="i">
              <h3>
                <a :href="`/apartment/${filteredApartment.apartment.id}`">{{
                  filteredApartment.apartment.title
                }}</a>
              </h3>
              <h4>{{ filteredApartment.category.name }}</h4>
              <h4>{{ filteredApartment.apartment.price }}</h4>
              <h5 v-for="(service, j) in filteredApartment.services" :key="j">
                {{ service.name }}
              </h5>
            </div>
        </div>
        <div  id="map" class="map" style="width: 1000px; height: 1000px;"></div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      // v-model dei filtri selezionati dall'utente
      searchText: "",
      selectedCategory: -1,
      selectedServices: [],
      selectedRooms: -1,
      selectedBeds: -1,
      selectedBathrooms: -1,
      // array di appartamenti filtrati
      filteredApartments: [],
      // array di tutte le categorie e servizi
      categories: [],
      services: [],
      numbers: [1, 2, 3, 4],

      searchCoordinates: [],
      searchRadius: 20,
    };
  },
  props: {
    // array di oggetti contenenti gli appartamenti con categorie e servizi associati
    apartments: Array,
  },
  mounted() {
    axios
      .get("/api/categories/list")
      .then((r) => (this.categories = r.data))
      .catch((e) => console.error(e));
    axios
      .get("/api/services/list")
      .then((r) => (this.services = r.data))
      .catch((e) => console.error(e));
  },
  methods: {
    filteredByPrice() {
      this.filteredApartments = this.filteredApartments.sort(function (a, b) {
          return a.apartment.price - b.apartment.price;
        });
    },
    // metodo per eliminare le accentate da una stringa per il confronto dell'input utente con le città
    normalizeText(text) {
      return text.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
    },
    // metodo per trovare la lista degli appartamenti filtrati secondo quello che seleziona l'utente
    getFilteredApartments() {
      // elimina le accentate dalla ricerca dell'utente
      let cleanSearchText = this.normalizeText(this.searchText);
      // associa l'array di appartamenti filtrati a quello di base con tutti gli appartamenti
      this.filteredApartments = this.apartments;

      if (this.searchCoordinates) {         
        var radius = parseInt(this.searchRadius);
        console.log(radius); 
        console.log(this.getRadius(radius)); 
        console.log(this.searchCoordinates);
        console.log(this.searchCoordinates[0]);
        console.log(this.searchCoordinates[1]);

        var minLon = this.searchCoordinates[0]-this.getRadius(radius);
        var maxLon = this.searchCoordinates[0]+this.getRadius(radius);
        var minLat = this.searchCoordinates[1]-this.getRadius(radius);
        var maxLat = this.searchCoordinates[1]+this.getRadius(radius);

        this.filteredApartments = this.filteredApartments.filter(
          (r) => r.apartment.longitude >= minLon && r.apartment.longitude <= maxLon
        );
        this.filteredApartments = this.filteredApartments.filter(
          (r) => r.apartment.latitude >= minLat && r.apartment.latitude <= maxLat
        );
      }

      // controllo sulle città con la normalizzazione del testo (in minuscolo e rimozione delle accentate)
      // if (this.searchText) {
      //   this.filteredApartments = this.filteredApartments.filter((r) => {
      //     return this.normalizeText(r.apartment.city)
      //       .toLowerCase()
      //       .includes(cleanSearchText.toLowerCase());
      //   });
      // }
      
      // controllo sul numero di stanze
      if (this.selectedRooms != -1) {
        if (this.selectedRooms < 5) {
          this.filteredApartments = this.filteredApartments.filter(
            (r) => r.apartment.rooms == this.selectedRooms
          );
        } else {
          this.filteredApartments = this.filteredApartments.filter(
            (r) => r.apartment.rooms >= this.selectedRooms
          );
        }
      }
      // controllo sul numero di letti
      if (this.selectedBeds != -1) {
        if (this.selectedBeds < 5) {
          this.filteredApartments = this.filteredApartments.filter(
            (r) => r.apartment.beds == this.selectedBeds
          );
        } else {
          this.filteredApartments = this.filteredApartments.filter(
            (r) => r.apartment.beds >= this.selectedBeds
          );
        }
      }
      // controllo sul numero di bagni
      if (this.selectedBathrooms != -1) {
        if (this.selectedBathrooms < 5) {
          this.filteredApartments = this.filteredApartments.filter(
            (r) => r.apartment.bathrooms == this.selectedBathrooms
          );
        } else {
          this.filteredApartments = this.filteredApartments.filter(
            (r) => r.apartment.bathrooms >= this.selectedBathrooms
          );
        }
      }
      // controllo sulla categoria
      if (this.selectedCategory != -1) {
        this.filteredApartments = this.filteredApartments.filter(
          (r) => r.apartment.category_id == this.selectedCategory
        );
      }
      // controllo sui servizi selezionati
      if (this.selectedServices.length > 0) {
        this.selectedServices.forEach((s) => {
          this.filteredApartments = this.filteredApartments.filter((r) =>
            r.services.some((service) => service.id === s)
          );
        });
      }
    },
    initMap() {
        var map = tt.map({
            container: "map",
            key: "GJpBcQsMGEGTQjwmKY9ABdIiOR9gVzuk",
            center: this.searchCoordinates,
            zoom: 15,
        });

        var center = new tt.Marker({ color: "black" })
        .setLngLat(this.searchCoordinates)
        .addTo(map);

        for (let i = 0; i < this.filteredApartments.length; i++) {
            var apartmentCoordinates = [this.filteredApartments[i].apartment.longitude, this.filteredApartments[i].apartment.latitude]
            var marker = new tt.Marker({ color: "red" })
                .setLngLat(apartmentCoordinates)
                .addTo(map);
        }
        map.addControl(new tt.FullscreenControl());
        map.addControl(new tt.NavigationControl());
    },
    getSearchLatLong() {
      this.searchCoordinates = [];
      const search = this.normalizeText(this.searchText);
      const endpoint = `https://api.tomtom.com/search/2/search/${search}.json?limit=1&key=GJpBcQsMGEGTQjwmKY9ABdIiOR9gVzuk`;
      const encodedEndpoint = encodeURIComponent(endpoint);

      fetch(endpoint)
        .then((a) => a.json())
        .then((r) => {
          const lon = r.results[0].position.lon;
          const lat = r.results[0].position.lat;
          this.searchCoordinates.push(lon);
          this.searchCoordinates.push(lat);

          this.getFilteredApartments();
          this.initMap();
        })
        .catch((e) => console.error("errror: ", e));
      
    },
    getRadius(inputKm){
      let radius;
      radius = parseFloat(inputKm / 1.11 * 0.01).toFixed(2);
      return parseFloat(radius);
    }
  },
};
</script>

<style>
</style>