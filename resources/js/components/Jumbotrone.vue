<template>
    <div>

        <div id="jumbotrone" class="container-fluid">
                <div id="jumbotrone_paragraph" >
                    <h1 class="logo">boolBNB</h1>
                    <p>Sentiti a casa</p>
                </div> 
            </div>

            <!-- input per la ricerca degli appartamenti tramite la città -->
            <div id="box" class="col-9 ">
                <input type="search" id="search"   name="search" class="txt" size="95%" placeholder="Inserisci città" v-model="searchAp" @keypress="getFilterCity" @keyup.8="getFilterCity()">
            </div>

             <!-- Link per andare alla ricerca avanzata -->
           <div id="advanced_reserach"><span>Vuoi fare una <a href="/search">ricerca avanzata </a>?</span> </div> <br>

            <!-- Elenco degli appartamenti ricercati -->
            <div class="row row-apartment" >
                <a :href="`/apartment/${apartment.id}`" class="apartment" v-for="apartment in apartmentFilted" :key="apartment.id">
                    <div class="prezzo">
                        <div><strong>{{apartment.price}}€</strong></div>
                    </div>
                    <img class="image" :src="getImage(apartment.id)" :alt="apartment.title">
                    <div class="description">
                        <div>{{apartment.city}}</div>
                        <div>{{apartment.title}}</div>  
                    </div>
                </a>
            </div>

    </div>
</template>

<script>

export default {
    name: 'Jumbotrone',
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
        props: {
            apartment_sponsorship: Array,
            filter_sponsor: Array,
            apartment_images: Array,
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

    *{
        margin:0;
        padding:0;
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




    #jumbotrone{
        background:url("https://images.unsplash.com/photo-1588840103995-02893d4eb8fd?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1171&q=80");
        height:550px;
        filter: contrast(1.50);
        background-repeat: no-repeat;
        background-size:cover;
        background-position: center center;
    }

    #jumbotrone div {
        height:100%;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }

    #jumbotrone_paragraph h1{
        font-size: 5em;
        color: #FFAE00;
        font-family: "Noto Serif Display", serif;
    }

    #jumbotrone_paragraph p{
        font-size: 2em;
        color: #ffffff;
    }

    #advanced_reserach{
        color:black;
        font-size:20px;
        text-align: center;
        display: flex;
        justify-content: center;
        padding:20px;
    }

    #advanced_reserach a {
        color:#FFAE00;
        font-weight: bold;
    }

    #advanced_reserach:hover {
        text-decoration: none;
    }

    hr{
        width: 78%;
        border: 1px solid #978e87;
        margin:auto;
    }    

    #search{
        height:55px;
        padding: 0 20px;
        border-radius:50px;
        margin-left: 50px;
        border:none;
        box-shadow: 5px 5px 30px grey;
    }

    #box{
        display: flex;
        flex-direction: row;
    }

    #box button{
        border-radius: 18px;
        font-family: Helvetica;
        color: #FFFFFF;
        font-size: 15px;
        font-weight: 100;
        height: 60px;
        margin-top: 10px;
        margin-left: 10px;
        border: none;
        background-color: #FFAE00;
        box-shadow: 5px 5px 30px grey;
        border-radius: 38px;
        transform: translate(0, 0);
        -ms-transform: translate(-50%, -50%);
        transition: background-color .3s ease-in-out;
    }

    #box button:hover {
        border: solid #FFAE00;
        border-radius: 38px;
        text-decoration: none;
        background-color: #332b27;
    }

    #box{
        width: 70%;
        margin: 0 auto;
        margin-top: -40px;
    }

</style>