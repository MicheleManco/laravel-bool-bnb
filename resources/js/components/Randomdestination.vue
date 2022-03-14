<template>
    <!-- DESTINAZIONE CASUALE -->
    <div id="trip" class="container-fluid">
        <div id="paragraph">
            <h2>Non sai dove andare? <br>
                Fidati di noi
            </h2>
            <p>Tra i nostri tantissimi appartamenti <br>
            c'è anche quello perfetto per te.
            </p>
            <a href="#" class="BUTTON_UPJ">Destinazione casuale</a>
        </div>
    </div>
</template>

<script>

export default {
    name: 'Randomdestination',
    data(){
        return{
        }
    }
}
</script>

<style scoped lang="scss">
    #trip{
    background-image: url("https://images.unsplash.com/photo-1524169741802-fe62fbccd1a4?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1171&q=80");
    background-repeat: no-repeat;
    background-size:cover;
    margin-right:200px;
    filter: brightness(1);
    background-position: center center;
    height: 550px;
    width: 100%;
    margin:100px 0;
}

#paragraph{
    padding-top: 90px;
    color:#FFAE00;
    text-align: center;
}

#paragraph p {
    margin-bottom:35px;
}

#trip p{
  text-align:center;
  font-size: 25px;
  color: #ffffff;
}

#trip img{
    max-width: 100%;
    height: auto;
}

#trip h2 {
    margin: 20px 0;
    font-weight: bold;
}

.BUTTON_UPJ {
   color: #FFFFFF;
   font-family: Helvetica;
   font-size: 15px;
   font-weight: 100;
   padding: 20px 50px;
   background-color: #FFAE00;
   text-decoration: none;
   cursor: pointer;
   width:20%;
   margin: 0px auto;
   border-radius: 38px;
   transform: translate(0, 0);
   -ms-transform: translate(-50%, -50%);
   transition: background-color .3s ease-in-out;
}

.BUTTON_UPJ:hover {
   border: solid #FFAE00;
   text-decoration: none;
   background-color: #332b27;
}


</style>