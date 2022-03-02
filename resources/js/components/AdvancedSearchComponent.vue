<template>
    <div>

        <a href="/">Torna indietro</a>

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
                <option value="-1">Categoria</option>
                <option
                    v-for="category, j in categories" 
                    :key="j" 
                    :value="category.id">{{category.name}}</option>
            </select>

            <select v-model="selectedRooms">
                <option value="-1">Stanze</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5+</option>
            </select>

            <select v-model="selectedBeds">
                <option value="-1">Letti</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5+</option>
            </select>

            <select v-model="selectedBathrooms">
                <option value="-1">Bagni</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5+</option>
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
        <div v-for="filteredApartment, i in filteredApartments" :key="i">
            <h3><a :href="`/apartment/${filteredApartment.apartment.id}`">{{filteredApartment.apartment.title}}</a></h3>
            <h4>{{filteredApartment.category.name}}</h4>
            <h5 v-for="service,j in filteredApartment.services" :key="j">{{service.name}}</h5>
        </div>
    </div>
</template>

<script>
export default {
    data() {
            return {
                searchText: '',
                selectedCategory: -1,
                selectedServices: [],
                selectedRooms: -1,
                selectedBeds: -1,
                selectedBathrooms: -1,
                
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
                let cleanSearchText= this.searchText.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
                this.filteredApartments = this.apartments;
                if (this.searchText) {
                    this.filteredApartments = this.filteredApartments.filter(r=>r.apartment.city.toLowerCase().includes(cleanSearchText.toLowerCase()))
                }
                if (this.selectedRooms != -1) {
                    if (this.selectedRooms < 5) {
                        this.filteredApartments = this.filteredApartments.filter(r=>r.apartment.rooms == this.selectedRooms)
                    }else {
                        this.filteredApartments = this.filteredApartments.filter(r=>r.apartment.rooms >= this.selectedRooms)
                    }
                }
                if (this.selectedBeds != -1) {
                    if (this.selectedBeds < 5) {
                        this.filteredApartments = this.filteredApartments.filter(r=>r.apartment.beds == this.selectedBeds)
                    }else {
                        this.filteredApartments = this.filteredApartments.filter(r=>r.apartment.beds >= this.selectedBeds)
                    }
                }
                if (this.selectedBathrooms != -1) {
                    if (this.selectedBathrooms < 5) {
                        this.filteredApartments = this.filteredApartments.filter(r=>r.apartment.bathrooms == this.selectedBathrooms)
                    }else {
                        this.filteredApartments = this.filteredApartments.filter(r=>r.apartment.bathrooms >= this.selectedBathrooms)
                    }
                }
                if (this.selectedCategory != -1) {
                    this.filteredApartments = this.filteredApartments.filter(r=>r.apartment.category_id == this.selectedCategory)
                }
                if (this.selectedServices.length > 0) {
                    this.selectedServices.forEach(s => {
                        this.filteredApartments = this.filteredApartments.filter(r=>r.services.some(service => service.id === s))
                    });
                }                
            },
        }
        
        
}
</script>

<style>

</style>