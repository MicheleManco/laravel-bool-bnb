<template>
    <div>

        <h2>Cerca una città</h2>

        <input 
        type="text" 
        placeholder="Cerca una città"
        v-model="searchText"
        >

        <button 
        class="btn btn-primary" 
        @click="getFilteredApartments()">
            Cerca
        </button>
        
        <h2>Filtri</h2>
        <div>
            <select v-model="selectedCategory">
                <option
                    v-for="category, j in categories" 
                    :key="j" 
                    :value="category.id">{{category.name}}</option>
            </select>
            <div>
                <span v-for="service, i in services" :key="i">
                    <input type="checkbox" 
                    :value="service.id"
                    v-model="selectedServices">
                    {{service.name}}
                </span>
            </div>
        </div>
        <hr>
        
    </div>
</template>

<script>
export default {
    data() {
            return {
                searchText: '',
                selectedCategory: '',
                selectedServices: [],
                
                filteredApartments: [],

                categories: [],
                services: []
            }
        },
        props: {
            apartments: Array,
        },
        mounted() {
            axios.get('/api/categories/list')
                .then(r=>this.categories=r.data)
                .catch(e=>console.error(e))
            axios.get('/api/services/list')
                .then(r=>this.services=r.data)
                .catch(e=>console.error(e))
        },
        methods: {
            getFilteredApartments() {
                // axios.get(`/api/apartments?city=${this.searchText}&category=${this.selectedCategory}&services=${this.selectedServices}`)
                // .then(r=>console.log(r))
                // .catch(e=>console.error(e))
                console.log(this.apartments);
                
            },
        }
}
</script>

<style>

</style>