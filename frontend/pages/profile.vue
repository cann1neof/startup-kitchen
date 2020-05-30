<template>
    <div v-if="user && cards" class="standart-background">
        <v-card
            width="50vw"
            class="mx-auto px-4 py-4 mb-4"
            flat
            color="#F2F2F2"
        >
            <v-card-title>
                <span class="title-text">@{{user.username}}</span>
            </v-card-title>
            <v-card-subtitle class="ml-6 subtitle-text">
                {{user.name}} <br />
                {{user.email}}
            </v-card-subtitle>
        </v-card>

        <startup-card
            :cards="cards"
            nothing="Список ваших проектов пуст!"
        ></startup-card>        
    </div>
</template>

<script>
import StartupCard from '../components/StartupCard.vue'

export default {
    middleware: 'authenticated',
    data : () => ({
        cards: null,
        user: null
    }),
    components: {
        StartupCard,
    },
    methods: {
        async getData(){
            this.user = this.$store.getters.user
            await this.$store.dispatch('fetchCards')
            this.cards = this.$store.getters.cards.filter(el => el.username == this.user.username)
        }
    },
    watch: {
        $route(){
            this.getData()
        }
    },
    mounted(){
        this.getData()
    }
}
</script>

<style scoped>
.title-link{
    text-decoration: underline;
}
</style>