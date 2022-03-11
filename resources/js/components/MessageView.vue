<template>
    
    <div id="views">

        <h2 class="apartment">Messaggi ricevuti per <br> 
        "{{apartment.title}}"</h2>

        <hr>

        <div class="noMessage col-12" v-if="this.filtered_messages.length === 0">
            <p>Non ci sono messaggi per questo appartamento</p>
        </div>
        <div class="messageViews" v-for="message, i in this.filtered_messages" :key="i">
            <h2>{{message.name}} {{message.surname}}</h2>
            <h6>{{message.email}}</h6>
            <p>{{message.text}}</p>

            <span class="btn position-absolute bottom-0 end-0">Rispondi</span>
        </div>
    </div>
    

</template>

<script>

export default {

    data(){
        return{

        }
    },

    props: {

        apartment: Object,
        messages: Array,
        filtered_messages: Array,
    },

    methods: {

    }
}
</script>

<style scoped lang="scss">

#views {

        margin-left: 50px ;

        .apartment {

            color: #6c6c6c;
            font-weight: bold;
            margin-left: 20px;
            padding-top: 10px;
        }
        
        hr {
            margin-left: 20px ;
            width: 70%;
            border: 1px solid #6c6c6c;
        }

        .noMessage {

        
           text-align: center;

        }

        .messageViews {
            border: 1px solid gray;
            margin: 20px;
            padding: 20px;
            width: 50%;
            position: relative;

            h2, h6 {
                font-weight: bold;
                color: #6c6c6c;
            }

            p {

                width: 80%;
                padding-bottom:20px ;
            }

            .btn{
                color: white;
                background-color: #ffae00;
                border-radius: 20px;
                padding: 5px 50px;
                right: 10px;
                bottom: 15px;
                position: absolute;
            }

            .btn:hover {

                color: black;
            }
        }

    }


</style>