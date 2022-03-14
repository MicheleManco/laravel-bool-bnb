<template>
    <div>

        <Jumbotrone :apartment_images="apartment_images"/> 
        <Randomdestination/>
        

        <h2>Appartamenti in evidenza</h2>
        <div class="row row-apartment">
            <div class="elenco" v-for="sponsor, i in filter_sponsor" :key="i">

                <a :href="`/apartment/${apartment.id}`" class="apartment" v-for="apartment in apartments" :key="apartment.id" v-if="(apartment.id == sponsor[i].apartment_id) && (sponsor[i].end_date > expiryDate)">
                    <div class="prezzo">
                        <div><strong>{{apartment.price}}€</strong> </div>
                    </div>
                    <img class="image" :src="getImage(apartment.id)" :alt="apartment.title">
                    <div class="description">
                        <div>{{apartment.city}}</div>
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
            apartment_images: Array,
        },

        mounted() {
            console.log('id appartamento:'+ this.apartment_images[9].id);

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

            },
            getImage(id) {
                for (let i = 0; i < this.apartment_images.length; i++) {
                    if(this.apartment_images[i].id == id) {
                        return `/storage/apartments/${id}/${this.apartment_images[i].images[0]}`
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
        font-size: 20px;
        text-decoration: none;
        color: white;
        transition: 0.3s;
        position: relative;
        overflow: hidden;
        .prezzo div{
            background-color: #2c2c2c6c;
            border-radius: 10px;
            padding: 5px;
            margin-bottom: 80px;
            width: 50%;
            text-align: center;
            z-index: 999;
        }
        .description{
            background-color: #2c2c2c6c;
            border-radius: 10px;
            padding: 5px;
            z-index: 999;
        }
        .image{
            position:absolute;
            top: -20px;
            left: -20px;
            z-index: -1;
            height: 110%;
        }
    }

    .apartment:hover {
        width: 300px;
        margin: 25px 47px;
    }
</style>
