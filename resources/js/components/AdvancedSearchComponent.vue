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
        <div v-for="apartment, i in filteredApartments" :key="i">
            qui appartamento
        </div>
    </div>
</template>

<script>
export default {
    data() {
            return {
                searchText: '',
                selectedCategory: '',
                selectedServices: [],
                
                servicesArray: [],
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
                this.filteredApartments = [];

                for (let i = 0; i < this.apartments.length; i++) {
                    // fare il controllo su come è scritto
                    if(this.apartments[i].apartment.city == this.searchText) { //confronta la città

                        if(this.selectedCategory) { //controlla se c'è una categoria selezionata
                            if (this.apartments[i].category.id == this.selectedCategory) { // confronta le categorie

                                if (this.selectedServices.length > 0) { //controlla se ci sono servizi selezionati
                                    this.servicesArray = []
                                    this.apartments[i].services.forEach(element => { //salva gli id dei servizi
                                        this.servicesArray.push(element.id)
                                    });
                                        if (this.servicesArray.some(r=> this.selectedServices.includes(r))) { //confronta i servizi
                                            this.filteredApartments.push(this.apartments[i])
                                        }
                                } else {
                                    this.filteredApartments.push(this.apartments[i])
                                }
                            }
                        } else {
                            this.filteredApartments.push(this.apartments[i])
                        }
                    }
                }
                                
            },
        }
        
        
}
</script>

<style>

</style>