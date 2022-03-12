<template>
    <div>

        <Jumbotrone/> 
        <Randomdestination/>
        

        <h2>Appartamenti in evidenza</h2>
        <div class="row row-apartment">
            <div class="elenco" v-for="sponsor, i in filter_sponsor" :key="i">

                <a :href="`/apartment/${apartment.id}`" class="apartment" v-for="apartment in apartments" :key="apartment.id" v-if="(apartment.id == sponsor[i].apartment_id) && (sponsor[i].end_date > expiryDate)">
                    <div>
                        <p><strong>{{apartment.price}}€</strong> </p>
                    </div>
                    <img src="/images/apartment-placeholder.jpg" :alt="apartment.title">
                    <div>
                        <span>{{apartment.city}}</span>
                        <div>{{apartment.title}}</div>  
                    </div>
                </a>
            </div>   
        </div>
        
       
        <Visitedcities/>
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
h2{
        font-size: 40px;
        text-align: center;    
        margin: 50px 0;
    }
.row-apartment{
        width: 90%;
        margin: 0 auto;
        display: flex;
        justify-content: center;
    }
    .apartment{
        border-radius: 20px;
        box-shadow: 4px 5px 3px 0px #888888;
        display: flex;
        height: auto;
        width: 280px;
        justify-content: space-between;
        flex-direction: column;
        margin: 40px 47px;
        padding: 15px;
        background-color: #FFAE00;
        font-size: 20px;
        text-decoration: none;
        color: white;
        transition: 0.3s;

        img {
            width: 100%;
        }
    }


    .apartment:hover {

        color: black;
        // height: 320px;
        width: 300px;
        margin: 25px 47px;

        img {
            margin: 2px auto;
            width: 100%;
        }
    }
</style>
