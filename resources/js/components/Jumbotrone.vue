<template>
    <div>

        <div id="jumbotrone" class="container-fluid">
                <div id="jumbotrone_paragraph" >
                    <h1>boolBNB</h1>
                    <p>Sentiti a casa</p>
                </div> 
            </div>

            <!-- input per la ricerca degli appartamenti tramite la città -->
            <div id="box" class="col-9 ">
                <input type="search" id="search"   name="search" class="txt" size="95%" placeholder="  Inserisci città" v-model="searchAp" @keyup="getFilterCity" ><!--@keypress="getFilterCity"-->
                <button class="col-2 " href="#" id="button_search" @click="getFilterCity">Cerca</button>
            </div>

            <!-- Link per andare alla ricerca avanzata -->
            <a id="advanced_reserach" href="/search">Vuoi fare una <span> ricerca avanzata</span> ? </a><br>

            <hr>   

            <h2>Le città più visitate</h2>

    </div>
</template>

<script>

export default {
    name: 'Jumbotrone',
    data(){
        return{
        }
    }
}
</script>

<style scoped lang="scss">

    *{
        margin:0;
        padding:0;
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

    #advanced_reserach > span {
        color:#FFAE00;
        font-weight: bold;
        margin-left: 3px;
    }

    #advanced_reserach:hover {
        text-decoration: none;
    }

    hr{
        width: 78%;
        margin:auto;
        color: #978e87;
    }    

    h2{
        font-size: 40px;
        text-align: center;    
        margin: 50px 0;
    }

    #search{
        height:55px;
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
        color: #FFFFFF;
        font-family: Helvetica;
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