<template>
    <!-- CARD DELLE 3 CITTA PIU' VISITATE -->
    <div class="container-fluid">
        <hr>
        <h2>Le città più visitate</h2>
        <div class="row justify-content-center" id ="city_cards">
            <div class="col-12 col-sm-4 col-md-4 col-lg-3">
                <img class="img-fluid" src="https://images.unsplash.com/photo-1531572753322-ad063cecc140?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1176&q=80" style="height:100%" alt="Roma">
                <h3>ROMA</h3>
            </div>
            <div class="col-12 col-sm-4 col-md-4 col-lg-3">
                <img class="img-fluid" src="https://images.unsplash.com/photo-1516296270211-f3ae5494e65d?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1075&q=80" alt="Milano">
                <h3>MILANO</h3>
            </div>
            <div class="col-12 col-sm-4 col-md-4 col-lg-3">
                <img class="img-fluid" src="https://images.unsplash.com/photo-1571075051578-c8cd15385f46?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1169&q=80" style="height:100%" alt="Napoli">
                <h3>TORINO</h3>
            </div>
        </div>
        
    </div>
</template>

<script>

export default {
    name: 'Visitedcities',
    data(){
        return{
        }
    }
}
</script>

<style scoped lang="scss">
.container-fluid{
    margin-bottom: 40px;
}

hr{
        width: 78%;
        border: 1px solid #978e87;
        margin: 40px auto;
    }   
    h2{
        font-size: 40px;
        text-align: center;    
        margin: 50px 0;
    }

    h3{
        color: white;
        font-weight: bold;
        margin-top:-40px;
        margin-left:25px;
    }

     #city_cards div{
         margin: 20px 0;
     }

    #city_cards img{
        border-radius:20px;
    }

</style>