<template>
  <section>
    <section class="controls">
      <div class="search-bar-cont">
        <input class="city-search"
          type="text"
          placeholder="Cerca una città"
          v-model="searchText"
          @keyup.enter="getSearchLatLong()"
        />
        <!-- pulsante cerca -->
        <button class="my-btn" @click="getSearchLatLong()">
          Cerca
        </button>
      </div>
        <!-- <hr> -->
      <!-- sezione filtri -->
      <div class="filter-cont">
        <div>
          <h2>Filtri</h2>
        </div>
        <div>
          <div class="range-cont">
            <!-- raaggio di kilometri per la ricerca -->
            <span>Cerca in un raggio di:</span><input type="range" min="0" max="30" step="1" v-model="searchRadius"> <span>{{searchRadius}} KM</span>
          </div>
          <div class="select-cont">
            <!-- selezione categoria -->
            <div category-rooms-container>
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
            <!-- selezione numero di stanze -->
            <select v-model="selectedRooms">
              <option value="-1">Stanze</option>
              <option v-for="number in numbers" :key="number" :value="number">
                {{ number }}
              </option>
              <option value="5">5+</option>
            </select>
            </div>
            <div class="beds-bathrooms-container">
            <!-- selezione numero di leti -->
            <select v-model="selectedBeds">
              <option value="-1">Letti</option>
              <option v-for="number in numbers" :key="number" :value="number">
                {{ number }}
              </option>
              <option value="5">5+</option>
            </select>
            <!-- selezione numero di bagni -->
            <select v-model="selectedBathrooms">
              <option value="-1">Bagni</option>
              <option v-for="number in numbers" :key="number" :value="number">
                {{ number }}
              </option>
              <option value="5">5+</option>
            </select>
            </div>
          </div>
          <div class="service-cont">
          <!-- selezione servizi aggiuntivi -->
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
      </div>
      <div class="order-cont">
        <!-- pulsante ordina per prezzo minore -->
        <div>
          <button class="my-btn btn-outline" @click="filteredByPrice()">
            ordina per prezzo
          </button>
          <hr />
        </div>
            <!-- numero di risultati -->
        <p>{{filteredApartments.length}} Risultati</p>
            <!-- messaggio di errore se non si inserisce una città -->
      </div>
    </section>

      
    <div class="result-cont">
      <div v-if="noSearch">
        Devi inserire una città.
      </div>
        <div class="results">
          <!-- lista di appartamenti risultati dalla ricerca -->
          <div v-for="(filteredApartment, i) in filteredApartments" :key="i" class="apartment">
            <h3>
              <a :href="`/apartment/${filteredApartment.apartment.id}`">{{
                filteredApartment.apartment.title
              }}</a>
            </h3>
            <div class="apartment-head">
              <h4>{{ filteredApartment.apartment.city }}</h4>
              <h4>{{ filteredApartment.apartment.price }} €</h4>
            </div>
            <h4>{{ filteredApartment.category.name }}</h4>
            <div class="apartment-labels">
              <h5 v-for="(service, j) in filteredApartment.services" :key="j">
                {{ service.name }}
              </h5>
            </div>
          </div>
        </div>
      <!-- mappa che mostra gli appartamenti -->
      <div id="map" class="map"></div>
    </div>
  </section>
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

      searchCoordinates: [], // coordinate dell'indirizzo ricercato
      searchRadius: 20, // raggio in cui compiere la ricerca
      noSearch: 0, // se non c'è testo ricercato diventa 1 per mostrare un messaggio di errore
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
      // associa l'array di appartamenti filtrati a quello di base con tutti gli appartamenti
      this.filteredApartments = this.apartments;

      // se ci sono coordinate ricercate (cioé se l'utente ha inserito una citt'nel campo di ricerca)
      if (this.searchCoordinates) {         
        var radius = parseInt(this.searchRadius); //valore del raggio di ricerca

        // calcola coordinate massime e minime in cui fare la ricerca
        var minLon = this.searchCoordinates[0]-this.getRadius(radius);
        var maxLon = this.searchCoordinates[0]+this.getRadius(radius);
        var minLat = this.searchCoordinates[1]-this.getRadius(radius);
        var maxLat = this.searchCoordinates[1]+this.getRadius(radius);

        // filtra gli appartamenti che sono all'interno delle coordinate massime e minime
        this.filteredApartments = this.filteredApartments.filter(
          (r) => r.apartment.longitude >= minLon && r.apartment.longitude <= maxLon
        );
        this.filteredApartments = this.filteredApartments.filter(
          (r) => r.apartment.latitude >= minLat && r.apartment.latitude <= maxLat
        );
      }
      
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
      // metodo che disegna la mappa a partire dalle coordinate dell'indirizzo inserito nel campo di ricerca
        var map = tt.map({
            container: "map",
            key: "GJpBcQsMGEGTQjwmKY9ABdIiOR9gVzuk",
            center: this.searchCoordinates,
            zoom: 15,
        });

        var center = new tt.Marker({ color: "black" })
        .setLngLat(this.searchCoordinates)
        .addTo(map);
        // stampa tutti gli appartameni filtrati sulla mappa
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
      this.noSearch = 0;
      // controlla che sia stata inserita una città
      if(!this.searchText) {
        this.noSearch = 1;
        this.filteredApartments = [];
        this.initMap();
        return
      }
      // funzione che ritorna le coordinate del campo di ricerca
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

          // filtra i risultati e crea la mappa
          this.getFilteredApartments();
          this.initMap();
        })
        .catch((e) => console.error("errror: ", e));      
    },
    getRadius(inputKm){
      // trasforma il valore del raggio di ricerca da KM a gradi di coordinata (non è super preciso)
      let radius;
      radius = parseFloat(inputKm / 1.11 * 0.01).toFixed(2);
      return parseFloat(radius);
    }
  },
};
</script>

<style lang="scss" scoped>

section {
  font-size: 1.2rem;
  display: flex;
  flex-direction: column;
  align-items: center;
    a {
      color: #ffae00;
      font-weight: bold;
    }
    .my-btn {
        background: #ffae00;
        color: #fff;
        border-radius: 30px;
        border: solid #ffae00;
        padding: 10px 30px;
        transition: all 0.2s ease;
        text-decoration: none;
       
        &:hover {
            font-weight: bold;
            background-color: #332b27;
        }
        &.btn-outline {
            background: #fff;
            border: solid #ffae00;
            color: #ffae00;
        }
    }
  .controls{
    .search-bar-cont {
      width: 100%;
      display: flex;
      margin: 3rem 0;
      * {
        margin: 0 20px;
      }
      .city-search {
        width: 80%;
        border-radius: 30px;
        border: 1px solid #cbcbcb;
        padding: 10px 0 10px 25px;
      }
         @media (max-width: 480px) {
            flex-direction: column;
          }
          .my-btn {
            @media (max-width: 480px) {
            max-width: 120px;
            margin-top: 10px;
          }
          }
    }
    .filter-cont {
      display: flex;
      flex-direction: column;
      align-items: center;
      margin-bottom: 1rem;
      h2{
        font-weight: bold;
      }
      .range-cont, .select-cont{
        display: flex;
        justify-content: center;
      }
      .range-cont{
        margin: 1rem 0;
        input {
          width: 50%;
          margin: 0 1rem;
          @media (max-width: 600px) {
            width: 20%;
          }
        }
      }
      .select-cont{
        margin-bottom: 1rem;
        width: 100%;
      
         @media (max-width: 600px) {
              display: block;
              width: 50%;
              max-width: 200px;
              margin:auto;
            }

        select {
          margin-bottom: 5px;
          margin-right: 1rem;
          border-radius: 30px;
          padding: .2rem 1.5rem;
          
          @media (max-width: 600px) {
              margin: 5px;
          }
        }
      }
      .service-cont{
        display: grid; 
        grid-template-columns: 1fr 1fr 1fr 1fr; 
        grid-template-rows: 1fr 1fr 1fr; 
        gap: 0 2rem; 
        margin-bottom: 1rem;

        @media (max-width: 1200px) {
            grid-template-columns: 1fr 1fr 1fr;
        }

        @media (max-width: 768px) {
            grid-template-columns: 1fr 1fr;
        }

        @media (max-width: 480px) {
            grid-template-columns: 1fr;
        }

        span {
          line-height: 1.2em;
        }
      }
    }
  }
    .order-cont{
      margin-bottom: 1rem;
      width: 100%;
      div {
        display: flex;
        align-items: center;
        hr {
          width: 80%;
        }
        @media (max-width: 768px) {
          flex-direction: column;
        }
      }
      .my-btn {
        margin-right: 1rem;
        width: 220px;
        font-size: 15px;
      }
      p {
        text-align: center;
      }
    }
  .result-cont{
    width: 100%;
    display: flex;
    justify-content: flex-end;
    column-gap: 1rem;
     @media (max-width: 480px) {
          flex-direction: column;
        }
    .results {
      width: 40%;
      height: 1000px;
      overflow: auto;
      padding: 1rem;
      @media (max-width: 480px) {
          width: 100%;
      }
      
      .apartment {
        overflow: hidden;
        border: 1px solid #cbcbcb;
        height: 300px;
        margin-bottom: 1rem;
        padding: 1rem;
        transition: all 0.2s ease;
        &:hover {
              box-shadow: 0 0 20px #cbcbcb;
              border-color: #a0a0a0;
              transform: scale(1.01);
            }
        .apartment-head {
          display: flex;
          justify-content: space-between;
          h4{
            font-weight: bold;
          }
      
        }
        .apartment-labels{
          display: flex;
          flex-wrap: wrap;
          margin-top: 1rem;
         
          h5{
            margin-right: 1rem;
            color: #fff;
            background: #ffae00;
            border-radius: 30px;
            padding: .5rem 1rem;
            font-size: .6rem;
          }
        }
      }
    }
    #map {
      width: 50%;
      height: 1000px;
      margin: 0px 50px 50px 10px;
       @media (max-width: 480px) {
          width: 100%;
      }
    }
  }
}

</style>>