<template>
    <div class="standart-background">
        <v-card
            width="50vw"
            class="mx-auto px-4 py-4 mb-4"
            flat
            color="#F2F2F2"
        >
            <v-card-title>
                <span class="title-text">Новые проекты за сегодня</span>
            </v-card-title>
        </v-card>
        <startup-card
            :cards="cards"
            nothing="Пока что у нас нет новых проектов, но они скоро появятся!"
        ></startup-card>

        <div 
            class="text-center" 
            style="width: 100%;"
        >
            <v-btn
                class="my-3"
                color="primary"
                @click="getCards(cards.length)"
            >
                Загрузить еще
            </v-btn>
        </div>
    </div>
</template>

<script>
import StartupCard from '../components/StartupCard.vue'

export default {
    middleware: 'authenticated',
    data : () => ({
        cards: null,
    }),
    components: {
        StartupCard,
    },
    methods: {
        getCards(newStart){
            const l = (this.cards ? this.cards.length : 0)+ newStart
            this.cards = this.$store.getters.cards.slice(0, l)
        }
    },
    watch: {
        $route(){
            this.getCards(10)
        }
    },
    mounted(){
        this.getCards(10)
    }
}
</script>

<style scoped>
.card{
    border-radius: 15px !important;
    border: 2px solid #969696;
}
.title-link{
    text-decoration: underline;
}
</style>