<template>

    <div>
        <a href="#">Fai una ricerca avanzata</a><br>

        <div id="search">
            <input type="search" id="search" name="search" class="txt" size="90%" placeholder="Inserisci città" v-model="searchApp">
            <i class="fas fa-search fs-2"></i>
        </div>


        <div id="elenco" v-for="apartment in apartments" :key="apartment.id">
<!-- v-if="apartment.title.toLowerCase().includes(searchApp.toLowerCase())" -->
            <div id="apartment">
                <a href="#">{{apartment.title}}</a>
            </div>

        </div>

    </div>

</template>

<script>
    export default {

        data() {

            return {

                apartments: [],

                apartmentFilted: [],
            };

            searchApp= "";
        },

        mounted() {

            axios.get('api/apartments/list')
                .then(r => this.apartments = r.data)
                .catch(e => console.error(e));

        },

    }

</script>
