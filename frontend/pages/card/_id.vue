<template>
    <div class="standart-background" v-if="card">
        <v-card
            width="50vw"
            class="mx-md-auto"
            flat
            color="#F2F2F2"
        >   
            <v-card-text>
                <v-card>
                    <v-card-title>
                        <span class="title-text">{{card.title}}</span>
                    </v-card-title>
                    <v-card-subtitle class="subtitle-text">
                        @{{card.user}}
                    </v-card-subtitle>
                </v-card>
            </v-card-text>
        </v-card>
        <v-card
            width="50vw"
            class="mx-md-auto pb-4 mb-4"
            flat
            color="#F2F2F2"
        >   
            <v-card-text>
                <v-row>
                    <v-col cols=4>
                        <v-card>
                            <v-card-text>
                                <v-img
                                    :src="card.imgUrl == 'none' ? '/default-photo.png':card.imgUrl"
                                    contain
                                ></v-img>
                            </v-card-text>
                        </v-card>
                    </v-col>
                    <v-col cols=8>
                        <v-card>
                            <v-card-text>
                                <v-chip-group>
                                    <v-chip 
                                        label
                                        v-for="(theme, index) in card.themes"
                                        :key="index"
                                    >{{theme}}</v-chip>
                                </v-chip-group>
                                {{card.text}}
                            </v-card-text>
                        </v-card>

                        
                        <v-divider class="my-3"></v-divider>

                        <contacter :instance="card.contacts"> </contacter>
                    </v-col>
                </v-row>
            </v-card-text>
        </v-card>
    </div>
</template>

<script>
import Contacter from '../../components/Contacter.vue'

export default {
    data : () => ({
        card: null
    }),
    components: {
        Contacter,
    },
    methods:{
        getCard(){
            const id = this.$route.params.id
            this.card = this.$store.getters.cards.filter(el => el.id == id)[0]
            console.log(this.card)
        }
    },
    watch: {
        $route(){
            this.getCard()
        }
    },
    mounted(){
        this.getCard()
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