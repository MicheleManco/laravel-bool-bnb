<template>
    <div>

        <Jumbotrone /> 
        <Visitedcities />

        <h1>Appartamenti in evidenza</h1>

        <div class="elenco" v-for="sponsor, i in filter_sponsor" :key="i">

            <div class="apartment" v-for="apartment in apartments" :key="apartment.id" v-if="(apartment.id == sponsor[i].apartment_id) && (sponsor[i].end_date > expiryDate)">
                <p>
                    <a :href="`/apartment/${apartment.id}`">{{apartment.title}}</a>
                </p>
            </div>
        </div>
       
        <Randomdestination />
    </div>
      

</template>

<script>

import Jumbotrone from '../components/Jumbotrone.vue'
import Randomdestination from './Randomdestination.vue';
import Visitedcities from './Visitedcities.vue';

export default {

    name: 'HomeSearch',
    components: {
        Jumbotrone,
        Visitedcities,
        Randomdestination,
    },

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
            filter_sponsor: Array,
        },

        mounted() {

            // salva gli appartamenti del DB nell'array
            axios.get('api/apartments/list')
                .then(r => this.apartments = r.data)
                .catch(e => console.error(e));


        },

        methods: {

            getFilterCity() {

                // svuota l'array a ogni click
                this.apartmentFilted = [];

                for (let i = 0; i < this.apartments.length; i++) {

                    if(this.apartments[i].city.toLowerCase().includes(this.searchAp.toLowerCase()) || this.apartments[i].address.toLowerCase().includes(this.searchAp.toLowerCase())){

                        // aggiunge gli appartamenti filtrati nell'array
                        this.apartmentFilted.push(this.apartments[i]);
                        
                    }
                }

            }

        }

    }

</script>

<style scoped lang="scss">

</style>
