<template>
    <div class="standart-background">
        <v-card
            width="50vw"
            class="mx-auto py-4 mb-4"
            flat
            color="#F2F2F2"
        >
            <v-card-title>
                Поиск
                <v-spacer></v-spacer>
                <v-btn
                    color="primary"
                    nuxt
                    to="/search/advanced/"
                >
                    Расширенный поиск
                </v-btn>

            </v-card-title>
            <v-card-text>
                <v-card>
                    <v-card-title>
                        <v-text-field
                            label="Начните набирать название проекта"
                            outlined
                            hide-details
                            clearable
                            append-icon="mdi-magnify"
                            @click:append="search()"
                            @keydown.enter="search()"
                            v-model="searchingRequest"
                        ></v-text-field>
                    </v-card-title>
                </v-card>
                <startup-card
                    class="mt-3"
                    :cards="cards"
                    :nothing="searchingRequest.length ? 'По вашему запросу ничего не найдено' : ''"
                >
                </startup-card>
            </v-card-text>
        </v-card>


    </div>
</template>

<script>
import StartupCard from '../../components/StartupCard.vue'

export default {
    middleware: 'authenticated',
    data: () => ({
        searchingRequest: '',
        cards: null,
    }),
    components: {
        StartupCard,
    },
    methods: {
        search(){
            if(this.searchingRequest.replace(/\s/g,"") != ""){
                this.$axios.post(`http://localhost:8000/api/card/search`,{q:this.searchingRequest}).then(res => {
                    let tempCards = res.data
                    for(let each of tempCards){
                        each.themes = JSON.parse(each.themes)
                        each.contacts = JSON.parse(each.contacts)
                    }
                    this.cards = tempCards
                }).catch(err => console.log(err))
            }
        },
    },
}
</script>

<style scoped>
.standart-background{
	background-color: #F2F2F2;
	width: 100vw;
	min-height: 90vh;
}
</style>