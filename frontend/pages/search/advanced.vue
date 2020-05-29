<template>
    <div class="standart-background">
        <v-card
            width="60vw"
            class="mx-auto px-4 py-4 mb-4"
            flat
            color="#F2F2F2"
        >
            <v-card-title>
                Расширенный поиск
                <v-spacer></v-spacer>
                <v-btn
                    color="primary"
                    nuxt
                    to="/search/"
                >
                    Стандартный поиск
                </v-btn>
            </v-card-title>
            <v-card-text>
                <v-row>
                    <v-col cols=8>
                        <v-card>
                            <v-card-title>
                                <v-text-field
                                    label="Начните набирать название проекта"
                                    outlined
                                    hide-details
                                    dense
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
                            :nothing="searchingRequest ? 'По вашему запросу ничего не найдено' : ''"
                        ></startup-card>
                    </v-col>
                    <v-col cols=4>
                        <v-card>
                            <v-card-title>
                                <span style="font-size: 18px;">Параметры поиска</span>
                            </v-card-title>
                            <v-card-text>
                                <v-select
                                    v-model="value"
                                    :items="chips"
                                    attach
                                    outlined
                                    dense
                                    label="Выберите профиль"
                                    multiple
                                ></v-select>
                                <v-radio-group 
                                    v-model="radioValue"
                                    class="mt-0"
                                >
                                    <v-radio
                                        label="Я ищу проект"
                                        value="1"
                                    ></v-radio>
                                    <v-radio
                                        label="Я ищу разработчика в проект"
                                        value="2"
                                    ></v-radio>
                                </v-radio-group>
                            </v-card-text>
                        </v-card>
                    </v-col>
                </v-row>
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
        chips: [
            {text: 'THEME 1'}, {text: 'THEME 2'}, {text: 'THEME 3'}, {text: 'THEME 4'}
        ],
        value: null,
        radioValue: null,
        cards: null,
    }),
    components: {
        StartupCard,
    },
    methods: {
        search(){
            if(this.searchingRequest.replace(/\s/g,"") != "" && this.value && this.radioValue){
                const searchingRequest = this.searchingRequest.replace(/\s/g, '+')
                const searchingFilters = this.value.join('+').replace(/\s/g, '_')
                const searchingType = this.radioValue
                console.log(searchingRequest, searchingFilters, searchingType)
                this.$axios.get(`${searchingRequest}`).then(res => {
                    this.cards = res.data.cards
                }).catch(err => console.log(err))
            }
        }
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