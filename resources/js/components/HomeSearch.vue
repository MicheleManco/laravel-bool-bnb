<template>

    <div>
        <a href="/search">Fai una ricerca avanzata</a><br>

        <div id="search">
            <input type="search" id="search" name="search" class="txt" size="90%" placeholder="Inserisci città" v-model="searchAp" ><!--@keypress="getFilterCity"-->
            <i class="fas fa-search fs-2" @click="getFilterCity"></i>
        </div>


        <div id="elenco" >
            <div id="apartment" v-for="apartment in apartmentFilted" :key="apartment.id">

                <a :href="`/apartment/${apartment.id}`">{{apartment.city}}</a>
                <p>{{apartment.title}}</p>
                <p>{{apartment.description}}</p>
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

                // lista di appartamenti filtrati
                apartmentFilted: [],
                
                // variabili usata per la ricerca
                searchAp: "",
            };

        },

        mounted() {

            axios.get('api/apartments/list')
                .then(r => this.apartments = r.data)
                .catch(e => console.error(e));

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
