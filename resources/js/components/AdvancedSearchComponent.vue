<template>
    <div>

        <h2>Cerca una città</h2>

        <input 
        type="text" 
        name="" 
        id="" 
        placeholder="Cerca una città"
        :v-model="searchText"
        >

        <button 
        class="btn btn-primary" 
        @click="getApartments()">
            Cerca
        </button>
        
        <h2>Filtri</h2>
        <div>
            <select>
                <option
                    v-for="category, j in categories" 
                    :key="j" 
                    :value="category.id"
                    :v-model="selectedCategory">{{category.name}}</option>
            </select>
            <div>
                <span v-for="service, i in services" :key="i">
                    <input type="checkbox" 
                    :name="service.name" 
                    :id="service.name" 
                    :value="service.id"
                    :v-model="selectedServices">
                    {{service.name}}
                </span>
            </div>
        </div>
        
    </div>
</template>

<script>
export default {
    data: function() {
            return {
                searchText: '',
                selectedCategory: '',
                selectedServices: [],
                filteredApartments: [],
                categories: [],
                services: []
            }
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
            getApartments() {

            }
        }
}
</script>

<style>

</style>