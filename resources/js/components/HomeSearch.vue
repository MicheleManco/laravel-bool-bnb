<template>
    <div>
        <!-- elenco di appartamenti che compare se la città corrisponde -->
        <div id="elenco" >
            <div  id="apartment" v-for="apartment in apartmentFilted" :key="apartment.id">
                <a :href="`/apartment/${apartment.id}`">{{apartment.city}}</a>
                <p>{{apartment.title}}</p>
                <p>{{apartment.description}}</p>
            </div>
        </div>

        <Jumbotrone />
        <Visitedcities />
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
                
                
            };

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

                    if(this.apartments[i].city.toLowerCase().includes(this.searchAp.toLowerCase())){

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
