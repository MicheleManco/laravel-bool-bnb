<template>
    
    <div id="views">
        <div class="noMessage" v-if="this.filtered_messages.length === 0">
            <p>Non ci sono messaggi per questo appartamento</p>
        </div>
        <div class="messageViews" v-for="message, i in this.filtered_messages" :key="i">
            <span>Messaggio inviato da {{message.name}} {{message.surname}}</span><br>

            <p>{{message.text}}</p>
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