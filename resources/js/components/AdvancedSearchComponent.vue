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
                <option value="-1">Qualsiasi</option>
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
        <div v-for="filteredApartment, i in filteredApartments" :key="i">
            <h3>{{filteredApartment.apartment.title}}</h3>
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
                selectedCategory: '',
                selectedServices: [],
                
                filteredApartments: [],

                selectedCityApartments: [],
                selectedCategoryApartments: [],
                selectedServicesApartments: [],

                servicesIdArray: [],
                intersection: [],

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
                console.log('click');
                this.filteredApartments = [];
                this.intersection = [];

                this.selectedCityApartments = [];
                this.selectedCategoryApartments = [];
                this.selectedServicesApartments = [];

                for (let i = 0; i < this.apartments.length; i++) {
                    
                    if(this.searchText) { //controlla se c'è del testo di ricerca
                        if(this.apartments[i].apartment.city == this.searchText) {
                            this.selectedCityApartments.push(this.apartments[i])
                        }
                    }
                    
                    if(this.selectedCategory != -1) { //controlla se c'è una categoria selezionata
                        if (this.apartments[i].category.id == this.selectedCategory) { // confronta le categorie
                            this.selectedCategoryApartments.push(this.apartments[i])
                        }
                    }

                    if (this.selectedServices.length > 0) { //controlla se ci sono servizi selezionati     
                        this.servicesIdArray = [];
                        this.apartments[i].services.forEach(element => { //salva gli id dei servizi dell'appartamento
                            this.servicesIdArray.push(element.id)
                        });

                        if (this.servicesIdArray.some(r=> this.selectedServices.includes(r))) { //confronta i servizi
                            this.selectedServicesApartments.push(this.apartments[i])
                        }
                    }
                }

                    if(this.selectedCityApartments.length > 0 && this.selectedCategoryApartments.length > 0 && this.selectedServicesApartments.length > 0) {
                        this.intersection = this.selectedCityApartments.filter(e => this.selectedCategoryApartments.some(item => item.id === e.id));
                        this.filteredApartments = this.intersection.filter(e => this.selectedServicesApartments.some(item => item.id === e.id));
                        return this.filteredApartments;
                    } else {

                        if(this.selectedCityApartments.length > 0 && this.selectedCategoryApartments.length > 0) {
                            this.filteredApartments = this.selectedCityApartments.filter(e => this.selectedCategoryApartments.some(item => item.id === e.id));
                            return this.filteredApartments;
                        }
        
                         else if(this.selectedCityApartments.length > 0 && this.selectedServicesApartments.length > 0) {
                            this.filteredApartments = this.selectedCityApartments.filter(e => this.selectedServicesApartments.some(item => item.id === e.id));
                            return this.filteredApartments;
                        }
        
                        else if(this.selectedCategoryApartments.length > 0 && this.selectedServicesApartments.length > 0) {
                            this.filteredApartments = this.selectedCategoryApartments.filter(e => this.selectedServicesApartments.some(item => item.id === e.id));
                            return this.filteredApartments;
                        } else {

                            if(this.selectedCityApartments.length > 0 && this.selectedCategoryApartments.length == 0 && this.selectedServicesApartments.length == 0) {
                                this.filteredApartments = this.selectedCityApartments;
                                return this.filteredApartments;
                            }
                            else if(this.selectedCityApartments.length == 0 && this.selectedCategoryApartments.length > 0 && this.selectedServicesApartments.length == 0) {
                                this.filteredApartments = this.selectedCategoryApartments;
                                return this.filteredApartments;
                            }
                            else if(this.selectedCityApartments.length == 0 && this.selectedCategoryApartments.length == 0 && this.selectedServicesApartments.length > 0) {
                                this.filteredApartments = this.selectedServicesApartments;
                                return this.filteredApartments;
                            }
                        }
                    }



                                

                console.log(this.filteredApartments);
                // console.log(this.intersection);
            },
        }
        
        
}
</script>

<style>

</style>