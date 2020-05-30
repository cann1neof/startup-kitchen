<template>
    <div>
        <div v-if="cards">
            <v-card
                width="50vw"
                class="mx-auto px-4 py-4 mb-4"
                v-for="(card, index) in cards"
                :key="index"
                raised
                lazy
                
            >
                <v-card-title>
                    <span
                        class="title-link"
                        @click="$router.push(`/card/${card.id}`)"
                    >
                        {{card.title}}
                    </span>
                    <v-spacer></v-spacer>
                    <v-chip-group>
                        <v-chip 
                            label
                            v-for="(theme, index) in card.themes"
                            :key="index"
                        >{{theme}}</v-chip>
                    </v-chip-group>
                </v-card-title>

                <v-card-subtitle>
                    {{card.user}}
                </v-card-subtitle>

                <v-card-text>
                    <v-row>
                        <v-col cols="4">
                            <v-img
                            :src="card.imgUrl == 'none' ? '/default-photo.png' : 'http://localhost:8000/storage/'+card.imgUrl"
                            ></v-img>
                        </v-col>
                        <v-col cols="8">
                            {{ card.text.slice(0, 200) + (card.text.length >= 60 ? '...' : '' ) }}
                        </v-col>
                    </v-row>
                </v-card-text>
            </v-card>
        </div>
        <div v-else>
            {{ nothing }}
        </div>
    </div>
</template>

<script>
export default {
    props: {
        cards: {
            type: Array,
            required: false,
            default: null
        },
        nothing: {
            type: String,
            required: true,
        }
    }
}
</script>

<style scoped>

</style>