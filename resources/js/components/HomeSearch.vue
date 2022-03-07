<template>

    <div>
        <!-- Link per andare alla ricerca avanzata -->
        <a href="/search">Fai una ricerca avanzata</a><br>

        <!-- input per la ricerca degli appartamenti tramite la città -->
        <div class="search-box">
            <input class="search-txt" type="search" id="search" name="search" size="90%" placeholder="Inserisci città" v-model="searchAp" @keyup="getFilterCity" >
            <a href="#" class="search-btn">
                <i class="fas fa-search fs-2" @click="getFilterCity"></i>
            </a>
        </div>

        <!-- elenco di appartamenti che compare se la città corrisponde -->
        <div id="elenco" >
            <div id="apartment" v-for="apartment in apartmentFilted" :key="apartment.id">
                <a :href="`/apartment/${apartment.id}`">{{apartment.city}}</a>
                <p>{{apartment.title}}</p>
                <p>{{apartment.description}}</p>
            </div>

        </div>

        <h1>Appartamenti in evidenza</h1>
        <div v-for="apartmentsponsorship, i in apartment_sponsorship" :key="i">
            <div v-if="apartmentsponsorship.end_date > expiryDate">
                <div v-for="apartmentsponsor, j in apartments" :key="j">
                    <div v-if="apartmentsponsor.id == apartmentsponsorship.id">
                        <p> {{apartmentsponsor.title}}</p>
                    </div>
                </div>
            </div>
        </div>

    </div>

</template>

<script>
    export default {

        data() {

            return {

                // lista di appartamenti presa dal DB
                apartments: [],

                // variabili usata per la ricerca
                searchAp: "",

                // lista di appartamenti filtrati
                apartmentFilted: [],
                
                date: new Date(),

                expiryDate: moment(this.date).format(),

            };

        },
        props: {
            apartment_sponsorship: Array,
        },

        mounted() {

            // salva gli appartamenti del DB nell'array
            axios.get('api/apartments/list')
                .then(r => this.apartments = r.data)
                .catch(e => console.error(e));

            console.log(this.expiryDate);
        },

        methods: {

            getFilterCity() {

                // svuota l'array a ogni click
                this.apartmentFilted = [];

                for (let i = 0; i < this.apartments.length; i++) {

                    if(this.apartments[i].city.toLowerCase().includes(this.searchAp.toLowerCase())){

                        // aggiunge gli appartamenti filtrati nell'array
                        this.apartmentFilted.push(this.apartments[i]);
                        
                    }
                }

            }

        }

    }

</script>
